 <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
     <a href="<?php $session = \Config\Services::session(); if($session->get('userType')== "admin") echo base_url('dashboard'); else echo "#"; ?>" class="logo"><b>Back<span>Office</span></b></a>
       <!--logo end-->
     <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li>
            <a class="logout" href="<?php echo base_url('login'); ?>">Se d&eacute;connecter</a>
          </li>
        </ul>
      </div>
    </header>