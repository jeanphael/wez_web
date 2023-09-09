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
        <h3><i class="fa fa-angle-right"></i> Image &agrave; la une </h3>
       
        <!-- row -->
        <div class="row mt">
          
          <div class="col-md-6">
            <div class="form-panel">
              <form action="<?php echo base_url('picture_save'); ?>" class="form-horizontal style-form" method="POST" enctype="multipart/form-data">
        
            <div class="form-group last">
                  <label class="control-label col-md-3">Changer image</label>
                  <div class="col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="assets\img\<?php if (!empty($pictureList)) { foreach ($pictureList as $row): echo $row['name'];   ?>" style="max-width: 200px; max-height: 150px; line-height: 20px;">
                        <input type="hidden" name="id" value="<?php echo $row['idPicture'];  endforeach; } ?>"/> 
                      </div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Selectionner image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Changer</span>
                        <input type="file" class="default" name="image" id="image"/>
                        </span>
                        </div>
                    </div>
                   
                  </div>
                </div>
        
              <div class="form-send" class="col-md-4">
                <input type="submit" class="btn btn-large btn-primary"/>
              </div>
              </form>
                </div>
            </div>
         
          <!-- /col-md-12 -->
        </div>
        <!-- /row -->
      </section>
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
         <strong>Mai</strong>2020
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          Created with  <a href="https://templatemag.com/"></a>
        </div>
        <a href="index.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
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
  
</body>

</html>
