// You can also manually force this event to fire.
// $( window ).orientationchange();



$(window).scroll(function(){
     if($(this).scrollTop() > 0 ){

      $("body").removeClass("largelogo");
      }
     else{
     $("body").addClass("largelogo");
     }

     });  


$(document).ready(function(){


	//$('a,button').tooltip();

   
 $('.datepicker').datepicker({
    format:"yyyy-M-dd",
    autoclose:true,
    todayHighlight:true,
  }).on('changeDate',function(selected){
    FromStartDate = new Date(selected.date.valueOf());
    FromStartDate.setDate(FromStartDate.getDate(new Date(selected.date.valueOf())));
    $('.singledate-to').datepicker('setStartDate', FromStartDate);
    get_days();
  });
  $('.singledate-to').datepicker({
    format:"yyyy-M-dd",
    todayHighlight:true,
    autoclose:true,
  }).on('changeDate',function(selected){
    cin_date = new Date($("#checkin_date").val());
    FromEndDate = new Date(selected.date.valueOf());
    FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
		// $('.datepicker').datepicker('setEndDate', FromEndDate);
      if (FromEndDate < cin_date)
        {
          alert("Checkout Date should be greater than Checkin Date");
          $("#checkout_date").val("");
        }
        get_days();
     
  });

 $("#checkin_time,#checkout_time").on('blur',function(){
    get_days();
 });
// $('.timepicker').wickedpicker();
   
  $('.select2').select2();

setTimeout(function(){
  $(".booking_log th.sorting_disabled").each(function(i){
    style = $(this).attr("style");
    style = style.split(":");
    $(this).css("min-width",style[1].replace(";",""));
  });
},3000);


 $('#allinone_bannerRotator_classic').allinone_bannerRotator({
                skin: 'classic',
                width: 1900,
                height: 746,
                width100Proc:true,
                showPreviewThumbs:false,
                showAllControllers:true,
                autoHideNavArrows:false,
                autoHideBottomNav:false,
                defaultEffect:'topBottomDiagonalBlocks',
                responsive:true,
                thumbsWrapperMarginBottom:5,
                defaultEffect: 'random'
            });     




	$('input[id=base-input]').change(function() {
        $('#fake-input').val($(this).val().replace("C:\\fakepath\\", ""));
    });
$("#pdfForm").dropzone({
    maxFiles: 1,
    addRemoveLinks:true,
    acceptedFiles:"application/pdf",
    dictRemoveFile:"Remove",
    dictDefaultMessage:"Drag or Drop pdf here<br>(Or)<br>Browse File (Click)",
    url:base_url+'booking/pdfupload',
    success:function(data)
    {
      data = JSON.parse(data.xhr.response);
      console.log(data);
       $("input[name='officer_name']").val(data['officer_name']);
        $("input[name='po_no']").val(data['po_no']);
        $("input[name='checkin_date']").val(data['checkin_date']);
        $("input[name='checkin_time']").val(data['checkin_time']);
        if(data['checkout_date']!='' && data['checkout_time']!='')
        {
          $("input[name='checkout_date']").val(data['checkout_date']);
          $("input[name='checkout_time']").val(data['checkout_time']);
        }
        $("select[name='rank']").val(data['rank']).change();
        $("select[name='executive']").val(data['executive']).change();
        $("select[name='vessel']").val(data['vessel']).change();
    },
    reset:function()
    {
      $("form.bookingForm")[0].reset();
      $(".dz-message").show();
      $('.select2').val(null).trigger("change");
    },
    complete:function()
    {
      $(".dz-message").hide();
    },
    processing:function()
    {
      $(".dz-message").hide();
    }
  });

 
  $("form#LocationForm").submit(function(e){
      e.preventDefault();
      form = $(this).serializeArray();
      if(form[0].value=="")
      {
        $(".msg").addClass("red");
        $(".msg").html("Please Enter Location Name");
        return false;
      }      
      $.ajax({
      type:"POST",
      url:base_url+"taxi/add_location",
      data:form,
      success:function(data)
      {
        data = JSON.parse(data);
        $(".msg").addClass(data.class);
        $(".msg").html(data.msg);
        $("form#LocationForm")[0].reset();
      },
      error:function(data)
      {
        refresh_grid();
      }
    });
  });
  $("form#ChargeForm").submit(function(e){
      e.preventDefault();
      valid = 0;
      form = $(this).serializeArray();
      $("form#ChargeForm input,form#ChargeForm select").each(function(i,ele){
        if($(this).val()=="")
        {
          $(ele).next(".msg").addClass("red");
          str = $(this).attr("name").replace("_"," ");
          $(ele).next(".msg").html("The "+str+" field is required");
          valid++;
        }
        else if($(this).val()!="")
        {
          $(ele).next(".msg").html("");
          $(ele).next(".msg").removeClass("red");
        }
      });
      if(valid==0 || valid=="0")
      { 
        $.ajax({
          type:"POST",
          url:base_url+"taxi/add_charge",
          data:form,
          success:function(data)
          {
            console.log(data);
            data = JSON.parse(data);
            $("form#ChargeForm .msg.last-msg").addClass(data.class);
            $("form#ChargeForm .msg.last-msg").html(data.msg);
            $("form#ChargeForm")[0].reset();
            setTimeout(function(){
              $("form#ChargeForm .msg.last-msg").html("");
            },"3000");
          },
          error:function(data)
          {
            refresh_grid();
          }
        });
      }
  });

  $("select.waiting_charge,input.taxi_kms,select.day_select,input[name='rate'],form.bookingForm select[name='from'],form.bookingForm select[name='to']").on('change keyup click',function(){
    ch = $("input.taxi_charge");
    waiting = $("select.waiting_charge").val();
    kms = $("input.taxi_kms").val();
    day = $("select.day_select").val();
    rate = $("input[name='rate']:checked").val();
    from = $("form.bookingForm select[name='from']").val();
    to = $("form.bookingForm select[name='to']").val();
    if(day!="")
    {
      $.ajax({
        type:"POST",
        url:base_url+"taxi/get_charge",
        data:{waiting:waiting,kms:kms,day:day,rate:rate,from:from,to:to},
        success:function(data)
        {
          console.log(data);
          data = JSON.parse(data);
          ch.val(data.amount);
          if(rate=="Fixed")
            $("input.taxi_kms").val(data.kms);
        },
        error:function(data)
        {
          console.log(data);
        }
      });
    }
  });

  $("form#ChargeForm .to_select,form#ChargeForm .from_select").change(function(){
    from = $("form#ChargeForm .from_select").val();
    to = $("form#ChargeForm .to_select").val();
    $.ajax({
      type:"POST",
      url:base_url+"taxi/ajax_get_charge",
      data:{from:from,to:to},
      success:function(data)
      {
        if(data!='')
        {
          data = JSON.parse(data);
          console.log(data);
          $("form#ChargeForm input[name='kms']").val(data.kms);
          $("form#ChargeForm input[name='fixed_day_charge']").val(data.day_charge);
          $("form#ChargeForm input[name='fixed_night_charge']").val(data.night_charge);
        }
      }
    });
  });

$("form.operationForm").submit(function(e){
  e.preventDefault();
  form = $(this).serializeArray();
  var val = $.map($('input[name="op_select[]"]:checked'), function(c){return c.value; })
  form.push({name:"opt",value:val});
  // console.log(form);
  $.ajax({
    type:"POST",
    url:base_url+"booking/operation",
    data:form,
    success:function(data)
    {
      console.log(data);
      $.fn.init_progress_bar();
      $("form.operationForm")[0].reset();
      refresh_grid();
    },
    error:function(data)
    {
      refresh_grid();
    }
  });
 });

$("form#executiveForm,form#rankForm,form#vesselForm,form#roomForm,form#addressForm,form#purposeForm,form#costForm").submit(function(e){
  e.preventDefault();
  form = $(this).serializeArray();
  $.ajax({
    type:"POST",
    url:base_url+"services/add_services",
    data:form,
    success:function(data)
    {
      refresh_grid();
      console.log(data);
      console.log(form[0].value);
      data = JSON.parse(data);
      $("form#"+form[0].value).find(".msg").addClass(data.status);
      $("form#"+form[0].value).find(".msg").html(data.msg);
      $.fn.init_progress_bar();
      $("form#"+form[0].value)[0].reset();
      setTimeout(function(){
        $("form#"+form[0].value).find(".msg").html("");
      },3000);
    },
    error:function(data)
    {
      refresh_grid();
    }
  });
});

$("input[name='check-all']").click(function(){
  st = $(this).prop('checked');
  if(st)
    $("input[name='op_select[]']").prop('checked',true);
  else
    $("input[name='op_select[]']").prop('checked',false);
});


$(".export-excel").click(function(){
  $.ajax({
    type:"POST",
    url:base_url+"taxi/export_excel",
    data:"",
    success:function(data)
    {
      $("form#exportForm")[0].reset();
      console.log(data);
    },
    error:function(data)
    {
      console.log(data);
    }
  });
});

$("form#InoviceForm").submit(function(e){
  e.preventDefault();
  var allVals = [];
     $("input[name='r_id[]']:checked").each(function() {
       allVals.push($(this).val());
     });
     form = $(this).serializeArray();
     // console.log(form);
     // return false;
     if(allVals.length > 0)
     {
        $.ajax({
          type:"POST",
          url:base_url+"booking/invoice",
          data:form,
          dataType:'json',
          success:function(data)
          {
            console.log(data);
            if(data.status=='success')
            {
              $(".modal-invoice-body").html(data.msg);
              $("form#InoviceForm button[type='submit']").hide();
              $("form#InoviceForm .cancel-btn").text("Close");
              refresh_grid();
            }
          },
          error:function(data)
          {

          }
        });
     }
     else
     {
        alert("Please check anyone checkbox");
     }
});

$("form#SignatureForm").submit(function(e){
  e.preventDefault();
  form = $(this).serializeArray();
  len1 = $("#linear").signaturePad();
  len2 = $("#linear1").signaturePad();
  if($("#linear").is(":visible") && len1.getSignature().length > 0)
  {
    e_sign = len1.getSignatureImage();
    form.push({name:'e_sign',value:e_sign});
  }
  if($("#linear1").is(":visible") && len2.getSignature().length > 0)
  {
    o_sign = len2.getSignatureImage();
    form.push({name:'o_sign',value:o_sign});
  }
  console.log(len1);
  console.log(len2);
  $.ajax({
    type:"POST",
    url:base_url+"booking/submit_sign",
    data:form,
    dataType:'json',
    success:function(data)
    {
      $(".modal-signature-body").html("<h3>"+data.msg+"</h3>");
      $(".remodal .btn-success").hide();
      refresh_grid();
    }
  });
});


init_datatable();init_checkbox();

var mql = window.matchMedia("(orientation: portrait)");
console.log(mql);
// If there are matches, we're in portrait
if(mql.matches) { 
  // alert("Portrait");
  // Portrait orientation
} else {  
  // Landscape orientation
  // alert("Landscape1");
  // init_signature();
}

// Add a media query change listener
mql.addListener(function(m) {
style = $("#linear").width();
style1 = $("#linear1").width();
$(".pad1").attr("width",parseInt(style) - parseInt(5));
$(".pad2").attr("width",parseInt(style1) - parseInt(5));
  
});



});	


