<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>
<body style="background-color:#FAFAFA">
<?php include('menu.php'); $image = 'https://images.indianexpress.com/2020/06/online-classes.jpg'; ?>
    <div class="container">
           <div class="col-lg-10 col-sm-10 col-md-10 block-center"  style="margin:auto !important;float:none !important " >
           <div class="row titleban">
                  <div class="col-lg-6 col-md-6 col-sm-6">
                     <h3><b>Gestion </b></h3>
                 </div>
				<div class="col-lg-2 col-md-2 col-sm-2 text-right">  <h3><a  class="onglet" href="<?php echo base_url('gestion/cout'); ?>">Cout publication</a> </h3></div>
				<div class="col-lg-2 col-md-2 col-sm-2 text-right"> <h3><a  class="onglet" href="<?php echo base_url('gestion/categorie'); ?>">Cat&eacute;gories</a></h3></div>
				<div class="col-lg-2 col-md-2 col-sm-2 text-right"> <h3><a style="color:#47AF9E !important;font-weight: bold !important" class="onglet" href="<?php echo base_url('gestion/lieu'); ?>">Lieu</a></h3></div>     
            </div>
            <div class="row whitebackground"> 
                 <div class="row"> 
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12"> 
                         <div class="row" style="display:flex"> 
                            <div class="col-lg-8  col-xs-10 col-sm-10 col-md-10" style="padding-right:0px"> 
                                <div class="inputsearch">
                                    <input class="form-control" id="search-input-lieu" name="search" placeholder="Rechercher un évènement"/> 
                                </div>
                            </div>
                            <div class="col-lg-2  col-xs-2 col-sm-2 col-md-2" style="padding-left:0px"> 
                                <button class="btn radiusnone" id="search-button-lieu" type="submit" style="border-radius:4px !important;background-color:#4ECDC4 !important;color:white" >
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 text-right" style="float:right;">  
                          <button  class="btn vert-button" data-toggle="modal" data-target="#modallieu"  style=";color:white;background-color:#4ECDC4 !important;color:white;width:100%"><span style="margin-top: 3px;
margin-left: 10px;background: transparent url('<?php echo base_url(); ?>/assets/img/ico-+.png') 0% 0% no-repeat padding-box;
opacity: 1;float:left;width:15px;height:15px"></span>Nouveau lieu</button> </div> 
           <!-- Button trigger modal -->
     </div> 
                
                <br/> 
                <div class="row"  style="margin-right:0px;overflow-y: scroll; height:350px; width: auto;padding-right:10px;padding-left:10px"> 
                    <div class="col-lg-12 block-center table-responsive" style="border: 0px !important"> 
                    <?php if (! empty($placeList) && is_array($placeList)) : ?> 
                        <table class="table" id="lieuContainer"> 
                                <tr>
                                    <th scope="col" >Localit&eacute; </th> 
                                    <th scope="col" >Ville </th>
                                    <th scope="col" >Longitude </th> 
                                    <th scope="col" >Latitude </th> 
                                    <th scope="col" >Action </th> 
                                </tr>  
                                <?php foreach ($placeList as $row): ?>
                                <tr>
                                    <td> <?=esc($row->name); ?></td> 
                                    <td><?php echo $row->nameCity; ?></td>
                                    <td><?php echo $row->lng; ?></td> 
                                    <td><?php echo $row->lat; ?></td> 
                                    <td> <button style="background-color:#FAFAFA; border:none"  class="btnhove" data-toggle="modal" data-target="#modallieu" data-name="<?=$row->name;?>" data-idcity="<?=$row->idCity;?>" data-lat="<?=$row->lat;?>" data-lng="<?=$row->lng;?>" data-id="<?=$row->idPlace;?>"><i class="glyphicon-edit glyphicon" style="color:#4F4E4E;"></i></button><!--/a-->
                                        <button style="background-color:#FAFAFA; border:none"  class="btnhove" onclick="return deletePlace(<?=$row->idPlace;?>);"><i class="glyphicon glyphicon-trash" style="color:#4F4E4E;"></i></button>
                                    </td>  
                                </tr>  
                                <?php endforeach; ?>
                            </table> 
                            <?php else : ?> 
                            <h4>Aucun lieu enregistr&eacute;</h4> 
                            <?php endif ?> 
                            </div>      
                    </div>            
           
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
                <input class="form-control"  style="width:100% !important"  type="text" name="libLieu" value="<?php echo $libelle;?>" id="libLieu"/></div>
				
		 <div class="media"> 
			<div class="media-body" style=""> 
				<label >Latitude </label><input type="text"  style="width:100% !important" placeholder="Ex: -18.000000" class="form-control"name="lat" value="<?php echo $lat;?>" id="lat"/>
			</div> 
			<div class="media-body" style="padding-left:2% !important"> 
				<label >Longitude </label><input  class="form-control" style="width:100% !important"  placeholder="Ex: 47.000000"  type="text" name="lng" value="<?php echo $lng;?>" id="lng"/>
			</div>
		</div>	
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
 

