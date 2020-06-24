@extends('layouts.app')
@section('content')
@can('anyView', $user)
<article class="container mt-4">
    <fieldset class='position-relative shadow mt-5 py-2 px-4 border border-warning rounded'>
        <legend class='form-legend d-inline position-absolute' style='width:60%'>
            <span class='p-2 bg-warning text-white shadow rounded'>{{ $user->name }}</span>
        </legend>
        <div class="row">
            <section class="col-md-4">
                <div class="card mt-5 mb-3">
                    <div class="card-header d-flex justify-content-center bg-white">
                        <div class="image rounded-circle bg-light mt-3 d-flex justify-content-center border align-self-center">
                            @if($user->photo)
                            <img class='mw-100' src="{{asset('storage/').str_after($user->photo, 'public')}}">
                            @else
                            <span class='align-self-center text-center '>
                                <i class="fas fa-user" style="font-size: 6.0rem"></i>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>E-mail:</strong> <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                            </li>
                            @if($user->telephone)
                            <li class="list-group-item">
                                <strong>Telefone</strong>
                            </li>
                            @endif
                            @if($user->cpf)
                            <li class="list-group-item">
                                <strong>CPF:</strong> {{$user->cpf}}
                            </li>
                            @endif
                            @if($user->cnpj)
                            <li class="list-group-item">
                                <strong>CNPJ:</strong> {{$user->cnpj}}
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </section>
        </section>
        <section class='col-md-8'>
            <p class="text-right">
                <a class='btn btn-info btn-sm' href="{{route('admin.user.index')}}">
                    Listar <i class="fas fa-list"></i>
                </a>
                <a class='btn btn-primary btn-sm' href="{{route('admin.user.edit', $user->id)}}">
                    Alterar <i class="fas fa-edit"></i>
                </a>
                <a class='btn btn-success btn-sm' href="{{route('admin.user.create')}}">
                    Incluir <i class="fas fa-plus-square"></i>
                </a>
            </p>
            <h3>
                <span class="badge @classActive($user->active)">
                    @statusActive($user->active)
                </span>
            </h3>
            <h3 class='border-top'>Registro</h3>
            <span class='badge badge-primary' style="font-size: 1rem">Criado: @dateBr($user->creates_at) @hora($user->created_at)</span>
            <span class='badge badge-primary' style="font-size: 1rem">Atualizado: @dateBr($user->updated_at) @hora($user->updated_at)</span>

            <h3 class='border-top mt-2'>Perfís</h3>
            @forelse($user->roles as $role)
            <span class='badge badge-info' style="font-size: 1rem">{{$role->name}}</span>
            @empty
            <p class="alert alert-warning mt-2 d-inline-block">
                Usuário Sem Perfil Cadastrado
            </p>
            @endforelse
            <h3 class='border-top mt-2'>Produtoras</h3>
            @forelse($user->produces as $produce)
            <span class='badge badge-info' style="font-size: 1rem">{{$produce->name}}</span>
            @empty
            <p class="alert alert-warning mt-2 d-inline-block">
                Sem Vínculo com Produtoras
            </p>
            @endforelse
            
            
        </section>
    </div>
</fieldset>
</article>
@endcan
@endsection
