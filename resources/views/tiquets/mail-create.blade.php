<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Votre ticket as bien été créé</title>
</head>
<body>
    <h1>Bonjour {{ $ticket->user->firstname }},</h1>
    <p>Votre ticket as bien été créé. Celui-ci sera traité dans les plus brefs délais.</p>
    <p>Cordialement,</p>
    <p>L'équipe du support</p>
</body>
</html>