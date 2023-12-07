<?php
require '../init.php';
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
        <form action="">
            <div class="form-group">
                <label>Enter Buy Price</label>
                <input type="number" class="form-control" name="buy_price" >
            </div>
            <div class="form-group">
                <label>Enter Total Quantity</label>
                <input type="number" class="form-control" name="buy_quantity" >
            </div>
            <div class="form-group">
                <label>Enter Buy Date</label>
                <input type="date"  value="<?php echo date('Y-m-d')?>" class="form-control" name="buy_date" >
            </div>
            <input type="submit" value="Create" class="btn btn-warning" />
        </form>
      </div>
    </div>
    </div>
<?php
require '../include/footer.php';
?>