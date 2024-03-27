




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/payment.css">

</head>

<body>

    <div class="container">
        <div class="card-container">
            <div class="front">
                <div class="image">
                    <img src="../images/chip.png" alt="">
                    <img src="../images/visa.png" alt="">
                </div>
                <div class="card-number-box">################</div>
                <div class="flexbox">
                    <div class="box">
                        <span>card holder</span>
                        <div class="card-holder-name">full name</div>
                    </div>
                    <div class="box">
                        <span>expires</span>
                        <div class="expiration">
                            <span class="exp-month">mm</span>
                            <span class="exp-year">yy</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="back">
                <div class="stripe"></div>
                <div class="box">
                    <span>cvv</span>
                    <div class="cvv-box"></div>
                    <img src="image/visa.png" alt="">
                </div>
            </div>

        </div>

        <form action="" method="post">
            <div class="inputBox">
                <input type="text" maxlength="16" name="cn" class="card-number-input" placeholder="card number">
            </div>
            <div class="inputBox">
                <input type="text" class="card-holder-input" name="ch" placeholder="card holder">
            </div>
            <div class="flexbox">
                <div class="inputBox">
                    <span>expiration mm</span>
                    <select name="exm" id="" class="month-input">
                        <option value="month" selected disabled>month</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>expiration yy</span>
                    <select name="exy" id="" class="year-input">
                        <option value="year" selected disabled>year</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
                </div>
                <div class="inputBox" name="cvv">
                    <span>cvv</span>
                    <input type="text" maxlength="4" class="cvv-input">
                </div>
            </div>
            <input type="submit" value="Pay" class="submit-btn" name="btn">
        </form>

    </div>






    <script>
        document.querySelector('.card-number-input').oninput = () => {
            document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
        }

        document.querySelector('.card-holder-input').oninput = () => {
            document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
        }

        document.querySelector('.month-input').oninput = () => {
            document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
        }

        document.querySelector('.year-input').oninput = () => {
            document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
        }

        document.querySelector('.cvv-input').onmouseenter = () => {
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
        }

        document.querySelector('.cvv-input').onmouseleave = () => {
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
        }

        document.querySelector('.cvv-input').oninput = () => {
            document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
        }
    </script>

</body>

</html>


<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=agencevoyage', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$reservation_id = isset($_GET['reservation_id']) ? $_GET['reservation_id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn'])) {
    $ch = isset($_POST['ch']) ? $_POST['ch'] : null;
    $cn = isset($_POST['cn']) ? $_POST['cn'] : null;
    $exm = isset($_POST['exm']) ? $_POST['exm'] : null;
    $exy = isset($_POST['exy']) ? $_POST['exy'] : null;
    $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : null;

    if (empty($ch) && empty($cn) && empty($exm) && empty($exy) && empty($cvv)) {
        echo "<script>
                swal({
                    title: 'Erreur!',
                    text: 'All fields are required!',
                    icon: 'warning',
                });
            </script>";
        exit;
    } else {
        $selectStmt = $bdd->prepare("SELECT prix FROM reservation WHERE id_reser = ?");
        $selectStmt->execute([$reservation_id]);
        $reservation = $selectStmt->fetch(PDO::FETCH_ASSOC);

        if ($reservation) {
            $prix = $reservation['prix'];
            $date = date('Y-m-d H:i:s');

            $insertStmt = $bdd->prepare("INSERT INTO `payment` (`prix`, `date`, `id_reser`) VALUES (?, ?, ?)");
            $insertStmt->execute([$prix, $date, $reservation_id]);

            if ($insertStmt->rowCount() > 0) {
                $updateStmt = $bdd->prepare("UPDATE `reservation` SET `payment` = 'Paid' WHERE `id_reser` = ?");
                $updateStmt->execute([$reservation_id]);

                if ($updateStmt->rowCount() > 0) {
                    echo "<script>
                            swal({
                                title: 'Success!',
                                text: 'Payment successful!',
                                icon: 'success',
                            });
                            setTimeout(function () {
                                window.location.href = 'ticket.php';
                            }, 2500);
                        </script>";
                } else {
                    echo "<script>
                            swal({
                                title: 'Erreur!',
                                text: 'Failed to update reservation status!',
                                icon: 'error',
                            });
                            setTimeout(function () {
                                window.location.href = 'ticket.php';
                            }, 2500);
                        </script>";
                }
            } else {
                echo "<script>
                        swal({
                            title: 'Erreur!',
                            text: 'Failed to insert payment details!',
                            icon: 'error',
                        });
                        setTimeout(function () {
                            window.location.href = 'ticket.php';
                        }, 2500);
                    </script>";
            }
        } else {
            echo "<script>
                    swal({
                        title: 'Erreur',
                        text: 'No reservation found!',
                        icon: 'warning',
                    });
                    setTimeout(function () {
                        window.location.href = 'ticket.php';
                    }, 2500);
                </script>";
        }
    }
}
?>
