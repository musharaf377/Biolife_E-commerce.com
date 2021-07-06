<?php

class adminBack{
    public $conn;
    public function __construct()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "e-commerce_oop";

        $this->conn = mysqli_connect("$dbhost","$dbuser","$dbpass","$dbname");

        if(!$this->conn){
            die("Connection Error.");
        }
    }

    function admin_login($data){

        $admin_email = $data['email'];
        $admin_pass = md5($data['password']);

        $sql = "SELECT * FROM admin_login  WHERE `admin_email` = '$admin_email' AND `admin_pass` = '$admin_pass'";

        if( $result = mysqli_query($this->conn, $sql)){
            $admin_info = mysqli_fetch_assoc($result);

            if($admin_info){
                header("location:dashboard.php");
                session_start();
                $_SESSION['id'] = $admin_info['id'];
                $_SESSION['admin_email'] = $admin_info['admin_email'];
            }else{
                $error_msg = "Your Email Or Password is not correct.";
                return $error_msg;
            }
        }


    }

    public function adminLogout()
    {
        unset($_SESSION['id']);
        unset( $_SESSION['admin_email']);
        header("location:index.php");
    }

    //============ Add Category =================//
    public function add_category($data)
    {
        $ctg_name = $data['ctg_name'];
        $ctg_des = $data['ctg_des'];
        $ctg_status = $data['ctg_status'];
        
        $query = "INSERT INTO `category`(`ctg_name`, `ctg_des`, `ctg_status`) VALUES ('$ctg_name','$ctg_des','$ctg_status')";

        if(mysqli_query($this->conn, $query)){
            $message = "Category added successfully.";
            return $message;            
        }else{
            $message = "category not added.";
            return $message;
        }
    }

     //============ Category publish ==============//
     public function category_publish($id)
     {
         $sql = "UPDATE `category` SET `ctg_status` = 1 WHERE `ctg_id` = $id";
         mysqli_query($this->conn, $sql);
        }
     //============ Category Unpublish=============//
     
     public function category_unpublish($id)
     {
         $sql = mysqli_query($this->conn, "UPDATE `category` SET `ctg_status` = 0 WHERE `ctg_id` = $id");
         mysqli_query($this->conn, $sql);
        }
     
     
     //============ Category show ===========//

    public function display_ctg()
    {
        $query = "SELECT * FROM category";
        
        if($data = mysqli_query($this->conn, $query)){
            return $data;
        }
    }

    public function p_display_ctg()
    {
        $query = "SELECT * FROM category WHERE `ctg_status` = 1 ";
        
        if($data = mysqli_query($this->conn, $query)){
            return $data;
        }
    }

    //================ Delete Category =============//

    public function delete_category($id)
    {
        $query = mysqli_query($this->conn, "DELETE FROM `category` WHERE `ctg_id` = $id");

        if($query){
            $msg = "Delete successfully.";
            return $msg;
        }
    }

    //============= show category ==========//
    public function select_data($id)
    {
        $query = mysqli_query($this->conn, "SELECT * FROM category WHERE  `ctg_id` = '$id'");
        if($query){

            return $row = mysqli_fetch_assoc($query);
        }
    }
    //============= update Category ===========//
    public function update_category($data)
    {
        $id = $data['ctg_id'];
        $ctg_name = $data['ctg_name'];
        $ctg_des = $data['ctg_des'];

        $query = mysqli_query($this->conn,"UPDATE `category` SET `ctg_name`= '$ctg_name' ,`ctg_des`= '$ctg_des' WHERE `ctg_id`= '$id'");
        if($query){
            return $msg = "<h4 class='text-success'>Category Update successfully.</h4>";
        }
    }

    //============== Add Product ===========//
    public function add_product($data)
    {
        $pdt_name   = $data['pdt_name'];
        $pdt_price  = $data['pdt_price'];
        $pdt_des    = $data['pdt_des'];
        $pdt_ctg    = $data['pdt_ctg'];
        $pdt_status = $data['pdt_status'];
        $pdt_image  = $_FILES['pdt_img'];

        $image_name = $pdt_image['name'];
        $tmp_name = $pdt_image['tmp_name'];
        $img_size = $pdt_image['size'];
        $pdt_ext = pathinfo($image_name, PATHINFO_EXTENSION);

        $rand_name = rand('11111', '999999').'.jpg';
        $location = 'upload/'. $rand_name;

        if($pdt_ext == 'jpg' or $pdt_ext == 'png' or $pdt_ext == 'jpeg'){
            if($img_size <= 2097152){

                $query = mysqli_query($this->conn, "INSERT INTO `products`(`pdt_name`, `pdt_price`, `pdt_des`, `pdt_ctg`, `pdt_img`, `pdt_status`) VALUES ('$pdt_name', '$pdt_price', '$pdt_des', '$pdt_ctg', '$rand_name', '$pdt_status')");

                if($query){
                    move_uploaded_file($tmp_name, $location);
                    $msg = "Product added successfully.";
                    return $msg;
                }
                
            }else{
                $msg = "Your file size must be less or equal 2 MB";
                return $msg;
            }

        }else{
            $msg = "Your file must be a jpg or png format.";
            return $msg;
        }

        
    }

    //============== Product Show ============//
    public function display_pdt()
    {
        $query = "SELECT * FROM product_info_ctg";
        
        if($data = mysqli_query($this->conn, $query)){
            return $data;
        }
    }

    //============== Product delete =============//

    public function delete_product($id)
    {
        $query = mysqli_query($this->conn, "DELETE FROM `products` WHERE `id` = $id");

        if($query){
            $msg = "Delete successfully.";
            return $msg;
        }
    }

    //============ product publish ==============//
    public function product_publish($id)
    {
        $sql = "UPDATE `products` SET `pdt_status` = 1 WHERE `id` = $id";
        mysqli_query($this->conn, $sql);
    }
    //============ product Unpublish=============//
    
    public function product_unpublish($id)
    {
        $sql = mysqli_query($this->conn, "UPDATE `products` SET `pdt_status` = 0 WHERE `id` = $id");
        mysqli_query($this->conn, $sql);
    }

    //============ Product Edit ===========//
    public function product_edit($id)
    {
        
        $query = mysqli_query($this->conn, "SELECT * FROM `product_info_ctg` WHERE `id` = '$id'");
        $fetch_data = mysqli_fetch_assoc($query);
        return $fetch_data;
    }
    //=========== Product Update =============//
   
    public function product_update($data)
    {   
        $pdt_id    = $data['product_id'];
        $pdt_name  = $data['pdt_name'];
        $pdt_price = $data['pdt_price'];
        $pdt_des   = $data['pdt_des'];
        $pdt_ctg   = $data['pdt_ctg'];
        // $pdt_status = $data['pdt_status'];
        $pdt_image  = $_FILES['pdt_img'];

        $image_name = $pdt_image['name'];
        $tmp_name   = $pdt_image['tmp_name'];
        $img_size   = $pdt_image['size'];
        $pdt_ext    = pathinfo($image_name, PATHINFO_EXTENSION);

        $rand_name = rand('11111', '999999').'.jpg';
        $location  = 'upload/'. $rand_name;

        if($pdt_ext == 'jpg' or $pdt_ext == 'png' or $pdt_ext == 'jpeg'){
            if($img_size <= 2097152){

                $query = "UPDATE `products` SET `pdt_name`= '$pdt_name' ,`pdt_price`= '$pdt_price',`pdt_des`= '$pdt_des',`pdt_ctg`= '$pdt_ctg', `pdt_img`= '$rand_name'  WHERE `id` ='$pdt_id'";

                $result = mysqli_query($this->conn, $query);
                if($result){
                    move_uploaded_file($tmp_name, $location);
                    $msg = "Product added successfully.";
                    return $msg;
                }
                
            }else{
                $msg = "Your file size must be less or equal 2 MB";
                return $msg;
            }

        }else{
            $msg = "Your file must be a jpg or png format.";
            return $msg;
        }

        
    }

    //=========== product by category show ==========//

    public function product_by_cat($id)
    {
        $query =  "SELECT * FROM `product_info_ctg` WHERE `ctg_id` = '$id' ";

        if($fetch = mysqli_query($this->conn, $query)){
            return $fetch;
        }
    }

     //=========== product by id show ==========//

     public function product_by_id($id)
     {
         $query =  "SELECT * FROM `product_info_ctg` WHERE `id` = '$id' ";
 
         if($fetch = mysqli_query($this->conn, $query)){
             return $fetch;
         }
     }

     //============== category related product show =========//
     public function related_product($id)
     {
         
        $query = mysqli_query($this->conn,"SELECT * FROM `product_info_ctg` WHERE `ctg_id` = '$id' ORDER BY ctg_id DESC LIMIT 4 ") ;
        
        return $query;


    } 
    //============== category related product show =========//
     public function cat_by_id($id)
     {
         
        $query = mysqli_query($this->conn,"SELECT * FROM `product_info_ctg` WHERE `ctg_id` = '$id' ") ;
        
        $cat_data = mysqli_fetch_assoc($query);
        return $cat_data;

    }

     
}



?>
