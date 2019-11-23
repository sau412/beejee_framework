<?php
$db_connection = db::get_instance();

echo "Page $page of $pages\n";
echo "ORDER BY $order LIMIT $limit OFFSET $offset\n";
flush();
$statement = $this->db_resource->prepare($query);
if($statement !== FALSE) {
	$statement->bind_param("sii",$order,$limit,$offset);
	$statement->execute();
	$statement->bind_result(
		$id,
		$username,
		$email,
		$description,
		$status,
		$edited_by_admin
	);
	$statement->fetch();
}


?>
