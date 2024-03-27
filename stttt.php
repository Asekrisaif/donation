<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Line, Column &amp; Area</title>

    <link href="stat.css" rel="stylesheet">

    <style>
      
        #chart {
      max-width: 600px;
      margin: 35px auto;
    }
      
    </style>

     <script>
      window.Promise ||
        document.write(
          '<script src="js/polyfill.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="js/classList.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="js/findindex_polyfill_mdn"><\/script>'
        )
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    

    <script>
      // Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
      // Based on https://gist.github.com/blixt/f17b47c62508be59987b
      var _seed = 42;
      Math.random = function() {
        _seed = _seed * 16807 % 2147483647;
        return (_seed - 1) / 2147483646;
      };
    </script>

    
  </head>

  <body>
     <div id="chart"></div>
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






	//nattach_msisdn
	
$sql = "SELECT card_cvc,exp_year FROM donors";

	$result = $conn->query($sql);   
       if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if (isset($row["donors"])) {
            $Nbinc_Avril_lun = $row["donors"];
            // Perform further actions...
        } else {
            // Handle case when 'nb_donation' key is not present in the row
        }
    }
       }    
// Vérifiez le résultat de la requête
if (!$result) {
    die("Erreur d'exécution de la requête: " . mysqli_error($conn));
  }
  
  // Fermez la connexion
  mysqli_close($conn);
  ?>
    <script>
      
        var options = {
			 colors: ['red'],	
          series: [ {
          name: 'card_cvc',
          type: 'exp_year',
        data: [<?php echo $Nbinc_Avril_lun; ?>]
        }],
		 
		 chart: {
          height: 350,
          type: 'line',
          dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.2
            
          },
           toolbar: {
            show: true
          }
        },
        colors: ['red'],
        dataLabels: {
          enabled: true,
        },
        stroke: {
          curve: 'smooth'
        },
        title: {
          text: 'Evolution attach reseau',
          align: 'left'
        },
        grid: {
          borderColor: '#e7e7e7',
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        markers: {
          size: 1
        },
        xaxis: {
           categories: ['<?php echo $jmoins7_2 ?>',
           '<?php echo $jmoins6_2 ?>',
           '<?php echo $jmoins5_2 ?>', 
           '<?php echo $jmoins4_2 ?>',
            '<?php echo $jmoins3_2 ?>', 
            '<?php echo $jmoins2_2 ?>',
             '<?php echo $jmoins1_2 ?>'],
 title: {
            
          }
        },
        yaxis: {
         
        },
        legend: {
          position: 'top',
          horizontalAlign: 'center',
          floating: true,
          offsetY: -5
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      </script>

    
  </body>
</html>