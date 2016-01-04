<?php

return[
     'app' => [
          'url' => 'https://polar-mesa-8063.herokuapp.com',
          'hash' =>[
               'algo' => PASSWORD_BCRYPT,
               'cost' => 10
          ]
     ],
     'db' => [
          'driver' => 'mysql',
          'host' => '127.0.0.1',
          'name' => 'site',
          'username' => '',
     	    'password' => '',
          'charset' => 'utf8',
          'collation' => 'utf8_unicode_ci',
          'prefix' => ''
      ],
      'auth' =>[
           'session' => 'user_id',
           'remember' => 'user_r'
      ],
      'mail' =>[
           'smtp_auth' => true,
           'smtp_secure' => 'tls',
           'host' => 'smtp.gmail.com',
           'username' => 'htiwarih0@gmail.com',
           'password' => '455111781',
           'port' => 587,
           'html' => true
      ],
      'twig' =>[
           'debug' => true
      ],
      'csrf' => [
           'key' => 'csrf_token'
      ]
];

?>