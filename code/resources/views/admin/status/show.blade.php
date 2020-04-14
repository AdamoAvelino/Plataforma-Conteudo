@extends('layouts.app')
@section('content')
    <article class="container">
      <fieldset class='position-relative shadow mt-5 py-2 px-3 border border-warning rounded'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
          <span class='p-2 bg-warning text-white shadow rounded'>{{ $status->name }}</span>
        </legend>
        <div class="row">
          <section class="col-md-12 text-right mb-2">
            <a class='btn btn-success btn-sm' href="{{route('admin.status.create')}}">
                Criar <i class="fas fa-plus-square"></i>
            </a>
            <a class='btn btn-primary btn-sm' href="{{route('admin.status.edit', $status->id)}}">
                Editar <i class="fas fa-edit"></i>
            </a>
            <a class='btn btn-info btn-sm' href="{{route('admin.status.index')}}">
              Listar <i class="fas fa-list"></i>
            </a>
          </section>
          <section class="col-md-12">
            <div>
                <span class='badge badge-info'>
                    <strong>Data:</strong> @dateBr($status->created_at) - @hora($status->created_at)
                </span>
              </div>
          </section>
        </div>
      </fieldset>
    </article>
@endsection