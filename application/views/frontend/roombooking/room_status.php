<h2>Room Status</h2>

<div class="dataTables_wrapper room-status-section">

<table class="table table-striped table-hover" id="example1" width="100%">

	<thead>

		<th>Room Name</th><th>Type</th><th>Officer Name</th><th>Rank</th><th>Checkin Date</th><th>Exp. Checkout Date</th><th>Checked In</th>

	</thead>

	<tbody>

		<?php

			if($result)

			{

				foreach ($result as $key => $value)

				{

					$style="";

					if(isset($value['checkin_date']) && $value['checkin_date']!='')

					{

						$str1 = strtotime($value['checkin_date']);

						$str2 = strtotime(date("Y-m-d 23:59:59"));

						if($str1 > $str2)

						{

							$style = "style='color:red';";

						}

					}

					if($value['checkin_date']=='' && $value['officer_name']=='' && $value['checked_in']=='')

					{
						$style = "style='color:blue';";

					}

					if($value['checkout_date'] !='0000-00-00' && $value['checkout_time']){

						$chkoutdate = date('Y-m-d H:i',strtotime($value['checkout_date'].' '.$value['checkout_time']));

						if((strtotime($chkoutdate) >= strtotime(date('Y-m-d H:i'))) === FALSE){
							if($value['count'] >= 2)
								continue;
							
							$value = array('name'=>$value['name'],'occupancy'=>'','officer_name'=>'','executive'=>'','rank'=>'','checkin_date'=>'','e_checkout_date'=>'','checked_in'=>'');	
							$style = "style='color:blue';";
						}

					}

					?>

						<tr style="text-align: left;">

							<td <?=$style;?>><?=$value['name'];?></td>

							<td <?=$style;?>><?=$value['occupancy'];?></td>

							<td <?=$style;?> class="off_name">

								<?=$value['officer_name'];?>

								<?php if($value['executive']!=''){ echo "<br>";?>

								<div class="exe-span hide"><?=$value['executive'];?></div>

								<?php }?>

							</td>

							<td <?=$style;?>><?=$value['rank'];?></td>

							<td <?=$style;?>><?=$value['checkin_date'];?></td>

							<td <?=$style;?>><?=$value['e_checkout_date'];?></td>

							<td <?=$style;?>><?=$value['checked_in'];?></td>

						</tr>

					<?php

				}

			}

			?>

	</tbody>

</table>

</div>

<script type="text/javascript">

	$("#example1").DataTable({ "scrollY":400,"scrollX": true,paging:false,searching:false,ordering:false,info:false});

</script>