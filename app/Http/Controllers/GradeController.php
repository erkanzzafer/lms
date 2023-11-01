<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::latest()->get();
        return view("dashboard.grades.index", compact("grades"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.grades.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (Grade::where('name->tr', $request->name)->orWhere('name->en', $request->name_en)->exists()) {
            return redirect()->back()->with('error', 'Bu alanda kayıt yapılmış');
        }
        try {
            //dump($request->all());
            $validated = $request->validate(
                [
                    'name' => 'required',
                    'notes' => 'required'
                ]
            );

            $grade = new Grade(); // This is an Eloquent model

            $grade->name = ['en' => $request->name_en, 'tr' => $request->name];
            $grade->notes = $request->notes;

            //$grade->setTranslation('name', 'en', $request->name_en);
            //$grade->setTranslation('name', 'tr', $request->name);
            $grade->save();

            //Grade::create($validated);
            // toastr()->success(trans('main_trans.success_store'));
            return redirect()->back()->with('success', trans('main_trans.success_store'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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

        try {
            //dump($request->all());
            $validated = $request->validate(
                [
                    'name' => 'required',
                    'name_en' => 'required',
                    'notes' => 'required'
                ]
            );

            $grade = Grade::findOrFail($id); // This is an Eloquent model
            //dump($grade);
            $grade->update([
                $grade->name = ['en' => $request->name_en, 'tr' => $request->name],
                $grade->notes = $request->notes,
            ]);

            //$grade->setTranslation('name', 'en', $request->name_en);
            //$grade->setTranslation('name', 'tr', $request->name);
            // $grade->update();

            //Grade::create($validated);
            //toastr()->success(trans('main_trans.success_update'),trans('main_trans.success'));
            return redirect()->back()->with('success', trans('main_trans.success_update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grade = Grade::findOrFail($id);
        if ($grade->canBeDeleted()) {
            dd("yes silebilirsin");
            /*
        try {
            $grade = Grade::findOrFail($id);
            $grade->delete();
            return redirect()->back()->with('success', trans('main_trans.success_delete'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }*/
        } else {
            //dd("no sileemezsin");
            return redirect()->back()->with('error', "Alt Ögeler var silemezsin");
        };
    }
}
