@extends('layouts.app')
@section('content')
    <article class="container">
      <fieldset class='position-relative shadow mt-5 py-2 px-3 border border-warning'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
            <span class='p-2 bg-warning text-white shadow'>{{ $permission->name }}</span>
          </legend>
          <div class="row">
            <section class="col-md-12 mb-2 text-right">
              <a class='btn btn-info btn-sm' href="{{route('admin.permission.index')}}">
                Listar <i class="fas fa-list"></i>
              </a>
              <a class='btn btn-primary btn-sm' href="{{route('admin.permission.edit', $permission->id)}}">
                Editar <i class="fas fa-edit"></i>
              </a>
              <a class='btn btn-success btn-sm' href="{{route('admin.permission.create')}}">
                  Criar <i class="fas fa-plus-square"></i>
              </a>
            </section>
            <section class="col-md-6">
              <p class='text-muted'>{{ $permission->label }}</p>
              <p class="border-top">
                <strong>Permissão do Módulo:</strong> 
                <a href='{{route('admin.modulo.show', $permission->modulo_id)}}'>{{$permission->modulo->name}}</a>
              </p>
              <p class="border-top">
                <strong>Perfís Com a Permissão: </strong> 
                {{$permission->name}}
              </p>

              @forelse($permission->roles as $role)
                <span class="badge badge-secondary">{{$role->name}}</span>
              @empty
                <p class="alert alert-warning">
                  Não Existe Nenhum Perfil Para Essa Permissão.
                </p>
              @endforelse
          </section>
          <section class="col-md-6">
            
            <div class="text-right">
              <h5>Registro</h5>
              <span class="badge badge-info">@dateBr($permission->created_at) - @hora($permission->created_at)</span>
              <span class="badge badge-info">@dateBr($permission->updated_at) - @hora($permission->created_at)</span>
            </div>
          </section>
        </div>
      </fieldset>
    </article>
@endsection