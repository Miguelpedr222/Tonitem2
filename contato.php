<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = htmlspecialchars($_POST["nome"]);
    $email = htmlspecialchars($_POST["email"]);
    $mensagem = htmlspecialchars($_POST["mensagem"]);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.seudominio.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'seuemail@seudominio.com'; 
        $mail->Password   = 'sua_senha_ou_token';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('seuemail@seudominio.com', 'Site Toni Tem');
        $mail->addAddress('seuemail@seudominio.com'); 

        $mail->isHTML(false);
        $mail->Subject = 'Nova mensagem de contato - Toni Tem';
        $mail->Body    = "Nome: $nome\nEmail: $email\nMensagem:\n$mensagem";
        $mail->addReplyTo($email, $nome);

        $mail->send();
        header("Location: contato.html?status=sucesso");
        exit();
    } catch (Exception $e) {
        error_log("Erro ao enviar e-mail: " . $mail->ErrorInfo);
        header("Location: contato.html?status=erro");
        exit();
    }
} else {
    echo "Método inválido.";
}
