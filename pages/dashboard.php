<?php
session_start();
require '../db.php';
require '../classes/user.php';

$data = new Database;
$conn = $data->getConnection();

$result = $conn->query("SELECT * FROM courses");
$userNameResult = $conn->query("SELECT username FROM users");

if ($userNameResult && $userNameResult->rowCount() > 0) {
    $userNameRow = $userNameResult->fetch(PDO::FETCH_ASSOC);
    $userName = $userNameRow['username'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Youdemy | Dashboard</title>
</head>

<body class="bg-blue-50">
    <!-- navbar -->
        <div class="navbar flex justify-between bg-white shadow-md p-4">
            <div class="flex-1">
                <a class="text-2xl font-bold text-indigo-600" href="#">B.Post</a>
            </div>
            <div class="flex-none">
                <ul class="flex space-x-4">
                    <li><a class="text-gray-700 hover:text-indigo-600" href="#">Home</a></li>
                    <li><a class="text-gray-700 hover:text-indigo-600" href="#">Blog</a></li>
                    <li><a class="text-gray-700 hover:text-indigo-600" href="#">Contact</a></li>
                    <li>
                        <details class="relative">
                            <summary class="hover:underline text-red-600 cursor-pointer hover:text-indigo-600" style="list-style: none;">
                            <?php
                            $userName;
                            ?>
                            </summary>
                            <ul class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                                <li><a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="#">Edit</a></li>
                                <li><a class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white" href="#">Log-out</a></li>
                            </ul>
                        </details>
                    </li>
                </ul>
            </div>
        </div>

        <div>
            
        </div>

    <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg w-1/3">
        <img alt=""
            src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
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
    </article>
</body>

</html>