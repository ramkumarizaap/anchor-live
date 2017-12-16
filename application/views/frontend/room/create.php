<div class=" container-fluid inner-page"> 
 	<div class="row">
 		<div class="page-title">
 			<div class="container">
 				<h1>Create Room</h1>
 			</div>
 		</div>
	</div>
	<div class="container marketing pad-top pad-bot booking-a-room">
  	<!-- Three columns of text below the carousel -->
  	<form method="post" action="" enctype="multipart/form-data">
  		<div class="row">
  			<div class="col-sm-4 <?=(form_error('name'))?'has-error':'';?>">
    			<label for="" class="control-label">Room Name</label><br />
          <input class="form-control" placeholder="" name="name" type="text" value="<?=set_value('name');?>">
          <span class="error"><?=form_error('name')?></span>
  			</div>
  			<div class="col-sm-4 <?=(form_error('tariff'))?'has-error':'';?>">
    			<label for="" class="control-label">Tariff</label><br />
          <input class="form-control" placeholder="" name="tariff" type="text" value="<?=set_value('tariff');?>">
          <span class="error"><?=form_error('tariff')?></span>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-sm-4 <?=(form_error('type'))?'has-error':'';?>">
    			<label for="" class="control-label">Room Type</label><br />
          <select class="form-control" name="type">
          	<option value="Single">Single</option>
          	<option value="Twin">Twin</option>
          </select>
          <span class="error"><?=form_error('type')?></span>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-sm-4">
  				<button class="btn btn-primary" type="submit">Save</button>
  			</div>
  		</div>
  	</form>
  </div>
</div>