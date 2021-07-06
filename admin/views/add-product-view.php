<?php 

$obj_adminBack = new adminBack();
$ctg_info = $obj_adminBack->p_display_ctg();

if(isset($_POST['submit'])){
    $return_msg = $obj_adminBack->add_product($_POST);
}

?>


<h1>Add Product</h1>

<?php
    if(isset($return_msg)){
        echo $return_msg;
    }

?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="ctg-name">Product Name</label>
        <input class="form-control" type="text" name="pdt_name" placeholder="Product Name" id="ctg-name">
    </div>

    <div class="form-group">
        <label for="ctg-name">Product Price</label>
        <input class="form-control" type="number" name="pdt_price" placeholder="Product Price" id="ctg-name">
    </div>

    <div class="form-group">
        <label for="ctg-name">Product Description</label>
        <textarea class="form-control" name="pdt_des" rows="3" placeholder="Product Description" id="ctg-name"></textarea>
    </div>

    <div class="form-group">
        <label for="ctg-name">Product Category</label>
        <select class="form-control" name="pdt_ctg" id="">
            <option>Please Select your category</option>
            <?php while($ctg = mysqli_fetch_assoc($ctg_info)){ ?>
            <option value="<?php echo $ctg['ctg_id'] ; ?>"><?php echo $ctg['ctg_name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="ctg-name">Product Image</label>
        <input class="form-control" type="file" name="pdt_img" placeholder="Product Price" id="ctg-name">
    </div>

    <div class="form-group">
        <label for="ctg-status">Product Status</label>
        <select class="form-group form-control" name="pdt_status" id="">
            <option value="0">Unpublish</option>
            <option value="1">Publish</option>
        </select>
    </div>

    <input type="submit" class="btn btn-primary" name="submit" value="Add Product" id="">

</form>