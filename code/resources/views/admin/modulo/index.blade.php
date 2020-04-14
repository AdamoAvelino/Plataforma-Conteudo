@extends('../../layouts.app')
@section('content')
<div class="container-fluid">
    <h3 class='text-center mt-1'>
        <span class="badge badge-info">{{$modulos->count()}}</span> Permissões
    </h3>
    @include('layouts.message')
    <a href="{{url("/admin/modulo/create")}}" class="btn btn-success btn-sm">
      <i class="fas fa-plus-square"></i>
    </a>
    <table class="table table-bordered table-sm table-hover table-striped mt-2">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Decrição</th>
          <th width='18%'>Atualização</th>
          <th width='18%'>Criação</th>
          <th width='10%'>Ações</th>
        </tr>
      </thead>
      <tbody>
        @forelse($modulos as $modulo)
          <tr>
            <td>{{$modulo->name}}</td>
            <td>{{$modulo->description}}</td>
            <td class='text-right'>
              @dateBr($modulo->created_at) - @hora($modulo->created_at)
            </td>
            <td class='text-right'>
                @dateBr($modulo->updated_at) - @hora($modulo->updated_at)
            </td>
            <td class='text-center'>
              <a href="{{url("admin/modulo/{$modulo->id}/show")}}" class="btn btn-sm btn-warning">
                <i class="fas fa-eye"></i>
              </a>
              <a href="{{url("admin/modulo/{$modulo->id}/edit")}}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i>
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan='5'>
              <div class="alert alert-warning">
                Nenhuma Módulo encontrado
              </div>
            </td>
          </tr>
      @endforelse
      </tbody>
    </table>
  </div>
@endsection