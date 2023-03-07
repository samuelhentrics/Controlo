
<?php 
    $message = "Bonjour,
Nous vous informons que votre e-mail a été envoyé avec succès via l'application Controlo. Ce message a été généré automatiquement pour vous informer de l'envoi réussi de votre e-mail. Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter. 
Cordialement,

L'équipe Controlo.";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Contactez-nous</h2>
    <form action="mailSend.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" class="form-control" id="nom" placeholder="Enter votre nom" name="nom">
        </div>
        <div class="form-group">
            <label for="email">Envoye depuis cette adresse e-mail:</label>
            <input type="email" class="form-control" id="email_env" placeholder="Enter votre adresse e-mail" name="emailEnvoyeur">
        </div>
        <div class="form-group">
            <label for="email">Destinataire adresse e-mail:</label>
            <input type="email" class="form-control" id="email_dest" placeholder="Enter votre adresse e-mail" name="emailDestinataire">
        </div>
        <div class="form-group">
            <label for="sujet">Sujet:</label>
            <input type="text" class="form-control" id="sujet" placeholder="Enter le sujet" name="sujet">
        </div>
        <div class="form-group">
        <input type="file" name="file"> <br>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" rows="5" id="message" value="<?php echo $message;?>" placeholder="Enter le message" name="message"><?php echo $message;?></textarea>
        </div>
        <button type="submit" class="btn btn-default">Envoyer</button>
    </form>
</div>
</body>
</html>