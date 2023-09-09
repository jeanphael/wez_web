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
    
     <!--sidebar end-->
       <?php include('aside.php'); ?>
  
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i><?php if (!empty($event)) echo ' Mise à jour &eacute;v&egrave;nement'; else echo ' Nouvel &eacute;v&egrave;nement'; ?> </h3>
        <div class="row mt">
          <!--  DATE PICKERS -->
          <div class="col-lg-12">
            <div class="form-panel">
			<p><?php	echo $error;	?></p>
               <?php
			   
			   $validation =  \Config\Services::validation(); ?>
              <?= $validation->listErrors() ?>
              <form action="<?php if (!empty($event)) {
                echo base_url('event_updateValidate');
                $idE = $event->idEvent;
               $name = $event->name;
                $description = $event->description;
                $tab= explode(" ", $event->dateBegin );
                $dtBegin =explode("-", $tab[0]);
                $dateBegin=$dtBegin[1].'/'.$dtBegin[2].'/'.$dtBegin[0];



                $dateToformatBegin = explode(' ',$event->dateBegin)[0];
                $dateformatedBegin = explode('-',$dateToformatBegin);
                $datebeginning = $dateformatedBegin[2].'/'.$dateformatedBegin[1].'/'.$dateformatedBegin[0];


                $hrBegin=explode(":", $tab[1]);
                $hourBegin=$hrBegin[0].":".$hrBegin[1];
                $tabEnd= explode(" ",  $event->dateEnd );
                $dtEnd =explode("-", $tabEnd[0]);
                $dateEnd=$dtEnd[1].'/'.$dtEnd[2].'/'.$dtEnd[0];
                $hrEnd=explode(":", $tabEnd[1]);
                $hourEnd=$hrEnd[0].":".$hrEnd[1];
                $idOrganizer = $event->idOrganizer;
                $idPlace = $event->idPlace;
                $image = $event->image;
                $idCategory = $event->idCategory;
                $isValidated = $event->isValidated;
				$dureeAff = $event->dureeAffichage;
                $dateDebutAffichage = $event->dateDebutAffichage;
                								   
                 }
                 else 
				 {
					 echo base_url('event_save'); 
				
				 }
				?>  "class="form-horizontal style-form" method="POST" enctype="multipart/form-data"
         <?php if (empty($event)) { echo "onsubmit='return isValidImage()'"; } else{ echo "onsubmit='return isValidUpdate()'"; } ?>>
        
        <div class="form-group">
          <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Nom </b></label>
          <div class="col-md-4">
             <input type="hidden" name="id" value="<?=esc($idE);  ?>"/>
             <input type="hidden" name="imageLastName" value="<?=esc($image);  ?>"/>
             <input type="hidden" name="isValidated" value="<?=esc($isValidated);  ?>"/>
               <input type="name" name="nameEvent" class="form-control" id="contact-name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $name; ?>">
            <div class="validate"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Description</b></label>
          <div class="col-md-4">
            <textarea class="form-control" name="description" id="contact-message" rows="5" data-rule="required" data-msg="Please write something for us"><?php echo $description; ?></textarea>
            <div class="validate"></div>
          </div>  
        </div>
                <div class="form-group" style="border-bottom:none">
                  <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Date de d&eacute;but de l'&eacute;v&egrave;nement</b></label>
                  <div class="col-md-4">
					<div class="col-sm-6">
						<div class="input-group input-large" data-date="2020/01/01" data-date-format="yyyy-mm-dd">
						  <input style="height:34px;min-width:100%" type="date" class="dateInput" name="from" id="from"  >
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="input-group bootstrap-timepicker">
						  <input type="time" class="form-control" value="<?php if(!empty($event))echo $hourBegin; else echo "00:00";?>" name="timeBegin">
						  <span class="input-group-btn">
							<button class="btn btn-theme04" type="button"><i class="fa fa-clock-o"></i></button>
							</span>
						</div>
					</div>
                  </div>
				       <div class="col-md-4"><a onclick="printEnd()" style="padding-left:15px">+ Date et heure de fin</a></div>
                </div>
				<div class="form-group" id="blocDateFin">
                  <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Date de fin de l'&eacute;v&egrave;nement</b></label>
                  <div class="col-md-4">
				    <div class="col-sm-6">
						 <div class="input-group input-large" data-date="2020/01/01" data-date-format="yyyy-mm-dd">
							<input style="height:34px;min-width:100%" type="date" class="dateInput" name="to" id="to" >
						 </div>
					</div>
					
					<div class="col-sm-6">
						<div class="input-group bootstrap-timepicker">
						  <input type="time" class="form-control" name="timeEnd" value="<?php if(!empty($event))echo $hourEnd; else echo "00:00"; ?>">
						  <span class="input-group-btn">
							<button class="btn btn-theme04" type="button"><i class="fa fa-clock-o"></i></button>
							</span>
						</div>
					</div>
                  </div>
                </div>
        
        <div class="form-group">
          <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Lieu</b></label>
          <div class="col-md-4">
            <select name="place" id="idPlace"  class="form-control">
              <?php foreach ($placeList as $rowplace): ?>
              <option <?php if(!empty($idPlace) && $idPlace==$rowplace['idPlace']) echo "selected=\'true\'"; ?> value="<?=esc($rowplace['idPlace']);  ?>"><?=esc($rowplace['name']);  ?></option>
              <?php endforeach; ?>
       </select>
          </div>
      <div class="col-md-4">
        <button type="button" class="" data-toggle="modal" data-target="#modallieu">Nouveau lieu</button>
             </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Cat&eacute;gorie</b></label>
          <div class="col-md-4">
            <select name="category"  class="form-control" id="categoryid">
              <?php foreach ($categoryList as $rowcat): ?>
              <option <?php if(!empty($idCategory) && $idCategory==$rowcat['idCategory']) echo "selected=\'true\'"; ?> value="<?=esc($rowcat['idCategory']);  ?>"><?=esc($rowcat['name']);  ?></option>
              <?php endforeach; ?>
            </select></div>
       <div class="col-md-4">
        <button type="button" class="" data-toggle="modal" data-target="#modalCategorie">Nouvelle cat&eacute;gorie</button>
             
          </div>
        </div>


      <?php  $session = \Config\Services::session(); 
       if($_SESSION['idOrganizer'] == 0){ ?>
            <div class="form-group">
              <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Organisateur</b></label>
              <div class="col-md-4">
                <select name="organizer"  class="form-control" id="organizerId">
                  <?php foreach ($organizerList as $row): ?>
                  <option <?php if(!empty($idOrganizer) && $idOrganizer==$row->idOrganizer) echo "selected=\'true\'"; ?> value="<?php echo $row->idOrganizer;  ?>"><?php echo $row->name;  ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            <div class="col-md-4">
              <button type="button" class="" data-toggle="modal" data-target="#modalOrganisateur">Nouvel organisateur</button>
             </div>
            </div>    
      <?php } else { ?> <input type="hidden" name="organizer" value="<?php echo $_SESSION['idOrganizer']; ?>"/><?php } ?>
            <div id="tarifid">
        <div class="form-group">
          <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Tarif </b></label>
           <input type="checkbox" name="gratuit" id="gratuit" onclick="griserTarif()"/> Gratuit
           <div id="sectionTarif"> 
           <button type="button"  class="" data-toggle="modal" onclick="addTarifList(1)">Ajouter</button>
		     <button type="button"  class="" data-toggle="modal" onclick="dropTarifList(1)">Annuler</button>
         
          <div class="col-md-2">
            Libelle <input type="name" name="pricelibelle1" class="form-control" id="libtarif" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $price1; ?>"/>
          </div>
          <div class="col-md-2">
            Prix <input type="name" name="pricevalue1" class="form-control" id="prixtarif" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $price1; ?>"/>
          </div>
          <div class="col-md-2">
          <select name="listTarif[]" multiple class="form-control" id="listTarif">
            <?php if(isset($trfListSelected)){
              foreach($trfListSelected as $rowtrflst){
                ?><option value="<?php echo $rowtrflst->name.'__'.$rowtrflst->value; ?>" selected="true"><?php echo $rowtrflst->name.'__'.$rowtrflst->value;?></option>
                <?php 
              }
            }?>
           </select>
          </div>

          </div>
        </div>
		 <div class="form-group" id="sectionpdv">
          <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Point de vente</b></label>
          <div class="col-md-4">
            
             

          <div class="container_check_box" id="container_pdv_check">
		  
          <?php 
		  //var_dump($pdvListSelected);
		  foreach ($pdvList as $rowPDV): ?>
                         
            <input type="checkbox" name="pdv_selected[]" id="pdv_selected" 
              value="<?php echo $rowPDV->idPointOfSale;?>"
              <?php if( isset( $pdvListSelected ) && !empty($pdvListSelected))
                {
                foreach ($pdvListSelected as $rowPDVSelected):if($rowPDV->idPointOfSale == $rowPDVSelected->idPointOfSale)
                {  
                  echo "checked";
                } 
                  endforeach;
              }?> >
              <?php echo $rowPDV->name;  ?><br>
          <?php endforeach; ?>
            </div>
          </div>
      <div class="col-md-4">
        <button type="button" class="" data-toggle="modal" data-target="#modalpdv">Nouveau point de vente</button>
             </div>
        </div>
      </div>
	       <div class="form-group" id="">
          <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Affichage</b></label>
          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="affichage" id="normale" value="normale"  <?php if (!empty($event)) { if($event->affichageBan == '0') echo "checked "; echo "disabled";}
              else echo "checked";
              ?>>
              <label class="form-check-label" for="normale">
                Affichage normale
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="affichage" value="banniere" id="bann"<?php if (!empty($event)) { if($event->affichageBan == '1') echo "checked ";
              echo "disabled";}
              ?>>
              <label class="form-check-label" for="bann">
                Affichage dans la banni&egrave;re
              </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="col-md-6">
               <label class="form-check-label" for="normale">
                Durée de l'affichage
               </label> 
            </div>
              <div class="col-md-6">
               <select name="dureeJourAffichage" id="dureeJourAffichage" class="form-control" <?php if (!empty($event)) { 
              echo "disabled";}
             ?> onchange="settingPrice()">
                  <option value="7" <?php if ($dureeAff == 7) {  echo 'selected="true"'; } ?>
                      >Une semaine</option>
                  <option value="14" <?php if ($dureeAff == 14) {  echo 'selected="true"'; } ?>
                      >Deux semaines</option>
                  <option value="21" <?php if ($dureeAff == 21) {  echo 'selected="true"'; } ?>
                      >Trois semaines</option>
                  <option value="28" <?php if ($dureeAff == 28) {  echo 'selected="true"'; } ?>
                      >Un mois</option>
                </select>
             </div>
          </div>

          <div class="col-md-4">
             <div class="col-md-6">
                <label class="form-check-label" for="normale">
                    Nombre de jours suppl&eacute;mentaire
                </label>
            </div>
                <div class="col-md-6">
                    <input class="form-check-input" type="number" id="nbJsupp" onkeyup="settingPrice()" onchange="settingPrice()" name="nbJsupp" value="<?php if (!empty($event)) {  echo $event->nbJourSupplementaire;} else echo "0";
              ?>" <?php if (!empty($event)) { 
              echo "disabled";}
              ?>>
                
                     <label class="form-check-label" for="normale" id="containerPrice">
                    </label>
                </div>
          </div>
         </div>
         <div class="form-group last">
                  <label class="control-label col-md-3" style="color:black;font-size:18px"><b>Image</b></label>
                  <div class="col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
          <input type="hidden" name="imagename" value="<?php echo $image;?>"/>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">   <img src="<?php echo $image;  ?>" alt=""/>
                    </div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Selectionner image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Changer</span>
                        <input type="file" class="default" name="image" id="image" accept="image/x-png,image/gif,image/jpeg"/>
                        </span>
                       <!--  <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Supprimer</a> -->
                      </div>
                    </div>
                    <span class="label label-info">NOTE!</span>
                    <span>
                      Seul la derniere version de Firefox, Chrome, Opera,
                      Safari and Internet Explorer 10 supporte cette image attachée
                      </span>
                  </div>
                </div>
                <label class="control-label col-md-3"></label>
          
                  <div class="form-send" class="col-md-4">
                <input type="submit"  class="btn btn-large btn-primary"/>
              </div>
              </form>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
  
 </section>
