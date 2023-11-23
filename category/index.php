<?php

require '../init.php';
if(!isset($_SESSION['user'])){
  setError('Please login first');
  go('login.php');
}
//delete
if(isset($_GET['action'])){
  $slug = $_GET['slug'];
  query("delete from category where slug=?",[$slug]);
  setMsg('Category deleted');
}
//query
$category = getAll('select * from category order by id desc limit 2');
// print_r($category);

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
        <a href="create.php" class="btn btn-sm btn-warning">Create</a>
        <?php showMsg();
        showError() ?>
      <table class="table table-striped text-white mt-2">
        <thead>
            <tr>
                <td>name</td>
                <td>option</td>
            </tr>
        </thead>
        <tbody>
          <?php 
          foreach($category as $c){
            ?>
              <tr>
                <td>
                    <?php echo $c->name ?>
                </td>
                <td>
                    <a href="<?php echo $root . 'category/edit.php?slug=' .$c->slug ?>" class="btn btn-sm btn-danger">
                    <span class="fa fa-edit"></span>
                    </a>
                    <a onclick="return confirm('Sure to delete')" href="<?php echo $root . 'category/index.php?action=delete&slug=' .$c->slug ?>" class="btn btn-sm btn-primary">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>

          <?php
          }
            ?>
            
        </tbody>
      </table>

      <div class="text-center">
        <button type="button" class="btn btn-warning">
          <span class="fas fa-arrow-down"></span>
        </button>
      </div>
      </div>
    </div>
  </div>


<?php
require '../include/footer.php';

?>