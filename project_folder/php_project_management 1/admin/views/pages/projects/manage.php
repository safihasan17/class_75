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
    // echo $id;
    $res = Project::delete($id);

    if ($res === true) {
        $msg = "project Delated Sucessfully";
    } else {
        $msg = $res;
    }
}


$rows = Project::readALL();
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
                        <h3 class="mb-0 ">Project List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb bg-transparent  justify-content-end">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Projects Tables</li>
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
                                <a class="btn btn-sm btn-dark" href="create_project">create Projects</a>

                            </div>
                            <!-- /.card-header -->

                            <h4><?= $msg; ?></h4>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered  text-primary">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Client</th>
                                                <th>project category</th>
                                                <th>User</th>
                                                <th>Actual cost</th>
                                                <th>Budget cost</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($rows as $items): ?>
                                                <tr class="align-middle">
                                                    <td><?= $items['id'] ?></td>
                                                    <td> <a href="project_detail?id=<?= $items['id']; ?>"> <?= $items['title'] ?></a> </td>
                                                    <td> <?= $items['client_name'] ?></td>
                                                    <td><?= $items['category_name'] ?></td>
                                                    <td><?= $items['user_name'] ?></td>
                                                    <!-- <td> <?=  formatDate($items['expected_starting_time']) ?></td>
                                                     <td><?=  formatDate($items['expected_ending_time']) ?></td>
                                                     <td><?= formatDate($items['actual_starting_time']) ?></td>
                                                     <td><?= formatDate($items['actual_ending_time']) ?></td> -->

                                                    <td><?= $items['actual_cost'] ?></td>
                                                    <td><?= $items['budget_cost'] ?></td>


                                                    <td>
                                                        <?php
                                                        $hasStart = $items['actual_starting_time'] != '0000-00-00 00:00:00';
                                                        $hasEnd   = $items['actual_ending_time'] != '0000-00-00 00:00:00';

                                                        if ($hasEnd) {
                                                            $status = 'Completed';
                                                            $badgeClass = 'bg-primary';
                                                        } elseif ($hasStart) {
                                                            $status = 'Active';
                                                            $badgeClass = 'bg-success';
                                                        } else {
                                                            $status = 'Pending';
                                                            $badgeClass = 'bg-warning';
                                                        }
                                                        ?>
                                                        <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                                                    </td>


                                                    <td>
                                                        <div class="btn-group">
                                                            <!-- <a href="project_detail?id=<?= $items['id']; ?>" class="btn btn-sm btn-default"><i class="fa fa-eye text-primary"> </i> </a> -->
                                                            <a href="edit_project?id=<?= $items['id']; ?>" class="btn btn-sm btn-default"><i class="fa fa-edit text-success"></i></a>
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

                            </div>
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