<?php
    
    $weather = "";
    $error = "";
    
    if (array_key_exists('city', $_GET)) {
        
        $city = str_replace(' ', '', $_GET['city']);
        
        $file_headers = @get_headers("https://www.timeanddate.com/weather/india/".$city);
        
        
        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    
            $error = "That city could not be found.";

        } else {
        
        $forecastPage = file_get_contents("https://www.timeanddate.com/weather/india/".$city);
       
           
        $pageArray = explode(' class="layout-grid__main tpl-banner__content"><section class=bk-focus><div id=qlook class=bk-focus__qlook><div class=h1>', $forecastPage);
            
        if (sizeof($pageArray) > 1) {
                
                $secondPageArray = explode('</p></div><div class=bk-focus__info><table class="table table--left table--inner-borders-rows"><tbody><tr><th>Location:', $pageArray[1]);
            
                if (sizeof($secondPageArray) > 1) {

                    $weather = $secondPageArray[0];
                    
                } else {
                    
                    $error = "That city could not be found.";
                    
                }
            
            } else {
            
                $error = "That city could not be found.";
            
            }
        
        }
        
    }


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>

    <style type="text/css">
       html { 
          
          background: url(https://as2.ftcdn.net/v2/jpg/00/64/82/29/1000_F_64822947_rwkgNC6sbejwsEtNHgJ08qhBs02D7wyo.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          
        }
        body{
            background:none;
        }
        
        .container {
              
            text-align: center;
            margin-top: 80px;
            width: 450px;
            color:black;
            
              
        }
        .alert {
            display:inline-block;
            color:white:
        }
        
}
          
        input {
              
            margin: 20px 0;
              
        }
        .card {
        margin: 0 auto; 
        float: none; 
        margin-bottom: 10px; 
        background-color:#D4EDDA;
        }
        
        

    </style>
    </head>
    <body>
    <div class="container">
        <h1>What's The Weather?</h1> 
        <form>
        <fieldset class="form-group">
            <label for="city" >Enter the name of a city in India.</label>
            <p> <input type="text" id="city" name="city" placeholder="eg:London, paris"  value = "<?php 
																										   
                                                                                                           if (array_key_exists('city', $_GET)) {
																										   
																										   echo $_GET['city']; 
																										   
																										   }
																										   
																										   ?>"></p>
            <p> <button type="submit" class="btn btn-primary">Submit</button></p>
        </fieldset> 
        </form>

        <div id="weather"> <?php 
              
            if ($weather) 
            {
                  
                echo '<div class="card" style="width: 18rem;">
                        <div class="card-body">
                        <div >'.$weather.'/div>;
                        </div>
                    </div> ';
                
                  
            } else if ($error) {
                  
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                  
            }
              
              ?>   
    </div>                  
    </div>

  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>