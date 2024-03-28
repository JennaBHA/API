<?php

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "pharmacie";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Récupérer tous les médicaments
function getAllMedicaments($conn) {
    $stmt = $conn->prepare("SELECT * FROM medicaments");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer un médicament par son ID
function getMedicamentByID($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM medicaments WHERE MedicamentID = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Exemple d'utilisation : récupérer tous les médicaments
$medicaments = getAllMedicaments($conn);
echo json_encode($medicaments);

// Exemple d'utilisation : récupérer un médicament par son ID
$medicament = getMedicamentByID($conn, 1);
echo json_encode($medicament);

?>
