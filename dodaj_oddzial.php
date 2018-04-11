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
			<h1 class="hejt1">Dodaj oddział</h1>
			<hr style="border-color: rgba(0,0,0,0.3)"></hr><br></br>
		<div class="rejestracja ramka">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		Nazwa oddziału: <br><input type="text" name="nazwa_oddzialu"><br>
		<br><button class="btn btn-primary" type="submit" name="dodaj">Dodaj oddział</button>
		</form>
			
			<?php

			
		if(isset($_POST['dodaj'])){	
			$nazwa_oddzialu = $_POST['nazwa_oddzialu'];
			
			$sprawdz1 = mysqli_fetch_array(mysqli_query($polaczenie, "SELECT COUNT(*) FROM oddzialy WHERE nazwa_oddzialu='$nazwa_oddzialu' LIMIT 1"));
			$sprawdz2 = strlen($nazwa_oddzialu);
			
			$komunikat = "";
			
			if(!$nazwa_oddzialu){
				$komunikat .= '<span style="color: red;">Podaj nazwę oddziału.</span><br>';
			}
			if($sprawdz1[0] >= 1){
				$komunikat .= '<span style="color: red;">Oddział o takiej nazwie już istnieje.</span><br>';
			}
			if($sprawdz2 < 4){
				$komunikat .= '<span style="color: red;">Nazwa oddziału musi zawierać więcej niż 4 znaki.</span><br>';
			}
			
			if($komunikat != ''){
		
			echo 'Dodawanie oddziału nie powiodło się z powodu:</b><br>'.$komunikat.'<br>';
			}else{
			
			$ins = mysqli_query($polaczenie, "INSERT INTO oddzialy (nazwa_oddzialu) VALUES ('$nazwa_oddzialu')");
		
			echo "<span style='color: green;'>Dodano.</span>";
			}
		}
		}	
			?>
</div>
</div>
	<script> 
		document.getElementById("files").onchange = function () {
			var reader = new FileReader();

			reader.onload = function (e) {

				document.getElementById("image").src = e.target.result;
			};


			reader.readAsDataURL(this.files[0]);
		};
				document.getElementById("files2").onchange = function () {
			var reader = new FileReader();

			reader.onload = function (e) {

				document.getElementById("image2").src = e.target.result;
			};


			reader.readAsDataURL(this.files[0]);
		};
				document.getElementById("files3").onchange = function () {
			var reader = new FileReader();

			reader.onload = function (e) {
			
				document.getElementById("image3").src = e.target.result;
			};

		
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