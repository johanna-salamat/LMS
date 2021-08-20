<?php
header("Content-type:text/html;charset=utf-8");
include "conn.php";
//$img_list = glob("../image/clothes/*.png");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laundry Management System</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/top.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="../js/main.js"></script>


</head>

<body>

  <?php
  include "header.php";
  ?>


<div id="content-container">
  <div class="container" style="margin-top: 20px;">
    <div class="row">
      <div class="row col-sm-12">
        <div class="col-sm-9">
          <h3><span class="fa fa-list"></span>&nbsp; Items</h3>
        </div>
        <?
          if($_SESSION['user_type'] == "admin")
          {
        ?>
        <div class="col-sm-3">
          <button class="btn btn-info" style="width: 50%; height: 100%;" data-toggle="modal" data-target="#modal-add-item">Add item</button>
        </div>
        <?
          }
        ?>
      </div>
      <hr width="100%">
    </div>
    <div class="row">
      <div id="item_count"></div>
      <div id="content-container">
        <table class="table table-hover">
          <thead>
            <th>#</th>
            <th style="width: 25%;">Item name</th>
            <th style="width: 25%;">Description</th>
            <th style="width: 25%;">Price</th>
            <th colspan="2" style="width: 25%;">Category</th>
          </thead>
          <tbody id="userslist"></tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-edit-item" tabindex="-1" role="dialog" aria-labelledby="modal-edit-item-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-item-title">Edit item</h5>
                <button type="button" class="btn-transparent" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="fa fa-times"></span>
                </button>
            </div>
            
            <div class="modal-body">
              <form method="POST" id="update_item_price" name="update_item_price">
                <div class="form-row">
                  <div style="margin: auto;">
                      <div>
                        <input type="text" id="new_item_price" name="new_item_price" placeholder="Enter new item price" class="form-control">
                      </div>
                      <input type="hidden" name="this_user_id" id="this_user_id">             
                  </div>
                       
                  <div id="modal-btns" style="margin: auto;">
                    <div>
                      <input type="button" class="btn btn-info" value="Update" id="btn_update_item" name="btn_update_item" style="width: 100%;">
                    </div>
                  </div>
                </div>
              </form>
            </div>   
          </div>
      </div>
    </div>

  <div class="modal fade" id="modal-delete-item" tabindex="-1" role="dialog" aria-labelledby="modal-delete-item-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-delete-item-title">Delete item</h5>
                <button type="button" class="btn-transparent" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="fa fa-times"></span>
                </button>
            </div>
            
            <div class="modal-body">
              <form method="POST" id="delete_item_form" name="delete_item_form">
                <div class="form-row">
                  <div style="margin: auto;">
                      <div id="confirm_item_delete">
                        Are you sure you want to delete?
                      </div>
                      <input type="hidden" name="this_item_id" id="this_item_id">             
                  </div>
                       
                  <div id="modal-btns" style="margin: auto;">
                    <div>
                      <input type="button" class="btn btn-info" value="Delete" id="btn_delete_item" name="btn_delete_item" style="width: 100%;">
                    </div>
                  </div>
                </div>
              </form>
            </div>   
          </div>
      </div>
    </div>

      <div class="modal fade" id="modal-add-item" tabindex="-1" role="dialog" aria-labelledby="modal-add-item-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-item-title">Add item</h5>
                <button type="button" class="btn-transparent" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="fa fa-times"></span>
                </button>
            </div>
            
            <div class="modal-body">
              <form method="POST" id="add_item_form" name="add_item_form" class="form-row">

                  <div style="margin: auto;">
                      <div style="padding: 10px 5px;">
                        <input type="text" id="item_type_name" name="item_type_name" placeholder="Enter item name" class="form-control">
                      </div>
                      <div style="padding: 10px 5px;">
                        <input type="text" id="item_type_desc" name="item_type_desc" placeholder="Enter item description" class="form-control">
                      </div>
                      <div style="padding: 10px 5px;">
                        <input type="text" id="item_type_price" name="item_type_price" placeholder="Enter item price" class="form-control">
                      </div>
                      <div style="padding: 10px 5px;">
                        <select id="category_id" name="category_id" class="form-control">
                          <option value="">Select category</option>
                        </select>
                      </div>
                      <div>
                      <input type="button" class="btn btn-info" value="Add" id="btn_add_item" name="btn_add_item" style="width: 100%;">
                    </div>                
                  </div>
              </form>
            </div>   
          </div>
      </div>
    </div>
</body>

