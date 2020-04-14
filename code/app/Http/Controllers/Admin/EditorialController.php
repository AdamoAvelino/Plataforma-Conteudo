<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Editorial;

use App\Http\Requests\Editorial\EditorialCreate;

class EditorialController extends Controller
{
	/**
	 * ----------------------------------------------------------
	 * Recupera uma lista de Editorials e injeta no template de index de Editorial
	 * @return metodo view com template index de editorial
	 * ----------------------------------------------------------
	 */
	public function index()
	{
		$editorials = Editorial::all();
		return view('admin.editorial.index', compact('editorials'));
	}
    /**
     * ----------------------------------------------------------
     * Recupera o registro de uma determinada editorial e injeta no template show
     * de editorial
     * @param  [int] $id identificador do registro editorial
     * @return metodo view com template show de editorial
     */
    public function show($id)
    {
    	$editorial = Editorial::find($id);
    	return view('admin.editorial.show', compact('editorial'));
    }
    /**
     * ----------------------------------------------------------
     * @return metodo view com template create de módulo
     * ----------------------------------------------------------
     */
    public function create()
    {
    	return view('admin.editorial.create');
    }
    /**
     * ----------------------------------------------------------
     * Recupera o registro de uma determinada editorial e injeta no template edit
     * de editorial
     * @param  [int] $id identificador do registro editorial
     * @return metodo view com template edit de editorial
     * ----------------------------------------------------------
     */
    public function edit($id)
    {
    	$editorial = Editorial::find($id);
    	return view('admin.editorial.edit', compact('editorial'));
    }
    /**
     * ----------------------------------------------------------
     * Recupera os dados da requisição, persisti um novo registro
     * no banco de dados e inclui uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param  EditorialCreate $request Objeto request recebe e sanatiza os dados da
     * requisição
     * @return metodo redirect roteando para a rota admin.editorial.edit
     * em caso de sucesso | metodo view com template admin.editorial.create em caso
     * de erro injetando dos dados de requisição
     * ----------------------------------------------------------
     */
    public function save(EditorialCreate $request)
    {
    	$data_form = $request->all();
    	$editorial = Editorial::create($data_form);
    	if($editorial->id) {
    		session()->flash('success', "Editorial {$editorial->name} Criado com Sucesso");
    		return redirect()->route('admin.editorial.show', $editorial->id);
    	}

    	session()->flash('success', "Erro ao Criar a Editorial {$editorial->name}");
    	return view('admin.editorial.create');
    }
    /**
     * ----------------------------------------------------------
     * Recupera os dados da requisição de um registro de
     * editorial altera no banco de dados e inclui uma mensagem de erro ou sucesso
     * na sessão da aplicação.
     * @param  EditorialCreate $request Objeto request recebe e sanatiza os dados da 
     * requisição
     * @param  [int] $id - identificador do registro de editorial
     * @return metodo de redirect roteando para a rota admin.editorial.edit
     * ----------------------------------------------------------
     */
    public function update(EditorialCreate $request, $id)
    {
    	$editorial = Editorial::find($id);
    	$editorial->name = $request->name;

    	if($editorial->save()) {
    		session()->flash('success', "Editorial {$editorial->name} Atualizada com Sucesso");
    	} else {
    		session()->flash('error', "Erro ao Atualiar a Editorial {$editorial->name}");
    	}
    	return redirect()->route('admin.editorial.edit', $id);
    }
    /**
     * ----------------------------------------------------------
     * Recupera um determinado registro de editorial e delata da base de dados.
     * Cria uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param  [type] $id - identificador do registro de editorial
     * @return [type] metodo redirect roteando para rota admin.editorial.index caso de
     * sucesso | rotea para a rota admin.editorial.edit em caso de erro
     * ----------------------------------------------------------
     */
    public function delete($id)
    {
    	$editorial = Editorial::find($id);

    	if($editorial->delete()) {
    		session()->flash('success', "Editorial {$editorial->name} Excluida com Sucesso");
    		return redirect()->route('admin.editorial.index');
    	}

    	session()->flash('error', "Erro ao Excluir Editorial {$editorial->name}");
    	return redirect()->route('admin.editorial.edit', $id);
    }
}
