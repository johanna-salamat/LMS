<?php
header("Content-type:text/html;charset=utf-8");
include "conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laundry Management System</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--link rel="stylesheet" href="css/custom.css"-->
    <link rel="stylesheet" href="../css/top.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  
  <script src="../js/main.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>


</head>
<body>

<?php include "header.php"; ?>

  <div class="row">
    <div class="col-sm-10 center" id="filter">
      <div class="row">
        <div class=" col-sm-2">
          <select class="btn btn-light" style="height: 100%; width: 100%;" id="filter_by" name="filter_by">
            <option value="">Filter by</option>
            <option value="txn_invoice_no">Invoice number</option>
            <option value="customer_name">Customer name</option>
            <option value="customer_mobile">Mobile number</option>
          </select>
        </div>

        <div class="col-sm-5">
          <input type="text" name="filter_keyword" id="filter_keyword" class="form-control" placeholder="Enter keyword">
          
        </div>
        <button id="filter-button" name="filter-button" class="btn btn-light" style="height: 100%; margin:0;"><span class="fa fa-search"></span></button>

      </div>
    </div>
    <input type="hidden" id="txn_status" name="txn_status" value="pending" >

    <div class="col-sm-10 center">
      <div id="transaction_count"></div>
      <table class="table table-hover" id="invoice-table">
      </table>
    </div>
  </div>

     <?php include "view_transaction.php"?>
     <input type="hidden" id="txn_update_to_status" name="txn_update_to_status" value="ready">
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.js"></script> 

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="../js/transaction.js"> </script>