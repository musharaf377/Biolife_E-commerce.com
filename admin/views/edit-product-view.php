<?php
    $obj_adminBack = new adminBack();
    $ctg_info = $obj_adminBack->display_ctg();

    if(isset($_REQUEST['id'])){
        $id   = $_REQUEST['id'];
        $data = $obj_adminBack->product_edit($id);

    }

   if(isset($_POST['submit'])){
        $return_msg = $obj_adminBack->product_update($_POST);
      

        // var_dump($return_msg);
   }

?>

<h1>Edit Product</h1>
<?php
    if(isset($return_msg)){
        echo $return_msg;
    }

?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Product Name</label>
        <input class="form-control" type="text" value="<?php echo $data['pdt_name']  ?>" name="pdt_name" id="">
    </div>
        <input type="hidden" value="<?php echo $data['id']  ?>" name="product_id" >

    <div class="form-group">
        <label for="">Product Price</label>
        <input class="form-control" type="text" value="<?php echo $data['pdt_price'] ?>" name="pdt_price" id="">
    </div>

    <div class="form-group">
        <label for="">Product Description</label>
        <textarea class="form-control" rows="3" type="text" value="" name="pdt_des" id=""> <?php echo $data['pdt_des'] ?></textarea>
    </div>

    <div class="form-group">
        <label for="">Product ctg</label>
        <select class="form-control" name="pdt_ctg" id="">
            <option>Please Select your category</option>
            <?php while($ctg = mysqli_fetch_assoc($ctg_info)){ ?>
            <option selected value="<?php echo $ctg['ctg_id'] ;?>"><?php echo $ctg['ctg_name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="">Product Image</label>
        <input src="<?php echo $data['pdt_img'] ?>" class="form-control" type="file" name="pdt_img">
    </div>

    <div class="form-group">
        <label for="">Product Status</label>
        <select name="pdt_status" id="" class="form-control">
                <option value="1">publish</option>
                <option value="0">unpublish</option>
        </select>
    </div>

    <input type="submit" name="submit" value="update Product" class="btn btn-primary" id="">

</form>