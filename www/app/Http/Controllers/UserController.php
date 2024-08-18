<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function destroy(string $id)
    {
        if (!$id) {
            return redirect()
                ->intended(route('admin.company.list'))
                ->with('toastr', [
                    'msg'=>"Erro: ID não informado.",
                    'status'=>'error'
                ]);
        }

        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()
                ->intended(route('admin.company.users', $user->company_id))
                ->with('toastr', [
                    'msg'=>"Usuário removido com sucesso!",
                    'status'=>'success'
                ]);
        } catch (\Exception $e) {
            return redirect()
                ->intended(route('admin.company.list'))
                ->with('toastr', [
                    'msg'=>$e->getMessage(),
                    'status'=>'error'
                ]);
        }
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('company.users.open', compact('user'));
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $request['password'] = bcrypt($request['password']);
            $user = User::create($request->validated());

            return response()->json([
                'msg' => "Usuário <a href='/admin/user/{$user->id}'>{$user->name}</a> foi Cadastrado com Sucesso!",
                'status' => 'success'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'msg' => "Ocorreu um erro",
                'status' => 'error'
            ], 500);
        }
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $user = User::findOrFail($id);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->active = $validatedData['active'];
        $user->save();

        return redirect()
            ->intended(route('admin.user.open', $user->id))
            ->with('toastr', [
                'msg'=>"Cadastro de {$user->name} atualizado!",
                'status'=>'success'
            ]);
    }
}
