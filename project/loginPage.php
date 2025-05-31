<?php
include ("loginConnect.php");
$sql = "SHOW TABLE STATUS LIKE 'tbl_employee'";
$result = $con ->query ($sql);
$row = $result->fetch_assoc();
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="logIn">
    <img src="coffee.jpeg" alt="coffee" id="coffee">
    <h2>𝐡𝐚𝐜𝐞𝐫 𝐜𝐚𝐟é</h2>
    <form method="POST" action="">
      <label for="email">Email</label><br>
      <input type="email" id="email" name="email" required><br><p></p>

      <label for="pass">Password</label><br>                    
      <input type="password" id="pass" name="password" required><br><p></p>

      <button type="submit" id="log">Login</button><br>
      
      <div class="center-link">
         <i><a href="signin.php" id="forgot">Forgot password?</a></i>
      </div>
    </form>

    <h5 class="form-link">Don't have an account? <a href="signin.php">Register here</a></h5>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $con->real_escape_string($_POST['email']);
  $password = $_POST['password'];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $sql = "SELECT * FROM login_table WHERE email = '$email'";
  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    $error = "Email already registered.";
  } else {

    $sql = "INSERT INTO login_table (email, password) VALUES ('$email', '$hashed_password')";
    if ($con->query($sql) === TRUE) {
      $_SESSION['id'] = $con->insert_id;
      header("Location: sample.html");
      exit();
    } else {
      $error = "Error: " . $con->error;
    }
  }
}
?>
</body>
</html>