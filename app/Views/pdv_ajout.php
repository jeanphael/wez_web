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
      <?php include('aside.php'); ?>
  
	  <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i><?php if (!empty($pointOfSale)) echo ' Mise à jour point de vente'; else echo ' Nouveau point de vente'; ?> </h3>
        <div class="row mt">
          <!--  DATE PICKERS -->
          <div class="col-lg-12">
            <div class="form-panel">
               <?php $validation =  \Config\Services::validation(); ?>
              <?= $validation->listErrors() ?>
              <form  method="POST" action="<?php if (!empty($pointOfSale)) echo base_url('pos_updateValidate'); else echo base_url('pos_save'); ?>" class="form-horizontal style-form">
					<div class="form-group">
						<label class="control-label col-md-3">Nom</label>
						<div class="col-md-4">
             	<input type="name" name="name" class="form-control" id="contact-name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php if (!empty($pointOfSale))  { foreach ($pointOfSale as $r) {
      echo $r->name;
       $idPos = $r->idPointOfSale;
       $lat = $r->lat;
       $lng = $r->lng;
    } } ?>">
							<div class="validate"></div>
						</div>
					</div>
					<div class="form-group">
             <input type="hidden" name="id" value="<?=esc($idPos);  ?>"/>
						<label class="control-label col-md-3">Latitude</label>
					<div class="col-md-4">
                 <input type="name" name="lat" value="<?=esc($lat);  ?>" class="form-control" id="lat" placeholder="Latitude (-18.123456)" />
          </div>
          
       	</div>
          <div class="form-group">
            <label class="control-label col-md-3">Longitude</label>
          <div class="col-md-4">
                 <input type="name" name="lng" value="<?=esc($lng);  ?>" class="form-control" id="lng" placeholder="Longitude (47.123456)" />
          </div>
          
        </div>
					<div class="form-group">
					<label class="control-label col-md-3"></label>
                   <div class="col-md-4">
                      <button class="btn btn-theme" type="submit">Enregistrer</button>
                    </div>
                  </div>
              </div>
            </section>
          </div>
				</div>
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