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
        <h3><i class="fa fa-angle-right"></i> Cat&eacute;gorie</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12 col-md-12 col-sm-12">
           
             <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Liste</h4>
               
      <?php if (! empty($categoryList) && is_array($categoryList)) : ?> 
              <table class="table table-striped table-advance table-hover">
               <hr>
                <thead>
                  <tr>
                    <th><i class="fa"></i> Libelle</th>
                     <!--th><i class="fa fa-bookmark"></i> Profit</th>
                    <th><i class=" fa fa-edit"></i> Status</th-->
                    <th></th>
                  </tr>
                </thead>
                <tbody>
        <?php foreach ($categoryList as $row): ?>
                  <tr>
                    <td>
                     <?=esc($row['name']); ?>
                    </td>
                     <td>
                      <a href="<?php echo base_url('category_update?id='.$row['idCategory']."'"); ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                      <button class="btn btn-danger btn-xs" onclick="return deleteCategory(<?=$row['idCategory'];?>);"><i class="fa fa-trash-o "></i></button>
                    </td>
                  </tr>
                 <?php endforeach; ?>
                </tbody>
              </table>
        <?php else : ?> 
          <h4>Aucune cat&eacute;gorie enregistr&eacute;e</h4> 
        <?php endif ?> 
            </div>

             </br>
                <div class="form-panel">
                   <h4><i class="fa fa-angle-right"></i> <?php if (!empty($category)) echo ' Mise à jour categorie'; else echo ' Nouveau'; ?></h4>
          
           <?php $validation =  \Config\Services::validation(); ?>
            <?= $validation->listErrors() ?>
              <form  method="POST" action="<?php if (!empty($category)) {
              echo base_url('category_updateValidate');
              $name = $category->name;$idC = $category->idCategory;}
               else echo base_url('category_insert');  ?>" class="form-horizontal style-form">
          <div class="form-group">
            <label class="control-label col-md-3">Libelle</label>
            <div class="col-md-4">
                 <input type="hidden" name="id" value="<?=esc($idC);  ?>"/>
                <input type="name" name="name" class="form-control" id="contact-name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $name; ?>">
              <div class="validate"></div>
            </div>
          </div>
        
          <div class="form-group">
          <label class="control-label col-md-3"></label>
                   <div class="col-md-4">
                      <button class="btn btn-theme" type="submit">Enregistrer</button>
                    </div>
                  </div>
              </div>
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
  <script src="<?php echo base_url('assets/lib/jquery-ui-1.9.2.custom.min.js'); ?>"></script>
  <!--custom switch-->
  <script src="<?php echo base_url('assets/lib/bootstrap-switch.js'); ?>"></script>
  <!--custom tagsinput-->
  <script src="<?php echo base_url('assets/lib/jquery.tagsinput.js'); ?>"></script>

  <!--Contactform Validation-->
  <script src="<?php echo base_url('assets/lib/php-mail-form/validate.js'); ?>"></script>
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
      </script>

</body>

</html>