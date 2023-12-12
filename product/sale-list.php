<?php
require '../init.php';
if(isset($_GET['delete'])){
  //+product qty
  $product_slug=$_GET['product_slug'];
  $sale_id =$_GET['id'];
  $product_id=getOne("select product_id from product_sell where id=?",[$sale_id])->product_id;
 
  query("update product set total_quantity=product.total_quantity+1 where id=?",[$product_id]);
  query("delete from product_sell where id=?",[$sale_id]);
  setMsg('delete ');
  go('sale-list.php?product_slug=',$product_slug);

}

if(isset($_GET['product_slug']) and !empty($_GET['product_slug'])){
    $slug =$_GET['product_slug'];
    $product=getOne("select * from product where slug=?",[$slug]);
    $sales =getAll("select * from product_sell where product_id=?",[$product->id]);
    // print_r($sales);
}
require '../include/header.php';
?>


 <!-- Breadcamp -->
 <div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Product
          </h4>
          >
          <?php echo $product->name; ?>
          >
          sale list
        </span>
      </div>
    </div>
  </div>
<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
        <div class="card-body">
          <?php
          showMsg();
          showError(); ?>
            <table class="table">
                <tr>
                    <td>Sale Price</td>
                    <td>Date</td>
                    <td>Option</td>
                </tr>
                <tr>
                    <?php 
                      foreach($sales as $s){
                        ?>

                        <tr>
                            <td><?php echo $s->sale_price?> </td>
                            <td><?php echo $s->date ?> </td>
                            <td>
                                  <a class="btn btn-sm btn-danger" href="sale-list.php?delete=true&id=<?php echo $s->id; ?>&product_slug=<?php echo $slug ?>" onclick="return confirm('Are you sure you want to delete thi?')">
                                    <span class="fa fa-trash"></span>
                                    </a>
                            </td>
                        </tr>
                        <?php
                      }
                        ?>
                    
                  
                </tr>
            </table>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>