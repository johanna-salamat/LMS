<?php
header("Content-type:text/html;charset=utf-8");
require "conn.php";
session_start();
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
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

</head>

  <!-- <link rel="stylesheet" href="css/base.css"> -->
 
<body>
<?php
include "header.php";
?>
<div class="container-fluid">
   <div class="row">
        <!-- //ManageServicetype -->
        <div class="col-12 col-md-8">
          <!-- Tabs -->
        <section id="tabs">
          	<div class="container">
          		<div class="row">
          			<div class="col">
          				<nav>
                     <input type="hidden" id="txn_status" name="txn_status" value="new" >
          					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
          					<?php
          						$sql = "SELECT * FROM `category`";
          						$categories = mysqli_query($conn, $sql);
          						
          						if(mysqli_num_rows($categories) > 0)
          						{
          							while($category = mysqli_fetch_assoc($categories))
          							{
          							$selected = $category['category_id'] == 1 ? "true" : "false";
          							$active = $category['category_id'] == 1 ? "active" : "";
          					?>
          								<a class="nav-item nav-link <? echo $active ?>" id="nav-home-tab" data-toggle="tab" href="#nav-category-<?echo $category['category_id']?>" role="tab" aria-controls="nav-home" aria-selected=<? echo $selected; ?> ><? echo $category['category_name']?></a>
          					<?php
          							}
          						}
          					?>
          					</div>
          				</nav>
          				
          				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">	

          				<?php
                  $counter = 0;
          				if(mysqli_num_rows($categories) > 0)
          				{
          					foreach($categories as $category)
          					{
          						$sql = "SELECT * FROM `item_type` WHERE category_id={$category['category_id']}";
          						$items = mysqli_query($conn, $sql);
          				?>
		          				<!-- Container Dry Cleaning -->
		                   		<div class="tab-pane fade <?echo ($counter == 0)?'show active':'' ?>" id="nav-category-<?echo $category['category_id']?>" role="tabpanel" aria-labelledby="nav-home-tab">
		                   			<div class="main-container">
		                   				
		                   					<?php
		                   						if(mysqli_num_rows($items) > 0)
		                   						{ 
		                   							while($item = mysqli_fetch_assoc($items)){
		                   					?>
				                   					<ul id="products">
					                   					<li>
							                            	<a onclick="addItem(<?echo $item['item_type_id']?>);" data-toggle="modal">
							                              		<img src="../<?php echo $item["item_type_image"]?> ">
							                         		</a>
							                         		<input type="hidden" id="item_type_name_<?echo $item['item_type_id']?>" value="<?echo $item['item_type_name']?>"/>
							                         		<input type="hidden" id="item_type_price_<?echo $item['item_type_id']?>" value="<?echo $item['item_type_price']?>" />
							                        	</li>
							                        </ul>
				                        	<?php
				                        			}
				                        		}
				                        	?>
		                   			</div>
		                   		</div>
          				<?php
                      $counter++;
          					}
          				}
          				?>
          				</div>
          			</div>
          		</div>
          	</div>
        </section>
          <!-- /Tabs -->
        </div>




        <div class="col-12 col-md-4 mt-3">
          <div id="manageservice">
          	<div class="card pt-0">
          		<div class="card-body pt-0">
          			<form id="invoiceform" method="POST">
          				<div class="row top-buffer">
          					<div class="col-sm-10 px-0">
          						<input type="text" class="form-control customer-name" placeholder="Customer name or phone number" id="customer_name_phone" name="customer_name_phone">
                      			<input type="hidden" id="customer_id" name="customer_id">
          					</div>
      						<div class="col-sm-2">
      							<button type="button" class="btn btn-backcolor btn-circle btn-sm"  data-toggle="modal" data-target="#modal-add-customer">
      								<i class="fa fa-plus"></i>
      							</button>
      						</div>
          				</div>

          				<div class="row top-buffer">
          					<div class="col-sm-5 col-sm">
          						<div class="dropdown">
          							<input type="text" class="form-control" id="pickup_datepicker" name="pickup_datepicker" placeholder="Pickup date" required>
          							
          							</div>
          						</div>
          						<div class="col-sm col-sm">
          							<i class="fa fa-clock-o fa-3x"></i>
          						</div>
					         	<div class="dropdown">
					         		<input type="text" class="form-control" id="pickup_timepicker" name="pickup_timepicker" placeholder="Pickup time">
								</div>
          						<!--div class="col-sm-5 col-sm">
          							<div class="card justify-content-center">
          								<div class="card-body cd-padding">
          									<div class="custom-control custom-switch">
          										<label class="custom-control-label" for="customSwitch1">Notify By Email
												<input type="checkbox" class="custom-control-input" id="customSwitch1">
                                				</label>
          									</div>
          								</div>
          							</div>
          						</div-->
          					</div>
          			</form>

          			<form method="POST" id="invoicedetails" name="invoicedetails">
          				<div class="row">
      						<div class="col">
      								<div class="scbar" id="itemslist">     
                      </div>
      						</div>
          				</div>
          			</form>
          					

            <form id="invoicesummary">
  						<div class="row top-buffer">
  							<div class="col">
  								<div class="card">
  									<div class="card-body">
  										<div class="row">
  											<div class="col">
  												<label>Discount</label>
  											</div>
  											<div class="col-sm-1">
  												<label>%</label>
  											</div>
  											<div class="col-sm-2">
  												<input class="form-control in-height" placeholder="0" type="text" name="discount_percent" id="discount_percent"/>
  											</div>
  											<div class="col-sm-1">
  												<label>$</label>
  											</div>
  											<div class="col-sm-3">
  												<input class="form-control in-height" placeholder="0.00" type="text" name="discount_amt" id="discount_amt" style="text-align: right;" readonly />
  											</div>
  										</div>
  										<div class="row">
  											<div class="col">
  												<label>Gst</label>
  											</div>
  											<div class="col-sm-1">
  												<label>$</label>
  											</div>
  											<div class="col-sm-3">
  												<input class="form-control in-height" placeholder="0.00" type="text" name="gst_amt" id="gst_amt" style="text-align: right;" readonly/>
  											</div>
  										</div>
  										<div class="row">
  											<div class="col">
  												<label>Total</label>
  											</div>
  											<div class="col-sm-1">
  												<label>$</label>
  											</div>
  											<div class="col-sm-3">
  												<input class="form-control in-height" placeholder="0.00" type="text" id="net_amt" name="net_amt" style="text-align: right;" readonly/>
  												<input type="hidden" id="gross_amt" name="gross_amt" />
  											</div>
  										</div>
  									</div>
  								</div>
  							</div>
  						</div>


          						<div class="row top-buffer">
          							<div class="col-sm">
          								<input type="text" class="form-control" placeholder="Notes" id="notes" name="notes">
          								</div>
          							</div>
          							<div class="row top-buffer">
          								<div class="col-sm">
          									<div class="dropdown" style="height: 100%;">
          										<select id="payment_status" name="payment_status" class="form-control btn btn-backcolor" style="height: 100%; color: white;">
          											<option value="Paid">Paid</option>
          											<option value="Pay on Collect">Pay on Collection</option>
          										</select>
          									</div>
          								</div>
          								<div class="col-sm">
          									<div class="dropdown">
          										<button class="btn btn-backcolor" type="button" id="add_charges" name="add charges" style="height: 100%; color: white;">Additional Charges</button>
          									</div>
          								</div>
          							</div>
          							<div class="row top-buffer justify-content-center">
          								<div class="col-sm-6">
          									<input type="button" class="btn btn-backcolor" id="submit" value="Submit" style="color:white;">
          								</div>
          								<div class="col-sm-6">
          									<input type="button" class="btn btn-greycolor" id="clear" value="Clear">
          								</div>
          							</div>
          						</form>
          					</div>
          				</div>
          			</div>

        </div>
        <!-- / End ManageService -->

   </div>
 </div>

 		<!-- Add Item Modal -->
 		<div class="modal fade" id="modal-add-item" tabindex="-1" role="dialog" aria-labelledby="modalAddItemTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              	<div class="modal-content">
	                <div class="modal-header">
	                  <h6 class="modal-title" id="modalAddItemTitle">Add Item</h6>
	                  <button type="button" class="btn-transparent" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                  </button>
	                </div>
	                <div class="modal-body">
	                  	<form method="POST" id="add_item_form">
		                    <div class="row px-3">
		                    	<input type="hidden" id="item_type_name" />
		                    	<input type="hidden" id="item_type_price" />
		                    	<input type="hidden" id="item_type_id" />

			                    <div class="col-sm-6" id="itemName"></div>

			                    <div class="center col-sm-6">
				                    <div class="input-group">
							          <span class="input-group-btn">
							              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
							                  <span class="fa fa-minus"></span>
							              </button>
							          </span>
							          <input type="text" name="quant[1]" id="quantity" class="form-control input-number" value="1" min="1" max="10">
							          <span class="input-group-btn">
							              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
							                  <span class="fa fa-plus"></span>
							              </button>
							          </span>
							      </div>
			                    </div>
		                    </div>
	                  	</form>
	                </div>
	                <div class="modal-footer">
                  <button type="button"  data-dismiss="modal" class="btn btn-primary col-2 btn-modal-submit" onClick="addToInvoice();">Add</button>
                </div>
	            </div>
                
            </div>
        </div>

             <!-- Add Customer Modal -->
        <div class="modal fade" id="modal-add-customer" tabindex="-1" role="dialog" aria-labelledby="modal-add-custome-title" aria-hidden="true">
	        <div class="modal-dialog modal-dialog-centered" role="document">
	          	<div class="modal-content">
	            	<div class="modal-header">
	              		<h5 class="modal-title" id="modal-add-customer-title">Add Customer</h5>
	              		<button type="button" class="btn-transparent" data-dismiss="modal" aria-label="Close">
	                		<span aria-hidden="true" class="fa fa-times"></span>
	              		</button>
	            	</div>
	            	
	            	<div class="modal-body">
		            	<form method="POST" id="add_customer_form" name="add_customer_form">
		            		<div class="form-row">
		                    	<div id="error_message" style="display: none;" class="alert alert-danger"></div>
		                        <div class="row col-sm-12 px-3 mt-3">
			                        <div class="col">
			                        	<label for="customer_name">Customer name</label>
			                            <input type="text" class="form-control" placeholder="First name" id="customer_name" name="customer_name" required>
		                            </div>
		                        </div>
		                        <div class="row px-3 mt-3">
			                        <div class="col mr-1">
			                            <label for="customer_mobile">Mobile number</label>
			                            <input type="text" class="form-control" placeholder="e.g. 04xx xxx xxx" id="customer_mobile" name="customer_mobile" required>
			                        </div>
		                            <div class="col">
		                            	<label for="customer_email">Email</label>
		                            	<input type="text" class="form-control" placeholder="someone@example.com" id="customer_email" name="customer_email" required>
		                            </div>
		                        </div>
		                        <div class="row px-3 mt-3">
		                        	<div class="col mr-1">
		                            	<label for="customer_streetaddress">Street address</label>
		                           		<input type="text" class="form-control" placeholder="Optional" id="customer_streetaddress" name="customer_streetaddress">
		                          	</div>
		                            <div class="col">
			                            <label for="customer_suburb">Suburb</label>
			                            <input type="text" class="form-control" placeholder="e.g. Sydney" id="customer_suburb" name="customer_suburb">
		                          	</div>
		                        </div>
		                        <div class="row px-3 mt-3">
		                        	<div class="col mr-1">
		                            	<label for="customer_state">State</label>
		                            	<input type="text" class="form-control" placeholder="e.g. NSW, WA, VIC, NT, SA, QLD" id="customer_state" name="customer_state">
		                          	</div>
		                          	<div class="col">
		                            	<label for="customer_postcode">Postcode</label>
		                            	<input type="text" class="form-control" placeholder="e.g. 2000" id="customer_postcode" name="customer_postcode">
		                          	</div>
		                        </div>
		                        <div class="row col-sm-12 modal-footer">
		                          <input type="submit" class="btn btn-info" value="Add" id="btn_add_customer">
		                          <input type="button" data-dismiss="modal" class="btn btn-info" value="Cancel">
		                        </div>
		                	</div>
		                </form>
	            	</div>   
	          	</div>
	        </div>
      	</div>

        <div class="modal fade" id="modal-transaction-response" tabindex="-1" role="dialog" aria-labelledby="modalResponseTitle" aria-hidden="true">
          	<div class="modal-dialog" role="document">
	            <div class="modal-content">
	              	<div class="modal-header">
		                <h5 class="modal-title" id="modalResponseTitle">Add Transaction</h5>
		                <button type="button" class="btn-transparent" data-dismiss="modal" aria-label="Close">
		                  <span aria-hidden="true" class="fa fa-times"></span>
		                </button>
	            	</div>
		            <div class="modal-body">
			            <div class="mr-0" style="text-align: center;" id="response_message">
			            </div>
			            <div align="center">
			                  <!--input type="button" id="add-customer" name="add-customer" value="Yes" class="btn btn-info" data-toggle="modal" data-target="#modal-add-customer" onClick="hideModal('modal-confirm-add-customer');" /-->
			                  <input type="button" id="done" name="done" value="Done" class="btn btn-info" onClick="hideModal('modal-transaction-response');"/>
			            </div>
		            </div>
	            </div>
          	</div>
        </div>

        <div class="modal fade" id="modal-confirm-add-customer" tabindex="-1" role="dialog" aria-labelledby="modalConfirmTitle" aria-hidden="true">
          	<div class="modal-dialog" role="document">
	            <div class="modal-content">
	              	<div class="modal-header">
		                <h5 class="modal-title" id="modalConfirmTitle"><span class="fa fa-exclamation-triangle"></span>&nbsp;Warning</h5>
		                <button type="button" class="btn-transparent" data-dismiss="modal" aria-label="Close">
		                  <span aria-hidden="true" class="fa fa-times"></span>
		                </button>
	            	</div>
		            <div class="modal-body">
			            <div class="mr-0" style="text-align: center;" id="confirmAddMessage">
			            	<h5>Customer not found. Do you want to add?</h5>
			            </div>
		                <div align="center">
		                  <input type="button" id="add-customer" name="add-customer" value="Yes" class="btn btn-info" data-toggle="modal" data-target="#modal-add-customer" onClick="hideModal('modal-confirm-add-customer');" />
		                  <input type="button" id="cancel" name="cancel" value="No" class="btn btn-info" onClick="hideModal('modal-confirm-add-customer');"/>
		                </div>
			            
		            </div>
	            </div>
          	</div>
        </div>
