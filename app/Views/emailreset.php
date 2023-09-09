<html>
<head></head>
<body>
<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
<form class="col-6">
<p>Bonjour,</p> 
<p>Pour reinitialiser votre mot de passe ,  vous devez cliquer le lien suivant : </p>
<br/>
<div class="mb-4">
<a rel="nofollow" target="_blank" href="<?php echo 'http://www.wez.mg/services/reset?i='.password_hash($email, PASSWORD_BCRYPT);?>">Reinitialiser mot de passe</a>
</div>
<br/>
<p>Merci<br/>
L&#039;&eacute;quipe WEZ</p></div></div>
</form>   
</div>
</div>
</body>
</html>