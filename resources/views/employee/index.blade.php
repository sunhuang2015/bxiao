@extends('tpl.master')
@section('content')
    <table class="table">
        <thead>
            <th>工号</th>
            <th>姓名</th>
            <th>公司</th>
        <th>部门</th>
        <th>成本中心</th>
        <th>级别</th>
        <th>电话</th>
        <th>账号</th>
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

                <td>{!! $employee->telephone !!}</td>
                <td>{!! $employee->bank_account !!}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection