<!DOCTYPE html>
<html lang="en">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
				<div class="col-lg-2 col-md-2 col-sm-2 text-right"> <h3><a  style="color:#47AF9E !important;font-weight: bold !important" class="onglet" href="<?php echo base_url('gestion/categorie'); ?>">Cat&eacute;gories</a></h3></div>
				<div class="col-lg-2 col-md-2 col-sm-2 text-right"> <h3><a class="onglet" href="<?php echo base_url('gestion/lieu'); ?>">Lieu</a></h3></div>     
            </div>
            <div class="row whitebackground"> 
                 <div class="row"> 
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12"> 
                         <div class="row"  style="display:flex"> 
                            <div class="col-lg-8  col-xs-10  col-sm-10 col-md-10" style="padding-right:0px"> 
                                <div class="inputsearch">
                                    <input class="form-control" id="search-input-category" name="search" placeholder="Rechercher un catégorie"/> 
                                </div>
                            </div>
                            <div class="col-lg-2  col-xs-2 col-sm-2 col-md-2" style="padding-left:0px"> 
                                <button class="btn radiusnone" id="search-button-category" type="submit" style="background-color:#4ECDC4 !important;color:white;border-radius:4px !important" >
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 text-right" style="float:right;">      <button type="button" data-toggle="modal" data-target="#modalCategorie" class="btn vert-button"  onclick="addcat()" style=";color:white;background-color:#4ECDC4 !important;color:white;width:100%"><span style="margin-top: 3px;
margin-left: 10px;background: transparent url('<?php echo base_url(); ?>/assets/img/ico-+.png') 0% 0% no-repeat padding-box;
opacity: 1;float:left;width:15px;height:15px"></span>Nouveau cat&eacute;gorie</button> </div> 
                </div> 
                
                <br/> 
                <div class="row" style="overflow-y: scroll; height:350px; width: auto;padding-right:10px;padding-left:10px"> 
                    <div class="col-lg-12 block-center table-responsive" style="border: 0px !important">
                    <?php if (! empty($categoryList) && is_array($categoryList)) { ?>
                        <table class="table" id="tableContainer"> 
                            <tr>
                                <th scope="col" >Libelle </th> 
                                <th scope="col" >Action </th> 
                            </tr>  
                            <?php foreach ($categoryList as $row){ ?>
                          <tr>
                                <td> <?=esc($row['name']); ?></td> 
                                <td> <button style="background-color:#FAFAFA; border:none"  class="btnhove" data-toggle="modal" data-target="#modalCategorie" data-name="<?=$row['name'];?>" data-id="<?=$row['idCategory'];?>"><i class="fa fa-edit" style="color:#4F4E4E;"></i></button>
                                    <button style="background-color:#FAFAFA; border:none"  class="btnhove" onclick="return deleteCategory(<?=$row['idCategory'];?>);"><i class="glyphicon glyphicon-trash" style="color:#4F4E4E;"></i></button>
                              </td> 
                              
                            </tr>  
                            <?php }  ?> 
                        </table> 
                        <?php } else {?>     <h4>Aucune cat&eacute;gorie enregistr&eacute;e</h4> 
                              <?php  }?>
                            </div>      
                    </div>            
           
    </div>
<footer>
</footer>
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
 function addcat()
 {
    // alert("car");
 }
    function addCategorie(){
    libelle = $("#idcat").val();
    if(libelle === null || libelle.trim() === '') {
      alert('Veuillez entrer le nouveau catégorie');
      return;
    }
    if($("#idCategory").val().trim() !== ''){ 
      var idCategory = $("#idCategory").val();
      $.ajax({
        url : 'category_update_post', // La ressource ciblée
        dataType : 'json',
        type : 'POST', // Le type de la requête HTTP.
          data:{ libelle: libelle,id:idCategory
        },success:function(data){
          $("#modalCategorie").modal('hide');
          location.href =  "<?php echo base_url('gestion/categorie');?>";
        },
      });
     }
    else{
        $.ajax({
        url : 'category_insert_post', // La ressource ciblée
        dataType : 'json',
        type : 'POST', // Le type de la requête HTTP.
          data:{ libelle: libelle
        },success:function(data){
		 $("#modalCategorie").modal('hide');
          location.href =  "<?php echo base_url('gestion/categorie');?>";
        },
      });
    }
  }
 </script>
 <script type="text/javascript">
    function deleteCategory(idCategory){
      res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =  "category_delete?id="+idCategory;
          document.location.href = url;
        return true;
       }
       else{
           return false;
        }
      }
      $('#modalCategorie').on('show.bs.modal', function(e) {
         var name = $(e.relatedTarget).data('name');
          var id = $(e.relatedTarget).data('id');
          $('#modalCategorie').find('input[name="cat"]').val(name);
         $('#modalCategorie').find('input[name="idCategory"]').val(id);
         if($("#idCategory").val().trim()!=='')   $('#modalCategorie').find('#title').text("Editer categorie");
        });


        
$( "#search-button-category" ).click(function() {
           $searchVal = $( "#search-input-category" ).val().trim();
     
     if($searchVal.length >1)
     {
      
      $.ajax({
       url : 'category/search', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ textToFind:$searchVal
      },success:function(data){
        console.log(data);
        $('#tableContainer').html('');
        $('#tableContainer').append('<tr> <th scope="col" >Libelle </th>   <th scope="col" >Action </th>   </tr>');
        
        $.each(data, function(k, v) {
            str = "<tr>";
            str+= '<td>'+v.name+'</td>';
            str+='<td> <button class="" data-toggle="modal" data-target="#modalCategorie" data-name="'+v.name+'" data-id="'+v.idCategory+'"><i class="glyphicon glyphicon-edit"></i><button class="" onclick="return deleteCategory('+v.idCategory+');"><i class="glyphicon glyphicon-trash"></i></button></td>';
            str+= '</tr>';
           
            $('#tableContainer').append(str);
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
