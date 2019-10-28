<?php
	require_once "../../model/exceptions/InvalidParamException.class.php";
	require_once "../../model/exceptions/DatabaseException.class.php";

	class User {
		private $_id;
		private $_pseudo;
		private $_email;
		private $_db;

		/*
		** -------------------- Serialize --------------------
		*/
		public function serialize()
	    {
	        return serialize([
	            $this->_id,
	            $this->_pseudo,
	            $this->_email,
				$this->_db
	        ]);
	    }

	    public function unserialize($data)
	    {
	        list(
	            $this->_id,
	            $this->_pseudo,
	            $this->_email,
				$this->_db
	        ) = unserialize($data);
	    }


		/*
		** -------------------- Construct --------------------
		*/
		public function __construct()
		{
			$a = func_get_args();
	        $i = func_num_args();
	        if (method_exists($this, $f = '__construct' . $i)) {
	            call_user_func_array(array($this,$f),$a);
	        }
			else {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Wrong amount of parameters ($i).\n", 0);
			}
		}

		private function __construct2($id_cookie, $db)
		{
			// test parameters validity
			if (!User::is_valid_id($id_cookie)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid id.\n", 21);
			}
			if (!Database::is_valid($db)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid db object.\n", 22);
			}

			// query from database
			$query = "SELECT user.id_user, pseudo, email FROM user JOIN cookie ON cookie.id_user = user.id_user WHERE id_cookie = :idc;";
			$db->query($query, array(':idc' => $id_cookie));
			$row = $db->fetch();
			if ($row === false) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". id_cookie not found in database.\n", 30);
			}

			// set object properties
			$this->_id = $row['id_user'];
			$this->_pseudo = $row['pseudo'];
			$this->_email = $row['email'];
			$this->_db = $db;
		}

		private function __construct3($email, $hashed_password, $db)
		{
			// test parameters validity
			if (!User::is_valid_email($email)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid email.\n", 31);
			}
			if (!User::is_valid_hashed_password($hashed_password)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid hashed password.\n", 32);
			}
			if (!Database::is_valid($db)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid db object.\n", 33);
			}

			// query from database
			$query = 'SELECT id_user, pseudo FROM user WHERE email = :em AND password = :pw;';
			$db->query($query, array(':em' => $email, ':pw' => $hashed_password));
			$row = $db->fetch();
			if ($row === false) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". User-password combination not found in database.\n", 30);
			}

			// set object properties
			$this->_id = $row['id_user'];
			$this->_pseudo = $row['pseudo'];
			$this->_email = $email;
			$this->_db = $db;
		}

		private function __construct4($pseudo, $email, $hashed_password, $db)
		{
			// test parameters validity
			if (!User::is_valid_pseudo($pseudo)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid pseudo.\n", 41);
			}
			if (!User::is_valid_email($email)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid email.\n", 42);
			}
			if (!User::is_valid_hashed_password($hashed_password)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid password.\n", 43);
			}
			if (!Database::is_valid($db)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid db object.\n", 44);
			}
			if (User::is_email_in_use($email, $db)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Email in use.\n", 42);
			}

			// adding new user to database and pull the id_user
			$query = 'INSERT INTO user (pseudo, email, password) VALUES (:ps, :em, :pw);';
			$db->query($query, array(':ps' => $pseudo, ':em' => $email, ':pw' => $hashed_password));
			$query = 'SELECT LAST_INSERT_ID() AS `id_user`;';
			$db->query($query, array());
			$row = $db->fetch();
			if ($row === false) {
				throw new DatabaseException("Failed constructing " . __CLASS__ . ". Id not pulled from db.\n");
			}

			// set object properties
			$this->_id = $row['id_user'];
			$this->_pseudo = $pseudo;
			$this->_email = $email;
			$this->_db = $db;
		}


		/*
		** -------------------- Magic methods --------------------
		*/
		public function __destruct() {
			$this->_id = null;
			$this->_pseudo = null;
			$this->_email = null;
			$this->_db = null;
		}
		public function __toString()
		{
			return get_pseudo();
		}


		/*
		** -------------------- Account verification --------------------
		*/
		// public function send_account_verification_request() //ni
		// public function receive_account_verification_request($unique_key) //ni


		/*
		** -------------------- Set --------------------
		*/
		public function set_pseudo($new)
		{
			if (!User::is_valid_pseudo($new)) {
				throw new InvalidParamException("Failed setting pseudo. Invalid pseudo.\n");
			}

			$query = 'UPDATE user SET pseudo = :ps WHERE id_user = :id;';
			$this->_db->query($query, array(':ps' => $new, ':id' => $this->_id));
			$modified_row_count = $this->_db->rowCount();
			if ($modified_row_count !== 1) {
				throw new DatabaseException("Fail setting pseudo. " . $modified_row_count . " rows have been modified in the database.\n");
			}

			$this->_pseudo = $new;
		}
		public function set_email($new)
		{
			if (!User::is_valid_email($new)) {
				throw new InvalidParamException("Fail setting email. Invalid email.\n", 1);
			}
			if (User::is_email_in_use($new, $this->_db)) {
				throw new InvalidParamException("Failed setting email. Email in use.\n", 1);
			}

			$query = 'UPDATE user SET email = :em WHERE id_user = :id;';
			$this->_db->query($query, array(':em' => $new, ':id' => $this->_id));
			$modified_row_count = $this->_db->rowCount();
			if ($modified_row_count !== 1) {
				throw new DatabaseException("Fail setting email. " . $modified_row_count . " rows have been modified in the database.\n");
			}

			$this->_email = $new;
		}
		public function set_password($hashed_old, $hashed_new)
		{
			if (!User::is_correct_password($hashed_old, $this->_db)) {
				throw new InvalidParamException("Fail setting password. Wrong old password.\n", 2);
			}
			if (!User::is_valid_hashed_password($hashed_new)) {
				throw new InvalidParamException("Fail setting password. Invalid new password.\n", 2);
			}

			// update db
			$query = 'UPDATE user SET password = :pw WHERE id_user = :id;';
			$this->_db->query($query, array(':pw' => $hashed_new, ':id' => $this->_id));
			$modified_row_count = $this->_db->rowCount();
			if ($modified_row_count !== 1) {
				throw new DatabaseException("Fail setting password. " . $modified_row_count . " rows have been modified in the database.\n");
			}
		}
		//public function set_pref_mail_notification() //ni

		/*
		** -------------------- Get --------------------
		*/
		public function get_id()
		{
			return $this->_id;
		}
		public function get_pseudo()
		{
			return $this->_pseudo;
		}
		public function get_email()
		{
			return $this->_email;
		}
		//public function get_pref_mail_notification() //ni

		/*
		** -------------------- Is valid --------------------
		*/
		public static function is_valid_email($email)
		{
			$patern = "/\A(?=[a-z0-9@.!#$%&'*+\/=?^_`{|}~-]{6,254}\z)(?=[a-z0-9.!#$%&'*+\/=?^_`{|}~-]{1,64}@)[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\z/";
			return preg_match($patern, $email) ? TRUE : FALSE;
		}
		public static function is_valid_pseudo($pseudo)
		{
			$patern = "/^[a-zA-Z0-9]{3,64}$/";
			return preg_match($patern, $pseudo) ? TRUE : FALSE;
		}
		public static function is_valid_password($password)
		{
			$patern = "/^.{8,64}$/";
			return preg_match($patern, $password) ? TRUE : FALSE;
		}
		public static function is_valid_hashed_password($password)
		{
			$patern = "/^[a-f0-9]{128}$/"; // related to hash_password()
			return preg_match($patern, $password) ? TRUE : FALSE;
		}
		public static function is_valid_id($id_cookie)
		{
			if (gettype($id_cookie) === 'integer' && $id_cookie > 0) {
				return TRUE;
			}
			if (gettype($id_cookie) === 'string' && preg_match("/^[1-9][0-9]*$/", $id_cookie)) {
				return TRUE;
			}
			return FALSE;
		}
		public static function is_email_in_use($email, $db)
		{
			if (!User::is_valid_email($email)) {
				return FALSE;
			}
			if (!Database::is_valid($db)) {
				throw new InvalidParamException("Failed running " . __METHOD__ . ". Invalid db object.\n", 2);
			}

			$query = 'SELECT id_user FROM user WHERE email = :em;';
			$db->query($query, array(':em' => $email));
			$row = $db->fetch();
			if ($row !== false) {
				return TRUE;
			}
			return FALSE;
		}
		public function is_correct_password($hashed_password)
		{
			if (!User::is_valid_hashed_password($hashed_password)) {
				throw new InvalidParamException("Fail setting password. Invalid new password.\n", 2);
			}

			$query = 'SELECT password FROM user WHERE id_user = :id;';
			$this->_db->query($query, array(':id' => $this->_id));
			$row = $this->_db->fetch();
			if ($row === false) {
				throw new DatabaseException("Fail testing password. `id_user` not found in database.\n");
			}
			if (strcmp($row['password'], $hashed_password) != 0) {
				return FALSE;
			}
			return TRUE;
		}
		public static function is_valid($user)
		{
			return gettype($user) === 'object' && get_class($user) === __CLASS__;
		}

		/*
		** -------------------- Tools --------------------
		*/
		public function link_cookie($id_cookie) {
			if (!User::is_valid_id($id_cookie)) {
				throw new InvalidParamException("Failed running " . __METHOD__ . ". Invalid id_cookie.\n", 1);
			}

			// update db
			$query = 'UPDATE cookie SET id_user = :idu WHERE id_cookie = :idc;';
			$this->_db->query($query, array(':idu' => $this->_id, ':idc' => $id_cookie));
			$modified_row_count = $this->_db->rowCount();
			if ($modified_row_count !== 1) {
				throw new DatabaseException("Fail linking cookie. " . $modified_row_count . " rows have been modified in the database.\n");
			}
		}

		/*
		** -------------------- Activities -------------------- //ni
		*/
		//public function like($picture)
		//public function comment($picture, $content, $respond_to = null)
	}
?>
