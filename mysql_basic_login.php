<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>practise my sql</title>
  </head>
  <body>
    <?php
      //Setup account
      $server = "localhost";
      $user = "Yaroslav";
      $password = "YaroslavPW";
      $dbname = "kooler";

      //Create connection
      $database = new mysqli($server, $user, $password, $dbname);

      if ($database->connect_error) {
        die ("Connection failed error: " . $database->connect_error);
      } else {
        echo "success!";
      }

      $querry_string = "SELECT * FROM people";
      $result = $database->query($querry_string);

      echo "<br>";



      while ($row = "array") {
        echo "id is: " . $row['id'] . " Name: " . $row['Name'] . "<br>";
      }

    ?>


  </body>
</html>
