<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\CompraItem;
use App\Models\Livro;
use App\Models\Pais;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\throwException;

class CompraController extends Controller
{
    const STATUS_INICIADA = 'iniciada';

    public function processarDadosCliente(Request $request): JsonResponse
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

            if (!isEmpty($pais->getEstados())) {
                $request->validate([
                    'estado_id' => 'required',
                ]);
            }

            cache(['dados_cliente' => $request->all()], now()->addMinutes(30));

            return response()->json(['dados_cliente' => $request->all()], 200);
        } catch (\Exception $exception) {
            return new JsonResponse(['Mensagem' => $exception->getMessage()], 400);
        }
    }

    public function iniciar(Request $request): JsonResponse
    {
        try {
            $dadosCliente = cache('dados_cliente');

            $request->validate([
                'total' => 'required|gt:0',
                'itens' => 'filled',
            ]);

            $itens = $request->input('itens');
            $totalCompra = 0;
            $livros = [];

            foreach ($itens as $item) {
                $livro = Livro::find($item['idLivro']);

                if (!$livro instanceof Livro) {
                    throw new \Exception('Informe um idLivro válido!', 101);
                }

                if (!isset($item['quantidade']) || !is_numeric($item['quantidade']) || $item['quantidade'] <= 0) {
                    throw new \Exception('A quantidade deve ser informada e deve ser um número maior que zero!', 102);
                }

                $totalCompra += $livro->getPreco() * $item['quantidade'];
                $livros[] = new CompraItem([
                    'livro_id' => $item['idLivro'],
                    'quantidade' => $item['quantidade'],
                    'preco' => $livro->getPreco()
                ]);
            }

            if ($totalCompra <> $request->input('total')) {
                throw new \Exception('Total da compra incorreto!', 103);
            }

            $dadosCompra = $dadosCliente;
            $dadosCompra['total_compra'] = $totalCompra;
            $dadosCompra['status'] = self::STATUS_INICIADA;

            $compra = new Compra($dadosCompra);
            $compra->save();
            $compra->itens()->saveMany($livros);


            return response()->json(['compra' => array_merge($dadosCliente, $request->all())], 201);
        } catch (\Exception $exception) {
            return new JsonResponse(['Mensagem' => $exception->getMessage()], 400);
        }
    }
}
