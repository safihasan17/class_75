<?php
// Send the correct HTTP status code
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>



    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, Helvetica, sans-serif;
            background:#0f172a;
            color:#fff;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .container{
            text-align:center;
            max-width:600px;
            padding:40px;
        }

        h1{
            font-size:8rem;
            color:#38bdf8;
            margin-bottom:10px;
        }

        h2{
            font-size:2rem;
            margin-bottom:20px;
        }

        p{
            color:#cbd5e1;
            margin-bottom:30px;
            line-height:1.7;
        }

        .btn{
            display:inline-block;
            padding:14px 28px;
            background:#38bdf8;
            color:#0f172a;
            text-decoration:none;
            border-radius:8px;
            font-weight:bold;
            transition:.3s;
        }

        .btn:hover{
            background:#0ea5e9;
            transform:translateY(-2px);
        }

        .info{
            margin-top:40px;
            color:#94a3b8;
            font-size:.9rem;
        }

        code{
            background:#1e293b;
            padding:2px 6px;
            border-radius:4px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>404</h1>

    <h2>Oops! Page Not Found</h2>

    <p>
        The page you are looking for may have been removed,
        renamed, or is temporarily unavailable.
    </p>

    <a href="<?php echo esc_url(home_url('/'));?>" class="btn">Go to Homepage</a>

    <div class="info">
        <?php
        echo "Requested URL: <code>" .
             htmlspecialchars($_SERVER['REQUEST_URI']) .
             "</code>";
        ?>
    </div>

</div>

</body>
</html>