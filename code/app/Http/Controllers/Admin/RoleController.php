<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use App\Models\Admin\Modulo;
use App\Http\Requests\Role\RoleCreate;

class RoleController extends Controller
{
    private $role;

    public function __construct()
    {
        $this->role = new Role();
    }
    /**
     * ----------------------------------------------------------------------------------
     * Lista todos os registros de role (perfis de usuários)
     *
     * @return void
     */
    public function index()
    {
        $roles = $this->role->all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * ----------------------------------------------------------------------------------
     * Busca um determinado role para mostrar na tela os detalhes do role.
     * @param [int] $id id de um perfil (role)
     * @return metodo view com template show de role
     */
    public function show($id)
    {
        $role = $this->role->find($id);
        return view('admin.role.show', compact('role'));
    }
    /**
     * ----------------------------------------------------------------------------------
     * Busca os dados de um determinado registro de role, para preencher o formulario de
     * edição
     * @param [int] $id identificado de um role
     * @return metodo view com template edit de role
     */
    public function edit($id)
    {
        $modulos = Modulo::all();
        $role = $this->role->find($id);
        return view('admin.role.edit', compact('role', 'modulos'));
    }
    /**
     * ----------------------------------------------------------------------------------
     * Apresenta o formulario de criação com todas entradas necessárias para criação de
     * um registro role
     *
     * @return metodo view com template create de role
     */
    public function create()
    {
        $modulos = Modulo::all();
        return view('admin.role.create', compact('modulos'));
    }

    /**
     * ----------------------------------------------------------------------------------
     * Recupera os dados da requisição, aplica as regras de preenchimento e sanatiza os dados
     * @param RoleCreate $request - Objeto request que sanatiza os dados de rquisição para
     * persistir os novos dados no banco
     * @return metodo redirect para a rota admin.role.edit em caso de sucesso | metodo view
     * com o template create de role, injetando os dados da requisição.
     */
    public function save(RoleCreate $request)
    {
        $dataForm = $request->all();
        $role = Role::create($dataForm);

        if ($role->id) {
            if (isset($request->permission)) {
                $role->permissions()->sync($request->permission);
            }
            session()->flash('success', "Perfil {$role->name} Criado com Sucesso");
            return redirect()->route('admin.role.edit', $role->id);
        }
        $role = $request;
        session()->flash('error', "Erro ao Criar o Perfil {$role->name}");
        return view('admin.role.create', compact('role'));
    }

    /**
     * ----------------------------------------------------------------------------------
     * Busca um registro de role, aplica as alterações e persiste no banco de dados,
     * criando uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param RoleCreate $request - Objeto request que sanatiza os dados da requisição
     * @param [int] $id identificador de um registro role
     * @return metodo redirect para a rota admin.role.edit
     */
    public function update(RoleCreate $request,  $id)
    {
        $role = $this->role->find($id);
        $role->name = $request->name;
        $role->label = $request->label;

        if ($role->save()) {
            if (isset($request->permission)) {
                $role->permissions()->sync($request->permission);
            }
            session()->flash('success', "Perfil {$role->name} Alterado com Sucesso");
        } else {
            session()->flash('error', "Erro ao Alterar o Perfil {$role->name}");
        }
        return redirect()->route('admin.role.edit', $role->id);
    }

    /**
     * ----------------------------------------------------------------------------------
     * Recupera um determinado registro role e delata do banco de dados, criando uma mensagem
     * de sucesso ou erro na sessão da aplição.
     * @param [int] $id - identificador do registro role
     * @return metodo redirect para rota admin.role.index caso sucesso | admin.role.edit em
     * caso de erro
     */
    public function delete($id)
    {
        $role = $this->role->find($id);

        if ($role->delete()) {
            session()->flash('success', "Perfil {$role->name} Excluido com Sucesso");
            return redirect()->route('admin.role.index');
        } else {
            session()->flash('error', "Erro ao Excluir o Perfil {$role->name}");
            return redirect()->route('admin.role.edit', $id);
        }
    }
}
