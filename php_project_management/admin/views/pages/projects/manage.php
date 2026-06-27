<?php

$msg = "";
require_once 'models/projectclass.php';

function formatDate($date) {
    if (!$date || $date == '1000-01-01 00:00:00') return '-';
    return date('d M Y', strtotime($date));
}



if (isset($_POST['status_id'])) {
    $id = $_POST['status_id'];
    $status = $_POST['status'];
    $res = Project::updateStatus($id, $status);

    if ($res === true) {
        $msg = "Status updated successfully";
    } else {
        $msg = $res;
    }
}




if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $res = Project::delete($id);

    if ($res === true) {
        $msg = "project Deleted Successfully";
    } else {
        $msg = $res;
    }
}


$rows = Project::readALL();

?>


<div class="content-wrapper mt-5">
    <main class="app-main mt-5">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Project List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb bg-transparent justify-content-end">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Projects Tables</li>
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
                            <div class="card-header">
                                <a class="btn btn-sm btn-dark" href="create_project">Create Project</a>
                            </div>

                            <?php if ($msg): ?>
                                <div class="alert alert-info mx-3 mt-2"><?= $msg; ?></div>
                            <?php endif; ?>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-primary">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Client</th>
                                                <th>Category</th>
                                                <th>Manager</th>
                                                <th>Budget Cost <small class="text-muted d-block fw-normal">(Phase Sum)</small></th>
                                                <th>Actual Cost</th>
                                                <th>Completion</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($rows as $items): ?>
                                                <?php
                                                // Budget: phase_budget আসলে phase allocated_cost এর SUM (auto-synced)
                                                // fallback হিসেবে project এর budget_cost দেখাই
                                                $phaseBudget  = (float)$items['phase_budget'];
                                                $phaseActual  = (float)$items['phase_actual'];
                                                $budgetDisplay = $phaseBudget > 0 ? $phaseBudget : (float)$items['budget_cost'];
                                                $percent      = (float)$items['completion_percent'];
                                                $percent      = min($percent, 100);

                                                // Progress bar color
                                                if ($percent >= 100) {
                                                    $barColor = 'bg-success';
                                                } elseif ($percent >= 60) {
                                                    $barColor = 'bg-info';
                                                } elseif ($percent >= 30) {
                                                    $barColor = 'bg-warning';
                                                } else {
                                                    $barColor = 'bg-secondary';
                                                }

                                                // ✅ Status — শুধুমাত্র completion % এর উপর ভিত্তি করে
                                                // actual_starting_time / actual_ending_time এ নির্ভর করলে ভুল দেখায়
                                                if ($percent >= 100) {
                                                    $status     = 'Completed';
                                                    $badgeClass = 'bg-primary';
                                                } elseif ($percent >= 75) {
                                                    $status     = 'Almost Done';
                                                    $badgeClass = 'bg-info';
                                                } elseif ($percent >= 30) {
                                                    $status     = 'In Progress';
                                                    $badgeClass = 'bg-success';
                                                } elseif ($percent > 0) {
                                                    $status     = 'Started';
                                                    $badgeClass = 'bg-warning text-dark';
                                                } else {
                                                    $status     = 'Pending';
                                                    $badgeClass = 'bg-secondary';
                                                }
                                                ?>
                                                <tr class="align-middle">
                                                    <td><?= $items['id'] ?></td>
                                                    <td>
                                                        <a href="project_detail?id=<?= $items['id']; ?>">
                                                            <?= $items['title'] ?>
                                                        </a>
                                                    </td>
                                                    <td><?= $items['client_name'] ?></td>
                                                    <td><?= $items['category_name'] ?></td>
                                                    <td><?= $items['user_name'] ?></td>

                                                    <!-- Budget Cost (Phase allocated_cost SUM) -->
                                                    <td>
                                                        <span class="fw-semibold">
                                                            <?= number_format($budgetDisplay, 2) ?>
                                                        </span>
                                                        <?php if ($phaseBudget > 0): ?>
                                                            <br><small class="text-muted">From <?= count(array_filter($rows, fn($r) => $r['id'] == $items['id'])) ?> phases</small>
                                                        <?php endif; ?>
                                                    </td>

                                                    <!-- Actual Cost -->
                                                    <td>
                                                        <?php
                                                        $actualDisplay = $phaseActual > 0 ? $phaseActual : (float)$items['actual_cost'];
                                                        $isOver = $actualDisplay > $budgetDisplay && $budgetDisplay > 0;
                                                        ?>
                                                        <span class="<?= $isOver ? 'text-danger fw-semibold' : '' ?>">
                                                            <?= number_format($actualDisplay, 2) ?>
                                                        </span>
                                                        <?php if ($isOver): ?>
                                                            <br><small class="text-danger"><i class="fa fa-arrow-up"></i> Over Budget</small>
                                                        <?php endif; ?>
                                                    </td>

                                                    <!-- Completion Percentage -->
                                                    <td style="min-width: 130px;">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="progress flex-grow-1" style="height:10px; border-radius:6px;">
                                                                <div class="progress-bar <?= $barColor ?>"
                                                                    role="progressbar"
                                                                    style="width: <?= $percent ?>%;"
                                                                    aria-valuenow="<?= $percent ?>"
                                                                    aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                            <span class="small fw-semibold" style="min-width:38px;">
                                                                <?= $percent ?>%
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="edit_project?id=<?= $items['id']; ?>" class="btn btn-sm btn-default">
                                                                <i class="fa fa-edit text-success"></i>
                                                            </a>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="delete_id" value="<?= $items['id']; ?>">
                                                                <button type="submit" class="btn btn-sm btn-default">
                                                                    <i class="fa fa-trash text-danger"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>

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