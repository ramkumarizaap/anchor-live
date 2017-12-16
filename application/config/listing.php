<?php
/*
 * view - the path to the listing view that you want to display the data in
 * 
 * base_url - the url on which that pagination occurs. This may have to be modified in the 
 * 			controller if the url is like /product/edit/12
 * 
 * per_page - results per page
 * 
 * order_fields - These are the fields by which you want to allow sorting on. They must match
 * 				the field names in the table exactly. Can prefix with table name if needed
 * 				(EX: products.id)
 * 
 * OPTIONAL
 * 
 * default_order - One of the order fields above
 * 
 * uri_segment - this will have to be increased if you are paginating on a page like 
 * 				/product/edit/12
 * 				otherwise the pagingation will start on page 12 in this case 
 * 
 * 
 */
 

$config['booking_logs'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'booking/filter',
	"base_url"	=> 	'/booking/logs/',
	"per_page"	=>	"50",
	"fields"	=> array(   
					'inv_no'=>array('name'=>'Invoice No', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'po_no'=>array('name'=>'Po No', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"5"),
					'officer_name'=>array('name'=>'Officer Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'rank'=>array('name'=>'Rank', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'executive'=>array('name'=>'Executive', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'purpose'=>array('name'=>'Purpose', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'course_name'=>array('name'=>'Course Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'vessel'=>array('name'=>'Vessel', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'checkin_date'=>array('name'=>'Checkin Date', 'data_type' => 'datetime', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'checked_in'=>array('name'=>'Checked In', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'checkout_date'=>array('name'=>'Checkout Date', 'data_type' => 'datetime', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'no_of_days'=>array('name'=>'Room Nights', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'occupancy'=>array('name'=>'Occupancy', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'room'=>array('name'=>'Room', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					// 'lunch'=>array('name'=>'Lunch', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					// 'tariff'=>array('name'=>'Room Tariff', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					// 'breakfast'=>array('name'=>'Breakfast', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					// 'snacks'=>array('name'=>'Snacks', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					// 'printout'=>array('name'=>'Printout', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					// 'laundry'=>array('name'=>'Laundry', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					// 'logistics'=>array('name'=>'Logistics', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'cost_centre'=>array('name'=>'Cost Centre', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'discount'=>array('name'=>'Discount', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'invoice_amount'=>array('name'=>'Invoice Amt', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'invoice_link'=>array('name'=>'Invoice', 'data_type' => 'link', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'officer_sign'=>array('name'=>'Signature', 'data_type' => 'sign_link', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'pdf_downloaded'=>array('name'=>'PDF', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					),
	"default_order"	=> "a.id",
	"default_direction" => "DESC"
);


$config['room_status'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'room/filter',
	"base_url"	=> 	'/room/status/',
	"per_page"	=>	"50",
	"fields"	=> array(
						'name'=>array('name'=>'Room', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
						'occupancy'=>array('name'=>'Type', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
						'officer_name'=>array('name'=>'Officer Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
						'rank'=>array('name'=>'Rank', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
						'checkin_date'=>array('name'=>'Check In Date', 'data_type' => 'colorize', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
						'e_checkout_date'=>array('name'=>'Expected Check Out', 'data_type'=> 'datetime', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
						'checked_in'=>array('name'=>'Checked In', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
						'executive'=>array('name'=>'Executive', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>0,"width"=>"15"),),
	"default_order"	=> "b.checkin_date",
	"default_direction" => "desc"
);




$config['taxi_logs'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'taxi/filter',
	"base_url"	=> 	'/taxi/logs/',
	"per_page"	=>	"50",
	"fields"	=> array(   
					'inv_no'=>array('name'=>'Invoice No', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'driver_name'=>array('name'=>'Driver Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'officer_name'=>array('name'=>'Officer Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'rank'=>array('name'=>'Rank', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'vessel'=>array('name'=>'Assigned Vessel', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'date'=>array('name'=>'Date', 'data_type' => 'date', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'from_loc'=>array('name'=>'From', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'to_loc'=>array('name'=>'To', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'trip_sheet'=>array('name'=>'Trip Sheet', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'kms'=>array('name'=>'No of KM', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'waiting'=>array('name'=>'Waiting Charge', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'amount'=>array('name'=>'Amount', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'cgst'=>array('name'=>'CGST 6%', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'sgst'=>array('name'=>'SGST 6%', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'toll'=>array('name'=>'Toll', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'parking'=>array('name'=>'Parking', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'cost_centre'=>array('name'=>'Cost Centre', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'invoice_sent'=>array('name'=>'Invoice Sent', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'invoice_link'=>array('name'=>'Invoice Link', 'data_type' => 'link', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'cash_received'=>array('name'=>'Cash Received', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'total'=>array('name'=>'Total', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'grand_total'=>array('name'=>'Grand Total', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),),
	"default_order"	=> "a.id",
	"default_direction" => "DESC"
);



$config['feedback_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/feedback/filter',
	"base_url"	=> 	'/feedback/index/',
	"per_page"	=>	"50",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),					
						'rank'=>array('name'=>'Rank', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),					
						'email'=>array('name'=>'Email', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
						'room_id'=>array('name'=>'Room Name','data_type'=> 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
						'contact_no'=>array('name'=>'Contact No','data_type'=> 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
						'comments'=>array('name'=>'Comments', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),),
	"default_order"	=> "id",
	"default_direction" => "desc"
);




$config['services_executives'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'services/filter',
	"base_url"	=> 	'/services/executives/',
	"per_page"	=>	"50",
	"fields"	=> array(   
					'id'=>array('name'=>'ID', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'status'=>array('name'=>'Status', 'data_type' => 'label', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['services_rank'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'services/filter',
	"base_url"	=> 	'/services/rank/',
	"per_page"	=>	"50",
	"fields"	=> array(   
					'id'=>array('name'=>'ID', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'status'=>array('name'=>'Status', 'data_type' => 'label', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['services_vessels'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'services/filter',
	"base_url"	=> 	'/services/vessels/',
	"per_page"	=>	"50",
	"fields"	=> array(   
					'id'=>array('name'=>'ID', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'status'=>array('name'=>'Status', 'data_type' => 'label', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['services_inv_address'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'services/filter',
	"base_url"	=> 	'/services/inv_address/',
	"per_page"	=>	"50",
	"fields"	=> array(   
					'id'=>array('name'=>'ID', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'address'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'status'=>array('name'=>'Status', 'data_type' => 'label', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['services_purpose'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'services/filter',
	"base_url"	=> 	'/services/purpose/',
	"per_page"	=>	"30",
	"fields"	=> array(   
					'id'=>array('name'=>'ID', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'status'=>array('name'=>'Status', 'data_type' => 'label', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['services_cost_centre'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'services/filter',
	"base_url"	=> 	'/services/cost_centre/',
	"per_page"	=>	"30",
	"fields"	=> array(   
					'id'=>array('name'=>'ID', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'status'=>array('name'=>'Status', 'data_type' => 'label', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);



$config['services_rooms'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'services/filter',
	"base_url"	=> 	'/services/rooms/',
	"per_page"	=>	"50",
	"fields"	=> array(   
					'id'=>array('name'=>'ID', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'tariff'=>array('name'=>'Tariff', 'data_type' => 'money', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					'status'=>array('name'=>'Status', 'data_type' => 'label', 'sortable' => FALSE, 'default_view'=>1,"width"=>"15"),
					),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

