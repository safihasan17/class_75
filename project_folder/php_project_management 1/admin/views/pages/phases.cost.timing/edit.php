<?php
require_once 'models/phase_costs_and_timing_class.php';
require_once 'models/projectclass.php';
require_once 'models/phasesclass.php';

$msg = "";

$project_list = Project::readALL();
$phases_list  = Phases::readALL();

// Load existing record
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$existing = PhaseCostsandTiming::readById($id);

if (!$existing) {
    echo '<div class="alert alert-danger m-4">Record not found.</div>';
    exit;
}

if (isset($_POST['btn_submit'])) {
    $record_id     = (int)$_POST['record_id'];
    $phase_id      = (int)$_POST['phase_id'];
    $project_id    = (int)$_POST['project_id'];
    $allocatecost  = (float)$_POST['allocatecost'];
    $actualcost    = (float)$_POST['actualcost'];
    $expected_time = (int)$_POST['expected_time'];  // days
    $actualtime    = (int)$_POST['actualtime'];      // days

    $entry = new PhaseCostsandTiming($record_id, $phase_id, $project_id, $allocatecost, $actualcost, $actualtime, $expected_time);
    $result = $entry->update();

    if ($result === true) {
        $msg = '<div class="alert alert-success"><i class="fa-solid fa-check-circle me-1"></i>Phase entry updated. Project budget recalculated automatically.</div>';
        // Refresh existing data
        $existing = PhaseCostsandTiming::readById($record_id);
    } else {
        $msg = '<div class="alert alert-danger">Error: ' . $result . '</div>';
    }
}
?>

<div class="content-wrapper">
  <div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <div class="card-title fw-bold">Edit Phase Cost &amp; Timing</div>
      <a href="manage_phases_cost" class="btn btn-sm btn-dark">Back</a>
    </div>

    <?= $msg; ?>

    <form action="" method="POST">
      <input type="hidden" name="record_id" value="<?= $existing['id']; ?>">
      <div class="card-body">

        <div class="form-group mb-3">
          <label class="text-primary fw-semibold">Project</label>
          <select name="project_id" class="form-control">
            <?php foreach ($project_list as $items): ?>
              <option value="<?= $items['id']; ?>" <?= $items['id'] == $existing['project_id'] ? 'selected' : ''; ?>>
                <?= $items['title']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group mb-3">
          <label class="text-primary fw-semibold">Phase</label>
          <select name="phase_id" class="form-control">
            <?php foreach ($phases_list as $items): ?>
              <option value="<?= $items['id']; ?>" <?= $items['id'] == $existing['phase_id'] ? 'selected' : ''; ?>>
                <?= $items['title']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Allocated Budget (৳)</label>
              <input type="number" step="0.01" min="0" class="form-control" name="allocatecost"
                     value="<?= $existing['allocated_cost']; ?>" required>
              <small class="text-muted">Changing this will auto-update the project total budget</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Actual Cost (৳)</label>
              <input type="number" step="0.01" min="0" class="form-control" name="actualcost"
                     value="<?= $existing['actual_cost']; ?>" required>
              <small class="text-muted">Changing this will auto-update the project actual cost</small>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Expected Duration (days)</label>
              <input type="number" min="0" class="form-control" name="expected_time"
                     value="<?= $existing['expected_time']; ?>" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Actual Duration (days)</label>
              <input type="number" min="0" class="form-control" name="actualtime"
                     value="<?= $existing['actual_time']; ?>">
            </div>
          </div>
        </div>

        <div class="alert alert-info mb-0">
          <i class="fa-solid fa-circle-info me-1"></i>
          Saving changes will <strong>automatically recalculate</strong> the project's total budget and actual cost.
        </div>

      </div>
      <div class="card-footer">
        <button type="submit" name="btn_submit" class="btn btn-primary">Update Phase Entry</button>
      </div>
    </form>
  </div>
</div>
