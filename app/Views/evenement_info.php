<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
<style>
.navbar{
	margin-bottom:0px !important;
}
@media only screen and (max-width:768px) {
  .comcenter {
    margin: auto;
    float: none;
	height : 250px !important;
  }
}
@media only screen and (min-width:768px) {
  .comcenter {
    float: right;
	box-shadow: -2px 3px 4px #8F8F8F29;
border: 1px solid #F0F3F3;
  }
}
</style>
<body style="background-color:#FAFAFA">
<?php include('menu.php'); $image = 'https://images.indianexpress.com/2020/06/online-classes.jpg'; ?>
<?php
    $nom = "";
    $description = "";
    $image ="";
    $dateDebut="";
    $dateFin="";
    $idPlace = "";
    $idCategory = "";
    $affichageBan = "";
    $nbJour = "";
    $dateDebutAffichage = "";
    $nameCity = "";
    if(isset($ev)){
        foreach($ev as $event)
      $idEvent = $event->idEvent;
        $nom = $event->name;
        $description = $event->description;
        $image = $event->image;
        $ddeb = strtotime($event->dateBegin);
        $dateDebut = date('d/m/Y', $ddeb);
		$heureDebut =  date('H:i', $ddeb);
        $dfin=  strtotime($event->dateEnd);
        $dateFin = date('d/m/Y', $dfin);
        $heureFin = date('H:i', $dfin);
        $idPlace = $event->idPlace;
        $nomPlace = $event->placeName;
        $idCategory =  $event->idCategory;
        $nomCategory =  $event->nameCategory;
        $affichageBan =  $event->affichageBan;
	  $nbJour = $event->dureeAffichage;	
        
        $cout = $event->cout;
        $ddebA = strtotime($event->dateDebutAffichage);
        $dateDebutAffichage =  date('d/m/Y', $ddebA);
        $dfinA = new DateTime($event->dateDebutAffichage);
        $dfinA->add(new DateInterval('P'.(int)$nbJour.'D'));
        $dateFinAffichage = $dfinA->format('d/m/Y') ;
        $heureDebutAffichage = date('H:i', $ddebA);
        $heureFinAffichage =date('H:i', $ddebA);
        $nameCity = $event->nameCity;
        $nameOrganizer = $event->nameOrganizer;
        $dateCreation = date('d/m/Y',strtotime($event->dateCreation));
		 $isValidated = $event->isValidated;
		 /* style="margin:auto !important;float:none !important "*/
    }
    ?>
