<?php
	class Session {
		private $_id;
		private $_u;
		private $_login_tryes;

		/*
		** -------------------- Special functions --------------------
		*/
		public function __construct()
		public function __destruct()

		/*
		** -------------------- Account verification --------------------
		*/
		public function log_in($email, $password)
		public function sign_in($pseudo, $password, $confirm_pw, $email)
		public function log_off()

		/*
		** -------------------- Activities --------------------
		*/
		public function like($picture)
		public function comment($picture, $content, $respond_to)

		/*
		** -------------------- gets --------------------
		*/
		public function get_id()
		public function get_u()
		public function get_login_tryes()
	}
?>
