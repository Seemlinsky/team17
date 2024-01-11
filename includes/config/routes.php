<?php
$routes = [
    '' => 'HomeHandler@index',
    'games' => 'GameHandler@index',
    'games/detail' => 'GameHandler@detail',
    'games/create' => 'GameHandler@create',
    'games/edit' => 'GameHandler@edit',
    'games/delete' => 'GameHandler@delete',
    'genres' => 'GenreHandler@index',
    'genres/detail' => 'GenreHandler@detail',
    'genres/create' => 'GenreHandler@create',
    'genres/edit' => 'GenreHandler@edit',
    'genres/delete' => 'GenreHandler@delete',
    'developers' => 'DeveloperHandler@index',
    'developers/detail' => 'DeveloperHandler@detail',
    'developers/create' => 'DeveloperHandler@create',
    'developers/edit' => 'DeveloperHandler@edit',
    'developers/delete' => 'DeveloperHandler@delete',
    'user/login' => 'AccountHandler@login',
    'user/logout' => 'AccountHandler@logout'
];
