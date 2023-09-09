<html>
<head></head>
<body>
<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
<form class="col-6">
<p>Bonjour,</p> 
<br/>
<p>Vous avez une demande de rendez-vous: </p>
<br/>
<p><b>Date </b>: <?php echo $dateMeeting;?> &agrave; <?php echo $hourMeeting;?></p>
<p><b>Type de coaching </b>: <?php echo $coaching->name;?></p>
<p><b>Description </b>: <?php echo $description;?></p>
<p><b>Nom du client </b>: <?php echo $user->firstname.' '.$user->name;?></p>
<p><b>Adresse </b>: <?php echo $user->address;?> </p>
<p><b>Telephone </b>: <?php echo $user->phone;?></p>
<p><b>Email </b>: <?php echo $user->email;?></p>
<br/>
<p>Pour valider cette demande , merci de cliquer sur le lien ci-dessous : </p>
<div class="mb-4">
<a rel="nofollow" target="_blank" href="<?php echo 'http://coachservices.getcoachings.fr/services/index.php/meeting/addAdress/validate?i='.password_hash($user->idUser, PASSWORD_BCRYPT).'&im='.password_hash($idMeeting, PASSWORD_BCRYPT);?>">Valider le rendez-vous</a>
</div>
<br/>
<p>Merci<br/>
L&#039;&eacute;quipe GetCoachings</p></div></div>
</form>   
</div>
</div>
</body>
</html>
