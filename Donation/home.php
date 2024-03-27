<?php
session_start();

if (isset($_SESSION['user'])) {
    $userName = $_SESSION['user']['nom'];
} else {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" 
    integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <script src="sweetalert.min.js"></script>
    <title>Goodness</title>
</head>
<body>
    
    <div class="nevbar" id="nevbar" >
        <div class="logo">
            <a href="index.php" id="logo"><h1> Good<span>Ness</span></h1></a>
        </div>
        <div class="menu" id="menu">
            <ul>
                <li><a id="home" href="index.php">Home</a></li>
                <li><a href="#explore">Explore</a></li>
                <li><a href="#service">Service</a></li>
                <li><a href="#contact">Contact</a></li>
                
                <li id="login" class="login dropdown"><span><i class="bi bi-person-fill"></i>&nbsp;<?php echo $userName; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                    <ul>
                        
                        <li><a id="donate" href="Donate.php" target="blank">Donate</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="menuicon">
            <i id="menuicon" onclick="togglemenu()" class="fas fa-chevron-circle-down"> <span>MENU</span></i>
        </div>
      </div>
    
      <div class="bgimage">
        <div class="overplay"></div>
    <div class="cover">

        <div class="information">
            <h1>-</h1>
            <h3>Raising Hope</h3>
            <h2> BONHEUR...C'EST DONNER ET AIDER LES</h2>
            <h1> <span>Autres</span> </h1>
         
            <h1>-</h1>
            <a href="news.html"><button>News</button></a>
       
        </div>

    </div>
    </div>
    <div class="explore" id="explore"></div>

    <div class="about">
        <div class="imgcontanner">
            <div class="aboutimg"></div>
        </div>
        <div class="aboutcontent">
            <h5>_</h5>
            <h1>Why Donate?</h1>
            <p>This pandemic has forced over 6 Million* children to drop off from school. Your contribution can help them reshape their lives by providing for their education.</p>
            <p>We help them get access to learning materials, internist connectivity, laptops, and smartphones to keep the learning alive!</p>
            <a href="Donate.php" target="black">DONATE</a>
            <br>
            <br>
            <h5>_</h5>

        </div>
    </div>

    <!-- ----------------------------------  Service -------------------------------------- -->
    <div class="service" id="service">

        <h5>SERVICES</h5>
        <h1>Our Latest Services</h1>

        <div class="details">

            <div class="info">

                <div class="logo"><i class="fas fa-book-reader"></i></div>
                <p id="head">What we do</p>
                <p>We help empower underprivileged children with quality education.</p>

            </div>

            <div class="info" data-aos="fade-up">

                <div class="logo"><i class="fas fa-book-open"></i></div>
                <p id="head">How we do it</p>
                <p>We helps these children continue their education through digital initiatives.</p>
            </div>

            <div class="info" data-aos="fade-up">

                <div class="logo"><i class="fas fa-book"></i></div>
                <p id="head">Make a difference</p>
                <p>$ 3,000 can help a child build a life and add wings to their dreams</p>

            </div>

            <div class="info" data-aos="fade-up">

                <div class="logo"><i class="fas fa-chart-line"></i></div>
                <p id="head">Lives benefitted so far</p>
                <p>Over 50k+ children have benefitted so far with thousands more to go</p>

            </div>

        </div>

    </div>

    
    <!---------------------------- contact ------------------- -->
    
    <div class="contact" id="contact">
        <h1>CONTACT US</h1>
        <br>
        <div class="contactcontanner">
            
            <div class="contanner">
                <div class="heading">
                    <div class="icon"><i class="far fa-map"></i></div>
                    <div class="info">
                        <p>Address : </p>
                        <p id="contactinfo">aaaaaaaaaaaaaaa</p>
                    </div>
                </div>
                
                <div class="heading">
                    <div class="icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="info">
                        <p>Phone : </p>
                        <p id="contactinfo">+216 58 410 466</p>
                    </div>
                </div>
                
                <div class="heading">
                    <div class="icon"><i class="far fa-envelope"></i></div>
                    <div class="info">
                        <p>Email : </p>
                        <p id="contactinfo">goodness.tunisie@gmail.com</p>
                    </div>
                </div>
            </div>
            
            <div class="messageform">
                <div class="form">
                    <form action="" method="POST">
                        
                        <style>
                            ::placeholder {color: rgba(255, 255, 255, 0.7);}
                        </style>
    
                        <input type="text" name="nom" placeholder="NAME" required>
                        <input type="email" name="email" placeholder="EMAIL" required>
                
                        <textarea type="message" name="message" id="inputbox"  cols="30" rows="5" placeholder="MESSAGE" required></textarea>
                        <button type="submit">SEND MESSAGE</button>
    
                    </form>
                </div>
            </div>

        </div>          
    </div>

    <!-- ------------------------------  Counter  ---------------------------------- -->
    <div class="contercontent">

    <div class="counterbox one">
        <div class="information" data-aos="fade-down">
            <div class="number"><p style="color: rgba(255, 255, 255, 0.9);">27</p></div>
            <div class="text"><p style="color: rgba(255, 255, 255, 0.7);">Year <br> Experienced</p></div>
        </div>
    </div>
    
    <div class="counterbox">
        <div class="information" data-aos="fade-down">
            <div class="number"><p>46,023</p></div>
            <div class="text"><p>children <br> enrolled</p></div>
        </div>
    </div>

    <div class="counterbox">
        <div class="information" data-aos="fade-down">
            <div class="number"><p>189</p></div>
            <div class="text"><p>Mission <br> Education Centres</p></div>
        </div>
    </div>

    <div class="counterbox">
        <div class="information" data-aos="fade-down">
            <div class="number"><p>21</p></div>
            <div class="text"><p>States <br> Across The World</p></div>
        </div>
    </div>

    </div>



    <footer>
        <p><strong> devlopedd by Maram and Saif </strong> | <strong>All right reserved 2023</strong></p>
    </footer>
    <script>
        var menu = document.getElementById("menu");
        menu.style.maxHeight = "0px";
        function togglemenu() {
            if (menu.style.maxHeight == "0px") {
                menu.style.maxHeight = "390px";
            }
            else {
                menu.style.maxHeight = "0px";
            }
        }
    </script>

</body>
</html>



<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all form fields are set
    if (isset($_POST['nom'], $_POST['email'], $_POST['message'])) {
        $serveur = "localhost";
        $utilisateur = "root";
        $motdepasse = ""; // Empty if no password is set
        $base_de_donnees = "donation";

        // Connect to the database
        try {
            $bdd = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $motdepasse);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit();
        }

        // Sanitize and validate user inputs
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $insertion = $bdd->prepare('INSERT INTO contact (nom, email, message) VALUES (?, ?, ?)');
        $insertion->execute([$nom, $email, $message]);


if ($insertion) {
    echo '<script>
                            swal({
                                title: "Success!",
                                text: "message envoyé",
                                icon: "success",
                            });
                          </script>';
    exit();
} else {
    echo '<script>
                            swal({
                                title: "errru!",
                                text: "echec",
                                icon: "warning",
                            });
                          </script>';
    exit();
}
    }
}
?>