<?php
$obj_adminBack = new adminBack();

$ctg_data = $obj_adminBack->display_ctg();

//========== Category Publish and Unpublish ===============//

if(isset($_REQUEST['operation'])){
    $operation = $_REQUEST['operation'];
    $id = $_REQUEST['id'];
    if($operation == 'publish'){

        $obj_adminBack->category_publish($id);
        
    }elseif($operation == 'unpublish'){

        $obj_adminBack->category_unpublish($id);
    }elseif($operation == 'delete'){

       $msg = $obj_adminBack->delete_category($id);

    }
}


?>
<h2>Manage Category</h2>
<?php if(isset($msg)){
    echo $msg;  
}   ?>


<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>category id</th>
            <th>category Name</th>
            <th>category Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

    <?php 

        while($data = mysqli_fetch_assoc($ctg_data)){
            $id = $data['ctg_id'];
    ?>    
            <tr>
                <td><?php echo $data['ctg_id'] ?></td>
                <td><?php echo $data['ctg_name'] ?></td>
                <td><?php echo $data['ctg_des'] ?></td>
                <td><?php
                
                    $status = $data['ctg_status'] ;

                    if($status == 1){
                        echo "<a href='?operation=unpublish&id=$id' class='btn btn-sm btn-primary'>Publish</a>";
                    }elseif($status == 0){
                        
                        echo "<a href='?operation=publish&id=$id' class='btn btn-sm btn-warning'>Unpublish</a>";
                    }                
                    ?>
                
                
                </td>
                <td>
                    <a href="edit-cat.php?id=<?php echo $id ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="?operation=delete&id=<?php echo $id ?>" onclick="return confirm('Are you sure?');" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>

    <?php
        }
    ?>
    </tbody>
</table>