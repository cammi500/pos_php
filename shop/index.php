<?php
require '../init.php';

$shop =getAll("select * from manage_shop order by id desc limit 2");
print_r($shop);

require '../include/header.php'
?>


<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Shop</h4>
          > All
        </span>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">All shop</div>
          
        </div>
      </div>
    </div>
  </div>


   <!-- Content -->
   <div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
      <div class="card-body">
        <?php
        showError();
        showMsg(); ?>
      <table class="table table-striped text-white mt-2" >
        <thead>
            <tr>
                <td>name</td>
                <td>option</td>
            </tr>
        </thead>
        <tbody id="tblData">
          <?php 
          foreach($shop as $s){
            ?>
              <tr>
                <td>
                    <?php echo $s->name ?>
                </td>
                <td>
                    <a href="" class="btn btn-sm btn-danger">
                    <span class="fa fa-edit"></span>
                    </a>
                    <a onclick="return confirm('Sure to delete')"  class="btn btn-sm btn-primary">
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
        <button type="button" class="btn btn-warning" id="btnFetch">
          <span class="fas fa-arrow-down"></span>
        </button>
      </div>
      </div>
    </div>
  </div>
<?php
require '../include/footer.php'
?>