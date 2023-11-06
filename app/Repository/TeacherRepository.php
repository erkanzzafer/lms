<?php

namespace App\Repository;

use App\Models\Teacher;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getAllspecializations()
    {
        //
    }

    public function getAllgender()
    {
        //
    }

    public function StoreTeachers($request)
    {
        //
    }
}
