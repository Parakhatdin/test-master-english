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
     * @param Book $model
     *
     * @return array
     */
    public function transform(Book $model)
    {
        return [
            'id' => (int) $model->id,
            'book' => (int) $model->book,
            'topic' => (string) $model->topic,
            'questions_count' => (int) $model->questions_count
        ];
    }
}
