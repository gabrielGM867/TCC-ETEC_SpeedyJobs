<?php
include('connect.php');
if(isset($_POST['ler'])){
	
	$online = (int)$_POST['online'];
	$user = (int)$_POST['user'];

	$upd = mysqli_query($con, "UPDATE `tbmensagens` SET `lido` = 1 WHERE id_de = '$user' AND id_para = '$online'");

	if($upd){
		echo 'ok';
	}else{
		echo 'error';
	}
}
?>