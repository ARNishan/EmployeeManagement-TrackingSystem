<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for  your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web"  middleware group. Now create something great!
|
*/
// Route::get('/login', function () { 
//     return redirect()->route('home');
// });
Route::get('/', function () { 
    return redirect('/admin');
});
// Route::get('/','AuthController@index')->name('login')->middleware('guest');
Route::get('/admin','LoginController@indexAdmin')->name('admin')->middleware('guest:admin');
Route::get('/user', 'LoginController@indexUser')->name('user')->middleware('guest');



// Auth::routes();
// Route::get('/admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
//         Route::post('/login', 'Admin\LoginController@login')->name('admin.authenticate');
//         Route::get('/admin-logout', 'Admin\LoginController@logout')->name('admin.logout');

        // Registration Routes...
        // if ($options['register'] ?? true) {
        //     $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        //     $this->post('register', 'Auth\RegisterController@register');
        // }

        // Password Reset Routes...
        // if ($options['reset'] ?? true) {
        //     Route::resetPassword();
        // }

        // Email Verification Routes...
        // if ($options['verify'] ?? false) {
        //     Route::emailVerification();
        // }

//password reset Admin
Route::get('admin-password-reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password-email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('/admin-password-reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin-password-reset', 'Admin\ResetPasswordController@reset')->name('admin.password.update');

//password reset User 
Route::get('user-password-reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('user-password-email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
Route::get('/user-password-reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('user-password-reset', 'Auth\ResetPasswordController@reset')->name('password.update');






// Route::get('/home', 'HomeController@index')->name('home');
//Authenticate a admin
Route::post('/admin-authenticate','LoginController@AdminAuthenticate')->name('admin.authenticate')->middleware('guest:admin');
Route::get('/admin-dashboard','AdminDashboardController@index')->name('admin.dashboard');
//Authenticate a user
Route::post('/user-authenticate','LoginController@UserAuthenticate')->name('user.authenticate')->middleware('guest');
Route::get('/user-dashboard','UserDashboardController@index')->name('user.dashboard');
//logout the user
Route::get('/user-logout','AuthController@logout')->name('user.logout');
//show user details
Route::get('/user-show','AuthController@show')->name('user.auth.show');
//logout the Admin
Route::get('/admin-logout','AdminController@logout')->name('admin.logout');
//show Admin details
Route::get('/admin-show','AdminController@show')->name('admin.auth.show');
//employee
Route::get('/employees','EmployeesController@index')->name('employees');
Route::post('employees/search','EmployeesController@search')->name('employees.search');
Route::get('/employees-create','EmployeesController@create')->name('employees.create');
Route::post('/employees-store','EmployeesController@store')->name('employees.store');
Route::get('/employees-show/{id}','EmployeesController@show');
Route::get('/delete-employee/{id}','EmployeesController@destroy');
Route::get('/edit-employee/{id}','EmployeesController@edit');
Route::post('/update-employee/{id}','EmployeesController@update');

// Department route are here
Route::get('/departments','DepartmentsController@index')->name('departments');
Route::post('/departments/search','DepartmentsController@search')->name('departments.search');
Route::get('/departments-edit/{id}','DepartmentsController@edit');
Route::get('/departments-destroy/{id}','DepartmentsController@destroy');
Route::post('/department-update/{id}','DepartmentsController@update');
Route::get('/department-create','DepartmentsController@create')->name('departments.create');
Route::post('/departments-store','DepartmentsController@store')->name('departments.store');

//salaries route are here
Route::get('/salaries','SalariesController@index')->name('salaries');
Route::post('/salaries-search','SalariesController@search')->name('salaries.search');
Route::get('/salaries-create','SalariesController@create')->name('salaries.create');
Route::post('/salaries-store','SalariesController@store')->name('salaries.store');
Route::get('/salaries-edit/{id}','SalariesController@edit');
Route::post('/salaries-update/{id}','SalariesController@update');
Route::get('/salaries-destroy/{id}','SalariesController@destroy');

//Division Route are Here
Route::get('/divisions','DivisionsController@index')->name('divisions');
Route::post('/divisions-search','DivisionsController@search')->name('divisions.search');
Route::get('/divisions-create','DivisionsController@create')->name('divisions.create');
Route::post('/divisions-store','DivisionsController@store')->name('divisions.store');
Route::get('/divisions-edit/{id}','DivisionsController@edit');
Route::post('/divisions-update/{id}','DivisionsController@update');
Route::get('/divisions-destroy/{id}','DivisionsController@destroy');

//City Route are Here
Route::get('/cities','CitiesController@index')->name('cities');
Route::post('/cities-search','CitiesController@search')->name('cities.search');
Route::get('/cities-create','CitiesController@create')->name('cities.create');
Route::post('/cities-store','CitiesController@store')->name('cities.store');
Route::get('/cities-edit/{id}','CitiesController@edit');
Route::post('/cities-update/{id}','CitiesController@update');
Route::get('/cities-destroy/{id}','CitiesController@destroy');

//State Route are Here
Route::get('/states','StatesController@index')->name('states');
Route::post('/states-search','StatesController@search')->name('states.search');
Route::get('/states-create','StatesController@create')->name('states.create');
Route::post('/states-store','StatesController@store')->name('states.store');
Route::get('/states-edit/{id}','StatesController@edit');
Route::post('/states-update/{id}','StatesController@update');
Route::get('/states-destroy/{id}','StatesController@destroy');

//Country Route are Here
Route::get('/countries','CountriesController@index')->name('countries');
Route::post('/countries-search','CountriesController@search')->name('countries.search');
Route::get('/countries-create','CountriesController@create')->name('countries.create');
Route::post('/countries-store','CountriesController@store')->name('countries.store');
Route::get('/countries-edit/{id}','CountriesController@edit');
Route::post('/countries-update/{id}','CountriesController@update');
Route::get('/countries-destroy/{id}','CountriesController@destroy');

//Reports Route are Here
Route::get('/reports','ReportsController@index')->name('reports');
//Generate PDF
Route::post('/reports-pdf','ReportsController@makeReport')->name('reports.make');
//User route are here
Route::get('/users','UserController@index')->name('users');
Route::post('/users-search','UserController@search')->name('users.search');
Route::get('/users-create','UserController@create')->name('users.create');
Route::post('/users-store','UserController@store')->name('users.store');
Route::get('/users-destroy/{id}','UserController@destroy');

//Attendence route are  here
Route::get('/attendences','AttendeceController@AllAttendence')->name('attendences');
Route::post('/attendence-search','AttendeceController@search')->name('attendence.search');
Route::get('/attendences-show/{att_date}','AttendeceController@ViewAttendence');

//Messenger Route are here
Route::get('/user-messenger','MessageController@index')->name('user.messenger');
Route::get('/admin-messenger','AdminMessageController@adminindex')->name('admin.messenger');
//FOR GROUP CHAT
Route::get('messages','MessageController@fetchMessages');
Route::post('messages','MessageController@sendMessages');
//FOR GROUP CHAT ADMIN
Route::get('adminmessages','AdminMessageController@fetchMessages');
Route::post('adminmessages','AdminMessageController@sendMessages');