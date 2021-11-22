<?php

namespace App\Services;

use App\Models\Aluno;
use Exception;

class AlunoService
{
    public function __construct()
    {
        $this->aluno = new Aluno();
    }

    /**
     * pega todos alunos
     * e lança o erro
     */

    public function getListAluno()
    {
        try {
            return $this->aluno->all();
        } catch (Exception $error) {
            
            throw new Exception('Ocorreu um erro.', 405);
        }
    }

    public function createAluno($dataAluno)
    {
        //cria um novo aluno e retonar se foi cadastrado ou retorna erro
        try {
            Aluno::create([
                'nome' => $dataAluno['nome'], 
                'curso' => $dataAluno['curso'], 
                'semestre' => $dataAluno['semestre'],
                'ra' => $dataAluno['ra'],
                'cpf' => $dataAluno['cpf'],
                'cidade' => $dataAluno['cidade']
            ]);
            return 'Cadastrado com sucesso';
        } catch (Exception $error) {
            throw new Exception('Ocorreu um erro.', 405);
        }
    }

    public function getAlunoById($id)
    {
        //pega o primeiro valor da tabela aluno e se tiver erro
        try {
            return $this->aluno->where('id','=',$id)->get()->first();
        } catch (Exception $error) {
            throw new Exception('Ocorreu um erro.', 405);
        }
    }

    public function alunoExist($aluno)
    {
        if (empty($aluno)) {
            throw new Exception('Aluno nao encontrado', 404);
        }
    }

    public function updateAluno($aluno, $dataAluno)
    {
        //alterando aluno e retonar se foi cadastrado ou retorna erro
        try {
            $aluno->update([
                'nome' => $dataAluno['nome'], 
                'curso' => $dataAluno['curso'], 
                'semestre' => $dataAluno['semestre'],
                'ra' => $dataAluno['ra'],
                'cpf' => $dataAluno['cpf'],
                'cidade' => $dataAluno['cidade']
            ]);
            return 'Alterado com sucesso';
        } catch (Exception $error) {
            throw new Exception('Ocorreu um erro.', 405);
        }
    }

    public function deleteAlunoById($aluno)
    {
        //deletadno aluno ou retorna erro
        try {
            $aluno->delete();
            return 'Deletado com sucesso';
        } catch (Exception $error) {
            throw new Exception('Ocorreu um erro.', 405);
        }
    }
}
