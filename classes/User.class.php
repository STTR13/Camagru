<?php
	class User {
		private $_id;
		private $_pseudo;
		private $_email;
		private $_logged;

		/*
		** -------------------- Special functions --------------------
		*/

		/*

		** either:
		$kwargs = array(email => "...", password => "...")
""		to pull a user from the database

		** or:
		$kwargs = array(pseudo => "...", password => "...", confirm_pw => "...", email => "...")
		to create a new user

		*/
		public function __construct($kwargs)
		public function __destruct()
		public function __toString() {
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
	}
?>