function init_datatable()
{
  $("#example1").DataTable({ "scrollY": 350,"scrollX": true,paging:false,searching:false,ordering:false,info:false});
}

function get_status()
{
  $(".remodal.room .modal-body").html("<img src='"+base_url+"/assets/images/loading.gif'>");
  $(".room_modal").trigger('click');
  $.ajax({
    type:"POST",
    url:base_url+"roombooking/room_status",
    data:"",
    success:function(data)
    {
      console.log(data);
      data = JSON.parse(data);
      $(".remodal.room .modal-body").html(data.msg);
    },
    error:function(data)
    {
      console.log(data);
    }
  });
}
function init_checkbox(selval)
{
  // selval = selval?selval:'';
  // if(selval){   
  //   $.each(selval, function( index, value ) {
  //     $('#checkbox-'+value).attr('checked', true);
  //   }); 
  // }
  // $(".checkbox").checkboxradio({ icon: false });
  $("input[name='check-all']").click(function(){
  st = $(this).prop('checked');
  if(st)
    $("input[name='op_select[]']").prop('checked',true);
  else
    $("input[name='op_select[]']").prop('checked',false);
});

}


function get_services(ele)
{
  id = $(ele).attr("data-id");
  table = $(ele).attr("data-table");
  if(table=="executives")
    form = $("form#executiveForm");
  else if(table=="rank")
    form = $("form#rankForm");
  else if(table=="vessels")
    form = $("form#vesselForm");
  else if(table=="rooms")
    form = $("form#roomForm");
  else if(table=="invoice_address")
    form = $("form#addressForm");
  else if(table=="purpose")
    form = $("form#purposeForm");
  else if(table=="cost_centre")
    form = $("form#costForm");
   $.ajax({
    type:"POST",
    url:base_url+"services/get_services",
    data:{id:id,table:table},
    success:function(data)
    {
      console.log(data);
      data = JSON.parse(data);
      if(table=="invoice_address")
        form.find("textarea[name='name']").val(data.address);
      else
        form.find("input[name='name']").val(data.name);
      if(table=="rooms")
        form.find("input[name='tariff']").val(data.tariff);
      form.find("select[name='status']").val(data.status);
      form.find("input[name='id']").val(data.id);
    },
    error:function(data)
    {
      refresh_grid();
    }
  });
}

