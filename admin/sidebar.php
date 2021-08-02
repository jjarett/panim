<aside class="main-sidebar">
<a href="dashboard.php"><img style="margin-left: 20px; padding-bottom: 40px;" src=images/poggo.png></a>
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

  <?php

  if($_SESSION['role'] == 'ITAdmin'){

    ?>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="header">MANAGE</li>
      <li><a href="users.php"><i class="fa fa-users"></i> <span>Users</span></a></li>
      <li><a href="../../phpmyadmin/db_structure.php?server=1&db=pganim"><i class="fa fa-database"></i> <span>Database</span></a></li>
      <li class="header">OTHERS</li>
      <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
      
    </ul>

    <?php
  }

  ?>

  <?php

  if($_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Employee'){

    ?>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="header">MANAGE</li>
      <li><a href="orders.php"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
      <li><a href="customers.php"><i class="fa fa-users"></i> <span>Customers</span></a></li>
      <li><a href="products.php"><i class="fa fa-file-o"></i> <span>Product List</span></a></li>
      <li><a href="collections.php"><i class="fa fa-star"></i> <span>Collections</span></a></li>
      <li><a href="category.php"><i class="fa fa-list-alt"></i> <span>Categories</span></a></li>
      <li><a href="discountcodes.php"><i class="fa fa-percent"></i> <span>Discount Codes</span></a></li>
      <li><a href="deliveries.php"><i class="fa fa-truck"></i> <span>Deliveries</span></a></li>
      <li><a href="payments.php"><i class="fa fa-barcode"></i> <span>Payments</span></a></li>
      <li><a href="feedbacks.php"><i class="fa fa-comments-o"></i> <span>Feedbacks</span></a></li>
      <li class="header">OTHERS</li>
      <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
      
    </ul>

    <?php
  }

  ?>
  </section>
  <!-- /.sidebar -->
</aside>
