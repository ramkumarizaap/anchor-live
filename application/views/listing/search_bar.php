<div class="col-xs-12 table-sub-header text-right">
  <div class="row">
   <div class="div top-lisiting-search">
    <form method="post" id="simple_search_form">
      <div class="col-sm-2">
        <?php echo form_dropdown('search_type', $simple_search_fields, $search_conditions['search_type'], 'class="form-control"');?>
        
      </div>
      
      <div class="col-sm-4">
        <div class="input-group clearfix">
          <input type="text" class="form-control" name="search_text" value="<?php echo $search_conditions['search_text'];?>" placeholder="Search some stuff.">
          <span class="input-group-btn">
              <button class="btn" type="button" id="simple_search_button" data-placement="top" data-toggle="tooltip" data-original-title="search"><span class="fa fa-search"></span></button>
          </span>
          <a class="clear-text" href="javascript:void(0);" onclick="$.fn.clear_simple_search();" data-placement="top" data-toggle="tooltip" data-original-title="clear simple search">Clear Filter</a>
        </div>
      </div>
    </form>
     <div class="col-sm-3 text-left advanced-search">
      <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Advanced Search<span class="caret"></span>
  </button>
    <a class="clear-text" href="javascript:void(0);">Clear Filter</a>
    </div>
    <div class="col-sm-3 entry-text text-right">
       <span class="col-sm-6 show-entry">Show entries:</span>
       <span class="col-sm-6">
        <?php echo form_dropdown('per_page_options', $per_page_options, $per_page, 'class="form-control"');?>
        </span>
    </div>
  </div>
</div>
</div>