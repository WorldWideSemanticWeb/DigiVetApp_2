<!-- this is the result screen --> 
<!DOCTYPE html>
<html>

<head>
<title>DigiVet</title>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<h1> Outcome</h1>


<?php
include 'database.php';
include 'functions.php';
$col_decision = 'decision'; 
$table_general = 'variables_general'; 

$query = "SELECT notUrgent FROM $table_general";
$stmt = $con->prepare($query);
$stmt->execute();
$notUrgent = $stmt->fetchColumn();
//print $notUrgent;

$query = "SELECT urgent FROM $table_general";
$stmt = $con->prepare($query);
$stmt->execute();
$urgent = $stmt->fetchColumn();
//print $urgent; 

if (($notUrgent >= 3 AND $urgent ==1)OR($urgent>1)){
	$toVeterinarian_decision = 1;
	update_parameter($toVeterinarian_decision, $col_decision, $table_general); 
}
else {
	$toVeterinarian_decision = 0;
	update_parameter($toVeterinarian_decision, $col_decision, $table_general); 
} 

if ($toVeterinarian_decision == 1){ 
	print "<p>It is recommended to visit a veterinarian.</p>"; 
	
	echo '<p>To contact one: press blue for yes, or yellow for no.</p>'; 
	echo '<form action="contact.php">'; 
	echo '<button type="submit" id="vet_blue"></button>'; 
	echo '</form>'; 
	echo '<form method="get" action="final.php">'; 
	echo '<button type="submit" id="vet_yellow"></button>'; 
	echo '</form>'; 
    echo'<script>
    $(document).ready(function() {
        var audioElement = document.createElement("audio");
        audioElement.setAttribute("src", "sounds/visitVet.mp3");
        audioElement.setAttribute("autoplay", "autoplay");
        //audioElement.load()

        $.get();

        audioElement.addEventListener("load", function() {
            audioElement.play();
        }, true);

        $(".play").click(function() {
            audioElement.play();
        });

        $(".pause").click(function() {
            audioElement.pause();
        });           
    });
</script> ';
}
elseif ($toVeterinarian_decision == 0) { 
	print "<p>It is not recommended to visit a veterinarian</p>"; 
	
	echo '<p>If you would still like to contact one, press blue for yes, or yellow for no?</p>'; 
	echo '<form action="contact.php">'; 
	echo '<button type="submit" id="vet_blue"></button>'; 
	echo '</form>'; 
	echo '<form action="final.php">'; 
	echo '<button type="submit" id="vet_yellow"></button>'; 
	echo '</form>'; 
    echo'<script>
    $(document).ready(function() {
        var audioElement = document.createElement("audio");
        audioElement.setAttribute("src", "sounds/notVisitVet.mp3");
        audioElement.setAttribute("autoplay", "autoplay");
        //audioElement.load()

        $.get();

        audioElement.addEventListener("load", function() {
            audioElement.play();
        }, true);

        $(".play").click(function() {
            audioElement.play();
        });

        $(".pause").click(function() {
            audioElement.pause();
        });
        
    });
</script> ';
}

?>

</body>
</html> 	