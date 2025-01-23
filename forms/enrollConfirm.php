<?php 
session_start();
require '../db.php';
require '../classes/user.php';
require '../classes/courses.php';
require '../classes/enroll.php';

$data = new Database;
$conn = $data->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['email'])) {
        header("location: ../autho/login.html");
        exit();
    } else {
        $course_id = $_GET['course_id'];
        $user = new User($_SESSION['email']);
        // $username = $user->getUserName();
        $user_id = $user->getUserId();

        $role = $user->getRole();
        $courseDetails = Courses::getCourseDetails($conn, $course_id);

        $query = 'INSERT INTO enrollments (student_id, course_id) VALUES (:student_id, :course_id)';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':student_id', $user_id);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();

        echo "You have successfully enrolled in this course";
        header("location: /pages/courses/courseDetails.php?course_id=$course_id");
    }
}