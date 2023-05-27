<?php
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/") + 1);
  ?>




<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0   fixed-start   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">        
        <span class="ms-1 font-weight-bold text-white">City Admin</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link text-white <?= $page == 'reservations.php' ? 'active bg-gradient-primary' : "" ;?>" href="reservations.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">All Reservation</span>
          </a>
        </li>
      <li class="nav-item">
          <a class="nav-link text-white <?= $page == 'university-stays.php' ? 'active bg-gradient-primary' : "" ;?>" href="university-stays.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">university stays</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page == 'chambers.php' ? 'active bg-gradient-primary' : "" ;?>" href="chambers.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">All Chamber</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page == 'add-chamber.php' ? 'active bg-gradient-primary' : "" ;?>" href="add-chamber.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">add</i>
            </div>
            <span class="nav-link-text ms-1">Add Chamber</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page == 'add-university-stay.php' ? 'active bg-gradient-primary' : "" ;?>" href="add-university-stay.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">add</i>
            </div>
            <span class="nav-link-text ms-1">Add University Stay</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" href="../logout.php">Logout</a>
        </div>
    </div>
  </aside>