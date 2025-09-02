<?php
require "db_connect.php";
$fname = $surname = $phone = $email = $password = $dob = $gender = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fname"]) && isset($_POST["surname"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $fname = $_POST["fname"];
    $surname = $_POST["surname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];

    if(empty($fname) && empty($surname) && empty($phone) && empty($email) && empty($password) && empty($dob) && empty($gender) && empty($gender)) {
        header("Location: ".$_SERVER['PHP_SELF']."?success=0");
        echo "<script>alert('All fields are required.');</script>";
    }else{
        $sql =
        "INSERT INTO login_info (fname, surname, phone, email, password, dob, gender) 
    VALUES ('$fname', '$surname', '$phone', '$email', '$password', '$dob', '$gender')";
    $result = mysqli_query($conn, $sql);
    if ($result === TRUE) {
        $record = true;
        header("Location: ".$_SERVER['PHP_SELF']."?success=1");
        echo "<script>console.log('" . $record . "');</script>";
    }
    }

}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Style Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="flex flex-col md:flex-row md:space-x-16 items-center max-w-5xl w-full">

            <!-- Left Side -->
            <div class="md:w-1/2 mb-10 md:mb-0 text-center md:text-left">
                <h1 class="text-blue-600 text-5xl font-bold">Facebook</h1>
                <p class="mt-4 text-xl text-gray-700">Connect with friends and the world around you on Facebook.</p>
            </div>

            <!-- Right Side (Login Card) -->
            <div class="md:w-1/3 w-full">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <form action="profile.php" method="post">
                        <input id="loginEmail" name="loginEmail" type="text" placeholder="Email or Phone Number"
                            class="w-full mb-3 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <input id="loginPass" name="loginPass" type="password" placeholder="Password"
                            class="w-full mb-3 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Log In</button>
                    </form>

                    <a href="#" class="block text-center text-blue-600 text-sm mt-3 hover:underline">Forgotten password?</a>

                    <hr class="my-4">

                    <!-- Open Modal -->
                    <button onclick="document.getElementById('registerModal').classList.remove('hidden')"
                        class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">Create New Account</button>
                </div>

                <p class="text-center text-sm mt-6">
                    <span class="font-semibold">Create a Page</span> for a celebrity, brand or business.
                </p>
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div id="registerModal" class="hidden fixed inset-0 flex items-center justify-center bg-red-50/50 z-50">
        <div class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6 relative">

            <!-- Close Button -->
            <button onclick="document.getElementById('registerModal').classList.add('hidden')"
                class="absolute top-3 right-3 text-gray-600 hover:text-black text-xl font-bold">&times;</button>

            <!-- Header -->
            <div class="mb-4">
                <h2 class="text-2xl font-bold">Create a new account</h2>
                <p class="text-gray-600 text-sm">It’s quick and easy.</p>
            </div>
            <hr class="mb-4">

            <!-- Registration Form -->
            <form class="space-y-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="flex space-x-3">
                    <input id="fname" name="fname" type="text" placeholder="First name"
                        class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                    <input id="surname" name="surname" type="text" placeholder="Surname"
                        class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                </div>

                <input id="phone" name="phone" type="text" placeholder="Mobile number"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />

                <input id="email" name="email" type="text" placeholder="Email address"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />

                <input id="password" name="password" type="password" placeholder="New password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />

                <!-- Birthday -->
                <div>
                    <label class="text-sm text-gray-700 font-medium">Birthday</label>
                    <div class="flex space-x-2 mt-1">
                        <input id="dob" name="dob" type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Gender -->
                <div>
                    <label class="text-sm text-gray-700 font-medium">Gender</label>
                    <div class="flex space-x-4 mt-1">
                        <label class="flex items-center space-x-2 border border-gray-300 rounded-lg px-3 py-2 w-1/3">
                            <input id="gender" type="radio" name="gender" value="male">
                            <span>Male</span>
                        </label>
                        <label class="flex items-center space-x-2 border border-gray-300 rounded-lg px-3 py-2 w-1/3">
                            <input id="gender" type="radio" name="gender" value="female">
                            <span>Female</span>
                        </label>
                    </div>
                </div>

                <!-- Terms -->
                <p class="text-xs text-gray-500 leading-4">
                    By clicking Sign Up, you agree to our Terms, Privacy Policy and Cookies Policy.
                </p>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-green-600 text-white py-2.5 rounded-lg font-semibold hover:bg-green-700 transition">
                    Sign Up
                </button>
            </form>
        </div>
    </div>

</body>

</html>