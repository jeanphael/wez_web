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
        <h3><i class="fa fa-angle-right"></i> Liste des &eacute;v&egrave;nements</h3>
        <div class="mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table">
              <?php if (! empty($events) && is_array($events)) : ?> 
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-advance table-striped table-hover" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th>Date</th>
                    <th class="hidden-phone">Lieu</th>
        	<!--th class="hidden-phone">Tarifs</th-->
                    <th class="hidden-phone">Organisateur</th>
                    <th class="hidden-phone">Categorie</th>
                    <!--th class="hidden-phone">Inscrits</th-->
                     <th></th> <th></th>
                  </tr>
                </thead>
				<tbody>
				<?php foreach ($events as $row):
          $idE=$row->idEvent; ?> 
                  <tr class="gradeY">
                    <td><?= $row->name;  ?></td>
                    <td><?php 
                     $dateToformatBegin = explode(' ',$row->dateBegin)[0];
                     $dateToformatEnd = explode(' ',$row->dateEnd)[0];
                    $dateformatedBegin = explode('-',$dateToformatBegin);
                    $dateformatedEnd = explode('-',$dateToformatEnd);
                    $datebeginning = $dateformatedBegin[2].'/'.$dateformatedBegin[1].'/'.$dateformatedBegin[0];
                    $dateending = $dateformatedEnd[2].'/'.$dateformatedEnd[1].'/'.$dateformatedEnd[0];
                    $heurebeginning = explode(':',explode(' ',$row->dateBegin)[1])[0].':'.explode(':',explode(' ',$row->dateBegin)[1])[1];
                    $heureending = explode(':',explode(' ',$row->dateEnd)[1])[0].':'.explode(':',explode(' ',$row->dateEnd)[1])[1];
                     if($datebeginning ==  $dateending){
                        echo $datebeginning.'<b><em> de </em></b>'.$heurebeginning.'<b><em> à </em></b>'.$heureending; 
                     }
                     else{
                        echo $datebeginning.' '.$heurebeginning.'<b><em> au </em></b>'.$dateending.' '.$heureending; 
                     }
                       ?></td>
                    <td class="hidden-phone"><?= $row->placeName; ?></td>
       		<!--td class="center hidden-phone"> Ar -  Ar -  Ar</td-->
                    <td class="center hidden-phone"><?= $row->nameOrganizer; ?></td>
                    <td class="center hidden-phone"><?= $row->nameCategory; ?></td>
                      <td>  
                     <a href="<?php echo base_url('event_update?id='.$row->idEvent."'"); ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                     </td>   <td>    <button class="btn btn-danger btn-xs" onclick="return deleteEvent(<?=$row->idEvent;?>);"><i class="fa fa-trash-o "></i></button>
                    </td>
                    <!--td class="center hidden-phone">100</td-->
                  </tr>
				<?php endforeach; ?>
                </tbody>
              </table>
				<?php else : ?> 
					<h4>Aucun evenement enregistr&eacute;</h4> 
				<?php endif ?> 
            </div>
          </div>
          <!-- page end-->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>

    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
     </section>
	 <!--footer class="site-footer">
     <div class="text-center">
        <p>
         <strong>Mai</strong>2020
        </p>
        <div class="credits">
       
          Created with  <a href="https://templatemag.com/"></a>
        </div>
      </div>
    </footer-->
    <!--footer end-->
 
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script class="include" type="text/javascript" src="<?php echo base_url('assets/lib/jquery.dcjqaccordion.2.7.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.scrollTo.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery.nicescroll.js'); ?>" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/jquery.dataTables.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/lib/advanced-datatable/js/DT_bootstrap.js'); ?>"></script>
  <!--common script for all pages-->
  <script src="<?php echo base_url('assets/lib/common-scripts.js'); ?>"></script>

  <!--script for this page-->
  <script type="text/javascript">
    /* Formating function for row details */
    function fnFormatDetails(oTable, nTr) {
      var aData = oTable.fnGetData(nTr);
      var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      sOut += '<tr><td>Tarifs:</td><td>Classique 10 000 Ar , Silver 15 000 Ar , Premium 25 000 Ar</td></tr>';
      sOut += '<tr><td>Description:</td><td>Donec a tempus arcu. Pellentesque eu elit vitae sem cursus tempus et quis lectus. Aenean condimentum libero tortor, vel placerat nulla tristique nec. Integer feugiat vestibulum enim, ut porta ex varius id. Cras viverra erat sit amet tellus laoreet, id consequat urna porta. Aliquam pharetra massa ut luctus condimentum. Maecenas at egestas est, et tincidunt metus. Maecenas leo libero, elementum bibendum luctus nec, ullamcorper in ex. Nunc lacinia at purus at eleifend. Ut tincidunt, dolor et ultrices dictum, mi mi ullamcorper sem, sed varius lacus tellus in purus.</td></tr>';
      sOut += '</table>';

      return sOut;
    }
 function deleteEvent(idEv){
       res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =  "event_delete?id="+idEv;
          document.location.href = url;
          return true;
          }
         else{
           return false;
         }
      }

    $(document).ready(function() {

      
      /*
       * Insert a 'details' column to the table
       */
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