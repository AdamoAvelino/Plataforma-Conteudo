@extends('layouts.app')
@section('content')
    <article class="container">
      <fieldset class='position-relative shadow mt-5 py-2 px-3 border border-warning rounded'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
          <span class='p-2 bg-warning text-white shadow rounded'>{{ $account_class->name }}</span>
        </legend>
        <div class="row">
          <section class="col-md-12 text-right mb-2">
            <a class='btn btn-success btn-sm' href="{{route('admin.account_class.create')}}">
              Criar <i class="fas fa-plus-square"></i>
            </a>
            <a class='btn btn-primary btn-sm' href="{{route('admin.account_class.edit', $account_class->id)}}">
              Editar <i class="fas fa-edit"></i>
            </a>
            <a class='btn btn-info btn-sm' href="{{route('admin.account_class.index')}}">
              Listar <i class="fas fa-list"></i>
            </a>
          </section>
          <section class="col-md-12">
            <h5>Descrição</h5>
            <p class="text-muted">
              {{ $account_class->description }}
            </p>
            <div>
                <span class='badge badge-info'>
                    <strong>Data:</strong> @dateBr($account_class->created_at) - @hora($account_class->created_at)
                </span>
              </div>
          </section>
        </div>
      </fieldset>
    </article>
@endsection