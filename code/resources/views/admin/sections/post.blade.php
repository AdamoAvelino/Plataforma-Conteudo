@extends('layouts.app')

@section('content')
<section class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-header text-right">
                    <a href='{{ url("/admin/post") }}' class='label label-danger section' style='display: inline-block'>
                        Ver Post
                        <span class='badge badge-light'> {{$posts}} </span>
                    </a>
                </div>
                <div class="card-body">
                    <p class='text-center'>
                        <span class='title-panel'>
                            Posts
                        </span>
                        <i class="fas fa-newspaper menu-icon"></i><br>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-header text-right">
                    <a href='{{ url("/admin/category") }}' class='label label-danger section' style='display: inline-block'>
                        Ver Categoria
                        <span class='badge badge-light'> {{$categorys}} </span>
                    </a>
                </div>
                <div class="card-body">
                    <p class='text-center'>
                        <span class='title-panel'>
                            Categorys
                        </span>
                        <i class="fas fa-tags menu-icon"></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-header text-right">
                    <a class="section" href='{{ url("/admin/status") }}' style='display: inline-block'>
                        Ver Status
                        <span class='badge badge-light'> {{$statuses}} </span>
                    </a>
                </div>
                <div class="card-body">
                    <p class='text-center'>
                        <span class='title-panel'>
                            Status
                        </span>
                        <i class="fas fa-toggle-on menu-icon"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

