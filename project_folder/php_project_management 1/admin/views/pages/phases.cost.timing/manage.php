<?php

$msg = "";
require_once 'models/phase_costs_and_timing_class.php';

if (isset($_POST['delete_id'])) {
    $id  = (int)$_POST['delete_id'];
    $res = PhaseCostsandTiming::delete($id);

    if ($res === true) {
        $msg = '<div class="alert alert-success">Entry deleted. Project budget recalculated.</div>';
    } else {
        $msg = '<div class="alert alert-danger">' . $res . '</div>';
    }
}

$rows = PhaseCostsandTiming::readALL();
?>


<div class="content-wrapper mt-5">
    <main class="app-main mt-5">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Phase Cost &amp; Timing</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb bg-transparent justify-content-end">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Phase Cost &amp; Timing</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <a class="btn btn-sm btn-dark" href="create_phases_cost">+ Add Phase Entry</a>
                                <small class="text-muted">
                                    <i class="fa-solid fa-circle-info me-1"></i>
                                    Editing any entry auto-updates the project's total budget &amp; actual cost.
                                </small>
                            </div>

                            <?= $msg; ?>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Project</th>
                                                <th>Phase</th>
                                                <th>Allocated Budget (৳)</th>
                                                <th>Actual Cost (৳)</th>
                                                <th>Expected (days)</th>
                                                <th>Actual (days)</th>
                                                <th>Cost</th>
                                                <th>Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (empty($rows)): ?>
                                            <tr>
                                                <td colspan="10" class="text-center text-muted py-4">No entries yet.</td>
                                            </tr>
                                        <?php else: ?>
                                        <?php foreach ($rows as $items):
                                            $overCost = $items['actual_cost']  > $items['allocated_cost'];
                                            $overTime = (int)$items['actual_time'] > (int)$items['expected_time'] && (int)$items['expected_time'] > 0;
                                        ?>
                                            <tr>
                                                <td><?= $items['id'] ?></td>
                                                <td><?= htmlspecialchars($items['project_title']) ?></td>
                                                <td><?= htmlspecialchars($items['phase_title']) ?></td>
                                                <td>৳<?= number_format($items['allocated_cost'], 2) ?></td>
                                                <td>৳<?= number_format($items['actual_cost'], 2) ?></td>
                                                <td><?= (int)$items['expected_time'] ?> days</td>
                                                <td><?= (int)$items['actual_time'] ?> days</td>
                                                <td>
                                                  <span class="badge <?= $overCost ? 'bg-danger' : 'bg-success' ?>">
                                                    <?= $overCost ? 'Over' : 'OK' ?>
                                                  </span>
                                                </td>
                                                <td>
                                                  <?php if ((int)$items['expected_time'] > 0): ?>
                                                  <span class="badge <?= $overTime ? 'bg-danger' : 'bg-success' ?>">
                                                    <?= $overTime ? 'Delayed' : 'On Time' ?>
                                                  </span>
                                                  <?php else: ?>
                                                    <span class="text-muted">—</span>
                                                  <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="edit_phases_cost?id=<?= $items['id']; ?>" class="btn btn-sm btn-default">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                        <form action="" method="POST" onsubmit="return confirm('Delete this entry? Project budget will be recalculated.');">
                                                            <input type="hidden" name="delete_id" value="<?= $items['id']; ?>">
                                                            <button type="submit" class="btn btn-sm btn-default">
                                                                <i class="fa fa-trash text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
