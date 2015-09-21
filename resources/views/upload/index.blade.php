@extends('tpl.master')
@section('content')

    <div class="row">
        <div class="col-sm-8">
            {!! Form::open(
                    array(
                         'route' => 'upload.store',
                         'class' => 'form',
                         'files' => true)) !!}

            <div class="form-group">
                 {!! Form::label('分类') !!}
                 {!! Form::select('category', ["DEPT"=>"部门","EMPLOYEE"=>"职员","OTHERS"=>"其他"], array('placeholder'=>'Chess Board')) !!}
            </div>



             <div class="form-group">
                 {!! Form::label('文件') !!}
                 {!! Form::file('uploadFile', ['required']) !!}
                 </div>

             <div class="form-group">
                 {!! Form::submit('上传文件') !!}
                 </div>
             {!! Form::close() !!}
             </div>
        </div>

    </div>

@endsection