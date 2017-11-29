<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/instrucciones', function () {
    return view('instructions');
});

Route::get('/acerca-de', function () {
    return view('credits');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/seleccionar/proyecto/{id}', 'HomeController@selectProject');

Route::group(['middleware' => 'auth', 'namespace' => 'User'], function (){
    Route::get('/profile', 'ProfileController@edit');
    Route::post('/profile/data', 'ProfileController@postData');
    Route::post('/profile/password', 'ProfileController@postPassword');
    Route::post('/profile/image', 'ProfileController@postImage');
});

// Incident

Route::get('/reportar', 'IncidentController@create');
Route::post('/reportar', 'IncidentController@store');

Route::get('/incidencia/{id}/editar', 'IncidentController@edit');
Route::post('/incidencia/{id}/editar', 'IncidentController@update');

Route::get('/ver/{id}', 'IncidentController@show');

Route::get('/incidencia/{id}/atender', 'IncidentController@take');
Route::get('/incidencia/{id}/resolver', 'IncidentController@solve');
Route::get('/incidencia/{id}/abrir', 'IncidentController@open');
Route::get('/incidencia/{id}/derivar', 'IncidentController@nextLevel');


// Message & attachments
Route::post('/mensajes', 'MessageController@store');
Route::post('/adjuntos', 'AttachmentController@store');

// Search incidents by control number
Route::get('/search', 'SearchController@index');


Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {

    // PredefinedDescription
    Route::get('/descripciones', 'DescriptionController@index');
    Route::post('/descripciones', 'DescriptionController@store');

    // User
    Route::get('/usuarios', 'UserController@index');
    Route::post('/usuarios', 'UserController@store');
    Route::get('/usuario/{id}', 'UserController@edit');
    Route::post('/usuario/{id}', 'UserController@update');
    Route::get('/usuario/{id}/eliminar', 'UserController@delete');

    // Project
	Route::get('/proyectos', 'ProjectController@index');
	Route::post('/proyectos', 'ProjectController@store');

	Route::get('/proyecto/{id}', 'ProjectController@edit');
    Route::post('/proyecto/{id}', 'ProjectController@update');

    Route::get('/proyecto/{id}/eliminar', 'ProjectController@delete');
    Route::get('/proyecto/{id}/restaurar', 'ProjectController@restore');

    // Category
    Route::post('/categorias', 'CategoryController@store');
    Route::post('/categoria/editar', 'CategoryController@update');
    Route::get('/categoria/{id}/eliminar', 'CategoryController@delete');
    // Level
    Route::post('/niveles', 'LevelController@store');
    Route::post('/nivel/editar', 'LevelController@update');
    Route::get('/nivel/{id}/eliminar', 'LevelController@delete');

    // Project-User
    Route::post('/proyecto-usuario', 'ProjectUserController@store');
    Route::get('/proyecto-usuario/{id}/eliminar', 'ProjectUserController@delete');

    // Reports
	Route::get('/reportes', 'ReportController@index');
    Route::get('/reportes/by-project', 'ReportController@byProjects');
    Route::get('/reportes/proyectos/{project}/by-descriptions', 'ReportController@byPredefinedDescriptions');
});
