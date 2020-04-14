<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\AccountClass;

use App\Http\Requests\Account\AccountClassRequest;

class AccountClassController extends Controller
{
    /**
	 * ---------------------------------------------------------------------
	 * Recupera uma lista de account_class e injetar no temlate de index de AccountClass
	 * @return metodo view com template index de account_class
	 * ---------------------------------------------------------------------
	 */
	public function index()
	{
		$account_classes = AccountClass::all();
		return view('admin.account_class.index', compact('account_classes'));
	}
	/**
	 * ---------------------------------------------------------------------
	 * Recupera o registro de uma determinada account_class e injeta no template show
     * de account_class
	 * @param  [int] $id identificador do registro account_class
	 * @return [type] metodo view com template show de account_class
	 * ---------------------------------------------------------------------
	 */
	public function show($id)
	{
		$account_class = AccountClass::find($id);
		return view('admin.account_class.show', compact('account_class'));
	}

	/**
	 * ---------------------------------------------------------------------
	 * Recupera o registro de uma determinada account_class e injeta no template edit
     * de account_class
	 * @param  [id] $id - identificador do registro account_class
	 * @return metodo view com template edit de account_class
	 * ---------------------------------------------------------------------
	 */
	public function edit($id)
	{
		$account_class = AccountClass::find($id);
		return view('admin.account_class.edit', compact('account_class'));
	}
	/**
	 * ---------------------------------------------------------------------
	 * @return metodo view com template create de account_class
	 * ---------------------------------------------------------------------
	 */
	public function create()
	{
		return view('admin.account_class.create');
	}

	/**
	 * ---------------------------------------------------------------------
	 * [Recupera os dados da requisição de um registro de
     * account_class, altera no banco de dados e inclui uma mensagem de erro ou sucesso
     * na sessão da aplicação.
     * @param AccountClassRequest $request - Objeto request
     * @param [int] $id identificador do registro de account_class
     * @return metodo de redirect roteando para a rota admin.account_class.edit
	 * ---------------------------------------------------------------------
	 */
	public function update(AccountClassRequest $request, $id)
	{
		$account_class = AccountClass::find($id);
		$account_class->name = $request->name;
		$account_class->description = $request->description;

		if($account_class->save()) {
			session()->flash('success', "Classe de Conta {$account_class->name} Atualizada com Sucesso");
		} else {
			session()->flash('error', "Erro ao Atualiar a Classe de Conta {$account_class->name}");
		}
		return redirect()->route('admin.account_class.edit', $id);
	}
	/**
	 * ---------------------------------------------------------------------
	 * Recupera os dados da requisição, persisti um novo registro
     * no banco de dados e inclui uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param AccountClassRequest $request Objeto request
     * @return metodo de redirect roteando para a rota admin.account_class.edit
     * em caso de sucesso | metodo view com template admin.account_class.create em caso
     * de erro injetando dos dados de requisição
	 * ---------------------------------------------------------------------
	 */
	public function save(AccountClassRequest $request)
	{
		$data_form = $request->all();
		$account_class = AccountClass::create($data_form);
		if($account_class->id) {
			session()->flash('success', "Classe de Conta {$account_class->name} Criado com Sucesso");
			return redirect()->route('admin.account_class.show', $account_class->id);
		}

		session()->flash('success', "Erro ao Criar a Classe de Conta {$account_class->name}");
		return view('admin.account_class.create');

	}
	/**
	 * ---------------------------------------------------------------------
	 * Recupera um determinado registro de account_class e deleta da base de dados.
     * Cria uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param [int] $id identificador do registro de account_class
     * @return metodo redirect roteando para rota admin.account_class.index caso de
     * sucesso | rotea para a rota admin.account_class.edit em caso de erro
	 * ---------------------------------------------------------------------
	 */
	public function delete($id)
	{
		$account_class = AccountClass::find($id);

		if($account_class->delete()) {
			session()->flash('success', "Classe de Conta {$account_class->name} Excluida com Sucesso");
			return redirect()->route('admin.account_class.index');
		}

		session()->flash('error', "Erro ao Excluir Classe de Conta {$account_class->name}");
		return redirect()->route('admin.account_class.edit', $id);
	}
}
