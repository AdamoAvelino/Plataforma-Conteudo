@extends('layouts.app')
@section('content')
  <section class="container">
    <form class="form-group" method='post' action='{{route("admin.post.delete", $post->id)}}' id='delete'>
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type='hidden' name='id' value='{{$post->id}}'>
    </form>

    <form class="form-group" enctype="multipart/form-data" method='post' action='{{ route("admin.post.update", $post->id)}}'>
      <fieldset class='position-relative shadow mt-5 py-2 px-3 border border-info rounded'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
          <span class='p-2 bg-info shadow text-white rounded'>Editar Post</span>
        </legend>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name='id' value='{{$post->id}}'>
        <input type="hidden" name='user_id' value='{{$post->user_id}}'>

        @include('admin.post.formulario')

        <div class="row" style='margin-top: 10px'>
          <div class="col-md-8">
            <button class='btn btn-success btn-sm'>
                <i class="fas fa-save"></i>
            </button>
            <button class='btn btn-danger btn-sm' form='delete'>
                <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
      </fieldset>
    </form>
  </section>
@endsection