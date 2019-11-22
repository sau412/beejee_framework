<?php

class task {
	// Ресурс для достпа к БД
	private $db_resource;

	// Параметры задачи
	private $id = null;
	private $username;
	private $email;
	private $description;
	private $status;
	private $edited_by_admin;

	// Конструктор, просто записывает класс для доступа к БД
	public function __construct () {
		$this->db_resource = db::get_instance();
	}

	// Получение записи из БД по идентификатору
	public function load($id) {
		$query = "SELECT `id`, `username`, `email`, `description`, `status`, `edited_by_admin`
				FROM `tasks` WHERE `id`=?";
		$statement = $this->db_resource->prepare($query);
		if($statement !== FALSE) {
			$statement->bind_param("i",$id);
			$statement->execute();
			$statement->bind_result(
				$this->id,
				$this->username,
				$this->email,
				$this->description,
				$this->status,
				$this->edited_by_admin
			);
			$statement->fetch();
		} else {
			throw new Exception("Error loading record from database");
		}
	}

	// Добавление записи в БД
	public function insert() {
		$query = "INSERT INTO `tasks` (`username`,`email`,`description`,`status`,`edited_by_admin`)
				VALUES (?,?,?,?,?)";
		$statement = $this->db_resource->prepare($query);
		if($statement !== FALSE) {
			$statement->bind_param(
				"sssii",
				$this->username,
				$this->email,
				$this->description,
				$this->status,
				$this->edited_by_admin
			);
			$statement->execute();
		} else {
			throw new Exception("Error inserting record into database");
		}
	}

	// Обновление записи в БД
	public function update() {
		$query = "UPDATE `tasks`
				SET `username`=?,`email`=?,`description`=?,`status`=?,`edited_by_admin`=?
				WHERE `id`=?";
		$statement = $this->db_resource->prepare($query);
		if($statement !== FALSE) {
			$statement->bind_param(
				"sssiii",
				$this->username,
				$this->email,
				$this->description,
				$this->status,
				$this->edited_by_admin,
				$this->id
			);
			$statement->execute();
		} else {
			throw new Exception("Error updating record in database");
		}
	}

	// Получение записи из формы пользователя
	public function load_from_user_form($user_form) {
		$this->username = $user_form['username'];
		$this->email = $user_form['email'];
		$this->description = $user_form['description'];
		$this->status = 0;
		$this->edited_by_admin = 0;
	}

	// Получение изменённой записи из формы администратора
	public function load_from_admin_form($admin_form) {
		$id = $admin_form['id'];
		$this->load($id);
		$this->edited_by_admin = 1;
		$this->status = $admin_form['status'];
		$this->description = $admin_from['description'];
	}
}

?>
