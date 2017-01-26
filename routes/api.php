<?php

Route::post('/login', 'Api\AuthController@login');

// Android API
Route::get('/projects', 'Api\ProjectController@all');
Route::get('/project/categories', 'Api\CategoryController@byProject');

// Web API
Route::get('/proyecto/{id}/niveles', 'Admin\LevelController@byProject');
