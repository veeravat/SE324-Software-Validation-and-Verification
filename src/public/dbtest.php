<pre>
<?php

require 'common.php';

    $query = "SELECT * FROM `user_info` ";
    $data = $pdo->query("SELECT * FROM user_info ",array());
    echo count($data);
    print_r($data[0]);
    ?>
</pre>
