<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">

  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>Welcome To <hr>PK Inventory Management System</h1>
         <p>Manage and Add sales Only as an User!</p>
      </div>
    </div>
 </div>
</div>

<?php include_once('layouts/footer.php'); ?>
