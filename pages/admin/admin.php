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
    if ($role == 'student'){
        echo '
        
        ';

    } elseif ($role == 'teacher'){
        echo '
        
        ';

    } else{
        // header('location : ./dashboard.php');
        // exit();
    }
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

    <!-- <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg w-1/3 m-2">
        <img alt=""
            src="https://i.imgur.com/0dbDGTV.jpeg"
            class="h-56 w-full object-cover" />

        <div class="bg-white p-4 sm:p-6">
            <time datetime="2022-10-10" class="block text-xs text-gray-500"> 10th Oct 2022 </time>

            <a href="#">
                <h3 class="mt-0.5 text-lg text-gray-900">How to position your furniture for positivity</h3>
            </a>

            <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae dolores, possimus
                pariatur animi temporibus nesciunt praesentium dolore sed nulla ipsum eveniet corporis quidem,
                mollitia itaque minus soluta, voluptates neque explicabo tempora nisi culpa eius atque
                dignissimos. Molestias explicabo corporis voluptatem?
            </p>
        </div>
    </article> -->

    <?php
    
    ?>

    <h1 class="text-2xl">there's no course now</h1>
</body>

</html>