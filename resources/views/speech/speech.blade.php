<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speech Synthesis Example</title>
</head>
<body>
    <h1>Speech Synthesis Example</h1>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var message = new SpeechSynthesisUtterance('NOW SERVING, R-15');
            window.speechSynthesis.speak(message);
        });
    </script>
</body>
</html>
