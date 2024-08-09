<?php
    $user = $_SESSION['users'];
?>

<!-- sidebar.php -->
<div class="dashboard_sidebar" id="dashboard_sidebar" style="height: 1000vh;">
    <h3 class="dashboard_logo" id="dashboard_logo">SPMS</h3>
    <div class="dashboard_sidebar_user">
        <?php if(isset($user['first_name'], $user['last_name'])): ?>
            <span><?= $user['first_name'] . ' ' . $user['last_name'] ?></span>
        <?php endif; ?>
    </div>
    <div class="dashboard_sidebar_menus"></div>
    <ul class="dashboard_menu_lists">

    <!--class="menuActive"-->
        <li class="liMainMenu">
            <a href="dashboard.php"><i class="fa fa-dashboard"></i><span class="menuText"> Dashboard</span></a>
        </li>
        <li class="liMainMenu">
            <a href="javascript:void(0);"class="showHideSubMenu">
                <i class="fa fa-tag showHideSubMenu"></i>
                <span class="menuText showHideSubMenu"> Products</span>
            <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
        </a>
            <ul class ="subMenus" id="user">
                <li><a class ="subMenuLink" href="product_view.php"><i class ="fa fa-circle-o"></i>View Products </a></i>
                <li><a class ="subMenuLink" href="product_add.php"><i class ="fa fa-circle-o"></i>Add Products </a></i>
            </ul>
        </li>
        <li class="liMainMenu ">
            <a href="javascript:void(0);"class="showHideSubMenu">
                <i class="fa fa-truck showHideSubMenu"></i>
                <span class="menuText showHideSubMenu"> Suppliers</span>
            <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
        </a>
            <ul class ="subMenus" id="user">
                <li><a class ="subMenuLink" href="supplier_view.php"><i class ="fa fa-circle-o"></i>View Suppliers </a></i>
                <li><a class ="subMenuLink" href="supplier_add.php"><i class ="fa fa-circle-o"></i>Add Suppliers </a></i>
            </ul>
        </li>
        <li class="liMainMenu showHideSubMenu">
            <a href="javascript:void(0);"class="showHideSubMenu">
                <i class="fa fa-user-plus showHideSubMenu"></i>
                <span class="menuText showHideSubMenu"> Users</span>
            <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
        </a>
            <ul class ="subMenus" id="user">
                <li><a class ="subMenuLink" href="user_view.php"><i class ="fa fa-circle-o"></i>View Users </a></i>
                <li><a class ="subMenuLink" href="user_add.php"><i class ="fa fa-circle-o"></i>Add Users </a></i>
            </ul>
        </li>
    </ul>
</div>