<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Modulo\ModuloCreate;
use App\Models\Admin\Modulo;

class ModuloController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Modulo();
    }

    /**
     * ----------------------------------------------------------------------------------------------
     * Recupera uma lista de modulos e injeta no temlate de index de Modulos
     * @return metodo view com template index de modulo
     * ----------------------------------------------------------------------------------------------
     */
    public function index()
    {
        $modulos = $this->model->all();
        return view('admin.modulo.index', compact('modulos'));
    }
    /**
     * ----------------------------------------------------------------------------------------------
     * Recupera o registro de um determinado módulo e injeta no template show
     * de modulo
     * @param [int] $id - identificador do registro módulo
     * @return metodo view com template show de módulo
     * -----------------------------------------------------------------------------
     */
    public function show($id)
    {
        $modulo = $this->model->find($id);
        return view('admin.modulo.show', compact('modulo'));
    }
    /**
     * -----------------------------------------------------------------------------
     * @return metodo view com template create de módulo
     * -----------------------------------------------------------------------------
     */
    public function create()
    {
        return view('admin.modulo.create');
    }
    /**
     * ----------------------------------------------------------------------------------------------
     * Recupera o registro de uma determinado módulo e injeta no template edit
     * de módulo
     * @param [int] $id - identificador do registro módulo
     * @return metodo view com template edit de módulo
     * ----------------------------------------------------------------------------------------------
     */
    public function edit($id)
    {
        $modulo = $this->model->find($id);
        return view('admin.modulo.edit', compact('modulo'));
    }

    /**
     * ----------------------------------------------------------------------------------------------
     * Recupera os dados enviados da requisição, sanatiza para persistir um novo registro
     * no banco de dados e inclui uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param ModuloCreate $request Objeto request que santiza os dados da
     * requisição antes da persistencia
     * @return @return metodo de redirect roteando para a rota admin.modulo.edit
     * em caso de sucesso | metodo view com template admin.modulo.create em caso
     * de erro intetando dos dados de requisição
     * -----------------------------------------------------------------------------
     */
    public function save(ModuloCreate $request)
    {
        $dataForm = $request->all();

        $modulo = $this->model->create($dataForm);
        if ($modulo->id) {
            session()->flash('success', "Modulo {$modulo->name} Criado com Sucesso");
            return redirect()->route('admin.modulo.edit', $modulo->id);
        }
        session()->flash('error', "Erro ao Criar o Modulo");
        return view('admin.modulo.create');
    }

    /**
     * ----------------------------------------------------------------------------------------------
     * Recupera dos dados enviados da requisição e um registro de um determinado
     * módulo. Sanatiza a Requisição para persistir a alterasção no banco de dados
     * e inclui uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param ModuloCreate $request - Objeto request que santiza os dados da
     * requisição antes da persistencia
     * @param [int] $id identificador do registro de modulo
     * @return metodo de redirect roteando para a rota admin.modulo.edit
     * -----------------------------------------------------------------------------
     */
    public function update(ModuloCreate $request, $id)
    {
        $modulo = $this->model->find($id);
        $modulo->name = $request->name;
        $modulo->description = $request->description;
        if ($modulo->save()) {
            session()->flash('success', "Modulo {$modulo->name} Atualizado com Sucesso");
        } else {
            session()->flash('error', "Erro ao Atualizar o Modulo {$modulo->name}");
        }
        return redirect()->route('admin.modulo.edit', $id);
    }
    /**
     * ----------------------------------------------------------------------------------------------
     * Recupera um determinado registro de modulo e delata da base de dados.
     * Cria uma mensagem de erro ou sucesso na sessão da aplicação.
     * @param [int] $id identificador do registro de modulo
     * @return metodo redirect roteando para rota admin.modulo.index caso de
     * sucesso | rotea para a rota admin.modulo.edit em caso de erro
     * -----------------------------------------------------------------------------
     */
    public function delete($id)
    {
        $modulo = $this->model->find($id);
        if ($modulo->delete()) {
            session()->flash('success', "Modulo {$modulo->name} Excluído com Sucesso");
            return redirect()->route('admin.modulo.index');
        }
        session()->flash('error', "Erro ao Excluir o Módulo {$modulo->name}");
        return redirect()->route('admin.modulo.edit', $id);
    }
}
