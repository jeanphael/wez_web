<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <!-- Favicons -->
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url(); ?>/assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url(); ?>/assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet">

  <!-- Updated Slider -->
  <link href="<?php echo base_url(); ?>/assets/css/updatedslider.css?v=7" rel="stylesheet">

  <!-- Updated Swiper -->
  <link href="<?php echo base_url(); ?>/assets/css/swiper.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/css/mobile.css?v=1" rel="stylesheet">

	<!--Slick slider-->
	<link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"
      integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />


  <!-- =======================================================
    Template Name: Flatty
    Template URL: https://templatemag.com/flatty-bootstrap-app-landing-page-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
<style>
	.evenement {
		box-shadow: 0px 4px 8px rgba(116, 120, 120, 0.25);
		border-radius: 16px;
		background-color: white;
		height: 100%;
		text-align: left;
		margin-right: 1%;
		margin-left: 1%;
		padding: clamp(8px, 2%, 20px);
    	padding-bottom: 20px;
	}

	.imgInd
	{
		margin-right: 5px;
	}

 	.swiper-slide 
	{
		text-align: center;
		font-size: 18px;
		background: #fff;
		border-radius: 50px;
		/* Center slide text vertically */
		display: -webkit-box;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		-webkit-justify-content: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		-webkit-align-items: center;
		align-items: center;

		width: auto !important;
		height: 30px;
		box-shadow: 0px 0px 2px rgba(70, 70, 70, 0.4);
		font-family: sans-serif;
		font-weight: bold;
		color: rgb(66, 66, 66);
		padding: 0px 20px;
		margin-right: 12px !important;
	}
      
	
	.swiper-slide:hover 
	{
		cursor: pointer;
	}

	.swiper-button-next, .swiper-button-prev {
		top: 50%;
		color: #273030;
	}

	.swiper-button-next {
		right: -30px;
	}

	.swiper-button-prev {
		left: -30px;
	}

	.swiper-button-next:after, .swiper-button-prev:after {
		font-size: 12px;
		color: #273030;
		content: "" !important;
		width: 6px;
		height: 12px;
		background: url("assets/img/arrow_next.svg");
		background-repeat: no-repeat;
		background-size: contain;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.swiper-button-prev:after {
		transform: rotate(-180deg);
	}

	.swiper-button-disabled {
		display: none;
	}

	.swiper-slide:active 
	{
		color: whitesmoke;
		background-color: cyan;
	}

	.swiper {
        width: 100%;
        height: 100%;
    }

	#headerwrap {
		/* background: url(../img/bg01.jpg) no-repeat center top; */
		/* background-color: #3498db; */
		margin-top: -20px;
		padding-top: 200px;
		background-attachment: relative;
		background-position: center center;
		min-height: 650px;
		width: 100%;
		-webkit-background-size: 100%;
		-moz-background-size: 100%;
		-o-background-size: 100%;
		background-size: 100%;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}

@font-face {
    font-family: "opensans";
    src: url(<?php echo base_url()?>/assets/font/OpenSans-Bold.ttf);
}

@font-face {
    font-family: "Gilroy-bold";
    src: url(<?php echo base_url()?>/assets/font/Gilroy-Bold.ttf);
}


@font-face {
    font-family: "Gilroy-Medium";
    src: url(<?php echo base_url()?>/assets/font/Gilroy-Medium.ttf);
}

@font-face {
    font-family: "Gilroy-semibold";
    src: url(<?php echo base_url()?>/assets/font/Gilroy-SemiBold.ttf);
}


.open{
	font:18px 'opensans' !important;
}


.footlink{
	margin-left:6%;
	color: rgba(255, 255, 255, 1);
	font: 14px 'Gilroy-Medium';
	text-align:right;
}
.title{
	font: 20px 'Gilroy-Bold' !important;
	color: black !important;
}
.details{
	font: 16px 'Gilroy-Medium' !important;
	color: rgba(112, 118, 118, 1) !important;
}
.amenu{
	font: 16px 'Gilroy-Medium' !important;
	margin-top : 1%;
}

.titleCat{
	padding-right:5%;
	margin-bottom:5%;
}
.active{
	color: #31CAA5;
	border-bottom: solid  #31CAA5;
	padding-bottom : 2%;
}
#b1:hover {
  background-color:rgba(236, 250, 248, 1);
}
#b2:hover {
 background-color:rgba(236, 250, 248, 1);
}
#b3:hover {
  background-color:rgba(236, 250, 248, 1);
}
#b4:hover {
 background-color:rgba(236, 250, 248, 1);
}
.title1:hover {
 background: #2C8D82;border-radius: 8px;
 color:white !important;
}

.navbar-default .navbar-nav>li>a:hover {
 color:white !important;
}


@media only screen and (min-width:768px) {
	#listcategor {
    overflow: hidden;
    background: green;
    padding: 10px;
	width: 300px !important;
    height: 250px !important;
}
#contactBan{
	display:block;
}
#contactBan1{
	display:none;
}
#contactBan2{
	display:none;
}

