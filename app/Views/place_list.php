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
        <h4><i class="fa fa-angle-right"></i> Lieu</h4>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <h4 class="title"><?php if (!empty($place)) echo ' Mise à jour lieu'; else echo ' Nouveau'; ?></h4>
            <div id="message"></div>
            <?php $validation =  \Config\Services::validation(); ?>
            <?= $validation->listErrors() ?>
            <form class="contact-form" role="form" action="<?php if (!empty($place)) {
              echo base_url('placeUpdateValidate'); 
              $name = $place->name; $idCity = $place->idCity;  $lng = $place->lng;$lat = $place->lat;$idP=$place->idPlace;
            }else echo base_url('place_save'); ?>" method="POST">

              <div class="form-group">
                <input type="hidden" name="id" value="<?=esc($idP);  ?>"/>
                <input type="name" name="name" class="form-control" id="contact-name" placeholder="Libelle du lieu" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $name; ?>">
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <input type="name" name="lng" class="form-control" id="contact-name" placeholder="Longitude (47.123456)" data-rule="minlen:1" data-msg="Please enter a number" value="<?php echo $lng; ?>">
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <input type="name" name="lat" class="form-control" id="contact-name" placeholder="Latitude (-18.123456)" data-rule="minlen:1" data-msg="Please enter a number" value="<?php echo $lat; ?>">
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <select name="city" multiple class="form-control" id="idCity">
                  <?php foreach ((array)$cityList as $row): ?>
                  <option <?php if(!empty($idCity) && $idCity==$row['idCity']) echo "selected=\'true\'"; ?> value="<?=esc($row['idCity']);  ?>"><?=esc($row['name']);  ?></option>

                  
                  <?php endforeach; ?>
                </select> </br>
				 <button type="button" class="" data-toggle="modal" data-target="#modalcity">Nouvelle ville</button>
             
            </div>
              <div class="loading"></div>
              <div class="error-message"></div>
              <div class="sent-message"></div>
			    </br>
				<div class="col-md-1"><div class="form-send">
                <button type="submit" class="btn btn-large btn-primary">Enregistrer</button>
              </div></div>
			
            </form>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6">
            <h4 class="title">Liste</h4>
           <div class="content-panel">
      <?php if (! empty($placeList) && is_array($placeList)) : ?> 
              <table class="display table table-striped table-advance table-hover" id="hidden-table-info">
                <thead>
                  <tr>
                    <th><i class="fa"></i> Localite</th>
					 <th><i class="fa"></i> Ville</th>
                   <th><i class="fa"></i> Longitude</th>
                   <th><i class="fa"></i> Latitude</th>
                    <!--th><i class="fa fa-bookmark"></i> Profit</th>
                    <th><i class=" fa fa-edit"></i> Status</th-->
                    <th></th>
                  </tr>
                </thead>
                <tbody>
        <?php foreach ($placeList as $row): ?>
                  <tr>
                    <td>
                      <?=esc($row->name); ?>
                    </td>
                     <td class="hidden-phone"><?php echo $row->nameCity; ?></td>
                     <td class="hidden-phone"><?php echo $row->lng; ?></td>
                    <td class="hidden-phone"><?php echo $row->lat; ?></td>
					  <!--td>12000.00$ </td>
                    <td><span class="label label-info label-mini">Due</span></td-->
                    <td>
                     <a href="<?php echo base_url('place_update?id='.$row->idPlace."'"); ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                      <button class="btn btn-danger btn-xs" onclick="return deletePlace(<?=$row->idPlace;?>);"><i class="fa fa-trash-o "></i></button>
                    </td>
                  </tr>
                 <?php endforeach; ?>
                </tbody>
              </table>
        <?php else : ?> 
          <h4>Aucun lieu enregistr&eacute;</h4> 
        <?php endif ?> 
            </div>
            <!-- contact_details -->
          </div>
        </div>
        <!-- /row -->


        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
  </section>
   
    <!--footer end-->
    <!--footer end-->
	<div id="modalcity" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouvelle ville</h4>
      </div>
      <div class="modal-body">
		<p> Libell&eacute; <input type="text" name="libcity" id="libcity"/></p>
		
		<p><button type="button" id="btnSendCity" onclick="addCity()">Enregistrer</button></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>
 </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/jquery.js'); ?>"></script>
<!--custom switch-->
  <script src="<?php echo base_url('assets/lib/bootstrap-switch.js'); ?>"></script>
  <!--custom tagsinput-->
  <script src="<?php echo base_url('assets/lib/jquery.tagsinput.js'); ?>"></script>
 <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/jquery.dataTables.js'); ?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/DT_bootstrap.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script class="include" type="text/javascript" src="<?php echo base_url('assets/lib/jquery.dcjqaccordion.2.7.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.scrollTo.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.nicescroll.js'); ?>" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="<?php echo base_url('assets/lib/common-scripts.js'); ?>"></script>
  <!--script for this page-->
  <script src="<?php echo base_url('assets/lib/jquery-ui-1.9.2.custom.min.js'); ?>"></script>
  
  
   
  <!--Contactform Validation-->
  <script src="<?php echo base_url('assets/lib/php-mail-form/validate.js'); ?>"></script>
  <script type="text/javascript">
	
	function addCity(){
		libelle = $("#libcity").val();
		$.ajax({
		   url : 'city_insert_post', // La ressource ciblée
		   dataType : 'json',
		   type : 'POST', // Le type de la requête HTTP.
		    data:{ libelle:libelle
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
				$('#idCity').html(listPlace);
				 $("#modalcity").modal('hide');
			},
		});
	}
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
	  
	  $(document).ready(function() {

      var nCloneTh = document.createElement('th');
      var nCloneTd = document.createElement('td');
      nCloneTd.innerHTML = '<img src="<?php echo base_url('assets/lib/advanced-datatable/images/details_open.png'); ?>';
      nCloneTd.className = "center";

      $('#hidden-table-info thead tr').each(function() {
        this.insertBefore(nCloneTh, this.childNodes[0]);
      });

      $('#hidden-table-info tbody tr').each(function() {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
      });

      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */
    var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'asc']
        ]
      });

      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
      $('#hidden-table-info tbody td img').live('click', function() {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
          /* This row is already open - close it */
          this.src = "<?php echo base_url('assets/lib/advanced-datatable/media/images/details_open.png'); ?>";
          oTable.fnClose(nTr);
        } else {
          /* Open this row */
          this.src = "<?php echo base_url('assets/lib/advanced-datatable/images/details_close.png'); ?>";
          oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
      });
    });

    </script>

</body>

</html>