<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::latest()->get();
        $grades = Grade::all();
        return view("dashboard.classroom.index", compact("classrooms", "grades"));
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
        // dd($request->all());
        $request->validate([
            'List_Classes.*.name' => 'required',
            'List_Classes.*.name_en' => 'required',
            'List_Classes.*.grade_id' => 'required',
        ]);


        try {

            $List = $request->List_Classes;
            foreach ($List as $item) {
                $class = new Classroom();
                $class->name = ['en' => $item['name_en'], 'tr' => $item['name']];
                //$class->name = ['en' => 'en', 'tr' => 'tr'];
                //$class->name = 'asd';
                $class->grade_id = $item['grade_id'];
                $class->save();
            }
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
        $request->validate([
            'List_Classes.*.name' => 'required',
            'List_Classes.*.name_en' => 'required',
            'List_Classes.*.grade_id' => 'required',
        ]);


        try {



            $class = Classroom::findOrFail($id);
            $class->name = ['en' => $request->name_en, 'tr' => $request->name];
            //$class->name = ['en' => 'en', 'tr' => 'tr'];
            //$class->name = 'asd';
            $class->grade_id = $request->grade_id;
            $class->update();

            return redirect()->back()->with('success', trans('main_trans.success_store'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = Classroom::findOrFail($id);
        try {
            $class->delete();
            return redirect()->back()->with('success', trans('main_trans.success_delete'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteAll(Request $request)
    {
        //dd($request->all());
        $delete_all_id = explode(",", $request->delete_all_id);
        Classroom::whereIn('id', $delete_all_id)->Delete();
        //toastr()->error(trans('messages.Delete'));
        return redirect()->back()->with('success', trans('main_trans.success_delete'));
    }


    public function Filter_Classes(Request $request)
    {
        if ($request->grade_id == 0) {
            return $this->index();
        }
        $grades = Grade::all();
        $classrooms = Classroom::where('grade_id', $request->grade_id)->get();
        $selected = $request->grade_id;
        return view('dashboard.classroom.index', compact('grades', 'classrooms', 'selected'));
    }
}
