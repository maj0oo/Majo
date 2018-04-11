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
		
		$zdjecie1 = $_FILES['upload']['name'];
		$zdjecie1_tmp = $_FILES['upload']['tmp_name'];
		$zdjecie2 = $_FILES['upload2']['name'];
		$zdjecie2_tmp = $_FILES['upload2']['tmp_name'];
		$zdjecie3 = $_FILES['upload3']['name'];
		$zdjecie3_tmp = $_FILES['upload3']['tmp_name'];
		$opis = $_POST['opis'];
		$nr_zlecenia = $_POST['id'];
		
		$location1 = "../files/$zdjecie1";
		$location2 = "../files/$zdjecie2";
		$location3 = "../files/$zdjecie3";
		
		move_uploaded_file($zdjecie1_tmp, $location1);
		move_uploaded_file($zdjecie2_tmp, $location2);
		move_uploaded_file($zdjecie3_tmp, $location3);
			
		$zapytanie1 = mysqli_query($polaczenie, "UPDATE zlecenia SET zdjecie1='$zdjecie1', zdjecie2='$zdjecie2', zdjecie3='$zdjecie3', opis_wykonania='$opis' WHERE id='$nr_zlecenia'");

		$zapytanie2 = mysqli_query($polaczenie, "UPDATE zlecenia SET status='Wykonane' WHERE id='$nr_zlecenia'");
		
		$zapytanie3 = mysqli_query($polaczenie, "INSERT INTO alerty (id, wyswietlono) VALUES ('$nr_zlecenia', '0')");
	
	header('Location: ../zlecenia_pracownikow.php');
	}