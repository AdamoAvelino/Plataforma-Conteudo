@extends('layouts.app')
@can('create', App\User::class)
@section('content')
    <div class="container">
        <form action="{{ route('admin.user.save') }}" enctype="multipart/form-data" method='post'>
            <fieldset class='position-relative shadow mt-5 py-2 px-5 border border-success rounded'>
                <legend class='form-legend d-inline position-absolute' style='width:60%'>
                    <span class='p-2 bg-success text-white shadow rounded'>Criar Usuário</span>
                </legend>
                {{ csrf_field() }}

                @include('admin.user.formulario')
                <div class="row">
                    <div class="col-md-8 offset-4">
                        <label for="">Senha</label>
                        <input type="password" name="password" class="form-control form-control-sm">
                        <label for="">Confirme a Senha</label>
                        <input type="password" name="confirm_password" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row" style='margin-top: 10px'>
                    <div class="col-md-8 offset-4">
                        <button class='btn bt-sm btn-success'>
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
@endcan