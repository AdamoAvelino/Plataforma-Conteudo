<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Post;
use App\Models\Admin\Category;
use App\Models\Admin\Status;

use App\Models\Admin\Account;
use App\Models\Admin\AccountClass;
use App\Models\Admin\Produce;
use App\Models\Admin\Editorial;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Admin\Modulo;
use App\User;

use Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * Para verificação de autorização por usuário
     */
    public function index()
    {
        $posts  = Post::count();
        $roles  = Role::count();
        $users  = User::count();
        $categorys  = Category::count();
        $permissions = Permission::count();
        return view('home', compact('posts', 'roles', 'users', 'permissions', 'categorys'));
    }

    public function showPost($id)
    {
        $post = Post::find($id);
        //Lança uma excessão
        // $this->authorize('show-post', $post);
        // if (Gate::denies('view_post', $post)) {
        //     abort(403, 'Não Autorizado');
        // }
        // return view('politica_usuario.show-post', compact('post'));
    }

    public function permissionDebug()
    {
        $user = auth()->user();

        echo "<h1>Name: {$user->name} (ID: {$user->id})</h1>";

        foreach ($user->roles as $role) {
            echo "<h2>Perfil: {$role->name} (ID: {$role->id})</h2>";
            echo "<ul>";
            foreach ($role->permissions as $permission) {
                echo "<li>";
                echo "{$permission->name} (ID: {$permission->id})";
                echo "</li>";
            }
            echo "</ul>";
        }
        echo "<hr>";
        var_dump(Gate::allows('view_post'));
    }

    public function sections($name)
    {

        return $this->$name();
    }

    private function usuario()
    {
        $roles  = Role::count();
        $users  = User::count();
        $permissions = Permission::count();
        $modulos = Modulo::count();
        return view("admin.sections.usuario"
            , compact('roles', 'users', 'permissions', 'modulos')
        );
    }

    private function post()
    {
        $posts  = Post::count();
        $categorys  = Category::count();
        $statuses  = Status::count();
        return view("admin.sections.post"
            , compact('posts', 'categorys', 'statuses')
        );
    }

    private function account()
    {
        $accounts  = Account::count();
        $account_classes  = AccountClass::count();
        $produces  = Produce::count();
        $editorials  = Editorial::count();
        return view("admin.sections.account"
            , compact('accounts', 'account_classes', 'produces', 'editorials')
        );
    }
}
