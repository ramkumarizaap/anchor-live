<div class=" container-fluid inner-page"> 
<div class="row">
 <div class="page-title"><div class="container"><h1>User Account</h1></div></div></div>
<div class="container marketing pad-top pad-bot room-status user-account">
  <div class="inner-page">    
    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-md-6" style="margin: 0 auto;">
      <?php display_flashmsg($this->session->flashdata()); ?>
      <div class="">
        <form class="form-horizontal" role="form" method="POST" action="<?=base_url();?>login/reset/<?=$email;?>">
          <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-12">
                  <h2>Reset Password</h2>
                  <hr>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group has-danger">
                      <label class="sr-only" for="email">New Password</label>
                      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                          <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                          <input type="password" name="npassword" class="form-control" id="name"
                                 placeholder="New Password"  autofocus value="<?=set_value('npassword',$editdata['npassword']);?>">
                      </div>
                  </div>
              </div>
              <?php if(form_error('npassword')){?>
              <div class="col-md-6">
                  <div class="form-control-feedback">
                      <span class="text-danger align-middle">
                           <?=form_error('npassword');?>
                      </span>
                  </div>
              </div>
              <?php }?>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label class="sr-only" for="password">Confirm Password</label>
                      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                          <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                          <input type="password" name="cpassword" class="form-control" id="password"
                                 placeholder="Confirm Password" value="<?=set_value('cpassword',$editdata['cpassword']);?>" >
                      </div>
                  </div>
              </div>
              <?php if(form_error('cpassword')){?>
              <div class="col-md-12">
                  <div class="form-control-feedback">
                      <span class="text-danger align-middle">
                        <?=form_error('cpassword');?>
                      </span>
                  </div>
              </div>
              <?php }?>
          </div>
          <div class="row login-s">
              <div class="col-md-6">
                  <button type="submit" class="btn btn-primary btn-md"> Reset</button>
              </div>
          </div>       
      </div>
    </div>   
  </div>
    <!-- /.row --> 
  </div>
</div>

<!-- FOOTER -->