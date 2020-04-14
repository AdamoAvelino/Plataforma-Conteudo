@extends('layouts.app')
@section('content')
<div class="container">
  <form action="{{ route('admin.user.delete', $user->id) }}" id="delete" method='post'>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
  </form>

  <form action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data" method='post'>
    <fieldset class='position-relative shadow mt-5 py-2 px-4 border border-info'>
      <legend class='form-legend d-inline position-absolute' style='width:60%'>
        <span class='p-2 bg-info text-white shadow'>Editar Usuário</span>
      </legend>
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      @include('admin.user.formulario')
      <div class="row" style='margin-top: 10px'>
        <div class="col-md-8">
          <button class='btn bt-sm btn-success'>
              <i class="fas fa-save"></i>
          </button>

          <button class='btn bt-sm btn-danger' form='delete'>
              <i class="fas fa-trash"></i>
          </button>
        </div>
      </div>
    </fieldset>
  </form>
</div>
@endsection