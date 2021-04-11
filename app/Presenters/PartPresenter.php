<?php

namespace App\Presenters;

use App\Transformers\PartTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PartPresenter.
 *
 * @package namespace App\Presenters;
 */
class PartPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PartTransformer();
    }
}
