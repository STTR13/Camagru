<?php
	include 'config/setup.php';

	class User {
		private $_id;
		private $_pseudo;
		private $_email;
		private $_logged;

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

		/*
		$columns is a string listing the output needed
		$where is an array(culumn=>value_needed)
		*/
		private static function query_user($columns, $where)
		{
			// form query
			$query = "SELECT $columns FROM user WHERE";
			foreach ($where as $key => $value) {
				$qwery .= " $key = :$key";
			}
			$qwery .= ';';

			// prepare
			try {
				$statement = $db->prepare($query);
			} catch (PDOException $e) {
				return FALSE; //ni: bether exception handeling
			}

			// bind values
			foreach ($where as $key => $value) {
				if ($statement->bindValue(":$key", $value) === FALSE) {
					return FALSE;
				}
			}

			// execute statement and return
			if ($statement->execute() === FALSE) {
				return FALSE;
			}
			return $statement->fetch(PDO::FECH_ASSOC);
		}

		/*\
		$content = array(<<column>> => <<value>>)
		*/
		private static function insert_user($content)
		{
			// form query
			$columns = '';
			$values = '';
			foreach ($content as $key => $value) {
				$columns .= "$key, ";
				$values .= ":$key, ";
			}
			$query = 'INSERT INTO user (';
			$query .= rtrim($columns, ', ');
			$query .= ') VALUES (';
			$query .= rtrim($values, ', ');
			$query .= '); SELECT LAST_INSERT_ID() AS `id_user`';

			// prepare
			try {
				$statement = $db->prepare($query);
			} catch (PDOException $e) {
				return FALSE; //ni: bether exception handeling
			}

			// bind values
			foreach ($content as $key => $value) {
				if ($statement->bindValue(":$key", $value) === FALSE) {
					return FALSE;
				}
			}

			// execute statement and return
			if ($statement->execute() === FALSE) {
				return FALSE;
			}
			return $statement->fetch(PDO::FECH_ASSOC);
		}

		private static function hash_password($password) //ni

		private function __construct1($id)
		{
			// test parameters validity
			if (!__CLASS__::is_valid_id($id)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Parameter has invalid content.\n", 2);
			}

			// query from database
			$row = __CLASS__::query_user('pseudo, email', array('id_user' => $id));
			if (!array_key_exists('pseudo', $row) || !array_key_exists('email', $row)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Id not found in database.\n", 1);
			}

			// set object properties
			$this->_id = $id;
			$this->_pseudo = $row['pseudo'];
			$this->_email = $row['email'];
			$this->_logged = FALSE;
		}

		private function __construct2($email, $password)
		{ //ni: cookie management
			// test parameters validity
			if (!__CLASS__::is_valid_email($email) || !__CLASS__::is_valid_password($password)) {
				//ni: need more clarity on the reasons the parameters are wrong
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". At least one parameter have invalid content.\n", 1);
			}

			// hashing $password
			$password = __CLASS__::hash_password($password);

			// query from database
			$row = __CLASS__::query_user('id_user, pseudo', array('email' => $email, 'password' => $password));
			if (!array_key_exists('id_user', $row) || !array_key_exists('pseudo', $row)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Id not found in database.\n", 1);
			}

			// set object properties
			$this->_id = $row['id_user'];
			$this->_pseudo = $row['pseudo'];
			$this->_email = $email;
			$this->_logged = TRUE;
		}

		private function __construct4($pseudo, $email, $password, $confirm_pw)
		{
			// test parameters validity
			if (strcmp($password, $confirm_pw) !== 0 ||
				!__CLASS__::is_valid_pseudo($pseudo) ||
				!__CLASS__::is_valid_email($email) ||
				!__CLASS__::is_valid_password($password)) {
				//ni: need more clarity on witch parameters are wrong
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". At least one parameter have invalid content.\n", 1);
			}

			// make sure email isn't in use
			//ni

			// hashing $password
			$password = __CLASS__::hash_password($password);

			// adding new user to database and pull the id_user
			$row = insert_user(array('pseudo' => $pseudo, 'email' => $email, 'password' => $password));
			if ($row === FALSE){
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Id not found in database.\n", 1);
			}

			// set object properties
			$this->_id = $row['id_user'];
			$this->_pseudo = $pseudo;
			$this->_email = $email;
			$this->_logged = TRUE;
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
