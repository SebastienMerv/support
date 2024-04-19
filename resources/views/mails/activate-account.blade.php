<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation de compte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }
        h1 {
            font-size: 24px;
            margin: 0;
            text-align: center;
            padding-bottom: 20px;
        }
        p {
            margin: 0 0 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Activation de compte</h1>
        <p>Bienvenue sur le Support ! Pour activer votre compte, veuillez cliquer sur le lien ci-dessous :</p>
        <p><a href="{{ route('token', ['token' => $user->remember_token]) }}" class="btn">Activer mon compte</a></p>
        <p>Si le bouton ne fonctionne pas, vous pouvez copier et coller le lien suivant dans votre navigateur :</p>
        <p>LIEN_D_ACTIVATION</p>
        <p>Merci !</p>
        <p>L'équipe de [Votre Entreprise]</p>
    </div>
</body>
</html>
