<?php

Route::post('/login', 'Api\AuthController@login');

// Android API
Route::get('/projects', 'Admin\ProjectController@all');
Route::get('/project/{id}/categories', 'Admin\CategoryController@byProject');

// Web API
Route::get('/proyecto/{id}/niveles', 'Admin\LevelController@byProject');
