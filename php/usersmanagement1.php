<?php
header("Content-type:text/html;charset=utf-8");
include "../conn/conn.php";
//$img_list = glob("../image/clothes/*.png");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laundry Management System</title>

		<!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="custom.css">

</head>

  <!-- <link rel="stylesheet" href="css/base.css"> -->
  <script type ="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
  <script type ="text/javascript" src="../js/jquery.js"></script>
  <script type ="text/javascript" src="../js/jq/jquery.datepicker.js"></script>
  <link rel="stylesheet" href="../css/top.css">
  <link rel="stylesheet" href="../css/styles.css">
<body>

  <?php
  include "header.php";
  ?>

<div class="container-fluid">
   <div class="row">

          <div class="col-12 ml-10 my-4">
            <button class="btn btn-greycolor btn-update-order">
              Add Users
            </button>
          </div>
    </div>

   <div class="row">
     <table class="table">
       <thead class="">
         <tr>
           <th scope="col">User ID</th>
           <th scope="col">Name</th>
           <th scope="col">Edit Orders</th>
           <th scope="col">Delete Orders</th>
           <th scope="col">Discount (Orders)</th>
           <th scope="col">Items</th>
           <th scope="col">Users</th>
		   <th scope="col">Sales Reports</th>
		   <th scope="col">Reset Pin</th>
		   <th scope="col">Configurations</th>
           <th scope="col"></th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <th scope="row">Sin</th>
           <td>SinYin Tan</td>
           <th><input type="checkbox"</td>
           <td><input type="checkbox"</td>
           <td><input type="checkbox"</td>
           <td><input type="checkbox"</td>
           <td><input type="checkbox"</td>
		   <td><input type="checkbox"</td>
           <td><input type="checkbox"</td>
           <td><input type="checkbox"</td>
           <td>
             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
            </svg>
           </td>
         </tr>
         <tr>
           <th scope="row">Hanna</th>
           <td>20/05/20</td>
           <td>5pm</td>
           <td>@mdo</td>
           <td>2</td>
           <td>Cash</td>
           <td>$19.50</td>
           <td>
             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
            </svg>
           </td>
         </tr>
         <tr>
           <th scope="row">2005D0002</th>
           <td>20/05/20</td>
           <td>5pm</td>
           <td>@fat</td>
           <td>2</td>
           <td>Card</td>
           <td>$19.50</td>
           <td>
             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
            </svg>
           </td>
         </tr>
         <tr>
           <th scope="row">2005D0003</th>
           <td>20/05/20</td>
           <td>5pm</td>
           <td>@twitter</td>
           <td>2</td>
           <td>No</td>
           <td>$19.50</td>
           <td>
             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
            </svg>
           </td>
         </tr>


       </tbody>
     </table>



   </div>
 </div>


</body>



	<!-- // manageservicetype script -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script type="text/javascript">
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
   </script>
   <script src="../js/jquery-1.7.2.min.js"></script>
   <script src="../js/top.js"></script>
