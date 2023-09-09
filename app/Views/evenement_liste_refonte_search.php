<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>
<body style="background-color:#FAFAFA">
<style>
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
</style>
<?php include('menu.php'); $image = 'https://images.indianexpress.com/2020/06/online-classes.jpg'; ?>
    <link href="<?php echo base_url('assets/moment.min.js'); ?>" rel="apple-touch-icon">
 <div class="">
        <div class="row no-gutters"> 
            <div class="col-lg-8" style="margin:auto !important;float:none !important">
            <div class="row titleban" style="padding-left:3%;"> <h3><b>Evenements</b> <label id="count"> <?php echo ' ('. count($events).')'; ?></label></h3></div>
            <div class="row whitebackground"> 
                 <div class="row"> 
                    <div class="col-lg-6 col-xs-6 col-md-6 col-sm-6" style="display:flex"> 
					
                     
                    </div>		
                  
		               <div class="col-lg-4 col-sm-12 col-md-12 col-xs-12 text-right" style="float:right;">  <a href="<?php echo base_url("evenement/ajout");?>">      <button  class="btn vert-button"  style=";color:white;background-color:#4ECDC4 !important;color:white;width:100%"><span style="margin-top: 3px;
margin-left: 0px;background: transparent url('<?php echo base_url(); ?>/assets/img/ico-+.png') 0% 0% no-repeat padding-box;
opacity: 1;float:left;width:15px;height:15px"></span>Nouvel &eacute;venement</button></a> </div>  
                </div> 
			
                <div id="filterContainer"  class="row" style="padding-left:3%;padding-right:0px; display:none" > 
                     <hr/> 
					<form class="form-inline">
                    <div class="form-group">
                        <label for="status">Status </label>
                        <!--input type="select" class="form-control"  style="width: 50% !important" id="status"!-->
							<select name="status"  class="form-control" id="status" style="width: 40% !important">
								<option value="-1">Tous</option>
								<option value="1">Publi&eacute;</option>
								<!--option value="6">En attente publication</option-->
								<option value="0">En attente</option>
								<option value="3">Brouillon</option>
								<option value="4">Rejet&eacute;</option>
								<option value="5">Non publi&eacute;</option>
							</select>
                    </div>
                    <div class="form-group">
                        <label for="cat">Cat&eacute;gories </label>
                        <!--input type="select" class="form-control"  style="width: 50% !important" id="cat" placeholder=""!-->
						<select name="category"  class="form-control" id="category" style="width: 40% !important">
							<option value="-1">Tous</option>
							<?php foreach ((array)$categoryList as $row): ?>
							  <option value="<?=esc($row['idCategory']);  ?>"><?=esc($row['name']);  ?></option>
							<?php endforeach; ?>
						</select>
                    </div>
					<?php $session = \Config\Services::session(); 
						if($_SESSION['userType'] == "admin"){?>
					<div class="form-group">
                        <label for="cat">Organisateur</label>
                        <!--input type="select" class="form-control"  style="width: 50% !important" id="cat" placeholder=""!-->
						<select name="organizer"  class="form-control" id="organizer" style="width: 40% !important">
							<option value="-1">Tous</option>
							<?php foreach ((array)$organizerList as $row): ?>
							   <option value="<?php echo $row->idOrganizer;  ?>"><?php echo $row->name;  ?></option>
							<?php endforeach; ?>
						</select>
                    </div>
						<?php }?>
                    <div class="form-group" style="float:right;line-height: 40px; vertical-align:middle;"> <a href="" style="color:grey !important;padding-right:10px">R&eacute;initialiser</a> </div> 
                </form></div> 
					 <div id="filterSubmitToValidate"  class="row form-inline" style="padding-left:3%;padding-right:0px; display:none" > 
                     <hr/> 
					 <div class="form-group">
					 <?php $session = \Config\Services::session(); 
						if($_SESSION['userType'] == "admin"){?>
							<button id="" onclick="validateEvent()" class="vert-button btn text-center"><span style="background-color:#4ECDC4 !important;margin-top:3px;margin-right:5px;float:left;"></span> Valider</button> 
						<?php }?>
					 <div class="form-group">
					 </div> 
