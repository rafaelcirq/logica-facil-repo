<?php

namespace App\Presenters;

use App\Transformers\AlunosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AlunosPresenter.
 *
 * @package namespace App\Presenters;
 */
class AlunosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AlunosTransformer();
    }
}
