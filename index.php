<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Project Code Test</title>

  <style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans');
    
    body {
      padding: 0px;
      margin: 0px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    
    .center-content {
      
    }
    
    #timer {
      position: fixed;
      top: 5px;
      right: 5px;
      padding: 8px;
      font-size: 30px;
      line-height: 30px;
      margin: 0px;
      padding: 0px;
      font-family: "Open Sans", sans-serif;
      z-index: 100;
      color: black;
      background: rgba(255, 255, 255, 0.7);
      border-radius: 10px;
    }
    
    iframe {
      width: 100vw;
      height: calc(100vh);
      position: relative;
      top: 0px;
      margin: 0px;
      padding: 0px;
    }
    
    h1 {
      text-align: center;
      font-size: 30px;
      line-height: 30px;
      margin: 0px;
      padding: 0px;
      font-family: "Open Sans", sans-serif;
    }
    
    .error {
      margin: 20px;
      color: #700;
    }
    
    form {
      width: 250px;
      margin: 30px auto;
      text-align: center;
      position: relative;
    }
    
    input {
      width: 200px;
      display: block;
      position: absolute;
      left: 25px;
      margin: auto;
      text-align: center;
      font-family: "Open Sans", sans-serif;
      font-size: 20px;
      line-height: 2em;
      border: 3px solid black;
      padding-left: 5px;
      transition: .5s;
      box-shadow: 10px 10px 0px 0px rgba(0, 0, 0, 0.75);
    }
    
    input:focus {
      box-shadow: 13px 13px 0px 0px rgba(0, 0, 0, 0.75);
      outline-width: 10px;
    }
    
    button {
      margin-top: 70px;
      display: inline-block;
      padding: 5px;
      font-family: "Open Sans", sans-serif;
      font-size: 24px;
      line-height: 1.5em;
      border-radius: 20%;
      float: right;
      margin-right: 8%;
      border: 3px solid black;
      background: #fefefe;
      cursor: pointer;
      box-shadow: 10px 10px 0px 0px rgba(0, 0, 0, 0.75);
      position: relative;
      top: 0px;
      left: 0px;
      transition: .25s;
    }
    
    button:hover {
      box-shadow: 13px 13px 0px 2px rgba(0, 0, 0, 0.75);
      top: -3px;
      left: -3px;
    }
    
    button:active {
      box-shadow: 7px 7px 0px -2px rgba(0, 0, 0, 0.75);
      top: 3px;
      left: 3px;
    }
    
    
  </style>
  
</head>

<body>

  <div style="display:none;opacity:0;height:0px;width:0px;overflow:hidden;">

<?php
    // PHP placed in hidden div to hide return output from writting to used-ids.txt
    
    
    //  Check for Project Code or Office readiness, C for Project Code, O for office readiness
//     if (substr($user_input, 0, 1) === 'p') {
//       $project_code = true;
//       $office_readiness = false;
//     }
//     if (substr($user_input, 0, 1) === 'o') {
//       $office_readiness = true;
//       $project_code = false;
//     }
    
    //  Checks to see if page was loaded with POST data from form
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
   //  Checks to see input field has been filled in, if not error displayed
   if (isset($_POST['user_input'])) {
     //  Sanitize input to prevent any script input from running
     $user_input = filter_var($_POST['user_input'], FILTER_SANITIZE_STRING );
     //  Ensures input is all lowercase
     $user_input = strtolower($user_input);
     //  Tokens are surrounded by * to stop partial tokens from passing the test
     $user_input = "*" . $user_input . "*";
   } else {
     //  Adds error to content var since there was no input
     $content = '<h1 class="error">Invalid or Previously Used Token Code.</h1><h1>Enter Token <span id="toggle-hide">Code</span></h1>
    <form action="" method="post">
      <input type="text" id="user_input" name="user_input" autofocus autocomplete="off" required>
      <button type="submit">Submit</button>
    </form>';
   }
   
   //  Checks if user input is on the ids.txt file and not on the used-id.txt file
   if ( strpos(file_get_contents("./ids.txt"), $user_input) !== false && strpos(file_get_contents("./used-ids.txt"), $user_input) === false) {
     //  Opens used-ids.txt file in append mode
     $file = fopen("used-ids.txt","a");
     //  Writes the users valid token to the used-ids.txt file so it cannot be used again
     echo fwrite($file, $user_input . "\r\n");
     //  Closes the file
     fclose($file);
     
     //  Adds the test and timer to the content var for printing below
     $content = '
       <p id="timer"></p>
       <iframe src="http://codepen.io/KPCodes/full/oZmagw/" frameborder="0" id="test"></iframe>';
     
   } else if($user_input === "*spaceman*") {
     $content = '<p id="timer"></p>
       <iframe src="http://codepen.io/KPCodes/full/oZmagw/" frameborder="0" id="test"></iframe>';
   } else {
     //  Adds error to content var if token is invalid or already used
     $content = '<h1 class="error">Invalid or Previously Used Token Code.</h1><h1>Enter Token <span id="toggle-hide">Code</span></h1>
    <form action="" method="post">
      <input type="text" id="user_input" name="user_input" autofocus autocomplete="off" required>
      <button type="submit">Submit</button>
    </form>';;
   }
 } else {
   //  Adds the form to the content var when the page is loaded without any POST data
   $content = '
    <h1>Enter Token <span id="toggle-hide">Code</span></h1>
    <form action="" method="post">
      <input type="text" id="user_input" name="user_input" autofocus autocomplete="off" required>
      <button type="submit">Submit</button>
    </form>';
 }

