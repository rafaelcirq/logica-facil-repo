<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TestesCreateRequest;
use App\Http\Requests\TestesUpdateRequest;
use App\Repositories\TestesRepository;
use App\Validators\TestesValidator;

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
        $testes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $testes,
            ]);
        }

        return view('testes.index', compact('testes'));
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

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $testis = $this->repository->create($request->all());

            $response = [
                'message' => 'Testes created.',
                'data'    => $testis->toArray(),
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
        $testis = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $testis,
            ]);
        }

        return view('testes.show', compact('testis'));
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
        $testis = $this->repository->find($id);

        return view('testes.edit', compact('testis'));
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
                'data'    => $testis->toArray(),
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
                'message' => 'Testes deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Testes deleted.');
    }
}
