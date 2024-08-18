<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyIndexRequest;
use Illuminate\View\View;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\User;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminCompanyList(CompanyIndexRequest $request): View
    {
        $companies = (new Company)->list($request);

        return view('company.list', compact('companies'));
    }

    /**
     * Exibe formulário para criação de nova empresa.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Armazena uma nova empresa no banco de dados.
     */
    public function store(CompanyStoreRequest $request)
    {
        try {
            $company = Company::create($request->validated());

            return response()->json([
                'msg' => "Usuário <a href='/admin/companies/{$company->id}'>{$company->name}</a> foi Cadastrado com Sucesso!",
                'status' => 'success'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'msg' => "Ocorreu um erro",
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Exibe formulário para criação de nova empresa. | Exibe os dados de uma empresa cadastrada.
     */
    public function show(string $id)
    {

        $company = Company::findOrFail($id);

        return view('company.open', compact('company'));
    }

    /**
     * Atualiza uma empresa.
     */
    public function update(CompanyUpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $company = Company::findOrFail((int) $id);

        $company->name = $request->input('name', $company->name);
        $company->cnpj = $request->input('cnpj', $company->cnpj);
        $company->webhook_url = $request->input('webhook_url', $company->webhook_url);
        $company->api_token = $request->input('api_token', $company->api_token);
        $company->active = $request->input('active', $company->active);
        $company->only_200 = $request->input('only_200', $company->only_200);
        $company->only_200_wp = $request->input('only_200_wp', $company->only_200_wp);
        $company->code_487 = $request->input('code_487', $company->code_487);
        $company->code_487_wp = $request->input('code_487_wp', $company->code_487_wp);
        $company->delete_only_404 = $request->input('delete_only_404', $company->delete_only_404);
        $company->save();

        return redirect()
            ->intended(route('admin.company.open', $company->id))
            ->with('toastr', [
                'msg'=>"Empresa {$company->name} atualizada!",
                'status'=>'success'
            ]);
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
            $company = Company::findOrFail($id);
            $company->delete();

            return redirect()
                ->intended(route('admin.company.list'))
                ->with('toastr', [
                    'msg'=>"Usuário removido com sucesso!",
                    'status'=>'success'
                ]);
        } catch (\Exception $e) {
            return redirect()
                ->intended(route('admin.company.list'))
                ->with('toastr', [
                    'msg'=>"Ocorreu um erro ao remover o usuário.",
                    'status'=>'error'
                ]);
        }
    }

    public function renewToken(int $id): void
    {
        $company = Company::findOrFail($id);

        $newToken = Str::random(60);

        $company->api_token = $newToken;

        $company->save();
    }

    /**
     * Verify the API token for a company.
     */
    public function verifyToken(int $id): bool
    {
        $company = Company::findOrFail($id);

        $receivedToken = $request->input('api_token');

        return $receivedToken === $company->api_token;
    }

    public function userList(Request $request, int $company_id): View
    {
        $users = (new User)->listByCompany($request, $company_id);

        $company = Company::findOrFail($company_id);

        return view('company.users.list', compact('users', 'company'));
    }
}
