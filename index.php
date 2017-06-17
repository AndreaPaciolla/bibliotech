<?php require_once "shared/core.php"; ?>
<?php include_once "shared/layout/header.php"; ?>

  <body>

      <?php

      if(isLoggedUser()) {
          include_once "shared/layout/body.php";
      } else {
          include_once "shared/layout/engage.php";
      }

      ?>

    <?php include_once "shared/layout/footer.php"; ?>

  </body>
</html>

<?php

// SIGN IN FORM
if(isset($_POST['login']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if(userExists($_POST['email'])) {
        // user exists, do the login
        if(doLogin($_POST['email'], $_POST['password'])) {
            header("Location: ./");
        } else {
            echo "<script>alert('Password non valida');</script>";
        }
    } else {
        echo "<script>alert('Utente non riconosciuto');</script>";
    }
}

// SIGN UP FORM
if(isset($_POST['form-signup-submit'])) {
    if(userExists($_POST['email'])) {
        // user exists, do the login
        echo "<script>alert('L\'email esiste.');</script>";
    } else {
        registerUser($_POST);
    }
}

?>