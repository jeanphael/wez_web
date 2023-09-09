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
        <div class="row mt">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <!--  BASIC PROGRESS BARS -->
            <div class="showback">
              <h4><i class="fa fa-angle-right"></i> Liste des utilisateurs</h4>
                 <div class="content-panel">
      <?php if (! empty($users) && is_array($users)) : ?> 
              <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <th><i class="fa fa-bullhorn"></i> Nom</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Pr&eacute;nom</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
        <?php foreach ($users as $row): ?>
                  <tr>
                    <td>
                      <a href="basic_table.html#"><?=esc($row['name']); ?></a>
                    </td>
                    <td><?=esc($row['firstname']); ?></td>
                   
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
        <?php else : ?> 
          <h4>Aucun utilisateur enregistr&eacute;</h4> 
        <?php endif ?> 
            </div>
            </div>
            <!--/showback -->
          </div>
          <!-- /col-lg-6 -->
          <div class="col-lg-6 col-md-6 col-sm-12">
            <!--  ALERTS EXAMPLES -->
            <div class="showback">
				 <div id="calendar" class="mb">
				  <div class="panel green-panel no-margin">
					<div class="panel-body">
					  <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
						<div class="arrow"></div>
						<h3 class="popover-title" style="disadding: none;"></h3>
						<div id="date-popover-content" class="popover-content"></div>
					  </div>
					  <div id="my-calendar"></div>
					</div>
				  </div>
				</div>
             </div>
            <!-- /showback -->
            <!--  DISMISSABLE ALERT -->
           </div>
          <!-- /col-lg-6 -->
        </div>
        <!--/ row -->
      </section>
      <!-- /wrapper -->
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
  <script type="text/javascript" src="<?php echo base_url('assets/lib/gritter/js/jquery.gritter.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/gritter-conf.js'); ?>"></script>
</body>

</html>
