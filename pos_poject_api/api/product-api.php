<?php
function createProduct($_data, $_files)
{
    $img = null;
    if (isset($_files['image'])) {
        $result = imgupload($_files['image'], "../uploads/products");
        if (isset($result['success'])) {
            $img = $result['success'];
        } else {
            http_response_code(401);
            echo $result['error'];
            exit;
        }
    }

    
}
