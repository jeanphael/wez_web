<!DOCTYPE html>
<html lang="en">
<!--?php include('head.php'); ?!-->
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  
  <title>Administration</title>
  <script > var listprice =  new Array(); 
  function refreshPriceList()
{
    $('#newContainer').html('');
    
    txtSelect="";
        for(var i=0; i<listprice.length; i++){
            $tempPrice = listprice[i];
            console.log($tempPrice); 
            jQuery('<input  <?php echo $affichage; ?>  type="button" id="'+$tempPrice+'" value="× | '+$tempPrice+'" />', {
            class: 'some-class some-other-class'}).on('click',function(ev) {
                var clickedBtnID = $(this).attr('id'); // or var clickedBtnID = this.id
                //alert('you clicked on button #' + clickedBtnID);
                listprice.splice(listprice.indexOf(clickedBtnID), 1);
                refreshPriceList();
            }).appendTo('#newContainer');

            txtSelect = txtSelect+"<option  value=\""+listprice[i]+"\" selected=\"true\">"+listprice[i]+"</option>";
        }
        $("#listTarif").html(txtSelect);
}
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  

  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>

  <link href="<?php echo base_url('assets/lib/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link rel="stylesheet"  href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"> 
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>  
  
 <link href="<?php echo base_url('assets/css/style-bo.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.rawgit.com/mfd/09b70eb47474836f25a21660282ce0fd/raw/e06a670afcb2b861ed2ac4a1ef752d062ef6b46b/Gilroy.css">
<style>
body {
font:18px 'Gilroy', sans-serif;

}
.ui-datepicker {
    
    border: 1px solid #555;
    color: #000000;
	
}
.ui-state-default{
	background:#4ECDC4 !important;
}
.ui-corner-all{
	background:#4ECDC4 !important;
}
[type="checkbox"]:not(:checked),
[type="checkbox"]:checked {
  position: absolute;
  left: -9999px;
}

[type="checkbox"]:not(:checked)+label,
[type="checkbox"]:checked+label {
  position: relative;
  padding-left: 25px;
  cursor: pointer;
}

[type="checkbox"]:not(:checked)+label:before,
[type="checkbox"]:checked+label:before {
  content: '';
  position: absolute;
  left: 0;
  width: 15px;
  height: 15px;
  border-radius: 3px;
  box-shadow: inset 0 1px 3px #797979;
  border-radius: 10%;
  border: #797979;
  outline: none;
}

[type="checkbox"]:not(:checked)+label:after,
[type="checkbox"]:checked+label:after {
  content: '✔';
  position: absolute;
  left: 2px;
  top:12px;
  font-size: 14px;
  line-height: 0.8;
  color: #ffffff;
  transition: all .2s;
  background: #63C7B2;
  
}
 
[type="checkbox"]:not(:checked)+label:after {
  opacity: 0;
  transform: scale(0);
}

[type="checkbox"]:checked+label:after {
  opacity: 1;
  transform: scale(1);
  background: #63C7B2;
  
}


@media only screen and (max-width:768px) {
	.npdv {
	width: 50% !important;
	 }
}
@media only screen and (min-width:780px) {
	.npdv {
	width: 100% !important;
	 }
}


@media only screen and (max-width:480px) {
	.textplace {
	text-align: left !important;
	padding-right:0px !important;
	margin-bottom:10px !important;	}
}

@media only screen and (max-width:768px) {
  .comcenter {
    margin:auto;
	float: none;
	display:flex;
	height : 250px !important;
	 }
}
@media only screen and (min-width:768px) {
  .comcenter {
    float: right;
	box-shadow: -2px 3px 4px #8f8f8f29; 
    border: 1px solid #F0F3F3;
  }
}

</style>
  

 
<script>
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2();
		
	});
</script>
</head>
<body style="background-color:#FAFAFA;">
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
    if(isset($event)){
		foreach($event as $event)
		{		
			$idEvent = $event->idEvent;
			$nom = $event->name;
			$description = $event->description;
			$image = $event->image;
			$ddeb = strtotime($event->dateBegin);
			$dateDebut = date('d-m-Y', $ddeb);
			$heureDebut =  date('H:i', $ddeb);
			$dfin=  strtotime($event->dateEnd);
			$dateFin = date('d-m-Y', $dfin);
			$heureFin = date('H:i', $dfin);
			$idPlace = $event->idPlace;
			$idCategory =  $event->idCategory;
			$affichageBan =  $event->affichageBan;
			$nbJour = $event->dureeAffichage;
			$ddebA = strtotime($event->dateDebutAffichage);
			$dateDebutAffichage =  date('d-m-Y', $ddebA);
			$dfinA = new DateTime($event->dateFinAffichage);
			//$dfinA->add(new DateInterval('P'.$nbJour.'D'));
			$dateFinAffichage = $dfinA->format('d-m-Y') ;
			$heureDebutAffichage = date('H:i', $ddebA);
			$heureFinAffichage = '23:59';   
			$dateB = new DateTime($event->dateFinAffichage);
			$isValidated = $event->isValidated;
			//$dateB->add(new DateInterval('P'.$nbJour.'D'));
			$affichage ='';
			  if(new DateTime(date("Y-m-d H:i:s")) > $dateB){
				if(new DateTime(date("Y-m-d H:i:s")) >  new DateTime(explode(' ',$event->dateEnd)[0]) )
				{
				  $statut = 'Pass&eacute;';
				}
				else  $statut = 'Non publi&eacute;';
			 }
			 else{
				if($event->isValidated == 1) 
				{
					
					if(new DateTime(date("Y-m-d H:i:s")) < new DateTime(explode(' ',$event->dateDebutAffichage)[0]))
					{
						$statut = 'En attente de publication';
					}else{
						$statut = 'Publi&eacute;';
					}
					$affichage = 'disabled';
				}
				else $statut = 'En attente de validation';
				if($event->isValidated == 3) $statut = 'Brouillon';
				if($event->isValidated == 4) $statut = 'Rejet&eacute;';
			 }
		}
		
    }
    ?>
    
