<?php
class Utilisateur
{
    public $nom = "Dupont";
    public $prenom = "Jean";
    public $age = 30;
    // public $adresse;

    public $adresse = [
        "rue" => "123 rue de la République",
        "ville" => "lyon",
        "codePostal" => "69000"
    ];

    public $hobbies = ["lecture", "voyage", "jardinage"];
}

// class adresse
// {
//     public $rue = "rue de la République";
//     public $ville = "Paris";
//     public $codePostal = "75001";
// }

$retour = new Utilisateur();
// $adresse = new adresse();
// $retour->adresse = $adresse;


// echo "<br>";
//  print_r($retour);
// echo json_encode($retour, JSON_UNESCAPED_UNICODE);


echo "<br>";
$retour->age = $retour->age + 3;
// print_r($retour);
echo json_encode($retour, JSON_UNESCAPED_UNICODE);


// thay doi age vao 1 gia tri moi
$test = $_GET;
$newAge = $test['age'];
$retour = new Utilisateur();
$retour->age = $retour->age + $newAge;
echo "<br>";
print_r($retour);
echo "<br>";
echo json_encode($retour, JSON_UNESCAPED_UNICODE);


// thay doi gia tri nom moi vao URL theo cau truc: ...&nom=huyen -> thay doi données hien thi 
$retour = new Utilisateur();
if (isset($_GET["nom"])) {
    $retour->nom = $_GET["nom"];
}
echo "<br>";
echo json_encode($retour, JSON_UNESCAPED_UNICODE);

// thay doi gia tri prenom moi vao URL theo cau truc: ...&prenom=huyen -> thay doi données hien thi 
$retour = new Utilisateur();
if (isset($_GET["prenom"])) {
    $retour->prenom = $_GET["prenom"];
}
echo "<br>";
echo json_encode($retour, JSON_UNESCAPED_UNICODE);

// thay doi gia tri age moi vao URL theo cau truc &age=30
$retour = new Utilisateur();
if (isset($_GET["age"])) {
    $retour->age = $_GET["age"];
}
echo "<br>";
echo json_encode($retour, JSON_UNESCAPED_UNICODE);



// thay doi thong so Rue ="test" chu dong trong file php (k can thay doi tren URL)-> thay doi données hien thi 
$retour->adresse['rue'] = "test";
echo "<br>";
echo json_encode($retour, JSON_UNESCAPED_UNICODE);

// thay doi gia tri ville, codePostal moi vao URL theo cau truc: ...&ville=Villeurbanne -> thay doi données hien thi, in ra ville Villeurbanne
echo "<br>";
echo json_encode($retour, JSON_UNESCAPED_UNICODE);
if (isset($_GET["ville"])) {
    $retour->adresse["ville"] = $_GET["ville"];
}
if (isset($_GET["codePostal"])) {
    $retour->adresse["codePostal"] = $_GET["codePostal"];
}

// thay doi gia tri hobbies moi vao URL theo cau truc: ...&hobbies1=fot1&hobbies2=fot2&hobbies3=fot3 -> thay doi données hien thi, in ra ville 
if (isset($_GET["hobbies1"])) {
    $retour->hobbies[0] = $_GET["hobbies1"];
} else {
    $retour->hobbies[0] = "";
}
if (isset($_GET["hobbies2"])) {
    $retour->hobbies[1] = $_GET["hobbies2"];
} else {
    $retour->hobbies[1] = "";
}
if (isset($_GET["hobbies3"])) {
    $retour->hobbies[2] = $_GET["hobbies3"];
} else {
    $retour->hobbies[2] = "";
}
echo "<br>";
echo json_encode($retour, JSON_UNESCAPED_UNICODE);
