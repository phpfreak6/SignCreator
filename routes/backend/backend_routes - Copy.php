<?php

/**
 * Backend Dashboard
 * Namespaces indicate folder structure.
 */
 
Route::get('/', 'BackendController@index')->name('home');
Route::get('dashboard', 'BackendController@index')->name('dashboard');

/*
 *
 * Settings Routes
 *
 * ---------------------------------------------------------------------
 */
Route::group([
    'middleware' => [
        'permission:edit_settings'
    ]
], function () {
    Route::get('settings', 'SettingController@index')->name('settings');
    Route::post('settings', 'SettingController@store')->name('settings.store');
});


/*
 *
 * Artwork Template Routes
 *
 * ---------------------------------------------------------------------
 */
Route::group([
    'middleware' => [
        'permission:view_artwork_template'
    ]
], function () {
    Route::get('artwork', 'ArtworkController@index')->name('artwork');
    Route::get('artwork/artwork-templates', 'ArtworkController@artwork_templates')->name('artwork.artwork-templates');
    Route::post('artwork/get-artworktemp', 'ArtworkController@get_artworktemp')->name('artwork.get_artworktemp');
    Route::post('artwork/assign-artworktemp', 'ArtworkController@assign_artworktemp')->name('artwork.assign_artworktemp');
});


/*
 *
 * Jobs Routes
 *
 * ---------------------------------------------------------------------
 */
$module_name = 'jobs';
$controller_name = 'JobsController';

Route::any("$module_name/import-jobs", [
    'as' => "$module_name.import-jobs",
    'uses' => "$controller_name@importJobs"
]);
Route::get("$module_name", [
    'as' => "$module_name.index",
    'uses' => "$controller_name@index"
]);
Route::get("$module_name/reporting", [
    'as' => "$module_name.reporting",
    'uses' => "$controller_name@reporting"
]);
Route::get("$module_name/priority", [
    'as' => "$module_name.priority",
    'uses' => "$controller_name@priority"
]);
Route::post("$module_name/setPriority", [
    'as' => "$module_name.setPriority",
    'uses' => "$controller_name@setPriority"
]);
Route::get("$module_name/testEmailTemplate", [
    'as' => "$module_name.testEmailTemplate",
    'uses' => "$controller_name@testEmailTemplate"
]);
Route::get("$module_name/create", [
    'as' => "$module_name.create",
    'uses' => "$controller_name@create"
]);
Route::get("$module_name/{id}/edit", [
    'as' => "$module_name.edit",
    'uses' => "$controller_name@edit"
]);
Route::patch("$module_name/update/{id}", [
    'as' => "$module_name.update",
    'uses' => "$controller_name@update"
]);
Route::get("$module_name/{id}", [
    'as' => "$module_name.show",
    'uses' => "$controller_name@show"
]);
Route::post("$module_name/all", [
    'as' => "$module_name.all",
    'uses' => "$controller_name@getAlljob"
]);
Route::post("$module_name/getReportingjob", [
    'as' => "$module_name.getReportingjob",
    'uses' => "$controller_name@getReportingjob"
]);
Route::post("$module_name/today", [
    'as' => "$module_name.today",
    'uses' => "$controller_name@getTodayJobs"
]);
Route::post("$module_name/get-single-job", [
    'as' => "$module_name.singlejob",
    'uses' => "$controller_name@getSinglejob"
]);

Route::post("$module_name/select-installer", [
    'as' => "$module_name.select-installer",
    'uses' => "$controller_name@selectedInstaller"
]);
Route::post("$module_name/select-removal", [
    'as' => "$module_name.select-removal",
    'uses' => "$controller_name@selectedRemoval"
]);
Route::post("$module_name/upload-artwork", [
    'as' => "$module_name.upload-artwork",
    'uses' => "$controller_name@uploadArtwork"
]);
// Route::get("$module_name/{name}/{id}", [
// 'as' => "$module_name.artworkaccept",
// 'uses' => "$controller_name@acceptArtwork"
// ]);
Route::post("$module_name/printing-done", [
    'as' => "$module_name.printing-done",
    'uses' => "$controller_name@printingDone"
]);
Route::get("$module_name/download/{id}/{type}", [
    'as' => "$module_name.download",
    'uses' => "$controller_name@download"
]);
Route::get("$module_name/downloadOtherTaskImage/{id}", [
    'as' => "$module_name.downloadOtherTaskImage",
    'uses' => "$controller_name@downloadOtherTaskImage"
]);
Route::post("$module_name/artwork-not-required", [
    'as' => "$module_name.artwork-not-required",
    'uses' => "$controller_name@artworkNotRequired"
]);
Route::post("$module_name/task-installer", [
    'as' => "$module_name.task-installer",
    'uses' => "$controller_name@taskInstaller"
]);
Route::get("$module_name/destroy/{id}", [
    'as' => "$module_name.destroy",
    'uses' => "$controller_name@destroy"
]);
Route::get("$module_name/download-file/{id}", [
    'as' => "$module_name.download-file",
    'uses' => "$controller_name@downloadFile"
]);
Route::get("$module_name/download-install-file/{id}", [
    'as' => "$module_name.download-install-file",
    'uses' => "$controller_name@downloadInstallFile"
]);
Route::get("$module_name/removal-download-file/{id}", [
    'as' => "$module_name.download-install-file",
    'uses' => "$controller_name@removalDownloadFile"
]);
Route::get("$module_name/task-download-file/{id}", [
    'as' => "$module_name.task-download-file",
    'uses' => "$controller_name@taskDownloadFile"
]);

