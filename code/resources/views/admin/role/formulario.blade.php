@if($errors->any())
   @php ($role = (object) old())
@endif
<div class="row">
  <section class="col-md-12 text-right">
      <p>
        <a class='btn btn-info btn-sm mt-0' href="{{route('admin.role.index')}}">
          Listar <i class="fas fa-list"></i>
        </a>
        @isset($role->id)
          <a class='btn btn-success btn-sm mt-0' href="{{route('admin.role.create')}}">
              Criar <i class="fas fa-plus-square"></i>
          </a>
        @endisset
      </p>
  </section>
  <section class="col-md-8">

    @include('layouts.message')

    <label for="">Nome</label>
    <input type="text" name="name" class="form-control form-control-sm" placeholder="Digite um Nome"
    value="@isset($role->name){{$role->name}}@endisset">
    <label for="">Descrição</label>
    <input type='text' name="label" class="form-control form-control-sm" value="@isset($role->label){{$role->label}}@endisset">

  </section>

  @if(isset($role))
    <section class='col-md-4 text-right'>
      <h5>Registro</h5>
      <p>
        <span class="badge badge-info">
          Criado: @dateBr($role->created_at) - @hora($role->created_at)
        </span>
        <span class="badge badge-info">
            Atualizado: @dateBr($role->updated_at) - @hora($role->update_at)
        </span>
      </p>
    </section>
    @endif
    <section class='col-md-12'>
      @forelse($modulos as $modulo)
      @if($modulo->permissions->count())
        <h5 class='border-top mt-2'>{{$modulo->name}}</h5>
      @endif
        @foreach($modulo->permissions as $item)
          <div class="custom-control custom-switch d-inline">
            <input type="checkbox" value='{{$item->id}}' @isset($role)@statusCheck($role->hasPermission($item->id))@endisset name='permission[{{$item->name}}]' class="custom-control-input" id="permission_{{$item->id}}">
            <label class="custom-control-label" for="permission_{{$item->id}}">{{$item->name}}</label> |
          </div>
        @endforeach
      @empty
      <p class="alert alert-warning">
        Não há nenhum módulo cadastrado
      </p>
      @endforelse
    </section>
</div>
