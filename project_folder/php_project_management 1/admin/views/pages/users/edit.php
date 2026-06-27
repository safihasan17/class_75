<?php
require_once 'models/userclass.php';
require_once 'models/roleclass.php';

$msg = "";


if(isset($_POST['btn-submit'])){
   $id= $_POST['id'];
   $name= $_POST['name']; 
   $email= $_POST['email']; 
   $role= $_POST['role']; 

   $user = new User($id, $name, $email, $role);
   $user->update();
   
   

}

$roles = Role::readALL();
if(isset($_GET['id'])){
    $row = User::readById($_GET['id']);
    // echo "<pre>";
    // print_r($item);
    // echo "</pre>";
}
else{
    
}
// echo "<pre>";
// print_r($roles);
// echo "</pre>";




?>


<div class="content-wrapper">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Edit User</div> <br> <br>

           <a  href="manage"  class="btn btn-sm btn-dark">Back</a>
        </div>
        <h4><?= $msg ?? "" ?></h4>
        
        <form method="POST">
            <input type="hidden" name="id" id="" value="<?= $row['id']; ?>" >
            <div class="card-body">
 
               <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">name</label>
                    <input type="text" class="form-control" name="name" aria-describedby="emailHelp" value="<?= $row['name'] ?>">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="text" class="form-control" name="email" aria-describedby="emailHelp" value="<?= $row['email'] ?>">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"> Role</label>
                    <select class="form-control" name="role" id="">
                        <?php foreach($roles as $items): 
                             $selected = $items['id'] == $row['role_id'] ? 'selected' : '';?>
                        <option value="<?= $items['id']; ?>" <?= $selected; ?> > <?= $items['name']; ?></option>
                        
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"> Confirm Password</label>
                    <input type="password" class="form-control" name="con_password" >
                </div>

            </div>
            <div class="card-footer">
                <button type="submit"  name="btn-submit" class="btn btn-primary">Update </button>
            </div>
        </form>

        <h3><?= $msg; ?></h3> 
    </div>


</div>