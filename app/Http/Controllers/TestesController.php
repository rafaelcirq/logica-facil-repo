<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestesCreateRequest;
use App\Http\Requests\TestesUpdateRequest;
use App\Presenters\TestesPresenter;
use App\Repositories\TestesRepository;
use App\Validators\TestesValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class TestesController.
 *
 * @package namespace App\Http\Controllers;
 */
class TestesController extends Controller
{
    /**
     * @var TestesRepository
     */
    protected $repository;

    /**
     * @var TestesValidator
     */
    protected $validator;

    /**
     * TestesController constructor.
     *
     * @param TestesRepository $repository
     * @param TestesValidator $validator
     */
    public function __construct(TestesRepository $repository, TestesValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $testes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $testes,
            ]);
        }

        return view('testes.index', compact('testes'));
    }

    public function createByTurma($id)
    {
        $turmaId = $id;
        if (Auth::user()->tipo == "Professor") {
            return view('cadastros.testes.create', compact('turmaId'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function create()
    {
        $turmas = null;

        if (Auth::user()->tipo == "Professor") {
            return view('cadastros.testes.create', compact('turmas'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TestesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TestesCreateRequest $request)
    {
        try {
            $data = $request->all();
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $teste = $this->repository->create($data);

            $this->storeQuestoes($data['questoes'], $teste);

            $response = [
                'success' => true,
                'message' => 'Teste criado.',
                'data' => $teste->toArray(),
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
     * Salva questões no momento de criação de um teste
     */
    private function storeQuestoes($data, $teste)
    {
        $valor = $teste->valor / sizeof($data);

        foreach ($data as $key => $questao) {
            $pergunta = new \App\Entities\Perguntas;

            $pergunta->testes_id = $teste->id;
            $pergunta->valor = $valor;
            $pergunta->texto = $questao['pergunta'];
            $pergunta->save();

            for ($i = 0; $i < 5; $i++) {
                $isCorreta = false;
                $alternativaCorreta = (int) $questao["alternativaCorreta"] - 1;
                if ($alternativaCorreta == $i) {
                    $isCorreta = true;
                }
                $this->storeAlternativas($pergunta->id, $questao[$i], $isCorreta);
            }
        }
    }

    private function storeAlternativas($perguntas_id, $texto, $isCorreta)
    {
        $alternativa = new \App\Entities\Alternativas;
        $alternativa->perguntas_id = $perguntas_id;
        $alternativa->texto = $texto;
        $alternativa->is_correta = $isCorreta;
        $alternativa->save();
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
        $teste = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $teste,
            ]);
        }

        return view('cadastros.testes.show', compact('teste'));
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
        $teste = $this->repository->find($id);

        return view('cadastros.testes.edit', compact('teste'));
    }

    public function editByTurma($turmaId, $testeId)
    {
        $teste = $this->repository->find($testeId);

        return view('cadastros.testes.edit', compact('teste', 'turmaId', 'testeId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TestesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TestesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $testis = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Testes updated.',
                'data' => $testis->toArray(),
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
        try
        {
            $deleted = $this->repository->delete($id);

            $response = [
                'success' => true,
                'message' => 'Teste excluído.',
                'data' => $deleted,
            ];

            if (request()->wantsJson()) {
                return response()->json($response);
            }

            session()->flash('response', $response);

            return redirect()->back();
        } catch (\Exception $e) {
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

    public function responder($id)
    {
        $teste = $this->repository->find($id);

        return view('cadastros.testes.reply', compact('teste'));
    }

    public function getResultadosAluno($aluno_id)
    {
        $resultado = \App\Entities\Resultados::all()->where('users_id', $aluno_id);
        
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $resultado,
            ]);
        }
        return $resultado;
    }
}
