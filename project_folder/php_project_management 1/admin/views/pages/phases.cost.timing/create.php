<?php
require_once 'models/phase_costs_and_timing_class.php';
require_once 'models/projectclass.php';
require_once 'models/phasesclass.php';

$msg = "";

$project = Project::readALL();
$phases  = Phases::readALL();

if (isset($_POST['btn_submit'])) {
    $phase_id      = (int)$_POST['phase_id'];
    $project_id    = (int)$_POST['project_id'];
    $allocatecost  = (float)$_POST['allocatecost'];
    $actualcost    = (float)$_POST['actualcost'];
    $expected_time = (int)$_POST['expected_time'];  // days
    $actualtime    = (int)$_POST['actualtime'];      // days

    $entry = new PhaseCostsandTiming(null, $phase_id, $project_id, $allocatecost, $actualcost, $actualtime, $expected_time);
    $result = $entry->create();

    if ($result === true) {
        $msg = '<div class="alert alert-success"><i class="fa-solid fa-check-circle me-1"></i>Phase cost &amp; timing saved. Project budget updated automatically.</div>';
    } else {
        $msg = '<div class="alert alert-danger">Error: ' . $result . '</div>';
    }
}
?>

<div class="content-wrapper">
  <div class="card card-primary card-outline mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <div class="card-title fw-bold">Add Phase Cost &amp; Timing</div>
      <a href="manage_phases_cost" class="btn btn-sm btn-dark">Back</a>
    </div>

    <?= $msg; ?>

    <form action="" method="POST">
      <div class="card-body">

        <div class="form-group mb-3">
          <label class="text-primary fw-semibold">Project</label>
          <select name="project_id" class="form-control">
            <?php foreach ($project as $items): ?>
              <option value="<?= $items['id']; ?>"><?= $items['title']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group mb-3">
          <label class="text-primary fw-semibold">Phase</label>
          <select name="phase_id" class="form-control">
            <?php foreach ($phases as $items): ?>
              <option value="<?= $items['id']; ?>"><?= $items['title']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Allocated Budget (৳)</label>
              <input type="number" step="0.01" min="0" class="form-control" name="allocatecost" placeholder="0.00" required>
              <small class="text-muted">This phase's share of the project budget</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Actual Cost (৳)</label>
              <input type="number" step="0.01" min="0" class="form-control" name="actualcost" placeholder="0.00" required>
              <small class="text-muted">Actual amount spent in this phase</small>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Expected Duration (days)</label>
              <input type="number" min="0" class="form-control" name="expected_time" placeholder="e.g. 14" required>
              <small class="text-muted">How many days this phase is planned to take</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="text-primary fw-semibold">Actual Duration (days)</label>
              <input type="number" min="0" class="form-control" name="actualtime" placeholder="e.g. 18">
              <small class="text-muted">How many days this phase actually took (0 if ongoing)</small>
            </div>
          </div>
        </div>

        <div class="alert alert-info mb-0">
          <i class="fa-solid fa-circle-info me-1"></i>
          Saving this entry will <strong>automatically recalculate</strong> the project's total budget and actual cost.
        </div>

      </div>
      <div class="card-footer">
        <button type="submit" name="btn_submit" class="btn btn-primary">Save Phase Entry</button>
      </div>
    </form>
  </div>
</div>
