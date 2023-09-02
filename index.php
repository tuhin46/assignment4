<?php
if(array_key_exists('submit',$_GET)){
   if(!$_GET['city']){
      $error = "sorry, Your Input Field is Empty";
   }
   if($_GET['city'])
   {
      $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=1a0c40f3fe216a61cc1d38beeacfdd9e");
      $weather = json_decode($apiData, true);
      // C = K - 273.15
      $tempC = $weather['main']['temp'] - 273;
      $weatherarray= "<b>".$weather['name'].", ".$weather['sys']['country']." : ".intval($tempC)."&deg;C</b> <br>";
      $weatherarray .= "<b> Weather Condition : </b>" .$weather['weather']['0']['description']."<br>";
      $weatherarray .= "<b> Atmosperic Pressure : </b>" .$weather['main']['pressure']."hPa <br>";
      $weatherarray .= "<b> Wind Speed : </b>" .$weather['wind']['speed']."meter/sec <br>";
      $weatherarray .= "<b> Cloudness : </b>" .$weather['clouds']['all']."% <br>";
      date_default_timezone_set('Aisa/Dhaka');
      $sunrise = $weather['sys']['sunrise'];
      $weatherarray .= "<b>Sunrise : </b>" .date("g:i a",$sunrise)."<br>";
      $weatherarray .= "<b>Current Time : </b>" .date("F J, Y, g:i a");
      
   }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- css link -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Weather App</title>

</head>

<body>
    <div class="container">
        <h1>Search Global Weather</h1>
        <form action="" method="GET">
            <p><label for="city">Enter Your City Name</label>
            <p>
            <p><input type="text" name="city" id="city" placeholder="City Name"></p>
            <button type="submit" name="submit" class="btn btn-success">Submit Now</button>
            <div class="output mt-3">
                <?php 
                if($weatherarray){
                  echo '<div class="alert alert-success" role="alert"> 
                '.$weatherarray.'
                </div>';
                }
                if($error){
                  echo '<div class="alert alert-danger" role="alert">
                '. $error.'
                </div>';
                }
                
                ?>
            </div>
        </form>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>