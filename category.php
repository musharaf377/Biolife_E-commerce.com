<?php
    include "admin/Class/adminBack.php"; 
    $obj_adminBack = new adminBack();

    $ctg = $obj_adminBack->p_display_ctg();

    $ctgDatas = array();

    while($data = mysqli_fetch_assoc($ctg)){
        $ctgDatas[] = $data;
    }

    if(isset($_GET['status'])){
        $status = $_GET['status'];
        $catId = $_GET['id'];
        if($status == 'catView'){
        $cat_data = $obj_adminBack->product_by_cat($catId);
        $cat_by_datas = array();
        
        while($pro_data = mysqli_fetch_assoc($cat_data)){

            $cat_by_datas[] = $pro_data;
        }
        
        }
    }
    
    if(isset($_GET['status'])){
        $status = $_GET['status'];
        $catId = $_GET['id'];
        if($status == 'catView'){
        $cat_data = $obj_adminBack->cat_by_id($catId);
            
        
        
        }
    }



?>

<?php include_once "include/head.php"; ?>

<body class="biolife-body">
    <!-- Preloader -->
    <?php include_once "include/preload.php"; ?>
    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-03">
        <?php include_once "include/header_top.php"; ?>
        <?php include_once "include/header_middle.php"; ?>
        <?php include_once "include/header_bottom.php"; ?>
    </header>
    <!-- Page Contain -->
    <div class="page-contain">
        <!-- Main content -->
        <div id="main-content" class="main-content">

            <!--Hero Section-->
            <div class="hero-section hero-background">
                <h1 class="page-title">
                    <?php 
                          echo $cat_data['ctg_name'];
                     ?>
                </h1>
            </div>

            <!--Navigation section-->
            <div class="container">
                <nav class="biolife-nav">
                    <ul>
                        <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                        <li class="nav-item"><span class="current-page">
                        <?php 
                          echo $cat_data['ctg_name'];
                        ?>
                            </span></li>
                            
                    </ul>
                </nav>
            </div>
            <div class="container">
                <div class="page-contain category-page no-sidebar">
                    <div class="container">
                        <div class="row">

                            <!-- Main content -->
                            <div id="main-content" class="main-content col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="product-category grid-style">
                                    <div class="row">
                                        <ul class="products-list">

                                        <?php foreach($cat_by_datas as $cat_by_data){
                                            
                                            ?>

                                        

                                            <li class="product-item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                                <div class="contain-product layout-default">
                                                    <div class="product-thumb">
                                                        <a href="single_product.php?status=singleproduct&id=<?php echo $cat_by_data['id']; ?>" class="link-to-product">
                                                            <img src="admin/upload/<?php echo $cat_by_data['pdt_img'] ?>" alt="dd"
                                                                width="270" height="270" class="product-thumnail">
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <b class="categories"><?php echo $cat_by_data['ctg_name'] ?></b>
                                                        <h4 class="product-title"><a href="single_product.php?status=singleproduct&id=<?php echo $cat_by_data['id']; ?>" class="pr-name"><?php echo $cat_by_data['pdt_name']; ?>
                                                                </a></h4>
                                                        <div class="price">
                                                            <ins><span class="price-amount"><span
                                                                        class="currencySymbol">£</span><?php echo $cat_by_data['pdt_price'] ?></span></ins>
                                                           
                                                        </div>
                                                        <div class="shipping-info">
                                                            <p class="shipping-day">3-Day Shipping</p>
                                                            <p class="for-today">Pree Pickup Today</p>
                                                        </div>
                                                        <div class="slide-down-box">
                                                            <p class="message">All products are carefully selected to
                                                                ensure food safety.</p>
                                                            <div class="buttons">
                                                                <a href="#" class="btn wishlist-btn"><i
                                                                        class="fa fa-heart" aria-hidden="true"></i></a>
                                                                <a href="#" class="btn add-to-cart-btn"><i
                                                                        class="fa fa-cart-arrow-down"
                                                                        aria-hidden="true"></i>add to cart</a>
                                                                <a href="single_product.php?status=singleproduct&id=<?php echo $cat_by_data['id']; ?>" class="btn compare-btn"><i
                                                                        class="fa fa-eye" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        <?php } ?>

                                        </ul>
                                    </div>

                                    <div class="biolife-panigations-block">
                                        <ul class="panigation-contain">
                                            <li><span class="current-page">1</span></li>
                                            <li><a href="#" class="link-page">2</a></li>
                                            <li><a href="#" class="link-page">3</a></li>
                                            <li><span class="sep">....</span></li>
                                            <li><a href="#" class="link-page">20</a></li>
                                            <li><a href="#" class="link-page next"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!-- FOOTER -->
        <?php include_once "include/footer.php"; ?>
        <!--Footer For Mobile-->
        <?php include_once "include/mobile_footer.php";  ?>
        <?php include_once "include/mobile_global.php";  ?>
        <!-- Scroll Top Button -->
        <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>
        <?php include_once "include/script.php"; ?>
</body>

</html>