@extends('layouts.app')

@section('content')
  <article class="container">
    <h2>{{$post->title}}</h2>
    <div>
      {{$post->description}}
    </div>
  </article>
@endsection