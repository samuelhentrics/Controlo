<?php
function envoieUnMail($emailEnvoyeur, $emailDestinataire, $sujet, $message, $file)
{

    // if (isset($_POST['emailEnvoyeur']) && isset($_POST['emailDestinataire']) && isset($_POST['sujet']) && isset($_POST['message'])) {
    // $emailEnvoyeur = $_POST['emailEnvoyeur'];
    // $emailDestinataire = $_POST['emailDestinataire'];
    // $sujet = $_POST['sujet'];
    // $message = $_POST['message'];

    // Construction de l'en-tête du message
    $boundary = md5(time());
    $headers = "From: $emailEnvoyeur\r\n";
    $headers .= "Reply-To: $emailEnvoyeur\r\n";
    $headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";

    // Création du corps du message
    $body = "--$boundary\r\n";
    $body .= "Content-type: text/plain; charset=utf-8\r\n";
    $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $body .= $message . "\r\n";


    if (isset($file['name']) && $file['size'] > 0) {
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_type = $file['type'];

        $handle = fopen($file_tmp, "r");
        $content = fread($handle, $file_size);
        fclose($handle);

        $content = chunk_split(base64_encode($content));

        $body .= "--$boundary\r\n";
        $body .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n";
        $body .= $content . "\r\n";
    }

    $body .= "--$boundary--";

    // Envoi de l'email
    if (mail($emailDestinataire, $sujet, $body, $headers)) {
        echo "Votre e-mail a été envoyé avec succès.";
    } else {
        echo "Erreur : Impossible d'envoyer l'e-mail.";
    }
    // }
}
//Example:
if (isset($_POST['emailEnvoyeur']) && isset($_POST['emailDestinataire']) && isset($_POST['sujet']) && isset($_POST['message'])) {
    $emailEnvoyeur = $_POST['emailEnvoyeur'];
    $emailDestinataire = $_POST['emailDestinataire'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];
    $file = $_FILES['file'];

    envoieUnMail($emailEnvoyeur, $emailDestinataire, $sujet, $message, $file);
}

?>