<script type="text/javascript">
  var userArr = [];

  $(document).ready(function(){

    $.ajax({
      method: 'GET',
      url: 'get_items.php',
      dataType: 'json',
      success: function(res){

        document.getElementById('item_count').innerHTML = "<h6>" + res.items.length + " item(s) found.</h6>";
        
        userArr = res.items;

        for(var i=0; i<res.items.length; i++)
        {
          var itemRow = document.createElement('TR');
          itemRow.setAttribute("class", "clickable-row");
          itemRow.setAttribute("id", res.items[i].item_type_id);

          var countTd = document.createElement('TD');
          countTd.innerHTML = (i+1);
          itemRow.appendChild(countTd);

          var itemNameTd = document.createElement('TD');
          itemNameTd.innerHTML = res.items[i].item_type_name;
          itemRow.appendChild(itemNameTd);

          var itemDescTd = document.createElement('TD');
          itemDescTd.innerHTML = res.items[i].item_type_desc;
          itemRow.appendChild(itemDescTd);

          var itemPriceTd = document.createElement('TD');
          itemPriceTd.innerHTML = res.items[i].item_type_price;
          itemRow.appendChild(itemPriceTd);

          var categoryTd = document.createElement('TD');
          categoryTd.innerHTML = res.items[i].category_name;
          itemRow.appendChild(categoryTd);

          var currentUserType = "<? echo $_SESSION['user_type'] ?>";
 
          if(currentUserType == "admin")
          {
            var editItemTd = document.createElement('TD'); 
            
            var resetBtn = document.createElement('A');
            resetBtn.setAttribute("id", res.items[i].item_type_id);
            resetBtn.setAttribute("data-target", "#modal-edit-item");
            resetBtn.setAttribute("data-toggle", "modal");
            resetBtn.setAttribute("onclick", "showItemModal(this.id);")
            
            var nbsp = document.createElement('NBSP');

            var resetBtnSpan = document.createElement('SPAN');
            resetBtnSpan.setAttribute("class", "fa fa-edit");

            var deleteBtn = document.createElement('A');
            deleteBtn.setAttribute("id", res.items[i].item_type_id);
            deleteBtn.setAttribute("data-target", "#modal-delete-item");
            deleteBtn.setAttribute("data-toggle", "modal");
            deleteBtn.setAttribute("onclick", "showItemModal(this.id);")
            
            var deleteBtnSpan = document.createElement('SPAN');
            deleteBtnSpan.setAttribute("class", "fa fa-trash");

            deleteBtn.appendChild(deleteBtnSpan);
            resetBtn.appendChild(resetBtnSpan);
            editItemTd.appendChild(resetBtn);
            editItemTd.appendChild(deleteBtn)
            itemRow.appendChild(editItemTd);
          } 
          document.getElementById('userslist').appendChild(itemRow);
        }
      }
    });

    $.ajax({
      method: 'GET',
      url: 'get_categories.php',
      dataType: 'json',
      success: function(res){

        for(var i=0; i<res.categories.length; i++)
        {
          var option = document.createElement('OPTION');
          option.setAttribute("value", res.categories[i].category_id);
          option.innerHTML = res.categories[i].category_name;

          document.getElementById('category_id').appendChild(option);
        }
      }
    });

  });

  $('#btn_delete_item').click(function()
    {
      $.ajax({
        method: 'POST',
        url: 'manage_item.php',
        data: "action=delete&item_type_id=" + $("#this_item_id").val(),
        dataType: 'json',
        success: function(res){
          if(res.success == "Y")
          {
            alert("Item successfully deleted!");
            location.reload();
          }
          else
            alert("Unable to delete item. Please try again.");
        }
      });
    });


  $('#btn_update_item').click(function(){
      $.ajax({
        method: 'POST',
        url: 'manage_item.php',
        data: "action=update&item_type_id=" + $("#this_item_id").val() + "&item_type_price=" + $("#new_item_price").val(),
        dataType: 'json',
        success: function(res){
          if(res.success == "Y")
          {
            alert("Item successfully updated!");
            location.reload();
          }
          else
            alert("Unable to update item. Please try again.");
        }
      });  
  });

  $("#btn_add_item").click(function(){

    var add_user_fields = ['item_type_name', 'item_type_desc', 'item_type_price', ''];
    var errors = 0;
    for(var i=0; i<add_user_fields.length; i++)
    {
      var fieldname = add_user_fields[i];
      if($("#" + fieldname).val() == "")
      {
        document.getElementById(fieldname).setAttribute("class", "form-control is-invalid");
        errors++;
      }
    }

    if(errors == 0)
    {
      $.ajax({
        method: 'POST',
        url: 'manage_item.php',
        data: "action=insert&" + $("#add_item_form").serialize(),
        dataType: 'json',
        success: function(res){
          if(res.success == "Y")
          {
            alert("Item succesfully added!");
            location.reload();
          }
          else
            alert("Unable to insert item. Please try again.");
        }
      });

    }

  });

  function showItemModal(item_id)
  {
    $("#this_item_id").val(item_id);
  }
  
</script>
<style>
  #resetPassword:hover
  {
    background-color: transparent;
  }
</script>
