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
		
	$nr_zlecenia = $_POST['id'];
	$zapytanie = mysqli_query($polaczenie, "UPDATE zlecenia SET status='W trakcie' WHERE id='$nr_zlecenia'");
	
	header('Location: ../zlecenia_pracownikow.php');
	}
	
	
	
?>