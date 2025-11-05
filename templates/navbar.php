<?php
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<div class="container">
  <nav class="navbar navbar-expand-lg bg-body-tertiary text-uppercase">
  <div class="container m-3">
    <a class="navbar-brand h1" href="./index.php"><?php echo $lang['Romance in Blooms'] ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#MyNavbar" aria-controls="MyNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="MyNavbar">
      <form class="d-flex btn-search" role="search" action="search.php" method="GET">
        <div class="input-group">
          <input class="form-control" type="search" name="q" placeholder="<?php echo $lang['Search'] ?>" aria-label="Search" required="required" />
          <button class="btn btn-outline-dark" type="submit" disabled><?php echo $lang['Search'] ?></button>
        </div>
      </form>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php foreach ($navbarItems as $itemName => $itemLink) : ?>
          <li class="nav-item">
            <a class="nav-link <?php pageActive($pageTitle, $itemName); ?>" href="<?php echo $itemLink; ?>"><?php echo $lang[$itemName]; ?></a>
          </li>
        <?php endforeach; ?>
        <li class="nav-item">
          <a class="btn btn-light position-relative" href="cart.php">
            <i class="fas fa-shopping-cart"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
              <?php echo $cartCount; ?>
              <span class="visually-hidden">unread messages</span>
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="btn btn-light" href="./admin/index.php">
            <i class="fas fa-user mx-3"></i>Login as Admin
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>