@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <section class="row">
        <article class="col-md-12">
            <h3 class='text-center mt-1'>
                <span class="badge badge-info">{{$users->count()}}</span> Usuários
            </h3>
            @include('layouts.message')
            @can('create', App\User::class)
            <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus-square"></i>
            </a>
            @endcan
            <table class="table table-bordered table-sm table-hover table-striped mt-2">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Perfíl</th>
                        <th>Ativo</th>
                        <th>Produtora</th>
                        <th width='18%'>Data</th>
                        <th width='10%'>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            
                            @foreach(explode(',', $user->roles) as $role)
                            <p class='badge badge-info'>{{$role}}</p>
                            @endforeach
                        </td>
                        <td>
                            <p class="badge @classActive($user->active)">
                                 @statusActive($user->active)
                            </p>
                        </td>
                        <td>{{$user->produce}}</td>
                        <td class="text-right">@dateBr($user->created_at) - @hora($user->created_at)</td>
                        <td class="text-center">
                            @can('view', $user)
                            <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            @endcan
                            @can('update', $user)
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i><br>
                        <strong>Aviso</strong><br>
                        <span>Nenhum Usuário Encontrado</span>
                    </div>
                    @endforelse
                </tbody>
            </table>
        </article>
    </section>
</div>
@endsection