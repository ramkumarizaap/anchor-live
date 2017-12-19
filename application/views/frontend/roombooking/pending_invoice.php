 <style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>

 <table>
    <tr>
      <th>Invoice No</th>
      <th>Po No</th>
      <th>Officer Name</th>
      <th>Rank</th>
      <th>Executive</th>
      <th>Purpose</th>
      <th>Course Name</th>
      <th>Vessel</th>
      <th>Checkin Date</th>
      <th>Checked In</th>
      <th>Checkout Date</th>
      <th>Room Nights</th>
      <th>Occupancy</th>
      <th>Room</th>
      <th>Cost Centre</th>
      <th>Discount</th>
      <th>Invoice Amt</th>
      <th>Action</th>
    </tr>
    <?php foreach($pending_result as $res)
     {
    ?>
    <tr>
      <td><?php echo $res['inv_no'];?></td>
      <td><?php echo $res['po_no'];?></td>
      <td><?php echo $res['officer_name'];?></td>
      <td><?php echo $res['rankname'];?></td>
      <td><?php echo $res['executivename'];?></td>
      <td><?php echo $res['purpose'];?></td>
      <td><?php echo $res['course_name'];?></td>
      <td><?php echo $res['vesselname'];?></td>
      <td><?php echo date('d-m-Y',strtotime($res['checkin_date']));?></td>
      <td><?php echo $res['checked_in'];?></td>
      <td><?php echo date('d-m-Y',strtotime($res['checkout_date']));?></td>
      <td><?php echo $res['no_of_days'];?></td>
      <td><?php echo $res['occupancy'];?></td>
      <td><?php echo $res['roomname'];?></td>
      <td><?php echo $res['costcentre'];?></td>
      <td><?php echo $res['discount'];?></td>
      <td><?php echo $res['invoice_amount'];?></td>
      <td><a href="<?php echo site_url('booking/create/'.$res['id']);?>" class="table-action" target="_blank"><i class="fa fa-edit edit"></i> Edit</a></td>
    </tr>
    <?php } ?>
  </table>