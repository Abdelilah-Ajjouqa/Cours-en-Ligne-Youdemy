<?php
session_start();
require '../db.php';
require '../classes/user.php';
require '../classes/courses.php';

$data = new Database;
$conn = $data->getConnection();

if (!isset($_SESSION['email'])) {
    header("location: ./autho/login.html");
    exit();
} else {
    $user = new User($_SESSION['email']);
    $username = $user->getUserName();

    $role = $user->getRole();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Youdemy | Home</title>
</head>

<body class="bg-blue-50">

    <!-- navbar -->
    <div class="navbar flex justify-between bg-white shadow-md p-4">
        <div class="flex-1">
            <a class="text-2xl font-bold text-indigo-600 hover:text-2xl duration-300" href="./home.php"><i class="text-red-500">You</i>demy</a>
        </div>
        <div class="flex-none">
            <ul class="flex space-x-4">
                <li><a class="text-gray-700 hover:text-indigo-600" href="./home.php">Home</a></li>
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
                            <!-- <li>
                                    <a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="#">
                                        Edit
                                    </a>
                                </li> -->
                            <li>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="#">
                                    <form action="../forms/logout.php" method="post">
                                        <input type="submit" value="Logout" class="block w-full text-left">
                                    </form>
                                </a>
                            </li>
                            <?php
                            if ($user->isAdmin()) {
                                echo '<li><a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="#">Dashboard</a></li>';
                            }
                            ?>
                        </ul>
                    </details>
                </li>
            </ul>
        </div>
    </div>

    <!-- admin -->
    <?php
    header("location: ./admin/admin.php");
    ?>

    <!-- teacher -->
    <?php
    if ($role == 'teacher') {
        header("location: ./teacher/teacher.php");
    }
    ?>

    <!-- student -->
    <?php
    if ($role == 'student') {
        header("location: ./courses/courses.php");
    }
    ?>

    <script>
        function courseForm() {
            var form = document.getElementById('courseForm');
            form.classList.remove('hidden');
        }

        function cancelForm() {
            var form = document.getElementById('courseForm');
            form.classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('courseForm');
            form.classList.add('hidden');
        })
    </script>

</body>

</html>