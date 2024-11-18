<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  page_require_level(2);

  // Fetch product data
  $products = join_product_table();

  // Bubble sort function
  function bubble_sort(&$products, $order = 'asc') {
      $n = count($products);
      for ($i = 0; $i < $n - 1; $i++) {
          for ($j = 0; $j < $n - $i - 1; $j++) {
              $condition = $order === 'asc'
                  ? $products[$j]['quantity'] > $products[$j + 1]['quantity']
                  : $products[$j]['quantity'] < $products[$j + 1]['quantity'];
              
              if ($condition) {
                  $temp = $products[$j];
                  $products[$j] = $products[$j + 1];
                  $products[$j + 1] = $temp;
              }
          }
      }
  }

  // Get sorting order from the query string or default to ascending
  $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc'; // Default: ascending
  bubble_sort($products, $sort_order);
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <div class="pull-right">
          <!-- Add New Button -->
          <a href="add_product.php" class="btn btn-primary" style="margin-right: 10px;">Add New</a>

          <!-- Sort Button -->
          <button id="sortButton" class="btn btn-info" onclick="toggleSortOptions()">Sort</button>

          <!-- Sort Form (Hidden by default) -->
          <form method="GET" action="" id="sortForm" style="display: none; margin-top: 10px;">
            <select name="sort_order" class="form-control" style="width: auto; display: inline-block; margin-right: 10px;" onchange="this.form.submit()">
              <option value="asc" <?php if (isset($_GET['sort_order']) && $_GET['sort_order'] === 'asc') echo 'selected'; ?>>Ascending</option>
              <option value="desc" <?php if (isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc') echo 'selected'; ?>>Descending</option>
            </select>
          </form>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">SN</th>
              <th> Photo</th>
              <th> Product Title </th>
              <th class="text-center" style="width: 10%;"> Categories </th>
              <th class="text-center" style="width: 10%;"> In-Stock </th>
              <th class="text-center" style="width: 10%;"> Buying Price </th>
              <th class="text-center" style="width: 10%;"> Selling Price </th>
              <th class="text-center" style="width: 10%;"> Product Added </th>
              <th class="text-center" style="width: 100px;"> Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
              <td class="text-center"><?php echo count_id(); ?></td>
              <td>
                <?php if ($product['media_id'] === '0'): ?>
                  <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
              </td>
              <td> <?php echo remove_junk($product['name']); ?></td>
              <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
              <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
              <td class="text-center">NRS <?php echo remove_junk($product['buy_price']); ?></td>
              <td class="text-center">NRS <?php echo remove_junk($product['sale_price']); ?></td>
              <td class="text-center"> <?php echo read_date($product['date']); ?></td>
              <td class="text-center">
                <div class="btn-group">
                  <a href="edit_product.php?id=<?php echo (int)$product['id']; ?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a>
                  <a href="delete_product.php?id=<?php echo (int)$product['id']; ?>" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-trash"></span>
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>

<script>
  function toggleSortOptions() {
    const sortForm = document.getElementById('sortForm');
    const sortButton = document.getElementById('sortButton');
    
    // Toggle visibility of the sorting form
    if (sortForm.style.display === 'none' || sortForm.style.display === '') {
      sortForm.style.display = 'block'; // Show the form with sorting options
    } else {
      sortForm.style.display = 'none'; // Hide the form after sorting
    }
  }
</script>
