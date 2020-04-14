<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Post\PostCreate;
use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use App\Models\Admin\Status;
use App\Models\Admin\Category;

class PostController extends Controller
{
    /**
     * ---------------------------------------------------------------------------
     * Cria e lista todos os posts
     *
     * @return metodo view com template index de post
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * ---------------------------------------------------------------------------
     * Cria a tela para mostrar os detalhes de um post individual
     *
     * @param [int] $id - id do post a ser apresentado
     * @return metodo view com template show de post
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.post.show', compact('post'));
    }
    /**
     * ---------------------------------------------------------------------------
     * Apresenta um formulário com os dados de um post que podem ser alterados.
     * @param [int] $id - id do post a ser editado
     * @return metodo view com template edit de post
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $statuses = Status::all();
        $categorys = Category::all();

        return view('admin.post.edit', compact('post', 'statuses', 'categorys'));
    }

    /**
     * ---------------------------------------------------------------------------
     * Apresenta um formulário com entradas para criar um post
     * @return metodo view com template create de post com injeção
     * das collection de status e category
     */
    public function create()
    {
        $statuses = Status::all();
        $categorys = Category::all();
        return view('admin.post.create', compact('statuses', 'categorys'));
    }
    /**
     * ---------------------------------------------------------------------------
     * Recolhe os dados da requisição trata e persiste os persiste na base de dados
     * caso tenha sucesso.
     * @param PostCreate $request - Objeto request que sanatiza os dados de entrada
     * @return metodo de redirecionamento caso criado com sucesso | metodo view com
     * injeção dos dodos de requisição caso tenha dado algum erro.
     */
    public function save(PostCreate $request)
    {
        $dataForm = $request->except('_token');
        $dataForm['user_id'] = auth()->user()->id;
        $dataForm['image'] = $request->image->store('public');
        $post = Post::create($dataForm);
        if ($post->id) {
            $post->categorys()->sync($request->categorys);
            session()->flash('success', "Post {$post->title} Criado com Sucesso");
            return redirect()->route('admin.post.edit', $post->id);
        } else {
            session()->flash('error', "Erro  ao Criar o Post {$post->title}");
            $post = $request;
            return view('admin.post.create', compact('post'));
        }
    }
    /**
     * ---------------------------------------------------------------------------
     * Recolhe os dados da requisição trata e os persiste na base de dados
     * caso tenha sucesso.
     * @param PostCreate $request Objeto request que sanatiza os dados de entrada
     * @param [int] $id id do post que será atualizado
     * @return metodo de redirecionamento
     */
    public function update(PostCreate $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status_id = $request->status_id;

        if ($request->hasFile('image')) {

            $post->image = $request->image->store('public');
        }

        if ($post->save()) {
            // dd($request->categorys);
            $post->categorys()->sync($request->categorys);
            session()->flash('success', "Post {$post->title} Atualizado com Sucesso");
        } else {
            session()->flash('error', "Erro  ao Excluir o Post {$post->title}");
        }

        return redirect()->route('admin.post.edit', $post->id);
    }
    /**
     * ---------------------------------------------------------------------------
     * Busca o registro de um post e deleta da base de dados
     * @param [int] $id id do post que será excluido
     * @return metodo de redirecionamento
     */
    public function delete($id)
    {
        $post = Post::find($id);

        if ($post->delete()) {
            session()->flash('success', "Post {$post->title} Excluido com Sucesso");
            return redirect()->route('admin.post.index');
        }
        session()->flash('Error', "Não foi Possível Excluir o Post {$post->title}");
        return redirect()->route('admin.post.edit', $id);
    }
}
