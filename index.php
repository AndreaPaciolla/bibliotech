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
