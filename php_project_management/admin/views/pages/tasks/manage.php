<?php

$msg = "";
require_once 'models/taskclass.php';


function formatDate($date)
{
    if (!$date || $date == '0000-00-00 00:00:00' || $date == '1000-01-01 00:00:00') return '-';
    return date('d M Y', strtotime($date));
}

if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    // echo $id;
    $res = Tasks::delete($id);

    if ($res === true) {
        $msg = "project Delated Sucessfully";
    } else {
        $msg = $res;
    }
}




$rows = Tasks::readALL();
// echo "<pre>";
// print_r($rows);
// echo "</pre>";

?>


<div class="content-wrapper mt-5">
    <main class="app-main mt-5">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0"> Tasks</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb bg-transparent  justify-content-end">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Task list</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a class="btn btn-sm btn-dark" href="create_tasks">create Tasks</a>

                            </div>
                            <!-- /.card-header -->

                            <h4><?= $msg; ?></h4>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    
                                    <table class="table table-hover table-striped align-middle">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="text-success fw-bold">ID</th>
                                                <th class="text-success fw-bold">Project Title</th>
                                                <th class="text-success fw-bold">Phase Title</th>
                                                <th class="text-success fw-bold">Title</th>
                                                <th class="text-success fw-bold">Team Name</th>
                                                <th class="text-success fw-bold">Allocated Cost <small class="text-muted d-block fw-normal">(Budget)</small></th>
                                                <th class="text-success fw-bold">Actual Cost</th>
                                                <th class="text-success fw-bold">Phase Completion</th>
                                                <th class="text-success fw-bold">Expected Time</th>
                                                <th class="text-success fw-bold">Actual Time</th>
                                                <th class="text-success fw-bold">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($rows as $items): ?>

                                                <?php
                                                $allocated = (float)$items['allocated_cost'];
                                                $actual    = (float)$items['actual_cost'];
                                                $percent   = (float)$items['task_percent'];
                                                $isOver    = $actual > $allocated && $allocated > 0;

                                                if ($percent >= 100) {
                                                    $barColor = 'bg-success';
                                                } elseif ($percent >= 60) {
                                                    $barColor = 'bg-info';
                                                } elseif ($percent >= 30) {
                                                    $barColor = 'bg-warning';
                                                } else {
                                                    $barColor = 'bg-secondary';
                                                }
                                                ?>
                                                <tr class="align-middle">
                                                    <td class="fw-bold text-primary"><?= $items['id'] ?></td>
                                                    <!-- ব্যাজ সরিয়ে শুধু রঙিন টেক্সট -->
                                                    <td class="text-info fw-semibold"><?= $items['project_title'] ?></td>
                                                    <td class="text-success fw-semibold"><?= $items['phase_title'] ?></td>
                                                    <td class="text-warning fw-semibold"><?= $items['title'] ?></td>
                                                    <td class="text-danger fw-semibold"><?= $items['team_name'] ?></td>

                                                    
                                                    <!-- Allocated Cost (Budget) -->
                                                    <td class="fw-semibold text-success">
                                                        <?= number_format($allocated, 2) ?>
                                                    </td>

                                                    <!-- Actual Cost -->
                                                    <td class="<?= $isOver ? 'text-danger fw-semibold' : 'text-success fw-semibold' ?>">
                                                        <?= number_format($actual, 2) ?>
                                                        <?php if ($isOver): ?>
                                                            <br><small class="text-danger"><i class="fa fa-arrow-up"></i> Over</small>
                                                        <?php endif; ?>
                                                    </td>

                                                    <!-- task Completion -->
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

                                                    <!-- Expected Time: ব্যাজ না করে শুধু টেক্সট রঙ -->
                                                    <td class="text-warning fw-semibold"><?= formatDate($items['expected_time']) ?></td>

                                                    <!-- Actual Time: ব্যাজ না করে শুধু টেক্সট রঙ -->
                                                    <td class="text-danger fw-semibold"><?= formatDate($items['actual_time']) ?></td>

                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="edit_tasks?id=<?= $items['id']; ?>" class="btn btn-sm btn-outline-primary rounded-start" title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <form action="" method="POST" class="d-inline">
                                                                <input type="hidden" name="delete_id" value="<?= $items['id']; ?>">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-end" title="Delete" onclick="return confirm('Are you sure?')">
                                                                    <i class="fa fa-trash"></i>
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

                            <!-- <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>project title</th>
                                                <th>phase title</th>
                                                <th>title</th>
                                                <th>team name</th>
                                                <th>Action</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php foreach ($rows as $items): ?>
                                            <tr class="align-middle">
                                                <td><?= $items['id'] ?></td>
                                                <td><?= $items['project_title'] ?></td>
                                                <td><?= $items['phase_title'] ?></td>
                                                <td><?= $items['title'] ?></td>
                                                <td><?= $items['team_name'] ?></td>
                                                
                                             
                                                <td>
                                                    <div class="btn-group">
                                                        
                                                        <a href="edit_tasks?id=<?= $items['id']; ?>" class="btn btn-sm btn-default" ><i class="fa fa-edit text-success"></i></a> 
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="delete_id" value="<?= $items['id']; ?>">
                                                             <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-trash text-denger"></i></button>
                                                        </form>
                                                        


                                                    </div>
                                                </td>
                                            </tr>

                                            <?php endforeach; ?>



                                        </tbody>
                                    </table>
                                </div>

                            </div> -->
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->


                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
</div>


<!-- <div class="content-wrapper mt-4">
     <div class="nk-block nk-block-lg mt-3 ">
                      <div class="nk-block-head">
                        <div class="nk-block-head-content">
                          <h4 class="nk-block-title">Table </h4>
                          <div class="nk-block-des">
                            <p class="btn btn-sm btn-dark m-3"> Users </p>
                          </div>
                        </div>
                      </div>
                      <div class="card card-bordered card-preview">
                        <div class="card-inner">
                          <table class="table">
                            <thead>
                              <tr>
                                <th >ID</th>
                                <th >Name</th>
                                <th >Email</th>
                                <th >Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      
                      
</div> -->