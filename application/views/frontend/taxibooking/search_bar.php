<form action="<?=base_url();?>taxi/export_excel" method="post" id="exportForm">

  <div class="row">

    <div class="col-sm-4">

      <label for="">Fuel</label><br />

      <input class="form-control" name="fuel" placeholder="Fuel" value="" type="text">

    </div>

    <div class="col-sm-4">

      <label for="">Ola Clients</label><br />

      <input class="form-control" name="ola_clients" placeholder="Ola Clients" value="" type="text">

    </div>

    <div class="col-sm-4">

      <label for="">Maintenance</label><br />

      <input class="form-control" name="maintainence" placeholder="Maintenance" value="" type="text">

    </div>

  </div>

  <div class="row">

    <div class="col-sm-4">

      <label for="">Driver Salary</label><br />

      <input class="form-control" name="driver_salary" placeholder="Driver Salary" value="" type="text">

    </div>

    <div class="col-sm-4">

      <label for="">Miscellaneous</label><br />

      <input class="form-control" name="miscallenous" placeholder="Miscellaneous" value="" type="text">

    </div>

    <div class="col-sm-4">

      <label for="">Remarks</label><br />

      <input class="form-control" name="remarks" placeholder="Remarks" value="" type="text">

    </div>

  </div>

  <div class="row">

    <div class="col-md-12">

      <button type="submit" class="pull-right btn btn-primary">Export Excel</button>

    </div>

    <input type="hidden" name="search_from_date" class="search_from_date">

    <input type="hidden" name="search_to_date" class="search_to_date">

    <input type="hidden" name="search_inv_no" class="search_inv_no">

    <input type="hidden" name="search_officer_name" class="search_officer_name">

    <input type="hidden" name="search_driver_name" class="search_driver_name">

    <input type="hidden" name="search_trip_sheet" class="search_trip_sheet">

  </div>

</form>

<form id="simple_search_form">

  <!-- /.row --> 

  <div class="row b-chech-in-out">

    <div class="col-sm-4">              

      <label for="">Name of the Officer</label><br />

      <input class="form-control" name="officer_name" placeholder="" value="" type="text">

    </div>

    <div class="col-sm-4">              

      <label for="">Driver Name</label><br />

      <input class="form-control" name="driver_name" placeholder="" value="" type="text">

    </div>

     <div class="col-sm-4">

      <div class="col-sm-6">

        <label for="">Date(From)</label><br />

        <input class="form-control datepicker" name="from_date" placeholder="" value="" type="text">

      </div>

      <div class="col-sm-6">

        <label for="">Date(To)</label><br />

        <input class="form-control datepicker" name="to_date" placeholder="" value="" type="text">

      </div>

    </div>

  </div>

  <div class="row pdf-order">

    <div class="col-sm-4">

       <label for="">Trip Sheet</label><br />

      <input class="form-control" name="trip_sheet" placeholder="" value="" type="text">

    </div>

    <div class="col-sm-4 invoice-item">

      <label for="">Invoice Number</label><br />

      <input class="search-destiny form-control" name="inv_no" placeholder="" type="text">

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

<br>







<!-- <form method="post" action="" name="operationForm" class="operationForm">

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

        <button class="btn btn-primary btn-block" type="submit" data-placement="top" data-toggle="tooltip">Execute</button>

      </div>

    </div>

  </fieldset>

</form> -->

<br>