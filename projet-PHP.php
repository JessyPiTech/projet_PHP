<?php
// Start or resume the session
session_start();


if (!isset($_SESSION['connect']) || !$_SESSION['connect']) {
    header("Location: verif-code.php"); 
    exit(); 
}
require_once "header.php";
//ou sinon include 'footer...'
?>
    <main>
        <div class="container mt-5">
            <center><h1>Are you a worker ?</h1><center>
            <br>
            <br>
            <div style="display: flex;align-items: center;justify-content: space-around;">
                <form  method="post" action="projet-PHP.php" id="formNom">
                    <div class="form-group">
                        <label for="test">name of worker :</label>
                        <input type="text" class="form-control" id="test" name="test" required>
                        <input type="hidden" class="form-control" id="id" name="id" value="0"required>
                    </div>
                    <button type="submit" class="btn btn-primary">Verification</button>
                </form>
                <form method="post" action="projet-PHP.php" id="formId" style="display: none;">
                    <div class="form-group">
                        <label for="test">ID of worker :</label>
                        <input type="hidden" class="form-control" id="test" name="test" value="0"required>
                        <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Vérifier</button>
                </form>
            </div>
            <br>
            <label class="switch">
                <input onclick="changeFOrms()" type="checkbox">
                <span></span>
            </label>
            <div class="resultat" id="resultat"></div>
        </div>
    </main>

<script>
    // Your JavaScript code
    function changeForms() {
        var formNom = document.getElementById("formNom");
        var formId = document.getElementById("formId");

        if (formNom.style.display === "none") {
            formNom.style.display = "block";
            formId.style.display = "none";
        } else {
            formNom.style.display = "none";
            formId.style.display = "block";
        }
    }
</script>

<?php
// Include the footer
require_once "footer.php";
?>
<?php
// tableau de tableau d'employés avec nom, salaire et id
$employes = [
    ["id" => "1", "nom" => "alice", "salaire" => 50000],
    ["id" => "2", "nom" => "bob", "salaire" => 60000],
    ["id" => "3", "nom" => "charlie", "salaire" => 55000],
    ["id" => "4", "nom" => "david", "salaire" => 52000],
    ["id" => "5", "nom" => "eve", "salaire" => 70000]
];


function verifiEmploye($nom,$id, $employes) {
    if ($id == "0")  {
        foreach ($employes as $employe) {
            if ($employe['nom'] === $nom) {
                return $employe;
            }
        }
    } elseif ($nom == "0"){
        foreach ($employes as $employe) {
            if ($employe['id'] === $id) {
                return $employe;
            }
        }
    }
    return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $test = $_POST["test"];
    $resultat = verifiEmploye($test, $id, $employes);
    if ($resultat !== null) {
        $message = "<div class='alert alert-success'>{$resultat['nom']} is a worker. ID: {$resultat['id']}, Salary: {$resultat['salaire']}</div>";
    } elseif ($id == "0") {
        $message = "<div class='alert alert-danger'>$test is not an employee.</div>";
    } else {
        $message = "<div class='alert alert-danger'>The worker with ID: $test doesn't exist.</div>";
    }
    $script = "<script>document.getElementById('resultat').innerHTML = '" . addslashes($message) . "';</script>";
    echo $script;
}
?>