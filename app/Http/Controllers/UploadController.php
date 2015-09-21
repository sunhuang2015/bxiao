<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Validator;
use App\Company;
use App\Department;
use App\Level;
use App\Category;
use App\Status;
use App\Employee;
class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('upload.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $excel=collect([
            "application/vnd.ms-excel",
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            ]);
        $data=$request->except(['_method','_token']);
        if(!$request->hasFile('uploadFile')){
            return back();
        }

        $mineType=$request->file('uploadFile')->getClientMimeType();

        if(!$excel->contains($mineType)){
            return back();
        }
        $category=$request->get('category');
        $ext=$request->file('uploadFile')->getClientOriginalExtension();
        $filename=$category.Carbon::now()->timestamp.".".$ext;
        $path=base_path()."/public/up/";
        $dest_file= $path."/".$filename;
        $request->file('uploadFile')->move($path,$filename);
        switch($category){
            case 'DEPT':
                $this->importDept($dest_file);
                break;
            case 'EMPLOYEE':
                $this->importEMP($dest_file);
                break;
        }

        return back();



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function importDept($destfile){
        Excel::load($destfile,function($reader){
            $rules=[
                //
                'name'=>'required|unique_with:departments,company_id,costcenter',
                'company_id'=>'exists:companies,id',
                'costcenter'=>'required'
            ];
            $sheetsCount=$reader->getSheetCount();

            for($i=0;$i<$sheetsCount;$i++){
                $sheets=$reader->getSheet($i)->toArray();
                $company_name=$reader->getSheet($i)->getTitle();
                $dept['company_id']=Company::where('name',$company_name)->value('id');
                $sheetCount=count($sheets);
                for($j=6;$j<$sheetCount;$j++){
                    $dept['name']=$sheets[$j][1];
                    $dept['costcenter']=$sheets[$j][10];
                    $dept_v=\Validator::make($dept,$rules);
                    if($dept_v->fails()){

                    } else{
                        Department::create($dept);

                    }
                }
            }



            //END
        });
    }


    public function importEMP($destfile){
        Excel::load($destfile,function($reader){
            $rules=[
                //
                'number'=>'required|unique:employees',
                'company_id'=>'required|exists:companies,id',
                'department_id'=>'required|exists:departments,id',
                'bank_account'=>'required|unique:employees'
            ];
            $sheetsCount=$reader->getSheetCount();

            for($i=0;$i<$sheetsCount;$i++){
                $sheets=$reader->getSheet($i)->toArray();
                $company_name=$reader->getSheet($i)->getTitle();
                $dept['company_id']=Company::where('name',$company_name)->value('id');
                $sheetCount=count($sheets);
                for($j=6;$j<$sheetCount;$j++){
                    // Get Department ID;
                    $dept['name']=$sheets[$j][1];
                    $dept['costcenter']=$sheets[$j][10];
                    $employee['company_id']= $dept['company_id'];
                    $employee['department_id']=Department::where('name',$dept['name'])
                        ->where('company_id',$dept['company_id'])
                        ->where('costcenter',$dept['costcenter'])
                        ->value('id');
                    $employee['name']=$sheets[$j][2];
                    $employee['number']=$sheets[$j][3];
                    $employee['level_id']=Level::where('credit',400)->value('id');
                    $employee['category_id']=Category::where('code',1)->value('id');
                    $employee['status_id']=Status::where('code',1)->value('id');
                    $employee['telephone']=$sheets[$j][4];
                    $employee['bank_account']=$sheets[$j][8];
                    $emp_v=\Validator::make($employee,$rules);
                    if($emp_v->fails()){

                    }else{
                        Employee::create($employee);
                    }
                }
            }



            //END
        });
    }


}
