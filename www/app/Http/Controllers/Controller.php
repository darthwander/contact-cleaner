<?php

namespace App\Http\Controllers;


/**
     * @OA\Info(
     *     version="1.0.0",
     *     title="Contact Cleaner",
     *     description="Esta é a documentação da API Contact Cleaner.",
     *     @OA\Contact(
     *         email="wander.araujo@maisvois.com.br"
     *     ),
     *     @OA\License(
     *         name="MIT",
     *         url="https://opensource.org/licenses/MIT"
     *     )
     * )
     */
    /**
     * @OA\SecurityScheme(
     *     securityScheme="bearerAuth",
     *     type="http",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     description="Enter your Bearer token below:"
     * )
     */
abstract class Controller
{

}
