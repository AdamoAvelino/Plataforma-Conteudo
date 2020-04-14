@extends('layouts.app')

@section('content')
<section class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-header text-right">
                    <a href='{{ url("/admin/account") }}' class='label label-danger' style='display: inline-block'>
                        Ver Contas
                        <span class='badge badge-light'> {{$accounts}} </span>
                    </a>
                </div>
                <div class="card-body">
                    <p class='text-center'>
                        <span class='title-panel'>
                            Contas
                        </span>
                        <i class="fas fa-file-invoice-dollar menu-icon"></i><br>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-header text-right">
                    <a href='{{ url("/admin/account_class") }}' class='label label-danger' style='display: inline-block'>
                        Ver Classes de Contas
                        <span class='badge badge-light'> {{$account_classes}} </span>
                    </a>
                </div>
                <div class="card-body">
                    <p class='text-center'>
                        <span class='title-panel'>
                            Classes
                        </span>
                        <i class="fas fa-tags menu-icon"></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-header text-right">
                    <a href='{{ url("/admin/produce") }}' style='display: inline-block'>
                        Ver Produtoras
                        <span class='badge badge-light'> {{$produces}} </span>
                    </a>
                </div>
                <div class="card-body">
                    <p class='text-center'>
                        <span class='title-panel'>
                            Produtoras
                        </span>
                        <i class="fas fa-building menu-icon"></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-header text-right">
                    <a href='{{ url("/admin/editorial") }}' style='display: inline-block'>
                        Ver Editoriais
                        <span class='badge badge-light'> {{$editorials}} </span>
                    </a>
                </div>
                <div class="card-body">
                    <p class='text-center'>
                        <span class='title-panel'>
                            Editoriais
                        </span>
                        <i class="fas fa-network-wired menu-icon"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

