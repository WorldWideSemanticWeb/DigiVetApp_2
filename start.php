<!-- this is the welcome screen --> 
<!DOCTYPE html>
<html>

<head>
<title>DigiVet</title>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

<h1> Welcome to Digivet.</h1>

<p> Click on the cross to diagnose your animal. Click on the question mark to receive general information. </p>  

<a href="animal_screen.php"><img src="images/red_cross.png"></a>
<a href="animal_screen2.php"><img src="images/question_mark.png"></a>

<script>
    $(document).ready(function() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'sounds/welcome.mp3');
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