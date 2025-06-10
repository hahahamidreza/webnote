<?php
$config = [
     'db' => [
         'host' => 'localhost',
         'user' => 'root',
         'pass' => '',
         'name' => 'webnote'
     ],
    'base_url' => 'http://localhost/webnote/'
];
global $config;
function base_url(){
    global $config;
    return $config['base_url'];
}
//echo base_url();