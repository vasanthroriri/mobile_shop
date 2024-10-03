<?php
 include "db/dbConnection.php";

 echo "vasanth";

// Get the sum of income and expenses for online and cash
$income_expense_sql = "
SELECT 
    tran_method, 
    SUM(CASE WHEN tran_category = 'income' THEN tran_amount ELSE 0 END) AS total_income,
    SUM(CASE WHEN tran_category = 'expense' THEN tran_amount ELSE 0 END) AS total_expense
FROM 
    jeno_transaction
GROUP BY 
    tran_method
";

$result = $conn->query($income_expense_sql);

$close_online_income = 0;
$close_online_expense = 0;
$close_cash_income = 0;
$close_cash_expense = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['tran_method'] == 'Online') {
            $close_online_income = $row['total_income'];
            $close_online_expense = $row['total_expense'];
        } elseif ($row['tran_method'] == 'Cash') {
            $close_cash_income = $row['total_income'];
            $close_cash_expense = $row['total_expense'];
        }
    }
}

// Calculate the closing balances
$close_online_balance = $close_online_income - $close_online_expense;
$close_cash_balance = $close_cash_income - $close_cash_expense;


// Assume these values are for the next day's opening balance
$open_date = date('Y-m-d'); // Set the correct date
$open_online_balance = $close_online_balance;
$open_cash_balance = $close_cash_balance;

// Insert the next day's opening balance
$insert_sql = "INSERT INTO jeno_opening (open_date, open_open_online, open_open_cash, open_close_online, open_close_cash) VALUES (?, ?, ?, 0, 0)";
$stmt = $conn->prepare($insert_sql);
$stmt->bind_param("sdd", $open_date, $open_online_balance, $open_cash_balance);
$stmt->execute();
$stmt->close();

// Update the current day's closing balance
$update_sql = "UPDATE jeno_opening SET open_close_online = ?, open_close_cash = ? WHERE open_date = ?";
$current_date = date('Y-m-d'); // Set the correct current date
$stmt = $conn->prepare($update_sql);
$stmt->bind_param("dds", $close_online_balance, $close_cash_balance, $current_date);
$stmt->execute();
$stmt->close();

$conn->close();
?>
