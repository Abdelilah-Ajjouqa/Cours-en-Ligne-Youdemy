<?php
session_start();
require '../../db.php';
require '../../classes/user.php';
require '../../classes/courses.php';

$data = new Database;
$conn = $data->getConnection();

if (!isset($_SESSION['email'])) {
    header("location: ../autho/login.html");
    exit();
} else {
    $user = new User($_SESSION['email']);
    $username = $user->getUserName();
    // $courses = $user->getAllCours($conn);

    $role = $user->getRole();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Youdemy | Dashboard-Admin</title>
</head>

<body class="bg-blue-50">
    <!-- navbar -->
    <div class="navbar flex justify-between bg-white shadow-md p-4">
            <div class="flex-1">
                <a class="text-2xl font-bold text-indigo-600 hover:text-2xl duration-300" href="../courses/allCourses.php"><i class="text-red-500">You</i>demy</a>
            </div>
            <div class="flex-none">
                <ul class="flex space-x-4">
                    <li><a class="text-gray-700 hover:text-indigo-600" href="../courses/allCourses.php">Courses</a></li>
                    <!-- <li><a class="text-gray-700 hover:text-indigo-600" href="#">Blog</a></li> -->
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
                                        Dashboard
                                    </a>
                                </li>
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
    <div class="container mx-auto p-4">
        <h1 class="text-2xl">Admin Dashboard</h1>
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white p-4 shadow-md rounded-md">
                <h2 class="text-xl">Courses</h2>
                <ul>
                    <li class="text-gray-700">Course 1</li>
                    <li class="text-gray-700">Course 2</li>
                    <li class="text-gray-700">Course 3</li>
                    <li class="text-gray-700">Course 4</li>
                    <li class="text-gray-700">Course 5</li>
                </ul>
            </div>
            <div class="bg-white p-4 shadow-md rounded-md">
                <h2 class="text-xl">Students</h2>
                <ul>
                    <li class="text-gray-700">Student 1</li>
                    <li class="text-gray-700">Student 2</li>
                    <li class="text-gray-700">Student 3</li>
                    <li class="text-gray-700">Student 4</li>
                    <li class="text-gray-700">Student 5</li>
                </ul>
            </div>
            <div class="bg-white p-4 shadow-md rounded-md">
                <h2 class="text-xl">Teachers</h2>
                <ul>
                    <li class="text-gray-700">Teacher 1</li>
                    <li class="text-gray-700">Teacher 2</li>
                    <li class="text-gray-700">Teacher 3</li>
                    <li class="text-gray-700">Teacher 4</li>
                    <li class="text-gray-700">Teacher 5</li>
                </ul>
            </div>
        </div>
</body>

</html>