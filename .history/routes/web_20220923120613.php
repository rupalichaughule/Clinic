<?php

use Illuminate\Support\Facades\Route;

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

//Homepage
Route::GET('/', 'webapp\HomeController@index');
Route::GET('/index', 'webapp\HomeController@index');

//Appointment
Route::GET('/appointment', 'webapp\HomeController@appointment');
Route::POST('/saveappointment', 'webapp\UserController@saveappointment');

// Doctor & Patient Registration
Route::GET('/register', 'webapp\HomeController@register');
Route::POST('/saveuser', 'webapp\UserController@saveuser');


Route::GET('/login', 'webapp\HomeController@login');


Route::GET('/change-password', 'webapp\HomeController@changepassword');
Route::GET('/reset-password', 'webapp\HomeController@resetpassword');
Route::POST('/changeuserpassword', 'webapp\HomeController@changeuserpassword');

Route::GET('/logout', 'webapp\HomeController@logout');

//Login
Route::GET('/login', 'admin\LoginController@login');
Route::GET('/admin/login', 'admin\LoginController@login');
Route::POST('/checklogin', 'admin\LoginController@checklogin');
Route::GET('/dashboard', 'admin\HomeController@dashboard');
Route::GET('/admin/contacts', 'admin\AdminController@contacts');

//doctors
Route::GET('/doctors', 'admin\DoctorController@doctors');
Route::GET('/adddoctor', 'admin\DoctorController@adddoctor');
Route::POST('/savedoctor', 'admin\DoctorController@savedoctor');
Route::GET('/editdoctor/{id}', 'admin\DoctorController@editdoctor');
Route::POST('/updatedoctor/{id}', 'admin\DoctorController@updatedoctor');
Route::GET('/deletedoctor/{id}', 'admin\DoctorController@deletedoctor');


//patients
Route::GET('/patients', 'admin\PatientController@patients');
Route::GET('/addpatient', 'admin\PatientController@addpatient');
Route::POST('/savepatient', 'admin\PatientController@savepatient');
Route::GET('/editpatient/{id}', 'admin\PatientController@editpatient');
Route::POST('/updatepatient/{id}', 'admin\PatientController@updatepatient');
Route::GET('/deletepatient/{id}', 'admin\PatientController@deletepatient');

//Appointment
Route::GET('/appointments', 'admin\AppointmentController@appointments');
Route::GET('/addappointment', 'admin\AppointmentController@addappointment');
Route::POST('/saveappointment', 'admin\AppointmentController@saveappointment');
Route::GET('/editappointment/{id}', 'admin\AppointmentController@editappointment');
Route::POST('/updateappointment/{id}', 'admin\AppointmentController@updateappointment');
Route::GET('/deleteappointment/{id}', 'admin\AppointmentController@deleteappointment');

Route::GET('/inactiveappointmentstatus/{id}', 'admin\AppointmentController@inactiveappointmentstatus');
Route::GET('/activeappointmentstatus/{id}', 'admin\AppointmentController@activestatus');


Route::POST('/changepassword', 'admin\HomeController@changeuserpassword');

Route::GET('/inactivestatus/{id}', 'admin\AdminController@inactivestatus');
Route::GET('/activestatus/{id}', 'admin\AdminController@activestatus');
