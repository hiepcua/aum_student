<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
LogOut(getInfo('user'));
echo '<script language="javascript">window.location="index.php"</script>';
?>