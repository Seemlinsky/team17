<?php
$routes = [
    '' => 'HomeHandler@index',
    'dates' => 'DateHandler@index',
    'dates/detail' => 'DateHandler@detail',
    'dates/create' => 'DateHandler@create',
    'dates/edit' => 'DateHandler@edit',
    'dates/delete' => 'DateHandler@delete',
    'jobs' => 'JobHandler@index',
    'jobs/detail' => 'JobHandler@detail',
    'jobs/create' => 'JobHandler@create',
    'jobs/edit' => 'JobHandler@edit',
    'jobs/delete' => 'JobHandler@delete',
    'user/login' => 'AccountHandler@login',
    'user/logout' => 'AccountHandler@logout'
];
