<html>
<head></head>
<body>
<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
<form class="col-6">
<p>Bonjour <?php echo $nom;?> </p> 
<br/>
<p>Pour r&eacute;initialiser votre mot de passe , merci de cliquer sur le lien ci-dessous: </p>
<br/>
<div class="mb-4">
<a rel="nofollow" target="_blank" href="<?php echo 'http://wez.mg/services/form_reinit_pwd?i='.$email;?>">Reinitialiser mon mot de passe</a>
</div>
<br/>
<p>Merci<br/>
</p></div></div>
</form>   
</div>
</div>
</body>
</html>
