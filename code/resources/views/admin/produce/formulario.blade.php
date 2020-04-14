@if($errors->any())
@php ($produce = (object) old())
  @endif
    <div class="row">
      <section class="col-md-12 text-right mb-2">
        <a class='btn btn-primary btn-sm' href="{{route('admin.produce.index')}}">
          Listar <i class="fas fa-list"></i>
        </a>
      </section>
      <section class="col-md-8">

        @include('layouts.message')

        <label for="">Nome</label>
        <input type="text" name="name" class="form-control form-control-sm" placeholder="Digite um Nome"
        value="@isset($produce->name){{$produce->name}}@endisset">

        <label for="">CNPJ</label>
        <input type="number" name="cnpj" class="form-control form-control-sm" placeholder="Digite o CNPJ"
        value="@isset($produce->cnpj){{$produce->cnpj}}@endisset">

        <label for="">E-mail</label>
        <input type="email" name="email" class="form-control form-control-sm" placeholder="Digite um E-mail"
        value="@isset($produce->email){{$produce->email}}@endisset">

        <label for="">Telefone</label>
        <input type="number" name="telephone" class="form-control form-control-sm" placeholder="Digite um Telefone"
        value="@isset($produce->telephone){{$produce->telephone}}@endisset">

      </section>

</div>
