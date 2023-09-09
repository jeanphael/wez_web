<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
<style>
	.men{
			background-position: center center;
			text-align: center;
			background-color : white;
			border : solid transparent;
			margin: 20px;
			height: 200px;
			box-shadow: 0px 3px 2px #aab2bd;
			 border-radius: 10px;
			-webkit-border-radius: 10px;
			
	}
	.men h4{
		text-align: center;
		font-weight: 900;
		letter-spacing: 1px;
		
	}
	.evt.row{
		text-align : center;
		height: 50%;
	}
	.imgevt{
		
		width : 100%;
		height: 100%;
		//background-color: green; /* for visualization purposes */
		//display: inline-block;
		 display: -webkit-box;  /* OLD - iOS 6-, Safari 3.1-6, BB7 */
  display: -ms-flexbox;  /* TWEENER - IE 10 */
  display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
  display: flex;         /* NEW, Spec - Firefox, Chrome, Opera */

  justify-content: center;
  align-items: center;
	
		
	}
	.imgevt27{
		clip-path:ellipse(50% 50%);
		width : 60px;
		height: 60px;
		position: relative;
		 background-position: center center;
		background-repeat: no-repeat;
	overflow: hidden;
  display: inline-block;
  background-color:#c3c3c3;
  padding:10px;
		
		
	}
	.rowevt.row{
		height : 50%;
	}
	</style>
