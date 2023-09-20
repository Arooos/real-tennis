<?php
	require "../../app/connection/tennis_cnf.php";
	session_start();
	$login = $_POST['login'];
	$password = $_POST['password'];
	$sql = $db -> prepare("SELECT id,login FROM admin WHERE login=:login AND password=:password");
	$sql -> execute(array('login' => $login, 'password' => $password));
	$array=$sql -> fetch(PDO::FETCH_ASSOC);
	if($array["id"]>0){
		$_SESSION['login']=$array["login"];
		header('Location:/admin/tennis/adminpanel.php');
	}
	else{
		header('Location:/admin/tennis/adminlogin.html');
	}
?>

