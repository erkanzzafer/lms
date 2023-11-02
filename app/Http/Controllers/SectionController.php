<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with(['sections'])->get();
        $list_Grades = Grade::all();
        //dd($grades);
        return view("dashboard.sections.index", compact('grades', 'list_Grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (Section::where('name->tr', $request->name)->orWhere('name->en', $request->name_en)->exists()) {
            return redirect()->back()->with('error', 'Bu alanda kayıt yapılmış');
        }
        try {

            $validated = $request->validate(
                [
                    'name' => 'required',
                    'name_en' => 'required',
                    'grade_id' => 'required',
                    'class_id' => 'required'
                ]
            );
            $Sections = new Section();
            $Sections->name = ['en' => $request->name_en, 'tr' => $request->name];
            $Sections->grade_id = $request->grade_id;
            $Sections->classroom_id = $request->class_id;
            $Sections->status = 1;
            $Sections->save();


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

            $validated = $request->validate(
                [
                    'name' => 'required',
                    'name_en' => 'required',
                    'grade_id' => 'required',
                    'class_id' => 'required'
                ]
            );
            $Sections = Section::findOrFail($id);
            $Sections->name = ['en' => $request->name_en, 'tr' => $request->name];
            $Sections->grade_id = $request->grade_id;
            $Sections->classroom_id = $request->class_id;
            $Sections->status = $request->status ? 1 : 0;
            $Sections->update();
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
        $section = Section::findOrFail($id);
        try {
            $section->delete();
            return redirect()->back()->with('success', trans('main_trans.success_delete'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getClass(Request $request)
    {
        // dd($request->all());
        $list_classes = Classroom::where("grade_id", $request->grade_id)->pluck("name", "id");
        return $list_classes;
    }
}