<button id="" class="btn text-center" onclick="deleteSelected()"><span style="margin-top:3px;margin-right:5px;float:left;"></span> Supprimer</button>
</div> 
  <!--div class="form-group" style="float:right;line-height: 40px; vertical-align:middle;"> <a href="#" onclick="resetCheckbox()" style="color:grey !important;padding-right:10px">Annuler la s&eacute;lection</a> </div--> 
         
				</div> 
				 <div id="filterSubmitToDel"  class="row form-inline" style="padding-left:3%;padding-right:0px; display:none" > 
                     <hr/> 
				 <div class="form-group">
					
<button id="" onclick="deleteSelected()" class="btn text-center"><span style="margin-top:3px;margin-right:5px;float:left;"></span> Supprimer</button>
</div> 
  <!--div class="form-group" style="float:right;line-height: 40px; vertical-align:middle;"> <a href="" style="color:grey !important;padding-right:10px">Annuler la s&eacute;lection</a> </div--> 
         
				</div> 
                <br/> 
                <div style="overflow-y: scroll; height:350px; width: auto;">  
                        <table class="table" id="tableContainer"> 
                                <tr>
                                 	<th scope="col" >Nom </th> 
                                    <th scope="col" >Date & heures </th>
                                    <th scope="col" >Lieu </th> 
                                    <th scope="col" >Cat&eacute;gorie </th>  
									 <th scope="col" >Organisateur </th>  
                                    <th scope="col" >Statut </th>  
                                </tr>  
                                <?php $ind = 0; foreach ($events as $row): 
                                  ?> 
                                 <tr onclick="infoEvent(<?php echo $row['idEvent'];?> )">
                                    <td><?= $row['name'];  ?> </td> 
                                    <td><?php 
                     $dateToformatBegin = explode(' ',$row['dateBegin'])[0];
                     $dateToformatEnd = explode(' ',$row['dateEnd'])[0];
                    $dateformatedBegin = explode('-',$dateToformatBegin);
                    $dateformatedEnd = explode('-',$dateToformatEnd);
                    $datebeginning = $dateformatedBegin[2].'/'.$dateformatedBegin[1].'/'.$dateformatedBegin[0];
                    $dateending = $dateformatedEnd[2].'/'.$dateformatedEnd[1].'/'.$dateformatedEnd[0];
                    $heurebeginning = explode(':',explode(' ',$row['dateBegin'])[1])[0].':'.explode(':',explode(' ',$row['dateBegin'])[1])[1];
                    $heureending = explode(':',explode(' ',$row['dateEnd'])[1])[0].':'.explode(':',explode(' ',$row['dateEnd'])[1])[1];
                    echo $datebeginning;
                    if($datebeginning ==  $dateending){
                        echo '<p style="font-size:12px !important"> de '.$heurebeginning.' à '.$heureending .'</p>'; 
                     }
                     else{
                        echo ' <p style="font-size:12px !important"> de '.$heurebeginning.' au '.$dateending.' '.$heureending .'</p>'; 
                     }
                   
                       if($row['isValidated'] == 0) $statut = 'En attente de validation';
					 $h = "3";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
						$hm = $h * 60;
						$ms = $hm * 60;
						$dateAuj = gmdate("Y-m-d H:i:s",time()+($ms));
					  if($row['isValidated'] == 1){
						   if(new DateTime($dateAuj) < new DateTime(explode(' ',$row['dateDebutAffichage'])[0]))
						   $statut = 'En attente de publication';
						   else $statut = 'Publi&eacute;';
					   }
					    $dateB = new DateTime(explode(' ',$row['dateDebutAffichage'])[0]);
                      $dateB->add(new DateInterval('P'.$row['dureeAffichage'].'DT23H59M'));
                     
                       if($row['isValidated'] == 3) $statut = 'Brouillon';
                       if($row['isValidated'] == 4) $statut = 'Rejet&eacute;';
                       if(new DateTime(explode(' ',$dateAuj)[0]) >  new DateTime(explode(' ',$row['dateEnd'])[0]) )
                        {
                          $statut = 'Pass&eacute;';
                        } 
						if(new DateTime($dateAuj) > $dateB){
						  $statut = 'Non publi&eacute;';
						}
                    
                    
                       ?></td>
                                    <td><?= $row['placeName'];  echo ' <p style="font-size:12px !important">'.$row['nameCity'].'</p>';  ?> </td> 
                                    <td><?= $row['nameCategory'];  ?>  </td>  
                                     <td><?= $row['nameOrganizer'];  ?>  </td>  
                                    <td> <?php echo $statut;?></td>  
                                </tr>
                                <?php $ind++; endforeach; ?>
                            </table> 
                            </div>            
            </div>
            </div> 
        

        </div>



    </div>