<div class="col-lg-9 col-sm-9 col-md-9 block-right">
<?php if(isset($toUpdate)) {?>
	<div class="col-lg-4 col-sm-4 col-md-4 block-center" >
	 </div>
     <div class="col-lg-8 col-sm-8 col-md-8 block-center" >
        <form action="<?php echo base_url("event/validate");?>" method="POST"><?php }?>
		<div class="row titleban">
                <div class="col-lg-8 col-md-8 col-sm-8">
                     <h3><b><?php if(isset($asupp) || $info==true) echo "D&eacute;tails de l'&eacute;v&egrave;nement"; else echo "Ev&egrave;nement &agrave; valider";?></b></h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 text-right" style="height:100%">
                   <a class="lien" href="<?php echo base_url("evenement-list-refonte");?>">Liste des &eacute;v&egrave;nements</a>
                </div>
        </div>
        <div class="row whitebackground" style="background-color:white;padding:20px">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                     <div class="form-group">
                         <div id="addPhoto" class="row text-center" style="position:relative;height:300px;background-repeat: no-repeat;background-size: cover;background-color:#EFEFEF;width:100%<?php if(!empty($image))echo ';background-image:url('.$image.');'; ?>">
                         <input type="file"  style="display: none;"  id="image" class="form-control"  name="image" value="<?php echo $image; ?>">
                         <h1 style="color:white;font-weight:bold;float:left;position:absolute;bottom:30px;margin-left:15px"></h1>
                         <h4 style="color:white;float:left;position:absolute;bottom:0;margin-left:15px"></h4>
                        </div>
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-lg-4">
                    <h5 class="noir">Info de l'&eacute;v&egrave;nement: </h5>
                </div>
                <div class="col-lg-8">
                    <p>Titre: <span class="noir"><?php echo $nom; ?></span></p>
                    <p>Date de l'&eacute;v&egrave;nement: <span class="noir"><?php echo $dateDebut; ?> <?php if($dateDebut!=$dateFin) echo 'au '.$dateFin;?></span></p>
                    <p>Heure de l'&eacute;v&egrave;nement: <span class="noir"> <?php echo $heureDebut; ?>- <?php echo $heureFin; ?> </span> </p>
                    <p>Lieu: <span class="noir"> <?php echo $nomPlace.', '.$nameCity; ?> </span></p>
                    <p>Cat&eacute;gorie: <span class="noir"> <?php echo $nomCategory; ?> </span></p>
                    <p>Description: <span class="noir"> <?php echo $description; ?> </span></p>
                </div>
            </div>
			 <div class="row">
                <div class="col-lg-4">
                    <h5 class="noir">Info organisateur: </h5>
                </div>
                <div class="col-lg-8">
                    <p>Organisateur: <span class="noir"><?php echo $nameOrganizer; ?></span></p>
                    <p>Date de cr&eacute;ation: <span class="noir"><?php echo $dateCreation; ?> </span></p>
                </div>
            </div>
        
            <div class="row">
                <div class="col-lg-4">
                    <h5 class="noir">Info de publication: </h5>
                </div>
                <div class="col-lg-8">
                    <p class=""><label class="">Publi&eacute; dans les tops &eacute;venements: </label> <label class="noir" style="background-color:#A8E0D5;padding:1.5%;"> <?php if($affichageBan==0) echo "Non"; else echo "Oui"; ?> </label></p>
                    <p>D&eacute;but de publication: <span class="noir"><?php echo $dateDebutAffichage; ?> &agrave; <?php echo $heureDebutAffichage; ?> </span></p>
                    <p>Fin de publication: <span class="noir"><?php echo $dateFinAffichage; ?> &agrave;  23:59 </span></p>
                    <p>Nombre de jours: <span class="noir"><?php echo $nbJour; ?> </span></p>
                    <p>Cout: <span class="noir"><?php echo $cout.' Ar';?> </span></p>
					<p>Status: <span class="noir" style="background-color:#A8E0D5;padding:1.5%;">
					<?php echo $statut;?> </span></p>
                 </div>
            </div>
        </br>
            <div class="row">
                <div class="col-lg-4">
                <?php 
                $tarifSize = count($tarif); 
                if(count($tarif) < 10)
                {
                  $tarifSize = "0".$tarifSize;
				  if(count($tarif) == 0 )$tarifSize = "0";
                }

                $posSize = count($pos); 
                if($posSize < 10)
                {
                  $posSize = "0".$posSize;
				  if(count($pos) == 0 )$posSize = "0";
                }
    
                ?>
                    <h5 class="noir">Tarif de billet (<?php echo $tarifSize ;?>): </h5>
                </div>
                <div class="col-lg-8">
                    <?php foreach($tarif as $t){?>
                    <p><?php echo $t->name;?><span class="noir"> <?php echo $t->value;?> Ar </span></p>
                    <?php } ?>
                </div>
            </div>
        </br>
            <div class="row">
                <div class="col-lg-4">
                    <h5 class="noir">Point de vente de billet (<?php echo $posSize;?>): </h5>
                </div>
                <div class="col-lg-8">
                     <?php foreach($pos as $p){?>
                    <p class="note btn"><?php echo $p->namePointOfSale;?></p>
                    <?php } ?>
                </div>
            </div>
            <hr/>
            
            <div class="row"  style="background-color:white">
                 <?php echo $textButton;?>
				  <?php echo $modifier;?>
            </div>
      	<input type="hidden" name="idEv" value="<?php echo $idEvent;?>"/>
		
         </form>
		 
		<?php if ($hasPrevious || $hasNext) :?>
		</br>
		<div class="row">
			  <?php if ($hasPrevious) :?>
				<a style="float:left; color:#707070 !important" href="<?php echo base_url("evenement-info-avalider");?>?iE=av&currentIndex=<?php echo $currentIndex-1;?>"><i class="fa fa-arrow-left"></i> Ev&egrave;nement &agrave; valider pr&eacute;c&eacute;dent</a>

			  <?php endif ?>
			  <?php if ($hasNext) :?>
				<a style="float:right ; color:#707070 !important" href="<?php echo base_url("evenement-info-avalider");?>?iE=av&currentIndex=<?php echo $currentIndex+1;?>">Ev&egrave;nement &agrave; valider suivant <i class="fa fa-arrow-right"></i></a>
			  <?php endif ?>

		</div>
		  
		<?php endif ?>
		    </div>
	
    </div>
