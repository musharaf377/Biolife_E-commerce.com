<?php

    $obj_adminBack = new adminBack();

    //============ Select Data ===========//
    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

       $data =  $obj_adminBack->select_data($id);

    }
    
    //============ update data ============//
    if(isset($_POST['submit'])){
        $return_msg = $obj_adminBack->update_category($_POST);

    }


?>


<h1>Edit Category</h1>
<?php
    if(isset($return_msg)){
        echo $return_msg;
    }

    if(isset($return_msg)){
        echo $return_msg;
    }
?>
<form action="" method="POST">

    <div class="form-group">
        <label for="">Category Name</label>
        <input class="form-control" type="text" value="<?php echo $data['ctg_name'] ?>" name="ctg_name" id="">
    </div>

        <input class="form-control" type="hidden" value="<?php echo $data['ctg_id'] ?>" name="ctg_id" id="">

    <div class="form-group">
        <label for="">Category Description</label>
        <input class="form-control" value="<?php echo $data['ctg_des'] ?>" type="text" name="ctg_des" id="">
    </div>

    <input class="btn btn-success" type="submit" name="submit" value="Update" id="">
</form>