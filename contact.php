	<!-- this is the result screen --> 
<!DOCTYPE html>
<html>

<head>
<title>DigiVet</title>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<h1> Contact details Veterinarian</h1>

<p> Please call Medior vet:</p>
<p>Abubakar Zibuila</p>
<p>Telephone number: 026586919</p>


<?php

 if(!isset($_GET['result'])) {
	echo '<a id="send" class="click" href="http://localhost:8088/static/send-sms.html#http://localhost:80/digivet/contact.php?result=ok" title="call">Send SMS</a>';
 } else {
	echo '<p>SMS has been sent</p>';
 }
 
?>


</body>
</html> 	