function getFormatDate(d){
    return d.getMonth()+1 + '/' + d.getDate() + '/' + d.getFullYear()
}


function numbersonly(e) {
  var unicode=e.charCode? e.charCode : e.keyCode
  //alert(unicode)
  if (unicode!=8 && unicode != 46){ //if the key isn't the backspace key (which we should allow)
  if (unicode<48||unicode>57) //if not a number
    {
      if(unicode==8 || unicode==46 || unicode == 37 || unicode == 39)//To  enable tab index in firefox and mac.(TAB, Backspace and DEL from the keyboard)
      return true
        else
      return false //disable key press
    }
  }
}

//to delete selected record from list.
function delete_record(del_url,elm){

	$("#div_service_message").remove();
    
    	retVal = confirm("Are you sure to remove?");

        if( retVal == true ){
   
            $.post(base_url+del_url,{},function(data){           
                console.log(data);
                if(data.status == "success"){
                //success message set.
                service_message(data.status,data.message);
                
                //grid refresh
                refresh_grid();
    
            }
            else if(data.status == "error"){
                 //error message set.
                service_message(data.status,data.message);
            }
            
            },"json");
       }  
      
      
}


/* refresh grid after ajax submitting form */
function refresh_grid(data_tbl){
     
     data_tbl =(data_tbl)?data_tbl:"data_table";
     var cur_page = $("#base_url").val()+$("#cur_page").val();
     $.fn.init_progress_bar();
     $.fn.display_grid(cur_page,data_tbl);
}

