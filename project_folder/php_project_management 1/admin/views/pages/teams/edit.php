<?php
require_once 'models/projectclass.php';
require_once 'models/teamclass.php';

$msg = "";

$Teams = Project::readALL();
// echo "<pre>";
// print_r($p_catagory);
// echo "</pre>";





if (isset($_POST['btn_submit'])) {
  $name = $_POST['name'];
  $project_id = $_POST['project_id'];

  
  $team = new Teams(null, $name, $project_id );

  $teams = $team->create();

  if ($phases === true) {
    $msg = "Project saved successfully.";
  } else {
    $msg = "Error: " .$teams;
  }

  
}


?>


<div class="content-wrapper">
  <div class="card card-primary card-outline mb-4">
    <div class="card-header">
      <div class="card-title">Form</div> <br> <br>

      <a href="manage_teams" class="btn btn-sm btn-dark">Back</a>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
      <div class="card-body">
        <div class="form-group">
          <label>name</label>
          <input  class="form-control" type="text" name="name" id="">
        </div>

        <div class="form-group">
          <label>projects </label>
          <select class="form-control" name="project_id">

            <?php foreach ($Teams as $items): ?>
              <option value="<?= $items['id']; ?>"><?= $items['title']; ?></option>
            <?php endforeach; ?>

          </select>
        </div>
        
        
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" name="btn_submit" class="btn btn-primary">update</button>
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