<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="#" class="logo"><b>Back<span>Office</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- settings start -->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
              <i class="fa fa-tasks"></i>
              <span class="badge bg-theme"><?php if(isset($listEvents) && sizeof($listEvents)!=0){ $nb = sizeof($listEvents); echo "".$nb;} ?></span>
              </a>
            <ul class="dropdown-menu extended tasks-bar">
              <div class="notify-arrow notify-arrow-green"></div>
              <li>

                <p class="green"><?php if($nb>0){ if($nb==1){ echo "1 nouvel evenement &agrave; valider";}
                else echo $nb." nouveaux evenements &agrave; valider";} else echo "Aucun evenement &agrave; valider"; ?></p>
              </li>
              <?php if($nb>0){
                foreach($listEvents as $row){ ?>
                    <li>

                      <a href="<?php echo base_url('event_list_tovalidate');?>">
                        <div class="task-info">
                          <div class="desc"><?=esc($row->name);?></div>
                          <div class="desc">Organisateur : <?=esc($row->nameOrganizer);?></div>
                        </div>
                      </a>
                    </li>
             <?php }}?>
              <!--li class="external">
                <a href="#">Voir tout</a>
              </li-->
            </ul>
          </li>
		    <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
              <i class="fa fa-tasks"></i>
              <span class="badge bg-theme"><?php if(isset($listEventsNotPublished) && sizeof($listEventsNotPublished)!=0){ $nbNotPublished = sizeof($listEventsNotPublished); echo "".$nbNotPublished;} ?></span>
              </a>
            <ul class="dropdown-menu extended tasks-bar">
              <div class="notify-arrow notify-arrow-green"></div>
              <li>
                <p class="green"><?php if($nbNotPublished>0){ if($nbNotPublished==1){ echo "1  evenement n'est plus publié";}
                else echo $nbNotPublished." evenements ne sont plus publiés ";} else echo "Aucun ancien evenement"; ?></p>
              </li>
              <?php if($nbNotPublished>0){
                foreach($listEventsNotPublished as $row){ ?>
                    <li>
                      <a href="<?php echo base_url('event_list_notPublished');?>">
                        <div class="task-info">
                          <div class="desc"><?=esc($row->name);?></div>
                          <div class="desc">Organisateur : <?=esc($row->nameOrganizer);?></div>
                        </div>
                      </a>
                    </li>
             <?php }}?>
              <!--li class="external">
                <a href="#">Voir tout</a>
              </li-->
            </ul>
          </li>
      
          <!-- inbox dropdown end -->
          <!-- notification dropdown start-->
          <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="<?php echo base_url('login'); ?>">Se deconnecter</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <!--sidebar end-->
     <?php include('aside.php'); ?>
		 
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
   	<section id="main-content">
				<section class="wrapper">
						
											  
					<!--CUSTOM CHART START -->
					<div class="border-head">
						<h3>VUE D'ENSEMBLE</h3>
					</div>
   
					<!--custom chart end-->
					<div class="row">
						
						<a href="<?php echo base_url('event_list'); ?>">
							<div class="col-lg-2 col-md-2 col-sm-2 men">
									<div class="imgevt">
									<div class="imgevt255">		
										<img div class="imgevt27" src="<?php echo base_url('assets/img/dashboard/evenement.png'); ?>"/>		
					   
										<h4>Ev&egrave;nement</h4>														 
									</div>	
									</div>
								
							</div>
						</a>
						
						<a href="<?php echo base_url('organizer_list'); ?>">
   
							<div class="col-lg-2 col-md-2 col-sm-2 men">
									<div class="imgevt">
									<div class="imgevt255">		
										<img div class="imgevt27" src="<?php echo base_url('assets/img/dashboard/organisateur.png'); ?>"/>		
		  
										<h4>Organisateur</h4>	
									</div>	
									</div>
								
							</div>

						</a>
	
						<a href="<?php echo base_url('pos_list'); ?>">
							<div class="col-lg-2 col-md-2 col-sm-2 men">
									<div class="imgevt">
									<div class="imgevt255">		
										<img div class="imgevt27" src="<?php echo base_url('assets/img/dashboard/pdv.png'); ?>"/>		
										<h4>Point de vente</h4>														 
									</div>	
									</div>
								
							</div>
						</a>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																			 
						<a href="<?php echo base_url('user_list'); ?>">																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																		 
							<div class="col-lg-2 col-md-2 col-sm-2 men">
									<div class="imgevt">
									<div class="imgevt255">		
										<img div class="imgevt27" src="<?php echo base_url('assets/img/dashboard/utilisateur.png'); ?>"/>		
										<h4>Compte utilisateur</h4>														 
									</div>	
									</div>
								
							</div>
						</a>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																															 
						 <a href="<?php echo base_url('category'); ?>">																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																	 
							<div class="col-lg-2 col-md-2 col-sm-2 men">
									<div class="imgevt">
									<div class="imgevt255">		
										<img div class="imgevt27" src="<?php echo base_url('assets/img/dashboard/category.png'); ?>"/>		
										<h4>Cat&eacute;gorie</h4>														 
									</div>	
									</div>
							</div>
						</a>
						<a href="<?php echo base_url('place'); ?>">
							<div class="col-lg-2 col-md-2 col-sm-2 men">																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																														 
									<div class="imgevt">
									<div class="imgevt255">		
										<img div class="imgevt27" opacity="0.3" src="<?php echo base_url('assets/img/dashboard/lieu.png'); ?>"/>		
										<h4>Lieu</h4>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																	 
									</div>	
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																												 
									</div>
								
							</div>
						</a>
						
					</div>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																					 
				</section>
			</section>
		 <!--main content end-->
    <!--footer start-->
  
	 </section>
    <!--footer end-->
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script class="include" type="text/javascript" src="<?php echo base_url('assets/lib/jquery.dcjqaccordion.2.7.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.scrollTo.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.nicescroll.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/lib/jquery.sparkline.js'); ?>"></script>
  <!--common script for all pages-->
  <script src="<?php echo base_url('assets/lib/common-scripts.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/gritter/js/jquery.gritter.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/gritter-conf.js'); ?>"></script>
  <!--script for this page-->
  <script src="<?php echo base_url('assets/lib/sparkline-chart.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/zabuto_calendar.js'); ?>"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
      });

      return false;
    });
  </script>
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },

      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
</body>

</html>
