<?php
$folders_to_load_array=array("common","model","view","controller");

foreach($folders_to_load_array as $folder) {
	loader($folder);
}

function loader($folder) {
	$prefix="..";
	$files_array=scandir("$prefix/$folder");
	//var_dump($files);
	foreach($files_array as $filename) {
		// Не загружать файлы, начинающиеся с точки
		if(preg_match('/^\\./',$filename)) continue;
		// Загружать только файлы, оканчивающиеся на .php
		if(!preg_match('/.php$/',$filename)) continue;

		require_once("$prefix/$folder/$filename");
	}
}
?>
