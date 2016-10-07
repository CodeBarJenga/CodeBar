<?php
/*
 * 
 * 
 */
 require_once 'controller/indexcontroller.php';
 $cont=new indexcontroller();
 if(@$_GET['error']) $err=@$_GET['error'];
 else $err=0;
 $cont->handlerequest($err);
?>