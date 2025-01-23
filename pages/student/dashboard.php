<?php
session_start();
require '../../db.php';
require '../../classes/user.php';
require '../../classes/courses.php';
require '../../classes/enroll.php';

$data = new Database;
$conn = $data->getConnection();

if (!isset($_SESSION['email'])) {
    header("location: ../autho/login.html");
    exit();
} else {
    $course_id = $_GET['course_id'];
    $user_id = $_SESSION['user_id'];
    $user = new User($_SESSION['email']);
    $username = $user->getUserName();

    $role = $user->getRole();
    $courses = Courses::getAllCourses($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Youdemy | Teacher - Dashboard</title>
</head>

<body class="bg-blue-50">

    <!-- navbar -->
    <div class="navbar flex justify-between bg-white shadow-md p-4">
        <div class="flex-1">
            <a class="text-2xl font-bold text-indigo-600 hover:text-2xl duration-300" href="../courses/allCourses.php"><i
                    class="text-red-500">You</i>demy</a>
        </div>
        <div class="flex-none">
            <ul class="flex space-x-4">
                <li><a class="text-gray-700 hover:text-indigo-600" href="../courses/allCourses.php">Home</a></li>
                <li><a class="text-gray-700 hover:text-indigo-600" href="#">Blog</a></li>
                <li><a class="text-gray-700 hover:text-indigo-600" href="#">Contact</a></li>
                <li>
                    <details class="relative">
                        <summary class="hover:underline text-red-600 cursor-pointer hover:text-indigo-600"
                            style="list-style: none;">
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

    <h1 class="text-4xl font-bold text-center text-indigo-600 mb-4">Here You Are <?php echo $username ?></h1>
    <p class="text-lg text-center text-gray-700 mb-8">Here you can follow your courses</p>

    <!-- btn for form -->
    <button onclick="courseForm()"
        class="bg-blue-500 text-white text-3xl py-3 px-3 rounded-full fixed bottom-4 right-4 w-16 h-16 flex items-center justify-center">+</button>

    <!-- tab components -->
    <div class="flex justify-center">
        <div class="sm:hidden">
            <label for="Tab" class="sr-only">Tab</label>

            <select id="Tab" class="w-full rounded-md border-gray-200">
                <option>My Course</option>
            </select>
        </div>

        <div class="hidden sm:block">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex gap-6" aria-label="Tabs">
                    <!-- <a
                        href="#"
                        class="shrink-0 border-b-2 border-sky-500 px-1 pb-4 text-sm font-medium text-sky-600"
                        aria-current="page">
                        My Dashboard
                    </a> -->

                    <!-- <a
                        href="./tabs/allCourses.php"
                        class="shrink-0 border-b-2 border-transparent px-1 pb-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                        All Course
                    </a> -->

                    <a
                        href="./myCourse.php"
                        class="shrink-0 border-b-2 border-transparent px-1 pb-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                        My Course
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <div class="container mx-auto p-4">
        <div class="grid grid-cols-3 gap-4 mt-4" id="coursesContainer">
            <?php
            $checkEnroll = enroll::checkIfEnroll($conn, $user_id, $course_id, null);

            if ($checkEnroll) {
                foreach ($courses as $course) {
                    echo '<div class="course-item bg-white shadow-md p-4 rounded-md">
                    <img src="../../images/' . $course['cover'] . '" alt="' . $course['title'] . '" class="w-full h-40 object-cover rounded-md">
                    <h2 class="text-lg font-bold text-gray-700 mt-2">' . $course['title'] . '</h2>
                    <p class="text-gray-500">' . $course['description'] . '</p>
                    <a href="../courses/courseDetails.php?course_id=' . $course['course_id'] . '" class="block bg-indigo-600 text-white px-4 py-2 rounded-md mt-2 hover:bg-indigo-700 duration-300">View Course</a>
                </div>';
                }
            } else {
                echo "You have not enrolled in any course yet";
            }
            ?>
        </div>
</body>

</html>