<div class="container-fluid">

<div class="col-lg-9 col-sm-9 col-md-9 block-right">
	<div class="col-lg-4 col-sm-4 col-md-4 block-center" >
	 </div>
    <div class="col-lg-8 col-sm-12 col-md-8 col-xs-12 block-center" <?php if(empty($listComms)){ ?>  <?php } ?>>
        <div class="row titleban">
                <div class="col-lg-8 col-md-8 col-sm-8">
                     <h3><b><?php if(isset($toUpdate)) echo "Editer l'&eacute;v&egrave;nement"; else echo "Nouvel &eacute;v&egrave;nement ";?></b></h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                   <a class="lien" href="<?php echo base_url("evenement-list-refonte");?>">Liste des &eacute;v&egrave;nements</a>
                </div>
        </div>
        <form enctype="multipart/form-data" action="<?php if(isset($toUpdate)) echo base_url("save-update-event"); else echo base_url("save-new-event");?>" method="POST"
        <?php if (!isset($toUpdate)) { echo "onsubmit='return isValidForm()'"; } else{ echo "onsubmit='return isValidForm()'"; } ?>>
         <div class="row whitebackground" style="background-color:white;padding:20px">
                 <h3><b>Information g&eacute;n&eacute;rale</b></h3>
		 <div class="row" style="background-color:white">
                 
                 <div class="col-lg-4 col-md-4 col-lg-push-8 col-md-push-8" style="padding-top:6% !important">
                         <p><strong>Status: </strong><?php if (isset($toUpdate)) echo $statut;?></p>
                     </div> 
					 <div class="col-lg-8 col-md-8 col-lg-pull-4 col-md-pull-4">
                     <div class="form-group">
                         <label for="exampleInputEmail1">Nom de l'év&egrave;nement</label>
                         <input type="hidden" name="imageLastName" value="<?=esc($image);  ?>"/>
                         <input type="text" <?php echo $affichage; ?> class="form-control" id="nom"  name="nom" value="<?php echo $nom; ?>" placeholder="Entrez le nom de l'évenement" required>
                    </div>
                 </div>
		 </div>
		  <input type="hidden" class="form-control" id="idE" name="idEvent" value="<?php echo $idEvent; ?>">
                         
            <div class="row"  style="background-color:white">
                 <div class="col-lg-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea class="form-control" rows=5 name="description"  placeholder="Ajoutez une description de l'&eacute;v&egrave;nement">
                      <?php echo $description; ?> 
                        </textarea>
                    </div>
                </div>
            </div>
		
            <div class="row" style="background-color:white">
                 <div class="col-lg-8 col-md-8">
                     <div class="form-group">
                         <label for="exampleInputEmail1">Catégorie</label>
                         <select <?php echo $affichage; ?>  name="category"  class="form-control" id="categoryid">
                        <?php foreach ($categoryList as $rowcat): ?>
                        <option <?php if(!empty($idCategory) && $idCategory==$rowcat['idCategory'])  echo "selected=\'true\'"; ?> value="<?=esc($rowcat['idCategory']);  ?>"><?=esc($rowcat['name']);  ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                 </div>
                 <div class="col-lg-4 col-md-4"  style="padding-top:7% !important">
                    <strong> <p style="color:#63C7B2;font-size:22px;vertical-align:middle" > + <a  <?php echo $affichage; ?>  for="exampleInputEmail1" href="#" class=" lienVert" style="padding-bottom:0px !important;height:100% !important;font-weight:400 !important;padding-left:2px" data-toggle="modal" data-target="#modalCategorie">Ajouter un catégorie</a></p> </strong> 
                 </div> 
            </div>
            <br/>
          
            <div class="row" style="background-color:white">
                <div class="col-lg-6 col-md-6">
                    <h4><b>Date de l'&eacute;v&egrave;nement</b></h4>
                </div>
                <div class="col-lg-6 col-md-6 text-right" >
                </div>
            </div>
            <div class="row" style="background-color:white">
                <div class="col-lg-4 col-md-4 col-xs-12">
                   <div class="col-lg-12 col-md-12 col-xs-12"  style="padding-left:0px">
					<label for="exampleInputEmail1" class="text-left">Date et heure de d&eacute;but</label>
					</div> 
                    <div class="col-lg-6 col-md-6 col-xs-6"  style="float:left;padding-left:3px !important;margin:0px !important;margin-bottom:10px !important">
                         <div class="inner-addon right-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            <input type="text" <?php echo $affichage; ?> name="dateBegin" <?php if($isValidated==1) echo "disabled";?> autocomplete="off"  id="datepickerBeginEvent" placeholder="00/00" value="<?php echo $dateDebut; ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-6"  style="float:right;padding-left:3px !important;margin:0px !important;margin-bottom:10px !important">
                        <div class="inner-addon right-addon">
                            <i class="glyphicon glyphicon-time"></i>
                            <input type="text" <?php echo $affichage; ?> name="timeBegin" <?php if($isValidated==1) echo "disabled";?> autocomplete="off"  id="timepickerBeginEvent" placeholder="00:00" value="<?php echo $heureDebut; ?>" class="form-control"/>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-xs-12"  style="padding-left:0px">
						<label for="exampleInputEmail1"  class="text-left">Date et heure de fin</label>
					</div>
                    <div class="col-lg-6 col-md-6 col-xs-6"  style="float:left;padding-left:3px !important;margin:0px !important;margin-bottom:10px !important">
                        <div class="inner-addon right-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            <input type="text" <?php echo $affichage; ?> name="dateEnd" <?php if($isValidated==1) echo "disabled";?> autocomplete="off"  id="datepickerEndEvent" placeholder="00/00"  value="<?php echo $dateFin; ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-6"  style="float:right;padding-left:3px !important;margin:0px !important;margin-bottom:10px !important">
                        <div class="inner-addon right-addon">
                            <i class="glyphicon glyphicon-time"></i>
                            <input type="text" <?php echo $affichage; ?>  name="timeEnd" <?php if($isValidated==1) echo "disabled";?> autocomplete="off"  id="timepickerEndEvent" placeholder="00:00" value="<?php echo $heureFin; ?>" class="form-control"/>
                        </div>
                    </div> 
                </div>
            </div>
            <br/>
            <?php
             $session = \Config\Services::session();   
             if($_SESSION['userType'] == "admin")
             { ?>
           
            <div class="row" style="background-color:white">
                 <div class="col-lg-8 col-md-8">
                     <div class="form-group">
                         <label for="exampleInputEmail1">Organisateur</label>
                         <select <?php echo $affichage; ?>  name="idOrganizer"  class="form-control" id="idOrganizer">
                            <?php foreach ($organizerList as $rowOrganizer): ?>
                            <option <?php if(!empty($organizerList) && $idOrganizer==$rowOrganizer->idOrganizer) echo "selected=\'true\'"; ?> value="<?php echo $rowOrganizer->idOrganizer;  ?>"><?php echo $rowOrganizer->name;  ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                      </div>
                 </div>
                 
            </div>
            <br/>
            <?php } ?>
           

            <div class="row" style="background-color:white">
                 <div class="col-lg-8 col-md-8">
                     <div class="form-group">
                         <label for="exampleInputEmail1">Lieu</label>
                         <select  <?php echo $affichage; ?> name="lieu"  class="form-control" id="idPlace">
                            <?php foreach ($placeList as $rowPlace): ?>
                            <option <?php if(!empty($placeList) && $idPlace==$rowPlace->idPlace) echo "selected=\'true\'"; ?> value="<?php echo $rowPlace->idPlace;  ?>"><?php echo $rowPlace->name;  ?> - <?php echo $rowPlace->nameCity;  ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                 </div>
                <div class="col-lg-4 col-md-4"  style="padding-top:7% !important">
                    <strong> <p style="color:#63C7B2;font-size:22px;vertical-align:middle" > + <a  <?php echo $affichage; ?>  for="exampleInputEmail1" href="#" class=" lienVert" style="padding-bottom:0px !important;height:100% !important;font-weight:400 !important;padding-left:2px" data-toggle="modal" data-target="#modallieu">Ajouter un lieu</a></p> </strong> 
                 </div> 
            </div>
			
            <br/>
			 <div class="row" style="background-color:white">
                 <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-xs-8">
                          <label for="exampleInputEmail1">Tarifs</label>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-xs-4" >
                          <input <?php echo $affichage; ?> type="checkbox"  name="gratuit" id="gratuit" <?php if(!empty($isEventGratuit) && $isEventGratuit==1) echo "checked"; ?> onclick="griserTarif()"/> 
						  <label style="float:right;" for="gratuit" > Gratuit </label>
                        </div> 
						
                    </div>
                </div>
                <div class="col-lg-8 col-md-8" id="sectionTarif">
                    <div class="row"> 
                         <div class="col-lg-4 col-md-4" style="margin-bottom:10px">
                            <input type="text" <?php echo $affichage; ?>  class="form-control" id="tarifNom"  name="typeTarif" value="" placeholder="Type de tarif" >
                         </div>
                        <div class="col-lg-4 col-md-4" style="margin-bottom:10px">
                            <input type="number" <?php echo $affichage; ?>  class="form-control" id="tarifPrix"  name="tarifPrix" value="" placeholder="Ar 00 000" >
                         </div>
                        <div class="col-lg-3 col-md-3">
                             <p><button  <?php echo $affichage; ?> for="exampleInputEmail1" type="button" class="btn" style="padding-bottom:0px;height:100%" id="btnAddTarif">Ajouter un tarif</button></p>   
                        </div> 
                    </div>
                    <div class="row tarifcree"  <?php if(!isset($toUpdate)){?>style="display:none" <?php } ?>>
                            <label for="exampleInputEmail1" style="font-size:12px;color:#ccc">Tarifs cr&eacute;&eacute;s</label>
                            <br/>
                            <?php if(isset($trfListSelected)){
                          foreach($trfListSelected as $rowTarif){
                            if($rowTarif->value !=0){
                              echo '<script type="text/javascript"> listprice.push("'.$rowTarif->name.' : '.$rowTarif->value.'");</script>';
                            }
                      }
                          }
						  ?>
                            
                    </div>
					 <div id="newContainer"></div>
                    <select  <?php echo $affichage; ?>  style="display:none" name="listTarif[]" multiple class="form-control" id="listTarif">
                        
                    </select>
                 </div>
                 <div class="col-lg-4 col-md-4">
                 </div> 
            </div>
            <br/>
         
			   <div class="row" style="background-color:white" id="sectionpdv">
                 <div class="col-lg-6 col-md-6">
                     <div class="form-group">
                         <label for="exampleInputEmail1">Point de vente</label>

                              <select  <?php echo $affichage; ?> class="js-example-basic-multiple" id="pdv_selected"  name="pdv_selected[]" multiple="multiple" style="width:100%" >
                                  
                                  <?php foreach ($pdvList as $rowPDV): ?>
                                    <option  value="<?php echo $rowPDV->idPointOfSale;  ?>" 
                                        <?php if( isset( $pdvListSelected ) && !empty($pdvListSelected))
                                            {
                                              foreach ($pdvListSelected as $rowPDVSelected):if($rowPDV->idPointOfSale == $rowPDVSelected->idPointOfSale)
                                              {  
                                                echo "selected";
                                              } 
                                              endforeach;
                                          }?> ><?php echo $rowPDV->name;  ?></option>
                                <?php endforeach; ?>
                                  
                              </select>
                        </div>
                 </div>
                  <div class="col-lg-6 col-md-6"  style="padding-top:7% !important">
                    <strong> <p style="color:#63C7B2;font-size:22px;vertical-align:middle" > + <a  <?php echo $affichage; ?>  for="exampleInputEmail1" href="#" class=" lienVert" style="padding-bottom:0px !important;height:100% !important;font-weight:400 !important;padding-left:2px" data-toggle="modal" data-target="#modalpdv">Ajouter un point de vente</a></p> </strong> 
                 </div> 
            </div>
			<br/>
           
            <br/>
			  <div class="row" style="background-color:white">
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <h4><b>Publication</b></h4>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12 textplace text-right" >
                   <label style="padding-right:10px"> Publier dans les top evenements </label><input type="checkbox" id="pub" <?php echo $affichage; ?> <?php if($isValidated==1) echo "disabled";?> <?php if(!empty($affichageBan) && $affichageBan==1) echo "checked"; ?> name="isban"/>
                <label for="pub"></label>
				</div>
            </div>
            <div class="row" style="background-color:white">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <label for="exampleInputEmail1" class="text-center">Date de d&eacute;but</label>
                    <div class="col-lg-12 col-md-12 col-xs-12"  style="float:left;padding-left:3px !important;margin:0px !important;">
                        <div class="inner-addon right-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            <input name="dateBeginPublished"  <?php if($isValidated==1) echo "disabled";?> type="text" autocomplete="off" id="datepickerBeginPublish" placeholder="00/00" value="<?php echo $dateDebutAffichage;?>" class="form-control"/>
                        </div>
                    <!--input type="text" class="form-control"  style="float:left;padding:0px !important;margin:0px !important;width:100% !important"/-->
                    </div>
					
                </div>
				
				<div class="col-lg-4 col-md-4 col-xs-12">
                    <label for="exampleInputEmail1" class="text-center">Date de fin</label>
                    <div class="col-lg-12 col-md-12 col-xs-12"  style="float:left;padding-left:3px !important;margin:0px !important;">
                        <div class="inner-addon right-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            <input name="dateEndPublished" <?php if($isValidated==1) echo "disabled";?> type="text"  autocomplete="off"  id="datepickerEndPublish" onchange="getCout()" placeholder="00/00"  value="<?php echo $dateFinAffichage;?>"  class="form-control"/>
                        </div>
                    </div>
					
					
                </div>
				
				<div class="col-lg-4 col-md-4 col-xs-12">
                    <label for="exampleInputEmail1" class="text-left">Nombre de jours</label> 
                    <div class="row">
                      <div class="col-lg-2 col-md-4 col-xs-2" style="float:left;padding:0px !important;margin-left:15px !important">
                      <input disabled type="number" name="nbJour" id="nbJour" class="form-control" placeholder="00"  value="<?php echo $nbJour;?>"   style="float:left;padding:0px !important;text-align:center !important;width:100% !important"/> 
                      <input type="hidden" id="dureeAffichage" name="nbJour" class="form-control" placeholder="00"    style="float:left;padding:0px !important;text-align:center !important;margin:0px !important;width:100% !important"/> 
                      </div> 
                      <div class="col-lg-6 col-md-4 col-xs-4 text-left">
                      <span><strong>Cout</strong></span><br/>
                      <span id="coutAff"><strong>0 Ar</strong></span>
                      
                      </div>
                    </div>
                </div>
				
			</div>
			
            <br/>
		
            <div class="row" style="background-color:white">
                 <div class="col-lg-12 col-md-12 center-block">
                     <div class="form-group">
                         <label for="exampleInputEmail1">Image de l'&eacute;v&egrave;nement</label>
                         <div id="addPhoto" onclick="onAddPhotoClicked()" class="row text-center center-block" style="padding:10%;background-color:#EFEFEF;width:100%<?php if(!empty($image))echo ';background-image:url('.$image.'); background-repeat: no-repeat; background-size: cover; '; ?>">
                         <?php if(empty($image)) {?><p class="text-center"><strong><i class="fa fa-image"></i> Glissez ou importez l'image de l'évènement ici.</strong></p>
                             <p class="text-center">JPEG ou PNG , pas plus de 10Mo</p><?php } ?>
                             
                             
                        </div>
                        
                        <input type="file"  style="display:none;"  id="inputImage" class="form-control"  name="image" value="<?php echo $image; ?>"  accept="image/x-png,image/gif,image/jpeg"/>
                    </div>
                 </div>
            </div>
                <!--div class="input-group date" data-provide="datepicker"-->
           
            <br/><br/>
            <?php
			if($_SESSION['userType'] != "admin")
             {?>
           
            <div class="row"  style="background-color:white;" >
                 <div class="col-lg-4" style="margin-bottom:15px !important">
                 <input type="button"  <?php echo $affichage; ?>  onclick="annuler()" class="btn vert-button"  style="width:100%" value="Annuler"/>
                 </div>
                 <?php if(!isset($toUpdate))  { ?>
                 <div class="col-lg-4" style="margin-bottom:15px !important">
                 <input type="submit"  <?php echo $affichage; ?>  name="buttonsubmit" class="btn vert-button"  style="width:100%" value="Enregistrer en brouillon"/>
                 </div>
                 <div class="col-lg-4" style="margin-bottom:15px !important">
                 <input type="submit"  <?php echo $affichage; ?>  name="buttonsubmit"  class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Envoyer pour validation"/>
                 </div>
				 <?php } else { echo $buttonText;}?>
            </div>
            <?php }
				else { ?> 
			<div class="row"  style="background-color:white">
                 <div class="col-lg-4" style="margin-bottom:15px !important">
                 <input type="button"   onclick="annuler()" class="btn vert-button"  style="width:100%" value="Annuler"/>
                 </div>
                 <?php if(!isset($toUpdate))  { ?>
                 <div class="col-lg-4"style="margin-bottom:15px !important">
                 <input type="submit"  <?php echo $affichage; ?>  name="buttonsubmit"   class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Valider"/>
                 </div>
				 <?php } else { echo $buttonText;}?>
            </div>
			
			
			<?php } 
		?>
         </div>
         </form>
    </div>
	
  </div>  
