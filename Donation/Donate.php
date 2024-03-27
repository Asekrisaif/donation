<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation</title>
    <link rel="stylesheet" href="donate.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<body>
    <div class="wrapper">
        <form action="" method="post">
            <!-- Account Information Start -->
            <h4>Account</h4>
            <div class="input_group">
                <div class="input_box">
                    <input type="text" placeholder="Name" required class="name" name="name">
                    <i class="fa fa-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="text" placeholder="Last Name" required class="name" name="last_name">
                    <i class="fa fa-user icon"></i>
                </div>
            </div>
            <div class="input_group">
                <div class="input_box">
                    <input type="email" placeholder="Email Address" required class="name" name="email">
                    <i class="fa fa-envelope icon"></i>
                </div>
            </div>

            <!-- Payment Details Start -->
            <div class="input_group">
                <div class="input_box">
                    <h4>Donation Details</h4>
                    <input type="radio" name="pay" class="radio" id="bc1" checked>
                    <label for="bc1"><span><i class="fa fa-cc-visa"></i>Credit Card</span></label>
                    <input type="radio" name="pay" class="radio" id="bc2">
                    <label for="bc2"><span><i class="fa fa-cc-paypal"></i>Paypal</span></label>
                </div>
            </div>
            <div class="input_group">
                <div class="input_box">
                    <input type="tel" name="card_number" class="name" placeholder="Card Number 1111-2222-3333-4444" required>
                    <i class="fa fa-credit-card icon"></i>
                </div>
            </div>
            <div class="input_group">
                <div class="input_box">
                    <input type="tel" name="card_cvc" class="name" placeholder="Card CVC 632" required>
                    <i class="fa fa-user icon"></i>
                </div>
            </div>
            <div class="input_group">
                <div class="input_box">
                    <div class="input_box">
                        <input type="number" placeholder="Exp Month" required class="name" name="exp_month">
                        <i class="fa fa-calendar icon" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="input_box">
                    <input type="number" placeholder="Exp Year" required class="name" name="exp_year">
                    <i class="fa fa-calendar-o icon" aria-hidden="true"></i>
                </div>
            </div>
            <div class="input_box">
                <input type="number" placeholder="Enter Amount" required class="name" name="amount">
                <i class="fa fa-money icon" aria-hidden="true"></i>
            </div>
            <!-- Payment Details End -->

            <div class="input_group">
                <div class="input_box">
                    <button type="submit">Faire un don</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "donation";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Form data (without sanitization - make sure to use prepared statements)
    $name = $_POST['name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $paymentMethod = $_POST['pay'];
    $cardNumber = $_POST['card_number'];
    $cardCVC = $_POST['card_cvc'];
    $expMonth = $_POST['exp_month'];
    $expYear = $_POST['exp_year'];
    $amount = $_POST['amount'];

    // Insert data into the database using prepared statements
    $stmt = $conn->prepare("INSERT INTO donors (name, last_name, email, payment_method, card_number, card_cvc, exp_month, exp_year, amount) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([$name, $lastName, $email, $paymentMethod, $cardNumber, $cardCVC, $expMonth, $expYear, $amount]);

    if ($stmt) {
        $_SESSION['email'] = $email;
        echo '<script>alert("Donation successfully submitted!");</script>';
        header("Refresh:2.5;url=pdf.php");
        exit(); // Ensure no more output after header redirect
    } else {
        echo '<script>alert("Error submitting donation. Please try again.");</script>';
    }
}
?>

