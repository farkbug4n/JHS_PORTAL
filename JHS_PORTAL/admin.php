<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: LOGIN.php");
    exit();
}
include 'db_connect.php';

// Determine which section to show
$section = isset($_GET['section']) ? $_GET['section'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - JHS Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <!-- Side Navigation -->
    <aside class="w-64 bg-blue-800 text-white flex flex-col min-h-screen fixed left-0 top-0 z-20">
        <div class="flex items-center justify-center h-24 border-b border-blue-700">
            <img src="logo.jpg" alt="JHS Portal Logo" class="h-16 w-16 object-contain mr-2">
            <span class="font-bold text-lg">JHS Admin</span>
        </div>
        <nav class="flex-1 px-4 py-6">
            <ul class="space-y-2">
                <li><a href="admin.php?section=dashboard" class="block px-4 py-2 rounded hover:bg-blue-700 font-semibold <?php echo $section=='dashboard' ? 'bg-blue-900' : ''; ?>">Dashboard</a></li>
                <li><a href="admin.php?section=students" class="block px-4 py-2 rounded hover:bg-blue-700 <?php echo $section=='students' ? 'bg-blue-900 font-semibold' : ''; ?>">Student Management</a></li>
                <li><a href="admin.php?section=advisers" class="block px-4 py-2 rounded hover:bg-blue-700 <?php echo $section=='advisers' ? 'bg-blue-900 font-semibold' : ''; ?>">Adviser Management</a></li>
                <li><a href="admin.php?section=activity" class="block px-4 py-2 rounded hover:bg-blue-700 <?php echo $section=='activity' ? 'bg-blue-900 font-semibold' : ''; ?>">Activity Logs</a></li>
                <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-700">Help</a></li>
            </ul>
        </nav>
        <div class="px-4 pb-6 mt-auto">
            <a href="logout.php" class="block w-full text-center bg-red-500 hover:bg-red-600 px-4 py-2 rounded font-semibold">Logout</a>
        </div>
    </aside>
    <!-- Main Content -->
    <div class="flex-1 ml-64">
        <nav class="bg-blue-700 p-4 text-white flex justify-between items-center sticky top-0 z-10">
            <div class="font-bold text-xl">JHS Portal Admin</div>
            <div>
                <span class="mr-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            </div>
        </nav>
        <main class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
            <?php if ($section == 'students'): ?>
                <h1 class="text-2xl font-bold mb-4">Student Management</h1>
                <form method="get" class="mb-4 flex items-center">
                    <input type="hidden" name="section" value="students">
                    <label for="filter" class="mr-2 font-semibold">Show:</label>
                    <select name="filter" id="filter" class="border rounded px-2 py-1 mr-2">
                        <option value="all" <?php if (!isset($_GET['filter']) || $_GET['filter'] == 'all') echo 'selected'; ?>>All Students</option>
                        <option value="dropout" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'dropout') echo 'selected'; ?>>Active Dropout</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Filter</button>
                </form>
                <?php
                // Pagination logic for students
                $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                $per_page = 10;
                $offset = ($page - 1) * $per_page;
                $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
                $where = "WHERE role='student'";
                if ($filter == 'dropout') {
                    $where .= " AND status='dropout'";
                }
                $total_result = $conn->query("SELECT COUNT(*) as total FROM users $where");
                $total_students = $total_result ? $total_result->fetch_assoc()['total'] : 0;
                $total_pages = ceil($total_students / $per_page);
                $students = $conn->query("SELECT id, username, full_name, email, status FROM users $where ORDER BY id ASC LIMIT $per_page OFFSET $offset");
                ?>
                <div class="overflow-x-auto mb-4">
                    <table class="min-w-full bg-white border border-gray-200 rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border-b">#</th>
                                <th class="py-2 px-4 border-b">Username</th>
                                <th class="py-2 px-4 border-b">Full Name</th>
                                <th class="py-2 px-4 border-b">Email</th>
                                <th class="py-2 px-4 border-b">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($students && $students->num_rows > 0) {
                                $i = $offset + 1;
                                while ($student = $students->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='py-2 px-4 border-b'>" . $i++ . "</td>";
                                    echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($student['username']) . "</td>";
                                    echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($student['full_name']) . "</td>";
                                    echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($student['email']) . "</td>";
                                    echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($student['status']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='py-4 text-center text-gray-500'>No students found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-between items-center">
                    <span>Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>
                    <div>
                        <?php if ($page > 1): ?>
                            <a href="admin.php?section=students&page=<?php echo $page-1; ?>&filter=<?php echo $filter; ?>" class="px-3 py-1 bg-blue-200 text-blue-800 rounded hover:bg-blue-300 mr-2">Previous</a>
                        <?php endif; ?>
                        <?php if ($page < $total_pages): ?>
                            <a href="admin.php?section=students&page=<?php echo $page+1; ?>&filter=<?php echo $filter; ?>" class="px-3 py-1 bg-blue-200 text-blue-800 rounded hover:bg-blue-300">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php elseif ($section == 'advisers'): ?>
                <h1 class="text-2xl font-bold mb-4">Adviser Management</h1>
                <form method="get" class="mb-4 flex items-center">
                    <input type="hidden" name="section" value="advisers">
                    <label for="filter" class="mr-2 font-semibold">Show:</label>
                    <select name="filter" id="filter" class="border rounded px-2 py-1 mr-2">
                        <option value="all" <?php if (!isset($_GET['filter']) || $_GET['filter'] == 'all') echo 'selected'; ?>>All Adviser</option>
                        <option value="subjects" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'subjects') echo 'selected'; ?>>Assigned Subjects</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Filter</button>
                </form>
                <?php
                $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
                $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                $per_page = 10;
                $offset = ($page - 1) * $per_page;
                if ($filter == 'subjects') {
                    // Show advisers with their assigned subjects
                    $total_result = $conn->query("SELECT COUNT(DISTINCT u.id) as total FROM users u JOIN adviser_subjects s ON u.id = s.adviser_id WHERE u.role='teacher'");
                    $total_advisers = $total_result ? $total_result->fetch_assoc()['total'] : 0;
                    $total_pages = ceil($total_advisers / $per_page);
                    $advisers = $conn->query("
                        SELECT u.id, u.username, u.full_name, u.email, GROUP_CONCAT(s.subject SEPARATOR ', ') as subjects
                        FROM users u
                        JOIN adviser_subjects s ON u.id = s.adviser_id
                        WHERE u.role='teacher'
                        GROUP BY u.id
                        ORDER BY u.id ASC
                        LIMIT $per_page OFFSET $offset
                    ");
                    ?>
                    <div class="overflow-x-auto mb-4">
                        <table class="min-w-full bg-white border border-gray-200 rounded">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b">#</th>
                                    <th class="py-2 px-4 border-b">Username</th>
                                    <th class="py-2 px-4 border-b">Full Name</th>
                                    <th class="py-2 px-4 border-b">Email</th>
                                    <th class="py-2 px-4 border-b">Assigned Subjects</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($advisers && $advisers->num_rows > 0) {
                                    $i = $offset + 1;
                                    while ($adviser = $advisers->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='py-2 px-4 border-b'>" . $i++ . "</td>";
                                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($adviser['username']) . "</td>";
                                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($adviser['full_name']) . "</td>";
                                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($adviser['email']) . "</td>";
                                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($adviser['subjects']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='py-4 text-center text-gray-500'>No advisers found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>
                        <div>
                            <?php if ($page > 1): ?>
                                <a href="admin.php?section=advisers&page=<?php echo $page-1; ?>&filter=<?php echo $filter; ?>" class="px-3 py-1 bg-blue-200 text-blue-800 rounded hover:bg-blue-300 mr-2">Previous</a>
                            <?php endif; ?>
                            <?php if ($page < $total_pages): ?>
                                <a href="admin.php?section=advisers&page=<?php echo $page+1; ?>&filter=<?php echo $filter; ?>" class="px-3 py-1 bg-blue-200 text-blue-800 rounded hover:bg-blue-300">Next</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                } else {
                    // Show all advisers
                    $total_result = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='teacher'");
                    $total_advisers = $total_result ? $total_result->fetch_assoc()['total'] : 0;
                    $total_pages = ceil($total_advisers / $per_page);
                    $advisers = $conn->query("SELECT id, username, full_name, email FROM users WHERE role='teacher' ORDER BY id ASC LIMIT $per_page OFFSET $offset");
                    ?>
                    <div class="overflow-x-auto mb-4">
                        <table class="min-w-full bg-white border border-gray-200 rounded">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b">#</th>
                                    <th class="py-2 px-4 border-b">Username</th>
                                    <th class="py-2 px-4 border-b">Full Name</th>
                                    <th class="py-2 px-4 border-b">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($advisers && $advisers->num_rows > 0) {
                                    $i = $offset + 1;
                                    while ($adviser = $advisers->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='py-2 px-4 border-b'>" . $i++ . "</td>";
                                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($adviser['username']) . "</td>";
                                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($adviser['full_name']) . "</td>";
                                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($adviser['email']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='py-4 text-center text-gray-500'>No advisers found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>
                        <div>
                            <?php if ($page > 1): ?>
                                <a href="admin.php?section=advisers&page=<?php echo $page-1; ?>&filter=<?php echo $filter; ?>" class="px-3 py-1 bg-blue-200 text-blue-800 rounded hover:bg-blue-300 mr-2">Previous</a>
                            <?php endif; ?>
                            <?php if ($page < $total_pages): ?>
                                <a href="admin.php?section=advisers&page=<?php echo $page+1; ?>&filter=<?php echo $filter; ?>" class="px-3 py-1 bg-blue-200 text-blue-800 rounded hover:bg-blue-300">Next</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            <?php elseif ($section == 'activity'): ?>
                <h1 class="text-2xl font-bold mb-4">Activity Logs</h1>
                <?php
                // Pagination logic for activity logs
                $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                $per_page = 10;
                $offset = ($page - 1) * $per_page;
                $total_result = $conn->query("SELECT COUNT(*) as total FROM activity_logs");
                $total_logs = $total_result ? $total_result->fetch_assoc()['total'] : 0;
                $total_pages = ceil($total_logs / $per_page);
                $logs = $conn->query("SELECT id, username, action, timestamp FROM activity_logs ORDER BY timestamp DESC LIMIT $per_page OFFSET $offset");
                ?>
                <div class="overflow-x-auto mb-4">
                    <table class="min-w-full bg-white border border-gray-200 rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border-b">#</th>
                                <th class="py-2 px-4 border-b">Username</th>
                                <th class="py-2 px-4 border-b">Action</th>
                                <th class="py-2 px-4 border-b">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($logs && $logs->num_rows > 0) {
                                while ($log = $logs->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='py-2 px-4 border-b'>" . $log['id'] . "</td>";
                                    echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($log['username']) . "</td>";
                                    echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($log['action']) . "</td>";
                                    echo "<td class='py-2 px-4 border-b'>" . $log['timestamp'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='py-4 text-center text-gray-500'>No activity logs found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-between items-center">
                    <span>Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>
                    <div>
                        <?php if ($page > 1): ?>
                            <a href="admin.php?section=activity&page=<?php echo $page-1; ?>" class="px-3 py-1 bg-blue-200 text-blue-800 rounded hover:bg-blue-300 mr-2">Previous</a>
                        <?php endif; ?>
                        <?php if ($page < $total_pages): ?>
                            <a href="admin.php?section=activity&page=<?php echo $page+1; ?>" class="px-3 py-1 bg-blue-200 text-blue-800 rounded hover:bg-blue-300">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-100 p-4 rounded shadow text-center">
                        <div class="text-3xl font-bold text-blue-700">
                            <?php
                            $result = $conn->query("SELECT COUNT(*) as total FROM users");
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            ?>
                        </div>
                        <div class="text-gray-700 mt-2">Total Users</div>
                    </div>
                    <div class="bg-green-100 p-4 rounded shadow text-center">
                        <div class="text-3xl font-bold text-green-700">
                            <?php
                            $result = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='student'");
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            ?>
                        </div>
                        <div class="text-gray-700 mt-2">Students</div>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded shadow text-center">
                        <div class="text-3xl font-bold text-yellow-700">
                            <?php
                            $result = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='teacher'");
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            ?>
                        </div>
                        <div class="text-gray-700 mt-2">Teachers</div>
                    </div>
                </div>
                <div class="mt-10">
                    <h2 class="text-xl font-semibold mb-4">Activity Logs</h2>
                    <?php
                    // Pagination logic for dashboard activity logs
                    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                    $per_page = 10;
                    $offset = ($page - 1) * $per_page;
                    $total_result = $conn->query("SELECT COUNT(*) as total FROM activity_logs");
                    $total_logs = $total_result ? $total_result->fetch_assoc()['total'] : 0;
                    $total_pages = ceil($total_logs / $per_page);
                    $logs = $conn->query("SELECT id, username, action, timestamp FROM activity_logs ORDER BY timestamp DESC LIMIT $per_page OFFSET $offset");
                    ?>
                    <div class="overflow-x-auto mb-4">
                        <table class="min-w-full bg-white border border-gray-200 rounded">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b">#</th>
                                    <th class="py-2 px-4 border-b">Username</th>
                                    <th class="py-2 px-4 border-b">Action</th>
                                    <th class="py-2 px-4 border-b">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($logs && $logs->num_rows > 0) {
                                    while ($log = $logs->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='py-2 px-4 border-b'>" . $log['id'] . "</td>";
                                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($log['username']) . "</td>";
                                        echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($log['action']) . "</td>";
                                        echo "<td class='py-2 px-4 border-b'>" . $log['timestamp'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='py-4 text-center text-gray-500'>No activity logs found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>
                        <div>
                            <?php if ($page > 1): ?>
                                <a href="admin.php?page=<?php echo $page-1; ?>" class="px-3 py-1 bg-blue-200 text-blue-800 rounded hover:bg-blue-300 mr-2">Previous</a>
                            <?php endif; ?>
                            <?php if ($page < $total_pages): ?>
                                <a href="admin.php?page=<?php echo $page+1; ?>" class="px-3 py-1 bg-blue-200 text-blue-800 rounded hover:bg-blue-300">Next</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html> 