#listcategory {
  font: 18px 'OpenSans-Bold' !important;
	margin-bottom: 26px;
	position: relative; 
}

#listcategory span label{
  font: 18px 'OpenSans-Bold' !important;
}
	 .dern{
	display:none;
	}
	.imgEvent{
		height:192px;
	}
	 .dern8{
	display:none !important;
	}
	#backh1{
		color:rgba(39, 48, 48, 1) !important;font:48px ;
	}
	#screenmax7{
		display:none;
	}
}
@media only screen and (max-width:768px) {
	.notmobile{
		display : none !important;
	}
	.ismobile{
		display :block !important;
	}
	#screenmin7{
		display:none;
	}
	#next{
		width:25px;
		height:25px;
	}
	#prev{
		width:25px;
		height:25px;
	}
	#contactBan{
		display:none;
	}
	#contactBan1{
		display:block;
	}
	#contactBan2{
		display:block;
	}
	 .dern{
		display:none;
	}
	 .dern8{
	display:none !important;
	}
	#footerxs20{
		padding-left : 20% !important;
	}
	#listcategory{
		font-size : 12px !important;
	}
	#listcategory span label{
		font-size : 12px !important;
	}
	.containerMain{
		 display: flex; flex-direction: column;
	}
	.xsHome100{
		display:none;
		
	}
	.xs12{
		
	}
	#backh1{
		color: rgba(63, 202, 185, 1) !important;
		font: 40px 'Gilroy-bold' !important;
		background-image: url('http://wez.mg/assets/img/Rectangle 1.png');
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		height: 400px;
		border-radius: 16px 48px;
		padding: 3%;
		background-image: url(http://wez.mg/assets/img/Rectangle 1.png);
	}
}
@media only screen and (max-width:480px) {
	
	.notmobile{
		display : none !important;
	}
	.ismobile{
		display : block !important;
	}
	 .dern{
	display:none !important;
	}
	 .dern8{
	display:none !important;
	}
	
	 .dern2{
	display:none !important;
	}
	 .dern3{
	display:none !important;
	}
	.xs12{
		width:100% !important;
	}
	#footerxs20 a{
		font-size : 8px !important;
	}
	.xsHome100{
		width: 90%;
		
	}
	
	
	.xsPhoneNone{
		display:none;
	}
	.details {
		font-size : 9px !important;
		
	}
	.ville{
		padding-left: 10% !important;
	}
	.title{
		font-size : 16px !important;
	}
	.imgInd{
		width:10%;
	}
	* {
    box-sizing: border-box;
}

}

.item:last-child {
    margin-bottom: 0px;
}


#slider {
    width: 1200px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
}

#slide1, #slide2, #slide3, #slide4 {
    position: absolute;
    top: 0;
    left: 0;
}

#slide2, #slide3, #slide4 {
    display: none !important;
}

#precedent, #suivant {
    z-index: 1;
    transition: opacity 0.5s ease;
    font-size: 75px;
    font-weight: 100;
    position: absolute;
    top: 160px;
    background-color: rgba(0, 0, 0, 0.6);
    color: rgb(220, 220, 220, 0.6);
    opacity: 0;
    cursor: pointer;
}

#precedent {
    left: 0;
}

#suivant {
    right: 0;
}

#slider:hover #precedent, #slider:hover #suivant {
    opacity: 1;
}

.activeCategory
{
	background-color: rgba(63, 202, 185, 1) !important;
	color : rgba(236, 250, 248, 1) !important;
}

