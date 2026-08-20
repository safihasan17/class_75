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

function team_management_menu()
{
    add_menu_page(
        "Team Management List",     // page title
        "TeamManagement",                     // menu title
        "manage_options",           // capability
        "team-list",                // menu slug
        "team_members_list",                     // callback function
        "dashicons-groups",    // icon
        "30"                        // position
    );
    add_submenu_page(
        "team-list",                // parent slug
        "Add Team Member",                 // page title
        "Add Member",                      // menu title
        "manage_options",           // capability
        "team-add",                 // menu slug
        "team_management_add"                      // callback function
    );

    add_submenu_page(
        "",                // parent slug
        "Edit Team Member",                 // page title
        "Edit Member",                      // menu title
        "manage_options",           // capability
        "team-edit",                 // menu slug
        "team_management_edit"                      // callback function
    );
}

add_action('admin_menu', 'team_management_menu');

function test()
{
    echo "<script>alert('Page Loaded');</script>";
}

function team_members_list()
{
    global $wpdb;
    $table  = $wpdb->prefix . 'team_members';


    if (isset($_SESSION['flash_msg'])) {
        echo "
        <div class= 'notice notice-success is-dismissible'>
            <p>{$_SESSION['flash_msg']}</p>
        </div>";
        unset($_SESSION['flash_msg']);
    }

    if (isset($_POST['delete_id'])) {
        // echo $_POST['delete_id'];
        $detete_res =   $wpdb->delete(
            $table,
            array('id' => $_POST['delete_id'])
        );

        if ($detete_res) {
            echo '<div class= "notice notice-success is-dismissible">
            <p> Data Deleted Successfully</p>
            </div>';
        } else {
            echo '<div class= "notice notice-error is-dismissible">
            <p> Data not Delated</p>
            </div>';
        }
    }


    $results = $wpdb->get_results("SELECT * FROM $table");
    //    echo "<pre>";
    //    print_r($results);
    //    echo "</pre>";

    $table_body = '';
    foreach ($results as $item) {
        if ($item->image != null) {
            $img = wp_get_attachment_url($item->image);
        } else {
            $img = "https://placeholder.co/60x60.png";
        }
        $table_body .= "
        <tr>
            <td class='column-name'>$item->name</td>
            <td class='column-name'>$item->designation</td>
            <td class='column-name'>$item->email</td>
            <td class='column-name'>
            <img src='$img' width= '60' height= '60' alt = 'profile Image'>
            </td>
            <td class='column-name'>
             <a href='admin.php?page=team-edit&id=$item->id' class='button'>Edit</a>
             <form action='' method='POST'>
               <input type='hidden' name='delete_id' value='$item->id'>
               <input type='submit'  class='button' value='Delete'>
             </form>
            </td>
        </tr>
        ";
    }
    echo "
    <h2>Team Members List</h2>

    <table class='wp-list-table widefat fixed striped table-view-list tags'>
	  <thead>
		<tr>
			<th scope='col' class='manage-column column-name column-primary sorted asc'>
				<a>Name</a>
			</th>
			<th scope='col' class='manage-column sortable desc'>
				<a>Designation</a>
			</th>
			<th scope='col' class='manage-column sortable desc'>
				<a>Email</a>
			</th>
			<th scope='col' class='manage-column sortable desc'>
				<a>Image</a>
			</th>
			<th scope='col' class='manage-column sortable desc'>
				<a>Action</a>
			</th>
		</tr>
	  </thead>
	  <tbody data-wp-lists='list:tag'>
		$table_body
	 </tbody>	
    </table>
    ";
}

