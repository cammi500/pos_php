<?php
require '../init.php';

$product_slug =$_GET['product_slug'];
$product =getOne("select id,total_quantity from product where slug=?",[$product_slug]);
// var_dump('$product')
if($_SERVER['REQUEST_METHOD'] =="POST"){
  $req =$_REQUEST;
  $buy_price =$req['buy_price'];
  $total_quantity =$req['total_quantity'];
  $buy_date=$req['buy_date'];

  query("insert into product_buy (product_id,buy_price,total_quantity,buy_date) values (?,?,?,?)",[
    $product->id,$buy_price,$total_quantity,$buy_date
  ]);

  // $total_qty = $product->total_quantity + $total_quantity;
  $total_qty = intval($product->total_quantity) + intval($total_quantity);

  query("update product set total_quantity=$total_qty where slug='$product_slug'");
  setMsg("product buy");
  go('create.php?product_slug='.$product_slug);
  die();
}
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
        <form action="" method="POST">
            <div class="form-group">
                <label>Enter Buy Price</label>
                <input type="number" class="form-control" name="buy_price" >
            </div>
            <div class="form-group">
                <label>Enter Total Quantity</label>
                <input type="number" class="form-control" name="total_quantity" >
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