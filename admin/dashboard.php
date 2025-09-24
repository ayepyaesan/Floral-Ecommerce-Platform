<?php
session_start();
$pageTitle = 'Dashboard';
include './init.php';
if (isset($_SESSION['username'])) {
  $do = isset($_GET['do']) ? $_GET['do'] : 'dashboard';
  if ($do == 'dashboard') {

    $totalSubtotal = $con->query("SELECT SUM(subtotal) AS total_subtotal FROM orders WHERE order_status = 'completed'")->fetchColumn();
    $customersCount = $con->query("SELECT COUNT(*) AS total_customers FROM customers")->fetchColumn();
    $ordersCount = $con->query("SELECT COUNT(*) AS total_orders FROM orders")->fetchColumn();

    $ListBestSellers = $con->prepare("SELECT `products`.`id`, `products`.`name_product`, `products`.`img_product`,`products`.`price_product`, SUM(orders.product_quantity) AS `total_quantity_sold` FROM `orders` INNER JOIN `products` ON `orders`.`product_id` = `products`.`id` GROUP BY `products`.`id`, `products`.`name_product` ORDER BY `total_quantity_sold` DESC LIMIT 3;");
    $ListBestSellers->execute();
    $bestsellers = $ListBestSellers->fetchAll(PDO::FETCH_ASSOC);

  
$ListTdyOrders = $con -> prepare("SELECT orders.orders_number,customers.name_customer,orders.product_name,orders.product_quantity,orders.delivery_datetime,orders.order_status
FROM orders JOIN customers ON orders.customer_id = customers.id WHERE DATE(orders.delivery_datetime) = CURDATE() ORDER BY orders.delivery_datetime ASC");
$ListTdyOrders->execute();
$tdyorders = $ListTdyOrders->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="dashboard">
      <div class="container">
        <h1>Dashboard</h1>
        <div class="dashboard-status py-3">
          <div class="row">


            <div class="col-md-4">
              <div class="card border-secondary">
                <div class="card-body">
                  <h4 class="card-title">Total Sell</h4>
                  <p class="card-text"><?php echo $totalSubtotal; ?> MMK</p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card border-secondary">
                <div class="card-body">
                  <h4 class="card-title">Total Customers</h4>
                  <p class="card-text"><?php echo $customersCount ?></p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card border-secondary">
                <div class="card-body">
                  <h4 class="card-title">Total Orders</h4>
                  <p class="card-text"><?php echo $ordersCount ?></p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

<!-- Best Seller Products Section -->
 <!-- Best Seller Products Section (Card Grid Style) -->
<div class="container my-4">
  <h5 class="mb-3 fw-bold text-success">🌸 Best Seller Products</h5>
  <div class="row g-3">
    <?php $count=1; foreach ($bestsellers as $bestseller) : ?>
    <!-- Example Product Card -->
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <span class="position-absolute top-0 start-0 m-2 badge bg-danger">Top <?php echo $count;?></span>
        <img src="../uploads/<?php echo $bestseller['img_product']; ?>" class="card-img-top" style="height:300px; object-fit:cover; width:100%;" alt="Red Rose Bouquet">
        <div class="card-body">
          <h6 class="card-title mb-1"><?php echo $bestseller['name_product'] ?></h6>
          <p class="mb-1"><strong>Sold:</strong> <?php echo $bestseller['total_quantity_sold'] ?></p>
          <p class="mb-0"><strong>Revenue:</strong> <?php echo $bestseller['price_product']*$bestseller['total_quantity_sold']?>MMK</p>
        </div>
        <div class="card-footer bg-transparent border-0">
          <a href="/admin/products/1" class="btn btn-sm btn-outline-success w-100">View Product</a>
        </div>
      </div>
  </div>
  <?php  $count++; endforeach; ?>
  </div>
</div>

<!-- Today's Orders Section -->
<div class="container my-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">🌼 Today's Orders to Prepare</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th scope="col">Order #</th>
              <th scope="col">Customer</th>
              <th scope="col">Product</th>
              <th scope="col">Qty</th>
              <th scope="col">Delivery Time</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
             <?php foreach ($tdyorders as $tdyorder) : ?>
            <!-- Example static rows; Replace with PHP/JS loop -->
            <tr>
              <td><?php echo $tdyorder['orders_number'];?></td>
              <td><?php echo $tdyorder['name_customer'];?></td>
              <td><?php echo $tdyorder['product_name'];?></td>
              <td><?php echo $tdyorder['product_quantity'];?></td>
              <td><?php echo $tdyorder['delivery_datetime'];?></td>
              <td><span class="badge bg-success text-white"><?php echo $tdyorder['order_status'];?></span></td>
              <td>
               
              <form method="POST" action="dashboard.php?do=mark-done">
              <input type="hidden" name="orders_number" value="<?php echo $tdyorder['orders_number']; ?>">
              <button type="submit" class="btn btn-light" name="mark-done">Mark as done</button>
              </form>
              </td>
             </tr>
             <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <a href="edit-orders.php" class="btn btn-outline-primary btn-sm mt-2">View All Orders</a>
    </div>
  </div>
</div>
<?php
  } elseif ($do == 'mark-done') {
  if (isset($_POST['mark-done'])) {
    $ordernumber = $_POST['orders_number'];
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    // echo "DO: $do<br>";
    $stmt = $con->prepare("UPDATE orders SET order_status = 'completed' WHERE orders_number = ?");
    $stmt->execute([$ordernumber]);
    // show_message('Order status successfully completed', 'success');
    header('location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    header('Location: dashboard.php');
    exit();
  }
  } elseif ($do == '') {
  } elseif ($do == '') {
  } elseif ($do == '') {
    # code...
  }
} else {
  header('location: index.php');
  exit();
}
include $tpl . 'footer.php';
