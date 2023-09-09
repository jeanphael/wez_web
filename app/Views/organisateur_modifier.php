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
        <h3><i class="fa fa-angle-right"></i> Organisateur</h3>
        <!-- row -->
        <div class="row mt">
          <div class="col-md-6">
            <div class="content-panel">
			  <form class="form-horizontal style-form" action="<?php echo base_url('organizer_update'); ?>" method="POST" enctype="multipart/form-data">
      
			<input type="text" class="form-control" placeholder="Nom" autofocus name="name" id="contact-name" data-rule="minlen:4" >           <br>         
              <input type="text" class="form-control" placeholder="Prenom" name="firstname" id="contact-name" data-rule="minlen:4" >           <br>          
              <input type="text" class="form-control" placeholder="Adresse" name="adresse" id="contact-name" data-rule="minlen:4" >           <br>           
              <input type="email" class="form-control" placeholder="Email" name="email" id="contact-name" data-rule="minlen:4" >           <br>           
              <input type="text" class="form-control" placeholder="Telephone" name="phone" id="contact-name" data-rule="minlen:10" >           <br>           
              <input type="text" class="form-control" placeholder="nom utilisateur" name="login" id="contact-name" data-rule="minlen:2" >           <br>           
              <input type="password" class="form-control" placeholder="Mot de passe" name="pwd" id="contact-name" data-rule="minlen:6" >           <br>           
              <textarea class="form-control" name="description" id="contact-message" placeholder="Description" rows="5" data-rule="required" data-msg="Please write something for us" value="<?php echo $description; ?>"></textarea>            <br>            
              <div class="">            Image                    <div class="fileupload fileupload-new" data-provides="fileupload">                        
                <span class="">                           <span class="fileupload-new"><i class="fa fa-paperclip"></i> Selectionner image</span>                         
                  <input type="file" class="default" name="image" id="image"/>                         </span>                        
                </div>                                    
              </div>                  <br>
              <?php $validation =  \Config\Services::validation(); ?>              
              <?= $validation->listErrors() ?>       
                         
              <button class="btn btn-theme btn-block" href="index.+" type="submit"><i class="fa"></i>ENREGISTRER</button>  
                </form>
              </div>
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-md-12 -->
    
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
    function deleteOrganizer(idOrg){
       res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =  "organizer_delete?id="+idOrg;
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