<?php namespace App\Http\Controllers;

use App\Project;
use App\Transformers\ProjectTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ProjectsController extends ApiController {

    protected $validationRules = [
        'name'         => 'required|unique:projects,name|min:3',
        'description'  => 'required',
        'website'      => 'url',
        'repository'   => 'url',
        'status'       => 'required|exists:statuses,id',
        'completed_at' => 'date_format:d/m/Y'
    ];

    protected $project;

    function __construct(Project $project)
    {
        $this->project = $project;
    }


    /**
     * @param Manager $fractal
     * @param ProjectTransformer $projectTransformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Manager $fractal, ProjectTransformer $projectTransformer)
    {
        $projects = $this->project->with(['notes.links', 'status'])->get();

        $collection = new Collection($projects, $projectTransformer);

        $data = $fractal->createData($collection)->toArray();

        return $this->respondWithCORS($data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules);

        $this->project->name = $request->get('name');
        $this->project->description = $request->get('description');
        $this->project->url = $request->get('url');
        $this->project->repository = $request->get('repository');
        $this->project->completed_at = $request->get('completed_at');
        $this->project->status_id = $request->get('status');
        $this->project->save();

        return $this->respondCreated('Project was created');
    }

    /**
     * @param $projectId
     * @param Manager $fractal
     * @param ProjectTransformer $projectTransformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($projectId, Manager $fractal, ProjectTransformer $projectTransformer)
    {
        $project = $this->project->findOrFail($projectId);

        $item = new Item($project, $projectTransformer);

        $data = $fractal->createData($item)->toArray();

        return $this->respond($data);
    }

    /**
     * @param $projectId
     * @param Request $request
     * @return mixed
     */
    public function update($projectId, Request $request)
    {
        $project = $this->project->findOrFail($projectId);

        $this->validate($request, $this->validationRules);

        $project->name = $request->get('name');
        $project->description = $request->get('description');
        $project->url = $request->get('url');
        $project->repository = $request->get('repository');
        $project->completed_at = $request->get('completed_at');
        $project->status_id = $request->get('status');
        $project->save();

        return $this->respondCreated('Project was updated');
    }

    /**
     * @param $projectId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($projectId)
    {
        $project = $this->project->findOrFail($projectId);

        $project->delete();

        return $this->respondOk('Project was deleted');
    }

}
