<?php
session_start();
require '../../db.php';
require '../../classes/user.php';
require '../../classes/courses.php';

$data = new Database;
$conn = $data->getConnection();


$courses = Courses::getAllCourses($conn);

if (isset($_SESSION['email'])) {
    $user = new User($_SESSION['email']);
    $role = $user->getRole();

    $username = $user->getUserName();
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
            <a class="text-2xl font-bold text-indigo-600 hover:text-2xl duration-300" href="#"><i class="text-red-500">You</i>demy</a>
        </div>
        <div class="flex-none">
            <ul class="flex space-x-4">
                <li><a class="text-gray-700 hover:text-indigo-600" href="#">Courses</a></li>
                <!-- <li><a class="text-gray-700 hover:text-indigo-600" href="#">Courses</a></li> -->
                <li><a class="text-gray-700 hover:text-indigo-600" href="#">Contact</a></li>
                <li>
                    <details class="relative">
                        <summary class="hover:underline text-red-600 cursor-pointer hover:text-indigo-600"
                            style="list-style: none;">
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo $username;
                            } else {
                                echo "Guest";
                            }
                            ?>
                        </summary>
                        <ul class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                            <!-- <li>
                                    <a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="#">
                                        Edit
                                    </a>
                                </li> -->
                            <li>
                                <?php
                                if ($role == 'teacher') {
                                    echo '<a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="../teacher/dashboard.php">Dashboard</a>';
                                } elseif ($role == 'student') {
                                    echo '<a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="../student/dashboard.php">Dashboard</a>';
                                } elseif ($role == 'admin') {
                                    echo '<a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="../admin/dashboard.php">Dashboard</a>';
                                }
                                ?>
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

    <!-- main content -->
    <div class="container mx-auto p-4">
        <div class="flex justify-between">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-700">Courses</h1>
            </div>
            <!-- <div class="flex-none">
                <a href="addCourse.php"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 duration-300">Add
                    Course</a>
            </div> -->
        </div>
        <div class="mt-4">
            <input type="text" id="searchInput" placeholder="Search courses..." class="w-full px-4 py-2 border rounded-md">
        </div>
        <div class="grid grid-cols-3 gap-4 mt-4" id="coursesContainer">
            <?php
            foreach ($courses as $course) {
                echo '<div class="course-item bg-white shadow-md p-4 rounded-md">
                <img src="../../images/' . $course['cover'] . '" alt="' . $course['title'] . '" class="w-full h-40 object-cover rounded-md">
                <h2 class="text-lg font-bold text-gray-700 mt-2">' . $course['title'] . '</h2>
                <p class="text-gray-500">' . $course['description'] . '</p>
                <a href="courseDetails.php?course_id=' . $course['course_id'] . '" class="block bg-indigo-600 text-white px-4 py-2 rounded-md mt-2 hover:bg-indigo-700 duration-300">View Course</a>
            </div>';
            }
            ?>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            var filter = this.value.toLowerCase();
            var courseItems = document.querySelectorAll('.course-item');

            courseItems.forEach(function(item) {
                var title = item.querySelector('h2').textContent.toLowerCase();
                if (title.includes(filter)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>