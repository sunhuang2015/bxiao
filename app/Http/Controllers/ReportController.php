<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Report;
use Carbon\Carbon;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static $m;
    public function index($month='2015-09-01')
    {
        //
        if(isset($month)){
            $reports=Report::with('employee','employee.company','employee.department','employee.level','flag')
                ->where('months','=',$month)
                ->get();
        }else
            $month=Carbon::now()->firstOfMonth();
        $reports=Report::with('employee','employee.company','employee.department','employee.level','flag')
            ->where('months','=',$month)
            ->get();
        $reportStatus['counts']=Report::where('months','=',$month)
                    ->where('flag_id',1)
                    ->count();
        $reportStatus['total']=Report::where('months','=',$month)->count();
        return view('report.index')
                ->with('reports',$reports)
                ->with('reportStatus',$reportStatus);

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

        $data['fee']=$request->get('fee');
        $data['flag_id']=2;
        Report::find($id)->update($data);
        return back();
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
}
