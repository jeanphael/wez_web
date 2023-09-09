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
				<div class="col-lg-2 col-md-2 col-sm-2 text-right">  <h3><a  style="color:#47AF9E !important;font-weight: bold !important"  class="onglet" href="<?php echo base_url('gestion/cout'); ?>">Cout publication</a> </h3></div>
				<div class="col-lg-2 col-md-2 col-sm-2 text-right"> <h3><a  class="onglet" href="<?php echo base_url('gestion/categorie'); ?>">Cat&eacute;gories</a></h3></div>
				<div class="col-lg-2 col-md-2 col-sm-2 text-right"> <h3><a class="onglet" href="<?php echo base_url('gestion/lieu'); ?>">Lieu</a></h3></div>     
            
            </div>
            <div class="row whitebackground"> 
                 <div class="row"> 
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12"> 
                         <div class="row" style="display:flex"> 
                            <div class="col-lg-8  col-xs-10  col-sm-10 col-md-10" style="padding-left:3%;padding-right:0px"> 
                                <div class="inputsearch">
                                    <input class="form-control" name="search" placeholder="Rechercher un tarif"/> 
                                </div>
                            </div>
                            <div class="col-lg-2  col-xs-2 col-sm-2 col-md-2" style="padding-left:0px"> 
                                <button class="btn radiusnone" type="submit" style="border-radius:4px !important;background-color:#4ECDC4 !important;color:white" >
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </div> 
                    <!--div class="col-lg-4 col-md-4 col-sm-4 text-right" style="float:right;">      <button  class="btn vert-button"  style=";color:white;background-color:#4ECDC4 !important;color:white;width:100%">Nouveau tarif</button> </div--> 
                </div> 
                
                <br/> 
                <div class="row" style="overflow-y: scroll; height:350px; width: auto;padding-right:10px;padding-left:10px"> 
                    <div class="col-lg-12 block-center table-responsive" style="border: 0px !important">
                        <table class="table"> 
                                <tr>
                                    <th scope="col" >Libelle </th> 
                                    <th scope="col" >Tarif (En Ariary)</th>
                                    <th scope="col" >Action </th> 
                                </tr>  
                                 <tr>
                                    <td>Normal</td> 
                                    <td><?php echo $priceFirst->normal; ?></td> 
                                    <td> 
                                        <button data-toggle="modal"  class="btnhove" data-target="#modalpublication" data-name="normal" data-price="<?php echo $priceFirst->normal; ?>" data-id="<?php echo $priceFirst->id;?>" style="background-color:#FAFAFA; border:none" ><i class="glyphicon glyphicon-edit" style="color:#4F4E4E;"></i></button>
                                 </td>  
                                </tr>  
                                <tr>
                                    <td>Banniere</td> 
                                    <td><?php echo $priceFirst->banniere; ?></td> 
                                    <td>
                                        <button style="background-color:#FAFAFA; border:none"   class="btnhove" data-toggle="modal" data-target="#modalpublication"  data-name="banniere" data-price="<?php echo $priceFirst->banniere; ?>" data-id="<?php echo $priceFirst->id;?>"  ><i class="glyphicon glyphicon-edit" style="color:#4F4E4E;"></i></button>
                                     </td>  
                                </tr>  
                               
                            </table> 
                            </div>      
                    </div>            
           
    </div>
<footer>
</footer>
<div id="modalpublication" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title" id="title">Editer le cout de la publication</h3>
      </div>
      <div class="modal-body">
        <p><label class="control-label col-md-3">Cout</label>
        <input type="hidden" name="id" id="id"/></p>
         <input type="hidden" name="name" id="name"/></p>
         <input class="form-control" type="number" name="price" id="price"/></p>
      </div>
      <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
           <button type="button" id="title" class="btn btn-default ajoutlieu"  id="btnSend" onclick="addCout()">Enregistrer</button>
       </div>
    </div>
  </div>
</div>
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
    function addCout()
    {
        name = $("#name").val();
        price = $("#price").val();
        id = $("#id").val();
       
        if(price === null || price.trim() === ''){
        alert('Veuillez entrer le cout de l affichage '+name);
        return;
        }
        $.ajax({
            url : 'printprice_update', // La ressource ciblée
            dataType : 'json',
            type : 'POST', // Le type de la requête HTTP.
                data:{ name:name,price:price,id:id
            },success:function(data){
                $("#modalpublication").modal('hide');
               location.href = "<?php echo base_url('gestion/cout');?>";
            }
        });
    }
    $('#modalpublication').on('show.bs.modal', function(e) {
        //get data-id attribute of the clicked element
        var name = $(e.relatedTarget).data('name');
        var id = $(e.relatedTarget).data('id');
        var price = $(e.relatedTarget).data('price');
        //populate the textbox
        $('#modalpublication').find('input[name="name"]').val(name);
        $('#modalpublication').find('input[name="price"]').val(price);
        $('#modalpublication').find('input[name="id"]').val(id);
        if(name == "normal") $('#modalpublication').find('#title').text("Editer le cout de l\'affichage normale");
        else  $('#modalpublication').find('#title').text("Editer le cout de l affichage dans banniere");
    });
	$( "button.btnhove" ).mouseover(function() {
	  $( this ).css('background-color','#E0E0E0');
	});
	
	$( "button.btnhove").mouseout(function() { 
		$( this ).css('background-color','#FAFAFA');
	});
		
 </script>

</body>
 
</html>