<?php if(!empty($listComms)){?>

<div class="col-lg-3 col-sm-3 col-md-3 col-xs-10 comcenter" id="commentContainer" style="background: #ffffff !important 0% 0% no-repeat padding-box;
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
		<p style="color:#707070"><textarea name="comment" rows="4" style="width:100%;" placeholder="Ajouter un commentaire"></textarea></p>
		<p style="float:right"><input type="submit" value="Envoyer"/></p>
		</form>
</div>
<?php }?>		

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
                <input class="form-control" style="width:100% !important"  type="text" name="libLieu" value="<?php echo $libelle;?>" id="libLieu"/></div>
        <div class="media"> 
			<div class="media-body" style=""> 
				<label >Latitude </label><input style="width:100% !important" type="text"  <?php echo $affichage; ?>   class="form-control"name="lat" placeholder="Ex: -18.000000" value="<?php echo $lat;?>" id="lat"/>
			</div> 
			<div class="media-body" style="padding-left:2% !important"> 
				<label >Longitude </label><input style="width:100% !important" class="form-control" type="text" name="lng" value="<?php echo $lng;?>"  placeholder="Ex: 47.000000" id="lng"/>
			</div>
		</div>	
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <label > Ville </label>
                <select   <?php echo $affichage; ?> class="form-control" name="city"  class="" id="idcity">
                    <?php foreach ((array)$cityList as $row): ?>
                       <option id="cityname"  <?php if($idCity == $row['idCity']) echo "selected";?>value="<?=esc($row['idCity']);  ?>"><?=esc($row['name']);  ?></option>
                    <?php endforeach; ?>
                </select>
             </div> <br/> 
            <div class="col-lg-4 col-md-4 col-sm-4" style="bottom:0;heighit:auto;width: 100%;margin-top:5px">
                <button  <?php echo $affichage; ?>  type="button" class="btn" data-toggle="modal" data-target="#modalcity">Nouvelle ville</button></p>
             </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button"  <?php echo $affichage; ?>  id="btnSendLieu" class="btn btn-default ajoutlieu" onclick="addLieu()">Enregistrer</button>
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
        <button <?php echo $affichage; ?>  type="button" class="btn btn-default ajoutlieu" id="btnSendCity" onclick="addCity()">Enregistrer</button>
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
           <button  <?php echo $affichage; ?> type="button" id="title" class="btn btn-default ajoutlieu"  id="btnSend" onclick="addCategorie()">Ajouter un cat&eacute;gorie</button>
       </div>
    </div>
  </div>
