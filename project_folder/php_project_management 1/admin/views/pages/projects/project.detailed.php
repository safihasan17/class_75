<?php

include_once 'models/projectclass.php';
$id     = (int)$_GET['id'];
$report = Project::getProjectDetails($id);

$info          = $report['info'];
$phases        = $report['phases'];
$total_budget  = $report['total_budget'];
$total_actual  = $report['total_actual'];
$total_exp_time = $report['total_exp_time'];
$total_act_time = $report['total_act_time'];

$isOver    = $total_actual > $total_budget;
$isDelayed = $total_act_time > $total_exp_time;
?>

<h3><?= htmlspecialchars($info['title']); ?></h3>

<div class="card border-0 shadow-sm mb-4 mt-2">
    <div class="card-body p-4">
        <a href="manage_project" class="btn btn-sm btn-dark">Back</a>
    </div>
</div>


<!-- Project Overview -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-2">

        <h3 class="mb-1 fw-bold" style="color: var(--pd-ink, #10241F);"><?= htmlspecialchars($info['title']); ?></h3>
        <p class="text-muted mb-4">Project Overview</p>

        <div class="row g-3">
            <!-- Client -->
            <div class="col-md-4">
                <div class="p-3 rounded-3 h-100" style="background:#F3F6F5;">
                    <div class="text-uppercase small text-muted mb-1">
                        <i class="fa-solid fa-building me-1"></i> Client
                    </div>
                    <div class="fw-semibold"><?= htmlspecialchars($info['client_name']); ?></div>
                    <div class="small text-muted"><?= htmlspecialchars($info['organization']); ?></div>
                </div>
            </div>

            <!-- Category -->
            <div class="col-md-4">
                <div class="p-3 rounded-3 h-100" style="background:#F3F6F5;">
                    <div class="text-uppercase small text-muted mb-1">
                        <i class="fa-solid fa-tags me-1"></i> Category
                    </div>
                    <div class="fw-semibold"><?= htmlspecialchars($info['category_name']); ?></div>
                    <div class="small text-muted">
                        <i class="fa-regular fa-user me-1"></i> Manager: <?= htmlspecialchars($info['manager_name']); ?>
                    </div>
                </div>
            </div>

            <!-- Dynamic Cost Card -->
            <div class="col-md-4">
                <div class="p-3 rounded-3 h-100" style="background:#F3F6F5;">
                    <div class="text-uppercase small text-muted mb-1">
                        <i class="fa-solid fa-sack-dollar me-1"></i> Overall Cost
                        <span class="ms-1 badge bg-secondary" style="font-size:.6rem;">AUTO</span>
                    </div>
                    <div class="fw-semibold">Budget: ৳<?= number_format($total_budget, 2); ?></div>
                    <div class="small">
                        Actual: ৳<?= number_format($total_actual, 2); ?>
                        <span class="badge <?= $isOver ? 'bg-danger' : 'bg-success'; ?> ms-1">
                            <?= $isOver ? 'Over Budget' : 'On Budget'; ?>
                        </span>
                    </div>
                    <?php if ($total_budget > 0): ?>
                    <div class="mt-2">
                        <div class="progress" style="height:6px;">
                            <?php $pct = min(100, round(($total_actual / $total_budget) * 100)); ?>
                            <div class="progress-bar <?= $isOver ? 'bg-danger' : 'bg-success'; ?>"
                                 style="width:<?= $pct; ?>%"></div>
                        </div>
                        <div class="text-muted small mt-1"><?= $pct; ?>% of budget used</div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Timeline + Total Time -->
        <div class="row g-3 mt-1">
            <div class="col-md-4">
                <div class="p-3 rounded-3 h-100" style="background:#F3F6F5;">
                    <div class="text-uppercase small text-muted mb-1">
                        <i class="fa-regular fa-calendar me-1"></i> Expected Timeline
                    </div>
                    <div class="fw-semibold">
                        <?php if ($info['expected_starting_time'] && $info['expected_starting_time'] !== '1000-01-01 00:00:00'): ?>
                            <?= date('M d, Y', strtotime($info['expected_starting_time'])); ?>
                            <i class="fa-solid fa-arrow-right mx-1 text-muted small"></i>
                            <?= date('M d, Y', strtotime($info['expected_ending_time'])); ?>
                        <?php else: ?>
                            <span class="text-muted fw-normal">Not set</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <?php
                $hasActualStart = !empty($info['actual_starting_time']) && $info['actual_starting_time'] !== '1000-01-01 00:00:00';
                $hasActualEnd   = !empty($info['actual_ending_time'])   && $info['actual_ending_time']   !== '1000-01-01 00:00:00';
                $dateDelayed    = $hasActualEnd && strtotime($info['actual_ending_time']) > strtotime($info['expected_ending_time']);
                ?>
                <div class="p-3 rounded-3 h-100" style="background:#F3F6F5;">
                    <div class="text-uppercase small text-muted mb-1">
                        <i class="fa-solid fa-calendar-check me-1"></i> Actual Timeline
                    </div>
                    <div class="fw-semibold">
                        <?php if ($hasActualStart): ?>
                            <?= date('M d, Y', strtotime($info['actual_starting_time'])); ?>
                            <i class="fa-solid fa-arrow-right mx-1 text-muted small"></i>
                            <?= $hasActualEnd ? date('M d, Y', strtotime($info['actual_ending_time'])) : 'In Progress'; ?>
                            <?php if ($hasActualEnd): ?>
                                <span class="badge <?= $dateDelayed ? 'bg-danger' : 'bg-success'; ?> ms-1">
                                    <?= $dateDelayed ? 'Delayed' : 'On Time'; ?>
                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-muted fw-normal">Not started yet</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Dynamic Total Duration from phases -->
            <div class="col-md-4">
                <div class="p-3 rounded-3 h-100" style="background:#F3F6F5;">
                    <div class="text-uppercase small text-muted mb-1">
                        <i class="fa-solid fa-clock me-1"></i> Total Duration (phases)
                        <span class="ms-1 badge bg-secondary" style="font-size:.6rem;">AUTO</span>
                    </div>
                    <div class="fw-semibold">
                        Expected: <?= $total_exp_time; ?> day<?= $total_exp_time != 1 ? 's' : ''; ?>
                    </div>
                    <div class="small">
                        Actual: <?= $total_act_time; ?> day<?= $total_act_time != 1 ? 's' : ''; ?>
                        <?php if ($total_exp_time > 0): ?>
                        <span class="badge <?= $isDelayed ? 'bg-danger' : 'bg-success'; ?> ms-1">
                            <?= $isDelayed ? 'Delayed' : 'On Time'; ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Phases Table -->
