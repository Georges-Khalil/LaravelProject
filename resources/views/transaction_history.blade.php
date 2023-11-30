<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Main Menu</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>

<body>
    <h1 style="margin-left:auto;margin-right:auto;width:fit-content">Transaction History</h1>

    <table border="1">
        <thead>
            <tr>
                <td>Sender Username</td>
                <td>Sender Account Name</td>
                <td>Transfer Amount</td>
                <td>Recipient Username</td>
                <td>Recipient Account Name</td>
            </tr>
        </thead>
        <?php
        foreach ($transactions as $transaction) {
            $symbol = '';
            switch ($transaction->currency) {
                case 'USD':
                    $symbol = '$';
                    break;
                case 'EUR':
                    $symbol = '€';
                    break;
                case 'LBP':
                    $symbol = 'LBP ';
                    break;
            }

            echo "<tr><td>$transaction->username</td><td>$transaction->account_name</td><td>$symbol$transaction->transaction_amount</td><td>$transaction->receiving_username</td><td>$transaction->receiving_account_name</td></tr>";
        }
        ?>

    </table>

    <p style="margin-left:auto;margin-right:auto;width:fit-content"><a href="/user-menu">Return to Main Menu</a></p>

</body>

</html>