<div class=" container-fluid inner-page"> 
  <div class="row">
    <div class="page-title">
      <div class="container">
        <h1>Room Status</h1>
      </div>
    </div>
  </div>
  <div class="container marketing pad-top pad-bot">
    <?php display_flashmsg($this->session->flashdata()); ?>
    <div class="inner-page">    
      <!-- Three columns of text below the carousel -->
     <!--  <div class="row pad-bot">
        <div class="col-sm-12">
          <a href="<?=base_url();?>room/create/" class="btn btn-danger">Create Room</a>
        </div>
      </div> -->
      <?=$grid;?>
    </div>
    <!-- /.row --> 
  </div>
</div>