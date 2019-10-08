<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstituicoesCreateRequest;
use App\Http\Requests\InstituicoesUpdateRequest;
use App\Repositories\InstituicoesRepository;
use App\Validators\InstituicoesValidator;

/**
 * Class InstituicoesController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstituicoesController extends Controller
{
    /**
     * @var InstituicoesRepository
     */
    protected $repository;

    /**
     * @var InstituicoesValidator
     */
    protected $validator;

    /**
     * InstituicoesController constructor.
     *
     * @param InstituicoesRepository $repository
     * @param InstituicoesValidator $validator
     */
    public function __construct(InstituicoesRepository $repository, InstituicoesValidator $validator)
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
        $instituicoes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $instituicoes,
            ]);
        }

        return view('instituicoes.index', compact('instituicoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstituicoesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstituicoesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $instituico = $this->repository->create($request->all());

            $response = [
                'message' => 'Instituicoes created.',
                'data'    => $instituico->toArray(),
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
        $instituico = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $instituico,
            ]);
        }

        return view('instituicoes.show', compact('instituico'));
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
        $instituico = $this->repository->find($id);

        return view('instituicoes.edit', compact('instituico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstituicoesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InstituicoesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $instituico = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Instituicoes updated.',
                'data'    => $instituico->toArray(),
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
                'message' => 'Instituicoes deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Instituicoes deleted.');
    }
}
