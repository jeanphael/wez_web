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
        <h3><i class="fa fa-angle-right"></i> Gestion du prix d' affichage</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12 col-md-12 col-sm-12">
           

           
                <div class="form-panel">
                    
           <?php $validation =  \Config\Services::validation(); ?>
            <?= $validation->listErrors() ?>
              <form  method="POST" action="<?php if ($printPrice->id != null) 
              {
                echo base_url('update_print_price');
              }
              else echo base_url('add_print_price');  ?>" class="form-horizontal style-form"

              onsubmit="return isFormValid()"
              >
          <div class="form-group">

            <label class="control-label col-md-3">Affichage dans la banni&egrave;re</label>
            <div class="col-md-4">
                 <input type="hidden" name="id" value="<?=esc($printPrice->id);  ?>"/>
                <input type="number" name="bann" class="form-control" id="bann"  value="<?php echo $printPrice->banniere; ?>" data-rule="minlen:4" data-msg="Veuillez remplir le prix pour le bannière" >
              <div class="validate"></div>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3">Affichage normale</label>
            <div class="col-md-4">
                 
                <input type="number" name="normal" class="form-control" id="normal" value="<?php echo $printPrice->normal; ?>" data-rule-required="true" data-msg="Veuillez remplir le prix normal">
              <div class="validate"></div>
            </div>
          </div>
        
        <p style="color:red">  <?php echo $message; ?></p>
          <div class="form-group">
          <label class="control-label col-md-3"></label>
                   <div class="col-md-4">
                      <button class="btn btn-theme" type="submit">Enregistrer</button>
                    </div>
                  </div>
              </div>
        </div>

        
        </div>
        <!-- /row -->


        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
	</section>
 
  
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
  <!--custom switch-->
  <script src="<?php echo base_url('assets/lib/bootstrap-switch.js'); ?>"></script>
  <!--custom tagsinput-->
  <script src="<?php echo base_url('assets/lib/jquery.tagsinput.js'); ?>"></script>

  <!--Contactform Validation-->
  <script src="<?php echo base_url('assets/lib/php-mail-form/validate.js'); ?>"></script>
   <script type="text/javascript">
      function isFormValid()
      {
          bann = $("#bann").val();
          normal = $("#normal").val();
          if(bann === null || bann.trim() === '') {
            alert('Veuillez remplir tous les champs');
            return false;
          }
          if(normal === null || normal.trim() === '') {
            alert('Veuillez remplir tous les champs');
            return false;
          }

        return true;
      }
    </script>

</body>

</html>