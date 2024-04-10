<?php
    session_start(); // Démarre la session
    echo "you are not already connecte";
    $connect = isset($_SESSION['connect']) ? $_SESSION['connect'] : null;
    echo $connect;
    if ($connect == true){
        echo "you are already connecte";
        // Redirection vers la page projet-PHP.php
        header("Location: projet-PHP.php");
        exit; // Assure que le script s'arrête après la redirection
    }
?>

<?php require_once "header.php";?>
<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="asset/logiciel/envoyer_email.php" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="email">Adresse e-mail :</label>
                        <input type="email" id="email" name="email" required>
                        <input type="submit" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require_once "footer.php";?>

