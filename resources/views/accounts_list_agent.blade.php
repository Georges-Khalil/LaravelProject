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
                <td>Username</td>
                <td>Account Name</td>
                <td>Amount</td>
                <td>Status</td>
                <td>Change Status</td>
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
            else if($account->approved == 2){
                $approved = 'Closed';
            }
            else{
                $approved = 'Pending';
            }
            echo "<tr><td>$account->username</td><td>$account->account_name</td><td>$symbol$account->amount</td><td>$approved</td>";
            echo '<td>';
            echo '<form action="/change-status" method="POST">';
            echo csrf_field();
            echo '<input type="hidden" name="username" value="' . $account->username . '">';
            echo '<input type="hidden" name="account_name" value="' . $account->account_name . '">';
            echo '<input type="submit" value="Change Status">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        ?>

    </table>

    <p style="margin-left:auto;margin-right:auto;width:fit-content"><a href="/agent-menu">Return to Main Menu</a></p>

</body>

</html>