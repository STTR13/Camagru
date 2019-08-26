<?php
	include 'config/setup.php';

	class User {
		private $_id;
		private $_pseudo;
		private $_email;
		private $_logged;

		/*
		** -------------------- Special functions --------------------
		*/
		public function __construct()
		{
			$a = func_get_args();
	        $i = func_num_args();
	        if (method_exists($this,$f='__construct'.$i)) {
	            call_user_func_array(array($this,$f),$a);
	        } else {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Wrong amount of parameters ($i).\n", 2);
			}
		}
		private function __construct2($email, $password) {
			$query = 'SELECT id_user, pseudo FROM user WHERE email = :em AND password = :pw';
			try {
				if ($statement = $db->prepare($query) === FALSE ||
					$statement->bindValue(':em', $email) === FALSE ||
					$statement->bindValue(':pw', $password) === FALSE ||
					$statement->execute() === FALSE ||
					($row = $statement->fetch(PDO::FECH_ASSOC)) === FALSE) {

				}
			} catch (PDOException $e) {
				exit($e); //ni: bether exception handeling
			}
			if (($this->_id = $row['id_user']) == null ||
				($this->_pseudo = $row['pseudo']) == null) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Email-password pair not found in database.\n", 1);
			}
			return $row;
		}
		public function __destruct()
		public function __toString() {return get_pseudo();}


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
	}
?>
