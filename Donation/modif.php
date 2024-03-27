<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
/* Existing CSS code */
*{
    background-color:grey;
}
table {
    
    border-collapse: collapse;
    width: 80%;
    margin-top: 180px;
    margin-left:150px;
    font-family: Arial, sans-serif;
    
}

th, td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e2e2e2;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 3px;
        }

        .delete-button:hover {
            background-color: #d32f2f;
        }

        h3 {
            text-align: center;
            margin-top: 80px;
            text-align:center;
            margin-left:150px;
        }
</style>
</head>
<body>  
<div class="nevbar" id="nevbar" >
    
        <div class="logo">
            
            <a href="index.php" id="logo"><h1> Good<span>Ness</span></h1></a>
            <h3>Liste des comptes a supprimés:</h3>

        </div>
</div>
       
</body>
</html>
<?php

class login
{
    private $conn;

    // Constructeur pour établir la connexion à la base de données
    public function __construct($host, $username, $password, $database)
    {
        $this->conn = new mysqli($host, $username, $password, $database);
        if ($this->conn->connect_error) {
            die("La connexion à la base de données a échoué : " . $this->conn->connect_error);
        }
    }

    // Méthode pour supprimer un propriétaire
    public function supprimerlogin($cin)
    {
        $req = "DELETE FROM login WHERE cin='$cin'";
        $res = $this->conn->query($req);
        if ($res) {
            echo "<br>";
        } else {
            echo "Erreur lors de la suppression du compte: " . $this->conn->error . "<br>";
        }
    }

    // Méthode pour afficher la liste des propriétaires dans un tableau
    public function afficherListeProprietaires()
    {
        $query = "SELECT * FROM login";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>cin</th><th>Nom</th><th>email</th><th>psw</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["cin"] . "</td>";
                echo "<td>" . $row["nom"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["psw"] . "</td>";
                echo "<td><form method='post'><button class='delete-button' type='submit' name='delete' value='" . $row["cin"] . "'>Delete</button></form></td>";
                echo "</tr>";
            }
            echo "</table>";

            // Check if the delete button is clicked
            if (isset($_POST['delete'])) {
                $cinToDelete = $_POST['delete'];
                $this->supprimerlogin($cinToDelete);
                // Refresh the page after deletion
                echo "<meta http-equiv='refresh' content='0'>";
            }
        } else {
            echo "Aucun compte trouvé.<br>";
        }
    }
}

// Exemple d'utilisation
$proprioManager = new login("localhost", "root", "", "donation");

// Afficher la liste des propriétaires supprimés
$proprioManager->afficherListeProprietaires();
?>