</div>

<div id="modalpdv" class="modal" role="dialog">
    <div class="modal-dialog">
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
					 <div class="media">
                        <div class="media-body" style="padding-right:2% !important;">
                          <label class="control-label" >Latitude</label >
                          <div class="">
                              <input type="text"  style="width:100% !important" class="form-control" name="latpos" id="latpos" placeholder="Ex: -18.123456"/> </p>
                          </div>
                        </div>
                        <div class="media-body" style="padding-right:2% !important;">
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
		    <button type="button"  class=" btn btn-default" data-dismiss="modal">Annuler</button>
            <button <?php echo $affichage; ?> type="button" id="title" style="" id="btnSendpdv" class=" btn btn-default ajoutlieu" onclick="addPdv()">Nouveau point de vente</button>
           </div>
       </div>
    </div>
  </div>

<!-- CONTENT -->

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

<footer>


</footer>

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
  
  
  function addCity(){
    libelle = $("#libcity").val();
    if(libelle === null || libelle.trim() === '') {
      alert('Veuillez entrer le nom de la ville');
      return;
    }
    $.ajax({
       url :  "<?php echo base_url('city_insert_post'); ?>",
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ libelle:libelle
      },success:function(data){
        listPlace = "";
        $.each(data, function(key, value) {
          if(value.name == libelle){
            listPlace = listPlace+"<option selected='true' value='"+value.idCity+"'>"+value.name+"</option>";
          }
          else{
              listPlace = listPlace+"<option value='"+value.idCity+"'>"+value.name+"</option>";
          }
        });
        $('#idcity').html(listPlace);
        $('#idcityPdv').html(listPlace);
         $("#modalcity").modal('hide');
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
    function deleteUser(idU){
       res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =   "<?php echo base_url('admin/delete?i='); ?>"+idU;
          document.location.href = url;
          return true;
          }
         else{
           return false;
         }
      }
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

            $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-3d'
        });

