<?php
foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_") !== 0) {
        continue;
    }

    $servername = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $username = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $password = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

if($servername){
return $clasa = json_decode(json_encode([
    'setting' => [
        'db' => [
            'driver'    => 'mysql',
            'host'      => $servername,
            'database'  => 'srvnv',
            'username'  => $username,
            'password'  => $password,
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => ''
        ]
    ]
]));
}
else{
return $clasa = json_decode(json_encode([
    'setting' => [
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'srvnv',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => ''
        ]
    ]
]));
}