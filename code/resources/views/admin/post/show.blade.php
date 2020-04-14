@extends('layouts.app')
@section('content')
    <article class="container">
      <fieldset class='position-relative shadow mt-5 py-2 px-3 border border-warning rounded'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
          <span class='p-2 bg-warning text-white shadow rounded'>{{ $post->title }}</span>
        </legend>
        <div class="row">
          <section class="col-md-12 text-right mb-2">
            <a class='btn btn-success btn-sm' href="{{route('admin.post.create')}}">
                Criar <i class="fas fa-plus-square"></i>
            </a>
            <a class='btn btn-primary btn-sm' href="{{route('admin.post.edit', $post->id)}}">
                Editar <i class="fas fa-edit"></i>
            </a>
            <a class='btn btn-info btn-sm' href="{{route('admin.post.index')}}">
              Listar <i class="fas fa-list"></i>
            </a>
          </section>
          <section class='col-md-8'>
            {{ $post->description }}
          </section>
          <section class="col-md-4">
            <div>
              @if($post->image)
                <img src="{{ asset('storage/').str_after($post->image, 'public') }}">
              @endif
                <span class='badge badge-info'>
                  <strong>Autor:</strong> {{ $post->user->name }}
                </span>
                <span class='badge badge-info'>
                    <strong>Data:</strong> @dateBr($post->created_at)
                </span>
              </div>
              <div>
                <p><strong>Status: </strong>{{ $post->status->name }}</p>
                <p>
                  <strong>Categorias: </strong>
                  @isset($post->categorys){{ $post->categorys->first()->name }}@endisset
                </p>
              </div>
          </section>
        </div>
      </fieldset>
    </article>
@endsection