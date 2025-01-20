<?php
require '../classes/course.php';
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['cover']) && isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['content'])) {
        $cover = $_FILES['cover'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $content = $_FILES['content'];

        // Define the upload directory
        $coverupload = '../uploads/covers/';

        // Handle cover upload
        $coverPath = $uploadDir . basename($cover['name']);
        if (move_uploaded_file($cover['tmp_name'], $coverPath)) {
            // Handle content upload
            $contentPath = $uploadDir . basename($content['name']);
            if (move_uploaded_file($content['tmp_name'], $contentPath)) {
                $data = new Database;
                $conn = $data->getConnection();

                $course = new Courses($coverPath, $title, $description, $contentPath);
                $result = $course->addCourse($conn);

                if ($result === true) {
                    header('location: ../pages/home.php');
                    exit();
                } else {
                    echo $result;
                }
            } else {
                echo "Failed to upload content.";
            }
        } else {
            echo "Failed to upload cover.";
        }
    }
}