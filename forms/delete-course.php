<?php
require_once '../db.php';
require_once '../classes/courses.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['course_id'])) {
        $courseId = $_POST['course_id'];

        $data = new Database;
        $conn = $data->getConnection();

        $course = new Courses($courseId, '', '', '', '', '');
        $result = $course->deleteCourse($conn);

        if ($result === true) {
            header('location: ../pages/teacher/dashboard.php');
            exit();
        } else {
            echo $result;
        }
    }
}