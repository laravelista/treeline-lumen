<?php namespace App\Transformers;

use App\Note;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class NoteTransformer extends TransformerAbstract {

    protected $defaultIncludes = [
        'links'
    ];

    public function transform(Note $note)
    {
        return [
            'stamp'       => $note->stamp->format('d/m/Y'),
            'title'       => $note->title,
            'description' => $note->description
        ];
    }

    public function includeLinks(Note $note)
    {
        $links = $note->links;

        return $this->collection($links, new LinkTransformer);
    }

}