
<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=donation', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function sanitizeInput($input)
{
    return htmlspecialchars(strip_tags(trim($input)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['cin']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['psw'])) {
        $cin = sanitizeInput($_POST['cin']);
        $nm = sanitizeInput($_POST['name']);
        $em = sanitizeInput($_POST['email']);
        $psw = sanitizeInput($_POST['psw']);

        if (!empty($cin) && !empty($nm) && !empty($em) && !empty($psw)) {
            try {
                $checkStmt = $bdd->prepare("SELECT COUNT(*) FROM `login` WHERE `cin` = ?");
                $checkStmt->execute([$cin]);
                $count = $checkStmt->fetchColumn();


                if ($count > 0) {
                    echo '<script>
                            swal({
                                title: "erreur!",
                                text: "Your Cin is already used",
                                icon: "warning",
                            });
                          </script>';
                } else {
                    $insertStmt = $bdd->prepare("INSERT INTO `login` (`cin`, `nom`, `email`, `psw`) VALUES (?, ?, ?, ?)");
                    $insertStmt->execute([$cin, $nm, $em, $psw]);
                    
                    echo '<script>
                            swal({
                                title: "Success!",
                                text: "Your account has been created",
                                icon: "success",
                            });
                          </script>';
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo '<script>
                    swal({
                        title: "Error!",
                        text: "All fields are required",
                        icon: "warning",
                    });
                  </script>';
        }
    }
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cin']) && isset($_POST['psw'])) {
        $cin = sanitizeInput($_POST['cin']);
        $psw = sanitizeInput($_POST['psw']);
        
        if (!empty($cin) && !empty($psw)) {
            $login = $bdd->prepare("SELECT * FROM `login` WHERE `cin` = ? AND `psw` = ?");
            $login->execute([$cin, $psw]);
            $user = $login->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $user;
            $_SESSION['email']= $user;

            if ($user) { 
                $err = "valide";
                header("Refresh: 2.5; url=home.php");
                exit();
            } 
            
            else {
                $err = "psswd ou CIN incorrect";
            }
        } else {
            $err = "remplir les champs";
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
if (isset($_POST['cin']) && isset($_POST['psw'])) {
    $cin = sanitizeInput($_POST['cin']);
    $psw = sanitizeInput($_POST['psw']);
    if($cin==='admin'&&$psw==='admin')
    {
        header("location: adminHomePage.php");
    }
}}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <script src="../js/sweetalert.min.js"></script>
    <title>Sign Up/Sign In</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <div id="msg"></div>
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your Cin for registeration</span>

                <input type="text" placeholder="Cin" name="cin">
                <input type="text" placeholder="Full Name" name="name">
                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="psw">
                <button class="signup">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Or Use Your Cin And Password <br><?php
                if(isset($err)){
                    echo"<p style='color: red;font-size:15px; text-align:center;'>$err</p>";
                   
                }
                ?></span>
                
                <input type="text" placeholder="Cin" name="cin">
                <input type="password" placeholder="Password" name="psw">
                <a href="recover.html">Forget Your Password?</a>
                <button class="signin">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to  Donate</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello</h1>
                    <p> Enter with your personal details </p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="login.js"></script>
</body>
</html>

