@extends('layouts.app')
@section('content')
    <article class="container">
      <fieldset class='position-relative shadow mt-5 py-2 px-3 border border-warning rounded'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
          <span class='p-2 bg-warning text-white shadow rounded'>{{ $account->name }}</span>
        </legend>
        <div class="row">
          <section class="col-md-12 text-right mb-2">
            <a class='btn btn-success btn-sm' href="{{route('admin.account.create')}}">
                Criar <i class="fas fa-plus-square"></i>
            </a>
            <a class='btn btn-primary btn-sm' href="{{route('admin.account.edit', $account->id)}}">
                Editar <i class="fas fa-edit"></i>
            </a>
            <a class='btn btn-info btn-sm' href="{{route('admin.account.index')}}">
              Listar <i class="fas fa-list"></i>
            </a>
          </section>
          <section class="col-md-8">
            <h5>Informações da Conta</h5>
            <p class='text-muted'>{{ $account->description }}</p>
            <p>
              <span class="badge badge-info">
                {{ $account->class->name }}
              </span>
              <span class="text-white badge @classActive($account->active)">
                @statusActive($account->active)
              </span>
              <span class='badge badge-info'>
                Iniciada em @dateBr($account->initial_date);
              </span>
              @if(!$account->active)
                <span class='badge badge-info'>
                  Finalizada em @dateBr($account->final_date);
                </span>
              @endif
            </p>
            <h5>Proprietário</h5>
            <p>
              <strong>Nome: </strong> {{ $account->user->name }}<br>
              <strong>E-mail: </strong> 
              <a href="mailto:{{ $account->user->email }}">
                {{ $account->user->email }}
              </a>
            </p>
          </section>
          <section class="col-md-4">
            <div>
                <span class='badge badge-info'>
                    <strong>Data:</strong> @dateBr($account->created_at) - @hora($account->created_at)
                </span>
              </div>
          </section>
        </div>
      </fieldset>
    </article>
@endsection