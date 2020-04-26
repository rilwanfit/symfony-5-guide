<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="app_student_homepage")
     */
    public function index(StudentRepository $studentRepository)
    {
        $students = $studentRepository->findAll();

        return $this->render('student/index.html.twig', [
            'students' => $students
        ]);
    }

    /**
     * @Route("/student/{id<\d+>}", name="app_student_show")
     */
    public function show(Student $student)
    {
        if (!$student) {
            throw $this->createNotFoundException( 'No product found for id '.$student->getId() );
        }

        return $this->render('student/show.html.twig', [
            'student' => $student
        ]);
    }

    /**
     * @Route("/student/new", name="app_student_new")
     */
    public function new(Request $request)
    {
        if($request->isMethod('POST')) {
            $firstName = $request->request->get('firstName');
            $surname = $request->request->get('surname');
            if (empty($firstName) || empty($surname)) {
                $this->addFlash('error','student firstName/surname cannot be an empty string');
            } else {
                return $this->create($firstName, $surname);
            }
        }

        return $this->render('student/new.html.twig');
    }

    private function create($firstName, $surname)
    {
        $student = new Student();
        $student->setFirstName($firstName);
        $student->setSurname($surname);

        $em = $this->getDoctrine()->getManager();
        $em->persist($student);
        $em->flush();

        return new Response('Created new student with id '.$student->getId());
    }

    /**
     * @Route("/student/delete/{id}")
     */
    public function delete(Student $student)
    {
        // store ID before deleting, so can report ID later
        $id = $student->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($student);
        $em->flush();

        return new Response('Deleted student with id '.$id);
    }

    /**
     * @Route("/student/update/{id}/{newFirstName}/{newSurname}")
     */
    public function update(Student $student, $newFirstName, $newSurname, StudentRepository $studentRepository)
    {
        if (!$student) {
            throw $this->createNotFoundException( 'No product found for id '.$student->getId() );
        }

        $student->setFirstName($newFirstName);
        $student->setSurname($newSurname);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('app_student_homepage');
    }
}
