 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
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
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: rgba(188, 191, 191, 1) !important;
  opacity: 1; /* Firefox */
  letter-spacing: 0.015em;
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: rgba(188, 191, 191, 1) !important;
  letter-spacing: 0.015em;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: rgba(188, 191, 191, 1) !important;
  letter-spacing: 0.015em;
}
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
	height:56px;
}
p,a,span,button{
	font:16px 'Gilroy-Medium' !important;
}

.regular{
	font:16px 'Gilroy-Regular' !important;
}

.button{
	height:48px;
}

@media only screen and (max-width:768px) {
	#chk7
	{
		margin-top:0px !important;
	}
	 .conn{
	padding-left:15%;
	padding-right:15%;
	
	}
	.conn1{
		padding-left:15%;
	padding-right:15%;
	}
	#txtStayConn{
		font-size:14px !important;
	}
	#pwdReset{
		font-size:14px !important;
	}
}

@media only screen and (min-width:768px) {
	.conn1{
	padding-bottom:20%;
	padding-left:15%;
	}
	#chk7
	{
		margin-top:4px !important;
	}
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
  <div id="login-page">
    <div class="container">
        <div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 conn1"style="padding-top:20%;text-align:left">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height:42px;text-align:left;color:black !important;margin-left:10px !important; background-position-x: left;background-image: url(http://wez.mg/assets/img/logobl.png);float: none;background-repeat: no-repeat;"></div>
			<h2 class="txtsize" style="margin-left: 10px;font-size:42px !important;color: rgba(39, 48, 48, 1);">Faites d&eacute;couvrir vos &eacute;v&egrave;nements diff&eacute;remment</h2>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 conn">
			<div class="row" style="">
				<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12"  style="margin:auto;float:none; background-color: #ffffff;padding-top:5%;margin-bottom:10%;margin-top:20%;border-radius: 12px;box-shadow: 0.5px 0.5px 2px 2px rgba(227, 228, 228, 1);">
				
					<form class="form" action="<?php echo base_url('connexion-validation-refonte'); ?>" method="POST">
						<h4 class="form-login-heading text-center" style="font-size:28px !important"><b>Connexion</b></h4>
						<div class="text-left">
							<label style="">Nom d'utilisateur ou e-mail</label>
							<input type="text" class="form-control" style="color:rgba(188, 191, 191, 1) !important" placeholder="Nom d'utilisateur ou e-mail" autofocus name="login">
							<br/><label style="">Mot de passe</label>
							<input type="password" class="form-control" placeholder="Saisissez votre mot de passe" name="pwd">
							<br/>
							<input type="checkbox" id="chk7" name="souvenir" style="padding-right:5px;float:left"/> 
							<span id="txtStayConn" style="padding-left:5px;text-align:left;display:block;float:left"> 
							 Rester connecté</span>
							<a id="pwdReset" href="<?php echo base_url('reset/password');?>" style="color:#797979 !important;text-align:right;display:block;float:right">Mot de passe oublié ?</a>
							<br/> <br/>
							<button class="btn color-logo btn-block" style="background-color:rgb(44,141,130);height:48px !important" href="index.html" type="submit">Connexion</button>
							<br>
							<p class="text-center regular"> Nouveau organisateur ?  <a href="<?php echo base_url("inscription");?>" style="color:rgb(44,141,130) !important">cr&eacute;er un compte</a> </p>
							<br>
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
  </script>
</body>

</html>
