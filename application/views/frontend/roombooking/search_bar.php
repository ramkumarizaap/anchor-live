<div class="clearfix"></div>
<form action="<?=base_url();?>booking/export_excel" method="post">
  <div class="row pad-bot">
    <div class="col-md-12">
      <button type="submit" class="pull-right btn btn-primary">Export Excel</button>
    </div>
    <input type="hidden" name="search_from_date" class="search_from_date">
    <input type="hidden" name="search_to_date" class="search_to_date">
    <input type="hidden" name="search_inv_no" class="search_inv_no">
    <input type="hidden" name="search_officer_name" class="search_officer_name">
    <input type="hidden" name="search_po_no" class="search_po_no">
    <input type="hidden" name="search_pdf_link" class="search_pdf_link">
    <input type="hidden" name="search_order_status" class="search_order_status">
    <input type="hidden" name="search_pdf_downloaded" class="search_pdf_downloaded">
  </div>
</form>
  <form id="simple_search_form">
    <!-- /.row --> 
    <div class="row b-chech-in-out">
      <div class="col-sm-4">
        <label for="">Purchase Order NO </label><br />
        <input class="form-control" name="po_no" placeholder="" type="text">
      </div>
      <div class="col-sm-4">
        <div class="col-sm-6 pad-right-10">
          <label for="">Check Out Date(From)</label><br />
          <input class="form-control datepicker" id="date" name="checkout_date_from" placeholder="" type="text"/>
          <!-- <span data-tooltip="" class="has-tip tip-top" data-selector="tooltipy34ixm" title="E.g., 08/30/2017">More information?</span> -->
        </div>
        <div class="col-sm-6">
          <label for="">Check Out Date(To)</label><br />
          <input class="form-control datepicker" id="date" name="checkout_date_to" placeholder="" type="text"/>
          <!-- <span data-tooltip="" class="has-tip tip-top" data-selector="tooltipy34ixm" title="E.g., 08/30/2017">More information?</span> -->
        </div>
      </div>
      <div class="col-sm-4">              
        <label for="">Name of the Officer</label><br />
        <input class="form-control" name="officer_name" placeholder="" value="" type="text">
      </div>
    </div>
    <div class="row pdf-order">
      <div class="col-sm-4">
        <div class="col-sm-6  pad-right-10">              
          <label for="">PDF Link</label><br />
          <select class="form-control width_select" name="invoice_link">
            <option value=''>-Any-</option>
            <option value='enable'>Enable</option>
            <option value='disable'>Disable</option>
          </select>
        </div>
        <div class="col-sm-6 pad-right-10">              
          <label for="">Order Status</label><br />
          <select class="form-control width_select" name="status">
            <option value=''>-Any-</option>
            <option value='Open'>Open</option>
            <option value='Closed'>Closed</option>
          </select>
        </div>
      </div>
      <div class="col-sm-4 invoice-item">
        <div class="col-sm-6"> 
          <label for="">PDF download</label><br />
          <select class="form-control width_select" name="pdf_downloaded">
            <option value=''>-Any-</option>
            <option value='Yes'>Yes</option>
            <option value='No'>No</option>
          </select>
        </div>
        <div class="col-sm-6 pad-right-10">
          <label for="">Invoice Number</label><br />
          <input class="search-destiny form-control" name="inv_no" placeholder="" type="text">
        </div>
      </div>
      <div class="col-sm-4 serch-cztm"> 
        <div class="col-sm-6">
          <label for="">Items per page </label><br />
          <?php echo form_dropdown('per_page_options', $per_page_options, $per_page, 'class="form-control"');?>
        </div>
        <div class="col-sm-6">
          <label for="">&nbsp;</label><br />             
          <button class="btn btn-primary btn-block" type="button" id="simple_search_button" data-placement="top" data-toggle="tooltip" data-original-title="search"><span class="fa fa-search"></span> Search</button>
        </div>
      </div>
    </div>
  </form>
  <form method="post" action="" name="operationForm" class="operationForm">
    <fieldset style="border:1px solid #ccc;">
      <legend style="width: auto;padding-left: 5px;padding-right: 5px;">Operations</legend>
      <div class="row">
        <div class="col-sm-10">
          <select class="form-control" name="order">
            <option value="">-Choose an operation-</option>
            <option value="1">Close Order</option>
            <option value="2">Generate Invoice Link</option>
            <option value="3">PDF Downloaded</option>
          </select>
        </div>
        <div class="col-sm-2">
          <!-- <button class="btn btn-primary btn-block" type="submit" data-placement="top" data-toggle="tooltip">Execute</button> -->
          <a href="#" class="pull-left btn btn-primary btn-block" onclick="genInvoice();">Execute</a>
        </div>
      </div>
    </fieldset>
  </form>
  <br>


<div class="remodal modal-lg" data-remodal-id="invoice">
  <a data-remodal-action="close" class="remodal-close"></a>
  <form method="post" id="InoviceForm" action="">
    <h2>Generate Invoice</h2>
    <div class="row modal-invoice-body" style="max-height: 400px;overflow-y:auto; ">
      
    </div>
    <br>
    <a data-remodal-action="cancel" class="btn btn-primary pull-right cancel-btn" href="#">Cancel</a>
    <button type="submit" class="btn btn-success pull-right margin-right-20">Generate Invoice</button>
  </form>
</div>