function service_message(err_type,message,div_id){
    
    div_id = (div_id)?div_id:false; 	

    $("#div_service_message").remove();
    
    var str  ='<div id="div_service_message" class="alert alert-'+err_type+' alert-dismissible">';
        str +='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
	    str +='<strong>'+capitaliseFirstLetter(err_type)+':&nbsp;</strong>';
	    str += message;
        str +='</div>';
        
        if(div_id){
             $("#"+div_id).html(str);
        }
        else
        {
            $(".blue-mat").after(str);
            scroll_to("div_service_message");
        }
            
}

function scroll_to(jump_id){
    //page scroll
    if(jump_id !=""){
       $(window).scrollTop($('#'+jump_id).offset().top); 
    }
}

function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function genInvoice()
{
  sel = $("select[name='order']").val();
  if(sel=="2")
  {
   var allVals = [];
     $("input[name='op_select[]']:checked").each(function() {
       allVals.push($(this).val());
     });
    if(allVals.length>0)
    {
      $('[data-remodal-id=invoice]').remodal().open();
      $.ajax({
        type:"POST",
        url:base_url+"booking/get_selected_records",
        data:{id:allVals},
        dataType:'json',
        success:function(data)
        {
          console.log(data);
          $(".modal-invoice-body").html(data.msg);
          $("form#InoviceForm button[type='submit']").show();
        },
        error:function(data)
        {

        }
      });
    }
    else
    {
      alert("Please check anyone of the records");
    }
  }
  else
  {
    $(".operationForm").submit();
  }
}

