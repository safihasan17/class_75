<?php
if(isset($_SESSION['id'])){
    header("Location: dashboard");
}

require_once 'models/userclass.php';
require_once 'models/authclass.php';

if(isset($_POST['email']) && isset($_POST['password'])){
    $email =   $_POST['email'];
    $pass =   $_POST['password'];

    $auth = Auth::login($email, $pass);

    // print_r($auth);

    if(isset($auth['error'])){
        $msg = $auth['error'];
    }
    else{
        // print_r($auth);
        $_SESSION['id']= $auth['id'];
        $_SESSION['role_id']= $auth['role_id'];
        header("Location: dashboard");
    }
}
?>


<style>
    .nk-header-wrap{
        display: none;
    }

    .nk-footer{
      display: none;  
    }

    .nk-sidebar{
        display: none;
    }

    .nk-wrap {
    padding-left: 0 !important;
    }
</style>

<div class="contain-wrapper ">

    <div class="nk-block nk-block-middle nk-auth-body  wide-xs" style="text-align: center;">
        <div class="brand-logo pb-4 text-center">
            <a href="dashboard" class="logo-link">
                <!-- <img class="logo-light logo-img logo-img-lg" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark"> -->
                <h3 >Project Hub</h3>
            </a>
        </div>
        <div class="card card-bordered">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Sign-In</h4>
                        <div class="nk-block-des">
                            <p>Access the Project Hub panel using your email and password.</p>
                        </div>
                    </div>
                </div>
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Email or Username</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" name="email" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">password</label>
                            <a class="link link-primary link-sm" href="">Forgot Code?</a>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" id="password" placeholder="" name="password">
                        </div>
                    </div>
                     <p class="text-danger text-center font-weight-bold mb-1" ><?= $msg ?? "" ?></p>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" name="button">Sign in</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4"> New on our platform? <a href="">Create an account</a>
                </div>
                <div class="text-center pt-4 pb-3">
                    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                </div>
                <ul class="nav justify-center gx-4">
                    <li class="nav-item"><a class="link link-primary fw-normal py-2 px-3" href="#">Facebook</a></li>
                    <li class="nav-item"><a class="link link-primary fw-normal py-2 px-3" href="#">Google</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>