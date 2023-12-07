<?php
require '../init.php';
$product_slug =$_GET['product_slug'];
require '../include/header.php';
?>

<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Product Buy</h4>
          > All
        </span>
      </div>
    </div>
  </div>

    <!-- Content -->
    <div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
      <div class="card-body">
        <a href="create.php?product_slug=<?php echo $product_slug?>" class="btn btn-warning ">Create</a>
        <table class="table table-striped">
          <tr>
            <td>Buy Price</td>
            <td>Buy Quantity</td>
            <td>Buy Date</td>
            <td>Option</td>
          </tr>
        </table>
      </div>
    </div>
    </div>
<?php
require '../include/footer.php';
?>