var expanded = false;
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
		listPdv = " ";
        $.each(data, function(key, value) {

          listPdv = listPdv + "  <option value='"+value.idPointOfSale+"'";
          if(value.name == pdvName){
            
            listPdv = listPdv+" selected ";
          }
          listPdv = listPdv+">"+value.name+"</option>"
        });
        $('#pdv_selected').html(listPdv);
        // $("#modalpdv").modal('hide');
         //refreshPlaceList(libellePlace);
		   $("#modalpdv").modal('hide');
     
      },
      
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
    });
  }
  function deleteTarif()
  {
    //alert('test');
  }
  
 
  $('#btnAddTarif').on('click',function(e) {
      nom =  $('#tarifNom').val();
      prix =  $('#tarifPrix').val();
      if(nom === null || nom.trim() === ''  || prix === null || prix.trim() === '')
      {
        
         return;
      }
      $textTarif = nom+' : '+prix;
        if(listprice.indexOf($textTarif) !== -1)  
        {  
            return;
        }   
        listprice.push($textTarif);
        refreshPriceList();
        
        
});
 
 
  function onAddPhotoClicked(){
	 $("#inputImage").click();
  }
	if($('#pub').is(':checked')) price = true;
	else price = false;
  $('#pub').change(function(e) {
    if ($(this).is(':checked')) {
     price = true;
    }
    else price = false;
    getCout();
    }); 
  

    $( function() {
 
  } );

  $( document ).ready(function() {
    console.log( "ready---------------------------!" );
        
    /*$( "#datepickerBeginPublish" ).datepicker({ dateFormat: 'dd-mm-yy' }).on('select',function(e){
       getCout();
     });*/
	 $("#datepickerBeginPublish").datepicker({
		 dateFormat: 'dd-mm-yy',
		onSelect: function(dateText) {
			getCout();
		}
	});
	

	 $( "#datepickerEndPublish" ).datepicker({ dateFormat: 'dd-mm-yy' }).on('select',function(e){
       getCout();
     });
    $( "#datepickerBeginEvent" ).datepicker({ dateFormat: 'dd-mm-yy'  });
    $( "#datepickerEndEvent" ).datepicker({ dateFormat: 'dd-mm-yy'});
    
    $( "#timepickerBeginEvent").timepicker({timeFormat: 'HH:mm'});
    $( "#timepickerEndEvent").timepicker({timeFormat: 'HH:mm'});
});
  
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //$('#blah').attr('src', e.target.result);
            $('#addPhoto').css('background-image', "url("+e.target.result+")");
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#inputImage").change(function(){
    readURL(this);
});
function isValidForm()
{
  
  
  $nameEvent = $('#nom').val();
  if($nameEvent === null || $nameEvent.trim() === '')
  {
    alert("Veuillez entrer le nom de l'evenement");
    return false;
  }
  
   $datepickerBeginPublish = $('#datepickerBeginPublish').val();
   if($datepickerBeginPublish === null || $datepickerBeginPublish.trim() === '')
  {
    alert("Veuillez selectionner la date du publication");
    return false;
  }
   $timepickerBeginPublish = "00:00";
 
  $datepickerEndPublish = $('#datepickerEndPublish').val();
   if($datepickerEndPublish === null || $datepickerEndPublish.trim() === '')
  {
    alert("Veuillez selectionner la date fin du publication");
    return false;
  }  
  $timepickerEndPublish = "00:00"; 
   
  //test date and time event

  $datepickerBeginEvent = $('#datepickerBeginEvent').val();
   if($datepickerBeginEvent === null || $datepickerBeginEvent.trim() === '')
  {
    alert("Veuillez selectionner la date de début de l'evenement");
    return false;
  }
  $timepickerBeginEvent = $('#timepickerBeginEvent').val();
   if($timepickerBeginEvent === null || $timepickerBeginEvent.trim() === '')
  {
    alert("Veuillez selectionner l'heure début de l'evenement");
    return false;
  }

  $datepickerEndEvent = $('#datepickerEndEvent').val();
   if($datepickerEndEvent === null || $datepickerEndEvent.trim() === '')
  {
    alert("Veuillez selectionner la date fin de l'evenement");
    return false;
  }
  $timepickerEndEvent = $('#timepickerEndEvent').val();
   if($timepickerEndEvent === null || $timepickerEndEvent.trim() === '')
  {
    alert("Veuillez selectionner l'heure fin de l'evenement");
    return false;
  }
  $diffDatePublish = isValidDateSelected($datepickerBeginPublish,$datepickerEndPublish,$timepickerBeginPublish,$timepickerEndPublish,true);
  if($diffDatePublish==0)
  {
    alert("La date et heure début d'affichage doit être inferieur à la date fin d'affichage");
    return false;
  }
  else if($diffDatePublish==-1)
  {
    alert("La durée d'affichage doit être 5 jours minimum");
    return false;
  }
  if(isValidDateSelected($datepickerBeginEvent,$datepickerEndEvent,$timepickerBeginEvent,$timepickerEndEvent,false)==0)
  {
    alert("La date et heure début de l'évenement doit être inferieur à la date fin de l'évenement");
    return false;
  }

  var checkedNum = $("#pdv_selected :selected").length;
    var checkedgratuit = $('#gratuit').is(":checked");
    
    if (checkedNum == 0 && !checkedgratuit) {
      // User didn't check any checkboxes
    alert("Veuillez séléctionner le point de vente");
    return false;
    }
	// test tarif if empty
    if (listprice.length == 0 && !checkedgratuit) {
      // price null
    alert("Veuillez ajouter un prix!");
    return false;
    }
	
  $idEvent = $('#idE').val();
  if($('#inputImage').get(0).files.length ===0 && ($idEvent === null || $idEvent.trim() === ''))
        {
          alert("Veuillez ajouter une photo!");
          return false;
        }
        return true;
    }
