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
            <a class="text-2xl font-bold text-indigo-600 hover:text-2xl duration-300" href="../pages/courses/allCourses.php"><i class="text-red-500">You</i>demy</a>
        </div>
        <div class="flex-none">
            <ul class="flex space-x-4">
                <li><a class="text-gray-700 hover:text-indigo-600" href="../pages/courses/allCourses.php">Home</a></li>
                <li><a class="text-gray-700 hover:text-indigo-600" href="#">Courses</a></li>
                <li><a class="text-gray-700 hover:text-indigo-600" href="#">Contact</a></li>
            </ul>
        </div>
    </div>

    <!-- main content -->
    <section class="bg-blue-50">
        <div class="mx-auto max-w-screen-xl px-4 py-28 lg:flex lg:h-screen lg:items-center">
            <div class="mx-auto max-w-xl text-center">
                <h1 class="text-3xl font-extrabold sm:text-5xl">
                    Understand User Flow.
                    <strong class="font-extrabold text-red-700 sm:block"> Increase Conversion. </strong>
                </h1>

                <p class="mt-4 sm:text-xl/relaxed">
                Learning is a continuous journey that empowers individuals to grow and achieve their goals. By embracing new knowledge and skills, you can unlock your potential and open doors to endless opportunities.
                </p>

                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <a
                        class="block w-full rounded bg-red-600 px-12 py-3 text-sm font-medium text-white shadow hover:bg-red-700 focus:outline-none focus:ring active:bg-red-500 sm:w-auto"
                        href="./autho/register.html">
                        Join Now
                    </a>

                    <a
                        class="block w-full rounded px-12 py-3 text-sm font-medium text-red-600 shadow hover:text-red-700 focus:outline-none focus:ring active:text-red-500 sm:w-auto"
                        href="./courses/allCourses.php">
                        Continue Without Register
                    </a>
                </div>
            </div>
        </div>
    </section>

</body>

</html>