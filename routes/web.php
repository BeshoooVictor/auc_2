<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**************************************** Auth *****************************************/
/* LOGIN ROUTES */
Route::get('/', 'Auth\LoginController@showLoginForm')->name('/');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('postLogin');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::group(
  ['middleware' => 'auth', 'namespace' => 'Admin'],
  function () {
    // home page for all the users
    Route::get(
      '/home',
      function () {
        return view('admin.dashboard');
      }
    )->name('dashboard');


    Route::group(
      ['prefix' => 'location'],
      function () {
        Route::get('cities', ['uses' => 'CityController@index', 'as' => 'cities.index']);
        Route::get('cities/list', ['uses' => 'CityController@list', 'as' => 'cities.list']);
        Route::get('cities/create', ['uses' => 'CityController@create', 'as' => 'cities.create']);
        Route::get('cities/{city}/edit', ['uses' => 'CityController@edit', 'as' => 'cities.edit']);
        Route::post('cities', ['uses' => 'CityController@store', 'as' => 'cities.store']);
        Route::patch('cities/{city}', ['uses' => 'CityController@update', 'as' => 'cities.update']);
        Route::delete('cities/{city}', ['uses' => 'CityController@destroy', 'as' => 'cities.destroy']);

        Route::get('countries', ['uses' => 'CountryController@index', 'as' => 'countries.index']);
        Route::get('countries/list', ['uses' => 'CountryController@list', 'as' => 'countries.list']);
        Route::view('countries/create', 'admin.rk-admin.countries.create')->name('countries.create');
        Route::get('countries/{country}/edit', ['uses' => 'CountryController@edit', 'as' => 'countries.edit']);
        Route::post('countries', ['uses' => 'CountryController@store', 'as' => 'countries.store']);
        Route::patch('countries/{country}', ['uses' => 'CountryController@update', 'as' => 'countries.update']);
        Route::delete('countries/{country}', ['uses' => 'CountryController@destroy', 'as' => 'countries.destroy']);
      }
    );

    // speciality
    Route::get('specialities', ['uses' => 'SpecialityController@index', 'as' => 'specialities.index']);
    Route::get('specialities/list', ['uses' => 'SpecialityController@list', 'as' => 'specialities.list']);
    Route::get('specialities/{speciality}/clinics/featured',['uses' => 'SpecialityController@getFeaturedClinics', 'as' => 'specialities.get-featured']);
    Route::post('specialities/clinics/featured',['uses' => 'SpecialityController@postFeaturedClinics', 'as' => 'specialities.post-featured']);
    Route::view('specialities/create', 'admin.rk-admin.specialities.create')->name('specialities.create');
    Route::get('specialities/{speciality}/edit', ['uses' => 'SpecialityController@edit', 'as' => 'specialities.edit']);
    Route::post('specialities', ['uses' => 'SpecialityController@store', 'as' => 'specialities.store']);
    Route::patch('specialities/{speciality}', ['uses' => 'SpecialityController@update', 'as' => 'specialities.update']);
    Route::delete(
      'specialities/{speciality}',
      ['uses' => 'SpecialityController@destroy', 'as' => 'specialities.destroy']
    );

    // services
    Route::get('services', ['uses' => 'ServiceController@index', 'as' => 'services.index']);
    Route::get('services/list', ['uses' => 'ServiceController@list', 'as' => 'services.list']);
    Route::view('services/create', 'admin.rk-admin.services.create')->name('services.create');
    Route::get('services/{service}/edit', ['uses' => 'ServiceController@edit', 'as' => 'services.edit']);
    Route::post('services', ['uses' => 'ServiceController@store', 'as' => 'services.store']);
    Route::patch('services/{service}', ['uses' => 'ServiceController@update', 'as' => 'services.update']);
    Route::delete('services/{service}', ['uses' => 'ServiceController@destroy', 'as' => 'services.destroy']);

    // packages
    Route::get('packages', ['uses' => 'PackageController@index', 'as' => 'packages.index']);
    Route::get('packages/list', ['uses' => 'PackageController@list', 'as' => 'packages.list']);
    Route::view('packages/create', 'admin.rk-admin.packages.create')->name('packages.create');
    Route::get('packages/{package}/edit', ['uses' => 'PackageController@edit', 'as' => 'packages.edit']);
    Route::post('packages', ['uses' => 'PackageController@store', 'as' => 'packages.store']);
    Route::patch('packages/{package}', ['uses' => 'PackageController@update', 'as' => 'packages.update']);
    Route::delete('packages/{package}', ['uses' => 'PackageController@destroy', 'as' => 'packages.destroy']);

    // clinics
    Route::get('clinics', ['uses' => 'ClinicController@index', 'as' => 'clinics.index']);
    Route::get('clinics/list', ['uses' => 'ClinicController@list', 'as' => 'clinics.list']);
    Route::view('clinics/create', 'admin.rk-admin.clinics.create')->name('clinics.create');
    Route::get('clinics/{clinic}/edit', ['uses' => 'ClinicController@edit', 'as' => 'clinics.edit']);
    Route::post('clinics', ['uses' => 'ClinicController@store', 'as' => 'clinics.store']);
    Route::patch('clinics/{clinic}', ['uses' => 'ClinicController@update', 'as' => 'clinics.update']);
    Route::delete('clinics/{clinic}', ['uses' => 'ClinicController@destroy', 'as' => 'clinics.destroy']);

    Route::get('banks', ['uses' => 'BankController@index', 'as' => 'banks.index']);
    Route::get('banks/list', ['uses' => 'BankController@list', 'as' => 'banks.list']);
    Route::get('banks/create', ['uses' => 'BankController@create', 'as' => 'banks.create']);
    Route::get('banks/{bank}/edit', ['uses' => 'BankController@edit', 'as' => 'banks.edit']);
    Route::post('banks', ['uses' => 'BankController@store', 'as' => 'banks.store']);
    Route::patch('banks/{bank}', ['uses' => 'BankController@update', 'as' => 'banks.update']);
    Route::delete('banks/{bank}', ['uses' => 'BankController@destroy', 'as' => 'banks.destroy']);


    Route::group(
      ['prefix' => 'clinics'],
      function () {
        Route::get('{clinic}/gallery', ['uses' => 'GalleryController@index', 'as' => 'gallery.index']);
        Route::get('{clinic}/gallery/list', ['uses' => 'GalleryController@list', 'as' => 'gallery.list']);
        Route::get('{clinic}/gallery/create', ['uses' => 'GalleryController@create', 'as' => 'gallery.create']);
        Route::post('gallery', ['uses' => 'GalleryController@store', 'as' => 'gallery.store']);
        Route::delete('gallery/{gallery}', ['uses' => 'GalleryController@destroy', 'as' => 'gallery.destroy']);

        Route::get('/clinic-of-week', ['uses' => 'ClinicController@getClinicOfWeek', 'as' => 'clinics.get-special']);
        Route::post('/clinic-of-week', ['uses' => 'ClinicController@postClinicOfWeek', 'as' => 'clinics.post-special']);
        Route::get(
          '/select-services/{speciality}',
          ['uses' => 'ClinicController@getServicesBySpeciality', 'as' => 'clinics.services-by-speciality']
        );
      }
    );


    Route::get('plans', ['uses' => 'InstallmentPlanController@index', 'as' => 'plans.index']);
    Route::get('plans/list', ['uses' => 'InstallmentPlanController@list', 'as' => 'plans.list']);
    Route::post('plans', ['uses' => 'InstallmentPlanController@store', 'as' => 'plans.store']);
    Route::view('plans/create', 'admin.rk-admin.installment-plans.create')->name('plans.create');
    Route::delete('plans/{plan}', ['uses' => 'InstallmentPlanController@destroy', 'as' => 'plans.destroy']);


    Route::get(
      'mobile-translations',
      ['uses' => 'MobileTranslationController@index', 'as' => 'mobile-translation.index']
    );
    Route::get(
      'mobile-translations/list',
      ['uses' => 'MobileTranslationController@list', 'as' => 'mobile-translation.list']
    );
    Route::post(
      'mobile-translations',
      ['uses' => 'MobileTranslationController@store', 'as' => 'mobile-translation.store']
    );
    Route::get(
      'mobile-translations/{mobileTranslation}/edit',
      ['uses' => 'MobileTranslationController@edit', 'as' => 'mobile-translation.edit']
    );
    Route::patch(
      'mobile-translations/{mobileTranslation}',
      ['uses' => 'MobileTranslationController@update', 'as' => 'mobile-translation.update']
    );
    Route::view('mobile-translations/create', 'admin.rk-admin.mobile-translations.create')->name(
      'mobile-translation.create'
    );
    Route::delete(
      'mobile-translations/{mobileTranslation}',
      ['uses' => 'MobileTranslationController@destroy', 'as' => 'mobile-translation.destroy']
    );


    // users
    Route::get('users', ['uses' => 'UserController@index', 'as' => 'users.index']);
    Route::get('users/list', ['uses' => 'UserController@list', 'as' => 'users.list']);
    Route::get('users/{user}/view', ['uses' => 'UserController@view', 'as' => 'users.view']);
    Route::delete('users/{user}', ['uses' => 'UserController@destroy', 'as' => 'users.destroy']);
    Route::get('users/{user}/{type}', ['uses' => 'UserController@deleteUserDocument', 'as' => 'users.delete_document']);
    Route::post('users/change-status', ['uses' => 'UserController@changeStatus', 'as' => 'users.change-status']);
    Route::view('users/create', 'admin.rk-admin.users.create')->name('users.create');
    Route::post('users', ['uses' => 'UserController@store', 'as' => 'users.store']);
    Route::get(
      'users/installment/{user}/create',
      ['uses' => 'UserController@createInstallment', 'as' => 'users.create_installment']
    );
    Route::post('users/installment/', ['uses' => 'UserController@storeInstallment', 'as' => 'users.store_installment']);
    Route::post(
      'installment/calculate-price',
      ['uses' => 'UserController@calculatePrice', 'as' => 'users.installment.calculate']
    );


    Route::group(
      ['prefix' => 'payment'],
      function () {
        Route::get('v-cash', ['uses' => 'VCashController@index', 'as' => 'v_cash.index']);
        Route::get('v-cash/list', ['uses' => 'VCashController@list', 'as' => 'v_cash.list']);
        Route::post('v-cash', ['uses' => 'VCashController@store', 'as' => 'v_cash.store']);
        Route::view('v-cash/create', 'admin.rk-admin.v-cash.create')->name('v_cash.create');
        Route::get('v-cash/{vcash}/edit', ['uses' => 'VCashController@edit', 'as' => 'v_cash.edit']);
        Route::patch('v-cash/{vcash}', ['uses' => 'VCashController@update', 'as' => 'v_cash.update']);
        Route::delete('v-cash/{vcash}', ['uses' => 'VCashController@destroy', 'as' => 'v_cash.destroy']);

        Route::get('bank-account', ['uses' => 'BankAccountController@index', 'as' => 'bank_account.index']);
        Route::get('bank-account/list', ['uses' => 'BankAccountController@list', 'as' => 'bank_account.list']);
        Route::post('bank-account', ['uses' => 'BankAccountController@store', 'as' => 'bank_account.store']);
        Route::view('bank-account/create', 'admin.rk-admin.bank-account.create')->name('bank_account.create');
        Route::get(
          'bank-account/{account}/edit',
          ['uses' => 'BankAccountController@edit', 'as' => 'bank_account.edit']
        );
        Route::patch(
          'bank-account/{account}',
          ['uses' => 'BankAccountController@update', 'as' => 'bank_account.update']
        );
        Route::delete(
          'bank-account/{account}',
          ['uses' => 'BankAccountController@destroy', 'as' => 'bank_account.destroy']
        );
      }
    );

    Route::get('installment', ['uses' => 'UserInstallmentController@index', 'as' => 'user_installment.index']);
    Route::get('installment/list', ['uses' => 'UserInstallmentController@list', 'as' => 'user_installment.list']);
    Route::post(
      'installment/{installment}/approve',
      ['uses' => 'UserInstallmentController@approve', 'as' => 'user_installment.approve']
    );
    Route::get(
      'installment/{installment}/reject',
      ['uses' => 'UserInstallmentController@reject', 'as' => 'user_installment.reject']
    );
    Route::get(
      'installment/{installment}/view',
      ['uses' => 'UserInstallmentController@view', 'as' => 'user_installment.view']
    );


    Route::get('patients', ['uses' => 'ClinicPatientsController@index', 'as' => 'patients.index']);
    Route::get('patients/list', ['uses' => 'ClinicPatientsController@list', 'as' => 'patients.list']);
    Route::get('patients/{patientId}/view', ['uses' => 'ClinicPatientsController@view', 'as' => 'patients.view']);
    Route::post('patients/{patientId}/update', ['uses' => 'ClinicPatientsController@update', 'as' => 'patients.update']);


    // send push notification
    Route::get(
      'notification/send',
      ['uses' => 'NotificationController@notificationsForm', 'as' => 'notification.form']
    );
    Route::post(
      'notification/submit',
      ['uses' => 'NotificationController@sendNotification', 'as' => 'notification.submit']
    );
  }
);
