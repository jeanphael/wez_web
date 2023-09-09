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
        <h4><i class="fa fa-angle-right"></i> Tarif</h4>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <h4 class="title"><?php if (!empty($price)) echo ' Mise à jour tarif'; else echo ' Nouveau'; ?></h4>
            <div id="message"></div>
            <form class="contact-form" method="POST" role="form" action="<?php if (!empty($price)) {
              echo base_url('priceUpdateValidate');
              $name = $price->name;$value = $price->value;$idEvent = $price->idEvent;$nameEvent = $price->nameEvent;$idP=$price->idPrice;}
               else echo base_url('price_save');  ?>">

              <div class="form-group">
                <input type="hidden" name="id" value="<?=esc($idP);  ?>"/>
                <input type="text" name="name" class="form-control" id="contact-name" placeholder="Libelle" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $name; ?>">
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <input type="number" name="value" class="form-control" id="contact-name" placeholder="Valeur" data-rule="minlen:1" data-msg="Please enter a number" value="<?php echo $value; ?>">
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <select name="idEvent" id="idEvent" multiple class="form-control">
				  <?php foreach ($eventList as $rowE): ?>
				  <option <?php if(!empty($idEvent) && $idEvent==$rowE->idEvent) echo "selected=\'true\'"; ?> value="<?=esc($rowE->idEvent);  ?>"><?=esc($rowE->name);  ?></option>
				  <?php endforeach; ?>
				</select>
              </div>
              <div class="loading"></div>
              <div class="error-message"></div>
              <div class="sent-message"></div>

              <div class="form-send">
                <button type="submit" class="btn btn-large btn-primary">Enregistrer</button>
              </div>

            </form>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6">
            <h4 class="title">Liste</h4>
           <div class="content-panel">
      <?php if (! empty($priceList) && is_array($priceList)) : ?> 
              <table class="display table table-striped table-advance table-hover" id="hidden-table-info">
                <thead>
                  <tr>
                    <th><i class="fa"></i> Libelle</th>
                   <th><i class="fa"></i> Valeur</th>
                   <th><i class="fa"></i> Evenement</th>
                    <!--th><i class="fa fa-bookmark"></i> Profit</th>
                    <th><i class=" fa fa-edit"></i> Status</th-->
                    <th></th>
                  </tr>
                </thead>
                <tbody>
        <?php foreach ($priceList as $row): ?>
                  <tr>
                    <td>
                     <?php echo $row->name; ?>
                    </td>
                    <td class="hidden-phone"><?php echo $row->value; ?></td>
                    <td class="hidden-phone"><?php echo $row->nameEvent; ?></td>
                    <!--td>12000.00$ </td>
                    <td><span class="label label-info label-mini">Due</span></td-->
                    <td>
                       <a href="<?php echo base_url('price_update?id='.$row->idPrice."'"); ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                      <button class="btn btn-danger btn-xs" onclick="return deletePrice(<?=$row->idPrice;?>);"><i class="fa fa-trash-o "></i></button>
                    </td>
                  </tr>
                 <?php endforeach; ?>
                </tbody>
              </table>
        <?php else : ?> 
          <h4>Aucun tarif enregistr&eacute;</h4> 
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

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
   <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/jquery.js'); ?>"></script>
 
  <script class="include" type="text/javascript" src="<?php echo base_url('assets/lib/jquery.dcjqaccordion.2.7.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.scrollTo.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.nicescroll.js'); ?>" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="<?php echo base_url('assets/lib/common-scripts.js'); ?>"></script>
  <!--script for this page-->
  <script src="<?php echo base_url('assets/lib/jquery-ui-1.9.2.custom.min.js'); ?>"></script>
  <!--custom switch-->
  <script src="<?php echo base_url('assets/lib/bootstrap-switch.js'); ?>"></script>
  <!--custom tagsinput-->
  <script src="<?php echo base_url('assets/lib/jquery.tagsinput.js'); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/jquery.dataTables.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/DT_bootstrap.js'); ?>"></script>
 
  <!--Contactform Validation-->
  <script src="<?php echo base_url('assets/lib/php-mail-form/validate.js'); ?>"></script>
   <script type="text/javascript">
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