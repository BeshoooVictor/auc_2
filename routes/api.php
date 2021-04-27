<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Splash
 */

Route::group(
  ['namespace' => 'Api'],
  function () {
    Route::get('/test', 'ServiceController@getStartDateOfInstallment');

    Route::get('/splash', 'HomeController@splash');
    Route::get('/home', 'HomeController@home');
    // Route::get('/getUserStatus', 'HomeController@getUserStatus');

    // list of notifications
    Route::get('notifications', 'HomeController@notificationList');
    Route::post('set-token', 'HomeController@setToken');

    Route::get('user/status', 'HomeController@getUserStatus');

    Route::group(
      ['prefix' => 'payment'],
      function () {
        Route::get('/home', 'PaymentController@home');
        Route::get('/transactions', 'PaymentController@transactions');
        Route::patch('/pay', 'PaymentController@pay');
      }
    );

    Route::group(
      ['prefix' => 'services'],
      function () {
        Route::get('/', 'ServiceController@services');
        Route::get('/{id}', 'ServiceController@getServiceDetails');
        Route::post('/request', 'ServiceController@ClinicRequestService');
        Route::post('/confirm', 'ServiceController@patientConfirmService');
      }
    );

    Route::group(
      ['prefix' => 'clinic'],
      function () {
        Route::get('/', 'ClinicController@home');
        Route::get('/all', 'ClinicController@all');
        Route::get('/{id}', 'ClinicController@getClinic');
      }
    );
    ////////////Auth////////////////////////////

    ////////////Auth Patient //////////////////
    Route::group(
      ['prefix' => 'auth'],
      function () {
        Route::post('/register', 'AuthController@signup');
        Route::post('/login', 'AuthController@singIn');
        Route::post('/upload_files', 'AuthController@uploadFiles');
      }
    );
    ///////////////////////////////////////////



    ///////////////////////////////////////////////


     //////////Clinic-app//////////////////////////
    Route::group(
      ['prefix' => 'clinic-app', 'namespace' => 'Clinic'],
      function () {
        Route::get('/splash', 'HomeController@splash');
    /////////////////////////////////////////////////////
      ///////// Auth Clinic///////////////////////
    Route::group(
      ['prefix' => 'auth'],
      function () {
        Route::post('/sign-up-doctor' , 'AuthController@registerDoctor');
        Route::post('/login', 'AuthController@singIn');
        Route::post('/forget-password', 'AuthController@forgetPassword');
        Route::post('/reset-password', 'AuthController@resetPassword');
      }
    );
    ///////////////////////////////////////////////


        ///////////// ClinicPatient/////////////

        Route::group(
          ['prefix' => 'patients'],
          function () {
            Route::get('/', 'ClinicPatientsController@index');
            Route::post('/add', 'ClinicPatientsController@createPatient');
          }
        );
        /////////////////////////////////////////



        ////////clinicController////////////////
        Route::group(
          ['prefix' => 'clinic'],
          function () {
            Route::get('{clinicId}/work', 'ClinicController@getClinicWork');
            Route::post('{clinicId}/work/add', 'ClinicController@addClinicWork');
            Route::get('{clinicId}/services', 'ClinicController@getClinicServices');
            Route::get('{clinicId}/services/all', 'ClinicController@getClinicSpecialityAllServices');
            Route::post('{clinicId}/services/add', 'ClinicController@addClinicService');
            Route::put('{clinicId}/services/{clinicServiceId}/edit', 'ClinicController@editClinicService');
          }
        );
        /////////////////////////////////////////////


        Route::post('bank/update', 'HomeController@updateClinicBank');

        Route::get('notifications', 'HomeController@notificationList');
        Route::post('set-token', 'HomeController@setToken');
      }
    );
  }
);
