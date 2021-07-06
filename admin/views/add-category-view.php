<?php 

  $obj_adminBack = new adminBack;
  if(isset($_POST['submit'])){
      $return_message = $obj_adminBack->add_category($_POST);
  }  

  if(isset($return_message)){
      echo $return_message;
  }
?>

<h1>Add Category</h1>
<form action="" method="post">
    <div class="form-group">
        <label for="ctg-name">Category Name</label>
        <input class="form-control" type="text" name="ctg_name" placeholder="Category Name" id="ctg-name">
    </div>
    <div class="form-group">
        <label for="ctg-des">Category Description</label>
        <input class="form-control" type="text" name="ctg_des" placeholder="Description" id="ctg-name">
    </div>
    <div class="form-group">
        <label for="ctg-status">Category Status</label>
        <select class="form-group form-control" name="ctg_status" id="">
            <option value="0">Unpublish</option>
            <option value="1">Publish</option>
        </select>
    </div>
    <input type="submit" class="btn btn-primary" name="submit" id="" value="Add Category">
</form>