<?php
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