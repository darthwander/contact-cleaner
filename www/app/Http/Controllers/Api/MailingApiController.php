<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use \Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\MailingApiCreateRequest;
use Illuminate\Http\Request;
use App\Models\Mailing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MailingApiController extends Controller
{

    /**
     * @OA\Info(
     *   title="Mailing API",
     *   version="1.0.0"
     * )
     *
     * @OA\Post(
     *   path="/api/mailing/create",
     *   summary="Endpoint público para envio de carga de mailing",
     *   description="Endpoint to create a new mailing.",
     *   tags={"API PUBLIC"},
     *   security={{"bearerAuth": {}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="description",
     *         type="string",
     *         description="A brief description of the mailing."
     *       ),
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(
     *           type="object",
     *           @OA\Property(property="cod", type="integer", example=111),
     *           @OA\Property(property="name", type="string", example="AAAAAA"),
     *           @OA\Property(
     *             property="phones",
     *             type="array",
     *             @OA\Items(type="string", example="111111111")
     *           )
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Envio de e-mail criado com sucesso",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="object",
     *         @OA\Property(
     *           property="message",
     *           type="string"
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="401",
     *     description="Não autenticado"
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Dados inválidos"
     *   )
     * )
     */
    public function createMailing(MailingApiCreateRequest $request): JsonResponse
    {

        $data = $request->data;

        $filePath = Mailing::createCsvFileName();

        $columnPhoneCount = Mailing::writeCsvMailing($filePath, $data);

        $savedMailing = Mailing::saveChargeMailing($request->description, $columnPhoneCount, $filePath);

        return response()->json([
            'message' => 'Mailing created successfully.',
        ]);
    }
}
