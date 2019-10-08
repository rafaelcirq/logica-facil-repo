<?php

namespace App\Presenters;

use App\Transformers\InstituicoesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InstituicoesPresenter.
 *
 * @package namespace App\Presenters;
 */
class InstituicoesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InstituicoesTransformer();
    }
}
