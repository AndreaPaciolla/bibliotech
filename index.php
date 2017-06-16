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
if(isset($_POST['form-signin'])) {
    if(userExists($_POST['email'], $_POST['password'])) {
        // user exists, do the login
        makeLogin($_POST['email'], $_POST['password']);
    } else {
        echo "<script>alert(L'utente non esiste);</script>";
    }
}

// SIGN UP FORM
if(isset($_POST['form-signup'])) {
    if(userExists($_POST['form-signup'])) {
        // user exists, do the login
        echo "<script>alert(L'email esiste.);</script>";
    } else {
        registerUser($_POST['form-signup']);
    }
}

?>