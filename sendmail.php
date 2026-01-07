<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $to = "allo@allocumulus.fr, stevens.letourneur@gmail.com";
    $subject = "Demande depuis le site";

    $message = "Nom: " . $data['name'] . "\\n";
    $message .= "Email: " . $data['email'] . "\\n";
    $message .= "Téléphone: " . $data['phone'] . "\\n";
    $message .= "Service: " . $data['service'] . "\\n";
    $message .= "Urgence: " . $data['urgency'] . "\\n";
    $message .= "Message:\\n" . $data['message'];

    $headers = "From: " . $data['email'] . "\\r\\n";
    $headers .= "Reply-To: " . $data['email'] . "\\r\\n";

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["success" => true, "message" => "Message envoyé avec succès."]);
    } else {
        echo json_encode(["success" => false, "message" => "Échec de l'envoi du message."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données invalides."]);
}
?>
