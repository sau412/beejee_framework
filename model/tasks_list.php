<?php

class task_list {
	// Ресурс для доступа к БД
	private $db_resource;

	// Параметры списка задач
	// Текущая страницв
	private $current_page = 1;
	// Общее число страниц
	private $total_pages;
	// Общее число записей
	private $total_records;

	// По какому полю будет сортировка
	private $order_by = "id";

	// Записи из БД
	private $records = array();

	// Конструктор, просто записывает класс для доступа к БД
	// И получает количество записей
	public function __construct () {
		$this->db_resource = db::get_instance();

		$query = "SELECT count(*) FROM `tasks`";
		$statement = $this->db_resource->prepare($query);
		if($statement !== FALSE) {
			$statement->execute();
			$statement->bind_result($total_records);
			$statement->fetch();
			$this->total_records = $total_records;
		}
		$this->total_pages = ceil($this->total_records / settings::$records_per_page);
	}

	// Получить число страниц
	public function get_pages_count() {
		return $this->total_pages;
	}

	// Получить порядок сортировки
	public function get_sorting_order() {
		return $this->order_by;
	}

	// Получить записи
	public function get_records() {
		return $this->records;
	}

	// Получить текущую страницу
	public function get_current_page() {
		return $this->current_page;
	}

	// Установить текущую страницу
	public function set_current_page($index) {
		// Валидация
		// Если индекс слишком мал, считаем его равным нижней границе
		if($index < 1) $index = 1;
		// Если слишком велик - верхней
		else if($index > $this->total_pages) $index = $this->total_pages;

		$this->current_page = $index;
	}

	// Установить сортировку
	public function set_sorting_order($field) {
		// Валидация
		if(in_array($field,array("id","username","email","description","status","edited_by_admin"))) {
			$this->order_by = $field;
		}
	}

	// Получение записи из БД по номеру страницы
	public function load() {
		$order = $this->order_by;
		$query = "SELECT `id`, `username`, `email`, `description`, `status`, `edited_by_admin`
				FROM `tasks` ORDER BY `$order` LIMIT ? OFFSET ?";
		$statement = $this->db_resource->prepare($query);
		if($statement !== FALSE) {
			$limit = settings::$records_per_page;
			$offset = ($this->current_page - 1) * settings::$records_per_page;
			$statement->bind_param("ii",$limit,$offset);
			$statement->execute();
			$statement->bind_result($id,$username,$email,$description,$status,$edited_by_admin);
			while ($statement->fetch()) {
				$this->records[] = array(
					"id"=>$id,
					"username"=>$username,
					"email"=>$email,
					"description"=>$description,
					"status"=>$status,
					"edited_by_admin"=>$edited_by_admin,
				);
			}
			//var_dump($this->records);
		} else {
			throw new Exception("Error loading record from database");
		}
	}
}

?>
