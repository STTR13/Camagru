<?php
	//require_once "verbose.php";

	class Database {
		private $_db;
		private $_statement;

		public function __construct($dsn, $username, $password)
		{
			try {
			    $this->_db = new PDO(
					$dsn,
					$username,
					$password,
					array(PDO::ATTR_PERSISTENT => TRUE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
				);
			} catch(PDOException $e) {
				//ni: pop a neeter error page
				//ni: try to setup a new db by copying one on an other server
				//ni: send report to main log
				exit($e);
			}
		}

		public function __destruct() {
			$this->_db = null;
		}

		public function query($query, $bindValues)
		{
			// prepare
			try {
				$this->_statement = $this->_db->prepare($query);
			} catch (PDOException $e) {
				//verbose("Invalid query.\n");
				return FALSE; //ni: bether exception handeling
			}

			// bind values
			foreach ($bindValues as $key => $value) {
				if ($this->_statement->bindValue($key, $value) === FALSE) {
					//verbose("Incorect bindValues.\n");
					return FALSE;
				}
			}
			// execute statement and return
			if ($this->_statement->execute() === FALSE) {
				//verbose("Execution error.\n");
				return FALSE;
			}
			return TRUE;
		}

		public function exec($sql)
		{
			return $this->_db->exec($sql);
		}

		public function fetch()
		{
			return $this->_statement->fetch(PDO::FETCH_ASSOC);
		}

		public static function is_valid()
		{
			return true; //ni
		}
	}
?>
