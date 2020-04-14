@extends('layouts.app')
@section('content')
<section class="container-fluid">
  <h3 class='text-center'>
      <span class="badge badge-info mt-1">{{$posts->count()}}</span> Posts
  </h3>
  @include('layouts.message')
  <a href="{{url("/admin/post/create")}}" class="btn btn-success btn-sm">
    <i class="fas fa-plus-square"></i>
  </a>
  <table class="table table-bordered table-sm table-hover table-striped mt-2">
    <thead>
      <tr>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Status</th>
        <th>Categorias</th>
        <th width='18%'>Date</th>
        <th width='10%'>Ação</th>
      </tr>
    </thead>
    <tbody>
      @forelse( $posts as $post )
      <tr>
        <td>{{$post->title}}</td>
        <td>{{$post->user->name}}</td>
        <td>{{$post->status->name}}</td>
        <td>{{$post->categorys->first()->name}}</td>
        <td class='text-right'>
            @dateBr($post->created_at) - @hora($post->created_at)
        </td>
        <td class='text-center'>
          <a href="{{url("/admin/post/$post->id/show")}}" class="btn btn-warning btn-sm">
              <i class="fas fa-eye"></i>
          </a>
          <a href="{{url("/admin/post/$post->id/edit")}}" class="btn btn-primary btn-sm">
              <i class="fas fa-edit"></i>
          </a>
        </td>
      </tr>
      @empty
      <td colspan="4">
        <p class="alert alert-warning">
          Nenhum Artigo Encontrado
        </p>
      </td>
      @endforelse
    </tbody>
  </table>
</section>

@endsection