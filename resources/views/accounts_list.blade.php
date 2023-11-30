<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Main Menu</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>

<body>
    <h1 style="margin-left:auto;margin-right:auto;width:fit-content">Accounts List</h1>

    <table border="1">
        <thead>
            <tr>
                <td>Account Name</td>
                <td>Amount</td>
                <td>Status</td>
            </tr>
        </thead>
        <?php
        foreach ($accounts as $account) {
            $symbol = '';
            switch ($account->currency) {
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

            if($account->approved == 1){
                $approved = 'Open';
            }
            else{
                $approved = 'Closed';
            }
            echo "<tr><td>$account->account_name</td><td>$symbol$account->amount</td><td>$approved</td></tr>";
        }
        ?>

    </table>

    <p style="margin-left:auto;margin-right:auto;width:fit-content"><a href="/user-menu">Return to Main Menu</a></p>

</body>

</html>