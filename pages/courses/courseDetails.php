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
    $user = new User($_SESSION['email']);
    $username = $user->getUserName();
    $user_id = $user->getUserId();

    $role = $user->getRole();
    $courseDetails = Courses::getCourseDetails($conn, $course_id);
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
                        </ul>
                    </details>
                </li>
            </ul>
        </div>
    </div>

    <!-- main content -->
    <div class="container mx-auto p-4">
        <div class="flex justify-center">
            <div class="w-full md:w-3/4 lg:w-2/3  bg-white p-8 shadow-2xl rounded-lg">
                <h1 class="text-4xl font-bold text-center text-indigo-700 mb-8">Course Details</h1>
                <div class="mb-8 flex justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-indigo-700">Title</h2>
                        <p class="text-gray-800 mt-2 text-lg"><?php echo $courseDetails['title']; ?></p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold text-indigo-700">Teacher</h2>
                        <p class="text-gray-800 mt-2 text-lg"><?php echo $courseDetails['username']; ?></p>
                    </div>
                </div>
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-indigo-700">Content</h2>
                    <div class="mt-4">
                        <?php
                        $checkEnroll = enroll::checkIfEnroll($conn, $user_id, $course_id, null);
                        
                        if($checkEnroll) {
                            echo '
                            <video class="w-full rounded-lg shadow-md h-[600px]" controls>
                                <source src='.$courseDetails["content"].' type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            ';
                        } else {
                            echo "You need enroll first to see the content";
                            echo '<a href="../../forms/enroll.php?course_id='.$course_id.'" class="w-28 block bg-indigo-600 text-white px-4 py-2 rounded-md mt-2 hover:bg-indigo-700 duration-300">Enroll Now</a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-indigo-700">Description</h2>
                    <p class="text-gray-800 mt-2 text-lg"><?php echo $courseDetails['description']; ?></p>
                </div>
            </div>  
        </div>
    </div>
    

</body>

</html>