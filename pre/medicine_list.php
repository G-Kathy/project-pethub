<?php
$host = 'localhost';
$db = 'search_for_medicine_list';
$user = 'root';
$pass = 'pethub@12';

try {
    $con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['action']) && $_GET['action'] == 'view') {
        $stmt = $con->prepare('SELECT * FROM search_for_medicine_list');
        $stmt->execute();
        $medicines = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $medicines = [];
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine List</title>
    <link rel="stylesheet" href="medicine_list.css">
</head>
<body>
    <div class="container">
        <header>
            <button onclick="location.href='petcare.php'">Back</button>
            <h1>Medicine List</h1>

        </header>
        <main>
            <table id="tblMedicineList">
                <thead>
                    <tr>
                        <th>Animal Name</th>
                        <th>Medicine Name</th>
                        <th>Information</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medicines as $medicine): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($medicine['AnimalName']); ?></td>
                        <td><?php echo htmlspecialchars($medicine['MedicineName']); ?></td>
                        <td><?php echo htmlspecialchars($medicine['Information']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button id="btnView">View</button>
        </main>
        <footer>
            <img src="PetMed.png" alt="Pet Medicine">
            <img src="PetMed1.png" alt="Pet Medicine 1">
        </footer>
    </div>
    <script>
        document.getElementById('btnView').addEventListener('click', function() {
            window.location.href = 'medicine_list.php?action=view';
        });
    </script>
</body>
</html>