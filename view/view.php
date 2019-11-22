<?php

class view {
	public function __construct() {
	}

	public function view_from_template($page_name, $model = null) {
		if(!is_null($model)) {
			foreach($model as $key => $value) {
				$$key = $value;
			}
		}
		require("../templates/".$page_name.".php");
	}
}
?>