<footer>
</footer>

<!-- SCRIPTS -->
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
function deletePlace(idPlace){
       res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =  "place_delete?idPlace="+idPlace;
          document.location.href = url; 
          return true;
        }
       else{
         return false;
       }
      }
	  

$("#test").click(function() {
    
    $('#modallieu').modal('show')
    
    });

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
   if($("#idPlace").val().trim() !== ''){
        var idPlace = $("#idPlace").val();
        $.ajax({
            url : 'place_update_post', // La ressource ciblée
            dataType : 'json',
            type : 'POST', // Le type de la requête HTTP.
                data:{ libelle:libelle,lat:lat,lng:lng,city:city,idPlace:idPlace
            },success:function(data){
                $("#modallieu").modal('hide');
                location.href = "<?php echo base_url('gestion/lieu');?>";
            },
        });
   }
   else{
        $.ajax({
        url : 'place_save_post', // La ressource ciblée
        dataType : 'json',
        type : 'POST', // Le type de la requête HTTP.
            data:{ libelle:libelle,lat:lat,lng:lng,city:city
        },success:function(data){
            $("#modallieu").modal('hide');
            location.href = "<?php echo base_url('gestion/lieu');?>";
        },
        });
   }
    
  }
  
  $('#modallieu').on('show.bs.modal', function(e) {


//get data-id attribute of the clicked element
var name = $(e.relatedTarget).data('name');
var id = $(e.relatedTarget).data('id');

var lat = $(e.relatedTarget).data('lat');
var lng = $(e.relatedTarget).data('lng');

var idCity = $(e.relatedTarget).data('idcity');
//alert("test-----" +nameCity);

//populate the textbox
$('#modallieu').find('input[name="idPlace"]').val(id);
$('#modallieu').find('input[name="libLieu"]').val(name);
$('#modallieu').find('input[name="lat"]').val(lat);
$('#modallieu').find('input[name="lng"]').val(lng);
$('#modallieu option[value="'+idCity+'"]').prop('selected', true);
if($('#modallieu').find('input[name="idPlace"]').val().trim()!== '') $('#modallieu').find('#title').text("Editer lieu");
});


$( "#search-button-lieu" ).click(function() {
           $searchLieuVal = $( "#search-input-lieu" ).val().trim();
     
     if($searchLieuVal.length >1)
     {
      
      $.ajax({
       url : 'lieu/search', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ textToFind:$searchLieuVal
      },success:function(data){
        console.log(data);
        $('#lieuContainer').html('');
        $('#lieuContainer').append('<tr> <th scope="col" >Nom & Pr&eacute;nom </th> <th scope="col" >Contact </th> <th scope="col" >E-mail </th>   <th scope="col" >Action </th>   </tr>');
        
        $.each(data, function(k, v) {
            str = "<tr>";
            str+= '<td>'+v.name+'</td>';
            str+= '<td> ville </td>';
            str+= '<td>'+v.lng+'</td>';
            str+= '<td>'+v.lat+'</td>';
            str+='<td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modallieu" data-name="'+v.name+'" data-idcity="'+v.idCity+'" data-lat="'+v.lat+'" data-lng="'+v.lng+'" data-id="'+v.idPlace+'"><i class="fa fa-pencil"></i></button><!--/a--><button class="btn btn-danger btn-xs" onclick="return deletePlace('+v.idPlace+')"><i class="fa fa-trash-o "></i></button></td>';
            str+= '</tr>';
           
            $('#lieuContainer').append(str);
        });
      
     
      },
      
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
    });
     }});
	 $( "button.btnhove" ).mouseover(function() {
	  $( this ).css('background-color','#E0E0E0');
	});
	
	$( "button.btnhove").mouseout(function() { 
		$( this ).css('background-color','#FAFAFA');
	});
		
 </script>

</body>
 
</html>
