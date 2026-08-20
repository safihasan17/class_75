<?php

/**
 * Plugin Name: Team Management
 * Description: Integrate team management features into your company.
 * Version: 1.0.0
 * Author: Asia
 * Author URI: https://example.com
 * Text Domain: team-management
 */

if (! defined('ABSPATH')) {
    exit;
}

if (!session_id()) session_start();



require_once (__DIR__. '/includes/menus.php');


require_once (__DIR__. '/templetes/team-manage.php');

require_once (__DIR__. '/templetes/team-add.php');



function team_management_edit()
{
 
require_once (__DIR__. '/templetes/team-edit.php');
    
}



function team_management_db()
{
  
require_once (__DIR__. '/includes/db-table.php');
}


