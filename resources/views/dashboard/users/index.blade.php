@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="width:100%;">

            <div class="row" style="width:100%;justify-content: space-between;">
                <div class="pull-left">
                    @if (Auth::user()->root == 1)
                        <h2>Пользователи</h2>
                    @else
                        <h2>Профиль</h2>
                    @endif
                </div>
                <div class="pull-left">
                    @if (Auth::user()->root == 1)
                    <a class="btn btn-success" href="{{ route('user.create') }}"> Создать</a>
                    @endif
                </div>
            </div>


            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif


            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th width="280px">Действия</th>
                </tr>
            @if(Auth::user()->root == 1)
            @foreach($data as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>

                        <td>
                            <a class="btn btn-info" href="{{ route('user.show',$row->id) }}">Просмотреть</a>
                            <a class="btn btn-primary" href="{{ route('user.edit',$row->id) }}">Изменить</a>
                             {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $row->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                          
                        </td>
                    </tr>
            @endforeach
            @else
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>

                        <td>
                            <a class="btn btn-info" href="{{ route('user.show',$data->id) }}">Просмотреть</a>
                            <a class="btn btn-primary" href="{{ route('user.edit',$data->id) }}">Изменить</a>
                          
                        </td>
                    </tr>
            @endif
             
            </table>
            @if(Auth::user()->root == 1)
          {!! $data->render() !!} 
            @endif
        </div>
    </div>
@endsection
