<?php
	class Picture {
		private $_id;
		private $_user_id;
		private $_user_pseudo;
		private $_path;
		private $_date;
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

		private function __construct2($id_picture, $db)
		{
			if (!User::is_valid_id($id_picture)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid id.\n", 21);
			}
			if (!Database::is_valid($db)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid db object.\n", 22);
			}

			// query from database
			$query = "SELECT picture.id_picture, picture.path, picture.date, user.id_user, user.pseudo FROM user JOIN picture ON picture.id_user = user.id_user WHERE id_picture = :idp;";
			$db->query($query, array(':idp' => $id_picture));
			$row = $db->fetch();
			if ($row === false) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". id_picture not found in database.\n", 20);
			}

			// set object properties
			$this->_id = $row['id_picture'];
			$this->_user_id = $row['id_user'];
			$this->_user_pseudo = $row['pseudo'];
			$this->_path = $row['path'];
			$this->_date = $row['date'];
			$this->_db = $db;
		}

		private function __construct3($path, $user, $db)
		{
			// test parameters validity
			if (!Picture::is_valid_path($path)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid path.\n", 41);
			}
			if (!User::is_valid($user)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid user.\n", 42);
			}
			if (!Database::is_valid($db)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid db object.\n", 43);
			}

			// adding new user to database and pull the id_user
			$query = 'INSERT INTO picture (id_user, `path`) VALUES (:idu, :p);';
			$db->query($query, array(':idu' => $user->get_id(), ':p' => $path));
			$query = 'SELECT LAST_INSERT_ID() AS `id_picture`, `id_user`, `date`;';
			$db->query($query, array());
			$row = $db->fetch();
			if ($row === false) {
				throw new DatabaseException("Failed constructing " . __CLASS__ . ". Id not pulled from db.\n");
			}

			// set object properties
			$this->_id = $row['id_picture'];
			$this->_user_id = $row['id_user'];
			$this->_user_pseudo = $row['pseudo'];
			$this->_path = $path;
			$this->_date = $row['date'];
			$this->_db = $db;
		}


		/*
		** -------------------- Special functions --------------------
		*/

		public function __destruct()
		{
			$this->_id = null;
			$this->_user_id = null;
			$this->_user_pseudo = null;
			$this->_path = null;
			$this->_date = null;
			$this->_db = null;
		}
		public function __toString()
		{
			return $this->_path;
		}


		/*
		** -------------------- gets --------------------
		*/
		public function get_id()
		{
			return $this->_id;
		}
		public function get_user_id()
		{
			return $this->_user_id;
		}
		public function get_user_pseudo()
		{
			return $this->_user_pseudo;
		}
		public function get_path()
		{
			return $this->_path;
		}
		public function get_date()
		{
			return $this->_date;
		}
		public function get_next_picture()
		// output format: array(<<id_comment>> => array("c" => <<content>>, <<id_response>> => array(...
		//public function get_comments() //ni
	}
?>
