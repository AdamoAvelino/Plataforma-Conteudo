<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreate;
use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Produce;

class UserController extends Controller
{
    /**
     * Lista todos os usuários cadastrados
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        if ($users->count($users) == 1) {
            return $this->show($users[0]->id);
        }
         
        return view('admin.user.index', compact('users'));
    }

    /**
     * ------------------------------------------------------------------------
     * Apresenta os detalhes dos usuários
     *
     * @param [int] $id
     * @return metodo view para apresentação do template de show de usuários
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * ------------------------------------------------------------------------
     * Lança uma registro do usuário para o formulario de edição
     *
     * @param [int] $id id de identificação do usuário
     * @return metodo view para apresentação do template de edit de usuários
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $produces = false;
        if (auth()->user()->hasManyRules('Root')) {
            $produces = Produce::all();
        } elseif (auth()->user()->hasManyRules('Revisor') or auth()->user()->hasManyRules('Coordenador') or auth()->user()->hasManyRules('Admin')) {
            $produces = auth()->user()->produces;
        }
        return view('admin.user.edit', compact('user', 'roles', 'produces'));
    }

    /**
     * ------------------------------------------------------------------------
     * Apresenta o formulário para registro de um novo usuário
     *
     * @return metodo view para apresentação do template create de usuarios
     */
    public function create()
    {
        $roles = Role::all();

        $produces = false;
        if (auth()->user()->hasManyRules('Root')) {
            $produces = Produce::all();
        } elseif (auth()->user()->hasManyRules('Revisor') or auth()->user()->hasManyRules('Coordenador')) {
            $produces = auth()->user()->produces;
        }

        return view('admin.user.create', compact('roles', 'produces'));
    }

    /**
     * ------------------------------------------------------------------------
     * Cria um registro de usuário com os dados vindo da requisição.
     *
     * @param UserCreate $request - Classe request que sanatiza os dados de requisição
     * @return metodo de redirecionamento para a rota admin.user.edit em caso de sucesso |
     * metodo view para o template cretae de usuários com injeção do rquest.
     */
    public function save(UserCreate $request)
    {
        $dataForm = $request->except('_token');
        $dataForm['active'] = 1;
        if ($request->hasFile('photo')) {
            $dataForm['photo'] = $request->photo->store('public');
        }

        if ($request->password and $request->password === $request->confirm_password) {
            $dataForm['password'] = bcrypt($dataForm['password']);

            $user = User::create($dataForm);
            if ($user->id) {
                if (isset($request->perfis)) {
                    $user->roles()->sync($request->perfis);
                }
                if (isset($request->produces)) {
                    $user->produces()->sync($request->produces);
                }
                $request->session()->flash('success', "Usuário {$dataForm['name']} Cadastrado com Sucesso");
                return redirect()->route('admin.user.edit', compact('user'));
            }
        }

        $request->session()->flash('error', "Erro ao Cadastrar o Usuário {$dataForm['name']}");
        $user = $request;
        return view('admin.user.create', compact('user'));
    }

    /**
     * ------------------------------------------------------------------------
     * Atualiza um usuário persistindo os dados que vem da requisição
     *
     * @param UserCreate $request - Classe request que sanatiza os dados de requisição
     * @param [int] $id - do usuário que sofrerá alteração do registro
     * @return metodo de redirecionamento para a rota admin.user.edit
     */
    public function update(UserCreate $request, $id)
    {
        // dd($request);
        $user = User::find($id);
        if ($request->hasFile('photo')) {
            $user->photo = $request->photo->store('public');
        }
        $user->active = isset($request->active) ? $request->active : 0;
        $user->name = $request->name;
        // $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->cnpj = $request->cnpj;
        $user->telephone = $request->telephone;
        if ($user->save()) {
            if (isset($request->perfis)) {
                $user->roles()->sync($request->perfis);
            }

            $user->produces()->sync($request->produces);

            $request->session()->flash('success', "Usuário {$user->name} Atualizado com Sucesso");
        } else {
            $request->session()->flash('error', "Erro ao Cadastrar o Usuário {$user->name}");
        }
        return redirect()->route('admin.user.edit', compact('user'));
    }

    /**
     * ---------------------------------------------------------------------------
     * Busca o registro de um usuário e deleta da base de dados
     * @param [int] $id id do user que será excluido
     * @return metodo de redirecionamento para admin.user.edit
     */
    public function delete($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            session()->flash('success', "Usuário {$user->name} Excluido com Sucesso");
            return redirect()->route('admin.user.index');
        }
        session()->flash('Error', "Não foi Possível Excluir o Usuário {$user->name}");
        return redirect()->route('admin.user.edit', $id);
    }
}
