@extends('layouts.app')
@section('content')

    <section class="container-fluid mt-5">
        <div class="row">
            @can('view', App\User::class)
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class='card-header text-right'>
                            <a href='{{url('/admin/user')}}' class='label label-primary section'>Ver Users
                                <span class='badge badge-light'> {{$users}} </span>
                            </a>
                        </div>
                        <div class="card-body bg-primary">
                            <p class='text-center'>
                          <span class='title-panel'>
                              Users
                          </span>
                                <i class="fas fa-users menu-icon"></i>
                            </p>
                        </div>
                    </div>
                </div>
            @endcan
            @can('view', App\Models\Admin\Role::class)
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-header text-right">
                        <a href="{{ url('/admin/role') }}" class='label label-warning section'
                           style='display: inline-block'>
                            Ver Perfis
                            <span class='badge badge-light'>{{$roles}}</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <p class='text-center'>
                          <span class='title-panel'>
                              Perfis
                          </span>
                            <i class="fas fa-user-lock menu-icon"></i>
                        </p>
                    </div>
                </div>
            </div>
            @endcan
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-header text-right">
                        <a href="{{ url('/admin/permission') }}" class='label label-success section'
                           style='display: inline-block'>
                            Ver Permissões
                            <span class='badge badge-light'>{{$permissions}}</span>
                        </a>
                    </div>
                    <div class='card-body'>
                        <p class='text-center'>
                          <span class='title-panel'>
                              Perm.
                          </span>
                            <i class="fas fa-lock menu-icon"></i>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-header text-right">
                        <a href='{{ url("/admin/modulo") }}' class='label label-danger section'
                           style='display: inline-block'>
                            Ver Modulos
                            <span class='badge badge-light'> {{$modulos}} </span>
                        </a>
                    </div>
                    <div class="card-body">
                        <p class='text-center'>
                            <span class='title-panel'>
                                Modulos
                            </span>
                            <i class="fas fa-puzzle-piece menu-icon"></i><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection