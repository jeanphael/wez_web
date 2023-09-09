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
	     <?php include('aside.php'); ?>
  
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Utilisateur</h3>
        <!-- row -->
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
			<?php if (! empty($users) && is_array($users)) : ?> 
              <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> Liste</h4>
                <hr>
                <thead>
                  <tr>
                    <th><i class="fa fa-bullhorn"></i> Nom</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Pr&eacute;nom</th>
                    <th><i class="fa fa-bookmark"></i> Contact</th>
                    <th><i class="fa fa-bookmark"></i> Email</th>
                    <th><i class=" fa fa-edit"></i> Adresse</th>
                     <th><i class=" fa fa-edit"></i> Evenements aim&eacute;s</th>
                     <th><i class=" fa fa-edit"></i> Organisateur suivis</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
				<?php foreach ($users as $row): ?>
                  <tr>
                    <td>
                      <?php echo $row->name; ?>
                    </td>
                    <td><?php echo $row->firstname; ?></td>
                    <td class="hidden-phone"><?php echo $row->phone; ?></td>
					<td><?php echo $row->email; ?></td>
                    <td><span class="label label-info label-mini"><?php echo $row->adresse; ?></span></td>
                    <td><a href="<?php echo base_url('event_like?id='.$row->idUser."'"); ?>">Evenements aim&eacute;s</a></td>
              		<td><a href="<?php echo base_url('follow?id='.$row->idUser."'"); ?>">Organisateur suivis</a></td>
                    <td>
                      <!--a href="<?php //echo base_url('user_update?id='.$row['idUser']."'"); ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a-->
                      <button class="btn btn-danger btn-xs" onclick="return deleteUser(<?=$row->idUser;?>);"><i class="fa fa-trash-o "></i></button>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
				<?php else : ?> 
					<h4>Aucun utilisateur enregistr&eacute;</h4> 
				<?php endif ?> 
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-md-12 -->
        </div>
        <!-- /row -->
      </section>
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    </section>
  
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
  <script type="text/javascript">
    function deleteUser(idUser){
        res = confirm("Voulez-vous vraiment supprimer ?");
        if(res){
           url =  "user_delete?id="+idUser;
          document.location.href = url;
          return true;
        }
       else{
         return false;
       }
      }
  </script>
  
</body>

</html>