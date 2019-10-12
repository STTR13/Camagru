<?php
	include 'config/setup.php';

	class User {
		private $_id;
		private $_pseudo;
		private $_email;
		private $_db;

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
			if (!__CLASS__::is_valid_id($id_cookie)) {
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

		private function __construct3($email, $password, $db)
		{ //ni: cookie management
			// test parameters validity
			if (!__CLASS__::is_valid_email($email)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid email.\n", 31);
			}
			if (!__CLASS__::is_valid_password($password)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid password.\n", 32);
			}
			if (!Database::is_valid($db)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid db object.\n", 33);
			}

			// hashing $password
			$password = __CLASS__::hash_password($password);

			// query from database
			$query = 'SELECT id_user, pseudo FROM user WHERE email = :em AND password = :pw;';
			$db->query($query, array(':em' => $email, ':pw' => $password));
			$row = $db->fetch();
			if ($row === false) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". User-password combination not found in database.\n", 30);
			}

			// go through email account verification
			//ni

			// set object properties
			$this->_id = $row['id_user'];
			$this->_pseudo = $row['pseudo'];
			$this->_email = $email;
			$this->_db = $db;
		}

		private function __construct4($pseudo, $email, $password, $db)
		{
			// test parameters validity
			if (!__CLASS__::is_valid_pseudo($pseudo)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid pseudo.\n", 41);
			}
			if (!__CLASS__::is_valid_email($email)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid email.\n", 42);
			}
			if (!__CLASS__::is_valid_password($password)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid password.\n", 43);
			}
			if (!Database::is_valid($db)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid db object.\n", 44);
			}

			// make sure email isn't in use
			$query = 'SELECT id_user FROM user WHERE email = :em;';
			$db->query($query, array(':em' => $email));
			$row = $db->fetch();
			if ($row !== false) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Email alredy in use.\n", 45);
			}

			// hashing $password
			$password = __CLASS__::hash_password($password);

			// adding new user to database and pull the id_user
			$query = 'INSERT INTO user (pseudo, email, password) VALUES (:ps, :em, :pw;); SELECT LAST_INSERT_ID() AS `id_user`;';
			$db->query($query, array(':ps' => $pseudo, ':em' => $email, ':pw' => $password));
			$row = $db->fetch();
			if ($row === false) {
				throw new DatabaseException("Failed constructing " . __CLASS__ . ". Id not pulled from db.\n");
			}

			// set object properties
			$this->_id = $row['id_user'];
			$this->_pseudo = $pseudo;
			$this->_email = $email;
			$this->_db = $db;

			// send verification mail
			$this->send_account_verification_request();
		}


		/*
		** -------------------- Magic methods --------------------
		*/
		public function __destruct();
		public function __toString()
		{
			return get_pseudo();
		}


		/*
		** -------------------- Account verification --------------------
		*/
		public function send_account_verification_request();
		public function receive_account_verification_request($unique_key);


		/*
		** -------------------- Set --------------------
		*/
		public function set_pseudo($new)
		{
			if (!__CLASS__::is_valid_pseudo($new)) {
				throw new InvalidParamException("Failed setting pseudo. Invalid pseudo.\n");
			}

			$query = 'UPDATE user SET pseudo = :ps WHERE id_user = :id;';
			$modified_row_count = $db->exec($query, array(':ps' => $new, ':id' => $this->_id));
			if ($modified_row_count !== 1) {
				throw new DatabaseException("Fail setting pseudo. " . $modified_row_count . " rows have been modified in the database.\n");
			}

			$this->_pseudo = $new;
		}
		public function set_email($new)
		{
			if (!__CLASS__::is_valid_email($email)) {
				throw new InvalidParamException("Fail setting email. Invalid email.\n", 42);
			}

			$query = 'UPDATE user SET email = :em WHERE id_user = :id;';
			if (($modified_row_count = $db->exec($query, array(':em' => $new, ':id' => $this->_id))) !== 1) {
				throw new DatabaseException("Fail setting email. " . $modified_row_count . " rows have been modified in the database.\n");
			}

			$this->_email = $new;
		}
		public function set_password($old, $new)
		{
			if (!__CLASS__::is_valid_password($old)) {
				throw new InvalidParamException("Fail setting password. Invalid old password.\n", 1);
			}
			if (!__CLASS__::is_valid_password($new)) {
				throw new InvalidParamException("Fail setting password. Invalid new password.\n", 2);
			}

			// hashing pw
			$old = __CLASS__::hash_password($old);
			$new = __CLASS__::hash_password($new);

			// pulling old pw from db and testing if it is the same as param
			$query = 'SELECT password FROM user WHERE id_user = :id;';
			$db->query($query, array(':id' => $email));
			$row = $db->fetch();
			if ($row === false) {
				throw new DatabaseException("Fail setting password. `id_user` not found in database.\n");
			}
			if (strcmp($row['password'], $old) !== 0) {
				throw new InvalidParamException("Fail setting password. Wrong old password.\n", 1);
			}

			// update db
			$query = 'UPDATE user SET password = :pw WHERE id_user = :id;';
			if (($modified_row_count = $db->exec($query, array(':pw' => $new, ':id' => $this->_id))) !== 1) {
				throw new DatabaseException("Fail setting password. " . $modified_row_count . " rows have been modified in the database.\n");
			}
		}
		public function set_pref_mail_notification() //ni

		/*
		** -------------------- Get --------------------
		*/
		public function get_pseudo()
		{
			return $this->_pseudo;
		}
		public function get_email()
		{
			return $this->_email;
		}
		public function get_pref_mail_notification() //ni

		/*
		** -------------------- Is valid --------------------
		*/
		public static function is_valid_email($email)
		{
			$patern = "/\A(?=[a-z0-9@.!#$%&'*+\/=?^_`{|}~-]{6,254}\z)(?=[a-z0-9.!#$%&'*+\/=?^_`{|}~-]{1,64}@)[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\z/"
			return preg_match($patern, $email) ? TRUE : FALSE;
		}
		public static function is_valid_pseudo($pseudo)
		{
			$patern = "/^[a-zA-Z0-9]{6,64}$/";
			return preg_match($patern, $pseudo) ? TRUE : FALSE;
		}
		public static function is_valid_password($password)
		{
			$patern = "/(?s)^.{8,128}$/";
			return preg_match($patern, $pseudo) ? TRUE : FALSE;
		}
		private static function is_valid_id($id_cookie)
		{
			return preg_match("/^[1-9][0-9]*$/", $id_cookie) ? TRUE : FALSE;
		}

		/*
		** -------------------- Tools --------------------
		*/
		public function send_mail($content)
		private static function hash_password($password)
		{
			return $password; //ni: need real hash
		}

		/*
		** -------------------- Activities --------------------
		*/
		public function like($picture)
		public function comment($picture, $content, $respond_to = null)
	}
?>
