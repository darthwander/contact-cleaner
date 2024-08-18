<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CompanyApiIndexRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyApiController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/companies/list",
     *   description="Endpoint to list registered companies.",
     *   tags={"API INTERNAL"},
     *   security={{"bearerAuth": {}}},
     *     summary="Listagem de empresas",
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Busca por nome da empresa",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Listagem de empresas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="active", type="boolean"),
     *                 @OA\Property(property="cnpj", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized"
     *     )
     * )
     */
    public function index(CompanyApiIndexRequest $request): JsonResponse
    {
        $companies = (new Company)->list($request);

        return response()->json($companies, 200);
    }
}
