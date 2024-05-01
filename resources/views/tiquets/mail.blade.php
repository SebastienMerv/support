<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Bonjour {{ $ticket->user->firstname }},</p>

    <p>Nous vous contactons pour vous informer qu'un nouveau suivi a été ajouté à votre ticket pour l'objet :
        "{{ $ticket->subject }}". Nous avons pris en compte votre demande et travaillons activement pour résoudre votre
        problème dans les
        plus brefs délais.</p>

    <p>Veuillez consulter le suivi ajouté pour obtenir les dernières mises à jour et informations concernant votre
        demande. Si vous avez des questions ou des préoccupations supplémentaires, n'hésitez pas à nous contacter. Nous
        sommes là pour vous aider.</p>

    <p>Nous vous remercions de votre patience et de votre compréhension.</p>

    <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-500">Voir le ticket</a>

    <p>Cordialement,</p>
    <p>Votre équipe de support</p>
</body>

</html>