function get_days()
{
  var checkin_date = get_month($("#checkin_date").val());
  var checkout_date = get_month($("#checkout_date").val());
  var checkin_time = $("#checkin_time").val();
  var checkout_time = $("#checkout_time").val();
  var days = 0;
  if(checkin_date!='' && checkout_date!='')
  {
     checkin_time = (checkin_time!='')? checkin_time:'00:00';
     checkout_time = (checkout_time!='')? checkout_time:'23:59';

     checkin_date = checkin_date + ' '+ checkin_time;
     checkout_date = checkout_date + ' '+ checkout_time;
     checkin_date = new Date(checkin_date);     
     checkout_date = new Date(checkout_date);  
     var mStart = moment.utc(checkin_date);
     var mEnd = moment.utc(checkout_date);
  // Calculate difference and create duration
     var dur = moment.duration( mEnd.diff(mStart) );

    days = dur.days();
    if(days)
      days = (dur.hours() > 4)? days+1 :days;
    else
      days = 1;

  }
 
  $(".no_of_days").text(days).val(days);
}

function get_month(date='')
{
  mon='';
  date = date.split('-');
  name = date[1];
  switch(name)
  {
    case 'Jan':
      mon = date[0]+'-01-'+date[2];
    break;
    case 'Feb':
      mon = date[0]+'-02-'+date[2];
    break;
    case 'Mar':
      mon = date[0]+'-03-'+date[2];
    break;
    case 'Apr':
      mon = date[0]+'-04-'+date[2];
    break;
    case 'May':
      mon = date[0]+'-05-'+date[2];
    break;
    case 'Jun':
      mon = date[0]+'-06-'+date[2];
    break;
    case 'Jul':
      mon = date[0]+'-07-'+date[2];
    break;
    case 'Aug':
      mon = date[0]+'-08-'+date[2];
    break;
    case 'Sep':
      mon = date[0]+'-09-'+date[2];
    break;
    case 'Oct':
      mon = date[0]+'-10-'+date[2];
    break;
    case 'Nov':
      mon = date[0]+'-11-'+date[2];
    break;
    case 'Dec':
      mon = date[0]+'-12-'+date[2];
    break;
  }
  return mon;
}

function getSignature(id='')
{
  $('[data-remodal-id=signature]').remodal().open();
 
  $.ajax({
    type:"POST",
    url:base_url+"booking/signature_form",
    data:{id:id},
    dataType:'json',
    success:function(data)
    {
      console.log(data);
      $(".modal-signature-body").html(data.msg);
       style = $("#linear").width();
       style1 = $("#linear1").width();
      $(".pad1").attr("width",parseInt(style) - parseInt(5));
      $(".pad2").attr("width",parseInt(style1) - parseInt(5));
      init_signature();
    },
    error:function(data)
    {
      console.log(data);
    }
  });
}

function init_signature()
{
  $('#linear,#linear1').signaturePad({drawOnly:true, lineTop:0,penColour:"#000000"});
}


function pending()
{
  //alert(base_url+"booking/get_pending_records");
  var pending="1";
  $.ajax({
        type:"POST",
        url:base_url+"booking/get_pending_records",
        data:{id:pending},
        dataType:'json',
        success:function(res)
        {
         // alert(res);
      $("#pending_room").html(res.messages);
        }
     
      });
}

//$('tbody').sortable();


$("tbody").sortable({
  //var check= $(this).attr("data-id");
  //alert(check);
  update  : function(event, ui)
  {
  //check= $(this).attr("data-id");
   //var page_id_array = new Array();
  //alert(page_id_array);
  var page_id_array = [];
  i = 1;

   $('.ui-sortable tr').each(function(){
   //alert($(this).attr('id'));
   //alert(page_id_array.push($(this).attr('id')));
    page_id_array.push($(this).attr('id'));
    //alert(page_id_array);
   });
   //console.log(page_id_array);
   $.ajax({
        type:"POST",
        url:base_url+"services/get_page_id",
        data:{id:page_id_array},
        dataType:'html',
        success:function(data)
        {
          //alert(data);
         alert("Position Updated Successfully");
         //refresh_grid();
        }
     
      });
  }
 });

