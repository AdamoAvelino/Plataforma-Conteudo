@extends('layouts.app')
@section('content')
    <article class="container">
      <fieldset class='position-relative shadow mt-5 py-2 px-3 border border-warning rounded'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
          <span class='p-2 bg-warning text-white shadow rounded'>{{ $produce->name }}</span>
        </legend>
        <div class="row">
          <section class="col-md-12 text-right mb-2">
            <a class='btn btn-success btn-sm' href="{{route('admin.produce.create')}}">
                Criar <i class="fas fa-plus-square"></i>
            </a>
            <a class='btn btn-primary btn-sm' href="{{route('admin.produce.edit', $produce->id)}}">
                Editar <i class="fas fa-edit"></i>
            </a>
            <a class='btn btn-info btn-sm' href="{{route('admin.produce.index')}}">
              Listar <i class="fas fa-list"></i>
            </a>
          </section>
          <section class="col-md-8">
            <h4>Informações da Produtora</h4>
            <h5>Produtora</h5>
            <p>
              <strong>Nome: </strong> {{ $produce->name }}<br>
              <strong>cnpj: </strong> {{ $produce->cnpj }}<br>
              <strong>E-mail: </strong>
              <a href="mailto:{{ $produce->email }}">
                {{ $produce->email }}
              </a><br>
              <strong>Telefone: </strong> {{ $produce->telephone }}
            </p>

            <hr>

            <h5>Proprietários</h5>
            @foreach($produce->users as $user)
            <p>
              <strong>Nome: </strong> {{ $user->name }}<br>
              <strong>E-mail: </strong>
              <a href="mailto:{{ $user->email }}">
                {{ $user->email }}
              </a>
            </p>
            @endforeach
          </section>
          <section class="col-md-4">
            <div>
                <span class='badge badge-info'>
                    <strong>Data:</strong> @dateBr($produce->created_at) - @hora($produce->created_at)
                </span>
              </div>
          </section>
        </div>
      </fieldset>
    </article>
@endsection