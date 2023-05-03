<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    $to = $email;
    $subject = "Nova mensagem de " . $nome;
    $message = "Nome: " . $nome . "\n";
    $message .= "E-mail: " . $email . "\n";
    $message .= "Mensagem: " . $mensagem;

    // Replace with your SendGrid API key and email address
    $apiKey = 'YOUR_SENDGRID_API_KEY';
    $from = 'YOUR_EMAIL_ADDRESS';

    // Prepare the headers
    $headers = array(
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    );

    // Prepare the payload
    $payload = json_encode(array(
        'to' => $to,
        'from' => $from,
        'subject' => $subject,
        'text' => $message
    ));

    // Send the email using SendGrid API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    echo "<script>alert('Mensagem enviada com sucesso!'); window.location='index.html';</script>";
}
?>
