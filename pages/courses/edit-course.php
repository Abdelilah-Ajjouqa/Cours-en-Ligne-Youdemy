<?php
session_start();
require '../../db.php';
require '../../classes/user.php';
require '../../classes/courses.php';

$data = new Database;
$conn = $data->getConnection();

if (!isset($_SESSION['email'])) {
    header("location: ../../autho/login.php");
    exit();
} else {
    $user = new User($_SESSION['email']);
    $username = $user->getUserName();

    // $courseId = $_GET['course_id'];
    // $course = new Courses($conn, $courseId, '', '', '');
    // $title = $course->getCourseTitle($courseId);
    // $description = $course->getCourseDescription($courseId);
    // $content = $course->getCourseContent($courseId);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Youdemy | Update Account</title>
</head>

<body class="bg-blue-50">
    <!-- navbar -->
    <div class="navbar flex justify-between bg-white shadow-md p-4">
        <div class="flex-1">
            <a class="text-2xl font-bold text-indigo-600 hover:text-2xl duration-300" href="../home.php"><i class="text-red-500">You</i>demy</a>
        </div>
        <div class="flex-none">
            <ul class="flex space-x-4">
                <li><a class="text-gray-700 hover:text-indigo-600" href="../home.php">Home</a></li>
                <li><a class="text-gray-700 hover:text-indigo-600" href="#">Blog</a></li>
                <li><a class="text-gray-700 hover:text-indigo-600" href="#">Contact</a></li>
                <li>
                    <details class="relative">
                        <summary class="hover:underline text-red-600 cursor-pointer hover:text-indigo-600" style="list-style: none;">
                            <?php
                            echo $username;
                            ?>
                        </summary>
                        <ul class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                            <li>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="#">
                                    <form action="../../forms/logout.php" method="post">
                                        <input type="submit" value="Logout" class="block w-full text-left">
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>
            </ul>
        </div>
    </div>

    <!-- form -->
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg">
            <h1 class="text-center text-2xl font-bold text-indigo-600 sm:text-3xl">Update Course</h1>

            <form action="#" method="post" id="courseForm" enctype="multipart/form-data">
                <div class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
                    <div class="mb-4">
                        <label for="cover" class="block text-gray-700 font-bold mb-2">Cover</label>
                        <input type="file" id="cover" name="cover" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600" accept="image/*">
                    </div>
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Course Title</label>
                        <input type="text" id="title" name="title" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Course Description</label>
                        <textarea id="description" name="description" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600" rows="4" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 font-bold mb-2">Course Content (PDF or Videos)</label>
                        <input type="file" id="content" name="content" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600" accept=".pdf,video/*" required>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition duration-300">Submit</button>
                        <a href="../teacher/teacher.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>