<?php
// Kết nối CSDL
try {
    $dbh = new PDO('mysql:host=localhost;dbname=ittest', "root", "");
} catch (PDOException $e) {
    // Xử lý lỗi kết nối
    echo "Error: " . $e->getMessage();
    die();
}

$isSuprimer = false;
$nomDepartement = "";

if (isset($_GET['nomDepartement'])) {
    $nomDepartement = $_GET['nomDepartement'];
}

if (isset($_GET['isSuprimer'])) {
    $isSuprimer = true;
}

if ($isSuprimer) {
    $deleteQuery = $dbh->prepare("DELETE FROM departements WHERE nom_departement = :nomDepartement");
    $deleteQuery->bindParam(':nomDepartement', $nomDepartement, PDO::PARAM_STR);
    $deleteQuery->execute();
}

$selectQuery = $dbh->prepare('SELECT * FROM departements');
$selectQuery->execute();
$retour = $selectQuery->fetchAll();
echo json_encode($retour, JSON_UNESCAPED_UNICODE);
