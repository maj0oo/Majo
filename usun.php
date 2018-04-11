<?php	
	session_start();
	
	if (!isset($_SESSION['zalogowany']) || ($_SESSION['typ_konta']!='admin'))
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
	
	else{
	
?>
<html>
<head>
	<meta charset="utf-8">
	<title>System rejestracji czasu pracy pracowników</title>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" >
	<link rel="stylesheet" href="css/style1.css?<?php echo uniqid(); ?>" >
	
	<script src="js/bootstrap.js"></script>
	<script language="JavaScript" type="text/javascript">
	function zegar(){
		
		now = new Date();
		var hours = now.getHours();
		var min = now.getMinutes();
		var sec = now.getSeconds();
		
		if (hours < 10) hours = "0" + hours;
		if (min < 10) min = "0" + min;
		if (sec < 10) sec = "0" + sec;
		
		document.getElementById('czas').innerHTML = hours + ":" + min + ":" + sec;
			
		setTimeout("zegar()", 1000);
	}

	</script>
</head>
<body onLoad="zegar(); getLocation()">

<div class="background">
<div class="container">
<?php

		echo "<p><span class='glyphicon glyphicon-user'></span> Witaj ".$_SESSION['nazwa']."! <a href='logout.php' style='color: white; text-decoration: none;'><button style='height: 25px; padding: 2px;' class='btn btn-danger'>Wyloguj się!</button></a></p>";
	
	
	
	echo date("d.m.Y");
?>

<div id="czas"></div>
<br>
<?php
	if (($_SESSION['typ_konta']=='admin'))
	{
		
		$odd = mysqli_query($polaczenie, "SELECT nazwa, imie, nazwisko FROM uzytkownicy");
?>



	<a href="dodaj.php"><button class="btn btn-primary button-panel">Dodaj pracownika</button></a>
	<a href="raporty.php"><button class="btn btn-primary button-panel">Raporty</button></a>
	<a href="zlecenia.php"><button class="btn btn-primary button-panel">Dodaj zlecenie</button></a>
	<a href="dodaj_oddzial.php"><button class="btn btn-primary button-panel">Dodaj oddział</button></a>
	<a href="zlecenia_pracownikow.php"><button class="btn btn-primary button-panel">Zlecenia</button></a>
	<a href="usun.php"><button class="btn btn-primary button-panel">Usuń pracownika</button></a>

			<h1 class="hejt1">Usuń pracownika</h1>
			<hr style="border-color: rgba(0,0,0,0.3)"></hr><br></br>
		<div class="ramka">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		Usuń pracownika: <br>
		<select name="pracownik">
			<?php
			while ($tablica = mysqli_fetch_assoc($odd)) {
				if($tablica['nazwa'] == "admin"){
					
				}else{
				echo "<option>".$tablica['nazwa']."</option>";
				}
			}
			?>
		</select><br>
		<br><button class="btn btn-primary" type="submit" name="dodaj">Usuń pracownika</button>
		</form>
			
			<?php

			
		if(isset($_POST['dodaj'])){
		
			$nazwa_pracownika = $_POST['pracownik'];
			
			$ins = mysqli_query($polaczenie, "DELETE FROM uzytkownicy WHERE nazwa='$nazwa_pracownika'");
		
			if($ins){
				
				echo '<span style="color: green;">Pomyślnie usunięto użytkownika.</span>';
				
			}else echo "Błąd";

		}


}
}
?>
</div>
</div>
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>