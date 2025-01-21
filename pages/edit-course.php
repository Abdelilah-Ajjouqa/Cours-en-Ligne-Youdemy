<?php
session_start();
require '../db.php';
require '../classes/user.php';

$data = new Database;
$conn = $data->getConnection();

if (!isset($_SESSION['email'])) {
    header("location: ./login.html");
    exit();
} else {
    $user = new User($_SESSION['email']);
    $username = $user->getUserName();

    $course = new Courses($conn, '', '', '', '');
    $title = $course->getCourseTitle($conn);
    $description = $course->getCourseDescription($conn);
    $content = $course->getCourseContent($conn);
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
                                <li>
                                    <a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="./edit.php">
                                        Edit
                                    </a>
                                </li>
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

    <!-- form -->
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg">
            <h1 class="text-center text-2xl font-bold text-indigo-600 sm:text-3xl">Update Your Account</h1>

            <form method="post" action="./teacher.php" class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">

                <div>
                    <label for="firstname" class="sr-only">First Name</label>

                    <div class="relative">
                        <input type="text" name="firstname" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="<?php echo $firstname; ?>" />
                    </div>
                </div>

                <div>
                    <label for="lastname" class="sr-only">Last Name</label>

                    <div class="relative">
                        <input type="text" name="lastname" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="<?php echo $lastname; ?>" />
                    </div>
                </div>

                <div>
                    <label for="username" class="sr-only">Username</label>

                    <div class="relative">
                        <input type="text" name="username" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="<?php echo $username; ?>" />
                    </div><br>

                <button type="submit"
                    class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">
                    Done
                </button>
            </form>
        </div>
    </div>
</body>

</html>