<?php

require '../init.php';
if(!isset($_SESSION['user'])){
  setError('Please login first');
  go('login.php');
}

//check Category
if(isset($_GET['slug'])){
  $slug= $_GET['slug'];
  $category =getOne("select * from category where slug=?",[$slug]);
  //if a mistake 
  if(!$category){
    setError('category not found');
    go('index.php');
    die();
  }
}else{
  setError('Category not found');
  go('index.php');
  die();
}
//update category
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $slug = $_GET['slug'];
  $name =$_REQUEST['name'];
  query("update category set name=?,slug=? where slug=?",[$name,slug($name),$slug]);
  go('index.php');
}

require '../include/header.php';

?>

 <!-- Breadcamp -->
 <div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Category</h4>
        </span>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
      <div class="card-body">
        <a href="<?php echo $root .'category/index.php'?>" class="btn btn-sm btn-warning">Create</a>
        
        <?php
        showError();
        showMsg();
        ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="category">Enter name</label>
                    <br>
                    <input type="text>" name="name" value="<?php echo $category->name; ?>" class="form-control">
                </div>
                <input type="submit" value="Update" class="btn btn-sm btn-warning">
            </form>
      </div>
    </div>
  </div>


<?php
require '../include/footer.php';

?>