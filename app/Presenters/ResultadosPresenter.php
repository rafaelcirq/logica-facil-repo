<?php

namespace App\Presenters;

use App\Transformers\ResultadosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ResultadosPresenter.
 *
 * @package namespace App\Presenters;
 */
class ResultadosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ResultadosTransformer();
    }
}
