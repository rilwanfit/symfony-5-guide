<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student")
     */
    public function index(StudentRepository $studentRepository)
    {
        $students = $studentRepository->findAll();

        return $this->render('student/index.html.twig', [
            'students' => $students
        ]);
    }

    /**
     * @Route("/student/{id}", name="app_student_show")
     */
    public function show($id, StudentRepository $studentRepository)
    {
        $student = $studentRepository->find($id);

        if (!$student) {
            throw $this->createNotFoundException( 'No product found for id '.$id );
        }

        return $this->render('student/show.html.twig', [
            'student' => $student
        ]);
    }
}
