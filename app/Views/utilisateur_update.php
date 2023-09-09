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
        <h3><i class="fa fa-angle-right"></i> Compte utilisateur</h3>
        <!-- /row -->
        <div class="row mt">
          <div class="col-lg-12">
            <h4><i class="fa fa-angle-right"></i>  Mise à jour </h4>
            <div class="form-panel">
              <div class="form">
                 <?php $validation =  \Config\Services::validation(); ?>
              <?= $validation->listErrors() ?>
                <form class="cmxform form-horizontal style-form" id="signupForm" method="POST" action="<?php if (!empty($user)) {
              echo base_url('user_updateValidate');
              $name = $user->name;$firstname = $user->firstname;$username = $user->login;$password = $user->password;$adresse = $user->adresse;$phone = $user->phone;$email = $user->email;$idU = $user->idUser;}
               else echo base_url('user_save');  ?>" enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="name" class="control-label col-lg-2">Nom</label>
                    <div class="col-lg-10">
                        <input type="hidden" name="id" value="<?=esc($idU);  ?>"/>
                      <input class=" form-control" id="name" name="name" type="text" value="<?php echo $name; ?>"/>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Pr&eacute;noms</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="firstname" name="firstname" type="text" value="<?php echo $firstname; ?>"/>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="username" class="control-label col-lg-2">Nom utilisateur</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="username" name="username" type="text" value="<?php echo $username; ?>"/>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="password" class="control-label col-lg-2">Mot de passe</label>
                    <div class="col-lg-10"-->
                      <input class="form-control " id="password" name="password" type="password" text="<?php echo $username; ?>"/>
                    </div>
                  </div>
				    <div class="form-group ">
                    <label for="adresse" class="control-label col-lg-2">Adresse</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="adresse" name="adresse" type="text" value="<?php echo $adresse; ?>"/>
                    </div>
					</div>
				   <div class="form-group ">
                    <label for="tel" class="control-label col-lg-2">T&eacute;l&eacute;phone</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="tel" name="tel" type="text" value="<?php echo $phone; ?>"/>
                    </div>
					</div>
                  <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">Email</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="email" name="email" type="email" value="<?php echo $email; ?>"/>
                    </div>
                  </div>
                 
                  <!--div class="form-group ">
                    <label for="newsletter" class="control-label col-lg-2 col-sm-3">Receive the Newsletter</label>
                    <div class="col-lg-10 col-sm-9">
                      <input type="checkbox" style="width: 20px" class="checkbox form-control" id="newsletter" name="newsletter" />
                    </div>
                  </div-->
                
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-theme" type="submit">Enregistrer</button>
                     </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
        <!-- /row -->
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
  <script src="<?php echo base_url('assets/lib/form-validation-script.js'); ?>"></script>

</body>

</html>