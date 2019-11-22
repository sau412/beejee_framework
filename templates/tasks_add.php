<?php
// Форма добавления записи
$username_html = htmlspecialchars($username);
$email_html = htmlspecialchars($email);
$description_html = htmlspecialchars($description);
//var_dump($GLOBALS);

echo <<<_END
<form method=post>
<input type=hidden name=action value='$action'>
<p>Username: <input type=text name=username value='$username_html'></p>
<p>E-mail: <input type=text name=email value='$email_html'></p>
<p>Task description:</p>
<p><textarea name=description>$description_html</textarea></p>
<p><input type=submit value='Submit'></p>
</form>

_END;
?>
