<?php
// Работа с БД
// Singleton
class db {
	private static $db_resource = null;

	public function get_instance () {
		if(is_null(db::$db_resource)) {
			db::$db_resource = new mysqli(
				settings::$db_host,
				settings::$db_login,
				settings::$db_password,
				settings::$db_name
			);
		}
		return db::$db_resource;
	}
}

?>
