<!-- this is the third general information screen--> 
<!DOCTYPE html>
<html>

<head>
<title>DigiVet</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>

</head>
<body>

<div id="animal"> 
<?php
include 'database.php';


?>

</div> 

<div id="information"> 
<p>Here information should be given about the subject corresponding to the animal.</p>

</div> 

<p class="small"> Do you want to go back to the start screen? </p>
<p class="small"> Press blue for yes and yellow for no.</p>

<form action="start.php">
	<button type="submit" id="vet_blue"></button>
</form>

<form method="get" action="black.php">  <!-- should be changed to shutdown of the system if possible --> 
	<button type="submit" id="vet_yellow"></button>
</form>



</body>
</html> 	