</div>

<div class="col-lg-3 col-sm-3 col-md-3 col-xs-9 comcenter" id="commentContainer" style="<?php  echo $av;  ?>background-color:red;background: 0% 0% no-repeat padding-box;
opacity: 1;height: 1249px;">
		<form action="<?php echo base_url('event-update-state'); ?>" method="POST">
		<input type="hidden" name="idEvent" value="<?php echo $idEvent;?>"/>
		<h3 style="color:#707070">Commentaires</h3>
		<?php if(isset($listComms) && !empty($listComms)){foreach($listComms as $com){
			$firstCharacterN= substr($com->name, 0, 1);
			$firstCharacterF = substr($com->firstname, 0, 1);
			$txtFirst = strtoupper($firstCharacterN).''.strtoupper($firstCharacterF);
		?>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="row" style="height: 100%;display: table-row;">
					<div class="col-lg-3" style="color:white; display: table-cell; float: none;background: #707070; height:30px;display:flex; width:30px;border-radius: 50%;text-align:center;align-items: center; justify-content: center;"><?php echo $txtFirst;?></div>

					<div class="col-lg-9" style="display: table-cell; float: none;">
						<p style="color:#707070;font-size:16px"><strong><?php echo $com->name.' '.$com->firstname;?></strong></p>
						<p style="color:#707070;font-size:12px !important;"><?php if($com->typeUser == 'admin') echo "Administrateur"; else echo "Organisateur";?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<p style="color:#707070"><?php echo $com->comment;?></p>
			</div>
		</div>
		</br>
		<?php } } ?>
		<?php
			$firstCharacterN= substr($session->get('userName'), 0, 1);
			$txtFirst = strtoupper($firstCharacterN);
		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="row" style="height: 100%;display: table-row;">
					<div class="col-lg-3" style="color:white;display: table-cell; float: none;background: #707070; height:30px;display:flex; width:30px;border-radius: 50%;text-align:center;align-items: center; justify-content: center;"><?php echo $txtFirst;?></div>

					<div class="col-lg-9" style="display: table-cell; float: none;">
						<p style="color:#707070;font-size:16px"><strong><?php echo $session->get('userName');?></strong></p>
						<p style="color:#707070;font-size:12px !important;"><?php if($session->get('userType') == 'admin') echo "Administrateur"; else echo "Organisateur";?></p>
					</div>
				</div>
			</div>
			
		</div>
		</br>
		<p style="color:#707070" ><textarea name="comment" rows="4" style="width:100%" placeholder="Ajouter un commentaire"></textarea></p>
		<p style="float:right"><input type="submit" value="Envoyer"/></p>
		
		</form>
</div>
		

<div id="modallieu" class="modal" role="dialog">
        <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title" id="title">Nouveau lieu</h3>
      </div>
      <div class="modal-body">
        <div> <label >Libell&eacute; </label><input type="hidden" id="idPlace" name="idPlace" value="<?php echo $idPlace;?>" />
                <input class="form-control" type="text" name="libLieu" value="<?php echo $libelle;?>" id="libLieu"/></div>
        <div> <label >Latitude </label><input type="text"   class="form-control"name="lat" value="<?php echo $lat;?>" id="lat"/> </div>
        <div> <label >Longitude </label><input  class="form-control" type="text" name="lng" value="<?php echo $lng;?>" id="lng"/></div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <label > Ville </label>
                <select  class="form-control" name="city"  class="" id="idcity">
                    <?php foreach ((array)$cityList as $row): ?>
                       <option id="cityname"  <?php if($idCity == $row['idCity']) echo "selected";?>value="<?=esc($row['idCity']);  ?>"><?=esc($row['name']);  ?></option>
                    <?php endforeach; ?>
                </select>
             </div> <br/> 
            <div class="col-lg-4 col-md-4 col-sm-4" style="bottom:0;heighit:auto;width: 100%;margin-top:5px">
                <button type="button" class="btn" data-toggle="modal" data-target="#modalcity">Nouvelle ville</button></p>
             </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" id="btnSendLieu" class="btn btn-default ajoutlieu" onclick="addLieu()">Enregistrer</button>
      </div>
    </div>
 </div>
  </div>
  <!-- Modal -->
  <div id="modalcity" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Nouvelle ville</h3>
      </div>
      <div class="modal-body">
    <p><label > Libell&eacute; </label ><input class="form-control" type="text" name="libcity" id="libcity"/></p>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-default ajoutlieu" id="btnSendCity" onclick="addCity()">Enregistrer</button>
      </div>
    </div>
 </div>
  </div>
  <div id="modalCategorie" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Ajouter un cat&eacute;gorie</h3>
      </div>
      <div class="modal-body">
        <p><label class="control-label col-md-3"> Nom du cat&eacute;gorie</label>
          <input type="hidden" id="idCategory" name="idCategory" value="<?php echo $idCategory;?>" />
         <input class="form-control" type="text" name="cat" id="idcat"/></p>
      </div>
      <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
           <button type="button" id="title" class="btn btn-default ajoutlieu"  id="btnSend" onclick="addCategorie()">Ajouter un cat&eacute;gorie</button>
       </div>
    </div>
  </div>
