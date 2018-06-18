@extends('master')

@section('content')
   {!! Form::open(['url' => 'entities', 'files' => true]) !!}
   <div class="form-group">
      {{ Form::label("name", null, ['class' => 'control-label']) }}
      {{ Form::text("name", "" ,array_merge(['class' => 'form-control'])) }}
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
      {{ Form::date("expire_time", "" ,array_merge(['class' => 'form-control'])) }}
   </div>
   <div class="form-group">
      {{ Form::submit("Save", array_merge(['class' => 'form-control btn btn-success'])) }}
   </div>

   {!! Form::close() !!}
@endsection