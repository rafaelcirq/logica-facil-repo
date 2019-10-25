<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstituicoesCreateRequest;
use App\Http\Requests\InstituicoesUpdateRequest;
use App\Repositories\InstituicoesRepository;
use App\Validators\InstituicoesValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituicoes = Auth::user()->instituicoes;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $instituicoes,
            ]);
        }

        return view('cadastros.instituicoes.index', compact('instituicoes'));
    }

    /**
     * Chama a tela de importação de instituições
     */
    public function create()
    {
        return view('cadastros.instituicoes.import');
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
                'data' => $instituico->toArray(),
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
                'data' => $instituico->toArray(),
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
                'message' => 'Instituicoes deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Instituicoes deleted.');
    }

    /**
     * Retorna as universidades por Estado
     */
    public function getUniversidades($uf)
    {
        $arquivo = "instituicoes/universidades.csv";
        $csv = file_get_contents($arquivo);
        $array = explode("\n", $csv);
        $array = array_map("utf8_encode", $array);
        $instituicoes_array = array();
        for ($i = 11; $i < 2376; $i++) {
            $linha_array = explode(";", $array[$i]);
            $uf_ie = $linha_array["9"];
            if ($uf_ie == $uf) {
                $codigo = $linha_array['1'];
                $nome = $linha_array['2'];
                $sigla = $linha_array['3'];
                $instituicao = new \App\Entities\Instituicoes;
                $instituicao->codigo = $codigo;
                $instituicao->nome = $nome;
                $instituicao->sigla = $sigla;
                array_push($instituicoes_array, $instituicao);
            }
        }
        $instituicoes = collect($instituicoes_array);
        return $instituicoes;
    }

    public function getEscolas($uf)
    {
        dd($uf);
    }
}