function isValidDateSelected($strBegin,$strEnd,$strHoursAndMinutesBegin,$strHoursAndMinutesEnd,$isMinFiveDays)
{
  $dateBegin =  getDateByString($strBegin);
  $dateEnd =  getDateByString($strEnd);
  $hourAndMinBeginSplited = $strHoursAndMinutesBegin.split(':');
  $hourAndMinEndSplited = $strHoursAndMinutesEnd.split(':');
  
  if($hourAndMinBeginSplited.length == 2)
  {
    //console.log("heur: "+$bits[0]+" minute "+$bits[1]);
    if($.isNumeric( $hourAndMinBeginSplited[0] ) && $.isNumeric( $hourAndMinBeginSplited[1] ) )
    {
      $dateBegin.setHours($hourAndMinBeginSplited[0]);
      $dateBegin.setMinutes($hourAndMinBeginSplited[1]);
    }
  }
  if($hourAndMinEndSplited.length == 2)
  {
    //console.log("heur: "+$bits[0]+" minute "+$bits[1]);
    if($.isNumeric( $hourAndMinEndSplited[0] ) && $.isNumeric( $hourAndMinEndSplited[1] ) )
    {
      $dateEnd.setHours($hourAndMinEndSplited[0]);
      $dateEnd.setMinutes($hourAndMinEndSplited[1]);
    }
  }

  if($dateBegin.getTime() >= $dateEnd.getTime() )
  {
    return 0;
  }

if($isMinFiveDays)
{
   $diffTime = Math.abs($dateEnd - $dateBegin);
  $diffDays = Math.ceil($diffTime / (1000 * 60 * 60 * 24));
  if($dateBegin.getTime()  < $dateEnd.getTime()  && $diffDays<5)
  {
    return -1;
  }
}
  
  return 1;
}

