<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    protected $customMessages = [
        'name.required' => 'Title field cannot be empty',
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
        $types = Type::paginate(15);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create', ['type' => new Type()]);
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

        $newType = new Type();
        $newType->fill($data);
        $newType->save();
        $newType->slug = $newType->slug . '-' . $newType->id;
        $newType->update();

        return redirect()->route('admin.types.show', ['type' => $newType])->with('message', "Type $newType->name has been created")->with('alert-type', 'info');
    }

    /**
     * Display the specified resource.
     *
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $newRules = $this->validationRules();
        $newRules['name'] = [
            'required', Rule::unique('types')->ignore($type->id),
        ];

        $data = $request->validate($newRules, $this->customMessages);
        $data['slug'] = Str::slug($data['name'] . "-$type->id");
        $type->update($data);

        return redirect()->route('admin.types.show', compact('type'))->with('message', "Type $type->name has been edited")->with('alert-type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index')->with('message', "Type $type->name has been deleted")->with('alert-type', 'danger');
    }
}
