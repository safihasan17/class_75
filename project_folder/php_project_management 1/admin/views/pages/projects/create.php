<?php
require_once 'models/userclass.php';
require_once 'models/projectcatagoryclass.php';
require_once 'models/clintclass.php';
require_once 'models/projectclass.php';


$msg = "";

$p_catagory = ProjectCategory::readALL();
$clints = Clint::readALL();
$users = User::readALL();


if (isset($_POST['btn_submit'])) {
  $tittle            = $_POST['tittle'];
  $clint_id          = $_POST['clint_id'];
  $project_category_id = $_POST['project_category_id'];
  $user_id           = $_POST['user_id'];
  $exstartingtime    = !empty($_POST['exstartingtime']) ? $_POST['exstartingtime'] : '1000-01-01';
  $exendingtime      = !empty($_POST['exendingtime'])   ? $_POST['exendingtime']   : '1000-01-01';
  $acstartingtime    = !empty($_POST['acstartingtime']) ? $_POST['acstartingtime'] : '1000-01-01';
  $acendingtime      = !empty($_POST['acendingtime'])   ? $_POST['acendingtime']   : '1000-01-01';

  // budget_cost and actual_cost are auto-calculated from phases — no manual input
  $project = new Project(null, $tittle, $clint_id, $project_category_id, $user_id,
                         $exstartingtime, $exendingtime, $acstartingtime, $acendingtime);

  $result = $project->create();

  if ($result === true) {
    $msg = '<div class="alert alert-success">Project saved successfully. Budget & cost will be calculated automatically from phases.</div>';
  } else {
    $msg = '<div class="alert alert-danger">Error: ' . $result . '</div>';
  }
}
?>


<div class="content-wrapper">
  <div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <div class="card-title fw-bold">Create Project</div>
      <a href="manage_project" class="btn btn-sm btn-dark">Back</a>
    </div>

    <?= $msg; ?>

    <form action="" method="POST">
      <div class="card-body">
        <div class="form-group mb-3">
          <label class="text-primary fw-semibold">Project Title</label>
          <input type="text" class="form-control" name="tittle" placeholder="Enter project title" required>
        </div>

        <div class="form-group mb-3">
          <label class="text-primary fw-semibold">Client</label>
          <select class="form-control" name="clint_id">
            <?php foreach ($clints as $items): ?>
              <option value="<?= $items['id']; ?>"><?= $items['name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group mb-3">
          <label class="text-primary fw-semibold">Project Category</label>
          <select class="form-control" name="project_category_id">
            <?php foreach ($p_catagory as $items): ?>
              <option value="<?= $items['id']; ?>"><?= $items['name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group mb-3">
          <label class="text-primary fw-semibold">Project Manager</label>
          <select class="form-control" name="user_id">
            <?php foreach ($users as $items): ?>
              <option value="<?= $items['id']; ?>"><?= $items['name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Expected Starting Date</label>
              <input type="date" class="form-control" name="exstartingtime">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Expected Ending Date</label>
              <input type="date" class="form-control" name="exendingtime">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Actual Starting Date</label>
              <input type="date" class="form-control" name="acstartingtime">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Actual Ending Date</label>
              <input type="date" class="form-control" name="acendingtime">
            </div>
          </div>
        </div>

        <div class="alert alert-info mb-0">
          <i class="fa-solid fa-circle-info me-1"></i>
          <strong>Budget &amp; Cost</strong> are calculated automatically from Phase Costs &amp; Timing entries.
          Add phases after creating the project.
        </div>

      </div>
      <div class="card-footer">
        <button type="submit" name="btn_submit" class="btn btn-primary">Create Project</button>
      </div>
    </form>

  </div>
</div>
