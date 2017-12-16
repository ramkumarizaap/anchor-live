<?php

$uri = $this->uri->segment(1);
$uri1 = $this->uri->segment(2);
$data = is_logged_in();
$user = $this->session->userdata("user_data");
?>
<section class="header clearfix">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?=base_url();?>">
        <img src="<?=base_url();?>assets/images/logo.png" width="55" height="53">
        Anchorpoint
      </a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="navbar-collapse collapse" id="navbarCollapse" style="">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?=($uri=='home' || $uri=='')?"main-menu-active":"";?>"><a class="nav-link " href="<?=base_url();?>home">Home</a> </li>
          <?php 
          if(!$data)
          {
            ?>
              <li class="nav-item <?=($uri=='login')?"main-menu-active":"";?> ">
                    <a class="nav-link " href="<?=base_url();?>login">Login</a>
              </li>
            <?php
          }
          ?>
          <?php 
          if($data)
          {
            ?>
            <?php
                if($user['role']=="1" || $user['role']=="2"){?>
              <li class="nav-item <?=($uri=='booking' && $uri1=="create")?"main-menu-active":"";?> ">
                <a class="nav-link " href="<?=base_url();?>booking/create">Book a Room</a>
              </li>
              <?php }?>
              <?php
                if($user['role']=="1" || $user['role']=="2" || $user['role']=="3" || $user['role']=="4"){?>
              <li class="nav-item <?=($uri=='booking' && $uri1=="logs")?"main-menu-active":"";?>">
                <a class="nav-link" href="<?=base_url();?>booking/logs">Booking Log</a>
              </li>
              <?php }?>
              <?php
                if($user['role']=="1" || $user['role']=="2" || $user['role']=="3"){?>
              <li class="nav-item <?=($uri=='taxi' && ($uri1=="logs" || $uri1=="create"))?"main-menu-active":"";?> ">
                <a class="nav-link " href="<?=base_url();?>taxi/logs">Book a Taxi</a>
              </li>
              <?php }?>
              <?php
                if($user['role']=="1" || $user['role']=="2" || $user['role']=="3" || $user['role']=="4" || $user['role']=="5"){?>
              <li class="nav-item <?=($uri=='room' && $uri1=="status")?"main-menu-active":"";?>">
                <a class="nav-link " href="<?=base_url();?>room/status">Room Status</a>
              </li>
              <?php }?>
              <?php
                if($user['role']=="1" || $user['role']=="2" || $user['role']=="4" || $user['role']=="5"){?>
              <li class="nav-item <?=($uri=='feedback' && $uri1!="contact")?"main-menu-active":"";?>">
                <a class="nav-link " href="<?=base_url();?>feedback">All Feedback</a> </li>
              <?php }?>
                <?php
                if($user['role']=="1"){?>
              <li class="nav-item <?=($uri=='services')?"main-menu-active":"";?>">
                <a class="nav-link srviceslink" href="javascript:void(0);">Services</a>
                <ul>
                  <li class="<?=($uri=='services' && $uri1=="rooms")?"active":"";?>"><a href="<?=base_url();?>services/rooms">Manage Rooms</a></li>
                  <li class="<?=($uri=='services' && $uri1=="executives")?"active":"";?>"><a href="<?=base_url();?>services/executives">Manage Executives</a></li>
                  <li class="<?=($uri=='services' && $uri1=="rank")?"active":"";?>"><a href="<?=base_url();?>services/rank">Manage Rank</a></li>
                  <li class="<?=($uri=='services' && $uri1=="vessels")?"active":"";?>"><a href="<?=base_url();?>services/vessels">Manage Vessels</a></li>
                  <li class="<?=($uri=='services' && $uri1=="inv_address")?"active":"";?>"><a href="<?=base_url();?>services/inv_address">Manage Inv Address</a></li>
                  <li class="<?=($uri=='services' && $uri1=="purpose")?"active":"";?>"><a href="<?=base_url();?>services/purpose">Manage Purpose</a></li>
                  <li class="<?=($uri=='services' && $uri1=="cost_centre")?"active":"";?>"><a href="<?=base_url();?>services/cost_centre">Manage Cost Centre</a></li>
                </ul>
              </li>
              <?php }?>
              <li class="nav-item"> <a class="nav-link " href="<?=base_url();?>login/logout"> Logout</a></li>
              <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
    <div class="feedback-menu">
      <a href="<?=base_url();?>feedback/contact"><img src="<?=base_url();?>assets/images/feedback.gif"></a>
    </div>
</section>