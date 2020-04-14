@if($errors->any())
   @php ($post = (object) old())
@endif
<div class="row">
  @include('layouts.message')
  <section class="col-md-12 text-right mb-2">
    <a class='btn btn-primary btn-sm' href="{{route('admin.post.index')}}">
      Listar <i class="fas fa-list"></i>
    </a>
  </section>
  <section class="col-md-8">
    <label for="">Titulo</label>
    <input type="text" name="title" class="form-control" placeholder="Digite um Titulo"
    value="@isset($post->title){{$post->title}}@endisset">
    <label for="">Texto</label>
    <textarea name="description" class="form-control" rows='10'>@isset($post->description){{$post->description}}@endisset</textarea>
  </section>
  <section class='col-md-4'>

    @if(isset($post->image) and $post->image)
        <img src="{{ asset('storage/').str_after($post->image, 'public') }}">
    @else
      <label for='image' class="d-block">
        Selecione Uma Imagem
      </label>
      <input type="file" name="image" class="d-none" id='image'>
    @endif

    @if(isset($post->user))
      <p>
        <span class="badge badge-info">
          Autor: {{ $post->user->name }}
        </span>
        <span class="badge badge-info">
            Data: @dateBr($post->created_at) - @hora($post->created_at)
        </span>
      </p>
    @endif
    @if($categorys->count())
      <label>Categorias</label>
      <select name="categorys[]" id="" class="form-control form-control-sm">
        @foreach($categorys as $category)
          <option value='{{ $category->id }}' @isset($post->categorys)@statusSelect($post->categorys->contains('id', $category->id))@endisset>{{ $category->name }}</option>
        @endforeach
      </select>
    @else
      <p class="alert alert-warning">
        Não Existe Nenhuma Categoria Cadastrada
      </p>
    @endif
    @if($statuses->count())
      <label>Status</label>
      <select name="status_id" id="" class="form-control form-control-sm">
        @foreach($statuses as $status)
          <option value='{{ $status->id }}' @isset($post->status->id)@statusSelect($post->status->id == $status->id)@endisset>{{ $status->name }}</option>
        @endforeach
      </select>
    @else
      <p class="alert alert-warning">
        Não Existe Nenhuma Status Cadastrado
      </p>
    @endif
  </section>
</div>
