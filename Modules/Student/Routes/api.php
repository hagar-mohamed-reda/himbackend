<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your Student. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api_auth'], function () {
    Route::prefix('')->group(function () {

        // servicecs routes
        Route::get('students', 'StudentController@index');
        Route::get('students/{id}', 'StudentController@get');
        Route::post('students/store', 'StudentController@store');
        Route::post('students/update/{resourcc}', 'StudentController@update');
        Route::post('students/delete/{resourcc}', 'StudentController@destroy');

        Route::post('students/enroll/{id}', 'StudentController@saveToStudents');

        //theater
        Route::post('theaters/store', 'StudentController@storeTheater');
        Route::post('theaters/edit', 'StudentController@editTheater');
        Route::post('theaters/delete', 'StudentController@deleteTheater');

        //commission
        Route::post('commissions/store', 'StudentController@storeCommission');
        Route::post('commissions/edit', 'StudentController@editCommission');
        Route::post('commissions/delete', 'StudentController@deleteCommission');

        //students distributions
        Route::post('student_distributions/store', 'StudentController@storeStudentDistributions');
        Route::post('student_distributions_on_private/store', 'StudentController@storeStudentDistributionsOnPrivate');



        Route::post('students/set_numbers', 'StudentController@setNumbers');
        //new
        Route::post('students/set_numbers_null', 'StudentController@setNumbersNull');
        Route::get('students/get_commission_students', 'StudentController@getCommissionStudents');
        Route::get('students/get_all_commission_students', 'StudentController@getAllCommissionStudents');
        Route::post('students/get_students_setnumbers', 'StudentController@getStudentsSetnumbers');
        Route::post('students/store_student_set_number', 'StudentController@storeStudentSetNumber');
        Route::post('students/set_numbers_null', 'StudentController@setNumbersNull');

        // case constraints 
        Route::post('students/case_constraints/store', 'StudentController@storeCaseConstraints');

        // student excuses routes
        Route::get('student/student_excuses', 'StudentExcusesController@index');
        Route::post('student/student_excuses/store', 'StudentExcusesController@store');
        Route::post('student/student_excuses/update/{student_excuse}', 'StudentExcusesController@update');
        Route::post('student/student_excuses/delete/{student_excuse}', 'StudentExcusesController@destroy');





        Route::get('affair/report1', 'ReportController@report1');
        Route::get('affair/report2', 'ReportController@report2');
        Route::get('affair/report3', 'ReportController@report3');
        Route::get('affair/report4', 'ReportController@report4');
        Route::get('affair/report5', 'ReportController@report5');
        Route::get('affair/report6', 'ReportController@report6');
        Route::get('affair/report7', 'ReportController@report7');
        Route::get('affair/report8', 'ReportController@report8');
        Route::get('affair/report9', 'ReportController@report9');
        Route::get('affair/report11', 'ReportController@report11');
        Route::get('affair/report13', 'ReportController@report13');
        Route::get('affair/report15', 'ReportController@report15');
        Route::get('affair/report16', 'ReportController@report16');
        Route::get('affair/report17', 'ReportController@report17');
        Route::get('affair/report18', 'ReportController@report18');
        Route::get('affair/report19', 'ReportController@report19');
        Route::get('affair/report20', 'ReportController@report20');
        Route::get('affair/report21', 'ReportController@report21');
        Route::get('affair/report22', 'ReportController@report22');
        Route::get('affair/report23', 'ReportController@report23');
        Route::get('affair/report24', 'ReportController@report24');

        // this route was moved to the academic module
        // Route::get('affair/report25', 'ReportController@report25');
        Route::get('affair/report26', 'ReportController@report26');
        Route::get('affair/report27', 'ReportController@report27');

        Route::get('affair/get-result-advertsment', 'ReportController@getResultAdvertsment');
        Route::get('affair/get-result-advertsment-show', 'ReportController@getResultAdvertsmentShow');
        Route::get('affair/get-result-statistics', 'ReportController@getResultStatistics');
        Route::get('affair/get-courses-statistics', 'ReportController@getCoursesStatistics');
        Route::get('affair/get-result-absence', 'ReportController@getResultAbsence');
        Route::get('affair/prerequsite','ReportController@coursePrequests');

        ///////////////////////////////////  Sync Apis  //////////////////////////////////
        Route::get('sync/students', 'StudentController@syncStudents');


        ///////////////////////////////////  Sync Apis  //////////////////////////////////
        Route::get('sync/students', 'StudentController@syncStudents');
    });
});
