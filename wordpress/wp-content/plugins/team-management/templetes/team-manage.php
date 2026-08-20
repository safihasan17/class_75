<?php

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
?>