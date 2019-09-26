@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                     <a href="{{ route('user.index') }}">Мой профиль</a> 
                </div>
                 @if(Auth::user()->root == 1)
                 <div class="card-body">
                    <a href="{{ route('user.index') }}">Менеджеры</a>
                  </div>
                 @endif 
            </div>
        </div>
    </div>
</div>
@endsection
