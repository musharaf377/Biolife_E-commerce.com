
<?php require_once "includes/head.php";
      require_once "Class/adminBack.php";

    session_start();
    $adminID = $_SESSION['id'];
    $adminEmail = $_SESSION['admin_email'];
    if($adminID == null){
        header("location:index.php");
    }

    if(isset($_GET['adminLogout']) == 'logout'){

        $obj_admin_logout = new adminBack;

        $obj_admin_logout->adminLogout();
    }

?> 

<body>

    <body>
        <div class="fixed-button">
            <a href="https://codedthemes.com/item/gradient-able-admin-template" target="_blank"
                class="btn btn-md btn-primary">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Upgrade To Pro
            </a>
        </div>
        <!-- Pre-loader start -->
        <div class="theme-loader">
            <div class="loader-track">
                <div class="loader-bar"></div>
            </div>
        </div>
        <!-- Pre-loader end -->
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">

                <?php require_once "includes/header-nav.php"; ?>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <?php require_once "includes/sidenav.php" ?>
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">

                                        <div class="page-body">
                                         
                                            <?php 
                                            
                                            if($views){
                                                if($views == 'dashboard'){
                                                    require_once 'views/dashboard-view.php';
                                                }elseif($views == 'add-category'){
                                                    require_once "views/add-category-view.php";
                                                }elseif($views == 'manage-category'){
                                                    require_once "views/manage-category-view.php";
                                                }elseif($views == 'edit-cat'){
                                                    require_once "views/edit-category-view.php";
                                                }elseif($views == 'add-product'){
                                                    require_once "views/add-product-view.php";
                                                }elseif($views == 'manage-product'){
                                                    require_once "views/manage-product-view.php";
                                                }elseif($views == 'edit-product'){
                                                    require_once "views/edit-product-view.php";
                                                }

                                            }
                                            
                                            ?>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php require_once "includes/footer.php" ?>