<footer>
</footer>

<div id="modallieu" class="modal fade" role="dialog">
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

  
  <div id="modalpdv" class="modal">
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
  <!--common script for all pages-->
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
 var arrayToValidate= new Array();
  var arrayToDel= new Array();
	
  function showmodal(info,typeUser)
  {
	if(typeUser == "admin"){
		myArr = info.split(',');
		$('#modalpdv').modal({
			show: 'true'
		}); 
		$('#modalpdv').find('input[name="idpos"]').val(myArr[1]);
		$('#modalpdv').find('input[name="libpdv"]').val(myArr[0]);
		$('#modalpdv').find('input[name="latpos"]').val(myArr[2]);
		$('#modalpdv').find('input[name="lngpos"]').val(myArr[3]);
		if($('#modalpdv').find('input[name="idpos"]').val().trim()!== '') {
		  $('#modalpdv').find('#title').text("Mettre à jour");
		  $('#modalpdv').find('#titleModal').text("Info point de vente");
		  }
	}
  }
 function infoEvent(id)
   {
      location.href="<?php echo base_url('evenement/info');?>?iE="+id;
   }
  function showmodalllllll()
  {
   $('#modalpdv').modal({
        show: 'true'
    });
    $('#modalpdv').find('#title').text("Mettre à jour");
      $('#modalpdv').find('#titleModal').text("Info point de vente");
   

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

    if($("#idpos").val().trim() !== ''){
      
      var idpos = $("#idpos").val();
      $.ajax({
       url : 'pos/update', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ pdvName:pdvName,lat:lat,lng:lng,id:idpos
      },success:function(data){
		      $("#modalpdv").modal('hide');
          location.href = "<?php echo base_url('evenement-list-refonte');?>";
     
      },
      
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
    });
    }
    else{
      $.ajax({
       url : 'pos/save', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ pdvName:pdvName,lat:lat,lng:lng
      },success:function(data){
		      $("#modalpdv").modal('hide');
          location.href = "<?php echo base_url('evenement-list-refonte');?>";
     
      },
      
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
    });
    }
  }
 

   $( "#search-button-event" ).click(function() {
	 searchVal = $( "#search-input" ).val().trim();
	 if(searchVal.length >1)
     {
      $.ajax({
       url : '<?php echo base_url();?>/event-search-multi', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ textToFind:searchVal
      },success:function(data){
		  $('#tableContainer').html('');
        $('#tableContainer').append('<tr><th scope="col" >Nom </th><th scope="col" >Date & heures </th> <th scope="col" >Lieu </th> <th scope="col" >Cat&eacute;gorie </th><th scope="col" >Statut </th> </tr>  ');
     
        $.each(data, function(k, v) {
			var date = new Date(v.dateBegin); 
			var datedeb = new Date(v.dateBegin); 
			var debutAffichage =  new Date(v.dateDebutAffichage);
			var debutA =  new Date(v.dateDebutAffichage);
			var duree = parseInt(v.dureeAffichage);
			date.setDate(date.getDate() + duree); 
			dateFin = new Date(v.dateEnd);
            dateAuj = new Date();
			dateFinAffichage = debutAffichage;
			dateFinAffichage.setDate(dateFinAffichage.getDate() + duree); 
			dateFinAffichage.setHours(23);
			dateFinAffichage.setMinutes(59);
			if(v.isValidated == 1){
			   if(dateAuj < debutA){
			   statut = 'En attente de publication';
			   }
			   else statut = 'Publi&eacute;';
			}
			if(v.isValidated == 3) statut = 'Brouillon';
			if(v.isValidated == 4) statut = 'Rejet&eacute;';
			if(v.isValidated == 0) statut = 'En attente de validation';
			if(dateAuj > dateFinAffichage){
				    statut = 'Non publi&eacute;';
            }
			if(dateAuj > dateFin )
			{
				statut = 'Pass&eacute;';
			}
			datedebutEvent = addZeroBefore((new Date(v.dateBegin)).getDate())+'/'+ (datedeb.getMonth()+1)+'/'+datedeb.getFullYear();
			datefinEvent = addZeroBefore(dateFin.getDate())+'/'+ addZeroBefore((dateFin.getMonth()+1))+'/'+dateFin.getFullYear();
			heuredeb = addZeroBefore(datedeb.getHours())+':'+ addZeroBefore(dateFin.getMinutes());
			heurefin = addZeroBefore(dateFin.getHours())+':'+ addZeroBefore(dateFin.getMinutes());
			
			if(datedebutEvent ==  dateFin){
                        dateAffiche=  '<p> de '+heuredeb+' à '+heurefin+'</p>'; 
                     }
                     else{
                        dateAffiche= ' <p> de '+heuredeb+' au '+datefinEvent+' '+heurefin+'</p>'; 
                     }
			str = '<tr onclick="infoEvent('+v.idEvent+')">';
            str+= '<td>'+v.name+'</td>';
            str+= '<td>'+datedebutEvent+' '+dateAffiche+'</td>';
            str+= '<td>'+v.namePlace+'<p>'+v.nameCity+'</p></td>';
            str+= '<td>'+v.nameCategorie+'</td>';
			str+= '<td>'+statut+'</td>';
            str+= '</tr>';
           
            $('#tableContainer').append(str);
        });
     
      },
      
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
      //  alert("Status: " + textStatus +" Error: " + errorThrown); 
      } 
    });
     }});

     $( "#search-button-pos" ).click(function() {
           $searchPosVal = $( "#search-input-pos" ).val().trim();
     
     if($searchPosVal.length >1)
     {
      
      $.ajax({
       url : 'pos/search', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ textToFind:$searchPosVal
      },success:function(data){
        
        $('#POSContainer').html('');
        $.each(data, function(k, v) {
          
          $('#POSContainer').append('<div id="resultC"></div>');
          $("<div/>").addClass('heading')
          .insertBefore('#resultC')
            .text(v.name).on("click", function(event){
             //Your code  
             $strParams = v.name+','+v.idPointOfSale+','+v.lat+','+v.lng;
              //console.log($strParams);
              showmodal($strParams,<?php echo $_SESSION['userType'];?>);
            });
            $("<hr/> ").insertBefore('#resultC');
        
        });
     
      },
      
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
    });
     }});
    function addZeroBefore(n) {
	  return (n < 10 ? '0' : '') + n;
	}
	$visibilityFilter = 0;
	$( "#btnFilter" ).click(function() {
		
		if($visibilityFilter == 0)
		{
			$visibilityFilter = 1;
			 $("#filterContainer").css("display", "block");
			 compteur = 0;
			$("input[name='selection']").each(function() {
				if(this.checked) compteur = 1;
			});
			if(compteur == 0)
			{
				$("#filterSubmitToDel").css("display", "none");
				$("#filterSubmitToValidate").css("display", "none");
			}
		}
		else
		{
			$visibilityFilter = 0;
			 $("#filterContainer").css("display", "none");
			 
			 
		}
	});
	
	$('#status').on('change', function() {
		onFilterChange();
	});
	$('#category').on('change', function() {
		onFilterChange();
	});
	$('#organizer').on('change', function() {
		onFilterChange();
	});
	
	function onFilterChange()
	{
		$("#filterSubmitToDel").css("display", "none");
		$("#filterSubmitToValidate").css("display", "none");
		
	 status = $( "#status" ).val();
	 category = $( "#category" ).val();
	 organizer = $( "#organizer" ).val();
	 if(organizer == undefined)
	 {
		 organizer = -2;
	 }
	 //alert(searchVal +" "+status+" "+category+" "+organizer); return;
	 if($visibilityFilter == 1)
     {
      $.ajax({
       url : '<?php echo base_url();?>/event-filter', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ status:status,category:category,organizer:organizer,
      },success:function(data){
			console.log(data);
		  $('#tableContainer').html('');
		strtoapp=   '<tr>';
		if(organizer == '-1' && category == '-1' ){
			strtoapp+=   '<th scope="col"><input id="selection" onclick="seleAll('+$("#status").val()+')" type="checkbox" name="selAll" value="all"/></th>';
		}
		else strtoapp+= '<th scope="col"></th>';
        strtoapp+='<th scope="col" >Nom </th><th scope="col" >Date & heures </th> <th scope="col" >Lieu </th> <th scope="col" >Cat&eacute;gorie </th><th scope="col" >Statut </th> </tr>';
		
		 $('#tableContainer').append(strtoapp);
        $.each(data, function(k, v) {
			var date = new Date(v.dateBegin); 
			var datedeb = new Date(v.dateBegin); 
			var debutAffichage =  new Date(v.dateDebutAffichage);
			var duree = parseInt(v.dureeAffichage);
			date.setDate(date.getDate() + duree); 
			dateFin = new Date(v.dateEnd);
            dateAuj = new Date();
			
			if(v.isValidated == 1){
				if(dateAuj < debutAffichage) statut = 'En attente de publication';
				else statut = 'Publi&eacute;';
			} 
			if(v.isValidated == 3) statut = 'Brouillon';
			if(v.isValidated == 4) statut = 'Rejet&eacute;';
			if(v.isValidated == 0) statut = 'En attente de validation';
			dateFinAffichage = debutAffichage;
			dateFinAffichage.setDate(dateFinAffichage.getDate() + duree); 
			dateFinAffichage.setHours(23);
			dateFinAffichage.setMinutes(59);
			
			if(dateAuj > dateFinAffichage){
				    statut = 'Non publi&eacute;';
            }
			if(dateAuj > dateFin )
			{
				statut = 'Pass&eacute;';
			}
			datedebutEvent = addZeroBefore((new Date(v.dateBegin)).getDate())+'/'+ addZeroBefore(datedeb.getMonth()+1)+'/'+datedeb.getFullYear();
			datefinEvent = addZeroBefore(dateFin.getDate())+'/'+ addZeroBefore(dateFin.getMonth()+1)+'/'+dateFin.getFullYear();
			heuredeb = addZeroBefore(datedeb.getHours())+':'+ addZeroBefore(dateFin.getMinutes());
			heurefin = addZeroBefore(dateFin.getHours())+':'+ addZeroBefore(dateFin.getMinutes());
			
			if(datedebutEvent ==  dateFin){
                        dateAffiche=  '<p> de '+heuredeb+' à '+heurefin+'</p>'; 
                     }
                     else{
                        dateAffiche= ' <p> de '+heuredeb+' au '+datefinEvent+' '+heurefin+'</p>'; 
                     }
			str = '<tr>';
            str+= '<td> <input id="chk'+v.idEvent+'" type="checkbox" onclick="sele('+$("#status").val()+','+v.idEvent+')" name="selection" value="'+statut+':'+v.idEvent+'"/> <label for="chk'+v.idEvent+'"></label></td>';
			str+= '<td onclick="infoEvent('+v.idEvent+')">'+v.name+'</td>';
            str+= '<td onclick="infoEvent('+v.idEvent+')">'+datedebutEvent+' '+dateAffiche+'</td>';
            str+= '<td onclick="infoEvent('+v.idEvent+')">'+v.namePlace+'<p>'+v.nameCity+'</p></td>';
            str+= '<td onclick="infoEvent('+v.idEvent+')">'+v.nameCategorie+'</td>';
			str+= '<td onclick="infoEvent('+v.idEvent+')">'+statut+'</td>';
            str+= '</tr>';
			/*if($('#status').val() == 0 && statut != 'En attente de validation'){
			   return;
			}*/
            $('#tableContainer').append(str);
		//	if(statut == 'En attente de validation') $('#filterSubmitToValidate').css('display:block');
			
        });
     
      },
      
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
      //  alert("Status: " + textStatus +" Error: " + errorThrown); 
      } 
    });
     }
	}
	
	function sele(statut,valu)
	{
		arrayToDel = new Array();
		arrayToValidate = new Array();
		compteur = 0; 
		category = $( "#category" ).val();
		organizer = $( "#organizer" ).val();
		status = $( "#status" ).val();
		if(category != '-1' || organizer != '-1' || (category == '-1' && organizer == '-1' && status == '-1')){
				$("input[name='selection']").each(function() {
					if(this.value.split(":")[1] != valu) this.checked = false;
					 if(this.checked) arrayToDel.push(this.value.split(":")[1]);
					 if(this.checked && this.value.split(":")[0] == 'En attente de validation'){
						$('#filterSubmitToValidate').css('display','block');
						$('#filterSubmitToDel').css('display','none');
						 arrayToValidate.push(this.value.split(":")[1]);
						return false;
					}
					else{
						$('#filterSubmitToDel').css('display','block');
						$('#filterSubmitToValidate').css('display','none');
					}	
					
					if(this.checked)compteur++;
				});
		}
		else{
			$("input[name='selection']").each(function() {
				
				if(this.checked && this.value.split(":")[0] == 'En attente de validation'){
				 arrayToValidate.push(this.value.split(":")[1]);
				}
				if(this.checked)arrayToDel.push(this.value.split(":")[1]);
				if(statut==0) $('#filterSubmitToValidate').css('display','block');
				else $('#filterSubmitToDel').css('display','block');
				if(this.checked)compteur++;
				//else this.checked = false;
				//console.log( this.value + ":" + this.checked );
			});
			if(compteur ==0)
			{
				$('#filterSubmitToValidate').css('display','none');
				$('#filterSubmitToDel').css('display','none');
			}
		}
	}
	function seleAll(statut)
	{
		if($("input[name='selAll']")[0].checked) 
		{
			$("input[name='selAll']").checked = true;
			if(statut==0) {
				$('#filterSubmitToValidate').css('display','block');
				$('#filterSubmitToDel').css('display','none');
			}
			else
			{	$('#filterSubmitToDel').css('display','block');
				$('#filterSubmitToValidate').css('display','none');
			}
			$("input[name='selection']").each(function() {
				this.checked = true;
			});
		}
		else {
			$("input[name='selAll']").checked=false;
			$('#filterSubmitToValidate').css('display','none');
			$('#filterSubmitToDel').css('display','none');
			$("input[name='selection']").each(function() {
				this.checked = false;
			});
		}
		
	}
	function validateEvent()
	{
		  $.ajax({
		   url : 'event/validate', // La ressource ciblée
		   dataType : 'json',
		   type : 'POST', // Le type de la requête HTTP.
			data:{ listEvent:arrayToValidate
		  },success:function(data){
			 location.href = "<?php echo base_url('evenement-list-refonte');?>";
		  },
		  
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
			//alert("Status: " + textStatus); alert("Error: " + errorThrown); 
		  } 
		});
	}
	function deleteSelected()
	{
		$.ajax({
		   url : 'event/delete/list', // La ressource ciblée
		   dataType : 'json',
		   type : 'POST', // Le type de la requête HTTP.
			data:{ listEvent:arrayToDel
		  },success:function(data){
			  console.log(data);
			 location.href = "<?php echo base_url('evenement-list-refonte');?>";
		  },
		  
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log("echec");
			//alert("Status: " + textStatus); alert("Error: " + errorThrown); 
		  } 
		});
	}
	function resetCheckbox()
	{
		$("input[name='selection']").each(function() {
				this.checked = false;
			});
		$('#filterSubmitToValidate').css('display','none');
		$('#filterSubmitToDel').css('display','none');
		$("input[name='selAll']").checked=false;
				
	}
 </script>

</body>
 
</html>
