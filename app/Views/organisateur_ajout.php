<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>

<body>
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<div id="login-page">

<br>
<?php $validation =  \Config\Services::validation(); ?>
            <?= $validation->listErrors() ?>
  <div class="container">
    <form class="form-login" action="<?php if(!empty($organizer) && !empty($utilisateur)){ echo base_url('organizer_updateValidate'); } else echo base_url('organizer_save'); ?>" method="POST" enctype="multipart/form-data"
    onsubmit="return isValidImage()">
    
      <h2 class="form-login-heading"><?php if(!empty($organizer) && !empty($utilisateur)){
		  echo "Modification compte organisateur";
			  foreach($utilisateur as $user){
				$login = $user->login;$firstname = $user->firstname;$image = $user->image;$adresse = $user->adresse;$email = $organizer->email;$phone = $organizer->phone;$login = $user->login;$pwd = $user->password;$nameOrganisateur = $organizer->name;$description = $organizer->description;
			  }
			 ?>   <input type="hidden" class="form-control" name="id" id="name" value="<?php echo $organizer->idOrganizer; ?>"/>
					<input type="hidden" class="form-control" name="idUser" id="name" value="<?php echo $user->idUser; ?>"/>
      <?php
		  } else{
		  echo "Creation compte organisateur";
	  }
	  ?></h2>
	  <div class="login-wrap">
        <input type="text" class="form-control" placeholder="Nom d'organisateur" autofocus name="name" id="name" value="<?php echo $nameOrganisateur; ?>" data-rule="minlen:4" >
        <br>
        <input type="text" class="form-control" placeholder="Adresse" name="adresse" id="adresse" value="<?php echo $adresse; ?>"  data-rule="minlen:4" >
        <br>
        <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?php echo $email; ?>" data-rule="minlen:4" >
        <br>
        <input type="text" class="form-control" placeholder="Telephone" name="phone" id="phone" value="<?php echo $phone; ?>"  data-rule="minlen:10" >
        <br>
        <input type="text" class="form-control" placeholder="nom d’utilisateur" name="login" id="login" value="<?php echo $login; ?>"  data-rule="minlen:2" >
        <br>
		 <input type="text" class="form-control" placeholder="nif" name="nif" id="nif">
        <br>
		 <input type="text" class="form-control" placeholder="stat" name="stat" id="stat">
        <br>
        <?php if(empty($organizer) && empty($utilisateur)){  ?> <input type="password" class="form-control" placeholder="Mot de passe" name="pwd" id="pwd" data-rule="minlen:6"><?php } ?>
        <br>
        <textarea class="form-control" name="description" id="contact-message" placeholder="Description" rows="5" data-rule="required" data-msg="Please write something for us" value="<?php echo $description; ?>"></textarea>
        <?php if(empty($organizer) && empty($utilisateur)){  ?>   <br>
          Image
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Selectionner image</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Changer</span>
                      <input type="file" class="default" value="<?php echo $image;?>" name="image" id="image" accept="image/x-png,image/gif,image/jpeg"/>
                      </span>
                      <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Supprimer</a>
                  </div><?php } ?>
        <br>
          <button class="btn btn-theme btn-block" href="index.+" type="submit"><i class="fa"></i>ENREGISTRER</button>
          <br>
       <?php if(empty($organizer) && empty($utilisateur)){  ?> <a href="<?php echo base_url('login');?>">Se connecter</a><?php } ?>
        
        <hr>
      </div>
    </form>
    <br>
          
  </div>
</div>
<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery.backstretch.min.js'); ?>"></script>
<script type="text/javascript">

$isValidLogin = false;
$isValidEmail = false;
  $.backstretch("img/login-bg.jpg", {
    speed: 500
  });


  
  function isValidImage()
  {

    login = $("#login").val();
    email = $("#email").val();
    

    if($('#image').get(0).files.length ===0)
    {
      alert("Veuillez ajouter une photo!");
      return false;
    }
    if(email === null || email === '' || email.length <10 || !validateEmail(email)) 
    {
      alert("Email invalide");
      return false;
    }

    if(login === null || login === '' || login.length <4) {
      alert("Nom d'utilisateur invalide");
    return false;
    }

    if(!$isValidEmail)
    {
      alert("Email déjà existant!");
      return false;
    }
    if(!$isValidLogin)
    {
      alert("Nom d'utilisateur  déjà existant !");
      return false;
    }
    return true;
    
  }

  $("#login").on('change keydown paste input',function(){
    isLoginExist();
  });
  function isLoginExist(){
    
  login = $("#login").val();
  if(login === null || login === '' || login.length <4) {
    console.log("login length--" +login.length);
    $isValidLogin = false;
    return;
  }

    $isValidLogin = true;
    $.ajax({
    
    url : 'user_by_login', // La ressource ciblée
    dataType : 'text',
    type : 'POST', // Le type de la requête HTTP.
      data:{ login: login
    },success:function(data){
      
      if(data === "yes")
      {
      console.log("login exist");
      $isValidLogin = false;
      }
      else{
      console.log("valid login");
      $isValidLogin = true;
      }
      console.log(data);
    
    },
    error:function(data) {
      console.log("error login");
      console.log(data);
      $isValidLogin = false;
      
    }
  });
  
  
}

$("#email").on('change keydown paste input',function(){
    isEmailExist();
  });
  function isEmailExist(){
    
  email = $("#email").val();
  if(email === null || email === '' || email.length <10 || !validateEmail(email)) {
    console.log("email length--" +email.length);
    $isValidEmail = false;
    return;
  }

    $isValidEmail = true;
    $.ajax({
    
    url : 'user_by_email', // La ressource ciblée
    dataType : 'text',
    type : 'POST', // Le type de la requête HTTP.
      data:{ email: email
    },success:function(data){
      
      if(data === "yes")
      {
      console.log("email exist");
      $isValidEmail = false;
      }
      else{
      console.log("valid email");
      $isValidEmail = true;
      }
      console.log(data);
    
    },
    error:function(data) {
      console.log("error email");
      console.log(data);
      $isValidEmail = false;
      
    }
  });
  
  
}

function validateEmail(email) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}
  
</script>
</body>

</html>