/* slick */
	body {
		overflow-x: hidden;
		/* background: #c9cbcb; */
	}

	.event-slide {
		margin: 0 auto;
	}

	.event-slide .slick-arrow {
		width: 40px;
		height: 40px;
		border-radius: 50%;
		border: 1px solid #bcbfbf;
		display: flex !important;
		align-items: center;
		justify-content: center;
		z-index: 1000;
	}

	.event-slide .slick-disabled {
		display: none !important;
	}

	.event-slide .slick-arrow:before {
		content: "";
		width: 6px;
		height: 12px;
		background: url("assets/img/arrow_next.svg");
		background-repeat: no-repeat;
		background-size: contain;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.event-slide .slick-prev {
		left: -6px;
	}

	.event-slide .slick-prev:before {
		transform: rotate(-180deg);
	}

	.event-slide .slick-next {
		right: -6px;
		opacity: 1;
	}

	.event-slide .slick-track {
		display: flex;
		justify-content: center;
	}

	.event-card {
		background: #ffffff;
		border-radius: 8px;
		padding: 16px;
		margin: 0 20px;
		transform: translateY(0px);
		transition: all .3s ease;
		min-width: 243px;
	}

	.event-card:hover {
		cursor: pointer;
		box-shadow: 0px 4px 8px rgba(116, 120, 120, .25);
		transform: translateY(-3px);
		transition: all .3s ease;
	}

	.event-image {
		width: 100%;
		height: 192px;
		overflow: hidden;
		border-radius: 8px;
		margin: 0 0 16px 0;
	}

	.event-image img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.event-title {
		font-size: 20px;
		line-height: 30px;
		color: #000000;
		text-align: left;
		font-weight: 700;
	}

	.event-desc {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	.event-desc li {
		display: grid;
		grid-template-columns: 18px auto;
		grid-column-gap: 10px;
		font-size: 16px;
		color: #707676;
		margin-bottom: 8px;
		text-align: left;
	}

	.event-desc li:last-child {
		margin-bottom: 0px;
	}

	.event-desc li img {
		display: flex;
		height: 20px;
		margin: 0 auto;
	}

	.down_link {
		display: flex;
		align-items: center;
		margin-top: 16px;
	}

	.down_link a{
		display: flex;
		align-items:center;
		background: #2C8D82;
		border-radius: 8px;
		margin-right: 16px;
		padding: 12px 18px;
		color: #ffffff;
		text-decoration: none;
	}

	.down_link .text-link {
		display: flex;
		flex-direction: column;
		margin-left: 14px;
	}

	.down_link a .disponible{
		font-size: 12px !important;
		margin-bottom: 2px;
	}

	.down_link a .open{
		font-size: 18px;
		font-weight: 700;
		margin-bottom: 0
	}

</style>

 	<script src="https://code.jquery.com/jquery-latest.js"></script>
	<script src="<?php echo base_url(); ?>/assets/lib/multislider/js/jquery-2.2.4.min.js"></script>

</head>

<body style="font:18px 'Gilroy', sans-serif !important;background-color:rgb(251,251,251) !important">



  <!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top" id="menuBar" style="display:none;padding-top:2%;margin-bottom:0px !important;padding-bottom:0px !important">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
		  	<img src="<?php echo base_url('assets/img/logohomeMenu.png'); ?>"  style="float:left;padding:3%" />
        <a class="navbar-brand" href="#" style="height:0px !important;"><b></b></a>
      </div>

      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right ins"  <?php $session = \Config\Services::session(); if($session->get('userSession') != null){ echo "style='display:none'"; } else echo "style='display:block;'"; ?>>
          <li class="title1">
						<a href="<?php echo base_url('inscription'); ?>" style="" class="amenu smoothscroll">Inscription</a>
					</li>
        </ul>

				<ul class="nav navbar-nav navbar-right conne"  <?php $session = \Config\Services::session(); if($session->get('userSession') != null){ echo "style='display:none'"; } else echo "style='display:block;'"; ?>>
					<li class="title1" >
						<a href="<?php echo base_url('connexion'); ?>" class="amenu smoothscroll">Connexion</a>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right mese" <?php $session = \Config\Services::session(); if($session->get('userSession') != null){ echo "style='display:block'"; } else echo "style='display:none;'"; ?>>
						<li class="title1" >
							<a href="<?php echo base_url('evenement-list-refonte'); ?>" class="amenu smoothscroll">Mes &eacute;v&egrave;nements</a>
						</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="title1">
						<a href="<?php echo base_url('evenement/ajout'); ?>" class="amenu smoothscroll">Cr&eacute;er un &eacute;v&egrave;nement</a>
					</li>
				</ul>
      </div>
    </div>
  </div>

  <div id="headerwrap">
    <div class="container">
	  	<div class="row">
	  		<div class="col-lg-12 containerMain">
					<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 xs12">
						<p><?php echo $message; ?></p>
						<img id="imgLogo" class="notmobile" src="<?php echo base_url('assets/img/logohome.png'); ?>"  />
							<h1 id="backh1" class=" text-left" style="font:'Gilroy-bold' !important;display:none">
						<img id="imgLogoMobile" class="ismobile" style="display:none" src="<?php echo base_url('assets/img/logohome.png'); ?>"  />
								
						L&agrave; o&ugrave; les bons plans se trouvent et se cr&eacute;ent</h1>
						<p class="text-left" id="descriptionHome" style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important;display:none">Wez est une application mobile qui permet aux utilisateurs de d&eacute;couvrir et aux organisateurs de cr&eacute;er, de promouvoir des &eacute;v&egrave;nements que ce soit culturel, sportif ou &eacute;conomique par tout Madagascar</p>
						<br/><br/>
						<p class="text-left" id="downHome" style="font: 16px 'Gilroy-semibold' !important;display:none">T&eacute;l&eacute;chargez wez maintenant</p>
						
						<div class="down_link">
							<a href="" id="appHome">
								<img src="<?php echo base_url(); ?>/assets/img/apple.png" />
								<div class="text-link">
									<p class="disponible">Disponible sur:</p>
									<p class="open"> Apple store</p>
								</div>
							</a>

							<a href="" id="googleHome">
								<img src="<?php echo base_url(); ?>/assets/img/Playstore.png">
								<div class="text-link">
									<p  class="disponible">Disponible sur:</p>
									<p class="open"> Google play</p>
								</div>
							</a>
						</div>
					</div>
        	<!-- /col-lg-6 -->
					<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 xsHome100" style="display:none" id="imgHome">
						<img class="" src="<?php echo base_url(); ?>/assets/img/Rectangle 1.png" width="90%" height="auto" alt="">
					</div>
        	<!-- /col-lg-6 -->
				</div>
</div>
      <!-- /row -->
</div>
    <!-- /container -->
</div>
  <!-- /headerwrap -->


  <div class="container" id="othElem1" style="display:none">
   
    <!-- /row -->

    <div class="row mt centered" >
	  <div class="col-lg-12">
        <h1 style="color:rgba(39, 48, 48, 1) !important;font:48px 'Gilroy-bold' !important">Avec Les fonctionnalit&eacute;s de wez</h1>
		<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important">Exp&eacute;rimentez une nouvelle mani&egrave;re de d&eacute;couvrir les &eacute;v&egrave;nements</p>
       </div>
      </div><!--/col-lg-4 -->
	 
	
	 <div class="row mt centered" id="screenmin7">
			<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 text-right" style="padding:5%;">
				<div class="row b1min" id="b1" style="padding:5%;background-color:rgba(236, 250, 248, 1)">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-notification.png" alt="" style="text-align:right">
				 </br> </br>
				<p  style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important">Une notification</p>
				<p  style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">vous informe des événements disponible sur l’application</p>
				</div>
				</br></br></br>
				<div class="row b2min" id="b2" style="padding:5%">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-nbevenement.png" alt="" style="text-align:right">
				 </br> </br>
				<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important">Dans les favoris,</p>
				<p style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">retrouvez les évènements que vous avez aimé</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 block-center minMock" style="padding-top:5%;padding-left:7%;padding-right:7%">
			   <img class=""  style="width:100%" src="<?php echo base_url(); ?>/assets/img/Mock.png" alt="">
 
			</div>
			<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 text-left"  style="padding:5%">
				<div class="row b3min" id="b3" style="padding:5%">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-localisation.png" alt="">
				 </br> </br>
				<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important"> Le MAP intégré</p>
				<p style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">vous permet de localiser le lieu où se passe l’évènement mais aussi les points de vente des billets</p>
				</div>
				</br></br></br>
				<div class="row b4min" id="b4" style="padding:5%">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-recherche.png" alt="">
				 </br> </br>
				<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important">Grâce au recherche personnalisée,</p>
				<p style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">trouvez facilement les évènements qui conviennent à vos feelings</p>
				</div>
			</div>
      </div><!--/col-lg-4 -->
	 
	  <div class="row mt centered" id="screenmax7" style="height:350px" >
			<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 text-right" style="margin-top:5%;margin-bottom:5%;overflow:auto;height:100%">
				<div class="row b1max" id="b1" style="padding:5%;background-color:rgba(236, 250, 248, 1)">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-notification.png" alt="" style="text-align:right">
				 </br> </br>
				<p  style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important">Une notification</p>
				<p  style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">vous informe des événements disponible sur l’application</p>
				</div>
				<div class="row b2max" id="b2" style="padding:5%">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-nbevenement.png" alt="" style="text-align:right">
				 </br> </br>
				<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important">Dans les favoris,</p>
				<p style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">retrouvez les évènements que vous avez aimé</p>
				</div>
				<div class="row b3max" id="b3" style="padding:5%">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-localisation.png" alt="">
				 </br> </br>
				<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important">Le MAP intégré,</p>
				<p style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">vous permet de localiser le lieu où se passe l’évènement mais aussi les points de vente des billets</p>
				</div>
				<div class="row b4max" id="b4" style="padding:5%">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-recherche.png" alt="">
				 </br> </br>
				<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important">Grâce au recherche personnalisée,</p>
				<p style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">trouvez facilement les évènements qui conviennent à vos feelings</p>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 block-center" style="padding-top:5%;padding-left:7%;padding-right:7%">
			   <div class="row maxMock"  style="padding:5%">
					<img class="" style="width:100%" src="<?php echo base_url(); ?>/assets/img/Mock.png" alt="">
				</div>
			
			</div>
			
      </div><!--/col-lg-4 -->
	 
    </div>
	
    <!-- /row -->
  </div>
  <!-- /container -->
<br/>
	
<?php 
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
 
if($isMob){ 
    echo 'Using Mobile Device...'; 
}else{ 
    echo 'Using Desktop...'; 
}
 ?>
<?php if(isset($listCat)){ ?>
	<div class="container" id="othElem2" style="display:none; " >
		<div class="row mt centered" style="margin-top:5%;">
			<div class="col-lg-3">
				<h3 style="color:black !important;font:34px 'Gilroy-Medium' !important;padding:1%;text-align:left">Les évènements populaires de cette semaine</h3>
			</div>
			<div class="col-lg-9">
				<!-- Slider main container -->
			
				<div class="row" id="listcategory" style="color:black;text-align:left;margin-left:2%;margin-right:2%"> 
					<div class=" swiper mySwiper">
						<div class="swiper-wrapper">
							<div class="swiper-slide" id="activeCategory" onclick="changeListEvent(0)" style="background: rgb(63, 202, 185) !important; color: white !important;">Tout</div>
							<?php $count = 0;$i=1; foreach($listCat as $cat){ ?>
								<div class="swiper-slide" onclick="changeListEvent(<?php echo $cat->idCategory;?>)" id="idcat<?php echo $cat->idCategory;?>" ><?php echo $cat->name;?></div>
							<?php $count++; $i++;} ?>
						</div>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-pagination"></div>
					
					<!-- <div class="row" >
						<div class="col-lg-4" style="background:red;">sfsdfsfs</div>
						<div class="col-lg-4" style="background:green;">sdfsfsfs</div>
						<div class="col-lg-4" style="background:yellow;">sfsfsfsf</div>
					</div> -->
				</div>
				<div class="event-slide">
						<a href="" class="event-card">
							<figure class="event-image">
								<img
									src="<?php echo base_url('assets/img/event_1.png'); ?>"
									alt="Image évènement populaire"
								/>
							</figure>
							<h3 class="event-title">Clélia Présente la célébration Soulful</h3>
							<ul class="event-desc">
								<li>
									<img src="<?php echo base_url('assets/img/location.svg'); ?>" alt="icon" /> Glacier
									Analakely, Antananarivo
								</li>
								<li>
									<img src="<?php echo base_url('assets/img/calendar.svg'); ?>" alt="icon" /> 13 Oct - 21:00
								</li>
								<li>
									<img src="<?php echo base_url('assets/img/tariff.svg'); ?>" alt="icon" /> à partir de 25 000
									Ar
								</li>
							</ul>
						</a>

						<a href="" class="event-card">
							<figure class="event-image">
								<img
									src="<?php echo base_url('assets/img/event_2.png'); ?>"
									alt="Image évènement populaire"
								/>
							</figure>
							<h3 class="event-title">Tovo j’hay - tia tokoa</h3>
							<ul class="event-desc">
								<li>
									<img src="<?php echo base_url('assets/img/location.svg'); ?>" alt="icon" /> Les Cygnes
									Mandrosoa Ivato, Antananarivo
								</li>
								<li>
									<img src="<?php echo base_url('assets/img/calendar.svg'); ?>" alt="icon" /> Le 19 nov 2021 à
									21:00
								</li>
								<li>
									<img src="<?php echo base_url('assets/img/tariff.svg'); ?>" alt="icon" /> à partir de 25 000
									Ar
								</li>
							</ul>
						</a>

					  <a href="" class="event-card">
							<figure class="event-image">
								<img
									src="<?php echo base_url('assets/img/event_3.png'); ?>"
									alt="Image évènement populaire"
								/>
							</figure>
							<h3 class="event-title">Inah chante</h3>
							<ul class="event-desc">
								<li>
									<img src="<?php echo base_url('assets/img/location.svg'); ?>" alt="icon" /> Canal Olympia
									Iarivo, Antananarivo
								</li>
								<li>
									<img src="<?php echo base_url('assets/img/calendar.svg'); ?>" /> 29 Octobre 2021
									- 19:00
								</li>
								<li><img src="<?php echo base_url('assets/img/tariff.svg'); ?>" alt="icon" /> 50 000 Ar</li>
							</ul>
						</a>

						<a href="" class="event-card">
							<figure class="event-image">
								<img
									src="<?php echo base_url('assets/img/event_1.png'); ?>"
									alt="Image évènement populaire"
								/>
							</figure>
							<h3 class="event-title">Clélia Présente la célébration Soulful</h3>
							<ul class="event-desc">
								<li>
									<img src="<?php echo base_url('assets/img/location.svg'); ?>" alt="icon" /> Glacier
									Analakely, Antananarivo
								</li>
								<li>
									<img src="<?php echo base_url('assets/img/calendar.svg'); ?>" alt="icon" /> 13 Oct - 21:00
								</li>
								<li>
									<img src="<?php echo base_url('assets/img/tariff.svg'); ?>" alt="icon" /> à partir de 25 000
									Ar
								</li>
							</ul>
						</a>
    			</div>
			</div>
			
				

		</div>
	</div>
    <!-- /row -->
<?php } ?>
   <br/>
 <div class="container" id="othElem3" style="display:none"> 
	<div class="row mt centered">
          <img class="" style="width:100%" src="<?php echo base_url(); ?>/assets/img/app-banner.png" alt="">
        </div>
 </div>
 <br/>
  <div id="copyrights" style="display:none;">
    <div class="container">
	</br>
      <div class="row">
        <div class="col-lg-9 text-left col-md-8 col-sm-8 col-xs-8">
			<p><img src="<?php echo base_url(); ?>/assets/img/footerLogo.png"></p>
			</br><p id="contactBan"><img style="padding-right:1%" src="<?php echo base_url(); ?>/assets/img/footerPhone.png">+261340000000
			<img style="padding-left:3%;padding-right:1%" src="<?php echo base_url(); ?>/assets/img/envelop.png">Wez@gmail.com</p>
			<p id="contactBan1"><img style="padding-right:1%" src="<?php echo base_url(); ?>/assets/img/footerPhone.png">+261340000000</p>
			<p id="contactBan2"><img style="padding-right:1%" src="<?php echo base_url(); ?>/assets/img/envelop.png">Wez@gmail.com</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
			<p style="font: 14px 'Gilroy-Medium' !important">Nous suivre sur les r&eacute;seaux sociaux</p>
			</br><img style="padding-right:5%" src="<?php echo base_url(); ?>/assets/img/footerfb.png">
			<img style="padding-right:5%" src="<?php echo base_url(); ?>/assets/img/footerLinkedin.png">
			<img style="padding-right:5%" src="<?php echo base_url(); ?>/assets/img/footerr3.png">
		</div>
      </div>
	  </br>
	   <div class="row" style="border-top:solid;padding-top:2%">
				<div class="col-lg-12 text-left col-md-12 col-sm-12 col-xs-12">
					<img style="float:left" src="<?php echo base_url(); ?>/assets/img/footer2022.png">
					 <div style="padding-left:50%" id="footerxs20">
						 <a class="footlink" href="<?php echo base_url('utilisation'); ?>">Condition g&eacute;n&eacute;rale d'utilisation</a>
						 <a class="footlink" href="<?php echo base_url('confidentialite'); ?>">Politique de confidentialit&eacute</a>
						 <a class="footlink">Cookies</a>
					</div>
				</div>
	    </div>
      <div class="credits">
        <!--
          You are NOT allowed to delete the credit link to TemplateMag with free version.
          You can delete the credit link only if you bought the pro version.
          Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/flatty-bootstrap-app-landing-page-template/
          Licensing information: https://templatemag.com/license/
        -->
       </div>
    </div>
  </div>
  <!-- / copyrights -->
</div>
  <!-- JavaScript Libraries -->
  <script src="<?php echo base_url(); ?>/assets/lib/multislider/js/multislider.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/lib/php-mail-form/validate.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script
		type="text/javascript"
		src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
	></script>
  <!-- Template Main Javascript File -->
  <script>
	$(document).ready(function(){
		showElementSlowly("slow");

	});

	// event slide
	$(".event-slide").slick({
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
				},
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
				},
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
				},
			},
		],
	});

	
	if ($(window).width() < 768) {
		tabIdElm = ['#menuBar'];
		tabIdElm.push('#imgLogoMobile')
	}
	else 
	{
		tabIdElm = ['#imgHome','#menuBar'];
		tabIdElm.push('#imgLogo');
	}
	tabIdElmAfter = ['#backh1','#descriptionHome','#downHome','#appHome','#googleHome','#othElem1','#othElem2','#othElem3','#copyrights'];
	tabIdElm = tabIdElm.concat(tabIdElmAfter);
	indice = 0;
	
	function showElementSlowly(rythme){
	 $(tabIdElm[indice]).slideDown(rythme, function(){
		if(indice < tabIdElm.length)
			indice++;
			showElementSlowly('fast');
		});
	}
	
	changeMock();
	
	
	$( "#b1" ).mouseover(function() {
		$( "#b1" ).css( "background-color","rgba(236, 250, 248, 1)" );
	});
	
	$( "#b2" ).mouseover(function() {
		console.log('kk');
		$( "#b1" ).css( "background-color","rgb(251,251,251)" );
	});
	$( "#b3" ).mouseover(function() {
		$( "#b1" ).css( "background-color","rgb(251,251,251)" );
		});
	$( "#b4" ).mouseover(function() {
		$( "#b3" ).css( "background-color","rgb(251,251,251)" );
	});
		
	tabEvents = new Array();
	indx = 0;
	changeListEvent(0);		
	function changeListEvent(id)
	{
		let all = document.getElementsByClassName("swiper-slide");
		for(var i = 0; i < all.length; i++) {
			if(id == 0 && i==0){
				all[i].style.background = 'rgba(63, 202, 185, 1)';
				all[i].style.color = 'white';
			}
			else{
				all[i].style.background = '#fff';
				all[i].style.color = 'rgb(66, 66, 66)';
			}
		}

		idActive = '[id=' + 'idcat'+id.toString() + ']';
		let elem = document.getElementById(idActive);
		let array = $(idActive);

		for (let i = 0; i < array.length; i++) {
			array[i].style.background = 'rgba(63, 202, 185, 1)';
			array[i].style.color = 'white';
		} 

		indx = 0;
		$.ajax({
			url : '<?php echo base_url(); ?>/event/changeList', // La ressource ciblée
			dataType : 'json',
			type : 'POST', // Le type de la requête HTTP.
				data:{ idCategory:id
			},success:function(data){
				tabEvents = data.data;
			showEventByIndex(true);
			},
		});
		
	}
	function showEventByIndex(isNext)
	{
		console.log(tabEvents);
		if(isNext)
		{
			showView(indx,tabEvents.length);
		}
	}
	function showView(begin,end)
	{
		/*list ="";
		$.each(tabEvents, function(key, value) {	
			if(value.price != null) list = list+'<div class="item evenement"><img class="imgEvent" width="100%" src="'+value.image+'" alt=""><br/><br/><p class="title"> '+value.name+'</p> <p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indication.png" alt=""> '+value.placeName+'</p><p class="details ville" style="padding-left:7%"> '+value.nameCity+'</p><p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indicationdate.png" style="width: 12%;height: 12%;" alt=""> <span class="eventText"> Le '+value.dateBegin+' </span> </p><p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indicationPrix.png"> '+value.price+' </p></div>';  								
			else list = '<div class="item evenement"><img class="imgEvent"  width="100%" src="'+value.image+'" alt=""><br/><br/><p class="title"> '+value.name+'</p> <p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indication.png" alt=""> '+value.placeName+'</p><p class="details ville" style="padding-left:7%"> '+value.nameCity+'</p><p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indicationdate.png" style="width: 12%;height: 12%;" alt=""> <span class="eventText"> Le '+value.dateBegin+' </span> </p></div>';  
		});	
		
		$('#listEvent').html(list);
		$('#updatedSlider').multislider();
		$('#exampleSlider').multislider({
			interval:7000,
			slideAll:true,
			pauseAbove:1
		});*/ 
	}
	
	

	function changeListCatBef()
	{
		//Getting list cat
		$.ajax({
			url : '<?php echo base_url(); ?>/services/category/list', // La ressource ciblée
			dataType : 'json',
			type : 'POST', // Le type de la requête HTTP.
				data:{ 
			},success:function(data){
				
				tabNotVisible = new Array();
				tabVisible = new Array();
				
				$('label[id^=ca]').each(function() {
					if(jQuery.inArray(this.id.substring(2), data) != -1){
						name = arr.findIndex(function (entry, i) {
							if (entry.id == this.id.substring(2)) {
								index = i;
								return entry.name;
							}
						});
						console.log(name);
						tabVisible.push(this.id.substring(2)+'-'+name);
					}
					else tabNotVisible.push(this.id.substring(2)+'-'+data[jQuery.inArray(this.id.substring(2), data)].name);
				});
				
				ind0 = tabVisible[0];
				tabVisible.shift();
				tabVisible.push(tabNotVisible[0]);
				/*tabNotVisible.shift();
				$.each(tabNotVisible, function( index, value ) {
					tabVisible.push(value);
				});
				tabVisible.push(ind0);*/
				console.log(tabVisible);
				
				$('#listcategory').html();
				el = '<?php $count = 0; ?>';
				
				$.each(tabVisible, function( index, value ) {
					el=el+'<span onclick="changeListEvent('+value+')" class="titleCat <?php if($count>1 && $count<=4){ echo "dern".$i;$i++;} else if($count>4) echo "dern"; else echo "";?>"><label class="';
					if(tabVisible[0] == value) el=el+'active" id="ca'+value+'" style="font: 18px \'OpenSans-Bold\' !important;text-align:left;">'+value+'</label> </span>';
					else el=el+'" id="ca'+value+'" style="font: 18px \'OpenSans-Bold\' !important;text-align:left;">'+value+'</label> </span>';
				});
				el=el+'<img class="" style="display: flex;flex-direction: row;justify-content: center;align-items: center;position:static;float:right" onclick="changeListCatAft()" src="<?php echo base_url(); ?>/assets/img/Frame 26.png" alt=""><img class="" style="display: flex;flex-direction: row;justify-content: center;align-items: center;position:static;float:right;margin-right:1%" onclick="changeListCatBef()" src="<?php echo base_url(); ?>/assets/img/Frame 25.png" alt="">';
				$('#listcategory').html(el);
				
				/*
				$.each(tabNotVisible, function( index, value ) {
					a = '#ca'+value;
				   $(a).css('display','block');
				});
				$.each(tabVisible, function( index, value ) {
				  b = '#ca'+value;
				    $(b).css('display','none');
				});*/
				/*console.log(tab);
				var z = $.grep(data, function(el){return $.inArray(el, tab) == -1}); 
				console.log( z );*/
			},
		});
	}
	function changeListCatAft()
	{
		
	}

