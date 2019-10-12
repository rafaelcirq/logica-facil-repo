<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AlunosCreateRequest;
use App\Http\Requests\AlunosUpdateRequest;
use App\Repositories\AlunosRepository;
use App\Validators\AlunosValidator;

/**
 * Class AlunosController.
 *
 * @package namespace App\Http\Controllers;
 */
class AlunosController extends Controller
{
    /**
     * @var AlunosRepository
     */
    protected $repository;

    /**
     * @var AlunosValidator
     */
    protected $validator;

    /**
     * AlunosController constructor.
     *
     * @param AlunosRepository $repository
     * @param AlunosValidator $validator
     */
    public function __construct(AlunosRepository $repository, AlunosValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $alunos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $alunos,
            ]);
        }

        return view('alunos.index', compact('alunos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AlunosCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AlunosCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $aluno = $this->repository->create($request->all());

            $response = [
                'message' => 'Alunos created.',
                'data'    => $aluno->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
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
        $aluno = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $aluno,
            ]);
        }

        return view('alunos.show', compact('aluno'));
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
        $aluno = $this->repository->find($id);

        return view('alunos.edit', compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AlunosUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AlunosUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $aluno = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Alunos updated.',
                'data'    => $aluno->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
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
                'message' => 'Alunos deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Alunos deleted.');
    }
}