<?php

Route::post('/login', 'Api\AuthController@login');

// Android API
Route::get('/projects', 'Api\ProjectController@all');
Route::get('/project/categories', 'Api\CategoryController@byProject');

// Android API - Reports
Route::get('/incidents/state', 'Api\IncidentController@stateCount');

// Web API
Route::get('/proyecto/{id}/niveles', 'Admin\LevelController@byProject');
