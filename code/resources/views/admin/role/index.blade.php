@extends('../../layouts.app')
@section('content')

<div class="container-fluid">
 <h3 class='text-center mt-1'> 
  <span class="badge badge-info">{{$roles->count()}}</span> Perfís 
 </h3>
<a href="{{url("/admin/role/create")}}" class="btn btn-success btn-sm">
  <i class="fas fa-plus-square"></i>
</a>

<table class="table table-bordered table-sm table-hover table-striped mt-2">

  <thead>
    <tr>
      <th>Nome</th>
      <th>Descrição</th>
      <th width='18%'>Criado</th>
      <th width='18%'>Atualizado</th>
      <th width='10%'>Ações</th>
    </tr>
  </thead>

  <tbody>
    @forelse($roles as $role)
    <tr>
      <td>{{$role->name}}</td>
      <td>{{$role->label}}</td>
      <td class='text-right'>
        @dateBr($role->created_at) - @hora($role->created_at)
      </td>
      <td class='text-right'>
        @dateBr($role->updated_at) - @hora($role->updated_at)
      </td>
      <td class='text-center'>
        <a href="{{url("/admin/role/$role->id/show")}}" class="btn btn-sm btn-warning">
          <i class="fas fa-eye"></i>
        </a>
        <a href="{{url("/admin/role/$role->id/edit")}}" class="btn btn-sm btn-primary">
          <i class="fas fa-edit"></i>
        </a>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan='5'>
        <div class="alert alert-warning" role="alert">
          Nenhum perfil Encontrado
        </div>
      </td>
    </tr>
    @endforelse
  </tbody>

</table>

</div>
@endsection