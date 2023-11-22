<?php

require '../init.php';
if(!isset($_SESSION['user'])){
  setError('Please login first');
  go('login.php');
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
        <a href="create.php" class="btn btn-sm btn-warning">Create</a>
      <table class="table table-striped text-white mt-2">
        <thead>
            <tr>
                <td>name</td>
                <td>option</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Category name
                </td>
                <td>
                    <a href="http://" class="btn btn-sm btn-danger">
                        <span class="fa fa-trash"></span>
                    </a>
                    <a href="http://" class="btn btn-sm btn-primary">
                        <span class="fa fa-edit"></span>
                    </a>
                </td>
            </tr>
        </tbody>
      </table>
      </div>
    </div>
  </div>


<?php
require '../include/footer.php';

?>