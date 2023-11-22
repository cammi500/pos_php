<?php

//login user
function setError($message)
{
    $_SESSION['errors'] =[];
    $_SESSION['errors'][] = $message;
}

function showError()
{
    //error shi ma shi 
    $errors =$_SESSION['errors'];
    $_SESSION['errors'] =[];
    if(count($errors)){
        foreach($errors as $e){
            echo "<div class='alert alert-danger'>$e</div>";
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
    //error shi ma shi toe count lo ma ya so use isset($_SESSION['msg'])
    $msg =$_SESSION['msg'];
    $_SESSION['msg'] =[];
    if(isset($_SESSION['msg']) and count($msg)){
        foreach($msg as $e){
            echo "<div class='alert alert-success'>$e</div>";
        }
    }
}

function go($path){
    header("Location:$path");
}

function slug($str){
    return uniqid() . '-' . str_replace(' ','-',$str);
}