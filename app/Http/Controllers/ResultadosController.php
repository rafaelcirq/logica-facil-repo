<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ResultadosCreateRequest;
use App\Http\Requests\ResultadosUpdateRequest;
use App\Repositories\ResultadosRepository;
use App\Validators\ResultadosValidator;

/**
 * Class ResultadosController.
 *
 * @package namespace App\Http\Controllers;
 */
class ResultadosController extends Controller
{
    /**
     * @var ResultadosRepository
     */
    protected $repository;

    /**
     * @var ResultadosValidator
     */
    protected $validator;

    /**
     * ResultadosController constructor.
     *
     * @param ResultadosRepository $repository
     * @param ResultadosValidator $validator
     */
    public function __construct(ResultadosRepository $repository, ResultadosValidator $validator)
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
        $resultados = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $resultados,
            ]);
        }

        return view('resultados.index', compact('resultados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ResultadosCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ResultadosCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $resultado = $this->repository->create($request->all());

            $response = [
                'message' => 'Resultados created.',
                'data'    => $resultado->toArray(),
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
        $resultado = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $resultado,
            ]);
        }

        return view('resultados.show', compact('resultado'));
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
        $resultado = $this->repository->find($id);

        return view('resultados.edit', compact('resultado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ResultadosUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ResultadosUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $resultado = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Resultados updated.',
                'data'    => $resultado->toArray(),
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
                'message' => 'Resultados deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Resultados deleted.');
    }
}
