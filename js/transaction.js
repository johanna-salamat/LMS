 var txns = [];
 $(document).ready(function(){

    var li_menu = document.getElementById($("#txn_status").val());
    li_menu.setAttribute("class", "nav-item active");


    buildTransactionsTable();
    getAllTransactions();

    var page = $("#txn_status").val();

    if(page == "pending")
    {
      document.getElementById('btn_update_status').value = "Ready";

    }
    else if(page == "ready")
    {
      document.getElementById('btn_update_status').value = "Collect";
      $("#btn_void").remove();
    }
    else if(page == "collected")
    {
      $("#btn_void").remove();
      $("#btn_update_status").remove();
    }



    $('body').on('click', '.clickable-row', function(e){

      var transaction_id = e.target.parentNode.id;
      
      for(var j=0; j<txns.transactions.length; j++)
        {
          if(txns.transactions[j].txn_invoice_no == transaction_id)
          {

            if(txns.transactions[j].txn_invoice_isvoid == "Yes")
            {
                document.getElementById('btn_update_status').setAttribute("disabled", "disabled");
                document.getElementById('btn_void').setAttribute("disabled","disabled");
            }
            else
            {
              $('#btn_update_status').removeAttr("disabled");
              $('#btn_void').removeAttr("disabled");
            }

            document.getElementById('txn_invoice_no').innerHTML = transaction_id;
            document.getElementById('txn_customer_name').innerHTML = txns.transactions[j].customer_name;
            document.getElementById('txn_pickup_date').innerHTML = txns.transactions[j].txn_pickup_date;
            document.getElementById('txn_customer_mobile').innerHTML = txns.transactions[j].customer_mobile;
            document.getElementById('txn_customer_email').innerHTML = txns.transactions[j].customer_email;
            document.getElementById('txn_customer_address').innerHTML = txns.transactions[j].customer_address;
            document.getElementById('txn_discount_amt').innerHTML = txns.transactions[j].txn_discount_amt;
            document.getElementById('txn_gst_amt').innerHTML = txns.transactions[j].txn_gst_amt;
            document.getElementById('txn_net_amt').innerHTML = txns.transactions[j].txn_net_amt;
            document.getElementById('txn_prepaid_amt').innerHTML = txns.transactions[j].txn_prepaid_amt;
            document.getElementById('txn_payment_status').innerHTML = txns.transactions[j].txn_payment_status;
            document.getElementById('txn_invoice_isvoid').innerHTML = txns.transactions[j].txn_invoice_isvoid;

            /* clear item table */
            document.getElementById('invoice-item-table').innerHTML = "";

            var tHead = document.createElement('THEAD');

            /* create item table header */
            var itemHeader = document.createElement('TR');


            /* header for item name */
            var thItemName = document.createElement('TH');
            thItemName.setAttribute('scope', 'col');
            thItemName.innerHTML = "Item name";
            itemHeader.appendChild(thItemName);

            /* header for description */
            var thDescription = document.createElement('TH');
            thDescription.setAttribute('scope', 'col');
            thDescription.innerHTML = "Description";
            itemHeader.appendChild(thDescription);

            /* header for unit price */
            var thItemPrice = document.createElement('TH');
            thItemPrice.innerHTML = "Unit price"
            thItemPrice.setAttribute('scope', 'col');
            itemHeader.appendChild(thItemPrice);

            /* header for quantity */
            var thQuantity = document.createElement('TH');
            thQuantity.setAttribute('scope', 'col');
            thQuantity.innerHTML = "Quantity";
            itemHeader.appendChild(thQuantity);

            /* header for total */
            var thTotal = document.createElement('TH');
            thTotal.setAttribute('scope', 'col');
            thTotal.innerHTML = "Total";
            itemHeader.appendChild(thTotal);

            tHead.appendChild(itemHeader);
            document.getElementById('invoice-item-table').appendChild(tHead);

            var tBody = document.createElement('TBODY');

            for(var k=0; k<txns.transactions[j].items.length; k++)
            {
              var itemRow = document.createElement('TR');

              /* Column for item name */
              var tdItemName = document.createElement('TD');
              tdItemName.innerHTML = txns.transactions[j].items[k].item_type_name;
              itemRow.appendChild(tdItemName);

              /* Column for description */
              var tdDescription = document.createElement('TD');
              tdDescription.innerHTML = txns.transactions[j].items[k].item_type_name;
              itemRow.appendChild(tdDescription);

              /* Column for unit price */
              var tdUnitPrice = document.createElement('TD');
              tdUnitPrice.innerHTML = txns.transactions[j].items[k].item_type_price;
              itemRow.appendChild(tdUnitPrice);

              /* Column for quantity */
              var tdQuantity = document.createElement('TD');
              tdQuantity.innerHTML = txns.transactions[j].items[k].txn_invoice_item_qty;
              itemRow.appendChild(tdQuantity);

              /* Column for total */
              var tdTotal = document.createElement('TD');
              tdTotal.innerHTML = txns.transactions[j].items[k].txn_invoice_item_subtotal;
              itemRow.appendChild(tdTotal);

              tBody.appendChild(itemRow);
              document.getElementById('invoice-item-table').appendChild(tBody);
            }
          }
        }

      $("#modal-view-transaction").modal("show");

    });       
  });

  $(".clickable-row").click(function(){});

  $("#btn_update_status").click(function(){

    var txn_invoice_no = document.getElementById('txn_invoice_no').innerText;

    $.ajax({
      method: 'POST',
      url: 'update_transaction.php',
      data: 'txn_status=' + $("#txn_update_to_status").val() + "&txn_invoice_no=" + txn_invoice_no,
      dataType: 'json',
      success: function(res){
        alert(res.message);
        location.reload();
      }
    });
  });

  $("#btn_void").click(function(){

    var txn_invoice_no = document.getElementById('txn_invoice_no').innerText;

    $.ajax({
      method: 'POST',
      url: 'update_transaction.php',
      data: 'void=1&txn_invoice_no=' + txn_invoice_no,
      dataType: 'json',
      success: function(res){
        alert(res.message);
        location.reload();
      }
    });
  });

  $("#filter-button").click(function(){
    buildTransactionsTable();
    getAllTransactions();
  });

  function getAllTransactions()
  {
    var filter_string = "&filter_by=" + $("#filter_by").val() + "&filter_keyword=" + $("#filter_keyword").val();

    $.ajax({
      method: 'GET',
      url: 'get_transactions.php?txn_status=' + $("#txn_status").val() + filter_string,
      dataType: 'json',
      success: function(res){
        txns = res;

        /* re-create tbody */
        var tBody = document.createElement("tbody");

        document.getElementById("transaction_count").innerHTML = "<h6>" + txns.transactions.length + " transaction(s) found.</h6>";

        for(var l=0; l<txns.transactions.length; l++)
        {
          var txnRow = document.createElement('TR');
          txnRow.setAttribute("class", "clickable-row");
          txnRow.setAttribute("id", txns.transactions[l].txn_invoice_no);
          
          /* Column for invoice number */
          var tdInvoiceNo = document.createElement('TH');
          tdInvoiceNo.setAttribute("scope", "row");
          tdInvoiceNo.innerHTML = txns.transactions[l].txn_invoice_no;
          txnRow.appendChild(tdInvoiceNo);
          
          /* Column for invoice date */
          var tdInvoiceDate = document.createElement('TD');
          tdInvoiceDate.innerHTML = txns.transactions[l].txn_invoice_date;
          txnRow.appendChild(tdInvoiceDate);

          /* Column for pickup date */
          var tdPickupDateTime = document.createElement('TD');
          tdPickupDateTime.innerHTML = txns.transactions[l].txn_pickup_date;
          txnRow.appendChild(tdPickupDateTime);

          /* Column for customer */
          var tdCustomer = document.createElement('TD');
          tdCustomer.innerHTML = txns.transactions[l].customer_name;
          txnRow.appendChild(tdCustomer);
          tBody.appendChild(txnRow);

          /* Column for number of items */
          var tdTotalQty = document.createElement('TD');
          tdTotalQty.setAttribute("style","text-align: right;");
          tdTotalQty.innerHTML = txns.transactions[l].txn_total_qty;
          txnRow.appendChild(tdTotalQty);
          tBody.appendChild(txnRow);

          /* Column for net amount */
          var tdNetAmt = document.createElement('TD');
          tdNetAmt.innerHTML = txns.transactions[l].txn_net_amt;
          tdNetAmt.setAttribute("style","text-align: right;");
          txnRow.appendChild(tdNetAmt);
          tBody.appendChild(txnRow);

          /* Column for payment status */
          var tdPaymentStatus = document.createElement('TD');
          tdPaymentStatus.innerHTML = txns.transactions[l].txn_payment_status;
          txnRow.appendChild(tdPaymentStatus);
          tBody.appendChild(txnRow);

          /* Column for is void */
          var tdIsVoid = document.createElement('TD');
          tdIsVoid.innerHTML = txns.transactions[l].txn_invoice_isvoid;
          txnRow.appendChild(tdIsVoid);
        }

        document.getElementById("invoice-table").appendChild(tBody);
      }
    }); 
  }

  function buildTransactionsTable()
  {
    /* clear table */
    document.getElementById("invoice-table").innerHTML = "";

    /* re-create thead */
    var tHead = document.createElement('THEAD');

    var headerRow = document.createElement('TR');

    var thDate = document.createElement('TH');
    thDate.setAttribute("scope", "col");
    thDate.innerHTML = "Invoice number";
    headerRow.appendChild(thDate);

    var thInvoiceNo = document.createElement('TH');
    thInvoiceNo.setAttribute("scope", "col");
    thInvoiceNo.innerHTML = "Date";
    headerRow.appendChild(thInvoiceNo);

    var thPickupDate = document.createElement('TH');
    thPickupDate.setAttribute("scope", "col");
    thPickupDate.innerHTML = "Pickup Date and Time";
    headerRow.appendChild(thPickupDate);

    var thCustomer = document.createElement('TH');
    thCustomer.setAttribute("scope", "col");
    thCustomer.innerHTML = "Customer";
    headerRow.appendChild(thCustomer);

    var thItemQty = document.createElement('TH');
    thItemQty.setAttribute("scope", "col");
    thItemQty.innerHTML = "No. of items";
    headerRow.appendChild(thItemQty);

    var thTotal = document.createElement('TH');
    thTotal.setAttribute("scope", "col");
    thTotal.innerHTML = "Total amount";
    headerRow.appendChild(thTotal);

    var thPaymentStatus = document.createElement('TH');
    thPaymentStatus.setAttribute("scope", "col");
    thPaymentStatus.innerHTML = "Payment Status";
    headerRow.appendChild(thPaymentStatus);

    var thVoid = document.createElement('TH');
    thVoid.setAttribute("scope", "col");
    thVoid.innerHTML = "Void?";
    headerRow.appendChild(thVoid);

    tHead.appendChild(headerRow);
    document.getElementById("invoice-table").appendChild(tHead);
  }


