<!-- this is the animal screen --> 
<!DOCTYPE html>
<html>

<head>
<title>DigiVet</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
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


<form method="get" action="general_information.php">
	<div id = "up_images"> 
		<button id="cow" value=<?php $animal = 'cow'; $use_table = 'table_cow'; include 'database.php'; $query = "UPDATE variables_general SET kind_of_animal='$animal', use_table='$use_table'"; $stmt = $con->prepare($query); $stmt->execute(); $conn=null; ?> name ="animal_button" type = "submit" ></button>
		<button id="goat" value=<?php $animal = 'goat'; $use_table = 'table_goat'; include 'database.php'; $query = "UPDATE variables_general SET kind_of_animal='$animal', use_table='$use_table'"; $stmt = $con->prepare($query); $stmt->execute(); $conn=null; ?> name ="animal_button" type = "submit" ></button>
		<button id="sheep" value=<?php $animal = 'sheep'; $use_table = 'table_sheep'; include 'database.php'; $query = "UPDATE variables_general SET kind_of_animal='$animal', use_table='$use_table'"; $stmt = $con->prepare($query); $stmt->execute(); $conn=null; ?>  name ="animal_button" type = "submit" ></button>
	</div>
	<div id = "down_images"> 
		<button id="pig" value=<?php $animal = 'pig'; $use_table = 'table_pig'; include 'database.php'; $query = "UPDATE variables_general SET kind_of_animal='$animal', use_table='$use_table'"; $stmt = $con->prepare($query); $stmt->execute(); $conn=null; ?> name ="animal_button" type = "submit" ></button>
		<button id="dog" value=<?php $animal = 'dog'; $use_table = 'table_dog'; include 'database.php'; $query = "UPDATE variables_general SET kind_of_animal='$animal', use_table='$use_table'"; $stmt = $con->prepare($query); $stmt->execute(); $conn=null; ?> name ="animal_button" type = "submit" ></button>
	</div>
</form>	

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