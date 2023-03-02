<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    protected $customMessages = [
        'name.required' => 'Technologies field cannot be empty',
    ];

    public function validationRules()
    {
        return [
            'name' => 'required|unique:types',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::paginate(15);
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.technologies.create', ['technology' => new Technology()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules(), $this->customMessages);
        $data['slug'] = Str::slug($data['name']);

        $newTechnology = new Technology();
        $newTechnology->fill($data);
        $newTechnology->save();
        $newTechnology->slug = $newTechnology->slug . '-' . $newTechnology->id;
        $newTechnology->update();

        return redirect()->route('admin.technologies.show', ['technology' => $newTechnology])->with('message', "Type $newTechnology->name has been created")->with('alert-type', 'info');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $newRules = $this->validationRules();
        $newRules['name'] = [
            'required', Rule::unique('technologies')->ignore($technology->id),
        ];

        $data = $request->validate($newRules, $this->customMessages);
        $data['slug'] = Str::slug($data['name'] . "-$technology->id");
        $technology->update($data);

        return redirect()->route('admin.technologies.show', compact('technology'))->with('message', "Type $technology->name has been edited")->with('alert-type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('message', "Type $technology->name has been deleted")->with('alert-type', 'danger');
    }
}
