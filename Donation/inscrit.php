<?php

$bdd = new PDO('mysql:host=localhost;dbname=donation', 'root', '');

$cin = isset($_POST['cin']) ? $_POST['cin'] : null;
$nm = isset($_POST['name']) ? $_POST['name'] : null;
$em = isset($_POST['email']) ? $_POST['email'] : null;
$psw = isset($_POST['psw']) ? $_POST['psw'] : null;

if ($cin && $nm && $em && $psw) {
    $checkStmt = $bdd->prepare("SELECT COUNT(*) FROM `login` WHERE `cin` = ?");
    $checkStmt->execute(array($cin));
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo "Error: User with the same cin already exists. Please try again with a different cin.";
    } else {
        $insertStmt = $bdd->prepare("INSERT INTO `login` (`cin`, `nom`, `email`, `psw`) VALUES (?, ?, ?, ?)");
        $insertStmt->execute(array($cin, $nm, $em, $psw));
        echo "User registered successfully!";
    }
} else {
    echo "Error: All fields are required. Please fill in all the fields.";
}
?>
