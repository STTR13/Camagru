<?php
	// create a cookie wich values is an cookie.id_cookie extracted from the database
	public function new_id_cookie($db, string $cookie_name, string $domain, int $expires = time() + (60 * 60 * 24 * 30 * 6), string $path = "/", bool $secure = FALSE)
	{
		if (!Database::is_valid($db)) {
			throw new InvalidParamException("Failed running " . __FUNCTION__ . ". Invalid db object.\n", 1);
		}

		$query = 'INSERT INTO cookie () VALUES (); SELECT LAST_INSERT_ID() AS `id_cookie`;';
		$db->query($query, array());
		$row = $db->fetch();
		if ($row === false) {
			throw new DatabaseException("Failed running " . __FUNCTION__ . ". id_cookie not pulled from db.\n");
		}

		// setcookie and error management
		if (!setcookie($cookie_name, $row['id_cookie'], $expires, $path, $domain, $secure)) {
			$query = 'DELETE FROM cookie WHERE id_cookie = :id;';
			$modified_row_count = $db->exec($query, array(':id' => $row['id_cookie']));
			if ($modified_row_count !== 1) {
				throw new DatabaseException("Failed deleting cookie from db after failing to create it on the client side. ". $modified_row_count . " rows have been modified in the database on delete command.\n");
			}

			throw new CookieException("Failed running " . __FUNCTION__ . ". setcookie() failed. The corresponding cookie row in database has been successfully deleted\n");
		}
	}
?>
