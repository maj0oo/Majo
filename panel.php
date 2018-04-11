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
		
	$zapytanie = mysqli_query($polaczenie, "SELECT * FROM alerty WHERE wyswietlono = '0'");
	
	$bool = $zapytanie->num_rows;
?>

		<div class="modal fade" id="<?php if($bool>0){echo "showModal";}?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Postęp w zleceniach</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
			  <table class="table table-striped" cellpadding=\"2\" style="background-color: white;">	
			    <tr>
				<td style="background-color: rgba(0,0,0,0.1);"><center>Id</center></td>
				<td style="background-color: rgba(0,0,0,0.1);"><center>Nazwa zlecenia</center></td>
				<td style="background-color: rgba(0,0,0,0.1);"><center>Status</center></td>
				<td style="background-color: rgba(0,0,0,0.1);"><center>Szczegóły</center></td>
				<td style="background-color: rgba(0,0,0,0.1);"><center>Akcja</center></td>
				</tr>
				<?php
				while ($tablica = mysqli_fetch_assoc($zapytanie)) {
					$id_zlec = $tablica['id'];
					$zapytanie2 = mysqli_query($polaczenie, "SELECT * FROM zlecenia WHERE id = '$id_zlec'");
					while($tablica2 = mysqli_fetch_assoc($zapytanie2)){
						echo "<tr>";
						 echo "<td><center>".$tablica2['id']."</center></td>";
						 echo "<td><center>".$tablica2['nazwa_zlecenia']."</center></td>";
						 echo "<td><center><span style='color: green;'>".$tablica2['status']."</span></center></td>";
						 echo "<td><center><a href='zlecenia_pracownikow.php?zlecenie=".$tablica['id']."'>Szcegóły</a></center></td>";
						?>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<input type="hidden" name="id" value="<?php echo $tablica2['id']; ?>" />
						<?php
						 echo "<td><center><button type='submit' name='zatwierdz' class='btn btn-primary'>Zatwierdź</button></center></td>";
						 ?>
						 </form>
						 <?php
						echo "</tr>";
					}
				}
				
						if(isset($_POST['zatwierdz'])){
						$id= $_POST['id'];
						$zapytanie3 = mysqli_query($polaczenie, "UPDATE alerty SET wyswietlono = '1' WHERE id = '$id'");
					 
				
						 header('Refresh:0');

						}

				?>
				
			  </table>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
			  </div>
			</div>
		  </div>
		</div>



	<a href="dodaj.php"><button class="btn btn-primary button-panel">Dodaj pracownika</button></a>
	<a href="raporty.php"><button class="btn btn-primary button-panel">Raporty</button></a>
	<a href="zlecenia.php"><button class="btn btn-primary button-panel">Dodaj zlecenie</button></a>
	<a href="dodaj_oddzial.php"><button class="btn btn-primary button-panel">Dodaj oddział</button></a>
	<a href="zlecenia_pracownikow.php"><button class="btn btn-primary button-panel">Zlecenia</button></a>
	<a href="usun.php"><button class="btn btn-primary button-panel">Usuń pracownika</button></a>
<?php
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
					 
}else echo "błąd";
}

	if(isset($_POST['koniec'])){
		
		$pesel = $_SESSION['pesel'];
		$dostepny = "0";
		$pesel = $_SESSION['pesel'];


		$update = "UPDATE raporty SET dostepny = 'niedostępny', godzina_zak = NOW() WHERE pesel='$pesel' ORDER BY godzina_rozp DESC LIMIT 1";
					 
		if($polaczenie->query($update) === TRUE){

		header('Refresh:0');
		
}else echo "błąd";
}

		
	$pesel = $_SESSION['pesel'];
	$result = mysqli_query($polaczenie, "SELECT dostepny FROM raporty WHERE pesel='$pesel' ORDER BY godzina_rozp DESC LIMIT 1");

	$zapytanie99 = mysqli_query($polaczenie, "SELECT * FROM raporty WHERE pesel='$pesel'");
	
	$sprawdz = mysqli_num_rows($zapytanie99);
	
	if($sprawdz > 0){
?>
<div id="demo">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input name="lokalizacja" type="hidden" id="ide">
	<button name="start" <?php while ($row = mysqli_fetch_array($result)) { if($row["dostepny"] == "dostępny"){echo "disabled";}?>>Zacznij pracę</button>
</form>
</div>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<button name="koniec" <?php if($row["dostepny"] == "niedostępny"){echo "disabled";}}?>>Zakończ pracę</button>
</form>
<?php
}else{
?>
<div id="demo">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input name="lokalizacja" type="hidden" id="ide">
	<button name="start">Zacznij pracę</button>
</form>
</div>
<?php
}
?>

<a href="zlecenia_pracownikow.php"><button class="btn-primary button-panel">zlecenia</button></a><br>

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
	<script type="text/javascript">
    $(window).on('load',function(){
        $('#showModal').modal('show');
    });
	</script>
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>