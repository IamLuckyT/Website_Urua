<?php

session_start();

$errors = [
  'login' => $_SESSION['login_error'] ??'',
  'register' => $_SESSION['register_error'] ??''
];

$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error) {
  return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {
  return $formName === $activeForm ? 'active' : '';
}

?>

<html>
  <head>
    <title> login</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <div class="container">
      <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form"> 
        <form action="login_register.php" method="post"> <!-- php file used to login --> 
          <h2>Login</h2>
          <?= showError($errors['login']); ?>
            <input  type="idnumber" name="idnumber" placeholder="IDnumber" required>
            <input  type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
            <p>Don’t have an account? <a href="#" onclick="showForm('register-form')">Register</a>  </p>
      </div>

      <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form"> 
        <form action="login_register.php" method="post">
          <h2>Register</h2>
          <?= showError($errors['register']); ?>
            <input  type="text" name="name" placeholder="Name" required>
            <input  type="text" name="idnumber" placeholder="IDnumber" required>
            <input  type="email" name="email" placeholder="Email" required>
            <input  type="password" name="password" placeholder="Password" required> 
            <select name="Stakeholder_Type" required>
              <option value="">--Select Role--</option>
              <option value="user">User</option>
              <option value="admin">Admin</option>
            </select>           
            <button type="submit" name="register">Register</button>
            <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a>  </p>
        </form>
      </div>
      <script src="script.js"></script>
  </body>
  
</html>
