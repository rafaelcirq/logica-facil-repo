<?php

namespace App\Presenters;

use App\Transformers\PerguntasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PerguntasPresenter.
 *
 * @package namespace App\Presenters;
 */
class PerguntasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PerguntasTransformer();
    }
}
