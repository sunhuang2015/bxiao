@extends('tpl.master')
@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            There were some problems creating an account:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table id="reportTable" class="table table-striped table-bordered table-hover">
        <thead>

        <th>月份</th>
        <th>工号</th>
        <th>姓名</th>
        <th>公司</th>
        <th>部门</th>
        <th>成本中心</th>
        <th>级别</th>
        <th>账号</th>
        <th>状态</th>
        <th>费用</th>
        </thead>
        <tbody>
        @foreach($reports as $report)
            <tr>

                <td>{!! $report->months !!}</td>
                <td>{!! $report->employee->number !!}</td>
                <td>{!! $report->employee->name !!}</td>
                <td>{!! $report->employee->company->name !!}</td>
                <td>{!! $report->employee->department->name !!}</td>
                <td>{!! $report->employee->department->costcenter !!}</td>
                <td>{!! $report->employee->level->name !!}</td>
                <td>{!! $report->employee->bank_account !!}</td>
                <td>{!! $report->flag->name !!}</td>
                <td>
                    {!! Form::model($report,
                                 array(
                                 'method'=>'put',
                                 'route' => ['report.update', $report->id],
                                 'class' => 'form'))
                                 !!}
                   {!! Form::number('fee',$report->fee,['step'=>0.01]) !!}
                    <button class="btn btn-xs btn-info">
                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
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
            $("#reportTable").wrap("<div class='dataTables_borderWrap' />")
                    .dataTable({
                        bAutoWidth: false//for better responsiveness

                    });
        }); </script>
    </script>
@endsection