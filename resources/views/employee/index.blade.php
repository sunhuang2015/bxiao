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