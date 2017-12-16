<?php

$total =  $invoice['charge'];

?>

<table width="100%" border="1" cellspacing="0" cellpadding="0" class="billing-cztm-t1 invoicetable" >

  <tr style="background: #fff;border: 1px solid black;border-bottom: none; ">

    <td style="padding: 5px;" colspan="6" align="center" valign="middle">

          <img src="<?=base_url();?>assets/images/logo-old.png" style="height: 70px;width: 70px;vertical-align: top;">

          <h6 style="font-size:1.40rem;padding-top: 12px;display: inline-block;margin: 0 auto;">ANCHORPOINT HOSPITALITY PRIVATE LIMITED

            <br><small style="float: right;font-size: 14px;font-style: italic;margin-right: 10px;">Your Own Space</small></h6>

        </td>

  </tr>

  <tr align="center" style="background: rgb(227, 224, 255);border: 1px solid #000;border-top: none;border-bottom: none;">

    <td style="padding: 5px;font-size: 12px;" colspan="6" align="center" valign="middle">3A,3B & 3C Aiswarya Prapancha Apartments, Madha Koil Street, Thoraipakkam,Chennai.</td>

  </tr>

  <tr align="center" style="border: 1px solid #000;border-top: none;border-bottom: none;">

    <td style="padding: 5px;font-size: 12px;" colspan="6" align="center" valign="middle">

      <strong>CIN - U55101KA2014PTC076899</strong>

    </td>

  </tr>

  <tr align="center" style="background: rgb(227, 224, 255);">

    <td style="padding: 5px;font-size: 12px;" colspan="6" align="center" valign="middle"> <strong>INVOICE</strong></td>

  </tr>

  <tr style="">

    <td style="padding: 5px;" colspan="2" align="center" valign="middle"><strong>Invoice Details</strong></td>

    <td style="padding: 5px;" colspan="2" align="center" valign="middle"><strong>Details of Receiver / Billed to</strong> </td>

    <td style="padding: 5px;" colspan="2" align="center" valign="middle"><strong>Details</strong></td>

  </tr>

  <tr align="left" style="padding: 0 !important;border-top: 1px solid #000;border-bottom: none;">

    <td style="font-size: 10px;;padding: 5px;border-right: none;border-bottom: none;" width="15%" align="left" valign="middle">Invoice Date </td>
  
    <?php $invoice_date = ($invoice['created_date']!='0000-00-00' && !empty($invoice['created_date']))?$invoice['created_date']:date('Y-m-d');?>
    
    <td style="font-size: 10px;padding: 5px;border-left: none;border-right:1px solid #000;border-bottom: none; " width="17%" align="left" valign="middle"><?=date("d M Y",strtotime($invoice_date));?></td>

    <td style="font-size: 10px;padding: 5px;border-right: none;border-bottom: none;" width="12%" align="left" valign="middle">GSTIN </td>

    <td style="font-size: 10px;padding: 5px;border-left: none;border-right:1px solid #000;border-bottom: none;" width="25%" align="left" valign="middle">33AAUCS6460K1ZQ</td>

    <td style="font-size: 10px;padding: 5px;border-right: none;border-bottom: none;" width="11%" align="left" valign="middle">Guest name</td>

    <td style="font-size: 10px;padding: 5px;border-left: none;border-bottom: none;" width="20%" align="left" valign="middle"><?=$invoice['officer_name'];?></td>

  </tr>

  <tr style="border-top: none;border-bottom: none;">

    <td style="font-size: 10px;border-right:none;border-top: none;border-bottom:none;padding: 5px;" align="left" valign="middle">Invoice No</td>

    <td style="font-size: 10px;border-left: none;border-top: none;border-bottom:none;padding: 5px;" align="left" valign="middle"><?=$invoice['inv_no'];?></td>

    <td style="font-size: 10px;border-top: none;border-right:none;border-bottom:none;padding: 5px;" align="left" valign="middle">&nbsp;</td>

    <td style="font-size: 10px;border-top: none;border-left:none;border-bottom:none;padding: 5px;" align="left" valign="middle">&nbsp;</td>

    <td style="font-size: 10px;border-top: none;border-right:none;border-bottom:none;padding: 5px;" align="left" valign="middle">Rank</td>

    <td style="font-size: 10px;border-top: none;border-left:none;border-bottom:none;padding: 5px;" align="left" valign="middle"><?=get_by_id(array('id'=>$invoice['rank']),"rank")['name'];?></td>

  </tr>

  <tr style="border-top: none;border-bottom: none;">

    <td style="font-size: 10px;border-right:none;border-top: none;border-bottom:none;padding: 5px;" align="left" valign="middle">State of Supply & State code</td>

    <td style="font-size: 10px;padding: 5px;border-bottom:none;border-top: none;border-left: none;" align="left" valign="middle">Tamil Nadu & 33</td>

    <td style="font-size: 10px;padding: 5px;border-bottom:none;border-top: none;border-right: none;" align="left" valign="middle">Billed to</td>

    <td style="font-size: 10px;padding: 5px;border-bottom:none;border-left: none;border-top: none;" align="left" valign="middle"><?=($invoice['address'])?$invoice['address']:"Synergy Maritime Recruitment Services Private Limited, 3/381 Rajiv Gandhi Salai, Mettukuppam; Chennai, 600097, Chennai, Tamil Nadu";?></td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-right: none;" align="left" valign="middle">Vessel Name</td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-left: none;" align="left" valign="middle"><?=get_by_id(array('id'=>$invoice['vessel']),"vessels")['name'];?></td>

  </tr>

  <tr style="border-top: none;border-bottom: none;">

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-right: none;" align="left" valign="middle">GSTIN </td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-left: none;" align="left" valign="middle">33AAMCA9719R1ZU</td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-right: none;" align="left" valign="middle">&nbsp;</td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-left: none;" align="left" valign="middle">&nbsp;</td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-right: none;" align="left" valign="middle">&nbsp;</td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-left: none;" align="left" valign="middle">&nbsp;</td>

  </tr>

  <tr style="border-top: none;border-bottom: none;">

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-right: none;" align="left" valign="middle">&nbsp;</td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-left: none;" align="left" valign="middle">&nbsp;</td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-right: none;" align="left" valign="middle">&nbsp;</td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-left: none;" align="left" valign="middle">&nbsp;</td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-right: none;" align="left" valign="middle">&nbsp;</td>

    <td style="font-size: 10px;padding:5px;border-top: none;border-bottom: none;border-left: none;" align="left" valign="middle">&nbsp;</td>

  </tr>

  

