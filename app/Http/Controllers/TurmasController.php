<?php

namespace App\Http\Controllers;

use App\Entities\Turmas;
use App\Http\Requests\TurmasCreateRequest;
use App\Http\Requests\TurmasUpdateRequest;
use App\Presenters\TestesPresenter;
use App\Presenters\TurmasPresenter;
use App\Repositories\AlunosRepository;
use App\Repositories\ProfessoresRepository;
use App\Repositories\TestesRepository;
use App\Repositories\TurmasRepository;
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
     * @var AlunosRepository
     */
    protected $alunosRepository;

    /**
     * @var ProfessoresRepository
     */
    protected $professoresRepository;

    /**
     * @var TestesRepository
     */
    protected $testesRepository;

    /**
     * TurmasController constructor.
     *
     * @param TurmasRepository $repository
     * @param TurmasValidator $validator
     */
    public function __construct(TurmasRepository $repository, AlunosRepository $alunosRepository, ProfessoresRepository $professoresRepository, TestesRepository $testesRepository, TurmasValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;

        $this->alunosRepository = $alunosRepository;
        $this->professoresRepository = $professoresRepository;
        $this->testesRepository = $testesRepository;
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
        $turmas = $this->getTurmasByUser();

        if (request()->wantsJson()) {
            return $turmas;
        }

        $instituicoes = $this->getInstituicoesByUser();

        return view('cadastros.turmas.index', compact('turmas', 'instituicoes'));
    }

    /**
     * Busca todas as turmas do usuário
     */
    private function getTurmasByUser()
    {
        if (Auth::user()->tipo == "Professor") {
            $professor = $this->professoresRepository->findByField('users_id', Auth::id())->first();
            return $professor->turmas;
        } else {
            $aluno = $this->alunosRepository->findByField('users_id', Auth::id())->first();

            $t = new \App\Entities\Instituicoes();
            // return $aluno->turmas;
            return $t->find(1);
        }
    }

    private function getInstituicoesByUser()
    {
        if (Auth::user()->tipo == "Professor") {
            $professor = $this->professoresRepository->findByField('users_id', Auth::id())->first();
            return $professor->instituicoes;
        } else {
            $aluno = $this->alunosRepository->findByField('users_id', Auth::id())->first();
            // return $aluno->instituicoes;
            $repo = new \App\Entities\Instituicoes();
            $repo = $repo->find(1);
            return $repo;
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

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $turma = $this->repository->create($request->all());

            $response = [
                'message' => 'Turmas created.',
                'data' => $turma->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $turma,
            ]);
        }

        if (Auth::user()->tipo == "Professor") {
            return view('cadastros.turmas.index-professores', compact('turma'));
        } else {
            return view('cadastros.turmas.index-alunos', compact('turma'));
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

        return view('turmas.edit', compact('turma'));
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

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $turma = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Turmas updated.',
                'data' => $turma->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Turmas deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Turmas deleted.');
    }

    public function getAlunosByTurma($id)
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $this->repository->setPresenter(TurmasPresenter::class);
        $turma = \App\Entities\Turmas::find($id);

        // dd($turma->alunos);

        if (request()->wantsJson()) {
            return $turma->alunos;
        }
    }

    public function getTestesByTurma($id)
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $this->repository->setPresenter(TestesPresenter::class);

        $testes = $this->testesRepository->findWhere([
            'turmas_id' => $id
        ]);

        // dd($testes);

        if (request()->wantsJson()) {
            return $testes;
        }
    }
}
