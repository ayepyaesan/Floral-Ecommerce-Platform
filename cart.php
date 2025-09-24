<?php
session_start();
$pageTitle = 'Cart';
include './init.php';
$do = isset($_GET['do']) ? $_GET['do'] : 'cart';
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
  $cartItems = $_SESSION['cart'];
} else {
  $cartItems = array();
}
if ($do == 'cart') {
  ?>
  <div class="cart">
    <div class="container">
      <h1>Shopping Cart</h1>
      <?php
      if (isset($_SESSION['message'])): ?>
        <div id="message">
          <?php echo $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['message']);
      endif;
      ?>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="text-bg-light">
              <th>Product Details</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($cartItems)): ?>
              <?php foreach ($cartItems as $item): ?>
                <tr>
                  <td><?php echo $item['product_name']; ?></td>
                  <td><?php echo $item['quantity']; ?></td>
                  <td><?php echo $item['product_price']; ?></td>
                  <td><?php echo $item['quantity'] * $item['product_price']; ?></td>
                  <td>
                    <a href="cart.php?do=remove-product&id=<?php echo $item['id']; ?>" class="btn btn-danger"><i
                        class="fa-solid fa-trash"></i>&nbsp;Remove</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">Your cart is empty.<br /><a class="btn btn-outline-dark" href="./index.php">Return to
                    shop</a></td>
              </tr>
            <?php endif ?>
          </tbody>
          <tfoot>
            <?php
            $subtotal = 0;
            if (!empty($cartItems)) {
              foreach ($cartItems as $item) {
                $subtotal += $item['quantity'] * $item['product_price'];
              }
            }
            ?>
            <tr>
              <td colspan="3">
                <strong>Subtotal:</strong>
              </td>
              <td>
                <strong>
                  <?php echo $subtotal; ?>
                </strong>
              </td>
              <td>
                <a href="cart.php?do=checkout" class="btn btn-primary"><i
                    class="fa-solid fa-check-to-slot"></i>&nbsp;Checkout</a>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <?php
} elseif ($do == 'checkout') {
  ?>
  <div class="checkout">
    <div class="container">
      <h1>Checkout</h1>
      <form method="post" action="cart.php?do=place-order" autocomplete="off" class="py-3" enctype="multipart/form-data">
        <div class="row g-3">
          <div class="col-md-6">
            <h2>Billing Details</h2>
            <?php
            if (isset($_SESSION['message'])): ?>
              <div id="message">
                <?php echo $_SESSION['message']; ?>
              </div>
              <?php unset($_SESSION['message']);
            endif;
            ?>
            <div class="form-group">
              <label for="name_customer">Full Name *</label>
              <input type="text" name="name_customer" id="name_customer" class="form-control" required="required">
            </div>
            <div class="form-group">
              <label for="phone_customer">Phone *</label>
              <input type="tel" name="phone_customer" id="phone_customer" class="form-control" required="required">
            </div>
            <div class="form-group">
              <label for="email_customer">Email Address *</label>
              <input type="email" name="email_customer" id="email_customer" class="form-control" required="required">
            </div>
            <div class="form-group">
              <label for="delivery_address">Delivery Address *</label>
              <input type="text" name="delivery_address" id="delivery_address" class="form-control" required="required">
            </div>
            <div class="form-group">
            <label for="delivery_datetime">Delivery Date & Time *</label>
            <input type="datetime-local" name="delivery_datetime" id="delivery_datetime" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="note_customer">Additional Information</label>
              <textarea name="note_customer" id="note_customer" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="fileUpload">KBZPay Screenshot</label>
              <input type="file" class="form-control" id="fileUpload" name="fileUpload">
            </div>
          </div>
          <div class="col-md-6">
            <h2>Your Order</h2>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($cartItems as $item): ?>
                    <tr>
                      <td><?php echo $item['product_name']; ?></td>
                      <td><?php echo $item['quantity']; ?></td>
                      <td><?php echo $item['product_price']; ?></td>
                      <td><?php echo $item['quantity'] * $item['product_price']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <?php
                  $subtotal = 0;
                  if (!empty($cartItems)) {
                    foreach ($cartItems as $item) {
                      $subtotal += $item['quantity'] * $item['product_price'];
                    }
                  }
                  ?>
                  <tr>
                    <td colspan="3">
                      <strong>Subtotal:</strong>
                    </td>
                    <td>
                      <strong>
                        <?php echo $subtotal; ?>
                      </strong>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <button type="submit" name="place_order" class="btn btn-primary"><i
                class="fa-solid fa-check-double"></i>&nbsp;Place Order</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php
} elseif ($do == 'place-order') {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  if (isset($_POST['place_order'])) {
    $name_customer = $_POST['name_customer'];
    $phone_customer = $_POST['phone_customer'];
    $email_customer = $_POST['email_customer'];
    $delivery_address = $_POST['delivery_address'];
    $delivery_datetime = $_POST['delivery_datetime'];
    $note_customer = $_POST['note_customer'];

    $orders_number = generateOrderNumber($con);
    if (empty($name_customer) || empty($phone_customer) || empty($email_customer) || empty($delivery_address) || empty($delivery_datetime)) {
      show_message('Please fill in all required fields.', 'danger');
      header('location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    } else {
      if (!empty($_FILES['fileUpload']['name'])) {
        $upload_dir = 'uploads/payments/';
        $file_ext = pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION);
        $img_payment = uniqid() . '.' . $file_ext;
        $img_payment_path = $upload_dir . $img_payment;
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'];
        if (!in_array(strtolower($file_ext), $allowed_types)) {
          show_message('Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.', 'danger');
          header('location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        $max_file_size = 5 * 1024 * 1024; // 5MB
        if ($_FILES['fileUpload']['size'] > $max_file_size) {
          show_message('File size exceeds the allowed limit (5MB).', 'danger');
          header('location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        // if (!checkImageDimensions($img_payment_path)) {
        //   show_message('Invalid image dimensions.', 'danger');
        //   header('location: ' . $_SERVER['HTTP_REFERER']);
        //   exit();
        // }
        if (!move_uploaded_file($_FILES['fileUpload']['tmp_name'], $img_payment_path)) {
          show_message('Failed to upload image!', 'danger');
          header('location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        $customers = $con->prepare("INSERT INTO `customers`(`name_customer`, `email_customer`, `phone_customer`) VALUES (?, ?, ?)");
        $customers->execute([$name_customer, $email_customer, $phone_customer]);
        $customer_id = $con->lastInsertId();
        $_SESSION['customer_id'] = $customer_id;
        foreach ($_SESSION['cart'] as $cartItems => $item) {
          $product_name = $item['product_name'];
          $product_quantity = $item['quantity'];
          $product_price = $item['product_price'];
          $subtotal = $product_quantity * $product_price;
          $products=$con->prepare("SELECT id FROM products WHERE name_product = ?");
          $products->execute([$product_name]);
          $product=$products->fetch();
          $product_id=$product['id'];
          $orders = $con->prepare("INSERT INTO `orders`(`orders_number`, `customer_id`,`product_id`, `product_name`, `product_quantity`, `product_price`, `subtotal`,`delivery_address`, `delivery_datetime` , `note_customer`,`upload_file`) VALUES (?, ?,?,?, ?, ?, ?, ?, ?, ?,?)");
          $orders->execute([$orders_number, $customer_id,$product_id, $product_name, $product_quantity, $product_price, $subtotal,$delivery_address,$delivery_datetime, $note_customer, $img_payment]);
          $stockproducts= $con -> prepare( "UPDATE products SET stock_product = stock_product - ? WHERE name_product = ?");
          $stockproducts->execute([$product_quantity,$product_name]);
        }
        unset($_SESSION['cart']);
        header('Location: cart.php?do=order-received');
        exit();
      } else {
        show_message('No image selected!', 'danger');
        header('location: ' . $_SERVER['HTTP_REFERER']);
        exit();
      }
    }
  } else {
    header('location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }
} elseif ($do == 'order-received') {
  ?>
  <div class="order-received">
    <div class="container">
      <h1>Thank you. Your order has been received.</h1>
      <?php if (isset($_SESSION['customer_id'])) {
        $stmt = $con->prepare("SELECT * FROM `customers` WHERE `id` = ?");
        $stmt->execute([$_SESSION['customer_id']]);
        $customer = $stmt->fetch();
        $order = $con->prepare("SELECT * FROM `orders` WHERE `customer_id` = ? ORDER BY `id` DESC");
        $order->execute([$customer['id']]);
        $orderCount = $order->rowCount();
        if ($orderCount > 0) {
          ?>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Order number</th>
                  <th>Date</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = $order->fetch()) {
                  $orders_number = $row['orders_number'];
                  $order_date = date("F j, Y", strtotime($row['order_date']));
                  $total_price = $row['subtotal'];
                  ?>
                  <tr>
                    <td>
                      <?php echo $orders_number ?>
                    </td>
                    <td>
                      <?php echo $order_date ?>
                    </td>
                    <td>
                      <?php echo number_format($total_price, 2) . '&nbsp;' . $row['currency']; ?>
                    </td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="text-bg-light">
                <tr>
                  <th>Order details</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $order->execute([$customer['id']]);
                while ($row = $order->fetch()) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $row['product_name'] . ' x ' . $row['product_quantity'] ?>
                    </td>
                    <td>
                      <?php echo number_format($row['subtotal'], 2) . '&nbsp;' . $row['currency']; ?>
                    </td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <?php
        } else {
          ?>
          <div class="container">
            <div class="alert alert-warning text-center mt-5" role="alert">
              No orders found for this customer.
            </div>
          </div>
          <?php
        }
      } else {
        header('location: cart.php');
        exit();
      }
      ?>
    </div>
  </div>
  <?php
} elseif ($do == 'add-cart') {
  if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $Details = $con->prepare("SELECT * FROM `products` WHERE `id` = ? LIMIT 1");
    $Details->execute([$id]);
    $cart = $Details->fetch(PDO::FETCH_ASSOC);
    $product_id = $cart['id'];
    $product_name = $cart['name_product'];
    $product_price = $cart['price_product'];
    $cart_item = array(
      'id' => $product_id,
      'product_name' => $product_name,
      'quantity' => $quantity,
      'product_price' => $product_price
    );
    $_SESSION['cart'][] = $cart_item;
    show_message('Add ' . $product_name . ' to cart successfully.', 'success');
    header('location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    header('location: index.php');
    exit();
  }
} elseif ($do == 'remove-product') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $con->prepare("SELECT * FROM `products` WHERE `id` = ? LIMIT 1");
    $name->execute([$id]);
    $cart = $name->fetch(PDO::FETCH_ASSOC);
    $products = $cart['name_product'];
    foreach ($_SESSION['cart'] as $key => $item) {
      if ($item['id'] == $id) {
        unset($_SESSION['cart'][$key]);
        break;
      }
    }
    show_message('Remove ' . $products . ' from cart successfully.', 'success');
    header('location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    header('location: index.php');
    exit();
  }
} else {
}
include $tpl . 'footer.php';
