<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Book;

/**
 * Class BookTransformer.
 *
 * @package namespace App\Transformers;
 */
class BookTransformer extends TransformerAbstract
{
    /**
     * Transform the Book entity.
     *
     * @param \App\Models\Book $model
     *
     * @return array
     */
    public function transform(Book $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
