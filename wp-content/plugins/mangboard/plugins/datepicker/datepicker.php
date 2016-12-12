<?php

function mb_init_datepicker(){
	loadScript(MBW_PLUGIN_URL."plugins/datepicker/js/datepicker.js");
}
add_action('wp_enqueue_scripts', 'mb_init_datepicker');
add_action('admin_enqueue_scripts', 'mb_init_datepicker');
?>
