<?php
	require_once "../functions/verbose.php";
	require_once "../exceptions/DatabaseException.class.php";

	class Database {
		private $_db;
		private $_statement;

		public function __construct($dsn, $username, $password)
		{
			verbose("Database::__construct(" . $dsn . ", " . $username . ", " . $password . ")");

			try {
			    $this->_db = new PDO(
					$dsn,
					$username,
					$password,
					array(PDO::ATTR_PERSISTENT => TRUE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
				);
			} catch(PDOException $e) {
				throw new DatabaseException("Failed constructing " . __CLASS__ . ". PDO instanciation failed:\n" . $e->getMessage());
			}
		}

		public function __destruct()
		{
			verbose("Database::__destruct()");

			$this->_db = null;
		}

		public function query($query, $bindValues)
		{
			verbose("Database::query(" . $query . ", bv_array)\nbv_array: " . json_encode($bindValues) . "\n");

			// prepare
			try {
				$this->_statement = $this->_db->prepare($query);
			} catch (PDOException $e) {
				throw new DatabaseException("Failed querying " . __CLASS__ . ". Invalid query:\n" . $e->getMessage());
			}

			// bind values
			foreach ($bindValues as $key => $value) {
				if ($this->_statement->bindValue($key, $value) === FALSE) {
					throw new DatabaseException("Failed querying " . __CLASS__ . ". Invalid bindValue(s):\n" . $e->getMessage());
				}
			}
			// execute statement and return
			if ($this->_statement->execute() === FALSE) {
				throw new DatabaseException("Failed querying " . __CLASS__ . ". Execution failed:\n" . $e->getMessage());
			}
		}

		public function exec($sql)
		{
			verbose("Database::exec(" . $sql . ")\n");

			return rverbose($this->_db->exec($sql));
		}

		public function fetch()
		{
			return $this->_statement->fetch(PDO::FETCH_ASSOC);
		}

		public static function is_valid(Database $db)
		{
			return gettype($db) === 'object' && get_class($db) === __CLASS__ && $db->_db != null;
		}
	}
?>
