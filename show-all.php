<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All IDs Gateway</title>
  
  <style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans');
    
     h1 {
      text-align: center;
      font-size: 30px;
      line-height: 30px;
      margin: 0px;
      padding: 0px;
      margin-top: 30vh;
      font-family: "Open Sans", sans-serif;
    }
    
    .error {
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
 
  <?php

// Checks if loaded with post data and the input field is set
 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_input'])) {
   
   // sanatize input
    $user_input = filter_var($_POST['user_input'], FILTER_SANITIZE_STRING );
   
   // makes input lower case
    $user_input = strtolower($user_input);
   
   // Checks if password, in this case apollorocket
    if($user_input === "projectcode2014") {
      // puts ids.txt contents into content var
      $content = file_get_contents("ids.txt");
    } else {
      // puts error message and form in content if password incorrect
      $content = '<h1>Incorrect Password<br>Enter Password</h1><form action="" method="post"><input type="password" id="user_input" name="user_input" autofocus autocomplete="off"><button type="submit">Submit</button></form>';
    }
 } else {
   // loads form into contet
    $content = '<h1>Enter Password</h1><form action="" method="post"><input type="password" id="user_input" name="user_input" autofocus autocomplete="off"><button type="submit">Submit</button></form>';
 }


// Prints content var, it can either be the form, form and error message, or all of the ids
echo $content;
?>



</body>
</html>


