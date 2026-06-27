<?php
require_once 'models/projectteamsclass.php';
require_once 'models/teamclass.php';
require_once 'models/teamroleclass.php';
require_once 'models/teammemberclass.php';

$msg = "";

$projectTeams = ProjectTeam::readALL();
// echo "<pre>";
// print_r($Teams);
// echo "</pre>";

$Teams = Teams::readALL();

$TeamRole = TeamRole::readALL();

$TeamMember = TeamMember::readALL();





if (isset($_POST['btn_submit'])) {
    $team_id = $_POST['team_id'];
    $team_role_id = $_POST['team_role_id'];
    $team_member_id = $_POST['team_member_id'];
    


    $ProjectTeam = new ProjectTeam( null ,$team_id, $team_role_id, $team_member_id);

    $teams = $ProjectTeam->create();

    if ($teams === true) {
        $msg = "Project saved successfully.";
    } else {
        $msg = "Error: " . $teams;
    }
}


?>


<div class="content-wrapper">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Form</div> <br> <br>

            <a href="manage_project_teams" class="btn btn-sm btn-dark">Back</a>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card-body">

                <div class="form-group">
                    <label>Teams </label>
                    <select class="form-control" name="team_id">

                        <?php foreach ($Teams as $items): ?>
                            <option value="<?= $items['id']; ?>"><?= $items['name']; ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label>Team role </label>
                    <select class="form-control" name="team_role_id">

                        <?php foreach ($TeamRole as $items): ?>
                            <option value="<?= $items['id']; ?>"><?= $items['name']; ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label>Team member </label>
                    <select class="form-control" name="team_member_id">

                        <?php foreach ($TeamMember as $items): ?>
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