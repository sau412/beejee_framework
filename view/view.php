<?php

class view {
	public function __construct() {
	}

	public function view_from_template($page_name, $data_for_view = null) {
		echo "view_from_template($page_name, $data_for_view);\n";
		if(!is_null($data_for_view)) {
			foreach($data_for_view as $key => $value) {
				$$key = $value;
			}
		}
		echo "Show template $page_name\n";
		include "../templates/".$page_name.".php";
	}
}
?>
