<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;
use Exception;
use App\Services\AlunoService;
use Illuminate\Http\Request;

class AlunoController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     /**
     * @var \App\Services\AlunoService
     */
    //cria variavel privada
    private $alunoService;

    public function __construct(AlunoService $alunoService)
    {
        $this->alunoService = $alunoService;
    }

    /**
     * controler lista de aluno
     */
    
    public function listAluno()
    {
        try {
            return Response::json([
                //pesquisa a lista
                'data' => $this->alunoService->getListAluno()
            ]);
        } catch (Exception $error) {
            //se der erro  retorna informação de erro
            return Response::json([
                'status' => 'error',
                'description' => $error->getMessage()
            ], $error->getCode());
        }
    }

    public function createAluno(Request $request)
    {
        try {
            $dataAluno = $request->all();
            return Response::json([
                //pesquisa a lista
                'data' => $this->alunoService->createAluno($dataAluno)
            ]);
        } catch (Exception $error) {
            //se der erro  retorna informação de erro
            return Response::json([
                'status' => 'error',
                'description' => $error->getMessage()
            ], $error->getCode());
        }
    }

    public function getAlunoById(Request $request)
    {
        try {
            //retorna informacao  do aluno
            $response = $this->alunoService->getAlunoById($request->id);
            $this->alunoService->alunoExist($response);
            return Response::json($response,200);
        } catch (Exception $error) {
            //se der erro  retorna informação de erro
            return Response::json([
                'status' => 'error',
                'description' => $error->getMessage()
            ], $error->getCode());
        }
    }

    public function updateAluno(Request $request)
    {
        try {
            //retorna informação do aluno
            $aluno = $this->alunoService->getAlunoById($request->id);
            //ve se o aluno existe
            $this->alunoService->alunoExist($aluno);
            //retorna as alterações e retorna se deu certo
            $response = $this->alunoService->updateAluno($aluno, $request->all());
            return Response::json($response,200);
        } catch (Exception $error) {
            //se der erro  retorna informação de erro
            return Response::json([
                'status' => 'error',
                'description' => $error->getMessage()
            ], $error->getCode());
        }
    }

    public function deleteAlunoById(Request $request)
    {
        try {
            //retorna informação do aluno
            $aluno = $this->alunoService->getAlunoById($request->id);
            //ve se o aluno existe
            $this->alunoService->alunoExist($aluno);
            return Response::json([
                'data' => $this->alunoService->deleteAlunoById($aluno)
            ],200);
        } catch (Exception $error) {
            //se der erro  retorna informação de erro
            return Response::json([
                'status' => 'error',
                'description' => $error->getMessage()
            ], $error->getCode());
        }
    }
}
