@extends('layouts.app')
@section('content')
<section class="container-fluid">
  <h3 class='text-center'>
      <span class="badge badge-info mt-1">{{$accounts->count()}}</span> Contas
  </h3>
  @include('layouts.message')
  <a href="{{url("/admin/account/create")}}" class="btn btn-success btn-sm">
    <i class="fas fa-plus-square"></i>
  </a>
  <table class="table table-bordered table-sm table-hover table-striped mt-2">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Proprietário</th>
        <th>Classe</th>
        <th>Status</th>
        <th width='18%'>Iniciada</th>
        <th width='10%'>Finalizada</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      {{-- {{ dd($accounts) }} --}}
      @forelse( $accounts as $account )
      <tr>
        <td>{{$account->name}}</td>
        <td>{{$account->description}}</td>
        <td>{{$account->user->name}}</td>
        <td>{{$account->class->name}}</td>
        <td>@statusActive($account->active)</td>
        <td class='text-right'>
          @dateBr($account->initial_date)
        </td>
        <td class='text-right'>
          @if(!$account->active)
            @dateBr($account->final_date)
          @endif
        </td>
        <td class='text-center'>
          <a href="{{url("/admin/account/$account->id/show")}}" class="btn btn-warning btn-sm">
              <i class="fas fa-eye"></i>
          </a>
          <a href="{{url("/admin/account/$account->id/edit")}}" class="btn btn-primary btn-sm">
              <i class="fas fa-edit"></i>
          </a>
        </td>
      </tr>
      @empty
          <td colspan="8">
        <p class="alert alert-warning">
          Nenhuma Categoria Encontrada
        </p>
      </td>
      @endforelse
    </tbody>
  </table>
</section>

@endsection