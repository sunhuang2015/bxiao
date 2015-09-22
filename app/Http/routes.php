<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Company;
Route::get('/home', function () {
    return view('welcome');
});

// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::resource('upload','UploadController');

Route::resource('employee','EmployeeController');

Route::get('report/{month?}','ReportController@index')->where('month', '(\d)(\d)(\d)(\d)-[0-1]?[1-9]-[0-3]?[1-9]');;
//Route::get('report/{month?}','ReportController@index');
Route::resource('report','ReportController');

Route::get('export',function(){

    Excel::create('Filename', function($excel) {

        // Call writer methods here
        $excel->setTitle('Our new awesome title');

        // Chain the setters
        $excel->setCreator('Maatwebsite')
            ->setCompany('Maatwebsite');

        // Call them separately
        $excel->setDescription('A demonstration to change the file properties');

        $companys=Company::all();
        foreach($companys as $company)
        {
            $this->company_name=$company->name;
            $this->company_id=$company->id;
            $excel->sheet($this->company_name, function($sheet) {

                $employees=\App\Reportview::where('公司',$this->company_name)->get()->toArray();
                $sum=\App\Reportview::sum('费用');
                dd($sum);
                $sheet->with($employees);

            });
        }



    })->export('xlsx');
});