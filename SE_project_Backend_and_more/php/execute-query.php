<?php require_once("../php/dbconnect.php");
if (!isset($_POST['query'])) {
    echo "Error: query parameter is missing";
    exit;
}



try {
   

    $stmt = $pdo->prepare($query);
    echo "hi ";
    $success = $stmt->execute();
    echo "success ";

    if (preg_match('/^\s*(SELECT|PRAGMA)\b/i', $query)) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $output = '<table>';
        foreach ($rows as $row) {
            $output .= '<tr>';
            foreach ($row as $value) {
                $output .= '<td>' . htmlspecialchars($value) . '</td>';
            }
            $output .= '</tr>';
        }
        $output .= '</table>';
    } else {
        $output = $success ? 'Query executed successfully' : 'Error executing query';
    }

    echo $output;
} catch (PDOException $e) {
    echo 'Error connecting to database: ' . $e->getMessage();
}
