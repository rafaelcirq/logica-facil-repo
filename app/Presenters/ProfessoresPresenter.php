<?php

namespace App\Presenters;

use App\Transformers\ProfessoresTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProfessoresPresenter.
 *
 * @package namespace App\Presenters;
 */
class ProfessoresPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProfessoresTransformer();
    }
}
