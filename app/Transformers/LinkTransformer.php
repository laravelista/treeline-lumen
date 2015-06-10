<?php namespace App\Transformers;

use App\Link;
use League\Fractal\TransformerAbstract;

class LinkTransformer extends TransformerAbstract {

    public function transform(Link $link)
    {
        return [
            'name' => $link->name,
            'href' => $link->href
        ];
    }

}