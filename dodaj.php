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
<?php			
		$odd = mysqli_query($polaczenie, "SELECT nazwa_oddzialu FROM oddzialy");

?>


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
?>
	<a href="dodaj.php"><button class="btn btn-primary button-panel">Dodaj pracownika</button></a>
	<a href="raporty.php"><button class="btn btn-primary button-panel">Raporty</button></a>
	<a href="zlecenia.php"><button class="btn btn-primary button-panel">Dodaj zlecenie</button></a>
	<a href="dodaj_oddzial.php"><button class="btn btn-primary button-panel">Dodaj oddział</button></a>
	<a href="zlecenia_pracownikow.php"><button class="btn btn-primary button-panel">Zlecenia</button></a>
	<a href="usun.php"><button class="btn btn-primary button-panel">Usuń pracownika</button></a>
<?php
}
?>
			<h1 class="hejt1">Dodaj pracownika</h1>
			<hr style="border-color: rgba(0,0,0,0.3)"></hr><br></br>
		<div class="rejestracja ramka">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		Login:<br><input type="text" name="login" /><br></br>
		Hasło: <br><input type="password" name="haslo1" /><br></br>
		Powtórz hasło:<br> <input type="password" name="haslo2" /><br></br>
		Email:<br> <input type="text" name="email" /><br></br>
		Typ konta:<br> Admin: <input type="radio" name="typ" value="admin" /> User: <input type="radio" name="typ" value="user" checked="checked"/><br></br>
		Telefon:<br> <input type="text" name="tel" /> <br></br>
		Imię:<br><input type="text" name="imie" /> <br></br>
		Nazwisko:<br><input type="text" name="nazwisko" /> <br></br>
		Pesel:<br><input type="text" name="pesel" /> <br></br>
		Oddział:<br>
		<select name="oddzial">
			<?php
			while ($tablica = mysqli_fetch_assoc($odd)) {
				echo "<option>".$tablica['nazwa_oddzialu']."</option>";
			}
			?>
		</select>
		<br></br>
		<button class="btn btn-primary" type="submit" name="dodaj">Dodaj</button>

		</form>
			
			<?php

			
		if(isset($_POST['dodaj'])){	
		$nazwa = $_POST['login'];
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		$email = $_POST['email'];
		$typ = $_POST['typ'];
		$tel = $_POST['tel'];
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$pesel = $_POST['pesel'];
		$oddzial = $_POST['oddzial'];
		
		$sprawdz1 = mysqli_fetch_array(mysqli_query($polaczenie, "SELECT COUNT(*) FROM uzytkownicy WHERE pesel='$pesel' LIMIT 1"));
		$sprawdz2 = mysqli_fetch_array(mysqli_query($polaczenie, "SELECT COUNT(*) FROM uzytkownicy WHERE nazwa='$nazwa' LIMIT 1"));
		$sprawdz3 = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';
		$sprawdz4 = strlen($nazwa);
		$sprawdz5 = strlen($haslo1);
		$sprawdz6 = strlen($pesel);
		$komunikat = '';
		
	
		if (!$nazwa || !$haslo1 || !$haslo2 || !$pesel || !$imie || !$nazwisko ) {
		$komunikat .= "- Musisz wypełnić podstawowe pola.<br>"; 
		}
		if ($sprawdz4 < 4) {
		$komunikat .= "- Login musi zawierać przynajmniej 4 znaki.<br>"; 
		}
		if ($sprawdz5 < 4) {
		$komunikat .= "- Hasło musi zawierać przynajmniej 4 znaki.<br>"; 
		}
		if ($sprawdz1[0] >= 1) {
		$komunikat .= "- Uzytkownik o takim peselu już istnieje.<br>"; 
		}
		if ($sprawdz2[0] >= 1) {
		$komunikat .= "- Użytkownik o takim loginie już istnieje.<br>"; 
		}
		if ($sprawdz6 != 11) {
		$komunikat .= "- Pesel jest nieprawidłowy.<br>"; 
		}
		if(preg_match($sprawdz3, $email))
		{
			
		}else{
			$komunikat .= "- Zła konstrukcja maila.";
		}
	
	
	if($komunikat != ''){
		
		echo 'Dodawanie użytkownika nie powiodło się z powodu:</b><br>'.$komunikat.'<br>';
	}else{
	
	$haslo1 = md5($haslo1);
		
		$ins = "INSERT INTO uzytkownicy (nazwa, haslo, email, typ_konta, tel, pesel, imie, nazwisko, oddzial) VALUES ('$nazwa','$haslo1','$email','$typ','$tel','$pesel', '$imie', '$nazwisko', '$oddzial')";
		
		 if($polaczenie->query($ins) === TRUE){
			header('Location: index.php');
			
		}else {
			echo "Błąd." . $ins . "<br>" . $polaczenie->error;
		}
	}	
	
}
}	
			?>
</div>
</div>
<br></br>
	<script>
    var x=document.getElementById("ide");
	
	document.getElementById("demo").style.display = "none";
	
    function getLocation()
      {
      if (navigator.geolocation)
        {
        navigator.geolocation.getCurrentPosition(showPosition);
        }
      else{x.value="";}
      }
	document.addEventListener("load", showPosition);
	
    function showPosition(position)
      {
      x.value=position.coords.latitude +"," + position.coords.longitude;	
	  document.getElementById("demo").style.display = "";
      }
	  
	  
	  
    </script>
	<script> 
		document.getElementById("files").onchange = function () {
			var reader = new FileReader();

			reader.onload = function (e) {
				// get loaded data and render thumbnail.
				document.getElementById("image").src = e.target.result;
			};

			// read the image file as a data URL.
			reader.readAsDataURL(this.files[0]);
		};
				document.getElementById("files2").onchange = function () {
			var reader = new FileReader();

			reader.onload = function (e) {
				// get loaded data and render thumbnail.
				document.getElementById("image2").src = e.target.result;
			};

			// read the image file as a data URL.
			reader.readAsDataURL(this.files[0]);
		};
				document.getElementById("files3").onchange = function () {
			var reader = new FileReader();

			reader.onload = function (e) {
				// get loaded data and render thumbnail.
				document.getElementById("image3").src = e.target.result;
			};

			// read the image file as a data URL.
			reader.readAsDataURL(this.files[0]);
		};
	</script> 
	<script>
	$('#something').click(function() {
    location.reload();
	});
	</script>
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>