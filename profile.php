<?php
require "db_connect.php";
$row = $row1 = "";
$loginEmail = $loginPass = "";
$fname = $surname = $phone = $email = $password = $dob = $gender = $profile_img = $cover_img = $address = $bio = $post_img = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_form"])) {

    $loginEmail = $_POST["loginEmail"];
    $loginPass = $_POST["loginPass"];

    $sql = "SELECT * FROM login_info WHERE email='$loginEmail' AND password='$loginPass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $sql = "SELECT * FROM user_info WHERE id='$row[id]'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $row2 = mysqli_fetch_array($result);
            $fname = $row["fname"]; $surname = $row["surname"];
            $profile_img  = $row2["profile_img"]; $cover_img  = $row2["cover_img"]; $post_img = $row2["post_img"]; $bio = $row2["bio"]; $address = $row2["address"];
        }
    } else {
        echo "Invalid email or password.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facebook Style Profile</title>
    <!-- Tailwind Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        fb: {
                            bg: '#0f1419',
                            card: '#111827',
                            primary: '#1877F2',
                            soft: '#1f2937'
                        }
                    },
                    boxShadow: {
                        'soft': '0 8px 30px rgba(0,0,0,0.12)'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-fb-bg text-white/90 antialiased">

    <!-- Top Navbar -->
    <header class="sticky top-0 z-40 backdrop-blur bg-black/30 border-b border-white/10">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center gap-3">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-xl bg-fb.primary/10">
                    <!-- Logo (F) -->
                    <div class="w-5 h-5 font-black text-fb-primary">Facebook</div>
                </div>
            </div>
            <div class="ml-auto flex items-center gap-3">
                <input type="text" placeholder="Search Facebook"
                    class="hidden md:block bg-white/10 focus:bg-white/15 transition rounded-xl px-3 py-2 text-sm placeholder-white/50 outline-none" />
                <button class="px-3 py-2 rounded-xl bg-white/10 hover:bg-white/15 transition">Log out</button>
            </div>
        </div>
    </header>

    <!-- Profile Header -->
    <section class="max-w-6xl mx-auto">
        <div class="relative">
            <img src="<?php echo "$cover_img" ?>" alt="Cover" class="w-full h-100 sm:h-72 md:h-80 object-cover">
            <div class="absolute -bottom-10 left-6 flex items-end gap-4">
                <img src="<?php echo "$profile_img" ?>" alt="Avatar"
                    class="w-28 h-28 md:w-36 md:h-36 rounded-full ring-4 ring-black object-cover shadow-soft">
                <div class="mb-2">
                    <h1 class="text-2xl md:text-3xl font-bold"><?php echo "$fname" ." ". "$surname" ?></h1>
                    <p class="text-white/60 text-sm">@<?php echo "$fname"."$surname";  echo "$address"?></p>
                </div>
            </div>
        </div>

        <!-- Action bar -->
        <div
            class="px-6 pt-14 pb-4 flex flex-wrap items-center gap-2 border-b border-white/10 bg-gradient-to-b from-black/20 to-transparent">
            <button class="px-4 py-2 rounded-xl bg-fb-primary text-white hover:opacity-90">Add to story</button>
            <button class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/15">Edit profile</button>
            <div class="ml-auto flex items-center gap-5 text-white/70 text-sm">
                <span><strong class="text-white">230</strong> friends</span>
                <span><strong class="text-white">1.5k</strong> followers</span>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <main class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-6 py-6">

        <!-- Left Column: About / Friends -->
        <aside class="md:col-span-1 space-y-6">
            <!-- About Card -->
            <section class="bg-fb.card rounded-2xl p-5 shadow-soft">
                <h2 class="text-lg font-semibold mb-3">BIO</h2>
                <p class="text-white/80 leading-relaxed"><?php echo "$bio"?></p>
                <ul class="mt-4 space-y-2 text-white/70 text-sm">
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M11.54 22.351a.75.75 0 0 0 .92 0c1.258-.97 2.3-1.92 3.182-2.812 2.842-2.864 4.608-5.502 5.435-7.503.833-2.017.788-3.63.31-4.77a6.75 6.75 0 1 0-12.29 0c-.48 1.14-.524 2.753.31 4.77.827 2.001 2.593 4.64 5.436 7.503.881.892 1.923 1.842 3.181 2.812ZM12 13.5a3.75 3.75 0 1 1 0-7.5 3.75 3.75 0 0 1 0 7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        Lives in <span class="ml-1 text-white"><?php echo "$address"?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M4.5 4.5A1.5 1.5 0 0 1 6 3h12a1.5 1.5 0 0 1 1.5 1.5V18a3 3 0 0 1-3 3h-9A4.5 4.5 0 0 1 3 16.5v-9A3 3 0 0 1 6 4.5h12V18h-1.5a1.5 1.5 0 0 1-1.5-1.5V6H6A1.5 1.5 0 0 0 4.5 7.5v9A3 3 0 0 0 7.5 19.5H15"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="#" class="hover:underline" target="_blank" rel="noreferrer">Portfolio: <span class="text-white">www.porfolio.com</span></a>
                    </li>
                </ul>
            </section>

            <!-- Friends Card -->
            <section class="bg-fb.card rounded-2xl p-5 shadow-soft">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-lg font-semibold">Friends</h2>
                    <a href="#" class="text-fb-primary text-sm">See all</a>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="group">
                        <img src="https://media.istockphoto.com/id/2182695319/photo/cute-baby-girl-wearing-autumn-clothes.webp?a=1&b=1&s=612x612&w=0&k=20&c=zEWnaN1UYjtGq10In2aw-V4sssazXxNc6TkZefPMlBM=" alt="Friend 1"
                            class="w-full aspect-square object-cover rounded-xl">
                        <div class="mt-1 text-xs text-white/80 truncate">Qaim Raza</div>
                    </div>
                    <div class="group">
                        <img src="https://media.istockphoto.com/id/2166048638/photo/portrait-of-a-serious-little-boy-sitting-in-a-chair-and-looking-at-the-camera.webp?a=1&b=1&s=612x612&w=0&k=20&c=SbWroc2w-eLHCFynCyvykXsjDb7Zn9rt755dd66_fJY=" alt="Friend 2"
                            class="w-full aspect-square object-cover rounded-xl">
                        <div class="mt-1 text-xs text-white/80 truncate">Sherry Chughtai</div>
                    </div>
                    <div class="group">
                        <img src="https://media.istockphoto.com/id/2170852552/photo/portrait-of-1-year-old-blond-haired-blue-eyed-baby-boy-in-the-park.webp?a=1&b=1&s=612x612&w=0&k=20&c=ZadYfh_OPkPVM00WkUK_DcZh8gJ7LkmRMXfPNYwB2I4=" alt="Friend 3"
                            class="w-full aspect-square object-cover rounded-xl">
                        <div class="mt-1 text-xs text-white/80 truncate">Muzammil Ahmad</div>
                    </div>
                </div>
            </section>
        </aside>

        <!-- Right: Timeline -->
        <section class="md:col-span-2 space-y-6">
            <!-- Composer -->
            <div class="bg-fb.card rounded-2xl p-5 shadow-soft">
                <div class="flex gap-3">
                    <img src="<?php echo "$profile_img" ?>" class="w-10 h-10 rounded-full" alt="">
                    <form class="flex-1">
                        <input name="post_text" placeholder="What's on your mind, <?php echo "$fname" ." ". "$surname" ?>?"
                            class="w-full bg-white/10 focus:bg-white/15 transition rounded-xl px-4 py-3 outline-none" />
                        <div class="flex items-center gap-3 mt-3">
                            <label class="text-sm bg-white/10 hover:bg-white/15 px-3 py-2 rounded-xl cursor-pointer">
                                <input type="file" name="image" class="hidden"> Photo
                            </label>
                            <button class="ml-auto px-4 py-2 rounded-xl bg-fb-primary hover:opacity-90">Post</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Example Post -->
            <article class="bg-fb.card rounded-2xl shadow-soft overflow-hidden">
                <!-- Post header -->
                <div class="p-5 flex items-start gap-3">
                    <img src="<?php echo "$profile_img" ?>" class="w-11 h-11 rounded-full" alt="">
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <a href="#" class="font-semibold hover:underline"></a>
                            <span class="text-white/50 text-sm">· 2h ago</span>
                        </div>
                        <p class="mt-2 leading-relaxed text-white/90">
                            This is a sample post text. Exciting day!
                        </p>
                    </div>
                </div>
                <img src="<?php echo "$post_img" ?>" class="w-full max-h-[550px] object-cover" alt="">

                <!-- Post actions -->
                <div class="px-5 py-3 border-t border-white/10 text-white/70 text-sm">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button class="hover:text-white">👍 Like (10)</button>
                            <button class="hover:text-white">💬 Comment (3)</button>
                            <button class="hover:text-white">↗ Share (1)</button>
                        </div>
                        <button class="hover:text-white">⋯</button>
                    </div>
                </div>

                <!-- Comments mock -->
                <div class="px-5 pb-5">
                    <div class="mt-3 flex gap-3">
                        <img src="<?php echo "$profile_img" ?>" class="w-9 h-9 rounded-full" alt="">
                        <input placeholder="Write a comment..."
                            class="flex-1 bg-white/10 focus:bg-white/15 transition rounded-full px-4 py-2 outline-none text-sm" />
                    </div>
                </div>
            </article>
        </section>
    </main>

    <!-- Footer -->
    <footer class="max-w-6xl mx-auto px-6 pb-10 text-white/50 text-sm">
        <div class="border-t border-white/10 pt-6">© 2025 Facebook-style Profile UI. For demo purposes only.</div>
    </footer>

</body>

</html>