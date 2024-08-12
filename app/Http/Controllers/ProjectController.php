<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['projects'] = Project::withCount('tasks')->paginate(10);

        if($request->ajax()) {
            return view('projects.table', $data);
        }


        return view('projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        function getFileName($file)
        {
            $file = explode('/', $file);
            return  end($file);
        }

        try {

           $project = Project::create($request->all());

            

            foreach($request->attachments as $image){

                $url = Storage::disk('uploads')->put('/images/', $image);

                $project->attachments()->create([
                    'name' => "test",
                    'path' =>  $url,
                ]);
            }


            return response()->json(['message' => 'Project created successfully.', 'code' => 200], 200);
        } catch (\Throwable $th) {
            return response()->json(array('error' => $th->getMessage()), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        return view('projects.show', compact('project'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $project->load('attachments');

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        try {
            $project->update($request->all());
            return response()->json(['message' => 'Project updated successfully.', 'code' => 200], 200);
        } catch (\Throwable $th) {
            return response()->json(array('error' => $th->getMessage()), 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();

            return response()->json(['message' => 'Project deleted successfully.', 'code' => 200], 200);
        } catch (\Throwable $th) {
            return response()->json(array('error' => $th->getMessage()), 500);
        }
    }
}
