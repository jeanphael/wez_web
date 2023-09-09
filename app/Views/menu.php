<nav class="navbar navbar-default menu" id="custom_menu">
  
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
      <div style="margin-top: 18px;margin-bottom: 18px;margin-left: 48px;margin-right: 48px;width: 103px;height: 32px;background: transparent url('<?php echo base_url();?>/assets/img/wez-logo.png') 0% 0% no-repeat padding-box;"></div>
   
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
      <ul class="nav navbar-nav navbar-right" style="margin-top:10px;margin-bottom:10px">
	    <li><a href="<?php echo base_url("evenement-list-refonte");?>">Evenements</a></li>
		 <?php 
		 $session = \Config\Services::session(); 
		 if($_SESSION['userType'] == "admin"){ ?>
		<li><a href="<?php echo base_url("organisateur-list-refonte");?>">Organisateur</a></li>
		<li><a href="<?php echo base_url("utilisateur-list-refonte");?>">Utilisateur</a></li>
    <li><a href="<?php echo base_url("administrateur-list-refonte");?>">Administrateurs</a></li>
    <li><a href="<?php echo base_url("gestion/cout");?>">Gestion</a></li>
	<?php } ?>
		<li class="dropdown">
      <a href="#" class="glyphicon glyphicon-bell dropdown-toggle " style="position: relative;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php if(!empty($listEventsToValidate) || !empty($listEventsRejected)){  ?><span class="badge badge-light" style="background-color:red;position: absolute;top: 2px;right: 2px;"> <?php  echo(sizeof($listEventsToValidate)+sizeof($listEventsRejected));?></span><?php } ?></a>
      <ul class="dropdown-menu">
         <?php if(!empty($listEventsToValidate)){?><li><a href="<?php echo base_url("evenement-info-avalider?iE=av");?>" style="color:#797979 !important">  A valider:<?php echo(sizeof($listEventsToValidate));?></a></li>
        <hr/>  <?php } else echo "<li style='padding-left:10%;padding-top:5%'> &agrave; valider:0</li>  <hr/>";?>
		<?php if(!empty($events)){?><li><a href="<?php echo base_url("event/list/published");?>" style="color:#797979 !important">Publi&eacute;:<?php echo(sizeof($events));?></a></li>
         <hr/> <?php } else echo "<li style='padding-left:10%;padding-top:5%'>Publi&eacute;:0</li>  <hr/>";?>
		 <?php if(!empty($listEventsRejected)){?><li><a href="<?php echo base_url("event/list/rejected");?>" style="color:#797979 !important">Rejet&eacute;:<?php echo(sizeof($listEventsRejected));?></a></li>
       <hr/>   <?php } else echo "<li style='padding-left:10%;padding-top:5%'>Rejet&eacute;:0</li>  <hr/>";?>
          <?php if(!empty($listEventsNotPublished)){?><li><a href="<?php echo base_url("event/list/notpublished");?>" style="color:#797979 !important">Non publi&eacute;:<?php echo(sizeof($listEventsNotPublished));?></a></li>
          <?php } else echo "<li style='padding-left:10%;padding-top:5%'>Non publi&eacute;:0</li> ";?>
          
		  
     </ul>
    </li>
		<li><a href="#">|</a></li>
		<!--li> <img  width="20" height="20" src=""></img-->
		<li style="padding-top:2%">	<img style="margin-right:5%;width:15px !important;height:15px !important;margin-top:10%;float:left;" src="<?php echo $_SESSION['sessionImg'];?>"/></li>
	 	<li class="dropdown">
	
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['userName'];?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url("profil");?>" style="color:#797979 !important">Configuration de compte</a></li>
            <li><a href="#" style="color:#797979 !important">Mes billets</a></li>
            <li><a href="<?php echo base_url("deconnexion");?>" style="color:#797979 !important">Se d&eacute;connecter</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
</nav>
