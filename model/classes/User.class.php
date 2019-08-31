<?php
	include 'config/setup.php';

	class User {
		private $_id;
		private $_pseudo;
		private $_email;
		private $_logged;
		private $_db;

		/*
		** -------------------- Construct --------------------
		*/
		public function __construct()
		{
			$a = func_get_args();
	        $i = func_num_args();
	        if (method_exists($this,$f='__construct'.$i)) {
	            call_user_func_array(array($this,$f),$a);
	        }
			else {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Wrong amount of parameters ($i).\n", 2);
			}
		}

		private static function hash_password($password)
		{
			return $password; //ni: need real hash
		}

		private function __construct2($id, $db)
		{
			// test parameters validity
			if (!__CLASS__::is_valid_id($id) || !Database::is_valid($db)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Parameter has invalid content.\n", 2);
			}

			// query from database
			$query = "SELECT pseudo, email FROM user WHERE id_user = :id;";
			if ($db->query($query, array(':id' => $id))) {
				$row = $db->fetch();
			}
			if (!isset($row)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Id not found in database.\n", 1);
			}

			// set object properties
			$this->_id = $id;
			$this->_pseudo = $row['pseudo'];
			$this->_email = $row['email'];
			$this->_logged = FALSE;
			$this->_db = $db;
		}

		private function __construct3($email, $password, $db)
		{ //ni: cookie management
			// test parameters validity
			if (!__CLASS__::is_valid_email($email) || !__CLASS__::is_valid_password($password) || !Database::is_valid($db)) {
				//ni: need more clarity on the reasons the parameters are wrong
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". At least one parameter have invalid content.\n", 1);
			}

			// hashing $password
			$password = __CLASS__::hash_password($password);

			// query from database
			$query = 'SELECT id_user, pseudo FROM user WHERE email = :em AND password = :pw;';
			if ($db->query($query, array(':em' => $email, ':pw' => $password))) {
				$row = $db->fetch();
			}
			if (!isset($row)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Id not found in database.\n", 1);
			}

			// go through email account verification
			//ni

			// set object properties
			$this->_id = $row['id_user'];
			$this->_pseudo = $row['pseudo'];
			$this->_email = $email;
			$this->_logged = TRUE;
			$this->_db = $db;
		}

		private function __construct4($pseudo, $email, $password, $db)
		{
			// test parameters validity
			if (!__CLASS__::is_valid_pseudo($pseudo) ||
				!__CLASS__::is_valid_email($email) ||
				!__CLASS__::is_valid_password($password) ||
				!Database::is_valid($db)) {
				//ni: need more clarity on witch parameters are wrong
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". At least one parameter have invalid content.\n", 1);
			}

			// make sure email isn't in use
			$query = 'SELECT id_user FROM user WHERE email = :em;';
			if ($db->query($query, array(':em' => $email))) {
				$row = $db->fetch();
			}
			if (!isset($row)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ".\n", 1);
			}
			if (array_key_exists('id_user', $row)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Email alredy in use.\n", 2);
			}

			// hashing $password
			$password = __CLASS__::hash_password($password);

			// adding new user to database and pull the id_user
			$query = 'INSERT INTO user (pseudo, email, password) VALUES (:ps, :em, :pw;); SELECT LAST_INSERT_ID() AS `id_user`;';
			if ($db->query($query, array(':ps' => $pseudo, ':em' => $email, ':pw' => $password))) {
				$row = $db->fetch();
			}
			if (!isset($row)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ".\n", 1);
			}

			// set object properties
			$this->_id = $row['id_user'];
			$this->_pseudo = $pseudo;
			$this->_email = $email;
			$this->_logged = TRUE;
			$this->_db = $db;
		}


		/*
		** -------------------- Magic methods --------------------
		*/
		public function __destruct()
		public function __toString()
		{
			return get_pseudo();
		}


		/*
		** -------------------- Account verification --------------------
		*/
		public function send_account_verification_request()
		public function receive_account_verification_request($unique_key)


		/*
		** -------------------- Set and get --------------------
		*/
		public function set_pseudo($new)
		public function set_email($new)
		public function set_password($old, $new, $confirm)
		public function set_pref_mail_notification()

		public function get_id()
		public function get_pseudo()
		public function get_email()
		public function get_pref_mail_notification()


		/*
		** -------------------- Tools --------------------
		*/
		public function send_mail($content)
		public static function is_valid_email($email)
		{
			$patern = "/\A(?=[a-z0-9@.!#$%&'*+\/=?^_`{|}~-]{6,254}\z)(?=[a-z0-9.!#$%&'*+\/=?^_`{|}~-]{1,64}@)[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\z/"
			return preg_match($patern, $email) ? TRUE : FALSE;
		}
		public static function is_valid_pseudo($pseudo)
		public static function is_valid_password($password)
		public static function is_valid_id($id)
		{
			return preg_match("/^[1-9][0-9]*$/", $id);
		}
	}
?>
