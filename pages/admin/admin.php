<?php
session_start();
require '../../db.php';
require '../../classes/user.php';
require '../../classes/courses.php';
require '../../classes/student.php';
require '../../classes/teacher.php';
require '../../classes/categorie.php';

$data = new Database;
$conn = $data->getConnection();

if (!isset($_SESSION['email'])) {
    header("location: ../autho/login.html");
    exit();
} else {
    $role = $_SESSION['role'];
    if ($role != 'admin') {
        header("location: ../courses/allCourses.php");
        exit();
    }

    // get user details
    $user = new User($_SESSION['email']);
    $username = $user->getUserName();
    $role = $user->getRole();
    // var_dump($user);

    // get all courses
    $courses = Courses::getAllCourses($conn);
    // var_dump($course);

    // get all students
    $students = student::getAllStudents($conn);
    // var_dump($students);

    // get all teachers
    $teachers = teacher::getAllTeacher($conn);
    // var_dump($teahcers);

    // get all categories
    $categories = categorie::getAllCategories($conn);
    // var_dump($categories);

    
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

    <!-- main content -->
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-indigo-600 mb-4">Admin Dashboard</h1>
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white p-4 shadow-md rounded-md">
                <h2 class="text-xl">All Courses</h2>
                <ul>
                    <?php foreach ($courses as $course): ?>
                        <li class="text-gray-700 py-2 border-b border-gray-200">
                            <span class="font-semibold"><?php echo htmlspecialchars($course['title']); ?></span>
                            <div class="flex justify-between">
                                <span class="font-semibold text-blue-600"><?php echo htmlspecialchars($course['name']); ?></span>
                                <span class="font-semibold text-blue-800"><?php echo htmlspecialchars($course['username']); ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="bg-white p-4 shadow-md rounded-md">
                <h2 class="text-xl">All Teachers</h2>
                <ul>
                    <?php foreach ($teachers as $teacher): ?>
                        <li class="text-gray-700 py-2 border-b border-gray-200">
                            <span class="font-semibold"><?php echo htmlspecialchars($teacher['username']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="bg-white p-4 shadow-md rounded-md">
                <h2 class="text-xl">All Students</h2>
                <ul>
                    <?php foreach ($students as $student): ?>
                        <li class="text-gray-700 py-2 border-b border-gray-200">
                            <span class="font-semibold"><?php echo htmlspecialchars($student['username']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- categorie section -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-indigo-600">Categories</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white p-4 shadow-md rounded-md">
                    <ul>
                        <?php foreach ($categories as $category): ?>
                            <li class="text-gray-700 py-2 border-b border-gray-200">
                                <span class="font-semibold"><?php echo htmlspecialchars($category['name']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        
<!-- Button to open the modal -->
<button id="openModalBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">
    Add New Category
</button>

<!-- The Modal -->
<div id="myModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-4 shadow-md rounded-md w-1/3">
            <h2 class="text-2xl font-bold text-indigo-600 mb-4">Add New Category</h2>
            <form action="../../forms/addCategory.php" method="post">
                <div class="mb-4">
                    <label for="categoryName" class="block text-gray-700 font-bold mb-2">Category Name:</label>
                    <input type="text" id="categoryName" name="categoryName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Add Category
                    </button>
                    <button type="button" id="cancelBtn" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("openModalBtn");

    // Get the cancel button that closes the modal
    var cancelBtn = document.getElementById("cancelBtn");

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.classList.remove("hidden");
    }

    // When the user clicks on cancel button, close the modal
    cancelBtn.onclick = function() {
        modal.classList.add("hidden");
    }
</script>
</body>

</html>