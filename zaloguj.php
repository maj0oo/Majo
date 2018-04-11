<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = md5($_POST['haslo']);
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownicy WHERE nazwa='%s' AND haslo='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$_SESSION['zalogowany'] = true;
				
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['id'] = $wiersz['id'];
				$_SESSION['imie'] = $wiersz['imie'];
				$_SESSION['nazwisko'] = $wiersz['nazwisko'];
				$_SESSION['pesel'] = $wiersz['pesel'];
				$_SESSION['nazwa'] = $wiersz['nazwa'];
				$_SESSION['haslo'] = $wiersz['haslo'];
				$_SESSION['email'] = $wiersz['email'];
				$_SESSION['typ_konta'] = $wiersz['typ_konta'];
				$_SESSION['tel'] = $wiersz['tel'];
				$_SESSION['oddzial'] = $wiersz['oddzial'];
				
				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: panel.php');
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>