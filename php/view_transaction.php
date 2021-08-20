<!-- Add Customer Modal -->
    <div class="modal fade" id="modal-view-transaction" tabindex="-1" role="dialog" aria-labelledby="modal-view-transaction-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-view-transaction-title">View invoice</h5>
                <button type="button" class="btn-transparent" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="fa fa-times"></span>
                </button>
            </div>
            
            <div class="modal-body">
              <form method="POST" id="transaction_form" name="transaction_form">
                <div class="form-row">
                  <div class="col-sm-6">
                      <div class="row px-3 mt-3">
                        <div class="col-sm-5">
                          Invoice number: 
                        </div>
                        <div id="txn_invoice_no" name="txn_invoice_no" class="col-sm-5"></div>
                      </div>
                      
                      <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Invoice date: 
                          </div>
                          <div id="txn_invoice_date" name="txn_invoice_date" class="col-sm-5"></div>
                        </div>
                      
                        <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Pickup date: 
                          </div>
                          <div id="txn_pickup_date" name="txn_pickup_date" class="col-sm-5"></div>
                        </div>
                        
                        <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Discount amount: 
                          </div>
                          <div id="txn_discount_amt" name="txn_discount_amt" class="col-sm-5"></div>
                        </div>
                      
                        <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            GST: 
                          </div>
                          <div id="txn_gst_amt" name="txn_gst_amt" class="col-sm-5"></div>
                        </div>
                      
                        <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Total amount: 
                          </div>
                          <div id="txn_net_amt" name="txn_net_amt" class="col-sm-5"></div>
                        </div>
                      
                        <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Amount paid: 
                          </div>
                          <div id="txn_prepaid_amt" name="txn_prepaid_amt" class="col-sm-5"></div>
                        </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Customer name: 
                          </div>
                          <div id="txn_customer_name" name="txn_customer_name" class="col-sm-5"></div>
                        </div>
                      
                        <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Customer mobile: 
                          </div>
                          <div id="txn_customer_mobile" name="txn_customer_mobile" class="col-sm-5"></div>
                        </div>
                      
                        <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Customer email: 
                          </div>
                          <div id="txn_customer_email" name="txn_customer_email" class="col-sm-5"></div>
                        </div>
                      
                        <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Customer address: 
                          </div>
                          <div id="txn_customer_address" name="txn_customer_address" class="col-sm-5"></div>
                        </div>

                        <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Payment status: 
                          </div>
                          <div id="txn_payment_status" name="txn_payment_status" class="col-sm-5"></div>
                        </div>
                      
                        <div class="row px-3 mt-3">
                          <div class="col-sm-5">
                            Void?: 
                          </div>
                          <div id="txn_invoice_isvoid" name="txn_invoice_isvoid" class="col-sm-5"></div>
                        </div>
                  </div>
                  <div class="col-sm-10 center">
                    <div class="row">
                      <table class="table table-striped" id="invoice-item-table">
                      </table>
                    </div> 
                  </div>                           
                  <div class="row col-sm-6 center" id="modal-btns">
                    <input type="button" class="btn btn-info" value="Ready" id="btn_update_status" name="btn_update_status" style="height: 100%;">

                    <input type="button" class="btn btn-info" value="Void" id="btn_void" style="height: 100%;">

                    <input type="button" data-dismiss="modal" class="btn btn-info" value="Close" style="height: 100%;">
                  </div>
                  </div>
                </form>
            </div>   
          </div>
      </div>
    </div>