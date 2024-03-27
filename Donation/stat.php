<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statitiques</title>
    <link rel="stylesheet" href="stat.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div>
  <canvas id="myChart"></canvas>
</div>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dataPoints = array(); // Initialize an array to hold data

$result = $conn->query("SELECT pays, nombre FROM nb_donation");

if ($result->num_rows > 0) {
    // Fetch data and store it in the $dataPoints array
    while ($row = $result->fetch_assoc()) {
        $dataPoints[] = array("pays" => $row['pays'], "nombre" => $row['nombre']);
    }
}
?>

<script>
    const data = <?php echo json_encode($dataPoints); ?>;

    const labels = data.map(item => item.pays);
    const values = data.map(item => item.nombre);

    const config = {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de Donation',
                backgroundColor: 'rgba(255,99,132,0.2)',
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1,
                data: values
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
</body>
</html>
