<?php
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
?>