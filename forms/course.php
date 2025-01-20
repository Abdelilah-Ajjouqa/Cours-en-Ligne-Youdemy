<?php
require '../classes/course.php';
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['cover']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['content'])) {
        $cover = $_POST['cover'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $content = $_POST['content'];

        $data = new Database;
        $conn = $data->getConnection();

        $course = new Courses($cover, $title, $description, $content);
        $course->addCourse($conn);

        header("Location: ../pages/home.php");
        exit();
    }
}