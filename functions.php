<?php

function update_parameter($param, $column, $table){ 
	include 'database.php'; 
	$query = "UPDATE $table SET $column=$param"; 
	$stmt = $con->prepare($query);
	$stmt->execute();
	$conn=null; //flush the database
} 

function update_symptom($param, $column, $table){ 
	include 'database.php'; 
	$query = "UPDATE $table SET '$column'=$param"; 
	$stmt = $con->prepare($query);
	$stmt->execute();
	$conn=null; //flush the database
} 

function update_table($use_table){ 
	include 'database.php'; 
	$query = "UPDATE variables_general SET use_table='$use_table'"; 
	$stmt = $con->prepare($query);
	$stmt->execute();
	$conn=null; 
} 


function refresh_database(){

	include 'database.php';

	// `digivet`.`variables_diseases`
	$variables_diseases = "UPDATE variables_diseases SET PPR_disease=0, Plastic_bags_disease=0, Tetanus_disease=0, Tickborne_disease=0, Brucellosis_disease=0, Anthrax_disease=0, CBPP_disease=0, Black_leg_disease=0, Foot_and_mouth_disease=0, Rabies_disease=0, Dehydration=0, Pneumonia=0, BovineTuberculosis=0";
	$stmt = $con->prepare($variables_diseases);
	$stmt->execute();

	// `digivet`.`variables_general`
	$variables_general = "UPDATE variables_general SET question_id=1, general_id=1, use_table='table_cow', kind_of_animal='cow', urgent=0, notUrgent=0, decision=0, id=1";
	$stmt = $con->prepare($variables_general);
	$stmt->execute();

	// `digivet`.`variables_not_urgent`
	$variables_not_urgent = "UPDATE variables_not_urgent SET wound=0, dropMilkProduction=0, rapidBreathing=0, lossCondition=0, trembling=0, swellingThigh=0, convulsions=0, abortion=0, stillborn=0, weakCalfBorn=0, retentionMembranes=0, fatigue=0, twitchingMuscles=0, anxiousAndEasilyExcited=0, bloat=0, diarrhea=0, drinkingLotsOfWater=0, insects=0, notEnoughFood=0, drinksLitte=0, swollenLymphNodes=0, alteredVocalisation=0, exaggeratedMovements=0, increaseSexualActivity=0, depression=0"; 
	$stmt = $con->prepare($variables_not_urgent);
	$stmt->execute();

	// `digivet`.`variables_urgent`
	$variables_urgent = "UPDATE variables_urgent SET fever=0, highTemperature=0, eyesInOrbid=0, extremelyThin=0, dropHead=0, isolatedFromHerd=0, weightLoss=0, unwillingnessToMove=0, appetiteLoss=0, quiveringLipsAndFrothingMouth=0, blistersTeath=0, lameness=0, difficultBreathing=0, suddenDeath=0, bloodFromOpeningsAfterDeath=0, collapse=0, infectionMembranes=0, swollenTesticles=0, protrudingEyelid=0, spasm=0, hardBallInStomach=0, cough=0, snot=0, aggressive=0, weirdNoises=0, limping=0, bleeding=0, difficultSwallowing=0, blistersMouth=0, blistersFeet=0, seizures=0, pinkMassEye=0";
	$stmt = $con->prepare($variables_urgent);
	$stmt->execute();
	
	
	$conn=null; //flush the database

} 



?>