<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Status;

class StatusController extends Controller
{
    /**
	 * ---------------------------------------------------------------------
	 * Recupera uma lista de statuses e injeta no temlate de index de Status
	 * @return metodo view com template index de status
	 * ---------------------------------------------------------------------
	 */
    public function index()
    {
    	$statuses = Status::all();
    	return view('admin.status.index', compact('statuses'));
    }
	/**
	 * ---------------------------------------------------------------------
	 * Recupera o registro de uma determinada status e injeta no template show
     * de status
	 * @param  [int] $id identificador do registro status
	 * @return [type] metodo view com template show de status
	 * ---------------------------------------------------------------------
	 */
	public function show($id)
	{
		$status = Status::find($id);
		return view('admin.status.show', compact('status'));
	}

	/**
	 * ---------------------------------------------------------------------
	 * Recupera o registro de uma determinada status e injeta no template edit
     * de status
	 * @param  [id] $id - identificador do registro status
	 * @return metodo view com template edit de status
	 * ---------------------------------------------------------------------
	 */
	public function edit($id)
	{
		$status = Status::find($id);
		return view('admin.status.edit', compact('status'));
	}
	/**
	 * ---------------------------------------------------------------------
	 * @return metodo view com template create de módulo
	 * ---------------------------------------------------------------------
	 */
	public function create()
	{
		return view('admin.status.create');
	}

	/**
	 * ---------------------------------------------------------------------
	 * [Recupera os dados da requisição de um registro de
     * status altera no banco de dados e inclui uma mensagem de erro ou sucesso
     * na sessão da aplicação.
     * @param Request $request - Objeto request
     * @param [int] $id identificador do registro de modulo
     * @return metodo de redirect roteando para a rota admin.status.edit
	 * ---------------------------------------------------------------------
	 */
	public function update(Request $request, $id)
	{
		$status = Status::find($id);
		$status->name = $request->name;

		if($status->save()) {
			session()->flash('success', "Categoria {$status->name} Atualizada com Sucesso");
		} else {
			session()->flash('error', "Erro ao Atualiar a Categoria {$status->name}");
		}
		return redirect()->route('admin.status.edit', $id);
	}
	/**
	 * ---------------------------------------------------------------------
	 * Recupera os dados da requisição, persisti um novo registro
     * no banco de dados e inclui uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param Request $request Objeto request
     * @return @return metodo de redirect roteando para a rota admin.status.edit
     * em caso de sucesso | metodo view com template admin.status.create em caso
     * de erro intetando dos dados de requisição
	 * ---------------------------------------------------------------------
	 */
	public function save(Request $request)
	{
		$data_form = $request->all();
		$status = Status::create($data_form);
		if($status->id) {
			session()->flash('success', "Categoria {$status->name} Criado com Sucesso");
			return redirect()->route('admin.status.show', $status->id);
		}

		session()->flash('success', "Erro ao Criar a Categoria {$status->name}");
		return view('admin.status.create');

	}
	/**
	 * ---------------------------------------------------------------------
	 * Recupera um determinado registro de status e delata da base de dados.
     * Cria uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param [int] $id identificador do registro de status
     * @return metodo redirect roteando para rota admin.status.index caso de
     * sucesso | rotea para a rota admin.status.edit em caso de erro
	 * ---------------------------------------------------------------------
	 */
	public function delete($id)
	{
		$status = Status::find($id);

		if($status->delete()) {
			session()->flash('success', "Categoria {$status->name} Excluida com Sucesso");
			return redirect()->route('admin.status.index');
		}

		session()->flash('error', "Erro ao Excluir Categoria {$status->name}");
		return redirect()->route('admin.status.edit', $id);
	}
}
