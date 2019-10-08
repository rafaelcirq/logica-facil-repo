<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AlternativasCreateRequest;
use App\Http\Requests\AlternativasUpdateRequest;
use App\Repositories\AlternativasRepository;
use App\Validators\AlternativasValidator;

/**
 * Class AlternativasController.
 *
 * @package namespace App\Http\Controllers;
 */
class AlternativasController extends Controller
{
    /**
     * @var AlternativasRepository
     */
    protected $repository;

    /**
     * @var AlternativasValidator
     */
    protected $validator;

    /**
     * AlternativasController constructor.
     *
     * @param AlternativasRepository $repository
     * @param AlternativasValidator $validator
     */
    public function __construct(AlternativasRepository $repository, AlternativasValidator $validator)
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
        $alternativas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $alternativas,
            ]);
        }

        return view('alternativas.index', compact('alternativas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AlternativasCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AlternativasCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $alternativa = $this->repository->create($request->all());

            $response = [
                'message' => 'Alternativas created.',
                'data'    => $alternativa->toArray(),
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
        $alternativa = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $alternativa,
            ]);
        }

        return view('alternativas.show', compact('alternativa'));
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
        $alternativa = $this->repository->find($id);

        return view('alternativas.edit', compact('alternativa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AlternativasUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AlternativasUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $alternativa = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Alternativas updated.',
                'data'    => $alternativa->toArray(),
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
                'message' => 'Alternativas deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Alternativas deleted.');
    }
}