</table>

<h2 class="text-center" >Billing Details</h2>

<div class="billing-details1-orflw">

<table width="100%" border="1" cellspacing="0" cellpadding="0" class="billing-cztm-t2 invoicetable">

<tr align="center">
  <td colspan="9" valign="middle" style="padding:10px 10px;"> <strong>From</strong> : <?=get_taxilocation($invoice['from_loc']);?></td>
  <td colspan="8" valign="middle" style="padding:10px 10px;"><strong>To</strong> : <?=get_taxilocation($invoice['to_loc']);?></td>
</tr>  

<tr align="center">

<td width="6%" align="center" valign="middle"><strong>Sr.  No.</strong></td>

<td width="10%" valign="middle"><strong>Service</strong></td>

<td width="5%" valign="middle"><strong>SAC </strong></td>

<td width="3%" valign="middle"><strong>UOM</strong></td>

<td width="6%" valign="middle"><strong>Rate </strong></td>

<td width="8%" valign="middle"><strong>Rs.</strong></td>

<td width="4%" valign="middle"><strong>Discount</strong></td>

<td width="4%" valign="middle"><strong>Toll</strong></td>

<td width="4%" valign="middle"><strong>Parking</strong></td>

<td width="9%" valign="middle"><strong>Taxable  value </strong></td>

<td colspan="2" valign="middle"><strong>CGST</strong></td>

<td colspan="2" valign="middle"><strong>SGST</strong></td>

<td colspan="2" valign="middle"><strong>IGST</strong></td>

<td width="12%" valign="middle"><strong>Total</strong></td>

</tr>

<tr style="background: rgb(227, 224, 255);">

<td align="center" valign="middle">1</td>

<td valign="middle"><strong>&nbsp;</strong></td>

<td valign="middle">&nbsp;</td>

<td align="center" valign="middle">&nbsp;</td>

<td align="right" valign="middle">&nbsp;</td>

<td align="right" valign="middle">&nbsp;</td>

<td align="right" valign="middle">&nbsp;</td>

<td align="right" valign="middle">&nbsp;</td>

<td align="right" valign="middle">&nbsp;</td>

<td align="right" valign="middle">&nbsp;</td>

<td width="6%" valign="middle"><strong>Rate(%) </strong></td>

<td width="6%" valign="middle"><strong>Rs.</strong></td>

<td width="5%" valign="middle"><strong>Rate(%) </strong></td>

<td width="5%" valign="middle"><strong>Rs.</strong></td>

<td width="6%" valign="middle"><strong>Rate(%) </strong></td>

<td width="9%" valign="middle"><strong>Rs.</strong></td>

<td valign="middle"><strong>Rs.</strong></td>

</tr>

<tr>

<td align="center" valign="middle">&nbsp;</td>

<td align="center" valign="middle"><strong>Cab Charges</strong></td>

<td valign="middle">00441070</td>

<td align="center" valign="middle">95</td>

<td align="right" valign="middle"><?=displayData($invoice['charge'],"money");?></td>

<td align="right" valign="middle"><?=displayData($total,"money");?></td>

<td align="right" valign="middle"><?=$dis=$invoice['discount'];?></td>