function isValidDate(s) {
  var bits = s.split('-');
  var d = new Date(bits[2] + '-' + bits[1] + '-' + bits[0]);
  return !!(d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[0]));
}

function getDateByString(s) {
  var bits = s.split('-');
  var d = new Date(bits[2] + '-' + bits[1] + '-' + bits[0]);
  return d;
}
function supprimerTarif(nom,prix)
{
	texte = nom+''+prix;
	$("#TES100").css('display','none');
	listprice.splice($.inArray(nom+'__'+prix, listprice), 1);
}

function griserTarif()
{
    if($("#gratuit").is(":checked")){
      $("#sectionTarif").hide();
	    $("#sectionpdv").hide();
		$("#pdv_selected").each(function() {
			//deselect all point of sale on gratuit selected
		$(this).val(null).trigger('change');
  });
    }
    else{
      $("#sectionTarif").show();
      $("#sectionpdv").show();
    }
}

function getCout()
{
	
 	$datepickerBeginPublish = $('#datepickerBeginPublish').val();
  $datepickerEndPublish = $('#datepickerEndPublish').val();
   if($datepickerBeginPublish === null || $datepickerBeginPublish.trim() === ''
   || $datepickerEndPublish === null || $datepickerEndPublish.trim() === '' )
  {
	
    return;
  }
   
  $dateBegin =  getDateByString($datepickerBeginPublish);
  $dateEnd =  getDateByString($datepickerEndPublish);
  $diffTime = Math.abs($dateEnd - $dateBegin);
  $diffDays = Math.ceil($diffTime / (1000 * 60 * 60 * 24));
  if($dateBegin.getTime() >= $dateEnd.getTime() || ($dateBegin.getTime()  < $dateEnd.getTime()  && $diffDays<5))
  {
	$('#coutAff').text("0 Ar");
	$('#dureeAffichage').val('0');
	 $('#nbJour').val( '0' );
    alert("La durée d'affichage doit être 5 jours minimum");
    return;
  }
  $('#nbJour').val( $diffDays );
  if(price == true){
    pri = <?php echo $printPrice->banniere;?>;
  }
  else pri = <?php echo $printPrice->normal;?>;
  $cout = $diffDays * pri;
  
  $('#coutAff').text($cout +" Ar");
  $('#dureeAffichage').val($diffDays);
  

}
function annuler()
{
	location.href="<?php echo base_url("evenement-list-refonte");?>";
}
$('#datepickerEndPublish').change(function () {
});

