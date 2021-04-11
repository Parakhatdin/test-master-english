<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Part;

/**
 * Class PartTransformer.
 *
 * @package namespace App\Transformers;
 */
class PartTransformer extends TransformerAbstract
{
    /**
     * Transform the Part entity.
     *
     * @param \App\Models\Part $model
     *
     * @return array
     */
    public function transform(Part $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
