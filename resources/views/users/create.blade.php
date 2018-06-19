<?php
$method = isset($user) ? 'patch' : 'post';
$url = isset($user) ? 'users/' . $user->id : 'users';
?>
@extends('master')


@section('content')
    <div class="container">
        {!! Form::open(['url' => $url, 'method' => $method, 'files' => true]) !!}
        <div class="form-group">
            {{ Form::label("username", null, ['class' => 'control-label']) }}
            {{ Form::text("username", isset($user->username)?$user->username:"" ,array_merge(['class' => 'form-control'])) }}
        </div>
        <div class="form-group">
            {{ Form::label("first_name", null, ['class' => 'control-label']) }}
            {{ Form::text("first_name", isset($user->first_name)?$user->first_name:"" ,array_merge(['class' => 'form-control'])) }}
        </div>
        <div class="form-group">
            {{ Form::label("last_name", null, ['class' => 'control-label']) }}
            {{ Form::text("last_name", isset($user->last_name)?$user->last_name:"" ,array_merge(['class' => 'form-control'])) }}
        </div>
        <div class="form-group">
            {{ Form::label("email", null, ['class' => 'control-label']) }}
            {{ Form::email("email", isset($user->email)?$user->email:"" ,array_merge(['class' => 'form-control'])) }}
        </div>

        <div class="form-group">
            {{ Form::submit("Save", array_merge(['class' => 'form-control btn btn-success'])) }}
        </div>

        {!! Form::close() !!}
    </div>
@endsection