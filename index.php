<?php
include_once('database.php');

$query = "SELECT * FROM contacts";
$stmt = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>
    <title>Document</title>
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
    </style>
</head>
<body>
    <h1>Contactenlijst</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Voornaam</th>
                <th scope="col">Achternaam</th>
                <th scope="col">Geboortedatum</th>
                <th scope="col">Email</th>
                <th scope="col">Telefoonnummer</th>
                <th scope="col">Bewerken</th>
                <th scope="col">Verwijderen</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row['voornaam']."</td>";
                echo "<td>".$row['achternaam']."</td>";
                echo "<td>".$row['geboortedatum']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['telefoonnummer']."</td>";
                echo "<td><a href='update.php?id=" . $row['contactID'] . "'>Bewerken</a></td>";
                echo "<td><a href='delete.php?id=" . $row['contactID'] . "'>Verwijderen</a></td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
    <h1>Contact toevoegen</h1>
    <form action="" method="post">
        <label for="voornaam" style="font-size: 25px;">Voornaam</label><br>
        <input class="form-control" type="text" name="voornaam"><br>
        <label for="achternaam" style="font-size: 25px;">Achternaam</label>
        <input class="form-control" type="text" name="achternaam"><br>
        <label for="geboortedatum" style="font-size: 25px;">Geboortedatum</label>
        <input class="form-control" type="date" name="geboortedatum"><br>
        <label for="email" style="font-size: 25px;">Email</label><br>
        <input class="form-control" type="email" name="email"><br>
        <label for="telefoonnnumer" style="font-size: 25px;">Telefoonnummer</label>
        <input class="form-control" type="text" name="telefoonnummer"><br>
        <input class="btn btn-primary" name="submit" type="submit" value="Toevoegen">
    </form><br>
    <?php
    if (isset($_POST['submit'])) {
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $geboortedatum = $_POST['geboortedatum'];
        $email = $_POST['email'];
        $telefoonnummer = $_POST['telefoonnummer'];


        $sqlInsert = 'INSERT INTO contacts(voornaam, achternaam, email, telefoonnummer, geboortedatum)
                        VALUES (:voornaam, :achternaam, :email, :telefoonnummer, :geboortedatum)';
        $stmt = $conn->prepare($sqlInsert);

        $params = array(
            'voornaam' => $voornaam,
            'achternaam' => $achternaam,
            'email' => $email,
            'telefoonnummer' => $telefoonnummer,
            'geboortedatum' => $geboortedatum
        );
        $stmt->execute($params);

        if ($stmt) {
            echo "<h1 style='text-align:center;font-size:25px'> Contact succesvol toegevoegd in de database</h1>";
        } else {
            echo "<h1 style='text-align:center;font-size:25px'>Error</h1>";
        }
    }
    ?>
</body>
</html>