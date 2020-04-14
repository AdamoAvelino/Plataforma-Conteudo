@extends('layouts.app')
@section('content')
    <article class="container">
      <fieldset class='position-relative shadow mt-5 py-2 px-3 border border-warning rounded'>
          <legend class='form-legend d-inline position-absolute' style='width:60%'>
            <span class='p-2 bg-warning text-white shadow rounded'>{{ $role->name }}</span>
          </legend>
          <div class="row">
            <section class="col-md-12">
              <div class='text-right'>
                <a class='btn btn-info btn-sm' href="{{url('/admin/role')}}">
                  Listar <i class="fas fa-list"></i>
                </a>
                <a class='btn btn-primary btn-sm' href="{{route('admin.role.edit', $role->id)}}">
                  Editar <i class="fas fa-edit"></i>
                </a>
                <a class='btn btn-success btn-sm' href="{{route('admin.role.create')}}">
                  Criar <i class="fas fa-plus-square"></i>
                </a>
              </div>
              <p class='text-muted'>{{ $role->label }}</p>
              @php $modulo = false @endphp
              @forelse($role->permissions as $permission)

              @if(!$modulo or $permission->modulo_id != $modulo)
                <h5 class='border-bottom'>
                  <strong>Modulo: </strong>
                    {{$permission->modulo->name}} - <small class='text-muted'>(Permissões)</small>
                  </h5>
              @endif

              @php $modulo = $permission->modulo_id @endphp
                <span class='badge badge-secondary'>{{$permission->name}} </span>
              @empty
                  <p class="alert alert-warning">
                    Sem regras de permissões de módulos para este perfil
                  </p>
              @endforelse

            </section>
          </div>
      </fieldset>
    </article>
@endsection
