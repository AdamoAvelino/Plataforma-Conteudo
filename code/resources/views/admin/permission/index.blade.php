@extends('../../layouts.app')
@section('content')
<div class="container-fluid">
    <h3 class='text-center mt-1'>
        <span class="badge badge-info">{{$permissions->count()}}</span> Permissões
    </h3>
    @include('layouts.message')
    <a href="{{url("/admin/permission/create")}}" class="btn btn-success btn-sm">
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
        @forelse($permissions as $permission)
          <tr>
            <td>{{$permission->name}}</td>
            <td>{{$permission->label}}</td>
            <td class='text-right'>
              @dateBr($permission->created_at) - @hora($permission->created_at)
            </td>
            <td class='text-right'>
                @dateBr($permission->updated_at) - @hora($permission->updated_at)
            </td>
            <td class='text-center'>
              <a href="{{url("admin/permission/{$permission->id}/show")}}" class="btn btn-sm btn-warning">
                <i class="fas fa-eye"></i>
              </a>
              <a href="{{url("admin/permission/{$permission->id}/edit")}}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i>
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan='5'>
              <div class="alert alert-warning">
                Nenhuma Permissão encontrado
              </div>
            </td>
          </tr>
      @endforelse
      </tbody>
    </table>
  </div>
@endsection