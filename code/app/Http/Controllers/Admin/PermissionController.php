<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;
use App\Models\Admin\Modulo;
use App\Http\Requests\Permission\PermissionCreate;

class PermissionController extends Controller
{
    private $permission;
    public function __construct()
    {
        $this->permission = new Permission;
    }
    /**
     * -----------------------------------------------------------------------------
     * Recupera uma lista de permissões e injeta no temlate de index de Permission
     * @return metodo view com template index de permission
     * -----------------------------------------------------------------------------
     */
    public function index()
    {
        $permissions = $this->permission->all();
        return view('admin.permission.index', compact('permissions'));
    }
    /**
     * -----------------------------------------------------------------------------
     * Recupera o registro de uma determinada permissão e injeta no template show
     * de permission
     * @param [int] $id - identificador do registro permission
     * @return metodo view com template show de permission
     * -----------------------------------------------------------------------------
     */
    public function show($id)
    {
        $permission = $this->permission->find($id);
        return view('admin.permission.show', compact('permission'));
    }
    /**
     * -----------------------------------------------------------------------------
     * Recupera o registro de uma determinada permissão e injeta no template edit
     * de permission
     * @param [int] $id - identificador do registro permission
     * @return metodo view com template edit de permission
     * -----------------------------------------------------------------------------
     */
    public function edit($id)
    {
        $modulos = Modulo::all();
        // dd($modulos);
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission', 'modulos'));
    }
    /**
     * -----------------------------------------------------------------------------
     * @return metodo view com template create de permission
     * -----------------------------------------------------------------------------
     */
    public function create()
    {
        $modulos = Modulo::all();
        return view('admin.permission.create', compact('modulos'));
    }
    /**
     * -----------------------------------------------------------------------------
     * Recupera dos dados enviados da requisição e um registro de uma determinada
     * permissão. Sanatiza a Requisição para persistir a alterasção no banco de dados
     * e inclui uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param PermissionCreate $request - Objeto request que santiza os dados da
     * requisição antes da persistencia
     * @param [int] $id identificador do registro de permission
     * @return metodo de redirect roteando para a rota admin.permission.edit
     * -----------------------------------------------------------------------------
     */
    public function update(PermissionCreate $request, $id)
    {
        $permission = $this->permission->find($id);
        $permission->name = $request->name;
        $permission->label = $request->label;
        $permission->modulo_id = $request->modulo_id;
        if ($permission->save()) {
            session()->flash('success', "Permissão {$permission->name} Atualizado com Sucesso");
        } else {
            session()->flash('error', "Erro ao Atualizar Permissão {$permission->name}");
        }
        return redirect()->route('admin.permission.edit', $id);
    }

    /**
     * -----------------------------------------------------------------------------
     * Recupera os dados enviados da requisição, sanatiza para persistir um novo registro
     * no banco de dados e inclui uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param PermissionCreate $request Objeto request que santiza os dados da
     * requisição antes da persistencia
     * @return @return metodo de redirect roteando para a rota admin.permission.edit
     * em caso de sucesso | metodo view com template admin.permission.create em caso
     * de erro intetando dos dados de requisição
     * -----------------------------------------------------------------------------
     */
    public function save(PermissionCreate $request)
    {
        $dataForm = $request->all();
        $permission = $this->permission->create($dataForm);
        if ($permission->id) {
            session()->flash('success', "Permissão {$permission->name} Criada com Sucesso");
            return redirect()->route('admin.permission.edit', $permission->id);
        }
        session()->flash('error', "Erro ao Criar a Permissão {$permission->name}");
        $permission = $request;
        return view('admin.permission.create', 'permission');
    }

    /**
     * -----------------------------------------------------------------------------
     * Recupera um determinado registro de permission e delata da base de dados.
     * Cria uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param [int] $id identificador do registro de permission
     * @return metodo redirect roteando para rota admin.permission.index caso de
     * sucesso | rotea para a rota admin.permission.edit em caso de erro
     * -----------------------------------------------------------------------------
     */
    public function delete($id)
    {
        $permission = $this->permission->find($id);

        if ($permission->delete()) {
            session()->flash('success', "Permissão {$permission->name} Excluida com Sucesso");
            return redirect()->route('admin.permission.index');
        }
        session()->flash('error', "Erro ao Excluir a Permissão {$permission->name}");
        return redirect()->route('admin.permission.edit', $id);
    }
}
