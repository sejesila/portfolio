<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = ProjectResource::collection(Project::with('skill')->get());
        return Inertia::render('Projects/Index' ,compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = Skill::all();
        return Inertia::render('Projects/Create',compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'skill_id' => 'required',

        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('skills', 'public');
            Project::create([
                'skill_id'=>$request->skill_id,
                'name'=>$request->name,
                'image'=>$image,
                'project_url'=>$request->url
            ]);

            return Redirect::route('projects.index')->with('success', 'Skill created successfully.');
        }
        return Redirect::route('projects.index')->with('error', 'No file uploaded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