</body>

<script type="text/javascript">

$( function() {

    var li_menu = document.getElementById($("#txn_status").val());
    li_menu.setAttribute("class", "nav-item active");

	$( "#pickup_datepicker" ).datepicker({
		dateFormat: 'dd/mm/yy'
		});

	$('#pickup_timepicker').timepicker({
    timeFormat: 'hh:mm p',
    interval: 30,
    minTime: '7',
    maxTime: '6:30pm',
    defaultTime: '',
    startTime: '7:30am',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
});

$("#clear").click(function(){
  clearAllFields();
});

$("#btn_add_customer").click(function(e){
	e.preventDefault();

	$.ajax({
		method: 'POST',
		url: 'add_customer.php',
		data: $("#add_customer_form").serialize(),
		dataType: 'json',
		success: function(res)
		{
			if(res.customer_id != 0)
			{
				$("#customer_id").val(res.customer_id);
				$("#modal-add-customer").modal('hide');
	            
				clearResponseMessage('response_message');

	            var messageHeader = document.createElement('H5');
	            messageHeader.innerHTML = res.message;
	            
	            document.getElementById('response_message').appendChild(messageHeader);	
	            $("#modal-transaction-response").modal('show');
			}
			else
			{
				document.getElementById('error_message').style.display = "block";
				document.getElementById('error_message').innerHTML = "Unable to add customer. Please try again.";
			}
		}
	});

  
});

$("#modal-add-customer").on('show.bs.modal', function(){

  resetAddCustomerForm();

  var num_pattern = new RegExp("^\\d+$", "g");
  var customer = $("#customer_name_phone").val();
  var is_num = num_pattern.test(customer);
  

  if(is_num)
  {
    $("#customer_mobile").val(customer);
  }
  else
  {
    $("#customer_name").val(customer);
  }

});

$("#customer_name_phone").blur(function(){

  if($("#customer_name_phone").val() != "")
  {
    $.ajax({
        method: 'POST',
        url: 'validate_customer.php',
        data: 'customer='+$("#customer_name_phone").val(),
        dataType: 'json',
        success: function(res){
          if(res.customer_id == 0)
          {
          	clearResponseMessage('confirmAddMessage');
            var messageHeader = document.createElement('H5');
	        messageHeader.innerHTML = "Customer does not exist. Do you want to add " + $("#customer_name_phone").val() + "?";
	        document.getElementById("confirmAddMessage").appendChild(messageHeader);
            $("#modal-confirm-add-customer").modal('show');
          }
          else
          {
            $("#customer_id").val(res.customer_id);
            document.getElementById('customer_name_phone').setAttribute("class", "form-control customer-name");
          }
        }
    });
  }
  else
  {

    document.getElementById('customer_name_phone').setAttribute("class", "form-control is-invalid");
  }

});

$("#submit").click(function(){

	if(validateRequiredFields())
	{
		$.ajax({
	        method: 'POST',
	        url: 'add_transaction.php',
	        data: $("#invoiceform, #invoicedetails, #invoicesummary").serialize(),
	        dataType: 'json',
	        success: function(res)
	        {
	        	clearResponseMessage('response_message');

	        	var messageHeader = document.createElement('H5');
	        	messageHeader.innerHTML = res.message;

				document.getElementById('response_message').appendChild(messageHeader);
	        	
	        	if(res.success == "Y")
	        	{
	        		var invoiceDetails = document.createElement('H6');
	        		invoiceDetails.innerHTML = "Invoice number: " + res.invoice_no + "<br> Pick-up on: " + res.pickup_date_time;
	        		document.getElementById('response_message').appendChild(invoiceDetails);
	        	}
	        	$("#modal-transaction-response").modal('show');	
            clearAllFields();

	        }
		 });
	}
		
});

$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});

