<?php
include_once('database.php');
$id = $_GET['id'];

$sql = "SELECT * FROM contacts WHERE contactID = $id";
$stmt = $conn->query($sql);

$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
    <style>
        body {
            padding: 1rem;
        }
        form {
            width: 50%;
        }

        .btn {
            width: 100px;
        }

        form .form-control   {
            border: 1px solid gray;
        }

        ::placeholder {
            color: black;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <h1>Contact bijwerken</h1>
    <form action="" method="post">
        <label for="voornaam" style="font-size: 25px;">Voornaam</label><br>
        <input class="form-control" type="text" name="voornaam" autocomplete="off" placeholder="<?php echo $row['voornaam']?>"><br>
        <label for="achternaam" style="font-size: 25px;">Achternaam</label><br>
        <input class="form-control" type="text" name="achternaam" autocomplete="off" placeholder="<?php echo $row['achternaam']?>"><br>
        <label for="geboortedatum" style="font-size: 25px;">Geboortedatum</label><br>
        <input class="form-control" type="date" name="geboortedatum" autocomplete="off" placeholder="<?php echo $row['geboortedatum']?>"><br>
        <label for="email" style="font-size: 25px;">Email</label><br>
        <input class="form-control" type="email" name="email" autocomplete="off" require placeholder="<?php echo $row['email']?>"><br>
        <label for="telefoonnummer" style="font-size: 25px;">Telefoonnummer</label><br>
        <input class="form-control" type="text" name="telefoonnummer" autocomplete="off" placeholder="<?php echo $row['telefoonnummer']?>"><br>
        <input class="btn btn-primary" name="submit" type="submit" value="Bewerken">
    </form><br>

    <?php
    if (isset($_POST['submit'])) {
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $geboortedatum = $_POST['geboortedatum'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $email = $_POST['email'];


        $sqlUpdate = 'UPDATE contacts SET voornaam = :voornaam, achternaam = :achternaam, email = :email,
                        telefoonnummer = :telefoonnummer, geboortedatum = :geboortedatum WHERE contactID = :contactID';
        $stmt = $conn->prepare($sqlUpdate);

        $params = array (
            'voornaam' => $voornaam,
            'achternaam' => $achternaam,
            'email' => $email,
            'telefoonnummer' => $telefoonnummer,
            'geboortedatum' => $geboortedatum,
            'contactID' => $id
        );
        $stmt->execute($params);
        if ($stmt) {
            echo "<h1>Contact succesvol bijgewerkt</h1>";
        } else {
            echo "<h1>Error</h1>";
        }
    }

    ?>
</body>
</html>