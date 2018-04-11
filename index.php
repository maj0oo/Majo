<?php
	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: panel.php');
		exit();
	}
?> 

<html>
<head>
	<meta charset="utf-8">
	<title>System rejestracji czasu pracy pracowników</title>
	<link rel="stylesheet" href="css/bootstrap.css" >
	<link rel="stylesheet" href="css/style.css" >
	<link rel="stylesheet" href="css/style1.css" >
	<script src="js/bootstrap.js"></script>
</head>
<body>
<div class="col-md-12">
<div class="center col-md-4 responsive ">
<div class="ramka">
	<form action="zaloguj.php" method="post">
		Login: <br /> <input class="input_index" type="text" name="login" /> <br />
		Hasło: <br /> <input class="input_index" type="password" name="haslo" /> <br /><br />
		<input type="submit" value="Zaloguj się" />
	</form>
	<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
	?>
</div>
</div>
</div>


</body>
</html>