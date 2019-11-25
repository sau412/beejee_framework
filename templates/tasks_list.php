<?php
$records_array = $model->get_records();
$total_pages = $model->get_pages_count();
$order = $model->get_sorting_order();
$current_page = $model->get_current_page();

echo "<p>[<a href='/index.php/add'>Add new record</a>]</p>\n";

echo "Page: ";

for($page_index = 1; $page_index <= $total_pages; $page_index++) {
	$url = "/index.php/list/$order/$page_index";
	if($page_index == $current_page) {
		echo "[<b>$page_index</b>] ";
	} else {
		echo "[<a href='$url'>$page_index</a>] ";
	}
}

$url = "/index.php/list";
echo <<<_END
<table border=1>
<tr>
<th><a href='$url/id'>Id</a></th>
<th><a href='$url/username'>Username</a></th>
<th><a href='$url/email'>E-mail</a></th>
<th><a href='$url/description'>Description</a></th>
<th>Status</th>
</tr>
_END;

foreach($records_array as $record) {
	$id = $record['id'];
	$username = $record['username'];
	$email = $record['email'];
	$description = $record['description'];
	$status = $record['status'];
	$edited_by_admin = $record['edited_by_admin'];

	$id_html = htmlspecialchars($id);
	$username_html = htmlspecialchars($username);
	$email_html = htmlspecialchars($email);
	$description_html = str_replace("\n","<br>\n",htmlspecialchars($description));
	if($status == 0 && $edited_by_admin == 0) $status_html = "New";
	else if($status == 1) $status_html = "Completed";
	else $status_html = "Edited by Admin";
	//$status_html = htmlspecialchars($status);
	//$edited_by_admin_html = htmlspecialchars($edited_by_admin);

	echo "<tr><td>$id_html</td><td>$username_html</td><td>$email_html</td><td>$description_html</td><td>$status_html</td></tr>\n";
}
echo "</table>\n";
?>