$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});

$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    } 
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

$("#discount_percent").keyup(function(e){
  calculateDiscountAmount();
  calculateGST();
});

function addItem(item_id)
{
  $("#modal-add-item").modal('show');
  document.getElementById('itemName').innerHTML = $("#item_type_name_"+item_id).val();
  document.getElementById('item_type_id').value = item_id;
  document.getElementById('item_type_name').value = $("#item_type_name_"+item_id).val();
  document.getElementById('item_type_price').value = $("#item_type_price_"+item_id).val();
}

function addToInvoice()
{
  var itemSubtotal = (parseFloat($("#item_type_price").val())*$("#quantity").val()).toFixed(2);
  var divRow = document.createElement('DIV');
  divRow.setAttribute("class", "row");
  divRow.setAttribute("style", "margin-left: 10px;")

  var divName = document.createElement('DIV');
  divName.setAttribute("class", "col-sm-6");
  divName.innerHTML =  $("#item_type_name").val();

  var inputItemDesc = document.createElement('P');
  inputItemDesc.setAttribute("style", "margin-left: 20px;")
  inputItemDesc.innerHTML = $("#quantity").val() + " @  " + $("#item_type_price").val() + " each";
  divName.appendChild(inputItemDesc);

  var inputItemName = document.createElement('input');
  inputItemName.setAttribute("type", "hidden");
  inputItemName.setAttribute("name", "items[]");
  inputItemName.setAttribute("value", $("#item_type_id").val())
  divName.appendChild(inputItemName);

  var inputItemQty = document.createElement('input');
  inputItemQty.setAttribute("type", "hidden");
  inputItemQty.setAttribute("name", "items_qty[]");
  inputItemQty.setAttribute("value", $("#quantity").val())
  divName.appendChild(inputItemQty);


  var divItemSubtotal = document.createElement('DIV');
  divItemSubtotal.setAttribute("class", "col-sm-6");
  divItemSubtotal.setAttribute("style", "text-align: right; padding-right: 40px;")
  divItemSubtotal.innerHTML = itemSubtotal;

  var inputItemSubtotal = document.createElement('input');
  inputItemSubtotal.setAttribute("type", "hidden");
  inputItemSubtotal.setAttribute("name", "items_subtotal[]");
  inputItemSubtotal.setAttribute("value", itemSubtotal);
  divItemSubtotal.appendChild(inputItemSubtotal);

  divRow.appendChild(divName);
  divRow.appendChild(divItemSubtotal);
  
  document.getElementById('itemslist').appendChild(divRow);

  autoCalculateTotal();
}

