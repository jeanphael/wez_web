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
    padding-top: 150px;
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


@font-face {
    font-family: "Gilroy-light";
    src: url(<?php echo base_url()?>/assets/font/Gilroy-Light.ttf);
}
ul li{
	list-style : disc !important;
	
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
.h2conf {
	font: 24px 'Gilroy-SemiBold' !important;
	color : rgba(112, 118, 118, 1) !important;
}
.med p{
	font: 16px 'Gilroy-Medium' !important;
	color : rgba(112, 118, 118, 1) !important;
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
        <ul class="nav navbar-nav navbar-right ins"  <?php $session = \Config\Services::session(); if($session->get('userSession') != null){ echo "style='display:none'"; } else echo "style='display:block;'"; ?>>
          <li class="title1"><a href="<?php echo base_url('inscription'); ?>" style="" class="amenu smoothscroll">Inscription</a></li>
        </ul>
		<ul class="nav navbar-nav navbar-right conne"  <?php $session = \Config\Services::session(); if($session->get('userSession') != null){ echo "style='display:none'"; } else echo "style='display:block;'"; ?>>
          <li class="title1" ><a href="<?php echo base_url('connexion'); ?>" class="amenu smoothscroll">Connexion</a></li>
        </ul>
		<ul class="nav navbar-nav navbar-right mese" <?php $session = \Config\Services::session(); if($session->get('userSession') != null){ echo "style='display:block'"; } else echo "style='display:none;'"; ?>>
          <li class="title1" ><a href="<?php echo base_url('evenement-list-refonte'); ?>" class="amenu smoothscroll">Mes &eacute;v&egrave;nements</a></li>
        </ul>
		<ul class="nav navbar-nav navbar-right">
          <li class="title1"><a href="<?php echo base_url('evenement/ajout'); ?>" class="amenu smoothscroll">Cr&eacute;er un &eacute;v&egrave;nement</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>

<div id="headerwrap">
    <div class="container">
      <div class="row med">
	   <div class="col-lg-12" style="text-align:left !important">
        <h1 style="color:rgba(112, 112, 112, 1) !important;font:28px 'Gilroy-bold' !important">Politique de confidentialit&eacute;</h1>
		<p style="color:rgba(112, 112, 112, 1) !important;font:14px 'Gilroy-light' !important">Dernière mise à jour le 20 Mars 2022</p>
		<br/>
		<h2 class="h2conf">1.	Usage général. </h2>
		<p style="line-height:1.3em">Les données personnelles que vous nous soumettez sont utilisées soit pour répondre aux demandes que vous faites, soit pour nous aider à mieux vous servir. Nous utilisons vos données personnelles des manières suivantes :</p>
		<ul style="line-height:2em">
			<li>Pour faciliter la création de et aider nos efforts pour sécuriser votre compte.</li>
			<li>Pour vous identifier en tant qu'utilisateur de notre système.</li>
			<li>Pour améliorer l'administration de nos Services.</li>
			<li>Pour fournir les Services que vous demandez.</li>
			<li>Pour améliorer la qualité de l'expérience lorsque vous interagissez avec nos Services.</li>
			<li>Pour vous envoyer un e-mail de bienvenue pour vérifier la propriété de l'adresse e-mail fournie lors de la création de votre compte.</li>
			<li>Pour vous envoyer des notifications administratives par e-mail, telles que des avis de sécurité ou d'assistance et de maintenance.</li>
			<li>Pour envoyer des newsletters, des sondages, des offres et d'autres supports promotionnels liés à nos Services et à d'autres fins de marketing.</li>
		</ul>
		<br/><h2 class="h2conf">2.	Sécurité de vos données personnelles</h2>
			<p style="line-height:1.3em">Nous nous engageons à protéger la sécurité de vos données personnelles. Nous utilisons une variété de technologies et de procédures de sécurité standard de l'industrie pour aider à protéger vos données personnelles contre l'accès, l'utilisation ou la divulgation non autorisés. Nous vous demandons également de saisir un mot de passe pour accéder à votre compte. Veuillez ne pas divulguer le mot de passe de votre compte à des personnes non autorisées. Cependant, aucune méthode de transmission sur Internet, ou méthode de stockage électronique, n'est sécurisée à 100 %. Par conséquent, bien que nous fassions des efforts raisonnables pour protéger vos données personnelles, nous ne pouvons pas et ne garantissons pas leur sécurité absolue.</p>
			<br/><h2 class="h2conf">3.	Modification ou suppression de vos données personnelles.</h2>
			<p style="line-height:1.3em">Vous pouvez modifier n'importe laquelle de vos données personnelles dans votre compte en modifiant votre profil. Vous pouvez supprimer vos données personnelles par vous-même. Lorsque vous supprimez vos informations, elles seront supprimées de la base de données active, mais peuvent rester dans nos archives. Nous pouvons également conserver vos informations à des fins de détection de fraude ou à des fins similaires</p>
		
	   </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /headerwrap -->

  <div class="container">
   
   
   
    </div>
	
    <!-- /row -->
  </div>
    
  <!-- /container -->
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
							console.log(value.idCategory);
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
		$.ajax({
			url : '<?php echo base_url(); ?>/services/category/list', // La ressource ciblée
			dataType : 'json',
			type : 'POST', // Le type de la requête HTTP.
				data:{ 
			},success:function(data){
				$.each(data.data, function(key, value) {
					
						if(value.idCategory == $('#listcategory').find('span label.active').attr("id").substring(2))
						{
							nex = data.data[key-1];
							console.log(nex.idCategory);
							console.log("uu");
						}
					
					
				});
				$('#listcategory').prepend($('#listcategory').find('span label.active#ca'+nex.idCategory));
			}
		});
    }
    $('#listcategory').stop().animate({scrollTop:40},400,'swing'); // then scroll
  })
});

</script>

</body>
</html>

