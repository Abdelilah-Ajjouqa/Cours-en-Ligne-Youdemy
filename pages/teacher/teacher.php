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
            <a class="text-2xl font-bold text-indigo-600 hover:text-2xl duration-300" href="../home.php"><i
                    class="text-red-500">You</i>demy</a>
        </div>
        <div class="flex-none">
            <ul class="flex space-x-4">
                <li><a class="text-gray-700 hover:text-indigo-600" href="../home.php">Home</a></li>
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
                                <a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="#">
                                    <form action="../../forms/logout.php" method="post">
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

    <!-- main content -->
    <button onclick="courseForm()"
        class="bg-blue-500 text-white text-3xl py-3 px-3 rounded-full fixed bottom-4 right-4 w-16 h-16 flex items-center justify-center">+</button>
    <div class="container mx-auto mt-8">
        <h1 class="text-4xl font-bold text-center text-indigo-600 mb-4">Welcome, Teacher!</h1>
        <p class="text-lg text-center text-gray-700 mb-8">Here you can manage your courses and interact with your students.</p>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="py-3 px-4">Title</th>
                        <th class="py-3 px-4">Description</th>
                        <th class="py-3 px-4">Content</th>
                        <th class="py-3 px-4">Edit</th>
                        <th class="py-3 px-4">Delete</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php foreach ($courses as $course): ?>
                        <tr class="border-b">
                            <td class="py-3 px-4"><?php echo htmlspecialchars($course['title']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($course['description']); ?></td>
                            <td class="py-3 px-4">
                                <a href="<?php echo htmlspecialchars($course['content']); ?>" download class="text-blue-500 hover:underline">Download</a>
                            </td>
                            <td class="py-3 px-4">
                                <a href="../courses/edit-course.php" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-300">Edit</a>
                            </td>
                            <td class="py-3 px-4">
                                <form action="../../forms/delete-course.php" method="post" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                    <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course['course_id']); ?>">
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>








    <?php
    echo '
    <form action="../../forms/course.php" method="post" id="courseForm" class="hidden" enctype="multipart/form-data">
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
            <button type="button" onclick="cancelForm()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Cancel</button>
                 </div>
             </div>
    </form>
';
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