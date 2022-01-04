<?php
/*
 *
 * Frontend Routes
 *
 * --------------------------------------------------------------------
 */
Route::get('/', 'JobsController@index')->name('home');
Route::post('/get-jobs', 'JobsController@getJobs')->name('get-jobs');
Route::get('/job/{id}/{name}', 'JobsController@jobStatus')->name('job-status');
Route::post('/job/removal-req/{id}', 'JobsController@changeRemovalStatus')->name('job-removal-status');
Route::get('/other-job/{id}', 'JobsController@otherJob')->name('other-job');
Route::post('/othertask/{id}', 'JobsController@othertask')->name('othertask');
Route::get('/jobs/export', 'JobsController@exportData')->name('exportData');
Route::get('artwork/{id}', 'JobsController@declineArtwork')->name('declineArtwork');
Route::get('artwork/accept/{id}', 'JobsController@acceptArtwork')->name('acceptArtwork');
Route::post('/comment/save/{id}', 'JobsController@saveComment')->name('saveComment');
Route::get('/jobs/list/', 'JobsController@list')->name('list');
Route::post('/other-task', 'JobsController@otherTask')->name('otherTask');
Route::post('/install-complete', 'JobsController@installComplete')->name('installComplete');
Route::post('/install-not-complete', 'JobsController@installNotComplete')->name('installNotComplete');

Route::post('/uploadFile', 'JobsController@uploadFile');
Route::get('/jobs/download/{id}/{type}', 'JobsController@download');
Route::get('/jobs/downloadOtherTaskImage/{id}', 'JobsController@downloadOtherTaskImage');
Route::get('/jobs/downloadInstallerInstallImage/{id}', 'JobsController@downloadInstallerInstallImage');
Route::get('/jobs/downloadArtworkImage/{id}', 'JobsController@downloadArtworkImage');
Route::get('/jobs/downloadArtworkPdf/{id}', 'JobsController@downloadArtworkPdf');
Route::get('/jobs/renderArtwork/{id}', 'JobsController@renderArtwork');
Route::get('/jobs/download-file/{id}', 'JobsController@downloadFile');
Route::get('/jobs/download-install-file/{id}', 'JobsController@downloadInstallFile');
Route::get('/jobs/removal-download-file/{id}', 'JobsController@removalDownloadFile');


// Artwork routes

Route::post('/artwork-template',  'JobsController@getTemplates')->name('artwork-template');

Route::post('/upload-artworkimg', 'JobsController@uploadArtworkimg')->name('upload-artworkimg');

Route::post('/upload-artworktemp', 'JobsController@uploadArtworktemp')->name('upload-artworktemp');

Route::post('/upload-artworkpdf', 'JobsController@uploadArtworkpdf')->name('upload-artworkpdf');

Route::post('/artwork-cropimg', 'JobsController@artworkCropimg')->name('artwork-cropimg');

Route::post('/update-artworktemp', 'JobsController@updateArtworktemp')->name('update-artworktemp');

Route::post('/approve-artwork', 'JobsController@approveArtwork')->name('approve-artwork');


Route::group([
    'middleware' => [
        'auth'
    ]
], function () {

    Route::get('home', 'FrontendController@index')->name('home');
    // Route::get('profile', 'FrontendController@profile')->name('profile');
    Route::get('users/{id}', [
        'as' => 'users.show',
        'uses' => 'UserController@show'
    ]);
    Route::get('users/emailConfirmation/{confirmation_code}', [
        'as' => 'users.emailConfirmation',
        'uses' => 'UserController@emailConfirmation'
    ]);
    Route::get('users/emailConfirmationResend/{hashid}', [
        'as' => 'users.emailConfirmationResend',
        'uses' => 'UserController@emailConfirmationResend'
    ]);

    Route::get('profile/{id}', [
        'as' => 'users.profile',
        'uses' => 'UserController@profile'
    ]);
    Route::get('profile/{id}/edit', [
        'as' => 'users.profileEdit',
        'uses' => 'UserController@profileEdit'
    ]);
    Route::patch('profile/{id}/edit', [
        'as' => 'users.profileUpdate',
        'uses' => 'UserController@profileUpdate'
    ]);
    Route::delete('users/userProviderDestroy', [
        'as' => 'users.userProviderDestroy',
        'uses' => 'UserController@userProviderDestroy'
    ]);
    Route::get('users/profile/changePassword/{id}', [
        'as' => 'users.changePassword',
        'uses' => 'UserController@changePassword'
    ]);
    Route::patch('users/profile/changePassword/{id}', [
        'as' => 'users.changePasswordUpdate',
        'uses' => 'UserController@changePasswordUpdate'
    ]);

    // Jobs
    Route::resource('jobs', 'JobsController');
    // Route::get('jobs/{id}/edit', ['as' => 'jobs.update', 'uses' => 'JobsController@edit']);
});
