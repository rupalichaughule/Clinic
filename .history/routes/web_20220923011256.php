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


Route::GET('/admin/adduser', 'admin\UserController@adduser');

Route::POST('/changepassword', 'admin\HomeController@changeuserpassword');

Route::GET('/inactivestatus/{id}', 'admin\AdminController@inactivestatus');
Route::GET('/activestatus/{id}', 'admin\AdminController@activestatus');

//Listings
Route::GET('/admin/addlisting', 'admin\ListingController@addlisting');
Route::POST('/admin/savelisting', 'admin\ListingController@savelisting');
Route::GET('/admin/listings', 'admin\ListingController@listings');
Route::GET('/admin/listing/{id}', 'admin\ListingController@listing');
Route::GET('/admin/editlisting/{id}', 'admin\ListingController@editlisting');
Route::POST('/admin/updatelisting/{id}', 'admin\ListingController@updatelisting');
Route::GET('/admin/deletelisting/{id}', 'admin\ListingController@deletelisting');
Route::GET('/admin/listinginactivestatus/{id}', 'admin\ListingController@listinginactivestatus');
Route::GET('/admin/listingactivestatus/{id}', 'admin\ListingController@listingactivestatus');


//Categories
Route::GET('/admin/categories', 'admin\CategoryController@categories');
Route::POST('/admin/savecategory', 'admin\CategoryController@savecategory');
Route::POST('/admin/updatecategory/{id}', 'admin\CategoryController@updatecategory');
Route::GET('/admin/deletecategory/{id}', 'admin\CategoryController@deletecategory');


//Banner
Route::GET('/admin/addbanner', 'admin\BannerController@addbanner');
Route::GET('/admin/banners', 'admin\BannerController@banners');
Route::GET('/admin/editbanner/{id}', 'admin\BannerController@banneredit');
Route::POST('/admin/savebanner', 'admin\BannerController@savebanner');
Route::POST('/admin/updatebanner/{id}', 'admin\BannerController@updatebanner');
Route::GET('/admin/deletebanner/{id}', 'admin\BannerController@deletebanner');

Route::GET('/admin/websitesettings', 'admin\AdminController@websitesettings');
Route::POST('/admin/updatewebsitesettings', 'admin\AdminController@updatewebsitesettings');

//Ads
Route::GET('/admin/addad', 'admin\AdController@addad');
Route::GET('/admin/ads', 'admin\AdController@ads');
Route::GET('/admin/editad/{id}', 'admin\AdController@adedit');
Route::POST('/admin/savead', 'admin\AdController@savead');
Route::POST('/admin/updatead/{id}', 'admin\AdController@updatead');
Route::GET('/admin/deletead/{id}', 'admin\AdController@deletead');

// packges
Route::GET('/admin/addpackage', 'admin\PackageController@addpackage');
Route::POST('/admin/savepackage', 'admin\PackageController@savepackage');
Route::GET('/admin/packages', 'admin\PackageController@packages');
Route::GET('/admin/editpackage/{id}', 'admin\PackageController@editpackage');
Route::POST('/admin/updatepackage/{id}', 'admin\PackageController@updatepackage');
Route::GET('/admin/deletepackage/{id}', 'admin\PackageController@deletepackage');

//Vehicle Types
Route::GET('/admin/vehicletypes', 'admin\VehicleController@vehicletypes');
Route::POST('/admin/savevehicletype', 'admin\VehicleController@savevehicletype');
Route::POST('/admin/updatevehicletype/{id}', 'admin\VehicleController@updatevehicletype');
Route::GET('/admin/deletevehicletype/{id}', 'admin\VehicleController@deletevehicletype');

//Source
Route::GET('/admin/sources', 'admin\LocationController@sources');
Route::POST('/admin/savesource', 'admin\LocationController@savesource');
Route::POST('/admin/updatesource/{id}', 'admin\LocationController@updatesource');
Route::GET('/admin/deletesource/{id}', 'admin\LocationController@deletesource');

//Destination
Route::GET('/admin/destinations', 'admin\LocationController@destinations');
Route::POST('/admin/savedestination', 'admin\LocationController@savedestination');
Route::POST('/admin/updatedestination/{id}', 'admin\LocationController@updatedestination');
Route::GET('/admin/deletedestination/{id}', 'admin\LocationController@deletedestination');

//Source
Route::GET('/admin/purchases', 'admin\UserController@purchases');