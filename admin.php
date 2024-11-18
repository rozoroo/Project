

<?php
$page_title = 'Admin Home Page';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);

$c_categorie = count_by_id('categories');
$c_product = count_by_id('products');
$c_sale = count_by_id('sales');
$c_user = count_by_id('users');
$products_sold = find_higest_saleing_product('10');
$recent_products = find_recent_product_added('5');
$recent_sales = find_recent_sale_added('5');
?>
<?php include_once('layouts/header.php'); ?>

<style>
  .panel-box {
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    transition: all 0.3s ease-in-out;
    margin: 15px 10px;
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

 
  .panel-icon {
    font-size: 30px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
  }

  .bg-secondary1 {
    background-color: #6c757d;
    color: white;
  }

  .bg-red {
    background-color: #dc3545;
    color: white;
  }

  .bg-blue2 {
    background-color: #007bff;
    color: white;
  }

  .bg-green {
    background-color: #28a745;
    color: white;
  }

  .panel-value {
    text-align: right;
  }

  .panel-value h2 {
    font-size: 24px;
    margin: 0;
  }

  .panel-value p {
    margin: 0;
    font-size: 14px;
    color: #6c757d;
  }

  .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .col-md-3 {
    flex: 1 1 calc(25% - 20px);
    margin: 10px;
    max-width: calc(25% - 20px);
  }

  a {
    text-decoration: none;
  }
  a:hover{
    text-decoration: none;
  }
</style>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <a href="users.php">
      <div class="panel panel-box clearfix">
        <div class="panel-icon bg-secondary1">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value">
          <h2><?php echo $c_user['total']; ?></h2>
          <p>Users</p>
        </div>
      </div>
    </a>
  </div>

  <div class="col-md-3">
    <a href="categorie.php">
      <div class="panel panel-box clearfix">
        <div class="panel-icon bg-red">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value">
          <h2><?php echo $c_categorie['total']; ?></h2>
          <p>Categories</p>
        </div>
      </div>
    </a>
  </div>

  <div class="col-md-3">
    <a href="product.php">
      <div class="panel panel-box clearfix">
        <div class="panel-icon bg-blue2">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value">
          <h2><?php echo $c_product['total']; ?></h2>
          <p>Products</p>
        </div>
      </div>
    </a>
  </div>

  <div class="col-md-3">
    <a href="sales.php">
      <div class="panel panel-box clearfix">
        <div class="panel-icon bg-green">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value">
          <h2><?php echo $c_sale['total']; ?></h2>
          <p>Sales</p>
        </div>
      </div>
    </a>
  </div>
</div>
<br>
<br>

  
  <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Highest Selling Products</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th>Title</th>
             <th>Total Sold</th>
             <th>Total Quantity</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($products_sold as  $product_sold): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                <td><?php echo (int)$product_sold['totalSold']; ?></td>
                <td><?php echo (int)$product_sold['totalQty']; ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
   <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>LATEST SALES</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           <th class="text-center" style="width: 50px;">SN</th>
           <th>Product Name</th>
           <th>Date</th>
           <th>Total Sale</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($recent_sales as  $recent_sale): ?>
         <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td>
            <a href="edit_sale.php?id=<?php echo (int)$recent_sale['id']; ?>">
             <?php echo remove_junk(first_character($recent_sale['name'])); ?>
           </a>
           </td>
           <td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
           <td>NRS.<?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
        </tr>

       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Recently Added Products</span>
        </strong>
      </div>
      <div class="panel-body">

        <div class="list-group">
      <?php foreach ($recent_products as  $recent_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo    (int)$recent_product['id'];?>">
                <h4 class="list-group-item-heading">
                 <?php if($recent_product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image'];?>" alt="" />
                <?php endif;?>
                <?php echo remove_junk(first_character($recent_product['name']));?>
                  <span class="label label-warning pull-right">
                 NRS.<?php echo (int)$recent_product['sale_price']; ?>
                  </span>
                </h4>
                <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
              </span>
          </a>
      <?php endforeach; ?>
    </div>
  </div>
 </div>
</div>
 </div>
  <div class="row">

  </div>



<?php include_once('layouts/footer.php'); ?>
