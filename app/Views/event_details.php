<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
   <?php include('header.php'); ?>
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
        <h3><i class="fa fa-angle-right"></i> <?php if (!empty($event)){ foreach ($event as $r): echo $r['name'];  endforeach;}?> </h3>
        <div class="row mt">
          <!--  DATE PICKERS -->
          <div class="col-lg-12">
            <div class="form-panel">
              <form action="<?php if (!empty($event)) {
				foreach ($event as $row):
                $idE = $row->idEvent;
                $name = $row['name'];
                $description = $row['description'];
                $dateBegin = $row['dateBegin'];
                $dateEnd = $row['dateEnd'];
                $idOrganizer = $row['idOrganizer'];
                $idPlace = $row['idPlace'];
                $placeName = $row['placeName'];
                $nameCategory = $row['nameCategory'];
                $nameOrganizer = $row['nameOrganizer'];
                $placeOfSale = $row['placeOfSale'];
                $tarif = $row['tarif'];
                $image = $row['image'];
				$nbLike = $row['nbLike'];
			    $idCategory = $row['idCategory'];
				$dateDebutAffichage = $row['dateDebutAffichage'];
				$dateFinAffichage = $row['dateFinAffichage'];
			endforeach;?>"
			  class="form-horizontal style-form" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="control-label col-md-3"><b>Nom</b></label>
					<div class="col-md-4"><?php echo $name; ?>
					<div class="validate"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><b>Description</b></label>
					<label class="control-label col-md-4"><?php echo $description; ?></label>
					<div class="col-md-4"> <img src="<?php echo $image; ?>" width="100" height="100"/>
						<div class="validate"></div>
					</div>	
				</div>
                <div class="form-group">
                  <label class="control-label col-md-3"><b>Date de l'&eacute;v&egrave;nement</b></label>
                  <div class="col-md-4">
                    <?php echo $dateBegin.'  à  '.$dateEnd; ?> 
                  </div>
                </div>
				<div class="form-group">
                  <label class="control-label col-md-3"><b>Date de d&eacute;but affichage</b></label>
                  <div class="col-md-4">
                    <?php echo $dateDebutAffichage; ?> 
                  </div>
                </div>
				<div class="form-group">
                  <label class="control-label col-md-3"><b>Date de fin affichage</b></label>
                  <div class="col-md-4">
                    <?php echo $dateFinAffichage; ?> 
                  </div>
                </div>
				<div class="form-group">
					<label class="control-label col-md-3"><b>Lieu</b></label>
					<div class="col-md-4">
					<?php echo $placeName; ?> 
					</div>
				</div>
				<div class="form-group">
				  <label class="control-label col-md-3"><b>Cat&eacute;gorie</b></label>
				  <div class="col-md-4">
				   <?php echo $nameCategory; ?> 
				  </div>
				</div>
			
				<div class="form-group">
					<label class="control-label col-md-3"><b>Organisateur</b></label>
					<div class="col-md-4">
					<?php echo $nameOrganizer; ?>
					</div>
				</div>        
				 <div class="form-group">
                  <label class="control-label col-md-3"><b>Liste point de vente</b></label>
				  <div class="col-md-4">
				   <?php foreach ($placeOfSale as $placeOfSaleRow):
				   echo $placeOfSaleRow['name'];
				   echo '<br/>';
				   endforeach;
				   ?> 
					</div>
                  </div>
				   <div class="form-group">
                  <label class="control-label col-md-3"><b>Tarif</b></label>
				  <div class="col-md-4">
						<?php foreach ($tarif as $tarifRow):
					   echo $tarifRow['namePrice'].' : '.$tarifRow['valueOfPrice'].' Ar <br/>';
					   endforeach;
					   ?> 
					</div>
                  </div>
				   <div class="form-group">
                  <label class="control-label col-md-3"><b>Nombre d'utilisateur aimant l'evenement</b></label>
				  <div class="col-md-4">
				 <?php $session = \Config\Services::session();   
          if($_SESSION['userType'] == "admin"){ ?>
          <a href="<?php 
           echo base_url('list_user_like?id='.$row['idEvent']."'");?>"><?php echo $nbLike; ?></a>
         <?php } else{ echo $nbLike; } ?>
					</div>
                  </div>
				    <div class="form-group">
						  <label class="control-label col-md-3"><b>Statut</b></label><?php
							$session = \Config\Services::session();     
							 if($row['isValidated'] == 0 && $_SESSION['userType']=="admin") {
								echo "<td class='center hidden-phone'><a href='".base_url("event_validate?id=".$row['idEvent']."")."'>A valider</a></td>";
							 }else if($row['isValidated'] == 0 && $_SESSION['userType']!="admin") {
								echo "<td class='center hidden-phone'>En attente de validation</td>";
							 }
							 else echo "<td class='center hidden-phone'>Publi&eacute;</td>";

							?>
					</div>
                </div>
                <label class="control-label col-md-3"></label>
              </div>
			  <?php } ?>
              </form>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
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
  <!--common script for all pages-->
  <script src="<?php echo base_url('assets/lib/common-scripts.js'); ?>"></script>
  <!--script for this page-->
  <script src="<?php echo base_url('assets/lib/jquery-ui-1.9.2.custom.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-fileupload/bootstrap-fileupload.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-daterangepicker/date.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-daterangepicker/moment.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/advanced-form-components.js'); ?>"></script>

</body>

</html>