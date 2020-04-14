@if($errors->any())
   @php ($permission = (object) old())
@endif
<div class="row">
  <section class="col-md-12 text-right">
      <a class='btn btn-primary btn-sm' href="{{route('admin.permission.index')}}">
          Listar <i class="fas fa-list"></i>
        </a>
        @isset($permission->id)
          <a class='btn btn-success btn-sm' href="{{route('admin.permission.create')}}">
            Criar <i class="fas fa-plus-square"></i>
          </a>
          <a class='btn btn-warning btn-sm' href="{{route('admin.modulo.show', $permission->modulo_id)}}">
            Módulo <i class="fas fa-eye"></i>
          </a>
        @endisset
  </section>
  <section class="col-md-6">
    @include('layouts.message')

    <label for="">Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Digite um Nome"
    value="@isset($permission->name){{$permission->name}}@endisset">
    <label for="">Descrição</label>
    <input type='text' name="label" class="form-control" value="@isset($permission->label){{$permission->label}}@endisset">
    <label>Módulo</label>
    <select name="modulo_id" id="" class="form-control">
      <option value=''>Selecione</option>
      @forelse($modulos as $modulo)
        <option value="{{$modulo->id}}" @isset($permission)@statusSelect($modulo->id == $permission->modulo_id)@endisset>{{$modulo->name}}</option>
      @empty
      @endforelse
    </select>

  </section>

  <section class='col-md-6 text-right'>
    
    @if(isset($permission->created_at))
        <h5 class='border-top mt-3'>Registro</h5>
        <p>
          <span class="badge badge-info">
            Criado: @dateBr($permission->created_at) - @hora($permission->created_at)
          </span>
          <span class="badge badge-info">
              Atualizado: @dateBr($permission->updated_at) - @hora($permission->updated_at)
          </span>
        </p>
    @endif
  </section>
</div>