<div class="card border-0 shadow-sm mb-4">
  <div class="card-header bg-white border-0 pt-4 px-4 d-flex align-items-center justify-content-between">
    <h5 class="mb-0 fw-bold"><i class="fa-solid fa-layer-group me-2 text-success"></i>Phases</h5>
    <a href="create_phases_cost" class="btn btn-sm btn-outline-success">+ Add Phase Entry</a>
  </div>
  <div class="card-body px-4 pb-4 pt-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr class="text-uppercase small text-muted">
            <th>Phase</th>
            <th>Allocated Budget (৳)</th>
            <th>Actual Cost (৳)</th>
            <th>Expected (days)</th>
            <th>Actual (days)</th>
            <th>Cost Status</th>
            <th>Time Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($phases)): ?>
            <tr>
              <td colspan="7" class="text-center text-muted py-4">No phase data added for this project yet.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($phases as $p):
                $overCost = $p['actual_cost']  > $p['allocated_cost'];
                $overTime = $p['actual_time']  > $p['expected_time'];
            ?>
              <tr>
                <td class="fw-semibold"><?= htmlspecialchars($p['phase_title']); ?></td>
                <td>৳<?= number_format($p['allocated_cost'], 2); ?></td>
                <td>৳<?= number_format($p['actual_cost'], 2); ?></td>
                <td><?= (int)$p['expected_time']; ?> day<?= (int)$p['expected_time'] != 1 ? 's' : ''; ?></td>
                <td><?= (int)$p['actual_time']; ?> day<?= (int)$p['actual_time'] != 1 ? 's' : ''; ?></td>
                <td>
                  <span class="badge <?= $overCost ? 'bg-danger' : 'bg-success'; ?>">
                    <?= $overCost ? 'Over Budget' : 'On Budget'; ?>
                  </span>
                </td>
                <td>
                  <?php if ($p['expected_time'] > 0): ?>
                  <span class="badge <?= $overTime ? 'bg-danger' : 'bg-success'; ?>">
                    <?= $overTime ? 'Delayed' : 'On Time'; ?>
                  </span>
                  <?php else: ?>
                    <span class="text-muted small">—</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>

            <!-- Totals row -->
            <tr class="table-light fw-bold">
              <td>TOTAL</td>
              <td>৳<?= number_format($total_budget, 2); ?></td>
              <td>৳<?= number_format($total_actual, 2); ?></td>
              <td><?= $total_exp_time; ?> days</td>
              <td><?= $total_act_time; ?> days</td>
              <td>
                <span class="badge <?= $isOver ? 'bg-danger' : 'bg-success'; ?>">
                  <?= $isOver ? 'Over Budget' : 'On Budget'; ?>
                </span>
              </td>
              <td>
                <?php if ($total_exp_time > 0): ?>
                <span class="badge <?= $isDelayed ? 'bg-danger' : 'bg-success'; ?>">
                  <?= $isDelayed ? 'Delayed' : 'On Time'; ?>
                </span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- Team -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-users me-2 text-success"></i>Team</h5>
    </div>
    <div class="card-body px-4 pb-4 pt-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr class="text-uppercase small text-muted">
                        <th>Member</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($report['team'])): ?>
                        <tr>
                            <td colspan="2" class="text-center text-muted py-4">No team members assigned yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($report['team'] as $t): ?>
                            <tr>
                                <td class="d-flex align-items-center gap-2">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-success fw-semibold"
                                        style="width:32px;height:32px;font-size:.8rem;">
                                        <?= strtoupper(substr($t['member_name'], 0, 1)); ?>
                                    </span>
                                    <?= htmlspecialchars($t['member_name']); ?>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($t['role_name']); ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tasks -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-list-check me-2 text-success"></i>Tasks</h5>
    </div>
    <div class="card-body px-4 pb-4 pt-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr class="text-uppercase small text-muted">
                        <th>Task</th>
                        <th>Phase</th>
                        <th>Team</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($report['tasks'])): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">No tasks created for this project yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($report['tasks'] as $tk): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($tk['task_title']); ?></td>
                                <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($tk['phase_title']); ?></span></td>
                                <td><?= htmlspecialchars($tk['team_name']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
