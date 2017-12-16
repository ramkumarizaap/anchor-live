<div class=" container-fluid inner-page"> 
 	<div class="row">
 		<div class="page-title">
 			<div class="container">
 				<h1>Services</h1>
 			</div>
 		</div>
	</div>
<div class="container">
  <div class="row">
		<div class="col-md-12">
			<div class="tabbable-panel">
				<div class="tabbable-line">
					<ul class="nav nav-tabs ">
						<li class="active"><a href="#tab_default_1" data-toggle="tab">Executives</a></li>
						<li><a href="#tab_default_2" data-toggle="tab">Rank</a></li>
						<li><a href="#tab_default_3" data-toggle="tab">Vessel</a></li>
						<li><a href="#tab_default_4" data-toggle="tab">Rooms</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_default_1">
							<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										<a href="javascript:;" class="btn btn-primary pull-right" data-remodal-target="modal">+ Add Executive</a>
									</div>
							</div><br>
							<?=$grid1;?>
							</div>
						</div>
						<div class="tab-pane" id="tab_default_2">
							<div class="row">
								<div class="col-md-10"></div>
								<div class="col-md-2">
									<a href="#" class="btn btn-primary pull-right" data-remodal-target="modal1">+ Add Rank</a>
								</div>
							</div><br>
							<?=$grid2;?>
							</div>
						</div>
						<div class="tab-pane" id="tab_default_3">
							<div class="row">
								<div class="col-md-10"></div>
								<div class="col-md-2">
									<a href="#" class="btn btn-primary pull-right" data-remodal-target="modal2">+ Add Vessels</a>
								</div>
							</div><br>
							<?=$grid3;?>
							</div>
						</div>
						<div class="tab-pane" id="tab_default_4">
							<div class="row">
								<div class="col-md-10"></div>
								<div class="col-md-2">
									<a href="#" class="btn btn-primary pull-right" data-remodal-target="modal3">+ Add Room</a>
								</div>
							</div><br>
							<?=$grid4;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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


<div class="remodal" data-remodal-id="modal1">
  <a data-remodal-action="close" class="remodal-close"></a>
  <form method="post" id="rankForm" action="">
  	<input type="hidden" name="form_id" value="rankForm">
  	<input type="hidden" name="action" value="rank">
  	<input type="hidden" name="id" value="">
  	<h2>Add Rank</h2>
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

<div class="remodal" data-remodal-id="modal2">
  <a data-remodal-action="close" class="remodal-close"></a>
  <form method="post" id="vesselForm" action="">
  	<input type="hidden" name="form_id" value="vesselForm">
  	<input type="hidden" name="action" value="vessels">
  	<input type="hidden" name="id" value="">
  	<h2>Add Vessel</h2>
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

<div class="remodal" data-remodal-id="modal3">
  <a data-remodal-action="close" class="remodal-close"></a>
  <form method="post" id="roomForm" action="">
  	<input type="hidden" name="form_id" value="roomForm">
  	<input type="hidden" name="action" value="rooms">
  	<input type="hidden" name="id" value="">
  	<h2>Add Room</h2>
		<div class="row">  			
			<div class="col-sm-12">
  			<label for="" class="col-md-2 pull-left control-label">Name </label>
  			<div class="col-md-10 pull-left">
        	<input class="form-control" placeholder="" type="text" name="name" value="">
        </div>
			</div><br><br>
			<div class="col-sm-12">
  			<label for="" class="col-md-2 pull-left control-label">Tariff </label>
  			<div class="col-md-10 pull-left">
        	<input class="form-control" placeholder="" type="text" name="tariff" value="">
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