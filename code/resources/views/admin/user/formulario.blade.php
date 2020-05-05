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

    <article class="col-md-8">
        <label for="">Nome</label>
        <input type="text" name="name" id="" class="form-control form-control-sm"
               value='@isset($user->name){{ $user->name }}@endisset'>

        <label for="">E-mail</label>
        <input type="email" name="email" id="" class="form-control form-control-sm"
               value='@isset($user->email){{ $user->email }}@endisset'>

        <div class="custom-control custom-switch">
            <input type="checkbox" value='1' @isset($user->active)@statusCheck($user->active)@endisset name='active'
            class="custom-control-input" id="customSwitch1">
            <label class="custom-control-label" for="customSwitch1">Ativo</label>
        </div>

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

    <article class="col-md-4">
        @if(isset($user) and $user->photo)
            <div class="image rounded-circle">
                <img class='mw-100' src="{{ asset('storage/').str_after($user->photo, 'public')}}" alt="imagem">
            </div>
        @else
            <div class='rounded-circle bg-info text-white d-flex justify-content-center image'>
                <label for="image" class='align-self-center text-center'>
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p class='text-muted'>Selecione uma Imagem</p>
                </label>
            </div>
            <input id='image' type="file" name='photo' hidden>
        @endif
    </article>

</section>

