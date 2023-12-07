<?php

require '../init.php';

if(!isset($_SESSION['user'])){
  setError('Please login first');
  go('login.php');
}
$category = getAll("select * from category");
if(isset($_GET['slug'])and !empty($_GET['slug'])){
    $slug = $_GET['slug'];
    $product = getOne("select * from product where slug='$slug'");
    //post method
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $request =$_REQUEST;
        $name = $request['name'];
        $category_id=$request['category_id'];
        $sale_price=$request['sale_price'];
        $description=$request['description'];
        // die($name.$category_id.$sale_price.$description);
        $file =$_FILES['image'];
        if(isset($file) and !empty($file['name'])){
            $file_limit_size = 1024 *1024 *1;
            $file_size =$file['size'];
            if($file_limit_size < $file_size){
              setError("image must be below than 1 mb");
            }
            //image uploade
            $file_name =slug($file['name']);
            $file_path ="../image/".$file_name;
            $tmp =$file['tmp_name'];
            move_uploaded_file($tmp,$file_path);
            //shi ma delete ma shi ma delete
            if(file_exists('../image/' .$product->image)){
                 //delete image
            unlink("../image/".$product->image);
            }
           
        }else{
            $file_name =$product->image;
            //exit
        }
        $sql ="
        update product set name='$name',category_id=$category_id,description='$description',image='$file_name',sale_price=$sale_price
        where slug ='$slug'
   ";
          $result = query($sql);
          if($result){
              setMsg("product update successfully");
              go('edit.php?slug=' . $product->slug);
              die();
          }else{
            setError("product update failed");
            go('edit.php?slug=' . $product->slug);
            die();
          }
      }

    //update
    //image uploaded
}else{
    setError("wrong slug ");
    go('index.php');
    die();
}
// $slug = $_GET['slug'];
// $product = getOne("select * from product where slug='$slug'");
print_r($product);
require '../include/header.php';
?>

 <!-- Breadcamp -->
 <div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Product</h4>
          ~ edit
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
        showMsg();
        ?>
            <form action="" class="mt-3 row" method="POST" enctype="multipart/form-data">
                <div class="col-12">
                    <h4 class="text-white">Product Info</h4>
                    <!-- category -->
                    <div class="form-group">
                        <label>Choose Category</label>
                        <select name="category_id" id="category" class="form-control">
                            <?php
                            foreach($category as $c){
                                $selected = $c->id == $product->category_id ?'selected':'';
                                echo "
                                <option value='{$c->id}' $selected >{$c->name}</option>
                                ";
                            }
                            ?>
                           
                        </select>
                    </div>
                    <!-- name -->
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" value="<?php echo $product->name?>" class="form-control" name="name">
                    </div>
                    <!-- image-->
                <div class="form-group">
                    <label>Choose Image</label>
                    <input type="file"  class="form-control" name="image" id="">
                            <img src="<?php echo $root . 'image/' .$product->image?>" class="img-thumbnail" width="200px" alt="" srcset="">
                </div>
                <!-- desc -->
                <div class="form-group">
                    <label for="">Enter Description</label>
                    <textarea name="description"  class="form-control" > <?php echo $product->description;?></textarea>
                </div>
                <div class="form-group">
                            <label for="">Sale Price</label>
                            <input type="number" value="<?php echo $product->sale_price;?>" class="form-control" name="sale_price" >
                        </div>
                </div>
                
                
                <div class="col-12">
                    <input type="submit" value="update" class="btn btn-warning">
                </div>
            </form>
      </div>
    </div>
  </div>


<?php
require '../include/footer.php';
?>