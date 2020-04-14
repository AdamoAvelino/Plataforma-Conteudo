@extends('layouts.app')
@section('content')
  <section class="container">
    <form class="form-group" method='post' action='{{route("admin.permission.delete", $permission->id)}}' id='delete'>
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

    <form class="form-group" method='post' action='{{ route("admin.permission.update", $permission->id)}}'>
      <fieldset class='position-relative shadow mt-5 px-3 py-2 border border-info'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
          <span class='p-2 bg-info text-white shadow'>Editar Permissões</span>
        </legend>
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('admin.permission.formulario')

        <div class="row" style='margin-top: 10px'>
          <div class="col-md-8">
            <button class='btn btn-success btn-sm'>
                <i class="fas fa-save"></i>
            </button>
            <button class='btn btn-danger btn-sm' form='delete'>
                <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
      </fieldset>
    </form>
  </section>
@endsection