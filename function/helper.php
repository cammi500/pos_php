<?php

//login user
function setError($message)
{
    $_SESSION['errors'] =[];
    $_SESSION['errors'][] = $message;
}

function showError()
{
    if(isset($_SESSION['errors'])){
     //error shi ma shi 
    $errors =$_SESSION['errors'];
    $_SESSION['errors'] =[];
    if(count($errors)){
        foreach($errors as $e){
            echo "<div class='alert alert-danger'>$e</div>";
        }
    }
    }
   
}
function hasError(){
  $errors =$_SESSION['errors'];
  if(count($errors)){
    return true;
  }
  return false;
}

//category
function setMsg($message)
{
    $_SESSION['msg'] =[];
    $_SESSION['msg'][] = $message;
}

function showMsg()
{
   if(isset($_SESSION['msg'])){
     //error shi ma shi toe count lo ma ya so use isset($_SESSION['msg'])
     $msg =$_SESSION['msg'];
     $_SESSION['msg'] =[];
     if(isset($_SESSION['msg']) and count($msg)){
         foreach($msg as $e){
             echo "<div class='alert alert-success'>$e</div>";
         }
     }
   }
}

function go($path){
    header("Location:$path");
}

function slug($str){
    return uniqid() . '-' . str_replace(' ','-',$str);
}
//down errow key
function paginateCategory($record_per_page =5){
    if(isset($_GET['page'])){
        $page =$_GET['page'];
    }else{
        $page = 2;
    }
    if($page<=0){
        $page =2;
    }

    //1=0,2
    //2=2,2

    $start =($page -1) * $record_per_page;
    $limit ="$start,$record_per_page";
    $sql ="select * from category order by id desc limit $limit";
    $data = getAll($sql);
    echo json_encode($data);
        // echo $sql;

    // echo $page;
}

//down errow key
function paginateProduct($record_per_page =5){
    if(isset($_GET['page'])){
        $page =$_GET['page'];
    }else{
        $page = 2;
    }
    if($page<=0){
        $page =2;
    }

    //1=0,2
    //2=2,2

    $start =($page -1) * $record_per_page;
    $limit ="$start,$record_per_page";
    $sql ="select * from product";
    if(isset($_GET['search']) and !empty($_GET['search'])){
        $search = $_GET['search'];
        $sql .= "where name like '%$search%' ";
    }
    //two sql concantinations
    $sql .="order by id desc limit $limit";
    $data = getAll($sql);
    echo json_encode($data);
        // echo $sql;

    // echo $page;
}