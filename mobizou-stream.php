<?php
  /*
    Plugin Name: Mobizou Stream 
    Plugin URI: https://github.com/mobizou/mobizou-stream
    Description: Sidebar widget to display merchant's content from mobizou.com.
    Version: 1.0
    Author: Mobizou Inc
    Author URI: http://www.mobizou.com
    License: GPL2
  */

include_once dirname( __FILE__ ) . '/widget.php';

if ( is_admin() )
	require_once dirname( __FILE__ ) . '/admin.php';
