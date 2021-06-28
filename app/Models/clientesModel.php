<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class clientesModel extends Model
{
    use HasFactory;
    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $cep;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $estado;
    private $dt_criacao;
    private $dt_atualizacao;

    private $status;
    private $mensagem;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    public function getDt_criacao()
    {
        return $this->dt_criacao;
    }

    public function setDt_criacao($dt_criacao)
    {
        $this->dt_criacao = $dt_criacao;

        return $this;
    }

    public function getDt_atualizacao()
    {
        return $this->dt_atualizacao;
    }

    public function setDt_atualizacao($dt_atualizacao)
    {
        $this->dt_atualizacao = $dt_atualizacao;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getMensagem()
    {
        return $this->mensagem;
    }

    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;

        return $this;
    }

    public function alterarClientePost()
    {
        $cliente = DB::table('clientes')->where('id', $this->getId())->count();

        if ($cliente > 0) {

            $cliente = DB::table('clientes')->where('email', $this->getEmail());
            if ($cliente->get()->contains('id', $this->getId()) || $cliente->count() == 0) {
                DB::table('clientes')->where('id', $this->getId())->update([
                    'nome' => $this->getNome(),
                    'email' => $this->getEmail(),
                    'telefone' => $this->getTelefone(),
                    'cep' => $this->getCep(),
                    'logradouro' => $this->getLogradouro(),
                    'numero' => $this->getNumero(),
                    'complemento' => $this->getComplemento(),
                    'bairro' => $this->getBairro(),
                    'cidade' => $this->getCidade(),
                    'estado' => $this->getEstado(),
                    'dt_atualizacao' => $this->getDt_atualizacao(),
                ]);

                $this->setStatus(true);
                $this->setMensagem('Cliente alterado com sucesso!');
            } else {
                $this->setStatus(false);
                $this->setMensagem('Desculpe, mas já existe um cliente cadastrado com o e-mail informado!');
            }
        } else {
            $this->setStatus(false);
            $this->setMensagem('Desculpe, esse cliente não está cadastrado!');
        }
    }

    public function cadastrarClientePost()
    {
        $cliente = DB::table('clientes')->where('email', $this->getEmail())->count();

        if ($cliente == 0) {
            DB::table('clientes')->insert([
                'nome' => $this->getNome(),
                'email' => $this->getEmail(),
                'telefone' => $this->getTelefone(),
                'cep' => $this->getCep(),
                'logradouro' => $this->getLogradouro(),
                'numero' => $this->getNumero(),
                'complemento' => $this->getComplemento(),
                'bairro' => $this->getBairro(),
                'cidade' => $this->getCidade(),
                'estado' => $this->getEstado(),
                'dt_criacao' => $this->getDt_criacao(),
            ]);

            $this->setStatus(true);
            $this->setMensagem('Cliente cadastrado com sucesso!');
        } else {
            $this->setStatus(false);
            $this->setMensagem('Desculpe, mas já existe um cliente cadastrado com o e-mail informado!');
        }
    }
}
