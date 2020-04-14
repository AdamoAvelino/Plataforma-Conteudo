<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Account\AccountCreate;

use App\Models\Admin\Account;
use App\Models\Admin\AccountClass;

class AccountController extends Controller
{
    /**
     * ---------------------------------------------------------------------------
     * Constroi uma lista todos os account
     *
     * @return metodo view com template index de account
     */
    public function index()
    {
    	$accounts = Account::all();
    	return view('admin.account.index', compact('accounts'));
    }

    /**
     * ---------------------------------------------------------------------------
     * Cria a tela para mostrar os detalhes de uma account individual
     *
     * @param [int] $id - identificador do account a ser apresentado
     * @return metodo view com template show de account
     */
    public function show($id)
    {
    	$account = Account::find($id);
    	return view('admin.account.show', compact('account'));
    }
    /**
     * ---------------------------------------------------------------------------
     * Apresenta um formulário com os dados de um account que podem ser alterados.
     * @param [int] $id - identificador do account a ser editado
     * @return metodo view com template edit de account
     */
    public function edit($id)
    {
    	$account = Account::find($id);
    	$account_classes = AccountClass::all();
    	return view('admin.account.edit', compact('account', 'account_classes'));
    }

    /**
     * ---------------------------------------------------------------------------
     * Apresenta um formulário com entradas para criar um account
     * @return metodo view com template create de account com injeção
     * da collection de AccountClass
     */
    public function create()
    {
    	$account_classes = AccountClass::all();
    	return view('admin.account.create', compact('account_classes'));
    }
    /**
     * ---------------------------------------------------------------------------
     * Recolhe os dados da requisição trata e os persiste na base de dados
     * caso tenha sucesso.
     * @param AccountCreate $request - Objeto request que sanatiza os dados de entrada
     * @return metodo de redirecionamento caso criado com sucesso | metodo view com
     * injeção dos dodos de requisição caso tenha dado algum erro.
     */
    public function save(AccountCreate $request)
    {
    	$dataForm = $request->except('_token');
    	$dataForm['user_id'] = auth()->user()->id;
    	$dataForm['active'] = isset($request->active) ? $request->active : 0;
    	$account = Account::create($dataForm);

    	if ($account->id) {
    		session()->flash('success', "Conta {$account->name} Criado com Sucesso");
    		return redirect()->route('admin.account.edit', $account->id);
    	} else {
    		session()->flash('error', "Erro  ao Criar a Conta {$account->name}");
    		$account = $request;
    		return view('admin.account.create', compact('account'));
    	}
    }
    /**
     * ---------------------------------------------------------------------------
     * Recolhe os dados da requisição trata e os persiste na base de dados
     * caso tenha sucesso.
     * @param AccountCreate $request Objeto request que sanatiza os dados de entrada
     * @param [int] $id identificador do account que será atualizado
     * @return metodo de redirecionamento para a rota edit de account
     */
    public function update(AccountCreate $request, $id)
    {
    	$account = Account::find($id);
    	$account->name = $request->name;
    	$account->description = $request->description;
    	$account->account_class_id = $request->account_class_id;
    	$account->active = isset($request->active) ? $request->active : 0;

    	if ($account->save()) {
    		session()->flash('success', "Conta {$account->name} Atualizado com Sucesso");
    	} else {
    		session()->flash('error', "Erro  ao Atualizar a Conta {$account->name}");
    	}

    	return redirect()->route('admin.account.edit', $account->id);
    }
    /**
     * ---------------------------------------------------------------------------
     * Busca o registro de um account e deleta da base de dados alimentando
     * mensagem de erro ou sucesso na sessão da aplicação
     * @param [int] $id identificador do account que será excluido
     * @return metodo de redirecionamento para a rota index de account em
     * caso de sucesso ou para a rota edit de account em caso de erro
     */
    public function delete($id)
    {
    	$account = Account::find($id);

    	if ($account->delete()) {
    		session()->flash('success', "Conta {$account->name} Excluido com Sucesso");
    		return redirect()->route('admin.account.index');
    	}
    	session()->flash('Error', "Não foi Possível Excluir a Conta {$account->name}");
    	return redirect()->route('admin.account.edit', $id);
    }
}
