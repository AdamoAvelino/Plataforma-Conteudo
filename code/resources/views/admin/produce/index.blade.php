@extends('layouts.app')
@section('content')
<section class="container-fluid">
  <h3 class='text-center'>
      <span class="badge badge-info mt-1">{{$produces->count()}}</span> Contas
  </h3>
  @include('layouts.message')
  <a href="{{url("/admin/produce/create")}}" class="btn btn-success btn-sm">
    <i class="fas fa-plus-square"></i>
  </a>
  <table class="table table-bordered table-sm table-hover table-striped mt-2">
    <thead>
      <tr>
        <th>Nome</th>
        <th>CNPJ</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Proprietário</th>
        <th width='18%'>Criada</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>

      @forelse( $produces as $produce )
      <tr>
        <td>{{$produce->name}}</td>
        <td>{{$produce->cnpj}}</td>
        <td>{{$produce->email}}</td>
        <td>{{$produce->telephone}}</td>
        <td>{{ $produce->users->first()->name }}</td>
        <td class='text-right'>
          @dateBr($produce->created_at)
        </td>
        <td class='text-center'>
          <a href="{{url("/admin/produce/$produce->id/show")}}" class="btn btn-warning btn-sm">
              <i class="fas fa-eye"></i>
          </a>
          <a href="{{url("/admin/produce/$produce->id/edit")}}" class="btn btn-primary btn-sm">
              <i class="fas fa-edit"></i>
          </a>
        </td>
      </tr>
      @empty
          <td colspan="8">
        <p class="alert alert-warning">
          Nenhuma Produtora Encontrada
        </p>
      </td>
      @endforelse
    </tbody>
  </table>
</section>

@endsection