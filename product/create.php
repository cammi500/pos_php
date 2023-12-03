<?php

require '../init.php';

if(!isset($_SESSION['user'])){
  setError('Please login first');
  go('login.php');
}
$category =getAll("select * from category");
if($_SERVER["REQUEST_METHOD"] == 'POST'){

    // print_r($_REQUEST);
    $category_id =$_REQUEST['category_id'];
    $slug =$_REQUEST['name'];
    $name =$_REQUEST['name'];
    $description =$_REQUEST['description'];
    $total_quantity =$_REQUEST['total_quantity'];
    $sale_price =$_REQUEST['sale_price'];
    $buy_price =$_REQUEST['buy_price'];
    // $buy_date =$_REQUEST['buy_date'];
    // $buy_date =$_REQUEST['buy_date'];
    $buy_date = isset($_REQUEST['buy_date']) ;

    $file =$_FILES['image'];
    if(empty($file['name'])){
        setError("Please Choose a file");
    }else{
        $file_limit_size =1024 * 1024 * 1;
        $file_size = $file['size'];
        if($file_limit_size < $file_size){
            setError("Image size must be below 2mb");
        }
        //image upload
        $file_name =slug($file['name']);
        $file_path ="../image/" . $file_name;
        $tmp =$file['tmp_name'];
        move_uploaded_file($tmp,$file_path);
        //save to product
        query(
            'insert into product (category_id,slug,name,description,image,total_quantity,sale_price) values (?,?,?,?,?,?,?)',
            [$category_id,$slug,$name,$description,$file_name,$total_quantity,$sale_price]
        );
        $product_id =$conn->lastInsertId();
        //echo $product_id;

        //save to product buy
        query(
            'INSERT INTO product_buy (product_id, buy_price, total_quantity, buy_date) VALUES (?, ?, ?, ?)',
            [$product_id, $buy_price, $total_quantity, $buy_date]
        );
        
        setMsg('product Created successfully');
        go('index.php');
    }
}
require '../include/header.php';

?>

 <!-- Breadcamp -->
 <div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Category</h4>
          > All
        </span>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container-fluid pr-5 pl-5 mt-3" >
    <div class="card">
      <div class="card-body">
        <a href="index.php" class="btn btn-sm btn-warning">All</a>
        <?php showError();
        ?>
            <form action="" class="mt-3 row" method="POST" enctype="multipart/form-data">
                <div class="col-6">
                    <h4 class="text-white">Product Info</h4>
                    <!-- category -->
                    <div class="form-group">
                        <label>Choose Category</label>
                        <select name="category_id" id="category" class="form-control">
                            <?php
                            foreach($category as $c){
                                echo "
                                <option value='{$c->id}'>{$c->name}</option>
                                ";
                            }
                            ?>
                           
                        </select>
                    </div>
                    <!-- name -->
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <!-- image-->
                <div class="form-group">
                    <label>Choose Image</label>
                    <input type="file" class="form-control" name="image" id="">
                </div>
                <!-- desc -->
                <div class="form-group">
                    <label for="">Enter Description</label>
                    <textarea name="description" class="form-control" ></textarea>
                </div>
                </div>
                
                <div class="col-6">
                    <h4 class="text-white">Inventory Info</h4>
                    <span class="text-primary">
                        <span class="fas fa-info-circle text-blue">
                            For sale Info
                        </span>
                   </span>    
                        <!-- name -->
                        <div class="form-group">
                            <label for="">Sale Price</label>
                            <input type="number" class="form-control" name="sale_price" >
                        </div>
                   <!-- sale price -->
                   <div class="form-group">
                   <span class="fas fa-info-circle text-blue">
                            For buy price
                        </span>
                        <div class="">
                            <label>Total Quantity</label>
                            <input type="number" class="form-control" name="total_quantity">
                        </div>
                   </div>
                    <!-- buy price -->
                    <div class="form-group">
                        <label>Buy Price</label>
                        <input type="number" class="form-control" name="buy_price" id="">
                    </div>
                    <!-- buy date -->
                    <div class="form-group">
                        <label>Buy Date</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" name="buy_date" id="">

                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" value="create" class="btn btn-warning">
                </div>
            </form>
      </div>
    </div>
  </div>


<?php
require '../include/footer.php';

?>