<?php
 
 include "dbconfig.php";

	$category = $_POST['category'];
	$name = $_POST['name'];

$sql = mq("insert into member (category,name) values('".$category."','".$name."','".$username."','".$adress."','".$sex."','".$email."')");

?>
<meta charset="utf-8" />
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=/">