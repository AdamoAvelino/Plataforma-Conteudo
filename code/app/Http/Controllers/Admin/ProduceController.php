<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Produce;
use App\Http\Requests\Produce\ProduceCreate;

class ProduceController extends Controller
{
    /**
     * Lista todos os Produces cadastrados
     *
     * @return metodo view para apresentação do template de index de Produce
     */
    public function index()
    {
    	$produces = Produce::all();
    	return view('admin.produce.index', compact('produces'));
    }

    /**
     * ------------------------------------------------------------------------
     * Apresenta os detalhes do Produce
     *
     * @param [int] $id identificador de produce
     * @return metodo view para apresentação do template de show de Produce
     */
    public function show($id)
    {
    	$produce = Produce::find($id);
    	return view('admin.produce.show', compact('produce'));
    }
    /**
     * ------------------------------------------------------------------------
     * Lança uma registro de Produce para o formulario de edição
     *
     * @param [int] $id identificador de Produce
     * @return metodo view para apresentação do template de edit de Produce
     */
    public function edit($id)
    {
    	$produce = Produce::find($id);
    	return view('admin.produce.edit', compact('produce'));
    }

    /**
     * ------------------------------------------------------------------------
     * Apresenta o formulário para registro de um novo Produce
     *
     * @return metodo view para apresentação do template create de produce
     */
    public function create()
    {
    	return view('admin.produce.create');
    }

    /**
     * ------------------------------------------------------------------------
     * Cria um registro de Produce com os dados vindo da requisição.
     *
     * @param ProduceCreate $request - Classe request que sanatiza os dados de requisição
     * @return metodo de redirecionamento para a rota admin.produce.edit em caso de sucesso |
     * metodo view para o template cretae de Produces com injeção do request em caso de erro.
     */
    public function save(ProduceCreate $request)
    {
    	$dataForm = $request->except('_token');

    	$produce = Produce::create($dataForm);
        $users[] = auth()->user()->id;

    	if ($produce->id) {
            $produce->users()->sync($users);
    		$request->session()->flash('success', "Produtora {$dataForm['name']} Cadastrado com Sucesso");
    		return redirect()->route('admin.produce.edit', compact('produce'));
    	}

    	$request->session()->flash('error', "Erro ao Cadastrar o Produtora {$dataForm['name']}");
    	$produce = $request;
    	return view('admin.produce.create', compact('produce'));
    }

    /**
     * ------------------------------------------------------------------------
     * Atualiza um Produce persistindo os dados que vem da requisição
     *
     * @param ProduceCreate $request - Classe request que sanatiza os dados de requisição
     * @param [int] $id - Identificador de Produce que sofrerá alteração do registro
     * @return metodo de redirecionamento para a rota admin.produce.edit
     */
    public function update(ProduceCreate $request, $id)
    {
        // dd($request);
    	$produce = Produce::find($id);

    	$produce->name = $request->name;
        $produce->cnpj = $request->cnpj;
    	$produce->email = $request->email;
    	$produce->telephone = $request->telephone;
    	if ($produce->save()) {
    		$request->session()->flash('success', "Produtora {$produce->name} Atualizado com Sucesso");
    	} else {
    		$request->session()->flash('error', "Erro ao Cadastrar o Produtora {$produce->name}");
    	}
    	return redirect()->route('admin.produce.edit', compact('produce'));
    }
    /**
     * ---------------------------------------------------------------------------
     * Busca o registro de um Produce e deleta da base de dados
     * @param [int] $id Identificador do produce que será excluido
     * @return metodo de redirecionamento para admin.produce.edit em caso de erro ou
     * redirecionamento para a rota admin.produce.index em caso de sucesso
     */
    public function delete($id)
    {
    	$produce = Produce::find($id);
    	if ($produce->delete()) {
    		session()->flash('success', "Produtora {$produce->name} Excluido com Sucesso");
    		return redirect()->route('admin.produce.index');
    	}
    	session()->flash('Error', "Não foi Possível Excluir o Produtora {$produce->name}");
    	return redirect()->route('admin.produce.edit', $id);
    }
}
