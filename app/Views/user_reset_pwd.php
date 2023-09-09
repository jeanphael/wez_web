<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <form class="form-login" action="<?php echo base_url('sendmail/reset/password'); ?>" method="POST">
        <h2 class="form-login-heading">Reinitialisation mot de passe</h2>
        <div class="login-wrap">
          <input type="text" class="form-control" placeholder="Adresse email de l'utilisateur" autofocus name="login">
          <br>
      <br>
          <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i>  ENVOYER</button>
          <br>
 
    <br><?php echo $message; ?>
          <hr>
        </div>
      </form>
    </div>

   
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="<?php echo base_url('assets/lib/jquery.backstretch.min.js'); ?>"></script>
  <script>
    $.backstretch("img/login-bg.jpg", {
      speed: 500
    });
  </script>
</body>

</html>