var buttons = $('.nextbutton');

//$('#listcategory').prepend($('#listcategory').find('span:last-child')); // prepend last element
//$('#listcategory').scrollTop(40); // scroll div to position 40 so first (div 10) not visible

$(buttons).each(function(){
  $(this).click(function(){  
	 var id = $(this).attr('id');
    if(id=="next"){
		$.ajax({
			url : '<?php echo base_url(); ?>/services/category/list/limit', // La ressource ciblée
			dataType : 'json',
			type : 'POST', // Le type de la requête HTTP.
				data:{ id:$('#listcategory').find('span:last label').attr("id").substring(2),prevornext:'next'
			},success:function(data){
				if(data.data.length !=0){	
					//$('#listcategory').find('span').remove();
					activefirst = false;
					if($('#listcategory').find('span:first label').attr('class') == 'active') {
						activefirst = true;
					}
					$('#listcategory').find('span:first').remove();
					$.each(data.data, function(key, value) {
							$('#listcategory').append('<span id="cat'+key+'" id="idcat'+value.idCategory+'" onclick="changeListEvent('+value.idCategory+')" class="titleCat"> <label id="ca'+value.idCategory+'" style="text-align:left;">'+value.name+'</label> </span>');
					});
					//$('#listcategory').find('span:first label').attr("class",'active');
					if(activefirst == true){
						$('#listcategory').find('span:first label').attr("class",'active');
					}
					changeListEvent($('#listcategory').find('span label[class="active"]').attr('id').substring(2));
				}	
			}
		});	
      	
    } else {
			//console.log($('#listcategory').find('span:first-child label').attr("id").substring(2));
			$.ajax({
			url : '<?php echo base_url(); ?>/services/category/list/limit', // La ressource ciblée
			dataType : 'json',
			type : 'POST', // Le type de la requête HTTP.
				data:{ id:$('#listcategory').find('span:first label').attr("id").substring(2),prevornext:'prev'
			},success:function(data){
				if(data.data.length !=0){
					activefirst = false;
					activelast = false;
					if($('#listcategory').find('span:first label').attr('class') == 'active') {
						activefirst = true;
					}
					if($('#listcategory').find('span:last label').attr('class') == 'active') {
						activelast = true;
					}
					$('#listcategory').find('span:last').remove();
					//$('#listcategory').find('span').remove();
					$.each(data.data, function(key, value) {
							$('#listcategory').prepend('<span id="cat'+key+'" onclick="changeListEvent('+value.idCategory+')" class="titleCat"> <label id="ca'+value.idCategory+'" style="text-align:left;">'+value.name+'</label> </span>');
					});
					
					if(activelast == true){
						$('#listcategory').find('span:last label').attr("class",'active');
					}
					//$('#listcategory').find('span:first label').attr("class",'active');
					changeListEvent($('#listcategory').find('span label[class="active"]').attr('id').substring(2));
				}
			}
		});	
		
    }
	 $('#listcategory').stop().animate({scrollTop:40},400,'swing'); // then scroll
  })
});
	function changeMock()
	{
		$( ".b2min" ).click(function() {
		$( ".minMock").html('<img class="" id="container_img" style="width:100%" src="<?php echo base_url(); ?>/assets/img/Feed.png" alt="">');
		});
		$( ".b3min" ).click(function() {
			$( ".minMock").html('<img class="" id="container_img" style="width:100%" src="<?php echo base_url(); ?>/assets/img/map.png" alt="">');
		});
		$( ".b4min" ).click(function() {
			$( ".minMock").html('<img class="" id="container_img" style="width:100%" src="<?php echo base_url(); ?>/assets/img/search.png" alt="">');
		});
		$( ".b1min" ).click(function() {
			$( ".minMock").html('<img class="" id="container_img" style="width:100%" src="<?php echo base_url(); ?>/assets/img/Notification.png" alt="">');
		});
		$( ".b1max" ).click(function() {
			$( ".maxMock").html('<img class="" id="container_img" style="width:100%" src="<?php echo base_url(); ?>/assets/img/Notification.png" alt="">');
		});
		$( ".b2max" ).click(function() {
			$( ".maxMock").html('<img class="" id="container_img" style="width:100%" src="<?php echo base_url(); ?>/assets/img/Feed.png" alt="">');
		});
		$( ".b3max" ).click(function() {
			$( ".maxMock").html('<img class="" id="container_img" style="width:100%" src="<?php echo base_url(); ?>/assets/img/map.png" alt="">');
		});
		$( ".b4max" ).click(function() {
			$( ".maxMock").html('<img class="" id="container_img" style="width:100%" src="<?php echo base_url(); ?>/assets/img/search.png" alt="">');
		});
	}

	 var swiper = new Swiper(".mySwiper", {
        slidesPerView: 'auto',
        spaceBetween: 30,
        slidesPerGroup: 3,
		 		loop: false,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
	 //  swiper.swipeTo(0);

	function nextClicked() 
	{
		var nextSlide = document.getElementById("next-slide");
		var count = eval(nextSlide.value) + eval(1);
		nextSlide.value = count;

		if(count > 0)
		{
			document.getElementById("previous-slide").style.display = "initial";
		}
	}

	function previousClicked() 
	{
		var nextSlide = document.getElementById("next-slide");
		var count = eval(nextSlide.value) - eval(1);
		nextSlide.value = count;

		if(count == 0)
		{
			document.getElementById("previous-slide").style.display = "none";
		}
	}
	
</script>

</body>
</html>

