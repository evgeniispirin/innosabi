<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function showProjects()
    {
        return response()->json(Project::all());
    }

    public function showOneProject($id, Request $request)
    {
        $response = null;

        if ($columns = $request->json('include')) {
            try {
                $response = response()->json(Project::find($id, explode(",", $columns)));
            } catch (\Exception $e) {
                $response = response()->json([
                    'error' => "Please list the columns as in the example: 'column1,column2' "
                ], 400);
            }
        } else {
            $response = response()->json(Project::find($id));
        }

        return $response;
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $project = Project::create($request->all());

        return response()->json($project, 201);

    }

    public function update($id, Request $request)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return response()->json($project, 200);
    }

    public function delete($id)
    {
        Project::findOrFail($id)->delete();
        return response()->json([
            'successful' => 'The project deleted.'
        ], 200);
    }
}