$('#idPlace').on('change', function() {         
  idPlace = $('option:selected', this).val();
   $.ajax({
       url : '<?php echo base_url(); ?>/evenement/ville/top', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ idPlace:idPlace
      },success:function(data){
			// s'il est visible on change ou pas , sinon (non modifiable statut passé ,non publié ...) on change pas
	
			console.log(data);
			if(data.existTop == 1)
			{
				if(data.event == $('#idE').val())
				{
					$('#pub').prop('disabled', false);
					$('#pub').prop('checked', true);
				}
				else
				{
					// rendre invisible
					$('#pub').prop('disabled', true);
					$('#pub').prop('checked', false);
				}
				
			}
			else{
				$('#pub').prop('disabled', false);
			}
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
	    //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
    });
});

 $.ajax({
       url : '<?php echo base_url(); ?>/evenement/ville/top', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ idPlace:$('#idPlace option:selected').val()
      },success:function(data){
			// s'il est visible on change ou pas , sinon (non modifiable statut passé ,non publié ...) on change pas
	
			console.log(data);
			if(data.existTop == 1)
			{
				if(data.event == $('#idE').val())
				{
					$('#pub').prop('disabled', false);
					$('#pub').prop('checked', true);
				}
				else
				{
					// rendre invisible
					$('#pub').prop('disabled', true);
					$('#pub').prop('checked', false);
				}
				
			}
			else{
				console.log("rendre visible");
				$('#pub').prop('disabled', false);
			}
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
	    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
    });


getCout();
griserTarif();
refreshPriceList();
 </script>
</body>
 
</html>