<td align="right" valign="middle"><?=$toll=displayData($invoice['toll'],"money");?></td>

<td align="right" valign="middle"><?=$parking=displayData($invoice['parking'],"money");?></td>

<td align="right" valign="middle"><?=displayData($total+$toll+$parking,"money");?>

</td>

<td align="right" valign="middle">2.5% </td>

<td align="right" valign="middle">

  <?php

    $discount = ($total / 100 ) * $dis;

    $cgst=((($total+$toll+$parking) - $discount) / 100 ) * 2.5;

    echo displayData($cgst,"money");

  ?>

</td>

<td align="right" valign="middle">2.5%</td>

<td align="right" valign="middle">

  <?php

    $sgst=((($total+$toll+$parking) - $discount) / 100 ) * 2.5;

    echo displayData($sgst,"money");

  ?>

</td>

<td align="right" valign="middle">-</td>

<td align="right" valign="middle">-</td>

<td align="right" valign="middle">

  <?php

    $r_total = ($total + $cgst + $sgst+$toll+$parking) - $discount;

    echo displayData(ceil($r_total),"money");

  ?>

</td>

</tr>

<tr style="background: rgb(227, 224, 255);">

<td align="center" valign="middle">&nbsp;</td>

<td valign="middle"><strong>TOTAL </strong></td>

<td valign="middle">&nbsp;</td>

<td align="center" valign="middle">&nbsp;</td>

<td align="right" valign="middle">&nbsp;</td>

<td align="right" valign="middle">

  <strong>

    <?php echo displayData($total,"money");?>

  </strong>

</td>

<td align="right" valign="middle">

  <strong>

    <?php echo displayData($discount,"money");?>

  </strong>

</td>

<td align="right" valign="middle">

  <?php

      echo displayData($toll,"money");

    ?>

</td>

<td align="right" valign="middle">

  <?php

      echo displayData($parking,"money");

    ?>

</td>

<td align="right" valign="middle">

  <strong>

    <?php

      echo displayData(($total+$toll+$parking) - $discount,"money");

    ?>

  </strong>

</td>



<td align="right" valign="middle">&nbsp;</td>

<td align="right" valign="middle">

  <strong>

     <?php

        $cgst=((($total+$toll+$parking) - $discount) / 100 ) * 2.5;

        echo displayData($cgst,"money");

      ?>

  </strong>

</td>

<td align="right" valign="middle">&nbsp;</td>

<td align="right" valign="middle">

  <strong>

     <?php

        $sgst=((($total+$toll+$parking) - $discount) / 100 ) * 2.5;

        echo displayData($sgst,"money");

      ?>

  </strong>

</td>

<td align="right" valign="middle">&nbsp;</td>

<td align="right" valign="middle">&nbsp;</td>

<td align="right" valign="middle">

  <strong>

    <?php

      $r_total = ($total + $cgst + $sgst + $toll + $parking ) - $discount;

      echo displayData(ceil($r_total),"money");

    ?>

  </strong>

</td>

</tr>

<tr>

<td align="right" valign="middle">&nbsp;</td>

<td colspan="10" valign="bottom" style="padding: 5px;">

  <p>Amount in Words(Rs.) <strong><?=displayData(ceil($r_total),"word_money");?></strong> </p>

</td>

<td colspan="6" rowspan="2" valign="middle"><table width="200" border="1" align="right" cellpadding="0" cellspacing="0">

  <tr>

    <td width="109" align="left">Taxable Value</td>

    <td width="85" align="right"><strong><?=displayData(($total+$toll+$parking) - $discount,"money");?></strong></td>

  </tr>

  <tr>

    <td align="left">CGST</td>

    <td align="right"><strong><?=displayData($cgst,"money");?></strong></td>

  </tr>

  <tr>

    <td align="left">SGST</td>

    <td align="right"><strong><?=displayData($sgst,"money");?></strong></td>

  </tr>

  <tr>

    <td align="left">IGST</td>

    <td align="right">-</td>

  </tr>

  <tr>

    <td align="left">Total</td>

    <td align="right"><strong><?=displayData(ceil($r_total),"money");?></strong></td>

  </tr>

  <tr>

    <td align="left" nowrap>Reverse Charge</td>

    <td align="right"><strong>No</strong></td>

  </tr>

</table></td>

</tr>

<tr>

<td height="106" colspan="11"><strong>BENEFICIARY BANK DETAILS:</strong> ANCHORPOINT HOSPITALITY SERVICES PRIVATE LIMITED.   Axis Bank, Thoraipakkam Branch, Plot No. 172 - 173, Chandrasekaran Avenue, Old  Mahaballipurm Road, Okkiyam Thuraipakkam, Chennai, Tamil Nadu, Pin 600097. Bank A.c  No: 914020052063794 IFSC CODE: UTIB0 001566 SWIFT CODE: AXISBBA75</td>

</tr>

</table>

</div>