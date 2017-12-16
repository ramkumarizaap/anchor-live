<div class="row" style="margin: 0">
	<input type="hidden" name="id" value="<?=$result['id'];?>">
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label">Officer Name : <b><?=$result['officer_name'];?></b></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label">Invoice No : <b><?=$result['inv_no'];?></b></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label">Occupancy : <b><?=$result['occupancy'];?></b></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label">Checkin Date : <b><?=$result['checkin_date']." ".$result['checkin_time'];?></b></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label">Checkout Date : <b><?=$result['checkout_date']." ".$result['checkout_time'];?></b></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label">No.of Days : <b><?=$result['no_of_days'];?></b></label>
		</div>
	</div>
</div>
<div class="row" style="margin: 0;display: block;">
	<div class="col-md-4 pull-left">
		<?php if($result['executive_sign']==''){?>
		<div class="sigPad" id="linear">
			<ul class="sigNav">
				<li class="clearButton"><a class="btn btn-danger btn-xs" href="#clear">Clear</a></li>
			</ul>
			<div class="sig sigWrapper" style="height:auto;">
				<canvas class="pad pad1" height="150"></canvas>
			</div>
			<small>(Executive Signature)</small>
		</div>
		<?php }else{?>
			<img src="<?=$result['executive_sign'];?>"><br>
			<small>(Executive Signature)</small>
		<?php }?>
	</div>
	<div class="col-md-4 pull-right">
		<?php if($result['officer_sign']==''){?>
		<div class="sigPad" id="linear1">
			<ul class="sigNav">
				<li class="clearButton"><a class="btn btn-danger btn-xs" href="#clear">Clear</a></li>
			</ul>
			<div class="sig sigWrapper" style="height:auto;">
				<canvas class="pad pad2" height="150"></canvas>
			</div>
			<small>(Officer Signature)</small>
		</div>
		<?php }else{?>
			<img src="<?=$result['officer_sign'];?>"><br>
			<small>(Officer Signature)</small>
		<?php }?>
	</div>
</div>
<div class="clearfix"></div><br>
<div class="row" style="margin: 0">
	<div class="col-md-12">
		<a data-remodal-action="cancel" class="btn btn-primary pull-right" href="#">Cancel</a>
		<?php if($result['officer_sign']=='' || $result['executive_sign']==''){?>
	 		<button type="submit" class="btn btn-success pull-right margin-right-20">Submit</button>
	 		<?php }?>
	</div>
</div>