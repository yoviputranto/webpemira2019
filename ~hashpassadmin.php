<?php

    $options = [
        'cost' => 10
    ];

    $hash1 = password_hash("adminpem!ra", PASSWORD_DEFAULT, $options);

    //$hash1 = password_hash("admin", PASSWORD_DEFAULT, $options);
    echo $hash1;
    echo "<br>";
    echo password_verify("adminpem!ra",$hash1);
    
    // echo "<br>";
    // echo password_hash("admin", PASSWORD_DEFAULT);

?>