/*
 *
 * Notification Routes
 *
 * ---------------------------------------------------------------------
 */
$module_name = 'notifications';
$controller_name = 'NotificationsController';
Route::get("$module_name", [
    'as' => "$module_name.index",
    'uses' => "$controller_name@index"
]);
Route::get("$module_name/markAllAsRead", [
    'as' => "$module_name.markAllAsRead",
    'uses' => "$controller_name@markAllAsRead"
]);
Route::get("$module_name/{id}", [
    'as' => "$module_name.show",
    'uses' => "$controller_name@show"
]);

/*
 *
 * Backup Routes
 *
 * ---------------------------------------------------------------------
 */
$module_name = 'backups';
$controller_name = 'BackupController';
Route::get("$module_name", [
    'as' => "$module_name.index",
    'uses' => "$controller_name@index"
]);
Route::get("$module_name/create", [
    'as' => "$module_name.create",
    'uses' => "$controller_name@create"
]);
Route::get("$module_name/download/{file_name}", [
    'as' => "$module_name.download",
    'uses' => "$controller_name@download"
]);
Route::get("$module_name/delete/{file_name}", [
    'as' => "$module_name.delete",
    'uses' => "$controller_name@delete"
]);

/*
 *
 * Roles Routes
 *
 * ---------------------------------------------------------------------
 */
$module_name = 'roles';
$controller_name = 'RolesController';
Route::resource("$module_name", "$controller_name");

/*
 *
 * Users Routes
 *
 * ---------------------------------------------------------------------
 */
$module_name = 'users';
$controller_name = 'UserController';
Route::get("$module_name/profile/{id}", [
    'as' => "$module_name.profile",
    'uses' => "$controller_name@profile"
]);
Route::get("$module_name/profile/{id}/edit", [
    'as' => "$module_name.profileEdit",
    'uses' => "$controller_name@profileEdit"
]);
Route::patch("$module_name/profile/{id}/edit", [
    'as' => "$module_name.profileUpdate",
    'uses' => "$controller_name@profileUpdate"
]);
Route::get("$module_name/emailConfirmation/{confirmation_code}", [
    'as' => "$module_name.emailConfirmation",
    'uses' => "$controller_name@emailConfirmation"
]);
Route::get("$module_name/emailConfirmationResend/{hashid}", [
    'as' => "$module_name.emailConfirmationResend",
    'uses' => "$controller_name@emailConfirmationResend"
]);
Route::delete("$module_name/userProviderDestroy", [
    'as' => "$module_name.userProviderDestroy",
    'uses' => "$controller_name@userProviderDestroy"
]);
Route::get("$module_name/profile/changeProfilePassword/{id}", [
    'as' => "$module_name.changeProfilePassword",
    'uses' => "$controller_name@changeProfilePassword"
]);
Route::patch("$module_name/profile/changeProfilePassword/{id}", [
    'as' => "$module_name.changeProfilePasswordUpdate",
    'uses' => "$controller_name@changeProfilePasswordUpdate"
]);
Route::get("$module_name/changePassword/{id}", [
    'as' => "$module_name.changePassword",
    'uses' => "$controller_name@changePassword"
]);
Route::patch("$module_name/changePassword/{id}", [
    'as' => "$module_name.changePasswordUpdate",
    'uses' => "$controller_name@changePasswordUpdate"
]);
Route::get("$module_name/trashed", [
    'as' => "$module_name.trashed",
    'uses' => "$controller_name@trashed"
]);
Route::patch("$module_name/trashed/{id}", [
    'as' => "$module_name.restore",
    'uses' => "$controller_name@restore"
]);
Route::get("$module_name/index_data", [
    'as' => "$module_name.index_data",
    'uses' => "$controller_name@index_data"
]);
Route::get("$module_name/index_list", [
    'as' => "$module_name.index_list",
    'uses' => "$controller_name@index_list"
]);
Route::resource("$module_name", "$controller_name");
Route::patch("$module_name/{id}/block", [
    'as' => "$module_name.block",
    'uses' => "$controller_name@block",
    'middleware' => [
        'permission:block_users'
    ]
]);
Route::patch("$module_name/{id}/unblock", [
    'as' => "$module_name.unblock",
    'uses' => "$controller_name@unblock",
    'middleware' => [
        'permission:block_users'
    ]
]);
