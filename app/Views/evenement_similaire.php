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
      <section class="wrapper site-min-height">
        <div class="row mt mb">
          <div class="col-lg-12">
            <h3><i class="fa fa-angle-right"></i> Evenements Similaires</h3>
            <br>
         
            <!-- end dmbox -->
          </div>
          <!--  /col-lg-12 -->
        </div>
        <!-- /row -->
        <div class="row content-panel">
          <h2 class="centered">Liste des cat&eacute;gories</h2>
          <div class="col-md-10 col-md-offset-1 mt mb">
              <?php  $i=0;$indice=['One','Two','Three'] ; 
              foreach ($categories as $row): ?>
              <div class="accordion" id="accordion2">
               <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="faq.html#collapse<?php echo $indice[$i]; ?>">
                    <em class="glyphicon glyphicon-chevron-right icon-fixed-width"></em> <?php echo $row->name;  ?>
                    </a>
                </div>
                <div id="collapse<?php echo $indice[$i]; ?>" class="accordion-body collapse in">
                <a href="<?php echo base_url('event_list_similar?idCategory='.$row->idCategory); ?>">
                  <div class="accordion-inner">
                    <p> <?php $liste = $row->listEvents;
                     foreach ($liste as $e): echo " ".$e->name." - "; endforeach; ?></p>
                  </div>
                  </a>
                </div>
              </div>

               </div>
             <?php $i++; endforeach; ?>

            <!-- end accordion -->
          </div>
          <!-- col-md-10 -->
        </div>
        <!--  /row -->
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

</body>

</html>