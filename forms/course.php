<?php
require '../classes/course.php';
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['cover']) && isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['content'])) {
        $cover = $_FILES['cover'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $content = $_FILES['content'];

        // Define the upload directories
        $coverUpload = '../uploads/covers/';
        $pdfUpload = '../uploads/pdfs/';
        $videoUpload = '../uploads/videos/';

        // check if the directories exist
        if (!is_dir($coverUpload)) {
            mkdir($coverUpload, 0777, true);
        }
        if (!is_dir($pdfUpload)) {
            mkdir($pdfUpload, 0777, true);
        }
        if (!is_dir($videoUpload)) {
            mkdir($videoUpload, 0777, true);
        }

        $coverPath = $coverUpload . basename($cover['name']);
        if (move_uploaded_file($cover['tmp_name'], $coverPath)) {
            // upload content
            $contentPath = '';
            if (strpos($content['type'], 'pdf') !== false) {
                $contentPath = $pdfUpload . basename($content['name']);
            } elseif (strpos($content['type'], 'video') !== false) {
                $contentPath = $videoUpload . basename($content['name']);
            }

            // move the content to the upload directory
            if ($contentPath && move_uploaded_file($content['tmp_name'], $contentPath)) {
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