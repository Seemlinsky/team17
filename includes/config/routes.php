<?php
$routes = [
    '' => 'HomeHandler@index',
    'afspraken' => 'DateHandler@index',
    'afspraken/detail' => 'DateHandler@detail',
    'afspraken/create' => 'DateHandler@create',
    'afspraken/edit' => 'DateHandler@edit',
    'afspraken/delete' => 'DateHandler@delete',
    'jobs' => 'JobHandler@index',
    'jobs/detail' => 'JobHandler@detail',
    'jobs/create' => 'JobHandler@create',
    'jobs/edit' => 'JobHandler@edit',
    'jobs/delete' => 'JobHandler@delete',
    'login' => 'AccountHandler@login',
    'logout' => 'AccountHandler@logout',
    'registratie' => 'AccountHandler@register'
];
