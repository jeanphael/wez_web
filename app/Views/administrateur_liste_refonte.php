<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); ?>
<body style="background-color:#FAFAFA">
<?php include('menu.php'); $image = 'https://images.indianexpress.com/2020/06/online-classes.jpg'; ?>
    <div class="container">
           <div class="col-lg-10 col-sm-10 col-md-10 block-center"  style="margin:auto !important;float:none !important " >
            <div class="row titleban"> <h3><b>Administrateurs </b><label id="count"><?php echo ' ('. count($userList).')'; ?></label></h3></div>
            <div class="row whitebackground"> 
                 <div class="row"> 
                    <div class="col-lg-6 col-md-12 col-sm-12  col-xs-12 "> 
                         <div class="row" style="display:flex"> 
                            <div class="col-lg-8  col-xs-10 col-sm-10 col-md-10" style="padding-right:0px"> 
                                <div class="inputsearch">
                                    <input class="form-control" id="search-input-user" name="search" placeholder="Rechercher un administrateur"/> 
                                </div>
                            </div>
                            <div class="col-lg-2  col-xs-2 col-sm-2 col-md-2" style="padding-left:0px"> 
                                <button class="btn radiusnone" id="search-button-user" type="submit" style="background-color:#4ECDC4 !important;border-radius:4px !important;color:white" >
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 text-right" style="float:right;">  <a href="<?php echo base_url("administrateur/ajout");?>">    <button  class="btn vert-button"  style=";color:white;background-color:#4ECDC4 !important;color:white;width:100%"><span style="margin-top: 3px;
margin-left: 10px;background: transparent url('<?php echo base_url(); ?>/assets/img/ico-+.png') 0% 0% no-repeat;
opacity: 1;float:left;width:15px;height:15px"></span>Nouveau administrateur</button> </a> </div> 
                </div> 
                
                <br/> 
                <div class="row" style="overflow-y: scroll; height:350px; width: auto;padding-right:10px;padding-left:10px"> 
                    <div class="col-lg-12 block-center table-responsive" style="border: 0px !important">
                        <table class="table" id="UserContainer"> 
                                <tr>
                                    <th scope="col" >Nom et pr&eacute;noms </th> 
                                    <th scope="col" >Contact </th>
                                    <th scope="col" >E-mail </th> 
                                    <th scope="col" >Action </th> 
                                </tr>  
                                <?php foreach ($userList as $row): ?> 
                                <tr>
                                    <td><?php echo $row->name;  ?> </td> 
                                    <td><?php echo $row->phone; ?> </td> 
                                    <td><?php echo  $row->email; ?> </td> 
                                    <td>
                                          <a href="<?php echo base_url('admin/update?i='.$row->idUser."'"); ?>"><button  class="btnhove" style="text-align:center;background-color:#FAFAFA; border: none; "><i class="glyphicon glyphicon-edit" style="color:#4F4E4E;"></i></button></a>
                                         <button   class="btnhove" style="background-color:#FAFAFA; border: none;" onclick="return deleteUser(<?php echo $row->idUser;?>);"><i class="glyphicon glyphicon-trash" style="color:#4F4E4E; text-align:center;"></i></button>
                                         
                                        </td>  
                                </tr>  
                                <?php endforeach; ?>
                            </table> 
                            </div>      
                    </div>            
           
    </div>
<footer>
</footer>

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
 

 <script type="text/javascript" >
    function deleteUser(idU){
       res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =  "admin/delete?i="+idU;
          document.location.href = url;
          return true;
          }
         else{
           return false;
         }
      }

      
      $( "#search-button-user" ).click(function() {
           $searchUserVal = $( "#search-input-user" ).val().trim();
     
     if($searchUserVal.length >1)
     {
      
      $.ajax({
       url : 'user/admin/search', // La ressource ciblée
       dataType : 'json',
       type : 'POST', // Le type de la requête HTTP.
        data:{ textToFind:$searchUserVal
      },success:function(data){
        
        $('#UserContainer').html('');
        $('#UserContainer').append('<tr> <th scope="col" >Nom & Pr&eacute;nom </th> <th scope="col" >Contact </th> <th scope="col" >E-mail </th>   <th scope="col" >Action </th>   </tr>');
        
        $.each(data, function(k, v) {
            str = "<tr>";
            str+= '<td>'+v.name+' '+v.firstname+'</td>';
            str+= '<td>'+v.phone+'</td>';
            str+= '<td>'+v.email+'</td>';
            str+='<td><a href="<?php echo base_url('admin/update?i='); ?>'+v.idUser+'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';

            str+= '<button class="btn btn-danger btn-xs" onclick="return deleteUser('+v.idUser+');"><i class="fa fa-trash-o "></i></button> </td>';
            str+= '</tr>';
           
            $('#UserContainer').append(str);
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
