<?php
echo '<style>
/* Existing CSS code */
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
    font-family: Arial, sans-serif;
}

th, td {
    border: 1px solid #2c3e50;
    padding: 12px;
    text-align: left;
}

th {
    background-color: green; /* Blue color */
    color: white;
}

.success, .error {
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
}

.success {
    background-color: #2ecc71; /* Green color */
    color: white;
}

.error {
    background-color: #e74c3c; /* Red color */
    color: white;
}
</style>';


$serveur = "localhost";
$utilisateur = "root";
$motdepasse = ""; // Mot de passe si nécessaire, laissez vide si non requis
$base_de_donnees = "donation";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}
echo "Connexion réussie<br>";

$sql = "SELECT * FROM contact"; // La table est corrigée ici (proprietaire au lieu de propriétaire)
$resultat = $connexion->query($sql);

// Vérification de la réussite de la requête
if ($resultat === false) {
    die("Échec de la requête : " . $connexion->error);
}
// Affichage des données de la première requête
echo "<table border='1'>
<tr>
<th>id</th>
<th>Nom</th>
<th>email</th>
<th>message</th>
</tr>";
while ($ligne = $resultat->fetch_assoc()) { 
    echo "<tr>
    <td>" . $ligne['id'] . "</td>
    <td>" . $ligne['nom'] . "</td>
    <td>" . $ligne['email'] . "</td>
    <td>" . $ligne['message'] . "</td>
    </tr>";
}

echo "</table></br>";
$sql = "SELECT * FROM donors"; // La table est corrigée ici (proprietaire au lieu de propriétaire)
$resultat = $connexion->query($sql);

// Vérification de la réussite de la requête
if ($resultat === false) {
    die("Échec de la requête : " . $connexion->error);
}
// Affichage des données de la première requête
echo "<table border='1'>
<tr>
<th>name</th>
<th>last_name</th>
<th>email</th>
<th>payment_metod</th>
<th>card_number</th>
<th>card_cvc</th>
<th>exp_month</th>
<th>exp_year</th>
<th>amount</th>
<th>id</th>
</tr>";
while ($ligne = $resultat->fetch_assoc()) { 
    echo "<tr>
    <td>" . $ligne['name'] . "</td>
    <td>" . $ligne['last_name'] . "</td>
    <td>" . $ligne['email'] . "</td>
    <td>" . $ligne['payment_method'] . "</td>
    <td>" . $ligne['card_number'] . "</td>
    <td>" . $ligne['card_cvc'] . "</td>
    <td>" . $ligne['exp_month'] . "</td>
    <td>" . $ligne['exp_year'] . "</td>
    <td>" . $ligne['amount'] . "</td>
    <td>" . $ligne['id'] . "</td>
    </tr>";
}

echo "</table></br>";



$sql = "SELECT * FROM login"; // La table est corrigée ici (proprietaire au lieu de propriétaire)
$resultat = $connexion->query($sql);

// Vérification de la réussite de la requête
if ($resultat === false) {
    die("Échec de la requête : " . $connexion->error);
}
// Affichage des données de la première requête
echo "<table border='1'>
<tr>
<th>cin</th>
<th>nom</th>
<th>email</th>
<th>password</th>
<th>reset_token</th>

</tr>";
while ($ligne = $resultat->fetch_assoc()) { 
    echo "<tr>
    <td>" . $ligne['cin'] . "</td>
    <td>" . $ligne['nom'] . "</td>
    <td>" . $ligne['email'] . "</td>
    <td>" . $ligne['psw'] . "</td>
    <td>" . $ligne['reset_token'] . "</td>
    </tr>";
}

echo "</table></br>";
$connexion->close();
?>

