<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url(); ?>/assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url(); ?>/assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Flatty
    Template URL: https://templatemag.com/flatty-bootstrap-app-landing-page-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
<style>
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

@media only screen and (min-width:768px) {
	#listcategor {
    overflow: hidden;
    background: green;
    padding: 10px;
	width: 300px !important;
    height: 250px !important;
}

#listcategor span {
   display: block;
    padding: 10px 10px;
    margin-bottom: 10px;
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
}
@media only screen and (max-width:768px) {
	 .dern{
		display:none;
	}
	 .dern8{
	display:none !important;
	}
	#footerxs20{
		padding-left : 20% !important;
	}
}
@media only screen and (max-width:480px) {
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
		font-size : 9px !important;
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



.item:last-child {
    margin-bottom: 0px;
}

</style>
</head>

<body style="font:18px 'Gilroy', sans-serif !important;background-color:rgb(251,251,251) !important">

  <!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top"  style="padding-top:2%;margin-bottom:0px !important;padding-bottom:0px !important">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <img src="<?php echo base_url('assets/img/logohomeMenu.png'); ?>"  style="float:left;padding:4%" />
        <a class="navbar-brand" href="#"><b></b></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo base_url('inscription'); ?>" style="background: #2C8D82;border-radius: 8px;color:white;" class="amenu smoothscroll">Inscription</a></li>
        </ul>
		<ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo base_url('connexion'); ?>" class="amenu smoothscroll">Connexion</a></li>
        </ul>
		<ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo base_url('evenement/ajout'); ?>" class="amenu smoothscroll">Cr&eacute;er un &eacute;v&egrave;nement</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>

  <div id="headerwrap">
    <div class="container">
      <div class="row">
	  <div class="col-lg-12">
        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 xs12">
		 <p><?php echo $message; ?></p>
        	 <img src="<?php echo base_url('assets/img/logohome.png'); ?>"  />
        	  <h1 class="text-left" style="color:rgba(39, 48, 48, 1) !important;font:48px 'Gilroy-bold' !important">D&eacute;couvrez de grands évènements ou créez les v&ocirc;tres</h1>
			  <p class="text-left" style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important">Wez rapproche les gens graces à des expériences en direct.Découvrez des evenements qui correspondent à vos passions ou creez votre propre evenement</p>
			  <p class="text-left" style="font: 16px 'Gilroy-semibold' !important">Téléchargez wez maintenant</p>
			 <div class="row">
				  <div class="col-lg-4 col-md-5 col-sm-5 col-xs-5" style="background-color:rgb(44,141,130);color:white !important;margin:2%;padding:1%;border-radius:5%">
					 <div class="row">
						 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align: center;height:100%;padding:10%"><img src="<?php echo base_url(); ?>/assets/img/apple.png" /></div>
						 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:2% !important;padding-right:1% !important;padding-top:5% !important"><p style="font-size:12px !important;margin-bottom:0px !important" class="text-left">Disponible sur:</p>
							<p class="text-left open"> Apple store</p>
						</div>
					</div>
				  </div>
				  <div class="col-lg-4 col-md-5 col-sm-5 col-xs-5" style="background-color:rgb(44,141,130);color:white !important;margin:2%;padding:1%;border-radius:5%">
					<div class="row">
						 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align: center;height:100%;padding:10%">
						<img src="<?php echo base_url(); ?>/assets/img/Playstore.png">
						</div>
						 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:2% !important;padding-right:1% !important;padding-top:5% !important">
						 <p style="font-size:12px !important;margin-bottom:0px !important" class="text-left">Disponible sur:</p>
							<p class="text-left open"> Google play</p>
						</div>
				  </div>
				</div>
			</div>
		</div>
        <!-- /col-lg-6 -->
        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 xsHome100">
          <img class="" src="<?php echo base_url(); ?>/assets/img/imgHome.PNG" width="90%" height="auto" alt="">
        </div>
        <!-- /col-lg-6 -->
	</div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /headerwrap -->


  <div class="container">
   
    <!-- /row -->

    <div class="row mt centered">
	  <div class="col-lg-12">
        <h1 style="color:rgba(39, 48, 48, 1) !important;font:48px 'Gilroy-bold' !important">Les fonctionnalités de wez</h1>
		<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important">Iorem ipsum dolor sit amet, consectetur adipiscing elit. Dolor malesuada cum amet viverra eu molestie </p>
       </div>
      </div><!--/col-lg-4 -->
	   <div class="row mt centered">
			<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 text-right" style="padding:5%;">
				<div class="row" id="b1" style="padding:5%;background-color:rgba(236, 250, 248, 1)">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-notification.png" alt="" style="text-align:right">
				 </br> </br>
				<p  style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important"> Notifications</p>
				<p  style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">Etre informé des nouvelles evenements à venir</p>
				</div>
				</br></br></br>
				<div class="row" id="b2" style="padding:5%">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-nbevenement.png" alt="" style="text-align:right">
				 </br> </br>
				<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important"> Plus de 10000 super evenements</p>
				<p style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">Iorem ipsum dolor sit amet, consectetur adipiscing elit </p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 block-center" style="padding-top:5%;padding-left:7%;padding-right:7%">
			   <img class="" style="width:100%;" src="<?php echo base_url(); ?>/assets/img/imgTelephone.png" alt="">
 
			</div>
			<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 text-left"  style="padding:5%">
				<div class="row" id="b3" style="padding:5%">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-localisation.png" alt="">
				 </br> </br>
				<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important"> Localiser les ventes de billets facilement</p>
				<p style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">Iorem ipsum dolor sit amet, consectetur adipiscing elit </p>
				</div>
				</br></br></br>
				<div class="row" id="b4" style="padding:5%">
				 <img class="" src="<?php echo base_url(); ?>/assets/img/icon-recherche.png" alt="">
				 </br> </br>
				<p style="color:rgba(112, 118, 118, 1) !important;font:20px 'Gilroy-Medium' !important"> Recherche rapide et facile</p>
				<p style="color:rgba(112, 118, 118, 1) !important;font:16px 'Gilroy-Medium' !important">Iorem ipsum dolor sit amet, consectetur adipiscing elit </p>
				</div>
			</div>
      </div><!--/col-lg-4 -->
	  
    </div>
	
    <!-- /row -->
  </div>
  <!-- /container -->
<br/>
<?php if(isset($listCat)){ ?>
  <div class="container">
    <div class="row mt centered" style="margin-top:5%">
       <div class="col-lg-3">
			<h3 style="color:black !important;font:34px 'Gilroy-Medium' !important;padding:1%;text-align:left">Rejoignez les évènements populaires de cette semaine</h3>
	    </div>
		<div class="col-lg-9">
			<div class="row" id="listcategory" style="font: 18px 'OpenSans-Bold' !important;color:black;text-align:left;margin-left:2%;margin-right:2%"> 
				<?php $count = 0;$i=1; foreach($listCat as $cat){ ?>
				<span id="cat<?php echo $i;?>" onclick="changeListEvent(<?php echo $cat['idCategory'];?>)" class="titleCat <?php if($count>1 && $count<=4){ echo "dern".$i;$i++;} else if($count==5) echo "dern8"; else if($count>5) echo "dern"; else echo "";?>"><label class="<?php if ($count==0) echo "active";  ?>" id="ca<?php echo $cat['idCategory'];?>" style="font: 18px 'OpenSans-Bold' !important;text-align:left;"><?php echo $cat['name'];?></label> </span>
				<?php $count++; $i++;} ?>
				<!--span style="font: 18px 'OpenSans-Bold' !important;color:black;text-align:left;" class="titleCat">Cabaret</span>
				<span style="font: 18px 'OpenSans-Bold' !important;color:black;text-align:left;" class="titleCat"> Sports</span>
				<span style="font: 18px 'OpenSans-Bold' !important;color:black;text-align:left;" class="titleCat dern1"> Conférences</span>
				<span style="font: 18px 'OpenSans-Bold' !important;color:black;text-align:left;" class="titleCat dern2"> Culture</span>
				<span style="font: 18px 'OpenSans-Bold' !important;color:black;text-align:left;" class="titleCat dern3"> Politiques</span>
				<span style="font: 18px 'OpenSans-Bold' !important;color:black;text-align:left;" class="titleCat dern"> Foire</span-->
				
					<img class="nextbutton"  id="next" style="display: flex;
flex-direction: row;
justify-content: center;
align-items: center;position:static;float:right" onclick="changeListCatAft()" src="<?php echo base_url(); ?>/assets/img/Frame 26.png" alt="">
				<img class="nextbutton" id="prev" style="display: flex;
flex-direction: row;
justify-content: center;
align-items: center;position:static;float:right;margin-right:1%" src="<?php echo base_url(); ?>/assets/img/Frame 25.png" alt="">
			
			</div>
			<div class="row" id="listEvent"> 
				
			</div>
	    </div>
    </div>
    <!-- /row -->

   </div>
   <?php } ?>
   <br/>
 <div class="container"> 
	<div class="row mt centered">
          <img class="" style="width:100%" src="<?php echo base_url(); ?>/assets/img/imgTelechargement.png" alt="">
        </div>
 </div>
 <br/>
  <div id="copyrights">
    <div class="container">
	</br>
      <div class="row">
        <div class="col-lg-9 text-left col-md-8 col-sm-8 col-xs-8">
			<p><img src="<?php echo base_url(); ?>/assets/img/footerLogo.png"></p>
			</br><p><img style="padding-right:1%" src="<?php echo base_url(); ?>/assets/img/footerPhone.png">+261340000000
			<img style="padding-left:3%;padding-right:1%" src="<?php echo base_url(); ?>/assets/img/envelop.png">Wez@gmail.com</p>
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
				<img style="float:left" src="<?php echo base_url(); ?>/assets/img/footer2022.png">
				 <div style="padding-left:50%" id="footerxs20">
					 <a class="footlink" href="<?php echo base_url('utilisation'); ?>">Condition g&eacute;n&eacute;rale d'utilisation</a>
					 <a class="footlink" href="<?php echo base_url('confidentialite'); ?>">Politique de confidentialit&eacute</a>
					 <a class="footlink">Cookies</a>
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

  <!-- JavaScript Libraries -->
  <script src="<?php echo base_url(); ?>/assets/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/lib/php-mail-form/validate.js"></script>
  <script src="<?php echo base_url(); ?>/assets/lib/easing/easing.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
  <script>
  
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
		$( "#b1" ).css( "background-color","rgb(251,251,251)" );
	});
	function changeListEvent(id)
	{
		$.ajax({
			url : '<?php echo base_url(); ?>/event/changeList', // La ressource ciblée
			dataType : 'json',
			type : 'POST', // Le type de la requête HTTP.
				data:{ idCategory:id
			},success:function(data){
				var list = "";
				$('#listEvent').html("");
				var price="";
				$.each(data.data, function(key, value) {
					
					if(value.price != null) list = list+'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="box-shadow: 0px 4px 8px rgba(116, 120, 120, 0.25);border-radius: 16px;background-color:white;height:100%;text-align:left;margin-right:2%;width:31%;padding-top:2%"><img class="imgEvent" width="100%" src="'+value.image+'" alt=""><br/><br/><p class="title"> '+value.name+'</p> <p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indication.png" alt=""> '+value.placeName+'</p><p class="details ville" style="padding-left:7%"> '+value.nameCity+'</p><p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indicationdate.png" alt=""> Le '+value.dateBegin+'</p><p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indicationPrix.png" alt=""> '+value.price+'</p></div>';  								
					else list = '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="box-shadow: 0px 4px 8px rgba(116, 120, 120, 0.25);border-radius: 16px;background-color:white;height:100%;text-align:left;margin-right:2%;width:31%;padding-top:2%"><img class="imgEvent"  width="100%" src="'+value.image+'" alt=""><br/><br/><p class="title"> '+value.name+'</p> <p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indication.png" alt=""> '+value.placeName+'</p><p class="details ville" style="padding-left:7%"> '+value.nameCity+'</p><p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indicationdate.png" alt=""> Le '+value.dateBegin+'</p></div>';  
				});
				$('label[id^=ca]').attr('class', '');
				$('#ca'+id).attr('class', 'active');
				$('#listEvent').html(list);	
			},
		});
	}
	$.ajax({
			url : '<?php echo base_url(); ?>/event/changeList', // La ressource ciblée
			dataType : 'json',
			type : 'POST', // Le type de la requête HTTP.
				data:{ idCategory:5
			},success:function(data){
				var list = "";
				$('#listEvent').html("");
				var price="";
				$.each(data.data, function(key, value) {
					if(value.price != null) list = list+'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="box-shadow: 0px 4px 8px rgba(116, 120, 120, 0.25);border-radius: 16px;background-color:white;height:100%;text-align:left;margin-right:2%;width:31%;padding-top:2%"><img class="imgEvent" width="100%" src="'+value.image+'" alt=""><br/><br/><p class="title"> '+value.name+'</p> <p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indication.png" alt=""> '+value.placeName+'</p><p class="details ville" style="padding-left:7%"> '+value.nameCity+'</p><p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indicationdate.png" alt=""> Le '+value.dateBegin+'</p><p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indicationPrix.png" alt=""> '+value.price+'</p></div>';  								
					else list = '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="box-shadow: 0px 4px 8px rgba(116, 120, 120, 0.25);border-radius: 16px;background-color:white;height:100%;text-align:left;margin-right:2%;width:31%;padding-top:2%"><img class="imgEvent"  width="100%" src="'+value.image+'" alt=""><br/><br/><p class="title"> '+value.name+'</p> <p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indication.png" alt=""> '+value.placeName+'</p><p class="details ville" style="padding-left:7%"> '+value.nameCity+'</p><p class="details"> <img class="imgInd" src="<?php echo base_url(); ?>/assets/img/indicationdate.png" alt=""> Le '+value.dateBegin+'</p></div>';  
				});
				$('label[id^=ca]').attr('class', '');
				$('#ca5').attr('class', 'active');
				$('#listEvent').html(list);	
			},
		});
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
			url : '<?php echo base_url(); ?>/services/category/list', // La ressource ciblée
			dataType : 'json',
			type : 'POST', // Le type de la requête HTTP.
				data:{ 
			},success:function(data){
				
				
				/*$('label[id^=ca]').each(function() {
					if(this.id.substring(2) == $('#listcategory').find('span:last-child')){
						idSuivant = this.id.substring(2);
						console.log(idSuivant);
						 $('#listcategory').append($('#listcategory').find('span#cat'+idSuivant));   //do modification first    
						 return;
					}
				});*/
				// $('#listcategory').append($('#listcategory').find('span.dern label'));
				//console.log($('#listcategory span.dern label').attr("id").substring(2));
				$.each(data.data, function(key, value) {
					if($('#listcategory').find('span.dern label')!= undefined)
					{
						if(value.idCategory == $('#listcategory').find('span.dern label').attr("id").substring(2))
						{
							nex = data.data[key];
						}
					}
					
				});
				$('#listcategory').find('span.dern8').attr("class","titleCat");
				$('#listcategory').find('span.dern8').css("display","block");
				if($('#listcategory').find('span.dern label')!= undefined)
				{
						console.log($('#listcategory').find('span.dern label#ca'+nex.idCategory).text());
					$('#listcategory').find('span.dern label#ca'+nex.idCategory).parent().attr("class",'dern8');
				}
				 $('#listcategory').find('span:first-child').remove();
				$('#listcategory').find('span:first-child label').attr("class",'active');
				 
				 changeListEvent($('#listcategory').find('span:first-child label').attr("id").substring(2));
			}
		});		
      	
    } else {
			//console.log($('#listcategory').find('span:first-child label').attr("id").substring(2));
				
		$.ajax({
			url : '<?php echo base_url(); ?>/services/category/list', // La ressource ciblée
			dataType : 'json',
			type : 'POST', // Le type de la requête HTTP.
				data:{ 
			},success:function(data){
				index = data.data.findIndex(object => {
				  return object.idCategory === $('#listcategory').find('span:first-child label').attr("id").substring(2);
				});
				console.log(index);
				if(index !=0)
				{
					index = index-1;
					data.data.map(object => object.idCategory);
					var objectFound = data.data[index];
					console.log(objectFound);
					$('#listcategory').find('span:last-child').remove();
					$('#listcategory').prepend('<span id="cat'+(index+1)+'" onclick="changeListEvent('+objectFound.idCategory+')" class="titleCat"> <label class="" id="ca'+objectFound.idCategory+'" style="font: 18px \'OpenSans-Bold\' !important;text-align:left;">'+objectFound.name+'</label> </span>');
					$('#listcategory').find('span:first-child label').attr("class",'active');
				}
				
			//	console.log(nex.idCategory);
			//	$('#listcategory').prepend($('#listcategory').find('span label.active#ca'+nex.idCategory));
			}
		});
    }
    $('#listcategory').stop().animate({scrollTop:40},400,'swing'); // then scroll
  })
});

</script>

</body>
</html>

