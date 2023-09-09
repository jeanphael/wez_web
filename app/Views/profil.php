<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>
<body style="background-color:#FAFAFA">
<?php include('menu.php'); $image = 'https://images.indianexpress.com/2020/06/online-classes.jpg'; ?>
<?php
    $session = \Config\Services::session();
    $nom = "";
    $prenom = "";
    $email ="";
    $adresse="";
    $phone="";
    $nif="";
    $stat="";
    $login="";
    $photo="";
    $description="";
    $pwd="";
    if(isset($user)){
            $nom = $user->name;
            $prenom = $user->firstname;
            $email = $user->email;
            $phone = $user->phone;
            $adresse = $user->adresse;
            $description = $user->description;
            $login = $user->login;
            $photo = $user->image;
            $pwd = $user->password;
            $idUser = $user->idUser;
       
    }
    if(isset($organizer)){
        
        $description = $organizer['description'];
        $nif = $organizer['nif'];
        $stat = $organizer['stat'];
        $nomOrg = $organizer['name'];
		
}
    ?>
<div class="container">
    <div class="col-lg-8 col-sm-8 col-md-8 block-center"  style="margin:auto !important;float:none !important ">
        <div class="row titleban">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h3><b>Configuration de compte</b></h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                    <a class="lien" href="<?php echo base_url("evenement-list-refonte");?>">Liste des evenements</a>
                </div>
        </div>
       
        <div class="row whitebackground">
        <form action="<?php echo base_url("profil/update-profil");?>" method="POST" enctype="multipart/form-data"
        <?php if (empty($toUpdate)) { echo "onsubmit='return isValidImage()'"; } else{ echo "onsubmit='return isValidImage()'"; } ?>>
		         
            <div class="row" style="background-color:white;padding:3%">
                 <h3><b>Information g&eacute;n&eacute;rale</b></h3>
				 <div class="col-lg-3">
				    <div id="addPhotoContainer" class="block-center" style="padding:0px !important">
						<?php if($photo !=  base_url('assets/img/profil.png') ) echo  '
						<!--input type="file" id="image" name="image"  accept="image/x-png,image/gif,image/jpeg" style="display: none;" /-->
							<input type="hidden" name="currentPhoto" id="currentPhoto"  value="<?php if(isset($toUpdate)) echo $photo;?>" />
							<img id="addPhoto" src="'.$photo.'" style="width:150px !important;width:150px !important;"/>';
                        else {?>
							<label for="exampleInputFile">Photo de profil</label>
							<img id="addPhoto" width="200" length="200" src="<?php if(isset($toUpdate)) echo $photo; else echo base_url('assets/img/profil.png'); ?>"  />
							<input type="hidden" name="currentPhoto" id="currentPhoto"  value="<?php if(isset($toUpdate)) echo $photo;?>" />
							<p class="help-block">Ajouter un photo de profil</p>
						<?php } ?>
                    </div><input type="file" id="image" name="image"  accept="image/x-png,image/gif,image/jpeg" style="display: none;" />
							
                 </div>
                 <div class="col-lg-9">
                    <button type="button" style="margin-top:25%" class="btn btn-default" onclick="changePwd()">Changer mot de passe</button>
                 </div>
             </div>
               
        <!-- Standard button -->
             
            <div class="row" style="background-color:white">
                 <div class="col-lg-6">
                     <div class="form-group">
                         <label for="exampleInputEmail1">E-mail</label>
                         <input type="hidden" class="form-control" id="idU" name="iUser" value="<?php echo $idUser; ?>">
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?php echo $email; ?>" placeholder="Entrez votre Email"  required>
                    </div>
					 <?php $session = \Config\Services::session();   
					if($_SESSION['userType'] == "organisateur"){?>
						 <div class="form-group">
							<label for="exampleInputEmail1">Nom d'organisateur</label>
							<input type="text" name="nameOrg" class="form-control" id="exampleInputEmail1" value="<?php echo $nomOrg; ?>" placeholder="Entrez votre nom"  required>
						 </div>
					<?php } else{?>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Nom</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo $nom; ?>" placeholder="Entrez votre nom"  required>
                     </div>
					 <?php }?>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Num&eacute;ro t&eacute;l&eacute;phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" value="<?php echo $phone; ?>" placeholder="Entrez votre téléphone"  required>
                    </div>
                    <?php if(!isset($toUpdate)) {?>  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $pwd; ?>" placeholder="Entrez votre mot de passe"/>
                     </div>
                     <?php } ?>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom d'utilisateur</label>
                        <input type="text" name="login" class="form-control" id="exampleInputEmail1" value="<?php echo $login; ?>" placeholder="Entrez votre nom d utilisateur"  required>
                    </div>
					<?php if($_SESSION['userType'] != "organisateur"){?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pr&eacute;nom</label>
                        <input type="text" name="firstname" class="form-control" id="exampleInputEmail1" value="<?php echo $prenom; ?>" placeholder="Entrez votre prénom"  required>
                    </div>
					<?php } ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Domicile</label>
                        <input type="text" name="adresse"  class="form-control" id="exampleInputEmail1" value="<?php echo $adresse; ?>" placeholder="Entrez votre adresse de domicile"  required>
                    </div>
                 </div> 
            </div>
			<?php 
            if($session->get('userType')== "organisateur") { ?>
            <div class="row"  style="background-color:white">
                 <div class="col-lg-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea class="form-control" name="description"  ><?php echo $description; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row"  style="background-color:white">
                <div class="col-lg-6">
                    <h3><b>Informations Juridiques</b></h3>	
                 </div>
            </div>
            
            <div class="row"  style="background-color:white">
                <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIF</label>
                            <input type="text" name="nif" class="form-control" value="<?php echo $nif; ?>" id="exampleInputEmail1" placeholder="Entrez votre numero NIF"  >
                        </div>
                 </div> 
                 <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">STAT</label>
                            <input type="text" name="stat" class="form-control" value="<?php echo $stat; ?>" id="exampleInputEmail1" placeholder="Entrez votre numero STAT"  >
                        </div>
                 </div> 
             </div>
             <?php }?>
             
             <br/>
             <div class="row"  style="background-color:white">
                <div class="col-lg-6">
                 <a class="lien" href="#" onclick="return deleteUser(<?php echo $idUser;?>);"> Supprimer le compte</a>
                 </div>
                 <div class="col-lg-4" style="float:right;width:auto !important">
                 <input type="submit" class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Mettre &agrave; jour"/>
                 </div>
                 </div>
            </form>
            </div>
        </div>
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
  <script src="<?php echo base_url('assets/lib/common-scripts.js'); ?>"> </script>
  <script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
 <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
 
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-fileupload/bootstrap-fileupload.js'); ?>"></script>

 
 
 <script type="text/javascript" >
function isValidImage()
    {
        
        var currentPhoto = $("#currentPhoto").val();
    
        if(currentPhoto !== null && currentPhoto.trim() !== '')
        {
            return true;
        } 
        else if($('#image').get(0).files.length !==0)
        {
         return true;
        }

    
        alert("Veuillez ajouter une photo!");
        return false;
    }

$("#addPhotoContainer").click(function() {
 //alert("test");
    $("input[id='image']").click();
    });

 </script>
<script type="text/javascript" >
    function deleteUser(idU){
       res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =   "<?php echo base_url("profil/delete?i="); ?>"+idU;
          document.location.href = url;
          return true;
          }
         else{
           return false;
         }
      }
    function changePwd()
    {
        //url =   "<?php echo base_url("profil/resetPassword?e="); ?>"+email;
        url =   "<?php echo base_url("profil/resetPassword"); ?>";
        
        document.location.href = url;
    }
    

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#addPhotoContainer').css('background-image', "url("+e.target.result+")");
				$('#addPhotoContainer').css('width', "150px");
				$('#addPhotoContainer').css('height', "150px");
				$('#addPhoto').css('display', "none");
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#image").change(function(){
		readURL(this);
	});

 </script>
</body>
 
</html>
