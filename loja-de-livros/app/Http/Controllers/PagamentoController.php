<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isEmpty;

class PagamentoController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'nome' => 'required',
                'sobrenome' => 'required',
                'documento' => 'required',
                'endereco' => 'required',
                'complemento' => 'required',
                'cidade' => 'required',
                'pais_id' => 'required',
                'telefone' => 'required',
                'cep' => 'required',
            ]);

            /**
             * @var $pais Pais
             */
            $pais = Pais::find($request->input('pais_id'));

            if (isEmpty($pais->getEstados())) {
                $request->validate([
                    'estado_id' => 'required',
                ]);
            }

            return response()->json(['pagamento_primeira_etapa' => $request->all()], 200);
        } catch (\Exception $exception) {
            return new JsonResponse(['Mensagem' => $exception->getMessage()], 400);
        }

    }
}
