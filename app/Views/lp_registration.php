 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Administration</title>

  <!-- Favicons -->
   
  <link href="<?php echo base_url('assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('assets/lib/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <!--external css-->
  <link href="<?php echo base_url('assets/lib/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="<?php echo base_url('assets/css/style-responsive.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/style.css'); ?>?ts=<?=time()?>" rel="stylesheet">
 
<link rel="stylesheet" href="https://cdn.rawgit.com/mfd/09b70eb47474836f25a21660282ce0fd/raw/e06a670afcb2b861ed2ac4a1ef752d062ef6b46b/Gilroy.css">

<style>
body {
font:18px 'Gilroy', sans-serif;

}

@font-face {
    font-family: "Gilroy-SemiBold";
    src: url(<?php echo base_url()?>/assets/font/Gilroy-SemiBold.ttf);
}

@font-face {
    font-family: "Gilroy-Medium";
    src: url(<?php echo base_url()?>/assets/font/Gilroy-Medium.woff) format("woff");
}


@font-face {
    font-family: "Gilroy-Regular";
    src: url(<?php echo base_url()?>/assets/font/Gilroy-Regular.ttf);
}

label{
	font:16px 'Gilroy-SemiBold' !important;
}
.form-control{
	font:16px 'Gilroy-Medium' !important;
	color: rgba(188, 191, 191, 1) !important;
}

p,a,button,input{
	font:16px 'Gilroy-Medium' !important;
}


</style>



  <link href="<?php //echo base_url('assets/lib/advanced-datatable/css/demo_page.css'); ?>" rel="stylesheet" />
  <link href="<?php //echo base_url('assets/lib/advanced-datatable/css/demo_table.css'); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?php //echo base_url('assets/lib/advanced-datatable/css/DT_bootstrap.css'); ?>">
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>
<body style="font:18px 'Gilroy', sans-serif !important;background-color:rgb(251,251,251) !important">
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="">
    <div class="">
        <div class="row" style="margin:5%">
			<!--div class="col-lg-6 col-md-6 col-xs-6 col-sm-6" style="padding:0px !important;background-repeat: no-repeat;diplay:flex">
			 <img style="width:100% !important;height:auto important" src="<?php echo base_url('assets/img/registrationImg.png'); ?>" alt="">
			</div-->
			<div class="col-lg-7 col-md-7 col-xs-12 col-sm-12" style="border-radius: 12px;box-shadow: 0.5px 0.5px 2px 2px rgba(227, 228, 228, 1);float:none;margin:auto;background-color: #ffffff;">
			<div class="row" style="">
				<div class="col-lg-6"  style="padding-top:15%;padding-left:15% !important;padding-right:10% !important;width:100%">
					<img src="<?php echo base_url('assets/img/logobl.png'); ?>"/><br/><br/><br/>
					<form class="form" action="<?php echo base_url('connexion-validation-refonte'); ?>" method="POST">
						<h4 class="form-login-heading text-left" style="font-size:28px !important"><b>Cr&eacute;ez un nouveau compte</b></h4>
						<br/>
						<div class="row">
							 <div class="col-lg-12">
								 <div class="form-group">
									 <label for="exampleInputEmail1">Nom de l'organisateur</label>
									 <input type="hidden" class="form-control" id="idU" name="iUser" value="<?php echo $idUser; ?>">
									<input type="text" name="email" class="form-control" id="exampleInputEmail1"  placeholder="Votre nom"  required>
								</div>
								   
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Nom d'utilisateur</label>
									<input type="text" name="name" class="form-control" id="exampleInputEmail1"  placeholder="Votre nom d'utilisateur"  required>
								 </div>
							</div> 
							<div class="col-lg-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Num&eacute;ro t&eacute;l&eacute;phone</label>
									<input type="text" name="adresse"  class="form-control" id="exampleInputEmail1" placeholder="Votre numéro téléphone"  required>
								</div>
							</div> 
				 <div class="col-lg-12">
				   <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="phone" class="form-control" id="exampleInputEmail1"  placeholder="Votre email"  required>
                    </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
                        <label for="exampleInputEmail1">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe"/>
                     </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
                        <label for="exampleInputEmail1">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Retapez le mot de passe"/>
                     </div>
				</div>
						</div>
				<div class="row"  style="background-color:white">
                <div class="col-lg-12">
				<br/><p><input type="checkbox"/> Oui, Je voudrai &ecirc;tre inform&eacute; des nouveaut&eacute;s de wez dans ma bo&icirc;te email </p>
				<br/><p> <input id="checkbx" onclick="activateButton()" type="checkbox"/> Oui, j'accepte les <a href="<?php echo base_url('utilisation'); ?>" style="color:rgb(123,219,207) !important" >conditions d'utilisations</a> et <a href="<?php echo base_url('confidentialite'); ?>" style="color:rgb(123,219,207) !important">politiques de confidentialit&eacute;s</a> de wez</p> </p>
                 </div>
                <div class="col-lg-4" style="float:left;width:auto !important;margin-top:5%">
                 <input type="submit" id="btncreate" disabled class="btn color-logo btn-block"  style="color:white;background-color:rgb(44,141,130) !important;height:48px !important;color:white;width:100%" value="Créer un compte"/>
               </div>
				 </div>
				 <br/><br/>
				 <div class="row">
					<div class="col-lg-12">
						<p>Vous avez dej&agrave; un compte? <a style="color:rgb(44,141,130) !important" href="<?php echo base_url("connexion");?>">Se connecter</a></p>
					 </div>
				 </div>
					</form>
					</div>
				</div>
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
	function activateButton()
	{
		if(!$('#checkbx').is(':checked'))
		{
			$( "#btncreate" ).prop( "disabled", true ); 
		}
		else
		{
			$( '#btncreate' ).prop( "disabled", false );
		}
	}
  </script>
</body>

</html>
