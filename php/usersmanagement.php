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
          <h3><span class="fa fa-users"></span>&nbsp; User management</h3>
        </div>
        <?
          if($_SESSION['user_type'] == "admin")
          {
        ?>
        <div class="col-sm-3">
          <button class="btn btn-info" style="width: 50%; height: 100%;" data-toggle="modal" data-target="#modal-add-user">Add user</button>
        </div>
        <?
          }
        ?>
      </div>
      <hr width="100%">
    </div>
    <div class="row">
      <div id="users_count"></div>
      <div id="content-container">
        <table class="table table-hover">
          <thead>
            <th style="width: 25%;">Username</th>
            <th style="width: 25%;">User type</th>
            <th colspan="2" style="width: 25%;">Last login</th>
          </thead>
          <tbody id="userslist"></tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-reset-password" tabindex="-1" role="dialog" aria-labelledby="modal-reset-password-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-reset-password-title">Reset password</h5>
                <button type="button" class="btn-transparent" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="fa fa-times"></span>
                </button>
            </div>
            
            <div class="modal-body">
              <form method="POST" id="reset_password_form" name="reset_password_form">
                <div class="form-row">
                  <div style="margin: auto;">
                      <div>
                        <input type="password" id="new_password" name="new_password" placeholder="Enter new password" class="form-control">
                      </div>
                      <input type="hidden" name="this_user_id" id="this_user_id">             
                  </div>
                       
                  <div id="modal-btns" style="margin: auto;">
                    <div>
                      <input type="button" class="btn btn-info" value="Reset" id="btn_reset" name="btn_reset" style="width: 100%;">
                    </div>
                  </div>
                </div>
              </form>
            </div>   
          </div>
      </div>
    </div>

      <div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog" aria-labelledby="modal-add-user-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-user-title">Add user</h5>
                <button type="button" class="btn-transparent" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="fa fa-times"></span>
                </button>
            </div>
            
            <div class="modal-body">
              <form method="POST" id="add_user_form" name="add_user_form" class="form-row">

                  <div style="margin: auto;">
                      <div style="padding: 10px 5px;">
                        <input type="text" id="user_name" name="user_name" placeholder="Enter username" class="form-control">
                      </div>
                      <div style="padding: 10px 5px;">
                        <input type="password" id="password" name="password" placeholder="Enter password" class="form-control">
                      </div>
                      <div style="padding: 10px 5px;">
                        <select id="user_type" name="user_type" class="form-control">
                          <option value="">Select user type</option>
                          <option value="admin">Administrator</option>
                          <option value="user">User</option>
                        </select>
                      </div>
                      <div>
                      <input type="button" class="btn btn-info" value="Add" id="btn_add_user" name="btn_add_user" style="width: 100%;">
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
      url: 'get_users.php',
      dataType: 'json',
      success: function(res){

        document.getElementById('users_count').innerHTML = "<h6>" + res.users.length + " user(s) found.</h6>";
        
        userArr = res.users;

        for(var i=0; i<res.users.length; i++)
        {
          var userRow = document.createElement('TR');
          userRow.setAttribute("class", "clickable-row");
          userRow.setAttribute("id", res.users[i].user_id);

          var usernameTd = document.createElement('TD');
          usernameTd.innerHTML = res.users[i].user_name;
          userRow.appendChild(usernameTd);

          var userTypeTd = document.createElement('TD');
          userTypeTd.innerHTML = res.users[i].user_type;
          userRow.appendChild(userTypeTd);

          var lastLoggedinTd = document.createElement('TD');
          lastLoggedinTd.innerHTML = res.users[i].last_login;
          userRow.appendChild(lastLoggedinTd);

          var currentUserType = "<? echo $_SESSION['user_type'] ?>";
 
          if(currentUserType == "admin")
          {
            var resetPasswordTd = document.createElement('TD'); 
            
            var resetBtn = document.createElement('A');
            resetBtn.setAttribute("id", res.users[i].user_id);
            resetBtn.setAttribute("data-target", "#modal-reset-password");
            resetBtn.setAttribute("data-toggle", "modal");
            resetBtn.setAttribute("onclick", "showResetModal(this.id);")
            
            var resetBtnSpan = document.createElement('SPAN');
            resetBtnSpan.setAttribute("class", "fa fa-unlock-alt");

            resetBtn.appendChild(resetBtnSpan);
            resetPasswordTd.appendChild(resetBtn);
            userRow.appendChild(resetPasswordTd);
          } 
          document.getElementById('userslist').appendChild(userRow);
        }
        
      }
    });

  });

  $('#btn_reset').click(function(){
    var newPassword = $("#new_password").val();

    if(newPassword == "")
    {
      document.getElementById('new_password').setAttribute("class", "form-control is-invalid");
    }
    else
    {
      document.getElementById('new_password').setAttribute("class", "form-control");
      $.ajax({
        method: 'POST',
        url: 'reset_password.php',
        data: $("#reset_password_form").serialize(),
        dataType: 'json',
        success: function(res)
        {
          $("#modal-reset-password").modal("hide");
          if(res.success == "Y")
          {
            alert("Password successfully updated!");
          }
          else
          {
            alert("Something went wrong. Please try again.");
          }
        }
      });
    }
  });

  $("#btn_add_user").click(function(){

    var add_user_fields = ['user_name', 'password', 'user_type'];
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
        url: 'add_user.php',
        data: $("#add_user_form").serialize(),
        dataType: 'json',
        success: function(res){
          if(res.success == "Y")
          {
            alert("User added successfully!");
            $("#modal-add-user").modal("hide");
            location.reload();
          }
          else
            alert("User already exists. Please enter a different username.");

         
        }
      });
    }

  });

  function showResetModal(user_id)
  {
    $("#this_user_id").val(user_id);
  }
  
</script>
<style>
  #resetPassword:hover
  {
    background-color: transparent;
  }
</script>
