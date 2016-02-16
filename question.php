<!-- this is the diagnose screen with question--> 
<!DOCTYPE html>
<html>

<head>
<title>DigiVet</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>


</head>

<div id="question"> 
<?php
include 'database.php';
include 'functions.php';
$table_general = 'variables_general'; 
$table_urgent = 'variables_urgent';
$table_notUrgent = 'variables_not_urgent'; 
$col_urgent = 'urgent';
$col_notUrgent = 'notUrgent'; 
$col_gID = 'general_id'; 
$col_qID = 'question_id'; 
$col_ID = 'id'; 
$col_useTable = 'use_table'; 

$query = "SELECT kind_of_animal FROM variables_general";
$stmt = $con->prepare($query);
$stmt->execute();
$animal = $stmt->fetchColumn();
if ($animal == 'cow'){
	$animal_table = 'table_cow'; 
} 
elseif ($animal == 'goat'){
	$animal_table = 'table_goat'; 
} 
elseif ($animal == 'sheep'){
	$animal_table = 'table_sheep'; 
} 
elseif ($animal == 'pig'){
	$animal_table = 'table_pig'; 
} 
elseif ($animal == 'dog'){
	$animal_table = 'table_dog'; 
} 

$query = "SELECT use_table FROM variables_general";
$stmt = $con->prepare($query);
$stmt->execute();
$use_table = $stmt->fetchColumn();
//print $use_table; 

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

$query = "SELECT general_id FROM $table_general";
$stmt = $con->prepare($query);
$stmt->execute();
$id_general_question = $stmt->fetchColumn();
//print $general_id;

$query = "SELECT question_id FROM $table_general";
$stmt = $con->prepare($query);
$stmt->execute();
$question_id = $stmt->fetchColumn();
//print $question_id;

$query = "SELECT id FROM $table_general";
$stmt = $con->prepare($query);
$stmt->execute();
$id = $stmt->fetchColumn();
//print $id;


if (!(($notUrgent >= 3 AND $urgent ==1)OR($urgent>1))){
	if ($use_table == $animal_table) {
		$query = "SELECT question FROM $animal_table WHERE id = $id";  
		$stmt = $con->prepare($query);
		$stmt->execute();
		$general_question = $stmt->fetch(PDO::FETCH_COLUMN); 
		
		print "<p>" . $general_question . "</p>";  //display question
		$query = "SELECT id_general_question FROM $animal_table WHERE id = $id";  
		$stmt = $con->prepare($query);
		$stmt->execute();
		$id_general_question = $stmt->fetchColumn();
		
		$query = "SELECT audiofile FROM table_general_question WHERE id_general_question = $id_general_question";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$audiofile = $stmt->fetchColumn();
		
		
		if(isset($_GET['choice_button_no'])){
			$query = $con->prepare("SELECT * FROM $animal_table");
			$query->execute();
			$max_general_questions =$query->rowCount();
			$id = $id + 1;
			if ($id <= $max_general_questions){
				update_parameter($id, $col_ID, $table_general); 
				header('Refresh: 0; url=question.php'); // refresh the page
			} 
			elseif ($id > $max_general_questions){
				header("Location: result_system.php"); //go to result page
				exit;
			}
			
		}	
		elseif(isset($_GET['choice_button_yes'])) { 
			$query = "SELECT id_general_question FROM $animal_table WHERE id = $id";  
			$stmt = $con->prepare($query);
			$stmt->execute();
			$id_general_question = $stmt->fetchColumn();
			//print $id_general_question;
			update_parameter($id_general_question, $col_gID, $table_general); 
			
			$query = "SELECT use_table FROM table_general_question WHERE id_general_question = $id_general_question";
			$stmt = $con->prepare($query);
			$stmt->execute();
			$use_table = $stmt->fetchColumn(); 
			update_table($use_table);
			
			//urgent = + 1 en symptom = true
			$query = "SELECT symptom FROM table_general_question WHERE id_general_question = $id_general_question";
			$stmt = $con->prepare($query);
			$stmt->execute();
			$symptom = $stmt->fetchColumn();
			$urgent = $urgent + 1; 
			update_parameter($urgent, $col_urgent, $table_general); 
			$symptom_true = 1; 
			update_symptom($symptom_true, $symptom, $table_urgent); 
			
			header('Refresh: 0; url=question.php'); //refresh the page
		} 
	}	
	elseif ($use_table != $animal_table) { 
		
		$query = $con->prepare("SELECT * FROM $use_table");
		$query->execute();
		$number_rows =$query->rowCount();
		//print $number_rows;
		
		if ($question_id <= $number_rows) {
			$query = "SELECT question FROM $use_table WHERE id_general_question = $question_id";
			$stmt = $con->prepare($query);
			$stmt->execute();
			$question = $stmt->fetch(PDO::FETCH_COLUMN); 
			print "<p>" . $question . "</p>";  //display 
			
			$query = "SELECT audiofile FROM $use_table WHERE id_general_question = $question_id";
			$stmt = $con->prepare($query);
			$stmt->execute();
			$audiofile = $stmt->fetchColumn();
		
			if(isset($_GET['choice_button_yes'])){
				$query = "SELECT symptom FROM $use_table WHERE id_general_question = $question_id";
				$stmt = $con->prepare($query);
				$stmt->execute();
				$symptom = $stmt->fetchColumn();
				
				$result = $con->query('select * from variables_urgent limit 1'); 
				$column_names = array_keys($result->fetch(PDO::FETCH_ASSOC));
					if (in_array($symptom, $column_names, true)) {
						
						$urgent = $urgent + 1; 
						update_parameter($urgent, $col_urgent, $table_general); 
						$symptom_true = 1; 
						update_symptom($symptom_true, $symptom, $table_urgent); 
						
					} 
					else { 
						$notUrgent = $notUrgent + 1; 
						update_parameter($notUrgent, $col_notUrgent, $table_general); 
						$symptom_true = 1; 
						update_symptom($symptom_true, $symptom, $table_notUrgent); 
						
					} 
			
			}
			$question_id = $question_id + 1;	
			update_parameter($question_id, $col_qID, $table_general); 
			
		}	
		elseif ($question_id > $number_rows) {
			$id = $id + 1;	
			update_parameter($id, $col_ID, $table_general); 
			$question_id = $question_id = 1;	
			update_parameter($question_id, $col_qID, $table_general); 
			$use_table = $animal_table; 
			update_table($use_table);
			header('Refresh: 0; url=question.php'); // refresh the page
				
		} 
			
		
		 	
	}
}
else {
	header("Location: result_system.php"); //go to result page
	exit;
}

?>
<?php
echo'
</div> 
<button class="play"></button>
<button class="pause"></button>
<p class = "small" > Click on blue for yes, click on yellow for no.</p>
<form method="get" action="question.php">
<div id="choice"> 

<button type="submit" id="blue" value="yes" name= "choice_button_yes"></button>

<button type="submit" id="yellow" value="no" name = "choice_button_no"></button>

</div> 
</form>	


<body>

<script>
    $(document).ready(function() {
        var audioElement = document.createElement("audio");
        audioElement.setAttribute("src", "' . $audiofile . '");
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
</script>

</body>

</html> 
';
?>