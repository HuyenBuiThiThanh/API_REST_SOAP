<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <button onclick="nouveau()">Nouveau</button>
    <a href="connexionAPI.php">Nouveau</a>

    <form action="connexionAPI.php" method="get">
        <input type="text" name="departement" id="">
        <input type="text" name="emplacement" id="">

        <button type="submit">Valider</button>
    </form>

    <?php

    $url = "http://localhost/API_REST/API2.php";

    # $content = file_get_contents($url); #récuperer contenu d'une page pour visualiser OU

    $curl = curl_init(); # initialise la fonction curl

    #ci-dessous fonction execute requête
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $response = json_decode($response);
    #transforme un string qui contient du json en données utilisables

    foreach ($response as $key => $value) {
    ?>
        <h1><?php echo $value->nom_departement ?></h1>
        <h2><?php echo $value->emplacement ?></h2>
        <br>
    <?php

    }

    ?>
</body>

</html>