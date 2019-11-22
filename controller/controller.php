<?php
// Контроллер
class controller {
	public $redirect_to = NULL;
	public $content = "";

	// Конструктор
	// По заданному URI возвращает страницу
	public function __construct($uri) {
		echo "URI: $uri\n";
		$routing_rules=settings::$routing_rules;
		foreach(settings::$routing_rules as $rule) {
			$regexp = $rule['regexp'];
			$controller = $rule['controller'];
			if(preg_match($regexp,$uri,$matches)) {
				echo "Using controller $controller\n";
				$page = call_user_func_array(array($this,$controller),$matches);
				break;
			}
		}
		echo "Done!\n";
	}

	// Вызов метода
	public function __call($func_name, $args) {
		var_dump("Call unknown func",$func_name,$args);
	}

	// Контроллер просмотра задач
	public function tasks_list($uri) {
		echo "Called controller: tasks_list\n";
		$view = new view();
		$form_data['action'] = "add";
		$view->view_from_template("tasks_add", $form_data);
	}

	// Контроллер добавления задачи
	public function tasks_add($uri) {
		echo "Called controller: tasks_add\n";
		if(isset($_POST) && count($_POST)>0) {
			$form_data = array_map("stripslashes",$_POST);
			$model = new task();
			$model->load_from_user_form($form_data);
			$model->insert();
			$this->redirect_to = "list";
		} else {
			$view = new view();
			$form_data['action'] = "add";
			$view->view_from_template("tasks_add", $form_data);
		}
	}
}
?>
