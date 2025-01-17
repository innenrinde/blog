<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/


$hook['post_controller_constructor'] = [
    [
        'class' => 'LanguageLoader',
        'function' => 'initialize',
        'filename' => 'LanguageLoader.php',
        'filepath' => 'hooks'
    ],
    [
        'class' => 'WidgetsLoader',
        'function' => 'initialize',
        'filename' => 'WidgetsLoader.php',
        'filepath' => 'hooks'
    ],
    [
        'class' => 'StaticDataLoader',
        'function' => 'categories',
        'filename' => 'StaticDataLoader.php',
        'filepath' => 'hooks'
    ],
    [
        'class' => 'StaticDataLoader',
        'function' => 'pages',
        'filename' => 'StaticDataLoader.php',
        'filepath' => 'hooks'
    ]
];