<div id="modalCategorie" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouvelle cat&eacute;gorie</h4>
      </div>
      <div class="modal-body">
   <p><label class="control-label col-md-3"> Libell&eacute;</label>
       <input type="text" name="cat" id="idcat"/></p>
    <p><button type="button" id="btnSend" onclick="addCategorie()">Enregistrer</button></p></div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>

</div>
</div>
<div id="modalOrganisateur" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouvel organisateur</h4>
      </div>
      <div class="modal-body">
    <p>  <label >Nom </label>  <input type="text" name="modalOrganisateurName" id="modalOrganisateurName"/></p>
    <p> <label >Email </label>  <input type="text" name="modalOrganisateurEmail" id="modalOrganisateurEmail"/></p>
    <p> <label >Contact </label>  <input type="text" name="modalOrganisateurPhone" id="modalOrganisateurPhone"/></p>
    <p> <label >Description </label>  <input type="text" name="modalOrganisateurDescription" id="modalOrganisateurDescription"/></p>
      <p> <label >Adresse </label>  <input type="text" name="modalOrganisateurAdresse" id="modalOrganisateurAdresse"/></p>
      <p> <label >Nom utilisateur </label>  <input type="text" name="modalOrganisateurLogin" id="modalOrganisateurLogin"/></p>
      <p> <label >Mot de passe </label>  <input type="password" name="modalOrganisateurMdp" id="modalOrganisateurMdp"/></p>
      <p> <label > </label> <button type="button" id="btnModalSendOrganizer" onclick="addOrganisateur()">Enregistrer</button></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>

  </div>
   </div>
  <div id="modallieu" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouveau lieu</h4>
      </div>
      <div class="modal-body">
    <p> <label >Libell&eacute; </label><input type="text" name="libLieu" id="libLieu"/></p>
    <p> <label >Latitude </label><input type="text" name="lat" id="lat"/> </p>
    <p> <label >Longitude </label><input type="text" name="lng" id="lng"/></p>
    
     <label > Ville </label>
     
      <select name="city"  class="" id="idcity">
        <?php foreach ((array)$cityList as $row): ?>
        <option value="<?=esc($row['idCity']);  ?>"><?=esc($row['name']);  ?></option>
        <?php endforeach; ?>
      </select>
      </br>  
 <label></label> <button type="button" class="" data-toggle="modal" data-target="#modalcity">Nouvelle ville</button></p>
     </br>
    <p><label > </label><button type="button" id="btnSendLieu" onclick="addLieu()">Enregistrer</button></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
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
        <h4 class="modal-title">Nouveau point de vente</h4>
      </div>
      <div class="modal-body">
    <p> <label >Nom du point de vente</label><input type="text" name="libpdv" id="libpdv"/></p>

    <!--p> <label >Place </label ><input type="text" name="libLieupdv" id="libLieupdv"/></p-->
    <p> <label >Longitude</label > <input type="text" name="lngpdv" id="lngpdv" placeholder="Longitude (47.123456)" /> </p>
    <p> <label >Latitude</label > <input type="text" name="latpdv" id="latpdv" placeholder="Latitude (-18.123456)"/> </p>
    
    <p><label > </label>  <button type="button" id="btnSendpdv" onclick="addPdv()">Enregistrer</button></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>
 </div>
  </div>
  
    <div id="modallieupdv" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouveau lieu</h4>
      </div>
      <div class="modal-body">
    <p> <label >Libell&eacute; </label ><input type="text" name="libLieupdv" id="libLieupdv"/></p>
    <p> <label >Longitude</label > <input type="text" name="lngpdv" id="lngpdv" placeholder="Longitude (47.123456)" /> </p>
    <p> <label >Latitude</label > <input type="text" name="latpdv" id="latpdv" placeholder="Latitude (-18.123456)" /> </p>
     <p> Ville 
     
      <select name="city"  class="form-control" id="idcityPdv">
        <?php foreach ((array)$cityList as $row): ?>
        <option value="<?=esc($row['idCity']);  ?>"><?=esc($row['name']);  ?></option>
        <?php endforeach; ?>
      </select>
      </p>
         <button type="button" class="" data-toggle="modal" data-target="#modalcity">Nouvelle ville</button>
             
    <p><button type="button" id="btnSendLieu" onclick="addLieuPdv()">Enregistrer</button></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>
 </div>
  </div>
  <div id="modalcity" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouvelle ville</h4>
      </div>
      <div class="modal-body">
    <p><label > Libell&eacute; </label ><input type="text" name="libcity" id="libcity"/></p>
    
    <p><button type="button" id="btnSendCity" onclick="addCity()">Enregistrer</button></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>
 </div>
  </div>
  <div id="modaltrf" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouveau tarif</h4>
      </div>
      <div class="modal-body">
    <p> <label >Libell&eacute; </label ><input type="text" name="libtrf" id="libtrf"/></p>
    <p> <label >Prix</label > <input type="number" name="pricevalue" id="pricevalue"/></p>
    
    <p><button type="button" id="btnSendCity" onclick="addTarif()">Enregistrer</button></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>
 </div>
  </div>
  
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

  <script>
  settingPrice();
    function settingPrice()
    {
       if($("#bann").is(":checked")){
          var nb = $("#nbJsupp").val();
		  var duree = $("#dureeJourAffichage").val();
		  
          var priceBanniere = 0;
          <?php if(!empty($printPrice->banniere)){ ?> 
            priceBanniere = <?php echo $printPrice->banniere;}?>;
          var coutUnJour = priceBanniere/7;
          var coutSupp = nb*coutUnJour;
		   var coutB = (coutUnJour*duree)+coutSupp;
          $("#containerPrice").html("Cout de l'affichage : "+coutB+" Ar ");
        }
        else{
          var nb = $("#nbJsupp").val(); 
          var duree = $("#dureeJourAffichage").val();
		  var priceNormale = 0;
          <?php if(!empty($printPrice->normal)){ ?> 
            priceNormale = <?php echo $printPrice->normal;}?>;
          var coutUnJour = priceNormale/7;
          var coutSupp = nb*coutUnJour;
          var coutN = (coutUnJour*duree)+coutSupp;
          $("#containerPrice").html("Cout de l'affichage :  "+coutN+" Ar ");
        }
    }

    $("#bann").click(function() {
        settingPrice();
    });

    $("#normale").click(function() {
        settingPrice();
      
    });
  var listeprcxt = ""+$("#listTarif").val();
  var listeprc = listeprcxt.split(',');
  var listprice =  new Array();
  //var idEventToUpdate = <?php echo $idE; ?>;
  //alert(<?php echo $idE; ?>);
  //console.log("iddd-----"+idEventToUpdate);
  $('#blocDateFin').hide();
	<?php if( isset( $idE )){
		echo "	$('#blocDateFin').show();";
	}?>
  
  
  if(listeprc.length>0){
    for(i=0;i<listeprc.length;i++){
      listprice.push(listeprc[i]);
    }
  }
  
  function griserTarif(){
    if($("#gratuit").is(":checked")){
      $("#sectionTarif").hide();
	  $("#sectionpdv").hide();
    }
else{
  $("#sectionTarif").show();
   $("#sectionpdv").show();
}
    
  }

  function addTarifList(){
if($("#libtarif").val() == ""){
      libelle = "indefini";
    }
    else {
      libelle = $("#libtarif").val();
    }
    value = $("#prixtarif").val();
    listprice.push(libelle+'__'+value);
    txtSelect="";
    for(i=1;i<listprice.length;i++){
        txtSelect = txtSelect+"<option value=\""+listprice[i]+"\" selected=\"true\">"+listprice[i]+"</option>";
    }
    $("#listTarif").html(txtSelect);
  }
   function dropTarifList(){
   $("#libtarif").val("");
   $("#prixtarif").val("");
    listprice.splice(0, listprice.length) ;
    $("#listTarif").html("");
  }
  
  function ajoutchamptarif(compteur){
    compteur = compteur + 1;
    lien = "<div class=\"form-group\"><label class=\"control-label col-md-3\">Tarif</label><button type=\"button\" onclick=\"ajoutchamptarif("+compteur+")\">Ajout nouveau</button></div>";
    corps = '';
    for(i=1;i<=compteur;i++){
      corps = corps+"<div class=\"form-group\"><label class=\"control-label col-md-3\"/><div class=\"col-md-2\">Libelle<input type=\"name\" name=\"pricelibelle"+i+"\" class=\"form-control\" id=\"contact-name\" data-rule=\"minlen:4\"data-msg=\"Please enter at least 4 chars\"/></div><div class=\"col-md-2\">Prix <input type=\"name\" name=\"pricevalue"+i+"\" class=\"form-control\" id=\"contact-name\" data-rule=\"minlen:4\" data-msg=\"Please enter at least 4 chars\" value=\"<?php echo "k"; ?>\"></div><button type=\"button\">-</button></div>";
    }
    $("#tarifid").html(lien+corps);
  }
  
  function addCity(){
    libelle = $("#libcity").val();
    if(libelle === null || libelle.trim() === '') {
      alert('Veuillez entrer le nom de la ville');
      return;
    }
    $.ajax({
       url : 'city_insert_post', // La ressource ciblée
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
       url : 'category_insert_post', // La ressource ciblée
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
  
  function addOrganisateur(){
  
    name = $("#modalOrganisateurName").val();
    email = $("#modalOrganisateurEmail").val();
    phone = $("#modalOrganisateurPhone").val();
    description = $("#modalOrganisateurDescription").val();
    adresse = $("#modalOrganisateurAdresse").val();
    login = $("#modalOrganisateurLogin").val();
    mdp = $("#modalOrganisateurMdp").val();
    if(name === null || name.trim() === '' || email === null || email.trim() === '' || phone === null || phone.trim() === ''
    || adresse === null || adresse.trim() === '' || login === null || login.trim() === '' 
    || mdp === null || mdp.trim() === ''){
      alert('Veuillez remplir le formulaire');
      return;
    }
    if(!validateEmail(email))
    {
      alert('Adresse email invalid');
      return;
    }
    
    $.ajax({
       url : 'organizer_save_post',
       dataType : 'json',
       type : 'POST', 
        data:{ name: name,email: email,phone: phone,description: description,adresse:adresse,login:login,mdp:mdp
      },success:function(data){
        listOrg = "";
        $.each(data, function(key, value) {
          console.log('name---'+value.name);
          if(value.name == name){
            listOrg = listOrg+"<option selected='true' value='"+value.idOrganizer+"'>"+value.name+"</option>";
          }
          else{
              listOrg = listOrg+"<option value='"+value.idOrganizer+"'>"+value.name+"</option>";
          }
        });
        $('#organizerId').html(listOrg);
         $("#modalOrganisateur").modal('hide');
      },
    });
  }
  
  function addLieu(){
    libelle = $("#libLieu").val();
    lat = $("#lat").val();
    lng = $("#lng").val();
    city = $('#idcity option:selected').val();
    if(libelle === null || libelle === '') {
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
       url : 'place_save_post', // La ressource ciblée
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
  
  function addLieuPdv(){
    libelle = $("#libLieupdv").val();
    lat = $("#latpdv").val();
    lng = $("#lngpdv").val();
    city = $('#idcityPdv option:selected').val();
    
    //alert(libelle+lat+lng+city);
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
       url : 'place_save_post', // La ressource ciblée
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
        $('#idplace').html(listPlace);
         $("#modallieupdv").modal('hide');
      },
    });
    
  }
  
  
  function addPdv(){
    pdvName = $("#libpdv").val();
    //place = $('#idplace option:selected').val();
    if(pdvName === null || pdvName.trim() === '') {
      alert('Veuillez entrer le nom du point de vente');
      return;
    }
    /*if(!place){
      alert('Veuillez sélectionner la place');
      return;
    }*/
   // libellePlace = $("#libLieupdv").val();
    lat = $("#latpdv").val();
    lng = $("#lngpdv").val();
    
   
    if(lat === null || lat.trim() === ''){
      alert('Veuillez entrer la latitude');
      return;
    }
    if(lng === null || lng.trim() === ''){
      alert('Veuillez entrer la longitude');
      return;
    }
   
    $.ajax({
       url : 'pdv_save_post', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ pdvName:pdvName,lat:lat,lng:lng
      },success:function(data){
        
        listPdv = " "
        $.each(data, function(key, value) {

          listPdv = listPdv + "<input type='checkbox' name='pdv_selected[]' id='pdv_selected' value='"+value.idPointOfSale+"'";
          if(value.name == pdvName){
            
            listPdv = listPdv+" checked ";
          }
          listPdv = listPdv+"> "+value.name + " <br>";

          
        });
        $('#container_pdv_check').html(listPdv);
        // $("#modalpdv").modal('hide');
         //refreshPlaceList(libellePlace);
		   $("#modalpdv").modal('hide');
     




      },
      
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }  



    });




      






    
  }
  
  function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

	function printEnd(){
		$('#blocDateFin').show();
	}
	
