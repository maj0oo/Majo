<?php	
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: ../index.php');
		exit();
	}
	
		require_once "../connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	
	else{
		
		$id = $_POST['id'];
		$zapytanie = mysqli_query($polaczenie, "DELETE FROM `zlecenia` WHERE `zlecenia`.`id` = '$id';");
	
	header('Location: ../zlecenia_pracownikow.php');
	}