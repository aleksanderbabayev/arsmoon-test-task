<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        td {
            text-align: center;
        }
    </style>
    <title>Calls Statistics</title>
</head>
<body>
    <table border="1">
        <thead>
        <tr>
            <th>Customer ID</th>
            <th>Number of calls within the same continent</th>
            <th>Total Duration of calls within the same continent</th>
            <th>Total number of all calls</th>
            <th>The total duration of all calls</th>
        </tr></thead>
        <tbody>
            <?php foreach ($stats as $customerId => $data): ?>
                <tr>
                    <td><?php echo $customerId ?></td>
                    <td><?php echo $data['num_calls_same_continent'] ?></td>
                    <td><?php echo $data['total_duration_same_continent'] ?></td>
                    <td><?php echo $data['total_num_calls'] ?></td>
                    <td><?php echo $data['total_duration'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>