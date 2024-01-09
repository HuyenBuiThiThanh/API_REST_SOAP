<?php
//tao ra API voi 1 chuc nang lay ra tat ca cac thong tin cua employe
try {
    $dbh = new PDO('mysql:host=localhost;dbname=ittest', "root", "");
} catch (PDOException $e) {
}

// Chức năng lấy toàn bộ thông tin của nhân viên
$employes = $dbh->prepare('SELECT * FROM employes');
$employes->execute();
$employesData = $employes->fetchAll();

// Hiển thị thông tin của nhân viên dưới dạng JSON
echo json_encode($employesData, JSON_UNESCAPED_UNICODE);

// Chèn lại toàn bộ dữ liệu của nhân viên vào bảng employes cua Flo
// try {
//     // Kết nối đến cơ sở dữ liệu MySQL trên máy chủ khác trong cùng mạng
//     $dbh_remote = new PDO('mysql:host=10.21.6.23;dbname=ittest', "root", "");
// } catch (PDOException $e) {
//     // Xử lý lỗi kết nối
// }

try {
    // Kết nối đến cơ sở dữ liệu MySQL trên máy chủ khác trong cùng mạng
    $dbh_remote = new PDO('mysql:host=10.21.6.23;dbname=ittest', "root", "");
    $dbh_remote->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Bật chế độ báo lỗi chi tiết
} catch (PDOException $e) {
    // Xử lý lỗi kết nối
    echo "Kết nối không thành công với máy chủ khác: " . $e->getMessage();
    exit(); // Thoát khỏi chương trình nếu kết nối không thành công
}

foreach ($employesData as $employee) {
    $nom = $employee['nom'];
    $prenom = $employee['prenom'];
    $departement_id = $employee['departement_id'];
    $poste = $employee['poste'];
    $date_embauche = $employee['date_embauche'];
    $salaire = $employee['salaire'];

    // Chèn dữ liệu vào bảng employes
    // $insertQuery = $dbh->prepare('INSERT INTO `employes`(`nom`, `prenom`, `departement_id`, `poste`,`date_embauche`,`salaire`) VALUES ("' . $nom . '", "' . $prenom . '","' . $departement_id . '","' . $poste . '","' . $date_embauche . '","' . $salaire . '")');
    $insertQuery = $dbh_remote->prepare('INSERT INTO `employes`(`nom`, `prenom`, `departement_id`, `poste`,`date_embauche`,`salaire`) VALUES ("' . $nom . '", "' . $prenom . '","' . $departement_id . '","' . $poste . '","' . $date_embauche . '","' . $salaire . '")');

    // $insertQuery = $dbh_remote->prepare('INSERT INTO `employes`(`nom`, `prenom`, `departement_id`, `poste`, `date_embauche`, `salaire`) 
    // VALUES (:nom, :prenom, :departement_id, :poste, :date_embauche, :salaire)');
    $insertQuery->bindParam(':nom', $nom);
    $insertQuery->bindParam(':prenom', $prenom);
    $insertQuery->bindParam(':departement_id', $departement_id);
    $insertQuery->bindParam(':poste', $poste);
    $insertQuery->bindParam(':date_embauche', $date_embauche);
    $insertQuery->bindParam(':salaire', $salaire);

    try {
        $insertQuery->execute();
    } catch (PDOException $ex) {
        // Xử lý lỗi khi chèn dữ liệu
        echo "Lỗi khi chèn dữ liệu: " . $ex->getMessage();
    }
}

// Lấy lại toàn bộ dữ liệu từ bảng employes sau khi chèn
$newEmployesQuery = $dbh_remote->prepare('SELECT * FROM employes');
$newEmployesQuery->execute();
$newEmployesData = $newEmployesQuery->fetchAll();
echo json_encode($newEmployesData, JSON_UNESCAPED_UNICODE);