</div>

<div id="modalpdv" class="modal">
    <div class="modal-dialog modal-megamenu">
    <!-- Modal content-->
       <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title" id="titleModal">Nouveau point de vente</h3>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
            <form class="form-horizontal" role="form" style="width:100% !important;padding-right:0px">
               <div class="form-group">
                    <div class="row">
                         <label  class="col-sm-2 control-label">Nom du point de vente</label>
                          <div class="col-sm-12">
                          <input type="hidden" name="idpos" id="idpos"/>
                          <input style="width:100% !important" class="form-control" type="text" name="libpdv" id="libpdv"/>
                          </div>
                    </div>
                    <br/>
                      
                    <div class="row">
                        <label  class="col-sm-2 control-label" ><b>Localisation</b></label >
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                          <label class="control-label" >Latitude</label >
                          <div class="">
                              <input type="text" style="width:100% !important" class="form-control" name="latpos" id="latpos" placeholder="Ex: -18.123456"/> </p>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <label  class="control-label" >Longitude</label > 
                          <div class="">
                                <input type="text" style="width:100% !important" class="form-control" name="lngpos" id="lngpos" placeholder="Ex: 47.123456" /> 
                          </div>
                        </div>

                    </div>
                  
                   
                  </div>
              </div>
          </div>
          <div class="modal-footer">
          <div class="row">
                        <div class="col-md-6 ml-auto" >
                          <button type="button" style="width:100% !important" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        </div>
                        <div class="col-md-6 ml-auto">
                              <p><button type="button" id="title" style="width:100% !important" id="btnSendpdv" class="btn btn-default ajoutlieu" onclick="addPdv()">Nouveau point de vente</button></p>
                        </div>
                    </div>
          </div>
       </div>
    </div>
  </div>

<!-- CONTENT -->

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

<footer>


</footer>

<script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
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
  <script class="include" type="text/javascript" src="<?php echo base_url('assets/lib/jquery.dcjqaccordion.2.7.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.scrollTo.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.nicescroll.js'); ?>" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="<?php echo base_url('assets/lib/common-scripts.js'); ?>"></script>
  <!--script for this page-->
  <script src="<?php echo base_url('assets/lib/jquery-ui-1.9.2.custom.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-fileupload/bootstrap-fileupload.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-daterangepicker/date.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-daterangepicker/moment.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/advanced-form-components.js'); ?>"></script>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/modal.css'); ?>">

 
 <script type="text/javascript" >

