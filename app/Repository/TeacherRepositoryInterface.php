<?php

namespace App\Repository;

interface TeacherRepositoryInterface
{

    // get all Teachers
    public function getAllTeachers();
    public function getAllspecializations();
    public function getAllgender();
    public function StoreTeachers($request);
}
