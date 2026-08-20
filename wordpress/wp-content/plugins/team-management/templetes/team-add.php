<?php
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
?>