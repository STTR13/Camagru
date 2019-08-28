<?php
	class Database {
		private $_db;

		public function __construct($dsn, $username, $password)
		{
			try {
			    $this->_db = new PDO($dsn, $username, $password, array(PDO::ATTR_PERSISTENT => TRUE));
			} catch(PDOException $e) {
				//ni: pop a neeter error page
				//ni: try to setup a new db by copying one on an other server
				//ni: send report to main log
			    exit('Could not connect to mysql: '.$e);
			}
		}

		public function __destruct() {
			$this->_db = null;
		}

		public function query($query, $bindValues)
		{
			// prepare
			try {
				$statement = $this->_db->prepare($query);
			} catch (PDOException $e) {
				return FALSE; //ni: bether exception handeling
			}

			// bind values
			foreach ($bindValues as $key => $value) {
				if ($statement->bindValue(":$key", $value) === FALSE) {
					return FALSE;
				}
			}

			// execute statement and return
			if ($statement->execute() === FALSE) {
				return FALSE;
			}
			return $statement;
		}

		public function exec($sql)
		{
			return $this->_db->exec($sql);
		}
	}
?>
