<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>
<body style="background-color:#FAFAFA">
<?php include('menu.php'); $image = 'https://images.indianexpress.com/2020/06/online-classes.jpg'; ?>
    <div class="container">
           <div class="col-lg-10 col-sm-10 col-md-10 block-center"  style="margin:auto !important;float:none !important " >
            <div class="row titleban">
                 <div class="col-lg-4 col-md-4 col-sm-4">
                     <h3><b>Gestion </b></h3>
                 </div>
                 <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="col-lg-3 col-md-3 col-sm-3 text-right"> <a style="color:#47AF9E !important;font-size:16px !important;font-weight: bold !important" class="onglet" href="<?php echo base_url('gestion/tarif'); ?>">Tarif Ev&egrave;nement</a></div>
                        <div class="col-lg-3 col-md-3 col-sm-3 text-right"> <a class="onglet" href="<?php echo base_url('gestion/cout'); ?>">Cout publication</a></div>
                        <div class="col-lg-3 col-md-3 col-sm-3 text-right"><a class="onglet" href="<?php echo base_url('gestion/categorie'); ?>">Cat&eacute;gories</a></div>
                        <div class="col-lg-3 col-md-3 col-sm-3 text-right"><a class="onglet" href="<?php echo base_url('gestion/lieu'); ?>">Lieu</a></div>
                 </div>
            </div>
            <div class="row whitebackground"> 
                 <div class="row"> 
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12"> 
                         <div class="row"  style="display:flex"> 
                            <div class="col-lg-8  col-xs-10 col-sm-10 col-md-10" style="padding-left:3%;padding-right:0px"> 
                                <div class="inputsearch">
                                    <input class="form-control" name="search" placeholder="Rechercher un évènement"/> 
                                </div>
                            </div>
                            <div class="col-lg-2  col-xs-2 col-sm-2 col-md-2" style="padding-left:0px"> 
                                <button class="btn radiusnone" type="submit" style="background-color:#4ECDC4 !important;color:white" >
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 text-right" style="float:right;">      <button  class="btn vert-button"  style=";color:white;background-color:#4ECDC4 !important;color:white;width:100%" data-toggle="modal" data-target="#modaltrf"><span style="margin-top: 3px;
margin-left: 10px;background: transparent url('<?php echo base_url(); ?>/assets/img/ico-+.png') 0% 0% no-repeat;
opacity: 1;float:left;width:15px;height:15px"></span>Nouveau tarif</button> </div> 
                </div> 
                
                <br/> 
                <div class="row" style="overflow-y: scroll; height:350px; width: auto;"> 
                    <div class="col-lg-12 block-center"> 
                         <?php if (! empty($priceList) && is_array($priceList)) : ?> 
                         <table class="table"> 
                                <tr>
                                    <th scope="col" >Libelle </th> 
                                    <th scope="col" >Valeur </th>
                                    <th scope="col" >Evenement </th> 
                                    <th scope="col" >Action </th> 
                                </tr>  
                                <?php foreach ($priceList as $row): ?>
                                <tr>
                                    <td> <?php echo $row->name; ?></td> 
                                    <td><?php echo $row->value; ?></td> 
                                    <td><?php echo $row->nameEvent; ?> </td> 
                                    <td>  <button style="background-color:#FAFAFA; border:none"  class="btnhove" data-toggle="modal" data-target="#modaltrf" data-name="<?=$row->name;?>" data-value="<?=$row->value;?>" data-idevent="<?=$row->idEvent;?>" data-id="<?=$row->idPrice;?>"> <i class="glyphicon glyphicon-edit" style="color:#4F4E4E;"></i></button>
                                            <button style="background-color:#FAFAFA; border:none"   class="btnhove" onclick="return deletePrice(<?=$row->idPrice;?>);"><i class="glyphicon glyphicon-trash " style="color:#4F4E4E;"></i></button>
                                    </td>  
                                </tr>  
                                <?php endforeach; ?>
                            </table> 
                            <?php else : ?> 
                                <h4>Aucun tarif enregistr&eacute;</h4> 
                            <?php endif ?> 
                            
                            </div>      
                    </div>            
           
    </div>
    <div id="modaltrf" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Ajouter un tarif</h3>
      </div>
      <div class="modal-body">
    <p> <label >Libell&eacute; </label ><input type="hidden" name="id" id="id"/>
    <input class="form-control" type="text" name="libtrf" id="libtrf"/></p>
    <p> <label >Prix</label > <input class="form-control" type="number" name="pricevalue" id="pricevalue"/></p>
     
    <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <label > Evenement </label>
                <select  class="form-control" name="event"  class="" id="idevent">
                    <?php foreach ((array)$eventList as $row): ?>
                       <option  <?php if($idEvent == $row->idEvent) echo "selected";?>value="<?php echo $row->idEvent;  ?>"><?php echo $row->name;  ?></option>
                    <?php endforeach; ?>
                </select>
             </div> <br/> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-default ajoutlieu" id="btnSendCity" onclick="addTarif()">Enregistrer</button>
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


$("#test").click(function() {
    
    $('#modallieu').modal('show')
    
    });

    function deletePrice(idPrice){
       res =  confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =  "price_delete?id="+idPrice;
          document.location.href = url;
          return true;
        }
       else{
         return false;
       }
      }
    
function addTarif()
{
    libelle = $("#libtrf").val();
    pricevalue = $("#pricevalue").val();
    event = $('#idevent option:selected').val();
    if(libelle === null || libelle === '') {
      alert('Veuillez entrer le libelle du tarif');
      return;
    }
    if(pricevalue === null || pricevalue.trim() === ''){
      alert('Veuillez entrer la valeur du tarif');
      return;
    }
    if(!event){
      alert('Veuillez sélectionner l evenement');
      return;
    }
   if($("#id").size() > 0){
        idPrice = $("#id").val();
        $.ajax({
            url : 'price_update_post', // La ressource ciblée
            dataType : 'json',
            type : 'POST', // Le type de la requête HTTP.
                data:{ libelle:libelle,event:event,idPrice:idPrice,pricevalue:pricevalue
            },success:function(data){
                $("#modaltrf").modal('hide');
                location.href = "<?php echo base_url('gestion/tarif');?>";
            },
        });
   }
   else{
        $.ajax({
        url : 'price_save_post', // La ressource ciblée
        dataType : 'json',
        type : 'POST', // Le type de la requête HTTP.
            data:{ libelle:libelle,priceValue:pricevalue,event:event
        },success:function(data){
            $("#modaltrf").modal('hide');
            location.href = "<?php echo base_url('gestion/tarif');?>";
        },
        });
   }
    
}
$('#modaltrf').on('show.bs.modal', function(e) {
//get data-id attribute of the clicked element

var name = $(e.relatedTarget).data('name');
var id = $(e.relatedTarget).data('id');

var idevent = $(e.relatedTarget).data('idevent');
var valu = $(e.relatedTarget).data('value');
//populate the textbox
$('#modaltrf').find('input[name="id"]').val(id);
$('#modaltrf').find('input[name="libtrf"]').val(name);
$('#modaltrf').find('input[name="pricevalue"]').val(valu);
$('#modaltrf option[value="'+idevent+'"]').prop('selected', true);
if($('#modaltrf').find('input[name="id"]').val().trim()!== '') $('#modaltrf').find('#btnSendCity').text("Editer tarif");
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
