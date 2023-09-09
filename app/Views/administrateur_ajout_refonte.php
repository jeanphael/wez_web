<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
<body style="background-color:#FAFAFA">
<?php include('menu.php'); $image = 'https://images.indianexpress.com/2020/06/online-classes.jpg'; ?>
<?php
    $nom = "";
    $prenom = "";
    $email ="";
    $phone="";
    $login="";
    if(isset($user)){
        $idUser = $user->idUser;
        $nom = $user->name;
        $prenom = $user->firstname;
        $email = $user->email;
        $phone = $user->phone;
        $login = $user->login;
    }
    ?>
<div class="container">
    <div class="col-lg-8 col-sm-8 col-md-8 block-center"  style="margin:auto !important;float:none !important ">
        <div class="row titleban">
                <div class="col-lg-8 col-md-8 col-sm-8">
                     <h3><b><?php if(isset($toUpdate)) echo "Edition de compte administrateur"; else echo "Cr&eacute;ation de compte administrateur ";?></b></h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                   <a class="lien" href="<?php echo base_url("administrateur-list-refonte");?>">Liste des administrateurs</a>
                </div>
        </div>
        <form action="<?php if(isset($toUpdate)) echo base_url("admin/update"); else echo base_url("admin/save");?>" method="POST">
         <div class="row whitebackground" style="background-color:white;padding:20px">
                 <h3><b>Information g&eacute;n&eacute;rale</b></h3>
            <div class="row" style="background-color:white">
                 <div class="col-lg-6">
                     <div class="form-group">
                         <label for="exampleInputEmail1">Email</label>
                         <input type="hidden" class="form-control" id="idU" name="iUser" value="<?php echo $idUser; ?>">
                         <input type="email" class="form-control" id="email"  name="email" value="<?php echo $email; ?>" placeholder="Entrez votre Email" required>
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $nom; ?>" placeholder="Entrez votre nom" required>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Login</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $login; ?>" placeholder="Entrez votre nom d'utilisateur" required>
                     </div>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Num&eacute;ro t&eacute;l&eacute;phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"  value="<?php echo $phone; ?>" placeholder="Entrez votre téléphone" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pr&eacute;nom</label>
                        <input type="text" class="form-control" id="firstname" name="firstname"  value="<?php echo $prenom; ?>" placeholder="Entrez votre prénom" required/>
                    </div>
                    <?php if(!isset($toUpdate)) {?>  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $pwd; ?>" placeholder="Entrez votre mot de passe" required/>
                     </div>
                     <?php } ?>
                 </div> 
            </div>
            <br/><br/>
            <div class="row"  style="background-color:white">
                <div class="col-lg-6">
                <?php if(isset($toUpdate)) {?>  <a class="lien" href="#" onclick="return deleteUser(<?php echo $idUser;?>);"> Supprimer le compte</a><?php } ?>
                 </div>
                 <div class="col-lg-4" style="float:right;width:auto !important">
                 <input type="submit" class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="<?php if(isset($toUpdate)) echo "Mettre &agrave; jour"; else echo "Cr&eacute;er un compte administrateur";?>"/>
                 </div>
            </div>
         </div>
         </form>
    </div>
</div>


<!-- CONTENT -->

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

<footer>


</footer>

<!-- SCRIPTS -->
 <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/jquery.js'); ?>"></script>
  <script class="include" type="text/javascript" src="<?php echo base_url('assets/lib/jquery.dcjqaccordion.2.7.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.scrollTo.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.nicescroll.js'); ?>" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/jquery.dataTables.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/DT_bootstrap.js'); ?>"></script>
  <!--common script for all pages-->
  <script src="<?php echo base_url('assets/lib/common-scripts.js'); ?>"> 
 </script>
 <script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
 
 
 <script type="text/javascript" >


$("#addPhoto").click(function() {
  //alert("test");
    $("input[id='my_file']").click();
    });

 </script>
<script type="text/javascript" >
    function deleteUser(idU){
       res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =   "<?php echo base_url("admin/delete?i="); ?>"+idU;
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
