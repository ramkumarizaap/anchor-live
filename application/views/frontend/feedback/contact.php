<div class=" container-fluid inner-page">
	<div class="row">
 		<div class="page-title">
 			<div class="container">
 				<h1>Contact Form</h1>
 			</div>
		</div>
  </div>
	<div class="container marketing pad-top pad-bot contact-cztm">
	  <div class="inner-page">     
	   <?php display_flashmsg($this->session->flashdata()); ?>
	    <!-- Three columns of text below the carousel -->
	    <div class="row">
	       <div class="col-lg-1"></div>    
	      <div class="col-lg-10">
	      	<form action="" method="post">
					  <div class="row">
					    <div class="col-md-6 mb-3 <?=(form_error('name'))?'has-error':'';?>">      
					      <input type="text" class="form-control" placeholder="Name" name="name" value="<?=set_value('name',$editdata['name']);?>">
					      <span class="error"><?=form_error('name');?></span>
					    </div>
					    <div class="col-md-6 mb-3 <?=(form_error('rank'))?'has-error':'';?>">
					      <input type="text" class="form-control" placeholder="Rank" name="rank" value="<?=set_value('rank',$editdata['rank']);?>">
					      <span class="error"><?=form_error('rank');?></span>
					    </div>
					  </div>
					  <div class="row">
					    <div class="col-md-12 mb-3 <?=(form_error('room_id'))?'has-error':'';?>">
					      <?php echo form_dropdown('room_id', array('' => '-None-')+get_rooms(), set_value('room_id', $editdata['room_id']), 'class="form-control width_select select2" data-placeholder="Room Name"');?>
					      <span class="error"><?=form_error('room_id');?></span>
					    </div>
					  </div>
					  <div class="row">
					    <div class="col-md-6 mb-3 <?=(form_error('email'))?'has-error':'';?>">
					      <input type="text" class="form-control" placeholder="Email" name="email" value="<?=set_value('email',$editdata['email']);?>">
					      <span class="error"><?=form_error('email');?></span>
					    </div>
					        <div class="col-md-6 mb-3 <?=(form_error('phone'))?'has-error':'';?>">
					         <input type="phone" class="form-control" name="phone" placeholder="Contact number" value="<?=set_value('phone',$editdata['phone']);?>" >
					         <span class="error"><?=form_error('phone');?></span>
					    </div>
					  </div>
				    <div class="row">
				    	<div class="col-md-12 mb-3 <?=(form_error('comments'))?'has-error':'';?>">
				      	<textarea class="form-control" rows="3" name="comments" placeholder="Comments"><?=set_value('comments',$editdata['comments']);?></textarea>
				      	<span class="error"><?=form_error('comments');?></span>
				    	</div>
				  	</div>
	    			<div class="row">
	      			<div class="col-md-5 mb-3"></div>
	    				<div class="col-md-2 mb-3">
	      				<button class="btn btn-primary btn-block btn-lg" type="submit">SUBMIT</button>
	    				</div>
	    				<div class="col-md-5 mb-3"></div>
					  </div>
					</form>
	      </div>
				<div class="col-lg-1"></div>
	    </div>   
	  </div>
	    <!-- /.row --> 
	</div>
</div>