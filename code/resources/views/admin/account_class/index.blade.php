@extends('layouts.app')
@section('content')
<section class="container-fluid">
  <h3 class='text-center'>
      <span class="badge badge-info mt-1">{{$account_classes->count()}}</span> Classes de Conta
  </h3>
  @include('layouts.message')
  <a href="{{url("/admin/account_class/create")}}" class="btn btn-success btn-sm">
    <i class="fas fa-plus-square"></i>
  </a>
  <table class="table table-bordered table-sm table-hover table-striped mt-2">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th width='18%'>Date</th>
        <th width='10%'>Ação</th>
      </tr>
    </thead>
    <tbody>
      @forelse( $account_classes as $class )
        <tr>
          <td>{{$class->name}}</td>
          <td>{{$class->description}}</td>
          <td class='text-right'>
            @dateBr($class->created_at) - @hora($class->created_at)
          </td>
          <td class='text-center'>
            <a href="{{url("/admin/account_class/$class->id/show")}}" class="btn btn-warning btn-sm">
                <i class="fas fa-eye"></i>
            </a>
            <a href="{{url("/admin/account_class/$class->id/edit")}}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i>
            </a>
          </td>
        </tr>
      @empty
          <td colspan="4">
        <p class="alert alert-warning">
          Nenhuma Classe de Conta Encontrada
        </p>
      </td>
      @endforelse
    </tbody>
  </table>
</section>

@endsection