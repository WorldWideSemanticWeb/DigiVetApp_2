<!-- this is the second general information screen--> 
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
<p>Select a subject.</p>

</div> 
<form method="get" action="general_information2.php">
		<button id="subject1" value="subject1" name ="subject_button" type = "submit" >Animal</button>
		<button id="subject2" value="subject2" name ="subject_button" type = "submit" >Pregnancy</button>
		<button id="subject3" value="subject3" name ="subject_button" type = "submit" >Food</button>
</form>	





</body>
</html> 	