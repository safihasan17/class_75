<?php
require_once 'models/projectclass.php';
require_once 'models/userclass.php';
require_once 'models/projectcatagoryclass.php';
require_once 'models/clintclass.php';



$msg = "";


$p_catagory = ProjectCategory::readALL();
// echo "<pre>";
// print_r($p_catagory);
// echo "</pre>";


$clints = Clint::readALL();
// echo "<pre>";
// print_r($clints);
// echo "</pre>";

$users = User::readALL();
// echo "<pre>";
// print_r($users);
// echo "</pre>";

?>


<div class="content-wrapper">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Edit Project</div> <br> <br>

           <a  href="manage_project"  class="btn btn-sm btn-dark">Back</a>
        </div>
        <h4><?= $msg ?? "" ?></h4>
        
        <form action="" method="POST" enctype="multipart/form-data">
      <div class="card-body">
        <div class="form-group">
          <label>tittle</label>
          <input type="text" class="form-control" name="tittle" placeholder="Enter name">
        </div>
        <div class="form-group">
          <label>clint</label>
          <select class="form-control" name="clint_id">

            <?php foreach ($clints as $items): ?>
              <option value="<?= $items['id']; ?>"><?= $items['name']; ?></option>
            <?php endforeach; ?>

          </select>
        </div>
        <div class="form-group">
          <label>project category</label>
          <select class="form-control" name="project_category_id">
            <?php foreach ($p_catagory as $items): ?>
              <option value="<?= $items['id']; ?>"><?= $items['name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>user</label>
          <select class="form-control" name="user_id">
            <?php foreach ($users as $items): ?>
              <option value="<?= $items['id']; ?>"><?= $items['name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>expected_starting_time</label>
          <input type="date" class="form-control" name="exstartingtime">
        </div>
        <div class="form-group">
          <label>expected_ending_time</label>
          <input type="date" class="form-control" name="exendingtime">
        </div>
        <div class="form-group">
          <label>actual_starting_time</label>
          <input type="date" class="form-control" name="acstartingtime" value="">
        </div>
        <div class="form-group">
          <label>actual_ending_time</label>
          <input type="date" class="form-control" name="acendingtime">
        </div>
        <div class="form-group">
          <label>actual_cost</label>
          <input type="number" class="form-control" name="actualcost" value="180000">
        </div>

        <div class="form-group">
          <label>budget_cost</label>
          <input type="number" class="form-control" name="budgetcost" value="190000">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" name="btn_submit" class="btn btn-primary">Update</button>
      </div>
    </form>

        <h3><?= $msg; ?></h3> 
    </div>


</div>