<?php
include('includeBooking.php');
?>

<!-- HTML Form -->
<form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>
  
    <label for="gender">Gender:</label>
    <input type="radio" name="gender" value="F" required> Female
    <input type="radio" name="gender" value="M" required> Male<br>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required><br>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" required><br>
    
    <label for="ic">IC:</label>
    <input type="text" name="ic" required><br>
    
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="birthdate">Birthdate:</label>
    <input type="date" name="birthdate" required><br>

    <input type="submit" value="Submit">
</form>
