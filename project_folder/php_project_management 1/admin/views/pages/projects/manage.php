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
    $msg = ($res === true) ? "Status updated successfully" : $res;
}

if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $res = Project::delete($id);
    $msg = ($res === true) ? "project Delated Sucessfully" : $res;
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
                                <a class="btn btn-sm btn-dark" href="create_project">create Projects</a>
                            </div>

                            <h4><?= $msg; ?></h4>

                            <div class="card-body p-0">

                                <!-- 1st document এর table structure -->
                                <div class="card card-bordered card-preview">
                                    <table class="table table-orders">
                                        <thead class="tb-odr-head">
                                            <tr class="tb-odr-item">
                                                <th class="tb-odr-info">
                                                    <span class="tb-odr-id">Project</span>
                                                    <span class="tb-odr-date d-none d-md-inline-block">Client / Category</span>
                                                </th>
                                                <th class="tb-odr-amount">
                                                    <span class="tb-odr-total">Budget / Actual</span>
                                                    <span class="tb-odr-status d-none d-md-inline-block">Status</span>
                                                </th>
                                                <th class="tb-odr-action">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tb-odr-body">

                                            <?php foreach ($rows as $items): ?>
                                                <?php
                                                $hasStart = $items['actual_starting_time'] != '0000-00-00 00:00:00';
                                                $hasEnd   = $items['actual_ending_time']   != '0000-00-00 00:00:00';

                                                if ($hasEnd) {
                                                    $status     = 'Completed';
                                                    $badgeClass = 'bg-primary';
                                                } elseif ($hasStart) {
                                                    $status     = 'Active';
                                                    $badgeClass = 'bg-success';
                                                } else {
                                                    $status     = 'Pending';
                                                    $badgeClass = 'bg-warning';
                                                }
                                                ?>
                                                <tr class="tb-odr-item">
                                                    <td class="tb-odr-info">
                                                        <span class="tb-odr-id">
                                                            <a href="project_detail?id=<?= $items['id']; ?>">
                                                                #<?= $items['id'] ?> – <?= $items['title'] ?>
                                                            </a>
                                                        </span>
                                                        <span class="tb-odr-date d-none d-md-inline-block">
                                                            <?= $items['client_name'] ?> / <?= $items['category_name'] ?> / <?= $items['user_name'] ?>
                                                        </span>
                                                    </td>
                                                    <td class="tb-odr-amount">
                                                        <span class="tb-odr-total">
                                                            <span class="amount">
                                                                Budget: $<?= $items['budget_cost'] ?> &nbsp;|&nbsp; Actual: $<?= $items['actual_cost'] ?>
                                                            </span>
                                                        </span>
                                                        <span class="tb-odr-status">
                                                            <span class="badge badge-dot <?= $badgeClass ?>"><?= $status ?></span>
                                                        </span>
                                                    </td>
                                                    <td class="tb-odr-action">
                                                        <div class="tb-odr-btns d-none d-md-inline">
                                                            <a href="project_detail?id=<?= $items['id']; ?>" class="btn btn-sm btn-primary">View</a>
                                                        </div>
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                                               data-bs-toggle="dropdown" data-offset="-8,0" aria-expanded="false">
                                                                <em class="icon ni ni-more-h"></em>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="edit_project?id=<?= $items['id']; ?>" class="text-primary">Edit</a></li>
                                                                    <li><a href="project_detail?id=<?= $items['id']; ?>" class="text-primary">View</a></li>
                                                                    <li>
                                                                        <form action="" method="POST" style="display:inline;">
                                                                            <input type="hidden" name="delete_id" value="<?= $items['id']; ?>">
                                                                            <button type="submit" class="text-danger"
                                                                                    style="background:none;border:none;padding:0;cursor:pointer;">
                                                                                Remove
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>