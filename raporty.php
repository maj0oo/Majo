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
<body onLoad="zegar(); wyswietlCzas()">
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
?>
	<a href="dodaj.php"><button class="btn btn-primary button-panel">Dodaj pracownika</button></a>
	<a href="raporty.php"><button class="btn btn-primary button-panel">Raporty</button></a>
	<a href="zlecenia.php"><button class="btn btn-primary button-panel">Dodaj zlecenie</button></a>
	<a href="dodaj_oddzial.php"><button class="btn btn-primary button-panel">Dodaj oddział</button></a>
	<a href="zlecenia_pracownikow.php"><button class="btn btn-primary button-panel">Zlecenia</button></a>
	<a href="usun.php"><button class="btn btn-primary button-panel">Usuń pracownika</button></a>
	
	<h1 class="hejt1">Raporty</h1>
	<hr style="border-color: rgba(0,0,0,0.3)"></hr><br></br>
<?php
}
		
	$na_stronie = 5;

    $zapytanie = "SELECT COUNT(id) FROM raporty";
    $wynik = mysqli_query($polaczenie, $zapytanie);
    $a = mysqli_fetch_row($wynik);
    $liczba_wpisow = $a[0];
    $liczba_stron = ceil($liczba_wpisow / $na_stronie);
    

    if (isset($_GET['strona'])) {

        if ($_GET['strona'] < 1 || $_GET['strona'] > $liczba_stron) $strona = 1;

        else $strona = $_GET['strona'];

    }

    else $strona = 1;

    $od = $na_stronie * ($strona - 1);

    $zapytanie = "SELECT * FROM raporty ORDER BY godzina_rozp DESC LIMIT $od , $na_stronie";

    $wynik = mysqli_query($polaczenie, $zapytanie);
?>
	<table class="table table-striped" style="background-color: white;" cellpadding=\"2\">
	<tr>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Id</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Imię</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Nazwisko</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Login</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Godzina rozpoczęcia pracy</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Godzina zakończenia pracy</center></td>
	</tr>
<?php
    while ($tablica = mysqli_fetch_assoc($wynik)) {
		echo "<tr>";
        echo "<td><center>".$tablica['id']."</center></td>";
        echo "<td><center>".$tablica['imie']."</center></td>";
		echo "<td><center>".$tablica['nazwisko']."</center></td>";
		echo '<td><center>'.$tablica['nazwa_uzytkownika'].'</center></td>';
		echo "<td><center>".$tablica['godzina_rozp']."</center></td>";
		if($tablica['godzina_zak'] == "0000-00-00 00:00:00"){
		echo "<td><center>W pracy</center></td>";
		}else{			
		echo "<td><center>".$tablica['godzina_zak']."</center></td>";
		}
        echo "</tr>";
   
    }
		echo "</table>"; 
	


    if ($liczba_wpisow > $na_stronie) {

        $poprzednia = $strona - 1;

        $nastepna = $strona + 1;



        if ($poprzednia > 0) {

 echo '<a id="POPRZEDNIA" style="float: left;" href="raporty.php?strona='.$poprzednia.'">poprzednia strona</a>';

        }
        

        if ($nastepna <= $liczba_stron) {

 echo '<a id="NASTEPNA" style="float: right;" href="raporty.php?strona='.$nastepna.'">następna strona</a>';

        }


    }	
?>
	<br></br>
	Wybierz pracownika:
	<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
		<select name="nazwa">
		<?php 
		$zapytanie = "SELECT nazwa FROM uzytkownicy ORDER BY nazwa DESC ";

		$wynik = mysqli_query($polaczenie, $zapytanie);
		while ($tablica = mysqli_fetch_assoc($wynik)) {
			echo "<option>".$tablica['nazwa']."</option>";
		}
		?>
		</select>
		<br>
		<button type="submit" name="szukaj">Pokaż raport o użytkowniku</button>
	</form>
<?php	

	if(isset($_POST['szukaj'])){
		$nazwa = $_POST['nazwa'];
		?>
		<div class="ramka" style="margin-bottom: 20px;">
		
		<?php
		echo "<p>Nazwa pracownika: $nazwa</p>";
		$zapytanie = "SELECT * FROM uzytkownicy WHERE nazwa='$nazwa'";
		
		$wynik = mysqli_query($polaczenie, $zapytanie);

		while ($tablica = mysqli_fetch_assoc($wynik)){
			echo '<p><b>Imię: </b>'.$tablica['imie'].'</p>';
			echo '<p><b>Nazwisko: </b>'.$tablica['nazwisko'].'</p>';
			echo '<p><b>Pesel: </b>'.$tablica['pesel'].'</p>';
			echo '<p><b>Oddział: </b>'.$tablica['oddzial'].'</p>';
		}
		
		$zapytanie2 = "SELECT * FROM raporty WHERE nazwa_uzytkownika='$nazwa' ORDER BY godzina_rozp DESC LIMIT 1";

		$wynik2 = mysqli_query($polaczenie, $zapytanie2);
		
		while ($tablica = mysqli_fetch_assoc($wynik2)){
			if($tablica['dostepny'] == "niedostępny"){
			echo '<p style="color:red;">'.$tablica['dostepny'].'</p>';
			}else 
				
			if($tablica['dostepny'] == "dostępny"){
				
			echo '<p style="color:green;">'.$tablica['dostepny'].'</p>';
			echo 'Pozycja:<br>';
			echo '<iframe id="google_map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk?q='.$tablica['lokalizacja'].'&z=60&output=embed"></iframe>';
		}
		}
		?>
		</div>
		<?php
		$zapytanie3 = "SELECT * FROM raporty WHERE nazwa_uzytkownika='$nazwa' ORDER BY godzina_rozp DESC";

		$wynik3 = mysqli_query($polaczenie, $zapytanie3);
		
		echo '<table class="table table-striped" cellpadding=\"2\" style="background-color: white;">';
		echo '<tr>';
		echo "<td style='background-color: rgba(0,0,0,0.1);'><center>Id</center></td>";
		echo "<td style='background-color: rgba(0,0,0,0.1);'><center>Godzina rozpoczęcia pracy</center></td>";
		echo "<td style='background-color: rgba(0,0,0,0.1);'><center>Godzina zakończenia pracy</center></td>";
		echo "</tr>";
		
		while ($tablica = mysqli_fetch_assoc($wynik3)){
		echo "<tr>";
        echo "<td><center>".$tablica['id']."</center></td>";
		echo "<td><center>".$tablica['godzina_rozp']."</center></td>";
		if($tablica['godzina_zak'] == "0000-00-00 00:00:00"){
		echo "<td><center>W pracy</center></td>";
		}else{			
		echo "<td><center>".$tablica['godzina_zak']."</center></td>";
		}
        echo "</tr>";
		}
		
		echo '</table>';
	}
?>
</div>
</div>
<?php
}

	
?>
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