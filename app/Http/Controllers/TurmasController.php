<?php

namespace App\Http\Controllers;

use App\Http\Requests\TurmasCreateRequest;
use App\Http\Requests\TurmasUpdateRequest;
use App\Presenters\TurmasPresenter;
use App\Presenters\InstituicoesPresenter;
use App\Repositories\TurmasRepository;
use App\Repositories\InstituicoesRepository;
use App\Validators\TurmasValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class TurmasController.
 *
 * @package namespace App\Http\Controllers;
 */
class TurmasController extends Controller
{
    /**
     * @var TurmasRepository
     */
    protected $repository;

    /**
     * @var TurmasValidator
     */
    protected $validator;

    /**
     * @var InstituicoesRepository
     */
    protected $instituicoesRepository;

    // use Helpers;

    /**
     * TurmasController constructor.
     *
     * @param TurmasRepository $repository
     * @param UserRepository $userRepository
     * @param TurmasValidator $validator
     */
    public function __construct(TurmasRepository $repository, InstituicoesRepository $instituicoesRepository, TurmasValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;

        $this->instituicoesRepository = $instituicoesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $this->repository->setPresenter(TurmasPresenter::class);

        if (Auth::user()->tipo == "Aluno") {
            $turmas = Auth::user()->turmasAluno;
        } else if (Auth::user()->tipo == "Professor") {
            $turmas = Auth::user()->turmasProfessor;
        }

        foreach ($turmas as $key => $turma) {
            $turma['professor'] = $turma->professor;
            $turma['instituicao'] = $turma->instituicao;
        }

        if (request()->wantsJson()) {
            return $turmas;
        }

        return view('cadastros.turmas.index', compact('turmas'));
    }

    public function create()
    {
        $instituicoes = Auth::user()->instituicoes->sortBy('nome');
        if(Auth::user()->tipo == "Professor") {
            return view('cadastros.turmas.create', compact('instituicoes'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TurmasCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TurmasCreateRequest $request)
    {
        try {
            $data = $request->all();
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $turma = $this->repository->create($data);
            
            if(isset($data['alunos'])) {
                $turma->alunos()->sync($data['alunos']);
            }

            $response = [
                'success' => true,
                'message' => 'Turma criada.',
                'data' => $turma->toArray(),
            ];
            if ($request->wantsJson()) {
                return response()->json($response);
            }
            session()->flash('response', $response);
            return redirect()->back();
        } catch (\Exception $e) {
            // If errors...
            switch (get_class($e)) {
                case ValidatorException::class:
                    $message = $e->getMessageBag();
                    break;
                default:
                    $message = $e->getMessage();
                    break;
            }
            $response = [
                'success' => false,
                'message' => $message,
            ];
            if ($request->wantsJson()) {
                return response()->json($response);
            }
            return redirect()->back()->withErrors($response['message'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $turma = $this->repository->find($id);
        $testes = $this->getTestes($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $turma,
            ]);
        }

        if(Auth::user()->tipo == "Professor") {
            $alunos = $this->getAlunos($id);
            return view('cadastros.turmas.show-professor', compact('turma', 'testes', 'alunos'));
        } else if(Auth::user()->tipo == "Aluno") {
            return view('cadastros.turmas.show-aluno', compact('turma', 'testes'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $turma = $this->repository->find($id);

        $instituicoes = Auth::user()->instituicoes->sortBy('nome');

        return view('cadastros.turmas.edit', compact('turma', 'instituicoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TurmasUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TurmasUpdateRequest $request, $id)
    {
        try {
            $data = $request->all();
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $turma = $this->repository->update($data, $id);
            
            if(isset($data['alunos'])) {
                $turma->alunos()->sync($data['alunos']);
            }

            $response = [
                'success' => true,
                'message' => 'Turma alterada.',
                'data' => $turma->toArray(),
            ];
            if ($request->wantsJson()) {
                return response()->json($response);
            }
            session()->flash('response', $response);
            return redirect()->back();
        } catch (\Exception $e) {
            // If errors...
            switch (get_class($e)) {
                case ValidatorException::class:
                    $message = $e->getMessageBag();
                    break;
                default:
                    $message = $e->getMessage();
                    break;
            }
            $response = [
                'success' => false,
                'message' => $message,
            ];
            if ($request->wantsJson()) {
                return response()->json($response);
            }
            return redirect()->back()->withErrors($response['message'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try 
        {
            $deleted = $this->repository->delete($id);

            $response = [
                'success' => true,
                'message' => 'Turma excluída.',
                'data'    => $deleted,
            ];

            if (request()->wantsJson()) {
                return response()->json($response);
            }

            session()->flash('response', $response);

            return redirect()->back();
        }
        catch (\Exception $e) 
        {        
            $message = $e->getMessage();

            $response = [
                'success' => false,
                'message' => $message,
            ];

            if (request()->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->withErrors($response['message'])->withInput();
        }
    }

    /**
     * Retorna os alunos de uma determinada turma
     */
    public function getAlunos($id)
    {
        $turma = $this->repository->find($id);
        return $turma->alunos;
    }

    /**
     * Retorna os testes de uma determinada turma
     */
    public function getTestes($id)
    {
        $turma = $this->repository->find($id);
        return $turma->testes;
    }
}
