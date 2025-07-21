<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'teacher') {
    header("Location: LOGIN.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard - JHS Grading Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">
  <nav class="bg-blue-700 p-4 text-white flex justify-between items-center">
    <div class="font-bold text-xl">JHS Portal Teacher</div>
    <div>
        <span class="mr-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <a href="logout.php" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</a>
    </div>
</nav>
  <main class="max-w-3xl mx-auto mt-20 text-center">
    <h1 class="text-4xl font-extrabold mb-6">Welcome, Teacher!</h1>
    <p class="text-lg mb-10">This is your dashboard. Here you can manage student grades, view class records, and post announcements.</p>
    <div class="flex justify-center gap-6 mb-8">
      <button id="enterGradesBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-xl transition">Enter Grades</button>
      <button id="viewClassListBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl transition">View Class List</button>
    </div>
    <div id="enterGradesSection" class="bg-white rounded-xl shadow p-8 mb-6 hidden">
      <h2 class="text-2xl font-bold mb-4">Enter Grades</h2>
      <form class="space-y-4">
        <div class="flex gap-4">
          <input type="text" placeholder="Student Name" class="border rounded px-3 py-2 w-1/2">
          <input type="text" placeholder="Subject" class="border rounded px-3 py-2 w-1/4">
          <input type="number" placeholder="Grade" class="border rounded px-3 py-2 w-1/4">
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl transition">Submit</button>
      </form>
    </div>
    <div id="classListSection" class="bg-white rounded-xl shadow p-8 hidden">
      <h2 class="text-2xl font-bold mb-4">Class List</h2>
      <ul class="text-left list-disc ml-6">
        <li>Juan Dela Cruz</li>
        <li>Maria Santos</li>
        <li>Carlos Reyes</li>
      </ul>
    </div>
  </main>
  <script>
    const enterGradesBtn = document.getElementById('enterGradesBtn');
    const viewClassListBtn = document.getElementById('viewClassListBtn');
    const enterGradesSection = document.getElementById('enterGradesSection');
    const classListSection = document.getElementById('classListSection');
    enterGradesBtn.addEventListener('click', () => {
      enterGradesSection.classList.toggle('hidden');
      classListSection.classList.add('hidden');
    });
    viewClassListBtn.addEventListener('click', () => {
      classListSection.classList.toggle('hidden');
      enterGradesSection.classList.add('hidden');
    });
  </script>
</body>
</html> 