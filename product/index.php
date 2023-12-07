<?php

require '../init.php';
if(!isset($_SESSION['user'])){
  setError('Please login first');
  go('login.php');
}
// //query
// $product = getAll('select * from product order by id desc limit 2');

//search
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $product = getAll("select * from product  where name like '%$search%' order by id desc limit 2");
}else{
   $search ='';
    $product = getAll('select * from product order by id desc limit 2');
}

//data ajax from down key
if(isset($_GET['page'])){
    paginateProduct(2);
    die();
  }
  
//delete
// if(isset($_GET['action'])){
//   $slug = $_GET['slug'];
//   query("delete from category where slug=?",[$slug]);
//   setMsg('Category deleted');
// }
// //query
// $category = getAll('select * from category order by id desc limit 2');
// // print_r($category);


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

        <form action="" class="mt-2">
        <input type="text" name="search" value="<?php echo $search; ?>" class="btn bg-white" >
        <button type="submit" class="btn btn-primary">
            <span class="fa fa-search"></span>
        </button>
        <?php
        if(!empty($search)){
            echo '<a href="index.php" class="btn btn-danger">Clear</a>';
        }
        ?>
        </form>   
             <?php 
        showError();
        showMsg(); ?>
      <table class="table table-striped text-white mt-2" >
        <thead>
            <tr>
                <td>name</td>
                <td>Quantity</td>
                <td>Sale</td>
                <td>Option</td>
            </tr>
        </thead>
        <tbody id="tblData">
            <?php 
          foreach($product as $p){
             ?>
            <tr>
                <td>
                    <?php echo $p->name; ?>
                </td>
                <td>
                    <?php echo $p->total_quantity; ?>
                </td>
                <td>
                    <?php echo $p->sale_price; ?>
                </td>
                <td>
                    <!-- view -->
                    <a href="detail.php?slug=<?php echo $p->slug;?>" class="btn btn-sm btn-success">
                        <span class="fa fa-eye"></span>
                    </a>
                     <!-- edit -->
                     <a href="edit.php?slug=<?php echo $p->slug;?>" class="btn btn-sm btn-primary">
                        <span class="fa fa-edit"></span>
                    </a>
                     <!-- delete -->
                     <a href="" class="btn btn-sm btn-danger">
                        <span class="fa fa-trash"></span>
                    </a>
                    |
                     <!-- view -->
                     <a href="<?php echo $root.'product-buy/index.php?product_slug=' .$p->slug; ?>" class="btn btn-sm btn-outline-success">
                        Buy
                    </a>
                     <!-- view -->
                     <a href="" class="btn btn-sm btn-outline-danger">
                        Sale
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
require '../include/footer.php';

?>
<!-- ajax down arrow -->
<script>
  $(function(){
    var page = 1;
    var tblData = $('#tblData');
    var btnFetch =$('#btnFetch');
    btnFetch.click(function(){
      //for network
      page +=1;
      var search =<?php echo $search?>;
      var url = `index.php?page=${page}`
      if(search) {
        url += `&search=${search}`;
      }

        $.get(url).then(function(data){
          // console.log(data);
          const d = JSON.parse(data);
          var htmlString = '';
          //array length false
          if(!d.length){
            btnFetch.attr('disabled','disabled');
          }      
          d.map(function(d){
          htmlString += `
          <tr>
                <td>
                    ${d.name}
                </td>
                <td>
                    ${d.total_quantity}
                </td>
                <td>
                    ${d.sale_price}
                </td>
                <td>
                    <!-- view -->
                    <a href="detail.php?slug=${d.slug}" class="btn btn-sm btn-success">
                        <span class="fa fa-eye"></span>
                    </a>
                     <!-- edit -->
                     <a href="edit.php?slug=${d.slug}" class="btn btn-sm btn-primary">
                        <span class="fa fa-edit"></span>
                    </a>
                     <!-- delete -->
                     <a href="" class="btn btn-sm btn-danger">
                        <span class="fa fa-trash"></span>
                    </a>
                    |
                     <!-- view -->
                     <a href="" class="btn btn-sm btn-outline-success">
                        Buy
                    </a>
                     <!-- view -->
                     <a href="" class="btn btn-sm btn-outline-danger">
                        Sale
                    </a>

                </td>
            </tr>
        `
        })
      
      tblData.append(htmlString);
        })
      });
    });
</script>
