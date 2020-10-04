@if($errors->any())
@php $user = (object) old() @endphp
@endif
<section class="row">
    @include('layouts.message')

    <article class="col-md-12 text-right">
        <p>
            <a class='btn btn-info btn-sm mt-0' href="{{route('admin.user.index')}}">
                Listar <i class="fas fa-list"></i>
            </a>
            
            @isset($user->id)
            <a class='btn btn-success btn-sm mt-0' href="{{route('admin.user.create')}}">
                Criar <i class="fas fa-plus-square"></i>
            </a>
            @endisset
            
        </p>
    </article>

    <article class="col-md-4 d-flex flex-column align-items-center">
        <div class='rounded-circle bg-light text-muted image d-flex justify-content-center border'>
            @if(isset($user) and $user->photo)
            <img class='mw-100' src="{{ asset('storage/').str_after($user->photo, 'public')}}" alt="imagem">
            @else
            <span class='align-self-center text-center '>
                <i class="fas fa-user" style="font-size: 6.0rem"></i>
            </span>
            @endif
        </div>
        <input id='image' type="file" name='photo' hidden>
        
        <label for="image" class="d-flex justify-content-center mt-2">
            <p class='align-self-center text-center'>
                <span class="fas fa-edit"></span> Photo
            </p>
        </label>
    </article>

    <article class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                @isset($user)
                @can('updateActive', $user)
                <div class="custom-control custom-switch">
                    <input type="checkbox" value='1' @isset($user->active)@statusCheck($user->active)@endisset name='active'
                    class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">Ativo</label>
                </div>
                @elsecan('anyView', $user)
                <h4>
                    <span class="badge @isset($user->active)@classActive($user->active)@endisset">
                        @isset($user->active)@statusActive($user->active)@endisset
                    </span>
                </h4>
                @endcan
                @endisset
            </div>    
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="">Nome</label>
                <input type="text" name="name" id="" class="form-control form-control-sm"
                value='@isset($user->name){{ $user->name }}@endisset'>
                <label for="cnpj">CNPJ</label>
                <input type="text" name="cnpj" id="" class="form-control form-control-sm"
                value='@isset($user->cnpj){{ $user->cnpj }}@endisset'>

                <label for="cpf">CPF</label>
                <input type="cpf" name="cpf" id="" class="form-control form-control-sm"
                value='@isset($user->cpf){{ $user->cpf }}@endisset'>

                
            </div>
            <div class="col-md-6">
                <label for="">E-mail</label>
                <input type="email" name="email" id="" class="form-control form-control-sm"
                value='@isset($user->email){{ $user->email }}@endisset'>
                <label for="">Telefone</label>
                <input type="telephone" name="telephone" id="" class="form-control form-control-sm"
                value='@isset($user->telephone){{ $user->telephone }}@endisset'>
            </div>
        </div>

        @can('includeProduces', App\User::class)
        <h5>Produtoras</h5>
        @forelse($produces as $produce)
        <div class="custom-control custom-switch d-inline">
            <input type="checkbox" value='{{$produce->id}}' @isset($user->id)@statusCheck($user->hasProduces($produce->id))@endisset
            name='produces[{{$produce->name}}]' class="custom-control-input" id="produce_{{$produce->id}}">
            <label class="custom-control-label" for="produce_{{$produce->id}}">{{$produce->name}}</label> |
        </div>
        @empty
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i><br>
            <strong>Aviso</strong><br>
            <span>Usuário Sem Empresa</span>
        </div>
        @endforelse
        @elsecan('anyView', $user)
        @if($produces)
        @foreach($produces as $produce)
        <h4><span class='badge badge-info'>{{$produce->name}}</span></h4>
        <input type="hidden" name="produces[{{$produce->name}}]" value='{{$produce->id}}'>
        @endforeach
        @endif
        @endcan


        <h5 class='mt-2'>Perfis</h5>
        @forelse($roles as $role)
        <div class="custom-control custom-switch d-inline">
            <input type="checkbox" value='{{$role->id}}' @isset($user->roles)@statusCheck($user->hasManyRules($role->name))@endisset
            name='perfis[{{$role->name}}]' class="custom-control-input" id="role_{{$role->id}}">
            <label class="custom-control-label" for="role_{{$role->id}}">{{$role->name}}</label> |
        </div>
        @empty
        @endforelse
    </article>
</section>

