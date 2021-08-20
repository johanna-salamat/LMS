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

		<!-- Heade CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="../css/top.css">
  	<link rel="stylesheet" href="../css/styles.css">
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>

	<!-- for date picker -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	
<body>

  <?php
  include "header.php";
  ?>

 <div class="container" style="margin-top: 20px;">
 	<div class="row">
 		<div>
 			<h3><span class="fa fa-file"></span>&nbsp; Sales Report</h3>

 		</div>
 		<hr width="100%">
 	</div>
 	<div class="row">
		<div class="dropdown" style="margin: auto;">
			<input type="text" class="form-control" id="invoice_date_from" name="invoice_date_from" placeholder="Invoice date from" required>	
  		</div>
		<div class="dropdown" style="margin: auto;">
			<input type="text" class="form-control" id="invoice_date_to" name="invoice_date_to" placeholder="Invoice date to" required>	
  		</div>
		<div class="dropdown" style="margin: auto;">
			<input type="button" class="form-control btn btn-info" id="generate_report" name="generate_report" value="Generate">	
  		</div>
 	</div>

 	<div id="sales_report" class="row card" style="margin-top: 5%; padding: 20px 20px; display: none;">
 		<div id="report_header" style="margin: auto;">
 			<div class="center"><h2>Clean As A Whistle Dry Cleaners</h2></div>
 			<div id="date_range" style="text-align: center;"></div>
 			<div id="total_net_sales" style="text-align: center;"></div>
 			<div id="no_data" style="text-align: center;"></div>
 		</div>
 		<div id="report_body" style="margin: auto; width: 100%;">
 			<div class="col-sm-6 row" style="margin: auto;">
 				<div class="col-sm-5" style="text-align: right;">Total Gross Sales</div>
 				<div id="total_gross_sales" class="col-sm-5" style="text-align: right;"></div>
 			</div>
 			<div class="col-sm-6 row" style="margin: auto;">
 				<div class="col-sm-5" style="text-align: right;">Total Discount</div>
 				<div id="total_discount" class="col-sm-5" style="text-align: right;"></div>
 			</div>
 			<div class="col-sm-6 row" style="margin: auto;">
 				<div class="col-sm-5" style="text-align: right;">Total GST</div>
 				<div id="total_gst" class="col-sm-5" style="text-align: right;"></div>
 			</div>
 		</div>
 	</div>
 </div> 

</body>
<script type="text/javascript">
	$(document).ready(function(){
		$("#invoice_date_from").datepicker({
			dateFormat: 'dd/mm/yy'
		});
		$("#invoice_date_to").datepicker({
			dateFormat: 'dd/mm/yy'
		});
	});

	$("#generate_report").click(function(){

		if(validDateFields())
		{
			$.ajax({
				method: 'GET',
				url: 'get_sales_summary.php',
				data: 'invoice_date_from=' + $("#invoice_date_from").val() + "&invoice_date_to=" + $("#invoice_date_to").val(),
				dataType: 'json',
				success: function(res){
					if(res.success == "Y")
					{
						
						var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];


						var date_from = new Date(res.invoice_date_from).getDate() + " " + months[new Date(res.invoice_date_from).getMonth()] + " " + new Date(res.invoice_date_from).getFullYear();

						var date_to = new Date(res.invoice_date_to).getDate() + " " + months[new Date(res.invoice_date_to).getMonth()] + " " + new Date(res.invoice_date_to).getFullYear();
						
						document.getElementById('date_range').innerHTML = "<h5>Total Net Sales from " + date_from + " to " + date_to + "</h5>";

						document.getElementById('sales_report').style.display = "";
						if(res.total_net_amt != 0.00)
						{
							document.getElementById('total_net_sales').innerHTML = "<h1>$ " + res.total_net_amt + "</h1>";
							
							document.getElementById('total_gross_sales').innerHTML = "$ " + res.total_gross_amt;
							document.getElementById('total_discount').innerHTML = "$ " + res.total_discount_amt;
							document.getElementById('total_gst').innerHTML = "$ " + res.total_gst_amt;
							document.getElementById('no_data').innerHTML = "";

							document.getElementById('report_body').style.display = "";
						}
						else
						{
							document.getElementById('no_data').innerHTML = "******** No data found ********";
							document.getElementById('report_body').style.display = "none";

							document.getElementById('total_net_sales').innerHTML = "";
							document.getElementById('total_gross_sales').innerHTML = "";
							document.getElementById('total_discount').innerHTML = "";
							document.getElementById('total_gst').innerHTML = ""
						}
					}
				}
			});
		}
	});
	

	function validDateFields()
	{
		var errors = 0;


		if($("#invoice_date_from").val() == "")
		{
			errors++;
			document.getElementById("invoice_date_from").setAttribute("class", "form-control is-invalid");
		}
		else
		{
			document.getElementById("invoice_date_from").setAttribute("class", "form-control");
		}

		if($("#invoice_date_to").val() == "")
		{
			errors++;
			document.getElementById("invoice_date_to").setAttribute("class", "form-control is-invalid");
		}
		else
		{
			document.getElementById("invoice_date_to").setAttribute("class", "form-control");
		}

		if(errors == 0)
			return true;
		else
			return false;
	}
</script>