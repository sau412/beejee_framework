<?php
// Класс с настройками
// Singleton
class settings {
	// Настройки базы данных
	public static $db_host="localhost";
	public static $db_name="task_manager";
	public static $db_login="task_manager";
	public static $db_password="fVJFWI8NcGFsUwlc";

	// Настройки учётной записи администратора
	public static $admin_login="admin";
	public static $admin_pass="123";

	// Настройки роутинга
	public static $routing_rules = array(
		array("regexp"=>'/\\/view\\/([0-9]+)$/', "controller"=>"tasks_view"),
		array("regexp"=>'/\\/edit\\/([0-9]+)$/', "controller"=>"tasks_edit"),
		array("regexp"=>'/\\/add$/', "controller"=>"tasks_add"),
		array("regexp"=>'/\\/list$/', "controller"=>"tasks_list"),
	);
}
?>
