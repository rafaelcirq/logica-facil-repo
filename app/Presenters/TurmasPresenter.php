<?php

namespace App\Presenters;

use App\Transformers\TurmasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TurmasPresenter.
 *
 * @package namespace App\Presenters;
 */
class TurmasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TurmasTransformer();
    }
}
