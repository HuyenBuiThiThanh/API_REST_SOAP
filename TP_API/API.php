
<?php
//tao ra API voi 1 chuc nang lay ra tat ca cac thong tin cua employe
try {
    $dbh = new PDO('mysql:host=localhost;dbname=ittest', "root", "");
} catch (PDOException $e) {
}

$test = $dbh->prepare('SELECT * FROM employes');
$test->execute();
$retour = $test->fetchAll();

echo json_encode($retour, JSON_UNESCAPED_UNICODE);
