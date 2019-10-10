<?php
	class Cookie {
		private $_id;
		private $_db;
		private static const $id_cookie_name = 'insto_id_cookie';
		private static const $domain = 'localhost:8080';

		/*
		** -------------------- Special functions --------------------
		*/

		public function __construct($db)
		{
			if (!Database::is_valid($db)) {
				throw new InvalidParamException("Failed constructing " . __CLASS__ . ". Invalid db object.\n", 1);
			}

			if (!array_key_exists($id_cookie_name, $_COOKIE)) {
				// add cookie to db and pull id
				$query = 'INSERT INTO cookie () VALUES (); SELECT LAST_INSERT_ID() AS `id_cookie`;';
				$db->query($query, array(':ps' => $pseudo, ':em' => $email, ':pw' => $password));
				$row = $db->fetch();
				if ($row === false) {
					throw new DatabaseException("Failed constructing " . __CLASS__ . ". Id not pulled from db.\n");
				}

				// setcookie and error management
				if (!setcookie($id_cookie_name, $row['id_cookie'], time() + (60 * 60 * 24 * 30 * 6), '/', Cookie::$domain)) {
					$query = 'DELETE FROM cookie WHERE id_cookie = :id;';
					$modified_row_count = $db->exec($query, array(':id' => $row['id_cookie']));
					if ($modified_row_count !== 1) {
						throw new DatabaseException("Failed deleting cookie from db. ". $modified_row_count . " rows have been modified in the database.\n");
					}

					throw new CookieException("Failed constructing " . __CLASS__ . ". setcookie() failed.\n");
				}
			}

			// setting parameters
			$this->_id = $_COOKIE[$id_cookie_name];
			$this->_db = $db;
		}
		public function __destruct()
		{
			$this->_id = null;
			$this->_db = null;
		}
	}
?>
