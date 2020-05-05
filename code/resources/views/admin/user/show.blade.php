@extends('layouts.app')
@can('anyView', $user)
@section('content')
    <article class="container mt-4">
        <fieldset class='position-relative shadow mt-5 py-2 px-4 border border-warning rounded'>
            <legend class='form-legend d-inline position-absolute' style='width:60%'>
                <span class='p-2 bg-warning text-white shadow rounded'>{{ $user->name }}</span>
            </legend>
            <div class="row">
                <section class="col-md-6">
                    <h1></h1>
                    <div class="image rounded-circle">
                        <img class='mw-100' src="{{asset('storage/').str_after($user->photo, 'public')}}">
                    </div>
                    <strong>E-mail:</strong> <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                </section>
                <section class='col-md-6 text-right'>
                    <p>
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
                    <h5 class='border-top'>Registro</h5>
                    <span class='badge badge-info'>Criado: @dateBr($user->creates_at) @hora($user->created_at)</span>
                    <span class='badge badge-info'>Atualizado: @dateBr($user->updated_at) @hora($user->updated_at)</span>

                    @if($user->roles)
                        <h5 class='border-top mt-2'>Perfís</h5>
                        @foreach($user->roles as $role)
                            <span class='badge badge-secondary'>{{$role->name}}</span>
                        @endforeach
                    @else
                        <p class="alert alert-warning mt-2 d-inline-block">
                            Usuário Sem Perfil Cadastrado
                        </p>
                    @endif
                </section>
            </div>
        </fieldset>
    </article>
@endsection
@endcan