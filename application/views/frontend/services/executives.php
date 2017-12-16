<div class=" container-fluid inner-page"> 
 	<div class="row">
 		<div class="page-title">
 			<div class="container">
 				<h1>Manage Executives</h1>
 			</div>
 		</div>
	</div>
	<div class="container marketing pad-top pad-bot all-feed-back">
 	<div class="blue-mat"></div>  
    <!-- Three columns of text below the carousel -->
  	<div class="row">
			<div class="col-md-10"></div>
			<div class="col-md-2">
				<a href="javascript:;" class="btn btn-primary pull-right" data-remodal-target="modal">+ Add Executive</a>
			</div>
		</div><br>
    <div class="row">
      <div class="col-lg-12"> 
       <?=$grid?>  
      </div>     
    </div>
    <!-- /.row --> 
  </div>
<div class="remodal" data-remodal-id="modal">
  <a data-remodal-action="close" class="remodal-close"></a>
  <form method="post" id="executiveForm" action="">
  	<input type="hidden" name="form_id" value="executiveForm">
  	<input type="hidden" name="action" value="executives">
  	<input type="hidden" name="id" value="">
  	<h2>Add Executive</h2>
		<div class="row">  			
			<div class="col-sm-12">
  			<label for="" class="col-md-2 pull-left control-label">Name </label>
  			<div class="col-md-10 pull-left">
        	<input class="form-control" placeholder="" type="text" name="name" value="">
        </div>
			</div><br><br>
			<div class="col-sm-12">
  			<label for="" class="col-md-2 pull-left control-label">Status </label>
  			<div class="col-md-10 pull-left">
        	<select name="status" class="form-control">
        		<option value="Active">Active</option>
        		<option value="Deactive">Deactive</option>
        	</select>
        	<div class="msg"></div>
        </div>
			</div>
		</div>
  	<br>
  	<a data-remodal-action="cancel" class="btn btn-primary pull-right" href="#">Cancel</a>
  	<button type="submit" class="btn btn-success pull-right margin-right-20">Save</button>
  </form>
</div>