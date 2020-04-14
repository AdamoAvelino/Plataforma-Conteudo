<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
	/**
	 * ---------------------------------------------------------------------
	 * Recupera uma lista de categorys e injeta no temlate de index de Category
	 * @return metodo view com template index de category
	 * ---------------------------------------------------------------------
	 */
	public function index()
	{
		$categorys = Category::all();
		return view('admin.category.index', compact('categorys'));
	}
	/**
	 * ---------------------------------------------------------------------
	 * Recupera o registro de uma determinada category e injeta no template show
     * de category
	 * @param  [int] $id identificador do registro category
	 * @return metodo view com template show de category
	 * ---------------------------------------------------------------------
	 */
	public function show($id)
	{
		$category = Category::find($id);
		return view('admin.category.show', compact('category'));
	}

	/**
	 * ---------------------------------------------------------------------
	 * Recupera o registro de uma determinada category e injeta no template edit
     * de category
	 * @param  [id] $id - identificador do registro category
	 * @return metodo view com template edit de category
	 * ---------------------------------------------------------------------
	 */
	public function edit($id)
	{
		$category = Category::find($id);
		return view('admin.category.edit', compact('category'));
	}
	/**
	 * ---------------------------------------------------------------------
	 * @return metodo view com template create de category
	 * ---------------------------------------------------------------------
	 */
	public function create()
	{
		return view('admin.category.create');
	}

	/**
	 * ---------------------------------------------------------------------
	 * Recupera os dados da requisição de um registro de
     * category altera no banco de dados e inclui uma mensagem de erro ou sucesso
     * na sessão da aplicação.
     * @param Request $request - Objeto request recebe e sanatiza os dados da 
     * requisição
     * @param [int] $id identificador do registro de category
     * @return metodo de redirect roteando para a rota admin.category.edit
	 * ---------------------------------------------------------------------
	 */
	public function update(Request $request, $id)
	{
		$category = Category::find($id);
		$category->name = $request->name;

		if($category->save()) {
			session()->flash('success', "Categoria {$category->name} Atualizada com Sucesso");
		} else {
			session()->flash('error', "Erro ao Atualiar a Categoria {$category->name}");
		}
		return redirect()->route('admin.category.edit', $id);
	}
	/**
	 * ---------------------------------------------------------------------
	 * Recupera os dados da requisição, persisti um novo registro
     * no banco de dados e inclui uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param Request $request Objeto request
     * @return metodo de redirect roteando para a rota admin.category.edit
     * em caso de sucesso | metodo view com template admin.category.create em caso
     * de erro injetando dos dados de requisição
	 * ---------------------------------------------------------------------
	 */
	public function save(Request $request)
	{
		$data_form = $request->all();
		$category = Category::create($data_form);
		if($category->id) {
			session()->flash('success', "Categoria {$category->name} Criado com Sucesso");
			return redirect()->route('admin.category.show', $category->id);
		}

		session()->flash('success', "Erro ao Criar a Categoria {$category->name}");
		return view('admin.category.create');

	}
	/**
	 * ---------------------------------------------------------------------
	 * Recupera um determinado registro de category e delata da base de dados.
     * Cria uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param [int] $id identificador do registro de category
     * @return metodo redirect roteando para rota admin.category.index caso de
     * sucesso | rotea para a rota admin.category.edit em caso de erro
	 * ---------------------------------------------------------------------
	 */
	public function delete($id)
	{
		$category = Category::find($id);

		if($category->delete()) {
			session()->flash('success', "Categoria {$category->name} Excluida com Sucesso");
			return redirect()->route('admin.category.index');
		}

		session()->flash('error', "Erro ao Excluir Categoria {$category->name}");
		return redirect()->route('admin.category.edit', $id);
	}
}
