<?php
$method = isset($entity) ? 'patch' : 'post';
$url = isset($entity) ? 'entities/' . $entity->id : 'entities';
?>
@extends('master')


@section('content')
    <div class="container">
        {!! Form::open(['url' => $url, 'method' => $method, 'files' => true]) !!}
        <div class="form-group">
            {{ Form::label("name", null, ['class' => 'control-label']) }}
            {{ Form::text("name", isset($entity->name)?$entity->name:"" ,array_merge(['class' => 'form-control'])) }}
        </div>
        <div class="form-group">
            {{ Form::label("preview", null, ['class' => 'control-label']) }}
            {!! Form::file('preview',array_merge(['class' => 'form-control'])); !!}
        </div>
        <div class="form-group">
            {{ Form::label("deep_link", null, ['class' => 'control-label']) }}
            {!! Form::file('deep_link',array_merge(['class' => 'form-control'])); !!}
        </div>
        <div class="form-group">
            {{ Form::label("expire_time", null, ['class' => 'control-label']) }}
            {{ Form::date("expire_time", isset($entity->expire_time)?date('Y-m-j',strtotime($entity->expire_time)):"" ,array_merge(['class' => 'form-control'])) }}
        </div>
        <div class="form-group">
            {{ Form::submit("Save", array_merge(['class' => 'form-control btn btn-success'])) }}
        </div>

        {!! Form::close() !!}
    </div>
@endsection