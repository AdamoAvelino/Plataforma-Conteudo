@extends('layouts.app')
@section('content')
  <section class="container">
    <form class="form-group" method='post' action="{{ route('admin.permission.save') }}">
      <fieldset class='position-relative shadow mt-5 mt-5 px-3 py-2 border border-success'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
          <span class='p-2 bg-success text-white shadow'>Criar Permissão</span>
        </legend>
        {{ csrf_field() }}
        @include('admin.permission.formulario')
        <div class="row" style='margin-top: 10px'>
          <div class="col-md-8">
            <button class='btn btn-success btn-sm'>
                <i class="fas fa-save"></i>
            </button>
          </div>
        </div>
      </fieldset>
    </form>
  </section>
@endsection