<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <form class="form-login" action="<?php echo base_url('connection'); ?>" method="POST">
        <h2 class="form-login-heading">Connexion</h2>
        <div class="login-wrap">
		<p><?php echo $activation; ?> </p>
          <input type="text" class="form-control" placeholder="Nom utilisateur" autofocus name="login">
          <br>
          <input type="password" class="form-control" placeholder="Mot de passe" name="pwd">
		  <br>
          <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i>  SE CONNECTER</button>
          <br>
    <a href="<?php echo base_url('organizer_new');?>">Créer un compte organisateur</a>
    <br>
    <a href="<?php echo base_url('form_reinit_pwd');?>">Mot de passe oublié (organisateur)</a>
    
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
