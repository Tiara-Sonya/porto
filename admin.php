<?php
// Sesuaikan dengan konfigurasi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portofolio";

//koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Query to select data
$sql = "SELECT * FROM skills";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Portofolio Tiara Sonya</title>
    <link href="dist/output.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="dist/image/logo.png">
</head>
<body>
    <div class="w-full h-screen bg-gray-200">
        <div class="flex">
            <nav class="h-16 w-full fixed items-center z-[1000] flex bg-black shadow-md">
                <img src="dist/image/logo1.png" class="w-14 ml-5 mb-1" alt="">
                <h1 class="font-bold text-lg pl-80 text-light ">WELCOME TO ADMIN PORTOFOLIO TIARA SONYA!</h1>
            </nav>
            <div class="w-4/5 h-screen mt-18 flex flex-col absolute">
                <h1 class="mt-24 font-bold ml-6 text-xl">Skills</h1>
                <form class="mt-3 flex flex-col">
                    <div class="flex gap-3">
                        <span onclick="toggleForm()" class="bg-secondary text-white w-52 mt-3 px-5 text-center py-2 ml-5 rounded-md hover:shadow-lg hover:bg-black transition duration-300 cursor-pointer">Tambah Data</span>
                    </div>
                </form>
            </div>

            <div class="overflow-auto w-full pt-48 justify-center px-5 h-96 mx-auto">
                <table class="w-1/2 bg-white border border-gray-200 mt-5">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Id Skills</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Level</th>
                            <th class="px-4 py-2 border">Foto</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='px-4 py-2 border'>{$no}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['id_skills']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['name']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['level']}</td>";
                            echo "<td class='px-4 py-2 border'><img src='uploads/{$row['foto']}' alt='Foto' class='w-16 h-16 object-cover'></td>";
                            echo "<td class='px-4 py-6 h-auto border flex gap-3'>
                                    <a class='text-white py-2 px-4 rounded-md bg-secondary hover:underline' href='editskil.php?id={$row['id_skills']}' title='Edit'>Edit</a>
                                    <a class='text-white py-2 px-4 rounded-md bg-red-600 hover:underline' href='hapusskil.php?id={$row['id_skills']}' title='Hapus' onclick='return confirmDelete();'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Form -->
        <div id="formTambah" class="fixed inset-0 pt-20 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 h-4/5 overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Tambah Data</h2>
                    <button onclick="toggleForm()" class="text-secondary text-2xl">&times;</button>
                </div>
                <form action="tambahdataskil.php" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="id_skills" class="block text-sm font-medium text-gray-700">ID Skills</label>
                        <input type="text" name="id_skills" id="id_skills" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                        <input type="text" name="level" id="level" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                        <input type="file" name="foto" id="foto" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <button type="submit" class="w-full bg-secondary text-white py-2 rounded-md hover:shadow-lg hover:bg-black transition duration-300">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleForm() {
            document.getElementById('formTambah').classList.toggle('hidden');
        }
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus data ini?');
        }
    </script>
</body>
</html>
