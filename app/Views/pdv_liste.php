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
        <h3><i class="fa fa-angle-right"></i> Point de vente </h3>
       
        <!-- row -->
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
			<?php if (! empty($pointOfSaleList) && is_array($pointOfSaleList)) : ?> 
              <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> Liste point de vente</h4>
                <hr>
                <thead>
                  <tr>
                    <th><i class="fa fa-bullhorn"></i> Nom</th>
                    
                    <th></th>
                  </tr>
                </thead>
                <tbody>
				<?php foreach ($pointOfSaleList as $row): ?>
                  <tr>
                    <td>
                     <?=$row->name; ?>
                    </td>
                    
                  <?php $session = \Config\Services::session();     
                      if($_SESSION['userType'] == "admin"){ ?>
                    <td>
                      <a href="<?php echo base_url('pos_update?id='.$row->idPointOfSale."'"); ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                      <button class="btn btn-danger bt" onclick="return deletePdv(<?=$row->idPointOfSale;?>);"><i class="fa fa-trash-o "></i></button>
                    </td>
                  <?php } ?>  
                  </tr>
                 <?php endforeach; ?>
                </tbody>
              </table>
				<?php else : ?> 
					<h4>Aucun point de vente enregistr&eacute;</h4> 
				<?php endif ?> 
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-md-12 -->
        </div>
        <!-- /row -->
      </section>
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
  <script type="text/javascript">
    function deletePdv(idPdv){
       res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =  "pdv_delete?id="+idPdv;
          document.location.href = url;
          return true;
        }
         else{
           return false;
         }
      }
  </script>
  
</body>

</html>