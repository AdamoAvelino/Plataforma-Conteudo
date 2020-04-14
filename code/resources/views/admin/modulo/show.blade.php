@extends('layouts.app')
@section('content')
    <article class="container">
      <fieldset class='position-relative shadow mt-5 py-2 px-3 border border-warning rounded'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
          <span class='p-2 bg-warning text-white shadow rounded'>{{ $modulo->name }}</span>
        </legend>
        <div class="row">
          <section class="col-md-12 text-right mb-2">
            <a class='btn btn-success btn-sm' href="{{route('admin.modulo.create')}}">
                Criar <i class="fas fa-plus-square"></i>
            </a>
            <a class='btn btn-primary btn-sm' href="{{route('admin.modulo.edit', $modulo->id)}}">
                Editar <i class="fas fa-edit"></i>
            </a>
            <a class='btn btn-info btn-sm' href="{{route('admin.modulo.index')}}">
              Listar <i class="fas fa-list"></i>
            </a>
          </section>
          <section class="col-md-6">
            <p class='text-muted'>{{ $modulo->description }}</p>
            <h5 class='border-top'>Permissões do Módulo</h5>
            <p>
              <a href="{{route('admin.permission.create')}}" class="btn btn-success btn-sm">
                  Permissões <i class="fas fa-plus-square"></i>
              </a>
            </p>
            @forelse($modulo->permissions as $permission)
              <span class="badge badge-secondary">
                  {{$permission->name}}
              </span>
            @empty
              <p class="alert alert-warning">
                Nenhuma Permissão Encontrada Para Esse Módulo
              </p>
            @endforelse
          </section>
          <section class="col-md-6">
            <div class="text-right">
              <h5>Registro</h5>
              <span class="badge badge-info">
                  Criado: @dateBr($modulo->created_at) - @hora($modulo->created_at)
              </span>
              <span class="badge badge-info">
                  Atualizado: @dateBr($modulo->updated_at) - @hora($modulo->updated_at)
              </span>
            </div>
          </section>
        </div>
      </fieldset>
    </article>
@endsection