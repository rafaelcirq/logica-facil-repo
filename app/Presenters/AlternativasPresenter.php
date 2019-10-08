<?php

namespace App\Presenters;

use App\Transformers\AlternativasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AlternativasPresenter.
 *
 * @package namespace App\Presenters;
 */
class AlternativasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AlternativasTransformer();
    }
}
