<?php
$obj_adminBack = new adminBack();

$ctg_data = $obj_adminBack->display_pdt();

//========== Category Publish and Unpublish ===============//

if(isset($_REQUEST['operation'])){
    $operation = $_REQUEST['operation'];
    $id = $_REQUEST['id'];
    if($operation == 'publish'){

        $obj_adminBack->product_publish($id);
        
    }elseif($operation == 'unpublish'){

        $obj_adminBack->product_unpublish($id);
    }elseif($operation == 'delete'){

       $msg = $obj_adminBack->delete_product($id);

    }
}


?>
<h2>Manage Product</h2>
<?php if(isset($msg)){
    echo $msg;  
}   ?>


<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Product id</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th style="white-space: normal !important;" >Product Description</th>
            <th>Product ctg</th>
            <th>Product Image</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

    <?php 

        while($data = mysqli_fetch_assoc($ctg_data)){
            $id = $data['id'];
    ?>    
            <tr>
                <td><?php echo $data['id'] ?></td>
                <td><?php echo $data['pdt_name'] ?></td>
                <td><?php echo $data['pdt_price'] ?></td>
                <td style="white-space: normal !important;"><?php echo $data['pdt_des'] ?></td>
                <td><?php echo $data['ctg_name'] ?></td>
                <td><img class="w-50 rounded" src="upload/<?php echo $data['pdt_img'] ?>" alt=""></td>
                
                
                <td><?php
                
                    $status = $data['pdt_status'] ;

                    if($status == 1){
                        echo "<a href='?operation=unpublish&id=$id' class='btn btn-sm btn-primary'>Publish</a>";
                    }elseif($status == 0){
                        
                        echo "<a href='?operation=publish&id=$id' class='btn btn-sm btn-warning'>Unpublish</a>";
                    }                
                    ?>
                
                
                </td>
                <td>
                    <a href="edit-product.php?id=<?php echo $id ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="?operation=delete&id=<?php echo $id ?>" onclick="return confirm('Are you sure?');" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>

    <?php
        }
    ?>
    </tbody>
</table>