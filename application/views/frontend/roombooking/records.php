<span><i>* Note : Need to check the checkbox if you want to generate Invoice amount is more than Rs.15,000 and for others it will generate automatically</i></span>

<table class="table table-hover table-striped">

		<thead>

			<th>SNO</th><th>INV NO</th><th>Name</th><th>Checkin Date</th><th>Checkout Date</th><th>No.of Days</th><th>Amount</th><th></th>

		</thead>

		<tbody>

			<?php

			if($records)

			{

				$i=1;

				foreach ($records as $key => $value)

				{

					$tariff = $this->booking_model->get_where(array("id"=>$value['room_id']),"tariff","rooms")->row_array();

					$date1 = date("Y-m-d H:i:s",strtotime($value['checkin_date']." ".$value['checkin_time']));

		      $date2 = date("Y-m-d H:i:s",strtotime($value['checkout_date']." ".$value['checkout_time']));

		      $days = ceil(abs(strtotime($date2) - strtotime($date1)) / 100400);

		      $total = $days * $tariff['tariff'];

		      $tt = ($total / 100 ) * $value['discount'];

		      $t_value = $total - $tt;

		      $cgst=($t_value / 100 ) * 6;

		      $sgst=($t_value / 100 ) * 6;

		      $invoice_amount = ceil($t_value + $cgst + $sgst);

		      $class = "";

		      if($invoice_amount >= 15000)

		      	$class = "tr_red";

					?>

						<tr class="<?=$class;?>">

							<td align="center"><?=$i++;?></td>

							<td align="center"><?=$value['inv_no'];?></td>

							<td align="center"><?=$value['officer_name'];?></td>

							<td align="center"><?=$value['checkin_date']. " ".$value['checkin_time'];?></td>

							<td align="center"><?=$value['checkout_date']." ".$value['checkout_time'];?></td>

							<td align="center"><input type="text" value="<?=$value['no_of_days'];?>" meta-index="<?=$value['id'];?>" name="days[<?=$value['id'];?>]"></td>

							<td><?="Rs. ".displayData($invoice_amount,"money");?></td>

							<td align="center">

								<?php

								if($invoice_amount >= 15000)

								{

									?>

										<input type="checkbox" name="r_id[]" value="<?=$value['id'];?>">

									<?php

								}

								else

								{

									?>

									<input type="checkbox" name="r_id[]" checked value="<?=$value['id'];?>" style="display: none;">

									<?php

								}

								?>

							</td>

						</tr>

					<?php

				}

			}

			?>

		</tbody>

</table>

<style type="text/css">

	table thead th{text-align: center;}

	table tbody tr.tr_red{background-color: #e38e8e !important;font-weight: bold; }

</style>