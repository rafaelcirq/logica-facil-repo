<?php

namespace App\Presenters;

use App\Transformers\TestesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TestesPresenter.
 *
 * @package namespace App\Presenters;
 */
class TestesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TestesTransformer();
    }
}
