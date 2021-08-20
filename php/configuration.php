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
  <div class="container" style="margin-top: 20px;">
      <div class="row">
      <div class="row col-sm-12">
        <div class="col-sm-9">
          <h3><span class="fa fa-cogs"></span>&nbsp; Configuration</h3>
        </div>
      </div>
      <hr width="100%">
    </div>
    <div class="row">
      <div class="col">
        <nav>
           <input type="hidden" id="txn_status" name="txn_status" value="new" >
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
          <?php
            $configs = array("Company profile", "GST");

            for($i=0; $i<count($configs); $i++)
            {
            $selected = $i == 0 ? "true" : "false";
            $active = $i == 0 ? "active" : "";
          ?>
              <a class="nav-item nav-link <? echo $active ?>" id="nav-home-tab" data-toggle="tab" href="#nav-configs-<?echo $i?>" role="tab" aria-controls="nav-home" aria-selected=<? echo $selected; ?> ><? echo $configs[$i]?></a>
          <?php
            }
          ?>
          </div>
        </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent"> 
        <?php
          $config_keys = array("Company profile" => array("config_type" => "company_profile", "company_name" => "Company Name", "company_address" => "Address", "company_phone" => "Phone number", "company_abn" => "ABN", "company_email" => "Email"), 
                                  "GST" => array("config_type" => "GST", "gst_percent" => "GST (%)"));

          for($j=0; $j<count($configs); $j++)
          {
        ?>
        <div class="tab-pane fade <?echo ($j == 0)?'show active':'' ?>" id="nav-configs-<?echo $j?>" role="tabpanel" aria-labelledby="nav-home-tab">
          <form id="config_form_<? echo $j ?>" name="config_form_<? echo $j ?>">
            <div class="main-container col-sm-12"> 
              <?php

                foreach($config_keys[$configs[$j]] as $key => $label)
                {
                  ?>  
                    <div class="col-sm-9" style="padding: 10px; margin: auto;">
                      <div><? echo $key == 'config_type' ? '' : $label ?></div>
                      <div>
                        <input type="<? echo $key == 'config_type' ? 'hidden' : 'text'?>" class="form-control" placeholder="Enter <? echo $label ?>" id="<? echo $key ?>" name="<? echo $key ?>" <? echo $key == "config_type" ? "value='{$label}'" : "" ?>>
                      </div>
                    </div>
              <?php
                }
              ?>
              <div class="col-sm-9" style="padding: 10px; margin: auto;" >
                <input type="button" class="btn btn-info" id="btn_update_config_<? echo $j ?>" name="btn_update_config_<? echo $j ?>" onclick="switchForm(<?echo $j?>);" value="Update" style="margin: 0; margin-top: 5%; margin-left: 50%; margin-right: -50%; transform: translate(-50%, -50%)" >
              </div>
            </div>
          </form>
        </div>
        <?php 
          } 
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

<script type="text/javascript">
 $(document).ready(function(){

  $.ajax({
    method: 'GET',
    url: 'config.php',
    dataType: 'json',
    success: function(res){
      //for company profile
      $("#company_name").val(res.config.company_profile.company_name);
      $("#company_address").val(res.config.company_profile.company_address);
      $("#company_phone").val(res.config.company_profile.company_phone);
      $("#company_abn").val(res.config.company_profile.company_abn);
      $("#company_email").val(res.config.company_profile.company_email);

      //for GST
      $("#gst_percent").val(res.config.GST.gst_percent);
    }
  });
});

function switchForm(i)
{

    $.ajax({
      method: 'POST',
      url: 'config.php',
      data: $("#config_form_"+i).serialize(),
      dataType: 'json',
      success: function(res){
        if(res.success == "Y")
          alert("Configuration successfully updated!");
        else
          alert("Unable to update configuration. Please try again.");
      }
    });
}
</script>