function team_management_add()
{
    if (isset($_POST['submit'])) {
        // echo $_POST['name'];
        // echo $_POST['designation'];
        // echo $_POST['email'];

        // echo "<pre>";
        // print_r($_FILES['img']);
        // echo "</pre>";

        if ($_FILES['img']['size'] > 0) {

            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';

            $attachment_id = media_handle_upload('img', 0);
        }

        global $wpdb;
        $table  = $wpdb->prefix . 'team_members';
        $wpdb->insert(
            $table,
            array(
                'name'        => $_POST['name'],
                'designation'  => $_POST['designation'],
                'email'       => $_POST['email'],
                'image'       => $attachment_id ?? null
            )
        );

        $insert_id = $wpdb->insert_id;
        if ($insert_id) {
            echo '<div class="notice notice-success is-dismissible">
          <p> Data save Successfully </p>
        </div>';
        } else {
            echo '<div class="notice notice-error is-dismissible">
          <p> Data not inserted </p>
        </div>';
        }
    };

    echo "
    <div class='form-wrap'>
<h2>Add Team Member</h2>
<form  method='post'  class='validate' enctype= multipart/form-data>

<div class='form-field term-name-wrap'>
	<label>Name</label>
	<input name='name' type='text' value='' size='40' aria-required='true' aria-describedby='name-description'>
	
</div>
<div class='form-field term-slug-wrap'>
	<label >Designation</label>
	<input name='designation'  type='text' value='' size='40' aria-describedby='slug-description'>
	
</div>

<div class='form-field term-slug-wrap'>
	<label >Email</label>
	<input name='email'  type='text' value='' size='40' aria-describedby='slug-description'>
	
</div>

<div class='form-field term-slug-wrap'>
	<label > Upload Image</label>
	<input name='img'  type='file' id='img' value='' size='40' accept= 'image/*'>
</div>
<img src=''  id='preview' style='display: none;' width= '100' height= '100'  alt='Upload Image'>

<p class='submit'>
		<input type='submit' name='submit' id='submit' class='button button-primary' value='Add Member'>		<span class='spinner'></span>
</p>
	</form>
    
    </div>
    ";


    echo "<script>
    document.querySelector('#img').addEventListener('change', function(){
    let src =  URL.createObjectURL(this.files[0]);
       let preview = document.querySelector('#preview');
       preview.src = src;
       preview.style.display= 'block'
    })
   </script>";


}

function team_management_edit()
{

    global $wpdb;
    $table  = $wpdb->prefix . 'team_members';

    if (isset($_POST['submit'])) {
        // echo $_POST['name'];
        // echo $_POST['designation'];
        // echo $_POST['email'];

        if ($_FILES['img']['size'] > 0) {

            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';

            $attachment_id = media_handle_upload('img', 0);
        }

        $res =  $wpdb->update(
            $table,
            array(
                'name'         => $_POST['name'],
                'designation'  => $_POST['designation'],
                'email'        => $_POST['email'],
                'image'       => $attachment_id ?? $_POST['img_old']
            ),
            array(
                'id' => $_POST['id'],
            ),
        );

        if ($res) {
            //     echo '<div class="notice notice-success is-dismissible">
            //   <p> Data Update Successfully </p>
            // </div>';


            $_SESSION['flash_msg'] = 'Data updated successfully';

            wp_redirect(admin_url("admin.php?page=team-list"));
        }elseif($res == 0){
              echo '<div class="notice notice-warning is-dismissible">
          <p> Nothing to  updated </p>
          </div>';
        }else {
            echo '<div class="notice notice-error is-dismissible">
          <p> Data not updated </p>
        </div>';
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $item = $wpdb->get_row("SELECT * FROM $table WHERE id =$id");

        if($item->image !=null){
            $img_link = wp_get_attachment_url( $item->image );
            $img = "<img src = '$img_link' width= '100' height= '100'>";
        }else{
            $img = "";
        }
    }

    // if($item){
    //     echo "<pre>";
    //     print_r($item);
    //     echo "</re>";
    // }
    echo "
    <div class='form-wrap'>
     <h2>Edit Team Member</h2>
   <form  method='post'  class='validate' enctype= multipart/form-data>
     <input type='hidden' name='id' value= '$item->id'>
      <div class='form-field term-name-wrap'>
	<label>Name</label>
	<input name='name' type='text' value='$item->name' size='40' aria-required='true' aria-describedby='name-description'>
	
</div>
<div class='form-field term-slug-wrap'>
	<label >Designation</label>
	<input name='designation'  type='text' value='$item->designation' size='40' aria-describedby='slug-description'>
	
</div>

<div class='form-field term-slug-wrap'>
	<label >Email</label>
	<input name='email'  type='text' value='$item->email' size='40' aria-describedby='slug-description'>
	
</div>

<div class='form-field term-slug-wrap'>
	<label >Image</label>
	<input name='img'  type='file' value='' size='40' aria-describedby='slug-description'>
	<input name='img_old'  type='hidden' value='$item->image' size='40' '>
</div>
$img
<p class='submit'>
		<input type='submit' name='submit' id='submit' class='button button-primary' value='Update Member'>		<span class='spinner'></span>
</p>
	</form>
    
    </div>
    ";
}

function team_management_db()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'team_members';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "
    CREATE TABLE $table_name (
    id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    designation VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'team_management_db');