function addLieu(){
    libelle = $("#libLieu").val();
    lat = $("#lat").val();
    lng = $("#lng").val();
    city = $('#idcity option:selected').val();
    if(libelle === null || libelle.trim() === '') {
      alert('Veuillez entrer le nom de la place');
      return;
    }
    if(lat === null || lat.trim() === ''){
      alert('Veuillez entrer la latitude');
      return;
    }
    if(lng === null || lng.trim() === ''){
      alert('Veuillez entrer la longitude');
      return;
    }
    if(!city){
      alert('Veuillez sélectionner la ville');
      return;
    }
    $.ajax({
    url : 'save/place', // La ressource ciblée
    dataType : 'json',
    type : 'POST', // Le type de la requête HTTP.
        data:{ libelle:libelle,lat:lat,lng:lng,city:city
    },success:function(data){
        listPlace = "";
        $.each(data, function(key, value) {
          if(value.name == libelle){
            listPlace = listPlace+"<option selected='true' value='"+value.idPlace+"'>"+value.name+"</option>";
          }
          else{
              listPlace = listPlace+"<option value='"+value.idPlace+"'>"+value.name+"</option>";
          }
        });
        $('#idPlace').html(listPlace);
         $("#modallieu").modal('hide');
    },
    });
  
  }

  function addCategorie(){
    libelle = $("#idcat").val();
    if(libelle === null || libelle.trim() === '') {
      alert('Veuillez entrer le nouveau catégorie');
      return;
    }
    $.ajax({
    url : '<?php echo base_url("gestion/category_insert_post"); ?>', // La ressource ciblée
    dataType : 'json',
    type : 'POST', // Le type de la requête HTTP.
        data:{ libelle: libelle
    },success:function(data){
        $("#modalCategorie").modal('hide');
        listCat = "";
        $.each(data, function(key, value) {
          if(value.name == libelle){
            listCat = listCat+"<option selected='true' value='"+value.idCategory+"'>"+value.name+"</option>";
          }
          else{
              listCat = listCat+"<option value='"+value.idCategory+"'>"+value.name+"</option>";
          }
        });
        $('#categoryid').html(listCat);
    },
    });
  }



 </script>
<script type="text/javascript" >
function deleteEvent(idE){
       res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =   "<?php echo base_url('event/remove?id='); ?>"+idE;
          document.location.href = url;
          return true;
          }
         else{
           return false;
         }
      }
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
    
    
       
      

            $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-3d'
        });

var expanded = false;
function infoEvent(id)
   {
      location.href="<?php echo base_url('evenement/info');?>?iU="+id;
   }
function showCheckboxes()
{
    var checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}
function addPdv(){
    pdvName = $("#libpdv").val();
    //place = $('#idplace option:selected').val();
    if(pdvName === null || pdvName.trim() === '') {
      alert('Veuillez entrer le nom du point de vente');
      return;
    }
    lat = $("#latpos").val();
    lng = $("#lngpos").val();
  
    if(lat === null || lat.trim() === ''){
      alert('Veuillez entrer la latitude');
      return;
    }
    if(lng === null || lng.trim() === ''){
      alert('Veuillez entrer la longitude');
      return;
    }
      $.ajax({
       url : 'pos/save', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ pdvName:pdvName,lat:lat,lng:lng
      },success:function(data){
		listPdv = " "
        $.each(data, function(key, value) {

          listPdv = listPdv + " <label for='one'> <input type='checkbox' id='one'";
          if(value.name == pdvName){
            
            listPdv = listPdv+" checked ";
          }
          listPdv = listPdv+">"+value.name+"</label>"
        });
        $('#checkboxes').html(listPdv);
        // $("#modalpdv").modal('hide');
         //refreshPlaceList(libellePlace);
		   $("#modalpdv").modal('hide');
     
      },
      
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
    });
  }
  var listprice =  new Array();
  function ajouttarif()
  {
     nom =  $('#tarifNom').val();
     prix =  $('#tarifPrix').val();
     textTarif = nom+' : '+prix;
     texte = '<div class="col-lg-4 col-md-4" style="margin-right:5px;width:auto;background-color:#efefef;padding:1%;"> <input type="hidden" name="prixtarif" value="'+prix+'"/><input type="hidden" name="nomTarif" value="'+nom+'"/><button class="" style="border:0px;font-size:12px !important;width:auto;display: inline-block;" aria-label="Close"><span aria-hidden="true" style="color:black !important;background-color:#efefef;padding:2%;width:auto;float:right;height:auto">&times;</span>'+textTarif+'</button></div> ';
     $('.tarifcree').html($('.tarifcree').html()+texte);
     listprice.push(nom+'__'+prix);
     $('.tarifcree').css("display", "block");
     txtSelect="";
        for(i=1;i<listprice.length;i++){
            txtSelect = txtSelect+"<option value=\""+listprice[i]+"\" selected=\"true\">"+listprice[i]+"</option>";
        }
        $("#listTarif").html(txtSelect);
  }
  $("#addPhoto").click(function() {
    $("input[id='image']").click();
    });
	
	function rejeter()
	{
		$("#commentContainer").css("display", "block");
		
	}
	
 </script>
</body>
 
</html>
