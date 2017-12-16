<div class=" container-fluid inner-page"> 
<div class="row">
 <div class="page-title"><div class="container"><h1>User account</h1></div></div></div>
<div class="container marketing pad-top pad-bot room-status user-account">
  <div class="inner-page"> 
    
    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-md-6" style="margin: 0 auto;">
      <?php display_flashmsg($this->session->flashdata()); ?>
      <div class="">
        <div class="tabbable-panel">
          <div class="tabbable-line">
            <ul class="nav nav-tabs ">
              <li class="active"><a href="#tab_default_1" data-toggle="tab">Login</a></li>
              <li><a href="#tab_default_2" data-toggle="tab">Request New Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_default_1">
                <form class="form-horizontal" role="form" method="POST" action="<?=base_url();?>login/login">
                  <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-12">
                          <h2>Login</h2>
                          <hr>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group has-danger">
                              <label class="sr-only" for="email">E-Mail Address</label>
                              <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                  <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                                  <input type="text" name="email" class="form-control" id="name"
                                         placeholder="Email-ID"  autofocus>
                              </div>
                          </div>
                      </div>
                      <?php if(form_error('email')){?>
                      <div class="col-md-12">
                          <div class="form-control-feedback">
                              <span class="text-danger align-middle">
                                   <?=form_error('email');?>
                              </span>
                          </div>
                      </div>
                      <?php }?>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label class="sr-only" for="password">Password</label>
                              <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                  <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                                  <input type="password" name="password" class="form-control" id="password"
                                         placeholder="Password" >
                              </div>
                          </div>
                      </div>
                      <?php if(form_error('password')){?>
                      <div class="col-md-12">
                          <div class="form-control-feedback">
                              <span class="text-danger align-middle">
                                <?=form_error('password');?>
                              </span>
                          </div>
                      </div>
                      <?php }?>
                  </div>
                  <div class="row">
                      <div class="col-md-12" style="padding-top: .35rem">
                          <div class="form-check mb-2 mr-sm-2 mb-sm-0">
                              <label class="form-check-label">
                                  <input class="form-check-input" name="remember"
                                         type="checkbox" >
                                  <span style="padding-bottom: .15rem">Remember me</span>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="row login-s">
                      <div class="col-md-12 text-center" style="background: none !important;">
                          <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-sign-in"></i> Login</button>
                      </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="tab_default_2">
                <form class="form-horizontal" role="form" method="POST" action="<?=base_url();?>login/request_password">
                  <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-12">
                          <h2>Request New Password</h2>
                          <hr>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group has-danger">
                              <label class="sr-only" for="email">E-Mail Address</label>
                              <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                  <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                                  <input type="text" name="email" class="form-control" id="name"
                                         placeholder="Email-ID"  autofocus>
                              </div>
                          </div>
                      </div>
                      <?php if(form_error('email')){?>
                      <div class="col-md-12">
                          <div class="form-control-feedback">
                              <span class="text-danger align-middle">
                                   <?=form_error('email');?>
                              </span>
                          </div>
                      </div>
                      <?php }?>
                  </div>
                  <div class="row login-s">
                    <div class="col-md-12 text-center " style="background: none !important;">
                      <button type="submit" class="btn btn-primary btn-md">Email New Password</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
       </div>
     </div>
    </div>   
    </div>
    <!-- /.row --> 
  </div>
</div>

<!-- FOOTER -->