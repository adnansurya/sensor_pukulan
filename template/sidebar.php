<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-text mx-3"><span class="material-symbols-outlined">sports_mma</span>Boxing App</div>

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
    </li>

    <!-- Nav Item - Dashboard -->
    <?php
    if (isset($_SESSION['id_role'])) {
        if ($_SESSION['id_role'] == 1) {
            echo ' <li class="nav-item">
                        <a class="nav-link" href="users.php">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Users</span></a>
                    </li>';
        }
    }
    ?>
    <li class="nav-item">
        <a class="nav-link" href="data_record.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Record</span></a>
    </li>

    <!-- Nav Item - Dashboard -->
   

    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div> -->

</ul>