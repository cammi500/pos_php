<?php

require '../init.php';
if(!isset($_SESSION['user'])){
  setError('Please login first');
  go('login.php');
}

//data ajax from down key
if(isset($_GET['page'])){
  paginateCategory(2);
  die();
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

<script>
  $(function(){
    var page =1;
    var tblData = $('#tblData');
    var btnFetch =$('#btnFetch');
    btnFetch.click(function(){
      //for network
      page +=1;
        $.get(`index.php?page=${page}`).then(function(data){
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
                    <a href="edit.php?slug=${d.slug}" class="btn btn-sm btn-danger">
                    <span class="fa fa-edit"></span>
                    </a>
                    <a onclick="return confirm('Sure to delete')" href="index.php?slug=${d.slug}" class="btn btn-sm btn-primary">
                        <span class="fa fa-trash"></span>
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

