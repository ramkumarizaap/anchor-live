<div class=" container-fluid inner-page"> 
 	<div class="row">
 		<div class="page-title">
 			<div class="container">
 				<h1>Book a Room</h1>
 			</div>
 		</div>
	</div>
	<?php
	if($editdata['id']=='')
	{
		$active1 = "";
		$active = "active";
	}
	else
	{
		$active1 = "active";
		$active = "";
	}
	?>
	<div class="container marketing pad-top pad-bot booking-a-room">
		<div class="tabbable-panel">
				<div class="tabbable-line">
					<?php
					if($editdata['id']!='')
					{
						?>
						<ul class="nav nav-tabs ">
							<li class="<?=$active1;?>"><a href="#tab_default_1" data-toggle="tab">View</a></li>
							<li class="<?=$active;?>"><a href="#tab_default_2" data-toggle="tab">Edit</a></li>
						</ul>
						<?php
					}
					?>
					<div class="tab-content">
						<div class="tab-pane <?=$active1;?>" id="tab_default_1">
							<p><b>Purchase Order No :</b> <?=$editdata['po_no'];?></p>
							<p><b>Name of the Officer :</b> <?=$editdata['officer_name'];?></p>
							<p><b>Rank :</b> <?=$editdata['rank'];?></p>
							<p><b>Room Name :</b> <?=$editdata['room'];?></p>
							<p><b>Checkin Date :</b> <?=$editdata['checkin_date']." ".$editdata['checkin_time'];?></p>
							<p><b>Checkout Date :</b> <?=$editdata['checkout_date']." ".$editdata['checkout_time'];?></p>
							<p><b>Course Name :</b> <?=$editdata['course_name'];?></p>
							<p><b>Invoice Ref. Address :</b> <?=$editdata['address'];?></p>
							<p><b>Occupancy :</b> <?=$editdata['occupancy'];?></p>
							<p><b>Expected Checkout Date :</b> <?=$editdata['e_checkout_date']." ".$editdata['e_checkout_time'];?></p>
							<p><b>Assigned Vessel :</b> <?=$editdata['vessel'];?></p>
							<p><b>Booking Executives :</b> <?=$editdata['executives'];?></p>
							<p><b>Checked In :</b> <?=$editdata['checked_in'];?></p>
							<p><b>Logistics :</b> <?=$editdata['logistics'];?></p>
							<p><b>Discount% :</b> <?=$editdata['discount'];?></p>
						</div>
						<div class="tab-pane <?=$active;?>" id="tab_default_2">
							<form action="/" class="dropzone" id="pdfForm">
								
					  			<!-- <div class="col-sm-4 text-left">
					  				<button type="submit" class="btn btn-sm btn-primary">Upload</button>
					  			</div> -->
					  		
					  	</form>
					  	<form method="post" class="bookingForm" action="" enctype="multipart/form-data">
					  		<div class="row">
					  			<div class="col-sm-4 <?=(form_error('po_no'))?'has-error':'';?>">
					    			<label for="" class="control-label">Purchase Order NO </label><br />
					          <input class="form-control" placeholder="" name="po_no" type="text" value="<?=set_value('po_no',$editdata['po_no']);?>">
					          <span class="error"><?=form_error('po_no')?></span>
					  			</div>
					  			<div class="col-sm-4 <?=(form_error('officer_name'))?'has-error':'';?>">
					    			<label for="" class="control-label">Name of the Officer </label><br />
					          <input class="form-control" placeholder="" type="text" name="officer_name" value="<?=set_value('officer_name',$editdata['officer_name']);?>">
					          <span class="error"><?=form_error('officer_name')?></span>
					  			</div>
					   			<div class="col-sm-4 <?=(form_error('rank'))?'has-error':'';?>">
					        	<label for="" class="control-label">Rank</label><br />
					         	<?php echo form_dropdown('rank', array('' => '-None-')+get_ranks(), set_value('rank', $editdata['rank_id']), 'class="form-control width_select select2"');?>
					          <span class="error"><?=form_error('rank')?></span>
					        </div>
							  </div>
					  		<div class="row">
					    		<div class="col-sm-4 <?=(form_error('executive'))?'has-error':'';?>">
					          <label for="" class="control-label">Booking Executive </label><br />
					          <?php echo form_dropdown('executive', array('' => '-None-')+get_executives(), set_value('executive', $editdata['executive_id']), 'class="form-control width_select select2"');?>
					          <span class="error"><?=form_error('executive')?></span>
					  			</div>
					    		<div class="col-sm-4 <?=(form_error('occupancy'))?'has-error':'';?>">
					        	<label for="" class="control-label">Occupancy</label><br />
					          <?php echo form_dropdown('occupancy', array('Single' => 'Single',"Twin"=>"Twin"), set_value('occupancy', $editdata['occupancy']), 'class="form-control width_select"');?>
					          <span class="error"><?=form_error('occupancy')?></span>
					          <span data-tooltip="" class="has-tip tip-top" title="Room To be treated as Single or Twin">More information?</span>
					    		</div>
					    		<div class="col-sm-4 <?=(form_error('room_name'))?'has-error':'';?>">
					        	<label for="" class="control-label">Room Name </label><br />
					        	<?php echo form_dropdown('room_name', array('' => '-None-')+get_rooms(), set_value('room_name', $editdata['room_id']), 'class="form-control width_select select2"');?>
										<span class="error"><?=form_error('room_name')?></span>
					    		</div>
					 			</div>
					   		<div class="row">
					    		<div class="col-sm-4 <?=(form_error('purpose'))?'has-error':'';?>">
					        	<label for="" class="control-label">Purpose of Visit</label><br />
					          <?php echo form_dropdown('purpose', array('' => '-None-','Joining'=>"Joining","Training"=>"Training","Visit"=>"Visit","Course"=>"Course"), set_value('purpose', $editdata['purpose']), 'class="form-control width_select"');?>
										<span class="error"><?=form_error('purpose');?></span>
					    		</div>
							    <div class="col-sm-4 <?=(form_error('vessel'))?'has-error':'';?>">              
							      <label for="" class="control-label">Assigned Vessel </label><br />
							      <?php echo form_dropdown('vessel', array('' => '-None-')+get_vessels(), set_value('vessel', $editdata['vessel_id']), 'class="form-control width_select select2"');?>
										<span class="error"><?=form_error('vessel')?></span>
							    </div>
					    		<div class="col-sm-4 <?=(form_error('course_name'))?'has-error':'';?>">
					      		<label for="" class="control-label">Course Name </label><br />
					          <input class="form-control" name="course_name" placeholder="" type="text" value="<?=set_value('course_name',$editdata['course_name']);?>">
					          <span class="error"><?=form_error('course_name')?></span>
					    		</div>
					 			</div>
					  		<div class="row check-in-out pad-top pad-bot">
							    <div class="col-sm-4">
							    	<fieldset>
							      	<legend><span class="fieldset-legend">Check In Date </span></legend>
						          <div class="col-sm-6 <?=(form_error('checkin_date'))?'has-error':'';?>">
						          	<label for="" class="control-label">Date</label><br />
					              <input type="text" name="checkin_date" class="form-control singledate" value="<?=set_value('checkin_date',$editdata['checkin_date']);?>">
					              <span class="error"><?=form_error('checkin_date')?></span>
					              <span data-tooltip="" class="has-tip tip-top" data-selector="tooltipy34ixm" title="E.g., 08/30/2017">More information?</span>
						          </div>
						          <div class="col-sm-6 <?=(form_error('checkin_time'))?'has-error':'';?>">
						          	<label for="" class="control-label">Time</label><br />
					              <input class="form-control timepicker" type="text" name="checkin_time" value="<?=set_value('checkin_time',$editdata['checkin_time']);?>">
					              <span class="error"><?=form_error('checkin_time')?></span>
					              <span data-tooltip="" class="has-tip tip-top" data-selector="tooltipk5bqet" title="E.g, 23:00">More information?</span>
						          </div>
						        </fieldset>
							    </div>
					    		<div class="col-sm-4">
					    			<fieldset>
						        	<legend><span class="fieldset-legend">Expected Check Out Date </span></legend>
						          <div class="col-sm-6">
						          	<label for="" class="control-label">Date</label><br />
						            <input class="form-control singledate" id="date" name="e_checkout_date" placeholder="" type="text" value="<?=set_value('e_checkout_date',$editdata['e_checkout_date']);?>" />
						            <span data-tooltip="" class="has-tip tip-top" data-selector="tooltipy34ixm" title="E.g., 08/30/2017">More information?</span>
						           </div>
						          <div class="col-sm-6">
						          	<label for="" class="control-label">Time</label><br />
						            <input class="form-control timepicker" id="time" type="text" name="e_checkout_time" value="<?=set_value('e_checkout_time',$editdata['e_checkout_time']);?>">
						            <span data-tooltip="" class="has-tip tip-top" data-selector="tooltipk5bqet" title="E.g, 23:00">More information?</span>
						          </div>
					          </fieldset>
					    		</div>
					    		<div class="col-sm-4">
					    			<fieldset>
						        	<legend><span class="fieldset-legend">Check Out Date </span></legend>
						          <div class="col-sm-6 <?=(form_error('checkout_date'))?'has-error':'';?>">
						          	<label for="" class="control-label">Date</label><br />
						            <input class="form-control singledate" id="date" name="checkout_date" placeholder="" type="text" value="<?=set_value('checkout_date',$editdata['checkout_date']);?>">
						            <span class="error"><?=form_error('checkout_date')?></span>
						            <span data-tooltip="" class="has-tip tip-top" data-selector="tooltipy34ixm" title="E.g., 08/30/2017">More information?</span>
						          </div>
						          <div class="col-sm-6 <?=(form_error('checkout_time'))?'has-error':'';?>">
						          	<label for="" class="control-label">Time</label><br />
						            <input class="form-control timepicker" id="time" type="text" name="checkout_time" value="<?=set_value('checkout_time',$editdata['checkout_time']);?>">
						            <span class="error"><?=form_error('checkout_time')?></span>
						            <span data-tooltip="" class="has-tip tip-top" data-selector="tooltipk5bqet" title="E.g, 23:00">More information?</span>
						          </div>
						        </fieldset>
					    		</div>
					 			</div>
					   		<div class="row">
					   			<div class="col-sm-4">
					          <label for="" class="control-label">Cost Centre</label><br />
					          <?php echo form_dropdown('cost_centre', array('' => '-None-','Personal' => 'Personal',"SMPL"=>"SMPL","SNPL"=>"SNPL","SYN OCEA"=>"SYN OCEA","FOOD ALE"=>"FOOD ALE","SYN MARINE"=>"SYN MARINE","SGO MANILA"=>"SGO MANILA","VESSEL"=>"VESSEL"), set_value('cost_centre', $editdata['cost_centre']), 'class="form-control width_select"');?>
					          <span class="error"><?=form_error('cost_centre')?></span>
					        </div>
					    		<div class="col-sm-4 <?=(form_error('breakfast'))?'has-error':'';?>">
					        	<label for="" class="control-label">Breakfast </label><br />
					          <input class="form-control" placeholder="" type="text" name="breakfast" value="<?=set_value('breakfast',$editdata['breakfast']);?>">
					          <span class="error"><?=form_error('breakfast')?></span>
					    		</div>
					    		<div class="col-sm-4 <?=(form_error('lunch'))?'has-error':'';?>">
					        	<label for="" class="control-label">Lunch </label><br />
					          <input class="form-control" placeholder="" type="text" name="lunch" value="<?=set_value('lunch',$editdata['lunch']);?>">
					          <span class="error"><?=form_error('lunch')?></span>
					    		</div>
					 			</div>
					   		<div class="row">
					   			 <div class="col-sm-4 <?=(form_error('snacks'))?'has-error':'';?>">
							    	<label for="" class="control-label">Snacks</label><br />
							      <input class="form-control" placeholder="" type="text" name="snacks" value="<?=set_value('snacks',$editdata['snacks']);?>">
							      <span class="error"><?=form_error('snacks')?></span>
							    </div>
					    		<div class="col-sm-4 <?=(form_error('printout'))?'has-error':'';?>">
					        	<label for="" class="control-label">Print Out </label><br />
					          <input class="search-destiny form-control" name="printout" type="text" value="<?=set_value('printout',$editdata['printout']);?>">
					          <span class="error"><?=form_error('printout')?></span>
							    </div>
							    <div class="col-sm-4 <?=(form_error('laundry'))?'has-error':'';?>">
							      <label for="" class="control-label">Laundry</label><br />
							      <input class="search-destiny form-control" name="laundry" type="text" value="<?=set_value('laundry',$editdata['laundry']);?>">
							      <span class="error"><?=form_error('laundry')?></span>
							    </div>
					 			</div>
						   	<div class="row">
						   		<div class="col-sm-4 <?=(form_error('inv_address'))?'has-error':'';?>">
					          <label for="" class="control-label">Invoice Ref Address</label><br />
					          <?php echo form_dropdown('inv_address', array('' => '-None-')+get_address(), set_value('inv_address', $editdata['inv_address_id']), 'class="form-control width_select"');?>
					          <span class="error"><?=form_error('inv_address')?></span>
								  </div>
						   		
					    		<div class="col-sm-4 <?=(form_error('logistics'))?'has-error':'';?>">
					        	<label for="" class="control-label">Logistics </label><br />
					          <input class="search-destiny form-control" name="logistics" type="text" value="<?=set_value('logistics',$editdata['logistics']);?>">
					          <span class="error"><?=form_error('logistics')?></span>
					    		</div>
							    <div class="col-sm-4">
							      <label for="">Discount %  </label><br />
							      <input class="search-destiny form-control" name="discount" type="text" value="<?=set_value('discount',$editdata['discount']);?>">
							    </div>
							    <div class="col-sm-4 <?=(form_error('checked_in'))?'has-error':'';?>">
						      	<label for="" class="control-label">Checked In * </label><br />
						        <label class="radio-inline">
						        	<input type="radio" name="checked_in" value="Yes" <?=(isset($editdata['checked_in']) && $editdata['checked_in']=="Yes")?"checked":'';?>>Yes
						        </label>
					    			<label class="radio-inline">
					    				<input type="radio" name="checked_in" value="No" <?=(isset($editdata['checked_in']) && $editdata['checked_in']=="No")?"checked":'';?>>No
					    			</label>
					    			<span class="error"><?=form_error('checked_in')?></span>
					    		</div>
					 			</div>
							  <div class="row">
							  	<div class="col-sm-4"></div>
							    <div class="col-sm-4">
							      <button type="submit" class="btn btn-block btn-primary">Save</button>
							    </div>
					 			</div>
					 		</form>
						</div>
					</div>
				</div>
			</div>
  	<!-- Three columns of text below the carousel -->
 	</div>
</div>
<!-- FOOTER -->