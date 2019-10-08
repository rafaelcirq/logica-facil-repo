<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PerguntasCreateRequest;
use App\Http\Requests\PerguntasUpdateRequest;
use App\Repositories\PerguntasRepository;
use App\Validators\PerguntasValidator;

/**
 * Class PerguntasController.
 *
 * @package namespace App\Http\Controllers;
 */
class PerguntasController extends Controller
{
    /**
     * @var PerguntasRepository
     */
    protected $repository;

    /**
     * @var PerguntasValidator
     */
    protected $validator;

    /**
     * PerguntasController constructor.
     *
     * @param PerguntasRepository $repository
     * @param PerguntasValidator $validator
     */
    public function __construct(PerguntasRepository $repository, PerguntasValidator $validator)
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
        $perguntas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $perguntas,
            ]);
        }

        return view('perguntas.index', compact('perguntas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PerguntasCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PerguntasCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $pergunta = $this->repository->create($request->all());

            $response = [
                'message' => 'Perguntas created.',
                'data'    => $pergunta->toArray(),
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
        $pergunta = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pergunta,
            ]);
        }

        return view('perguntas.show', compact('pergunta'));
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
        $pergunta = $this->repository->find($id);

        return view('perguntas.edit', compact('pergunta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PerguntasUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PerguntasUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $pergunta = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Perguntas updated.',
                'data'    => $pergunta->toArray(),
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
                'message' => 'Perguntas deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Perguntas deleted.');
    }
}
