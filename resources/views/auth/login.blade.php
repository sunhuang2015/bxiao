<!-- resources/views/auth/login.blade.php -->
@extends('tpl.master')
@section('content')


    <div class="col-md-6">
         {!! Form::open(array('url' => '/auth/register', 'class' => 'form')) !!}

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
    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>
    </div>
    @endsection