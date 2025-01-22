<?php
require '../classes/courses.php';
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['cover']) && isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['content'])) {
        $cover = $_FILES['cover'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $content = $_FILES['content']['name'];
        $tmpName = $_FILES['content']['tmp_name'];
        $type = $_FILES['content']['type'];

        // Define the upload directories
        $coverUpload = '../uploads/covers/';
        $pdfUpload = '../uploads/pdfs/';
        $videoUpload = '../uploads/videos/';

        // check if the directories exist
        if (!is_dir($coverUpload)) { // is_dir check if the variable is a directory
            mkdir($coverUpload, 0777, true); // mkdir creates a directory
        }
        if (!is_dir($pdfUpload)) {
            mkdir($pdfUpload, 0777, true);
        }
        if (!is_dir($videoUpload)) {
            mkdir($videoUpload, 0777, true);
        }

        $coverPath = $coverUpload . basename($cover['name']);
        if (move_uploaded_file($cover['tmp_name'], $coverPath)) {
            // upload cover
            $contentPath = '';
            if (strpos($type, 'pdf') !== false) {
                $contentPath = $pdfUpload . basename($content);
            } elseif (strpos($type, 'video') !== false) {
                $contentPath = $videoUpload . basename($content);
            }

            // move the content to the upload directory
            if ($contentPath && move_uploaded_file($tmpName, $contentPath)) {
                $data = new Database;
                $conn = $data->getConnection();

                $course = new Courses($course_id, $coverPath, $title, $description, $contentPath);
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