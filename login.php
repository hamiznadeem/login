<?php
require "db_connect.php";

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$formDetails = false;
$fname = $surname = $phone = $email = $password = $dob = $gender = "";
$fnameErr = $surnameErr = $phoneErr = $emailErr = $passwordErr = $dobErr = $genderErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register_form"])) {

    $fname = ucfirst(test_input($_POST["fname"]));
    if(empty($fname)){
        $fnameErr = "First name is required";
        $formDetails = false;
    }elseif (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $fnameErr = "Only letters and white space allowed";
            $formDetails = false;
    }else{
        $formDetails = true;
    }

    $surname = ucfirst(test_input($_POST["surname"]));
    if(empty($surname)){
        $surnameErr = "Surname is required";
        $formDetails = false;
    }elseif (!preg_match("/^[a-zA-Z-' ]*$/", $surname)) {
            $surnameErr = "Only letters and white space allowed";
            $formDetails = false;
    }else{
        $formDetails = true;
    }
    
    $phone = test_input( $_POST["phone"]);
    if(empty($phone)){
        $phoneErr = "Phone number is required";
        $formDetails = false;
    }elseif (!preg_match("/^[0-9-]*$/", $phone)) {
            $phoneErr = "Only Numbers allowed";
            $formDetails = false;
    }else{
            $formDetails = true;
    }
    
    $email = test_input($_POST["email"]);
    if(empty($email)){
        $emailErr = "Email is required";
        $formDetails = false;
    }elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
            $emailErr = "Enter a valid email";
            $formDetails = false;
    }else{
        $formDetails = true;
    }

    $password = test_input($_POST["password"]);
    $dob = test_input($_POST["dob"]);
    $gender = test_input( $_POST["gender"]);
    
    if($formDetails){
        $sql =
            "INSERT INTO login_info (fname, surname, phone, email, password, dob, gender) 
            VALUES ('$fname', '$surname', '$phone', '$email', '$password', '$dob', '$gender')";
            $result = mysqli_query($conn, $sql);
        }else{
            echo "<script>alert('All fields are required.');</script>";
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
                        <button type="submit" name="login_form"
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
            <div class="mb-3">
                <h2 class="text-2xl font-bold">Create a new account</h2>
            </div>
            <hr class="mb-2">

            <!-- Registration Form -->
            <form class="space-y-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="grid grid-cols-1">
                        <span class="text-sm text-red-600"> <?php echo "$fnameErr"?></span>
                        <input id="fname" name="fname" type="text" placeholder="First name"
                        class=" px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="grid grid-cols-1">
                        <span class="text-sm text-red-600"> <?php echo "$surnameErr"?></span>
                        <input id="surname" name="surname" type="text" placeholder="Surname"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                </div>

                <span class="text-red-600"> <?php echo "$phoneErr"?></span>
                <input id="phone" name="phone" type="text" placeholder="Mobile number"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                    <span class="text-red-600"> <?php echo "$emailErr"?></span>
                <input id="email" name="email" type="text" placeholder="Email address"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                <input id="password" name="password" type="password" placeholder="New password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />

                <!-- Birthday -->
                <div class="grid grid-cols-2 gap-2">
                    <input id="dob" name="dob" type="date" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <div>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zinc-500" name="gender" id="gender">
                            <option class="px-2 py-1 border-gray-300 rounded-lg" value="Male">Male</option>
                            <option class="px-2 py-1 border-gray-300 rounded-lg" value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <!-- Terms -->
                <p class="text-xs text-gray-500 leading-4">
                    By clicking Sign Up, you agree to our Terms, Privacy Policy and Cookies Policy.
                </p>

                <!-- Submit -->
                <button type="submit" name="register_form"
                    class="w-full bg-green-600 text-white py-2.5 rounded-lg font-semibold hover:bg-green-700 transition">
                    Sign Up
                </button>
            </form>
        </div>
    </div>

</body>

</html>