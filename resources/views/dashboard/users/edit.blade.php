@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="width:100%;">
       
   <div class="row"  style="width:100%;justify-content: space-between;">
       <div class="pull-left">
            <h2>Редактировать пользователя</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('user.index') }}"> Назад</a>
        </div>
   </div>
        
 

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Упс!</strong> Что-то пошло не так.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Имя:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Пароль:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Подтвердите пароль:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
  
                
                   
   
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Изменить</button>
    </div>
</div>
{!! Form::close() !!}


    </div>
</div>
@endsection
