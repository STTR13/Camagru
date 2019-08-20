<?php
	class User {
		private $_id;
		private $_pseudo;
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
		set_pseudo($new)
		set_email($new)
		set_password($old, $new, $confirm)
		set_pref_mail_notification()

		get_id()
		get_pseudo()
		get_email()
		get_pref_mail_notification()
	}
?>
