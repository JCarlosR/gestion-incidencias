<?php

Route::post('/login', 'Api\AuthController@login');

Route::get('/proyecto/{id}/niveles', 'Admin\LevelController@byProject');
