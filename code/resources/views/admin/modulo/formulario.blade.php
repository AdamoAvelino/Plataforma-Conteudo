@if($errors->any())
   @php ($modulo = (object) old())
@endif
<div class="row">
  <section class="col-md-12 text-right mb-2">
      <a class='btn btn-primary btn-sm' href="{{route('admin.modulo.index')}}">
          Listar <i class="fas fa-list"></i>
        </a>
        @isset($modulo->id)
          <a class='btn btn-success btn-sm' href="{{route('admin.modulo.create')}}">
            Criar <i class="fas fa-plus-square"></i>
          </a>
        @endisset
  </section>
  <section class="col-md-8">

    @include('layouts.message')

    <label for="">Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Digite um Nome"
    value="@isset($modulo->name){{$modulo->name}}@endisset">
    <label for="">Descrição</label>
    <input type='text' name="description" class="form-control" value="@isset($modulo->description){{$modulo->description}}@endisset">

  </section>

  @if(isset($modulo->created_at))
    <section class='col-md-4 text-right'>
      <h5>Registro</h5>
      <p>
        <span class="badge badge-info">
          Criado: @dateBr($modulo->created_at) - @hora($modulo->created_at)
        </span>
        <span class="badge badge-info">
            Atualizado: @dateBr($modulo->updated_at) - @hora($modulo->updated_at)
        </span>
      </p>
    </section>
  @endif
</div>
