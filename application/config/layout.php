<?php

//
// Layout config for the site admin 
//
                                        

$config['layout']['default']['template'] = 'layouts/frontend';
$config['layout']['default']['title']    = 'Anchorpoint';
$config['layout']['default']['js_dir']   = 'assets/js/';
$config['layout']['default']['css_dir']  = 'assets/css/';
$config['layout']['default']['img_dir']     = 'assets/images/';


$config['layout']['default']['javascripts'] = array('jquery-3.2.1.min','bootstrap.min','build/global.min','moment',"jquery.dataTables.min",'select2.min','remodal',"dropzone",'allinone_bannerRotator','jquery.touchSwipe.min','bootstrap-datepicker.min','function');
 
$config['layout']['default']['stylesheets'] = array('bootstrap.min','styles','custom','select2.min','ram','font-awesome.min','remodal','remodal-default-theme','responsive',"dropzone",'jquery.dataTables.min','allinone_bannerRotator','bootstrap-datepicker3');

$config['layout']['default']['description'] = '';
$config['layout']['default']['keywords']    = '';

$config['layout']['default']['http_metas'] = array(
    'Content-Type' => 'text/html; charset=utf-8',
    'author' => 'Anchorpoint',
);

?>
