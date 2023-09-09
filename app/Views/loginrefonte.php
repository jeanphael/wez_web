<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>

<body style="font:18px 'Gilroy', sans-serif !important;">
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
        <div class="col-lg-4 connexion">
        <div class="row">
            <div class="col-lg-2 col-sm-2 col-md-2 text-center logo" style="background-position: center;padding:8%;margin-top:5%"></div>
            </div>
                <form class="form" action="<?php echo base_url('connexion-validation-refonte'); ?>" method="POST">
                    <h4 class="form-login-heading text-center"><b>Connexion</b></h4>
                    <div class="">
                        <label style="font:16px 'Gilroy', sans-serif !important;"><b>Nom d'utilisateur</b></label>
                        <input type="text" class="form-control" placeholder="Saisissez votre nom d'utilisateur" autofocus name="login">
                        <label style="font:16px 'Gilroy', sans-serif !important;"><b>Mot de passe</b></label>
                        <input type="password" class="form-control" placeholder="Saisissez votre mot de passe" name="pwd">
                        <br/> <a href="<?php echo base_url('reset/password');?>" style="color:#797979 !important"><u>Mot de passe oublié ?</u></a>
                        <br/> <br/>
                        <button class="btn color-logo btn-block" href="index.html" type="submit">Connexion</button>
                        <br>
                        <p class="text-center"> Nouveau organisateur ?  <a href="<?php echo base_url('organizer_new');?>" style="color: #3FCAB9 !important;">cr&eacute;er un compte</a> </p>
                        <br>
                    </div>
                </form>
            </div>
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
	if(<?php echo $succes;?> == 1){
		alert("Votre compte est activé , veuillez vous connecter");
		location.href = '<?php echo base_url();?>/login' ;
	}
	if(<?php echo $inscr;?> == 1){
		alert("Inscription faite , un email vous a été envoyé");
		location.href = '<?php echo base_url();?>/login' ;
	}
  </script>
</body>

</html>
