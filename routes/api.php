<?php

Route::post('/login', 'Api\AuthController@login');

// Android API
Route::get('/projects', 'Api\ProjectController@all');
Route::get('/project/categories', 'Api\CategoryController@byProject');

// Android API - New incident
Route::post('/incidents', 'Api\IncidentController@store');

// Android API - Reports
Route::get('/incidents/state', 'Api\IncidentController@stateCount');
Route::get('/projects/incident', 'Api\ProjectController@incidentCount');
Route::get('/supports/incident', 'Api\SupportController@incidentCount');

// Web API
Route::get('/proyecto/{id}/niveles', 'Admin\LevelController@byProject');
