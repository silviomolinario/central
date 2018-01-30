<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/api/cliente-store',
        '/api/cliente-update',
        '/api/produto-update',
        '/central/cheque/chequevinculo/*',
        '/central/cheque/readerstore',
        '/central/cheque/getStoreClientes',
        '/central/cheque/getClienteSellerCheck',
        '/central/cheque/get-by-cmc7',
    ];
}
