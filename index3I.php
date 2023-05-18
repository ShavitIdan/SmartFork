<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <?php
        echo "<h1>User information</h1>
              <h2>User's fullname is :  $_GET[fullName1]</h2>
              <h2>User's E-mail is   :  $_GET[mail1]</h2>
              <h2>User's BMI is      :  $_GET[BMI1]</h2>
              <h2>User's diet is     :  $_GET[diet1]</h2>
              <h2>User's age is      :  $_GET[age1]</h2>
              <h2>User's weight is   :  $_GET[weight1]</h2>
              <h2>User's height is   :  $_GET[height1]</h2>
              <h2>Is user pregnant   :  $_GET[flexRadioDefault1]</h2>";
        
        echo "<h1>Diet menu</h1>
              <h2>Diet start at      :  $_GET[date1]</h2>
              <h2>Calories per day   :  $_GET[Calories1]</h2>
              <h2>Protein per day    :  $_GET[Protein1]</h2>
              <h2>Fats per day       :  $_GET[Fats1]</h2>
              <h2>Carbohydrates per day :  $_GET[Carbohydrates1]</h2>
              <h2>Food to avoid      :  $_GET[cancelFood1]</h2>";

        if (isset($_GET['Health1'])) {
            $selectedHealth = $_GET['Health1'];
            echo "<h2>Selected Health Options:</h2>";
            if (is_array($selectedHealth)) {
                foreach ($selectedHealth as $option) {
                    echo "<p>$option</p>";
                }
            }else {
                echo "<p>$selectedHealth</p>";
            }
        }else {
            echo "<h2> Health labels      :No health options selected.</h2>";
        }       




           
    ?>
</body>
</html>