@extends('layouts.app')
@section('content')
<section class="container-fluid">
  <h3 class='text-center'>
      <span class="badge badge-info mt-1">{{$categorys->count()}}</span> Categorias
  </h3>
  @include('layouts.message')
  <a href="{{url("/admin/category/create")}}" class="btn btn-success btn-sm">
    <i class="fas fa-plus-square"></i>
  </a>
  <table class="table table-bordered table-sm table-hover table-striped mt-2">
    <thead>
      <tr>
        <th>Nome</th>
        <th width='18%'>Date</th>
        <th width='10%'>Ação</th>
      </tr>
    </thead>
    <tbody>
      @forelse( $categorys as $category )
      <tr>
        <td>{{$category->name}}</td>
        <td class='text-right'>
          @dateBr($category->created_at) - @hora($category->created_at)
        </td>
        <td class='text-center'>
          <a href="{{url("/admin/category/$category->id/show")}}" class="btn btn-warning btn-sm">
              <i class="fas fa-eye"></i>
          </a>
          <a href="{{url("/admin/category/$category->id/edit")}}" class="btn btn-primary btn-sm">
              <i class="fas fa-edit"></i>
          </a>
        </td>
      </tr>
      @empty
          <td colspan="4">
        <p class="alert alert-warning">
          Nenhuma Categoria Encontrada
        </p>
      </td>
      @endforelse
    </tbody>
  </table>
</section>

@endsection