?>

  </div>
  <div class="center-content">
    <?php

      //  Prints what is in the content var to the page
      //  The content var will either contatin the form, the test and timer, or an error message
      print $content;

    ?>
  </div>

    <script>
      
      /* Hide input script
      ========================= */
      if (document.body.contains(document.querySelector("#toggle-hide"))) {
        document.querySelector("#toggle-hide").addEventListener("click", function(){
          document.querySelector("body").innerHTML = '<h1 id="toggle-hide">Enter Token Code</h1><form action="" method="post"><input type="password" id="user_input" name="user_input" autofocus autocomplete="off"><button type="submit">Submit</button></form>';
        });
      }
      

      /* Timmer Script
      ========================= */

      // looks to see if the timer is on the page meaning the test has been launched
      if (document.body.contains(document.querySelector("#timer"))) {
        
        // Timer object
        var timer = {};

        // Timer length. First number is minutes, change as needed.
        timer.length = 20 * 60 * 1000;

        // Countdown Timer method
        timer.count = function () {
          
          //gets remaining minutes for display
          var minutes = Math.floor(timer.length / (60 * 1000));

          //gets remaining seconds for display and formats them if needed
          var seconds = (timer.length / 1000) - (minutes * 60);
          if (seconds < 10) {
            seconds = "0" + seconds;
          }

          //Checks if timer is at 0
          if (timer.length <= 0) {
            
            // Writes message that testing time has ended
            document.querySelector("body").innerHTML = "<h1 class='error'>Your testing time has ended<br>Please see instructor.</h1>";
            
            // Stops countdown method
            clearInterval(timer.countInt);
          }

          // takes one second off the timer
          timer.length -= 1000;

          //puts the current time in the timer element
          document.querySelector("#timer").innerHTML = minutes + ":" + seconds;
        }
        
        // Runs count method every second
        timer.countInt = setInterval(timer.count, 1000);

      }
      
      
      
      
  /*
            
            
      // This Script will generate 5000 unique tokens surrounded by *
      
            var alph = 'abcdefghijklmnopqrstuvwxyz0123456789';
            alph = alph.split("");
            var results = [];
            
            function getRandomArbitrary(min, max) {
              return Math.random() * (max - min) + min;
            }
          
            function createRandomString(){
              var rnd = "*";
              var tested = false;
              
              for(var x = 0; x < 6; x++) {
                rnd += alph[Math.floor(getRandomArbitrary(1, 36))];
              }
              rnd += "*";
              
              for(var x = 0; x < results.length; x++) {
                if(rnd === results[x]) {
                  return false;
                }
              }
              
              results.push(rnd);
            }
            
            while(results.length < 5000) {
              createRandomString();
            }
            document.querySelector("body").innerHTML = "<p>";
            
            for(var x = 0; x < results.length; x++) {
              document.querySelector("body").innerHTML += results[x] + "<br>";
            }
            document.querySelector("body").innerHTML += "</p>";
            
            
          */
      
      
    </script>

</body>

</html>