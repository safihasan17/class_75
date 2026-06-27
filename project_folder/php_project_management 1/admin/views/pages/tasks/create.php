<?php
require_once 'models/taskclass.php';
require_once 'models/teamclass.php';
require_once 'models/projectclass.php';
require_once 'models/phasesclass.php';

$msg = "";

$Tasks = Tasks::readALL();
// echo "<pre>";
// print_r($tasks);
// echo "</pre>";

$Teams = Teams::readALL();

$project = Project::readALL();

$phases = Phases::readALL();





if (isset($_POST['btn_submit'])) {
    $project_id = $_POST['project_id'];
    $phase_id = $_POST['phase_id'];
    $tittle = $_POST['tittle'];
    $tassign_to_team_id = $_POST['assign_to_team_id'];



    $tasks = new Tasks(null, $project_id, $phase_id,  $tittle, $tassign_to_team_id);

    $tasks = $tasks->create();

    if ($tasks === true) {
        $msg = "tasks saved successfully.";
    } else {
        $msg = "Error: " . $tasks;
    }
}


?>


<div class="content-wrapper">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Form</div> <br> <br>

            <a href="manage_tasks" class="btn btn-sm btn-dark">Back</a>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card-body">

                <div class="form-group">
                    <label class="text-primary">project </label>
                    <select name="project_id" class="form-control">
                        <?php foreach ($project as $items): ?>
                            <option value="<?= $items['id']; ?>"><?= $items['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="text-primary">phases </label>
                    <select name="phase_id" class="form-control">
                        <?php foreach ($phases as $items): ?>
                            <option value="<?= $items['id']; ?>"><?= $items['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="text-primary">Tittle</label>
                    <input type="text" class="form-control" name="tittle" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label class="text-primary">assign to teams </label>
                    <select name="assign_to_team_id" class="form-control">
                        <?php foreach ($Teams as $items): ?>
                            <option value="<?= $items['id']; ?>"><?= $items['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

        <h3><?= $msg; ?></h3>
    </div>


</div>



<!-- <div class="content-wrapper m-5">
    
    <div class="nk-block nk-block-lg m-5">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title"> Form</h4>
                <div class="nk-block-des">
                    <p></p>
                </div>
            </div>
        </div>
        <div class="card card-bordered">
            <div class="card-inner">
                <div class="card-head">
                     <h5 class="card-title">Customer Info S2</h5> 
                </div>
                <form action="#">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="full-name-1">Full Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="full-name-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address-1">Email address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="phone-no-1">Phone No</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="phone-no-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="pay-amount-1">Amount</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="pay-amount-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div> -->