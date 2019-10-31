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
            $data = $request->all();
            if ($data['tipo'] == "1") {
                $instituicoes = $this->getEscolas($data['estado'], $data['municipio']);
            } else if ($data['tipo'] == "2") {
                $instituicoes = $this->getUniversidades($data['estado'], $data['municipio']);
            }
            foreach ($data['instituicoes'] as $key => $codigo) {
                $instituicao = $instituicoes->firstWhere('codigo', $codigo);
                if ($this->repository->all()->firstWhere('codigo', $codigo) == null) {
                    $instituicao->save();
                } else {
                    $instituicao = $this->repository->all()->firstWhere('codigo', $codigo);
                }
                Auth::user()->instituicoes()->attach($instituicao->id);
            }
            $response = [
                'success' => true,
                'message' => 'Instituições atualizadas.',
                'data' => Auth::user()->instituicoes->toArray(),
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
        $instituicao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $instituicao,
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
        $removed = Auth::user()->instituicoes()->detach($id);

        $response = [
            'success' => true,
            'message' => 'Turma removida.',
        ];

        if (request()->wantsJson()) {
            return response()->json($response);
        }

        return redirect()->back()->with('message', 'Instituição removida.');
    }

    /**
     * Retorna as universidades por Estado e Município
     */
    public function getUniversidades($codigo_uf, $codigo_municipio)
    {
        $arquivo = "instituicoes/universidades.csv";
        $csv = file_get_contents($arquivo);
        $array = explode("\n", $csv);
        $array = array_map("utf8_encode", $array);
        $instituicoes_array = array();
        for ($i = 11; $i < 2376; $i++) {
            $linha_array = explode(";", $array[$i]);
            $codigo_uf_ie = $linha_array["7"];
            $codigo_municipio_ie = $linha_array["11"];
            if ($codigo_uf_ie == $codigo_uf && $codigo_municipio == $codigo_municipio_ie) {
                $codigo = $linha_array['1'];
                $nome = $linha_array['2'];
                $sigla = $linha_array['3'];
                $cidade = $linha_array['10'];
                $instituicao = new \App\Entities\Instituicoes;
                $instituicao->codigo = $codigo;
                $instituicao->nome = $nome;
                $instituicao->cidade = $cidade;
                if ($sigla !== "-") {
                    $instituicao->sigla = $sigla;
                } else {
                    $instituicao->sigla = "";
                }
                array_push($instituicoes_array, $instituicao);
            }
        }
        $instituicoes = collect($instituicoes_array);
        return $instituicoes;
    }

    /**
     * Retorna o nome do arquivo que contém as escolas do estado fornecido
     */
    private function getNomeArquivoEscolaByEstado($codigo_uf)
    {
        if ($codigo_uf >= 11 && $codigo_uf <= 17) {
            $regiao = "norte";
        } else if (($codigo_uf >= 21 && $codigo_uf <= 25)) {
            $regiao = "nordeste_1";
        } else if (($codigo_uf >= 26 && $codigo_uf <= 29)) {
            $regiao = "nordeste_2";
        } else if (($codigo_uf == 31)) {
            $regiao = "sudeste_2";
        } else if (($codigo_uf == 32 || $codigo_uf == 33)) {
            $regiao = "sudeste_1";
        } else if (($codigo_uf == 35)) {
            $regiao = "sudeste_3";
        } else if (($codigo_uf >= 41 && $codigo_uf <= 43)) {
            $regiao = "sul";
        } else if (($codigo_uf >= 50 && $codigo_uf <= 52)) {
            $regiao = "centro_oeste";
        }
        return "escolas_" . $regiao . ".csv";
    }

    /**
     * Retorna as escolas por Estado e Município
     */
    public function getEscolas($codigo_uf, $codigo_municipio)
    {
        $arquivo = "instituicoes/" . $this->getNomeArquivoEscolaByEstado($codigo_uf);
        $csv = file_get_contents($arquivo);
        $array = explode("\n", $csv);
        $array = array_map("utf8_encode", $array);
        $instituicoes_array = array();
        $ultimaLinha = sizeof($array) - 2;
        for ($i = 12; $i < $ultimaLinha; $i++) {
            $linha_array = explode(";", $array[$i]);
            $codigo_uf_ie = $linha_array["9"];
            $codigo_municipio_ie = $linha_array["12"];
            if ($codigo_uf_ie == $codigo_uf && $codigo_municipio == $codigo_municipio_ie) {
                $codigo = $linha_array['1'];
                $nome = $linha_array['2'];
                $cidade = $linha_array['11'];
                $instituicao = new \App\Entities\Instituicoes;
                $instituicao->codigo = $codigo;
                $instituicao->nome = $nome;
                $instituicao->cidade = $cidade;
                array_push($instituicoes_array, $instituicao);
            }
        }
        $instituicoes = collect($instituicoes_array);
        return $instituicoes;
    }

    public function isInstituicaoAssociadaAoUsuario($codigo)
    {
        $instituicao = Auth::user()->instituicoes->firstWhere("codigo", $codigo);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $instituicao,
            ]);
        }

        return $instituicao;
    }
}
