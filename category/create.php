<?php

require '../init.php';
if(!isset($_SESSION['user'])){
  setError('Please login first');
  go('login.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name =$_REQUEST['name'];
    if(empty($name)){
        setError('Please enter name');
    }
    if(!hasError()){
       $res = query("insert into category (slug,name) values (?,?)",
        [slug($name),$name]);
        if($res){
            setMsg('Category created successfully');
        }
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
  <div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
      <div class="card-body">
        <a href="create.php" class="btn btn-sm btn-warning">All</a>
        <?php
        showError();
        showMsg();
        ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="category">Enter name</label>
                    <input type="text>" name="name" placeholder="Enter name">
                </div>
                <input type="submit" value="Create" class="btn btn-sm btn-warning">
            </form>
      </div>
    </div>
  </div>


<?php
require '../include/footer.php';

?>