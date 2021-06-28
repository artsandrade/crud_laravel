<?php

namespace App\Http\Controllers;

use App\Models\clientesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class clientesController extends Controller
{

    public function clientesGet()
    {
        $clientes = DB::table('clientes')->select('id', 'nome', 'email', 'telefone')->get();
        return view('clientes.clientes', compact('clientes'));
    }

    public function alterarClienteGet(Request $request)
    {
        if (isset($request->cliente) && !empty($request->cliente)) {
            $dados_cliente = DB::table('clientes')->where('id', $request->cliente)->count();

            if (!empty($dados_cliente)) {
                $dados_cliente = DB::table('clientes')->where('id', $request->cliente)->get();
                return view('clientes.alterar', compact('dados_cliente'));
            } else {
                return redirect()->route('clientes_get');
            }
        } else {
            return redirect()->route('clientes_get');
        }
    }

    public function alterarClientePost(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'id' => 'required',
            'nome' => 'required',
            'email' => 'required|email',
            'cep' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
        ]);
        if ($validacao->fails()) {
            return Response()->json([
                'status' => false,
                'mensagem' => $validacao->errors(),
            ]);
        } else {
            $cliente = new clientesModel();
            $cliente->setId($request->id);
            $cliente->setNome($request->nome);
            $cliente->setEmail($request->email);
            $cliente->setTelefone($request->telefone);
            $cliente->setCep($request->cep);
            $cliente->setLogradouro($request->logradouro);
            $cliente->setNumero($request->numero);
            $cliente->setComplemento($request->complemento);
            $cliente->setBairro($request->bairro);
            $cliente->setCidade($request->cidade);
            $cliente->setEstado($request->estado);
            $cliente->setDt_atualizacao(date('Y-m-d H:i:s'));
            $cliente->alterarClientePost();

            return Response()->json([
                'status' => $cliente->getStatus(),
                'mensagem' => $cliente->getMensagem(),
            ]);
        }
    }

    public function cadastrarClienteGet()
    {
        return view('clientes.cadastrar');
    }

    public function cadastrarClientePost(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|email',
            'cep' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
        ]);
        if ($validacao->fails()) {
            return Response()->json([
                'status' => false,
                'mensagem' => $validacao->errors(),
            ]);
        } else {
            $cliente = new clientesModel();
            $cliente->setId($request->id);
            $cliente->setNome($request->nome);
            $cliente->setEmail($request->email);
            $cliente->setTelefone($request->telefone);
            $cliente->setCep($request->cep);
            $cliente->setLogradouro($request->logradouro);
            $cliente->setNumero($request->numero);
            $cliente->setComplemento($request->complemento);
            $cliente->setBairro($request->bairro);
            $cliente->setCidade($request->cidade);
            $cliente->setEstado($request->estado);
            $cliente->setDt_criacao(date('Y-m-d H:i:s'));
            $cliente->cadastrarClientePost();

            return Response()->json([
                'status' => $cliente->getStatus(),
                'mensagem' => $cliente->getMensagem(),
            ]);
        }
    }

    public function visualizarClienteGet(Request $request)
    {
        if (isset($request->cliente) && !empty($request->cliente)) {
            $dados_cliente = DB::table('clientes')->where('id', $request->cliente)->count();

            if (!empty($dados_cliente)) {
                $dados_cliente = DB::table('clientes')->where('id', $request->cliente)->get();
                return view('clientes.visualizar', compact('dados_cliente'));
            } else {
                return redirect()->route('clientes_get');
            }
        } else {
            return redirect()->route('clientes_get');
        }
    }

    public function removerClientePost(Request $request)
    {
        if (isset($request->id) && !empty($request->id)) {
            $cliente = DB::table('clientes')->where('id', $request->id)->count();

            if (!empty($cliente)) {
                $cliente = DB::table('clientes')->where('id', $request->id)->delete();
                return Response()->json([
                    'status' => true,
                    'mensagem' => 'Cliente removido com sucesso!',
                ]);
            } else {
                return Response()->json([
                    'status' => false,
                    'mensagem' => 'Desculpe, esse cliente não está cadastrado!',
                ]);
            }
        } else {
            return Response()->json([
                'status' => false,
                'mensagem' => 'Desculpe, mas é necessário selecionar um cliente para realizar a ação!',
            ]);
        }
    }
}
