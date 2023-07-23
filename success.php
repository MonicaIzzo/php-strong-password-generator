<?php
// Avvio la sessione
session_start();

//controllo se ho la password
if (!isset($_SESSION['password'])) {

    //controllo se non c'è rimando all'index
    header('Location: index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" content="Monica Izzo">
    <title>PHP Strong Password Generator | Success</title>

    <!-- icon-->
    <link rel="icon" type="image/png" sizes="32x32" href="img/faicon.png">

    <!-- stylesheet -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <div class="container mb-3 pt-3">
            <div class="row justify-content-center">
                <div class="alert alert-info">
                    La tua password è: <strong><?= $_SESSION['password'] ?></strong>
                </div>
            </div>
        </div>
    </div>
</body>

</html>