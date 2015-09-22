@extends('tpl.master')
@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>

                @endforeach
            </ul>
        </div>
    @endif

            <!-- Model for new department-->

        <!-- Button trigger modal -->
        <button type="button" class="btn  btn-purple btn-xs  " data-toggle="modal" data-target="#myModal">
            <i class="ace-icon fa fa-plus "></i> 新增
        </button>





        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">新增项目</h4>
                    </div>
                    {!! Form::open(
                               array(
                               'url'=>'app',
                               'class'=>'form form-horizontal',
                               'files'=>true)
                       ) !!}
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">SNC 号码</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('snc_number','',['class'=>'form-control','required']) !!}
                                    </div>


                                    {!! Form::hidden('step_id',1) !!}
                                    <label for="" class="col-sm-2 control-label">公司</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('company_id',\App\Company::lists('name','id'),null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">


                                    <label for="" class="col-sm-2 control-label">申请人</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('applicant','' ,['required','class'=>'form-control'])!!}
                                    </div>
                                    <label for="" class="col-sm-2 control-label">成本中心</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('costcenter','' ,['required','class'=>'form-control'])!!}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">网线</label>
                                    <div class="col-sm-4">
                                        {!! Form::number('network_qty','',['class'=>'form-control']) !!}
                                    </div>

                                    <label for="" class="col-sm-2 control-label">电话线</label>
                                    <div class="col-sm-4">
                                        {!! Form::number('telecom_qty','',['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">描述</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('name','',['class'=>'form-control']) !!}
                                    </div>


                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">附件</label>
                                    <div class="col-sm-10">
                                        {!! Form::file('ips_file') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">存盘</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <!-- end Model-->


        @if (session()->has('message'))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <p>{!!session('message') !!}</p>

            </div>
        @endif
    <table id="employeeTable" class="table table-striped table-bordered table-hover">
        <thead>

            <th>工号</th>
            <th>姓名</th>
            <th>公司</th>
            <th>部门</th>
            <th>成本中心</th>
            <th>级别</th>
            <th>状态</th>
            <th>电话</th>
            <th>账号</th>
            <th>Edit</th>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr>

                <td>{!! $employee->number !!}</td>
                <td>{!! $employee->name !!}</td>
                <td>{!! $employee->company->name !!}</td>
                <td>{!! $employee->department->name !!}</td>
                <td>{!! $employee->department->costcenter !!}</td>
                <td>{!! $employee->level->name !!}</td>
                <td class="hidden-480"><span  class="label  label-success">{!! $employee->status->name !!}</span></td>
                <td>{!! $employee->telephone !!}</td>
                <td>{!! $employee->bank_account !!}</td>
                <td><button class="btn btn-xs btn-info">
                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                    </button></td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection

@section('javascript')

    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/jquery.dataTables.bootstrap.js "></script>
    <script>
        $(document).ready(function(){
            $("#employeeTable").wrap("<div class='dataTables_borderWrap' />")
                    .dataTable({
                        bAutoWidth: false//for better responsiveness

                    });
        }); </script>
    </script>
@endsection