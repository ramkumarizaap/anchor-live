<div class=" container-fluid inner-page"> 

<div class="row">

 <div class="page-title"><div class="container"><h1>Room Booking Log</h1></div></div></div>

<div class="container marketing pad-top pad-bot booking-a-log"> 
<div class="blue-mat">
 <?php display_flashmsg($this->session->flashdata()); ?>
</div>



<?=$grid;?>

<div class="remodal modal-lg" data-remodal-id="signature">
  <a data-remodal-action="close" class="remodal-close"></a>
  <form method="post" id="SignatureForm" action="">
    <h2>Signature Form</h2><br>
    <div class="modal-signature-body" style="max-height: 400px;overflow-y:auto; ">

	 
  </form>
</div>