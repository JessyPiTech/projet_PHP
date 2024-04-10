<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $sujet = "Nouveau message de contact";

    // Récupérer l'adresse e-mail soumise par l'utilisateur
    $destinataire = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $email = "jessypiquerel3@gmail.com";
    $code_verification = rand(100000, 999999);
    if ($destinataire == '0@gmail.com'){
        $_SESSION['code_verification'] = $code_verification;
        $_SESSION['email'] = $email;
        header("Location: /asset/php/verif-code.php");
        exit; 
    }
    // Verifi si l'adresse est bien ecris
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // En-têtes du mail
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Corps du message
        $message = "Nouveau message de contact de $email, le code est $code_verification";

        // Envoi de l'e-mail
        if (mail($destinataire, $sujet, $message, $headers)) {
            // Stocker le code de vérification dans la session
            $_SESSION['code_verification'] = $code_verification;
            $_SESSION['email'] = $email;

            // Redirection vers la page projet-PHP.php
            header("Location: /asset/php/verif-code.php");
            exit; 
        } else {
            echo "Erreur lors de l'envoi de l'e-mail.";
        }
    } else {
        echo "L'adresse e-mail n'est pas valide. Veuillez entrer une adresse e-mail valide.";
    }
}
?>