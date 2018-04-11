<?php	
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
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
?>
	<a href="dodaj.php"><button class="btn btn-primary button-panel">Dodaj pracownika</button></a>
	<a href="raporty.php"><button class="btn btn-primary button-panel">Raporty</button></a>
	<a href="zlecenia.php"><button class="btn btn-primary button-panel">Dodaj zlecenie</button></a>
	<a href="dodaj_oddzial.php"><button class="btn btn-primary button-panel">Dodaj oddział</button></a>
	<a href="zlecenia_pracownikow.php"><button class="btn btn-primary button-panel">Zlecenia</button></a>
	<a href="usun.php"><button class="btn btn-primary button-panel">Usuń pracownika</button></a>
	
	
	<h1 class="hejt1">Zlecenia pracowników</h1>
	<hr style="border-color: rgba(0,0,0,0.3)"></hr><br></br>
	
	
<?php

	$na_stronie = 5;
	$zapytanie = "SELECT COUNT(id) FROM zlecenia";
    $wynik = mysqli_query($polaczenie, $zapytanie);
    $a = mysqli_fetch_row($wynik);
    $liczba_wpisow = $a[0];
    $liczba_stron = ceil($liczba_wpisow / $na_stronie);
		
	if (isset($_GET['strona'])) {

        if ($_GET['strona'] < 1 || $_GET['strona'] > $liczba_stron) $strona = 1;

        else $strona = $_GET['strona'];

    } else $strona = 1;
		
	$od = $na_stronie * ($strona - 1);
	
	$zapytanie = "SELECT * FROM zlecenia ORDER BY termin DESC LIMIT $od , $na_stronie";
		
	$wynik = mysqli_query($polaczenie, $zapytanie);
	echo '<table class="table table-striped" cellpadding=\"2\" style="background-color: white;">';
	?>
	<tr>
	<td style="background-color: rgba(0,0,0,0.1)"><center>Id</center></td>
	<td style="background-color: rgba(0,0,0,0.1)"><center>Zleceniodawca</center></td>
	<td style="background-color: rgba(0,0,0,0.1)"><center>Nazwa zlecenia</center></td>
	<td style="background-color: rgba(0,0,0,0.1)"><center>Lokalizacja</center></td>
	<td style="background-color: rgba(0,0,0,0.1)"><center>Termin</center></td>
	<td style="background-color: rgba(0,0,0,0.1)"><center>Status</center></td>
	<td style="background-color: rgba(0,0,0,0.1)"><center>Szczegóły</center></td>
	<td style="background-color: rgba(0,0,0,0.1)"><center>Akcja</center></td>
	</tr>
	<?php
    while ($tablica = mysqli_fetch_assoc($wynik)) {
	echo "<tr>";
        echo "<td><center>".$tablica['id']."</center></td>";
        echo "<td><center>".$tablica['zleceniodawca']."</center></td>";
		echo "<td><center>".$tablica['nazwa_zlecenia']."</center></td>";
		echo "<td><center>".$tablica['lokalizacja']."</center></td>";
		echo "<td><center>".$tablica['termin']."</center></td>";
		if($tablica['status'] == "Nie wykonane"){
			echo '<td style="color: red;"><center>'.$tablica['status'].'</center></td>';
		}else if($tablica['status'] == "W trakcie"){
			echo '<td style="color: orange;"><center>'.$tablica['status'].'</center></td>';
		}else if($tablica['status'] == "Wykonane"){
			echo '<td style="color: green;"><center>'.$tablica['status'].'</center></td>';
		}
		echo "<td><center><a href='zlecenia_pracownikow.php?zlecenie=".$tablica['id']."'>Szcegóły</a></center></td>";
		?>
		<form action="forms/usun.php" method="post">
		<input type="hidden" name="id" value="<?php echo $tablica['id']; ?>"/>
		<?php
		echo '<td><center><button type="submit" name="usun" class="btn btn-danger"><a style="color: white; text-decoration: none;" name="usun">Usuń</a></button></center></td>';
		?>
		</form>
		<?php
	echo "</tr>";
   
    }

	echo "</table>";
	
    if ($liczba_wpisow > $na_stronie) {

        $poprzednia = $strona - 1;

        $nastepna = $strona + 1;



        if ($poprzednia > 0) {

 echo '<a id="POPRZEDNIA" href="zlecenia_pracownikow.php?strona='.$poprzednia.'">poprzednia strona</a>';

        }
        

	if ($nastepna <= $liczba_stron) {

	echo '<a id="NASTEPNA" style="float: right;" href="zlecenia_pracownikow.php?strona='.$nastepna.'">następna strona</a>';

        }
    }	
	

	if(isset($_GET['zlecenie'])){
		
		$nr_zlecenia = $_GET['zlecenie'];
		
		$zapytanie = "SELECT * FROM zlecenia WHERE id='$nr_zlecenia'";
		
		$wynik = mysqli_query($polaczenie, $zapytanie);
		 while ($tablica = mysqli_fetch_assoc($wynik)) {
			 echo '<b>Zleceniodawca: </b>'.$tablica['zleceniodawca'].'<br>';
			 echo '<b>Nazwa zlecenia: </b>'.$tablica['nazwa_zlecenia'].'<br>';
			 echo '<b>Lokalizacja: </b>'.$tablica['lokalizacja'].'<br>';
			 echo '<b>Termin: </b>'.$tablica['termin'].'<br>';
			 echo '<b>Opis: </b>'.$tablica['opis'].'<br>';
			 echo '<b>Status: </b>';
			 if($tablica['status'] == "Nie wykonane"){
			echo '<span style="color: red;">'.$tablica['status'].'</span>';
			}else if($tablica['status'] == "W trakcie"){
				echo '<span style="color: orange;">'.$tablica['status'].'</span>';
			}else if($tablica['status'] == "Wykonane"){
				echo '<span style="color: green;">'.$tablica['status'].'</span>';
			}
			echo "<br></br>";
			if($tablica['status'] == "Wykonane"){
						?>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4">
					<a href="files/<?php echo $tablica['zdjecie1'];?>" class="thumbnail">
						<img src="files/<?php echo $tablica['zdjecie1'];?>" />
					</a>
					</div>
					<div class="col-md-4">
					<a href="files/<?php echo $tablica['zdjecie2'];?>" class="thumbnail">
					<img src="files/<?php echo $tablica['zdjecie2'];?>" />
					</a>
					</div>
					<div class="col-md-4">
					<a href="files/<?php echo $tablica['zdjecie3'];?>" class="thumbnail">
					<img src="files/<?php echo $tablica['zdjecie3'];?>" />
					</a>
					</div>
				</div>
			</div>
			
			<?php
			
			
			echo '<b>Od zleceniowykonawcy: </b>'.$tablica['opis_wykonania'].'<br>';
			echo "<br></br>";
			}
		 }
	}

}else{
	

		
	if(isset($_POST['start'])){
		
		$nazwa = $_SESSION['nazwa'];
		$imie = $_SESSION['imie'];
		$nazwisko = $_SESSION['nazwisko'];
		$pesel = $_SESSION['pesel'];
		$dostepny = "dostępny";
		$lokalizacja = $_POST['lokalizacja'];


					 $ins = "INSERT INTO raporty (imie, nazwisko, nazwa_uzytkownika, pesel, dostepny, godzina_rozp, godzina_zak, lokalizacja) VALUES ('$imie','$nazwisko','$nazwa','$pesel','$dostepny', NOW(), '', '$lokalizacja')";
					 
					 if($polaczenie->query($ins) === TRUE){
						 
						header('Refresh:0');
					}else echo "błąd" . $ins . "<br>" . $polaczenie->error;
		}


	if(isset($_POST['koniec'])){
		$pesel = $_SESSION['pesel'];
		$dostepny = "0";
		$pesel = $_SESSION['pesel'];
		$id = $_SESSION['idd'];
		
		$ins = "UPDATE raporty SET dostepny = 'niedostępny', godzina_zak = NOW() WHERE pesel='$pesel' ORDER BY godzina_rozp DESC LIMIT 1";
		
		
					 if($polaczenie->query($ins) === TRUE){
						
						 header('Refresh:0');
					 }else {
						 echo "Błąd." . $ins . "<br>" . $polaczenie->error;
					 }
		
	}
		
	$pesel = $_SESSION['pesel'];
	$result = mysqli_query($polaczenie, "SELECT dostepny FROM raporty WHERE pesel='$pesel' ORDER BY godzina_rozp DESC LIMIT 1");
?>
<div id="demo">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input name="lokalizacja" type="hidden" id="ide">
	<button name="start" onClick="window.location.reload()" <?php while ($row = mysqli_fetch_array($result)) { if($row["dostepny"] == "dostępny"){echo "disabled";}?>>Zacznij pracę</button>
</form>
</div>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<button name="koniec" <?php if($row["dostepny"] == "niedostępny"){echo "disabled";}}?>>Zakończ pracę</button>
</form>

<a href="zlecenia_pracownikow.php"><button class="btn btn-primary button-panel">zlecenia</button></a><br>
<br>
<?php
	$b = "1";
	$pesel = $_SESSION['pesel'];
	$result = mysqli_query($polaczenie, "SELECT dostepny FROM raporty WHERE pesel='$pesel' ORDER BY godzina_rozp DESC LIMIT 1");
	$result2 = mysqli_query($polaczenie, "SELECT godzina_rozp FROM raporty WHERE pesel='$pesel' ORDER BY godzina_rozp DESC LIMIT 1");
	while ($row = mysqli_fetch_array($result)) {
    while ($row2 = mysqli_fetch_array($result2)) {

	if($row["dostepny"] == "dostępny"){
		echo 'Jesteś <a style="color: green;">'; printf("%s", $row["dostepny"]); echo '</a><br>';
		echo "Zacząłeś pracę: "; echo $row2["godzina_rozp"];
	}else{
		
	echo 'Jesteś <a style="color: red;">'; printf("%s", $row["dostepny"]); echo '</a>';
	}	
}
}

?>
	<h1 class="hejt1">Zlecenia</h1>
	<hr style="border-color: rgba(0,0,0,0.3)"></hr><br></br>

<?php

	$na_stronie = 5;

    $zapytanie = "SELECT COUNT(id) FROM zlecenia";
    $wynik = mysqli_query($polaczenie, $zapytanie);
    $a = mysqli_fetch_row($wynik);
    $liczba_wpisow = $a[0];
    $liczba_stron = ceil($liczba_wpisow / $na_stronie);
	$oddzial = $_SESSION['oddzial'];
    

    if (isset($_GET['strona'])) {

        if ($_GET['strona'] < 1 || $_GET['strona'] > $liczba_stron) $strona = 1;

        else $strona = $_GET['strona'];

    }

    else $strona = 1;

    $od = $na_stronie * ($strona - 1);

    $zapytanie = "SELECT * FROM zlecenia WHERE oddzial = '$oddzial' ORDER BY termin DESC LIMIT $od , $na_stronie";

    $wynik = mysqli_query($polaczenie, $zapytanie);
	echo '<table class="table table-striped" cellpadding=\"2\" style="background-color: white;">';
	?>
	
	<tr>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Id</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Zleceniodawca</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Nazwa zlecenia</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Lokalizacja</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Termin</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Status</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Szczegóły</center></td>
	<td style="background-color: rgba(0,0,0,0.1);"><center>Akcja</center></td>
	</tr>
	
	<?php
    while ($tablica = mysqli_fetch_assoc($wynik)) {
	echo "<tr>";
        echo "<td><center>".$tablica['id']."</center></td>";
        echo "<td><center>".$tablica['zleceniodawca']."</center></td>";
		echo "<td><center>".$tablica['nazwa_zlecenia']."</center></td>";
		echo "<td><center>".$tablica['lokalizacja']."</center></td>";
		echo "<td><center>".$tablica['termin']."</center></td>";
		if($tablica['status'] == "Nie wykonane"){
			echo '<td style="color: red;"><center>'.$tablica['status'].'</center></td>';
		}else if($tablica['status'] == "W trakcie"){
			echo '<td style="color: orange;"><center>'.$tablica['status'].'</center></td>';
		}else if($tablica['status'] == "Wykonane"){
			echo '<td style="color: green;"><center><span>'.$tablica['status'].'</span></center></td>';
		}
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="hidden" name="id" value="<?php echo $tablica['id']; ?>">
		<?php
		echo "<td><center><button type='submit' name='szczegoly' class='btn btn-primary'><a>Szcegóły</a></button></center></td>";
		?>
		</form>
		<?php
		if($tablica['status'] == "Nie wykonane"){
		?>
		<form action="forms/rozp.php" method="post">
		<input type="hidden" name="id" value="<?php echo $tablica['id']; ?>">
		<?php
		echo "<td><center><button class='btn btn-primary' type='submit' name='rozpocznij'><a>Rozpocznij</a></button></center></td>";
		?>
		</form>
		<?php
		}else
		if($tablica['status'] == "W trakcie"){
		echo '<td><center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Zakończ</button></center></td>';
		?>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Zakończ zlecenie</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
			  <form action="forms/zak.php" method="post" enctype="multipart/form-data">
				<input type="file" name="upload" id="files"/>
				<input type="file" name="upload2" id="files2"/>
				<input type="file" name="upload3" id="files3"/><br>
				<input type="hidden" name="id" value="<?php echo $tablica['id']; ?>"/>
				<img id="image" height="100px" width="100px" border="0px"/>
				<img id="image2" height="100px" width="100px" border="0px"/>
				<img id="image3" height="100px" width="100px" border="0px"/>
				<br></br>
				<h4>Dodatkowe informacje</h4>
				<textarea name="opis" rows="10" cols="50"></textarea>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
				<input name="zakoncz" type="submit" class="btn btn-primary" value="Zakończ"/>
			  </form>
			  </div>
			</div>
		  </div>
		</div>
		<?php
		}else
		if($tablica['status'] == "Wykonane"){
			echo '<td><center><button class="btn btn-success" disabled>Zakończono</button></center></td>';
		}
    echo "</tr>";
   
    }
	


	echo "</table>";
	
    if ($liczba_wpisow > $na_stronie) {

        $poprzednia = $strona - 1;

        $nastepna = $strona + 1;



        if ($poprzednia > 0) {

 echo '<a id="POPRZEDNIA" href="zlecenia_pracownikow.php?strona='.$poprzednia.'">poprzednia strona</a>';

        }
        

	if ($nastepna <= $liczba_stron) {

	echo '<a id="NASTEPNA" style="float: right;" href="zlecenia_pracownikow.php?strona='.$nastepna.'">następna strona</a>';

        }
    }		
	
	echo "<br></br>";
	if(isset($_POST['szczegoly'])){
		
		$nr_zlecenia = $_POST['id'];
		
		$zapytanie = "SELECT * FROM zlecenia WHERE id='$nr_zlecenia'";
		
		$wynik = mysqli_query($polaczenie, $zapytanie);
		 while ($tablica = mysqli_fetch_assoc($wynik)) {
			echo '<b>Zleceniodawca: </b>'.$tablica['zleceniodawca'].'<br>';
			echo '<b>Nazwa zlecenia: </b>'.$tablica['nazwa_zlecenia'].'<br>';
			echo '<b>Lokalizacja: </b>'.$tablica['lokalizacja'].'<br>';
			echo '<b>Termin: </b>'.$tablica['termin'].'<br>';
			echo '<b>Opis: </b>'.$tablica['opis'].'<br>';
			echo '<b>Status: </b>'.$tablica['status'].'<br></br>';		
			if($tablica['status'] == "Nie wykonane"){
			?>
			<form action="forms/rozp.php" method="post">
			<input type="hidden" name="id" value="<?php echo $tablica['id']; ?>">
			<?php
			echo "<button class='btn btn-primary' type='submit' name='rozpocznij'><a>Rozpocznij</a></button>";
			?>
			</form>
			<?php
			}else
			if($tablica['status'] == "W trakcie"){
				?>
				
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
		Zakończ
		</button>

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Zakończ zlecenie</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
			  <form action="wykonane.php" method="post" enctype="multipart/form-data">
				<input type="file" name="upload" id="files"/>
				<input type="file" name="upload2" id="files2"/>
				<input type="file" name="upload3" id="files3"/><br>
				<input type="hidden" name="id" value="<?php echo $tablica['id']; ?>"/>
				<img id="image" height="100px" width="100px" border="0px"/>
				<img id="image2" height="100px" width="100px" border="0px"/>
				<img id="image3" height="100px" width="100px" border="0px"/>
				<br></br>
				<h4>Dodatkowe informacje</h4>
				<textarea name="opis" rows="10" cols="50"></textarea>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
				<input name="zakoncz" type="submit" class="btn btn-primary" value="Zakończ"/>
			  </form>
			  </div>
			</div>
		  </div>
		</div>

		

				<?php
			}
			
			echo '<br></br>';
			if($tablica['status'] == "Wykonane"){
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4">
					<a href="files/<?php echo $tablica['zdjecie1'];?>" class="thumbnail">
						<img src="files/<?php echo $tablica['zdjecie1'];?>" />
					</a>
					</div>
					<div class="col-md-4">
					<a href="files/<?php echo $tablica['zdjecie2'];?>" class="thumbnail">
					<img src="files/<?php echo $tablica['zdjecie2'];?>" />
					</a>
					</div>
					<div class="col-md-4">
					<a href="files/<?php echo $tablica['zdjecie3'];?>" class="thumbnail">
					<img src="files/<?php echo $tablica['zdjecie3'];?>" />
					</a>
					</div>
				</div>
			</div>
			
			<?php
			}
		 }
	}
}
}
?>
</div>
</div>


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

