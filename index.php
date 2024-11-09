<?php
require_once 'Database.php';

$db = new Database();

// Get visit data from the database
$visitData = $db->getVisitData();

// Display the visit data
echo '<h1>Visit Data</h1>';
echo '<table>';
echo '<tr><th>Page URL</th><th>IP Address</th><th>Timestamp</th></tr>';

foreach ($visitData as $visit) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($visit['page_url']) . '</td>';
    echo '<td>' . htmlspecialchars($visit['ip_address']) . '</td>';
    echo '<td>' . htmlspecialchars($visit['timestamp']) . '</td>';
    echo '</tr>';
}

echo '</table>';
