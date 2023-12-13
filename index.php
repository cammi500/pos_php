<?php

require 'init.php';
if(!isset($_SESSION['user'])){
  setError('Please login first');
  go('login.php');
}

$date =date('Y-m-d ');
$total_sale =getOne(
  "select sum(sale_price) as price from product_sell where date=?",[$date]
)->price;
// print_r($total_sale);
$total_buy =getOne(
  "select sum(buy_price) as price from product_buy where buy_date=?",[$date]
)->price;
// print_r($total_buy);
$net_profit =$total_sale -$total_buy;
// print_r($net_profit);

//latest sale
$latest_sale =getAll(
  "select  product_sell.*,name as product_name from product_sell
  left join product on product.id=product_sell.product_id where product_sell.date=?
  order by product_sell.id desc limit 5",
  [$date]
);
//latest buy
$latest_buy =getAll(
  "select product_buy.*,name as product_name from product_buy
  left join product on product.id=product_buy.product_id where product_buy.buy_date=?
  order by product_buy.id desc limit 5",
  [$date]
);
print_r($latest_buy);

require 'include/header.php';
// echo 'hello world again'
?>
<!-- content -->
 <div class="container-fluid pr-5 pl-5 mt-3">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-4">
          <div class="card p-4 text-center bg-success">
              <div class="">
                <h5 class="text-white">Total Sale:</h5>
                <span class="badge badge-warning"><?php echo $total_sale;?></span>
              </div>
        </div>
      </div>
      <div class="col-4">
          <div class="card p-4 text-center bg-danger">
              <div class="">
                <h5 class="text-white">Total buy:</h5>
                <span class="badge badge-warning"><?php echo $total_buy;?></span>
              </div>
        </div>
      </div>
      <div class="col-4">
          <div class="card p-4 text-center bg-primary">
              <div class="">
                <h5 class="text-white">Net Income:</h5>
                <span class="badge badge-warning"><?php echo $net_profit?></span>
              </div>
        </div>
      </div>


      <br><br>

      <hr class="w-100 border border-grey" />
        <div class="col-6">
          <h4 class="text-success">latest Sale List</h4>
          <table class="table table-striped">
            <tr class="text-white">
              <td>Product</td>
              <td>Sale</td>
            </tr>
                <?php
                foreach($latest_sale as $s){
                  ?>
                       <tr class="text-white">
                          <td> <?php echo $s->product_name?></td>
                          <td><?php echo $s->sale_price?></td>
                        </tr>
                  <?php
                  
                }
                ?>
           
          </table>
        </div>

        <div class="col-6">
    <h4 class="text-danger">latest Buy List</h4>
    <table class="table table-striped">
      <tr class="text-white">
        <td>Product</td>
        <td>buy</td>
      </tr>
      <?php
                foreach($latest_buy as $b){
                  ?>
                       <tr class="text-white">
                          <td> <?php echo $b->product_name?></td>
                          <td><?php echo $b->buy_price?></td>
                        </tr>
                  <?php
                  
                }
                ?>
    </table>
   </div>
      </div>
    </div>
  </div>
 </div>
<?php
require 'include/footer.php';

?>