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
			<h1 class="hejt1">Dodaj zlecenie</h1>
			<hr style="border-color: rgba(0,0,0,0.3)"></hr><br></br>
		<div class="rejestracja ramka">

			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="left">
			Zleceniodawca: <br><input type="text" name="zleceniodawca"><br>
			Nazwa zlecenia: <br><input type="text" name="nazwa_zlecenia"><br>
			Lokalizacja: <br><input type="text" name="lokalizacja"><br>
			</div>
			<div class="right">
			Opis zlecenia: <br><textarea name="opis" rows="10" cols="50"></textarea><br>
			</div>
			<div class="left2">
			Oddział:<br>
			<select name="oddzial">
			<?php
			while ($tablica = mysqli_fetch_assoc($odd)) {
				echo "<option>".$tablica['nazwa_oddzialu']."</option>";
			}
			?>
			</select><br>
			Termin: <br><input type="date" name="termin" value="<?php echo date("Y-m-d"); ?>"><br>

			<br><button class="btn btn-primary" type="submit" name="wyslij">Dodaj zlecenie</button>
			</div>
			</form>
			
			<?php

			
		if(isset($_POST['wyslij'])){
			$zleceniodawca = $_POST['zleceniodawca'];
			$nazwa_zlecenia = $_POST['nazwa_zlecenia'];
			$lokalizacja = $_POST['lokalizacja'];
			$opis = $_POST['opis'];
			$oddzial = $_POST['oddzial'];
			$termin = $_POST['termin'];
			
			if(!$zleceniodawca || !$nazwa_zlecenia || !$lokalizacja || !$oddzial || !$termin){
				echo '<span style="color: red;">Wypełniej wszystkie pola</span>';
			}else{
			
			$ins = "INSERT INTO zlecenia (zleceniodawca, nazwa_zlecenia, lokalizacja, opis, termin, oddzial, status) VALUES ('$zleceniodawca', '$nazwa_zlecenia', '$lokalizacja', '$opis', '$termin', '$oddzial', 'Nie wykonane')";
		
			if($polaczenie->query($ins) === TRUE){
			echo "Dodano.";
			header('Location: zlecenia_pracownikow.php');
			}else {
			echo "Błąd." . $ins . "<br>" . $polaczenie->error;
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





