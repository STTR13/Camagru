<?php
	class Picture {
		private $_id;
		private $_path;
		private $_filter_path;
		private $_date;

		/*
		** -------------------- Special functions --------------------
		*/

		/*

		** either:
		$kwargs = array(id => ...)
		to pull the image from the database

		** or:
		$kwargs = array(path => "...", filter_path => "...")
		to add a picture to the database

		*/
		public function __construct($kwargs)
		public function __destruct()
		public function __toString()


		/*
		** -------------------- gets --------------------
		*/
		public function get_id()
		public function get_path()
		public function get_filter_path()
		public function get_date()
		public function get_next_picture()
		// output format: array(<<id_comment>> => array("c" => <<content>>, <<id_response>> => array(...
		public function get_comments()
	}
?>