function isValidImage()
    {
    var checkedNum = $('input[name="pdv_selected[]"]:checked').length;
    var checkedgratuit = $('#gratuit').is(":checked");
    if (!checkedNum && !checkedgratuit) {
      // User didn't check any checkboxes
    alert("Veuillez séléctionner le point de vente");
    return false;
    }
      if($('#image').get(0).files.length ===0)
        {
          alert("Veuillez ajouter une photo!");
          return false;
        }
    
        return true;
     
    }

	
function isValidUpdate()
    {
    var checkedNum = $('input[name="pdv_selected[]"]:checked').length;
    var checkedgratuit = $('#gratuit').is(":checked");

    if (!checkedNum && !checkedgratuit) {
      // User didn't check any checkboxes
    alert("Veuillez séléctionner le point de vente");
    return false;
    }

    lastNbJsupp = '<?php echo $event->nbJourSupplementaire; ?>';
    newNbJsupp = $("#nbJsupp").val();
    if (newNbJsupp < lastNbJsupp) {
      // 
    alert("Le nombre de jour doit être superieur à " +lastNbJsupp);
    return false;
    }
        return true;
     
    }


year = '<?php echo $dtBegin[0] ;?>';
month = '<?php echo $dtBegin[1] ;?>';
day = '<?php echo $dtBegin[2] ;?>';

yearTo = '<?php echo $dtEnd[0] ;?>';
monthTo = '<?php echo $dtEnd[1] ;?>';
dayTo = '<?php echo $dtEnd[2] ;?>';

var from = year+"-"+(month)+"-"+(day) ;
$('#from').val(from);


to = yearTo+"-"+(monthTo)+"-"+(dayTo) ;
$('#to').val(to);

  </script>

</body>

</html>