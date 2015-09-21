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
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <th class="center">
            <label class="pos-rel">
                <input type="checkbox" class="ace">
                <span class="lbl"></span>
            </label>
        </th>
        <th>工号</th>
        <th>姓名</th>
        <th>公司</th>
        <th>部门</th>
        <th>成本中心</th>
        <th>级别</th>
        <th>状态</th>
        <th>电话</th>

        <th>Edit</th>
        </thead>
        <tbody>
        @foreach($reports as $report)
            <tr>
                <td><label class="pos-rel">
                        <input type="checkbox" class="ace">
                        <span class="lbl"></span>
                    </label></td>

                <td>{!! $report->employee->number !!}</td>
                <td>{!! $report->employee->name !!}</td>
                <td>{!! $report->employee->company->name !!}</td>
                <td>{!! $report->employee->department->name !!}</td>
                <td>{!! $report->employee->department->costcenter !!}</td>
                <td>{!! $report->employee->level->name !!}</td>
                <td>{!! $report->employee->bank_account !!}</td>
                <td>{!! $report->flag->name !!}</td>
                <td><button class="btn btn-xs btn-info">
                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                    </button></td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection