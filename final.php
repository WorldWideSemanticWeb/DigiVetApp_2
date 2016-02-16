<!-- this is the final screen --> 
<!DOCTYPE html>
<html>

<head>
<title>DigiVet</title>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<h1>Thank you for using DigiVet. </h1>
<p> Would you like to return to the homescreen? </p>
<p class="small"> Press blue for yes, or yellow for no.</p>

<form action="start.php">
	<button type="submit" id="vet_blue"></button>
</form>

<form method="get" action="black.php">  <!-- should be changed to shutdown of the system if possible --> 
	<button type="submit" id="vet_yellow"></button>
</form>
<script>
    $(document).ready(function() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'sounds/final.mp3');
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