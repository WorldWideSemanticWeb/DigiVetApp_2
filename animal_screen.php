<!-- this is the animal screen --> 
<!DOCTYPE html>
<html>

<head>
<title>DigiVet</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<?php
include 'functions.php';


refresh_database();
$con=null; //flush the database

?>
</head>

<body>
<div id="question"> 
<?php
include 'database.php';
$query = "SELECT * FROM table_general_question WHERE id_general_question = 1";
$sth = $con->prepare($query);

$sth->execute();


foreach ($sth->fetchAll() as $row) {
print "<p>" . $row['question'] . "</p>";
}

?>

</div> 

<button class="play"></button>
<button class="pause"></button>


<form method="get">
	<div id = "up_images"> 
		<button id="cow" name ="button1" type = "submit" ></button>
		<button id="goat" name ="button2" type = "submit" ></button>
		<button id="sheep" name ="button3" type = "submit" ></button>
	</div>
	<div id = "down_images"> 
		<button id="pig" name ="button4" type = "submit" ></button>
		<button id="dog" name ="button5" type = "submit" ></button>
	</div>
</form>
<?php

if(isset($_GET['button1'])){
    $animal = 'cow';
    $use_table = 'table_cow';
    $stmt = $con->prepare("UPDATE variables_general SET kind_of_animal='$animal', use_table='$use_table'");
    $stmt->execute();
    $con=null;
    header("Location: question.php"); //go to result page
    exit;
} elseif(isset($_GET['button2'])) { 
    $animal = 'sheep';
    $use_table = 'table_sheep';
    $stmt = $con->prepare("UPDATE variables_general SET kind_of_animal='$animal', use_table='$use_table'");
    $stmt->execute();
    $con=null;
    header("Location: question.php"); //go to result page
    exit;
} elseif(isset($_GET['button3'])) { 
    $animal = 'goat';
    $use_table = 'table_goat';
    $stmt = $con->prepare("UPDATE variables_general SET kind_of_animal='$animal', use_table='$use_table'");
    $stmt->execute();
    $con=null;
    header("Location: question.php"); //go to result page
    exit;
} elseif(isset($_GET['button4'])) { 
    $animal = 'pig';
    $use_table = 'table_pig';
    $stmt = $con->prepare("UPDATE variables_general SET kind_of_animal='$animal', use_table='$use_table'");
    $stmt->execute();
    $con=null;
    header("Location: question.php"); //go to result page
    exit;
} elseif(isset($_GET['button5'])) { 
    $animal = 'dog';
    $use_table = 'table_dog';
    $stmt = $con->prepare("UPDATE variables_general SET kind_of_animal='$animal', use_table='$use_table'");
    $stmt->execute();
    $con=null;
    header("Location: question.php"); //go to result page
    exit;
}

			
?>
<script>
    $(document).ready(function() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'sounds/animal_type.mp3');
        audioElement.setAttribute('autoplay', 'autoplay');
        //audioElement.load()

        $.get();

        audioElement.addEventListener("load", function() {
            audioElement.play();
        }, true);

        $('.play').click(function() {
            audioElement.play();
        });

        $('.pause').click(function() {
            audioElement.pause();
        });
    });
</script> 

</body>
</html> 	