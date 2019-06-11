@extends('layouts.base')

@section('title') {{$name}} @endsection

   
@section('content')
<div class="header">{{ $name }}</div>
<p class="text"><em>{{ $description }}</em></p>
@endsection