<?php  $session = \Config\Services::session();   
      if($_SESSION['userType'] == "admin"){ ?>
	<aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start class="img-circle"-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="<?php echo base_url('user_update'); ?>"><img src="<?php echo $_SESSION['sessionImg'];  ?>" width="80" height="80"></a></p>
          <h5 class="centered"><?php echo $_SESSION['userName']; ?> </h5>
          <!--li class="mt">
            <a class="active" href="<?php //echo base_url('dashboard'); ?>">
              <i class="fa fa-dashboard"></i>
              <span>Tableau de bord</span>
              </a>
          </li-->
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>Evenement</span>
              </a>
            <ul class="sub">
			          <li><a href="<?php echo base_url('event_new'); ?>">Nouvel evenement</a></li>
                <li><a href="<?php echo base_url('event_list'); ?>">Evenements publi&eacute;s</a></li>
                <li><a href="<?php echo base_url('event_list_tovalidate'); ?>">Evenements &agrave; valider</a></li>
                <li><a href="<?php echo base_url('event_list_notPublished'); ?>">Evenements non affichés</a></li>
          			<li><a href="<?php echo base_url('event_similar'); ?>">Evenement similaire</a></li>
            </ul>
          </li>
		  <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>Point de vente</span>
              </a>
            <ul class="sub">
              <li><a href="<?php echo base_url('pos_list'); ?>">Liste</a></li>
              <li><a href="<?php echo base_url('pos_new'); ?>">Nouveau point de vente</a></li>
            </ul>
          </li>
		  <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>Organisateur</span>
              </a>
            <ul class="sub">
             <li><a href="<?php echo base_url('organizer_list'); ?>">Liste</a></li>
              <li><a href="<?php echo base_url('organizer_new'); ?>">Nouvel organisateur</a></li>
              <!--li><a href="<?php // echo base_url('organizer_follow'); ?>">Suivi organisateur</a></li-->
            </ul>
          </li>
		  <!--li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Agenda</span>
              </a>
            <ul class="sub">
              <li><a href="<?php echo base_url('agenda_list'); ?>">Liste par utilisateur</a></li>
            </ul>
          </li-->
		  <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-tasks"></i>
              <span>Utilisateur</span>
              </a>
            <ul class="sub">
              <li><a href="<?php echo base_url('user_list'); ?>">Liste</a></li>
              <li><a href="<?php echo base_url('user_manage_admin'); ?>">Gestion Administrateur</a></li>
              <!--li><a href="<?php //echo base_url('user_update'); ?>">Réinitialisation mot de passe</a></li-->
            </ul>
          </li>
		  <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-cogs"></i>
              <span>Gestion</span>
              </a>
            <ul class="sub">
              <li><a href="<?php echo base_url('rate'); ?>">Tarif évènement</a></li>
              <li><a href="<?php echo base_url('place'); ?>">Lieu</a></li>
               <li><a href="<?php echo base_url('category'); ?>">Cat&eacute;gorie</a></li>
			   <li><a href="<?php echo base_url('city'); ?>">Ville</a></li>
			        <li><a href="<?php echo base_url('event_price_manage'); ?>">Coût d'affichage</a></li>
         
            </ul>
          </li>
       </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>

    <?php  }
    else{ ?>


      <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="<?php echo base_url('user_update'); ?>"><img src="<?php echo $_SESSION['sessionImg'];  ?>" class="img-circle" height="80" width="80"></a></p>
          <h5 class="centered"><?php echo $_SESSION['userName']; ?> </h5>
          <!--li class="mt">
            <a class="active" href="<?php //echo base_url('dashboard'); ?>">
              <i class="fa fa-dashboard"></i>
              <span>Tableau de bord</span>
              </a>
          </li-->
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>Evenement</span>
              </a>
            <ul class="sub">
      <li><a href="<?php echo base_url('event_list'); ?>">Liste</a></li>
              <li><a href="<?php echo base_url('event_new'); ?>">Nouvel evenement</a></li>
        <li><a href="<?php echo base_url('event_similar'); ?>">Evenement similaire</a></li>
            </ul>
          </li>
      <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>Point de vente</span>
              </a>
            <ul class="sub">
              <li><a href="<?php echo base_url('pos_list'); ?>">Liste</a></li>
              <li><a href="<?php echo base_url('pos_new'); ?>">Nouveau point de vente</a></li>
            </ul>
          </li>
     
      
      
      <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-cogs"></i>
              <span>Configuration</span>
              </a>
            <ul class="sub">
              <li><a href="<?php echo base_url('rate'); ?>">Tarif</a></li>
            </ul>
          </li>
       </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>

<?php }  ?>