function autoCalculateTotal()
{
  var itemsPriceList = document.getElementsByName('items_subtotal[]');
  var total = 0;

  for(i=0; i<itemsPriceList.length; i++)
  {
    total += parseFloat(itemsPriceList[i].value);
  }

  $("#gross_amt").val(total.toFixed(2));
  $('#net_amt').val(total.toFixed(2));
  calculateDiscountAmount();
  calculateGST();

}

function calculateDiscountAmount()
{
  var discount = $("#net_amt").val()*(($("#discount_percent").val())/100);
  $("#discount_amt").val(discount.toFixed(2));
  var newtotal = $("#net_amt").val() - discount;
  $("#net_amt").val(newtotal.toFixed(2));
}

function calculateGST()
{
  var gstPerCent = "<?php echo $_SESSION['gst_percent']?>";
  var gst = ($("#net_amt").val()*(gstPerCent/100));
  $("#gst_amt").val(gst.toFixed(2));
}

function hideModal(element_id)
{
  $("#"+element_id).modal('hide');
}

function resetAddCustomerForm()
{
  $("#customer_fname, #customer_lname, #customer_phone").val("");
}

function clearResponseMessage(element)
{
    var existingMessage = document.getElementById(element);
    existingMessage.innerHTML = "";
}

function validateRequiredFields()
{

  var errorCount = 0;
  
  if($("#customer_name_phone").val() == "")
  {
    document.getElementById('customer_name_phone').setAttribute("class", "form-control is-invalid");
    errorCount++;
  }

  if($("#pickup_datepicker").val() == "")
  {
    document.getElementById('pickup_datepicker').setAttribute("class", "form-control is-invalid");
    errorCount++;
  }
  else
    document.getElementById('pickup_datepicker').setAttribute("class", "form-control");

  if($("#pickup_timepicker").val() == "")
  {
    document.getElementById('pickup_timepicker').setAttribute("class", "form-control is-invalid");
    errorCount++;
  }
  else
    document.getElementById('pickup_timepicker').setAttribute("class", "form-control");


  if(document.getElementById('itemslist').childNodes.length == 1)
  {
    document.getElementById('itemslist').setAttribute("class", "scbar form-control is-invalid");
    errorCount++;
  }
  else
    document.getElementById('itemslist').setAttribute("class", "scbar form-control");

  if(errorCount == 0)
    return true;
  else
    return false;
  
}

function clearAllFields()
{
  $("#customer_name_phone").val("");
  $("#customer_id").val("");
  $("#pickup_datepicker").val("");
  $("#pickup_timepicker").val("");
  $("#discount_percent").val("");
  $("#discount_amt").val("");
  $("#gst_amt").val("");
  $("#net_amt").val("");
  $("#gross_amt").val("");
  document.getElementById("itemslist").innerHTML = "" ;
}

</script>

