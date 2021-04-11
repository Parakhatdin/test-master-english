<?php

namespace App\Presenters;

use App\Transformers\BookTransformer;
use League\Fractal\TransformerAbstract;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BookPresenter.
 *
 * @package namespace App\Presenters;
 */
class BookPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return BookTransformer|TransformerAbstract
     */
    public function getTransformer()
    {
        return new BookTransformer();
    }
}
