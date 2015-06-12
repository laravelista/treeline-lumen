<?php namespace App\Transformers;

use App\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract {

    protected $defaultIncludes = [
        'notes'
    ];

    public function transform(Project $project)
    {
        return [
            'id'           => $project->id,
            'name'         => $project->name,
            'description'  => $project->description,
            'completed_at' => $project->completed_at,
            'repository'   => $project->repository,
            'url'          => $project->url,
            'status'       => $project->status->name,
            'updated_at'   => $project->updated_at->format('F d, Y')
        ];
    }

    public function includeNotes(Project $project)
    {
        $notes = $project->notes;

        return $this->collection($notes, new NoteTransformer);
    }

}