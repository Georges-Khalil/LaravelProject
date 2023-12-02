<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Main Menu</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>

<body>
    <h1 style="margin-left:auto;margin-right:auto;width:fit-content">Transfer Funds</h1>

    <table border="0">
        <form action="/submit-form-transfer" method="post"> @csrf
            <td>Account Name :</td>
            <td>
                <input name="sender_account_name" type="text" />
            </td>
            </tr>
            <tr>
                <td>Amount to Transfer :</td>
                <td><input name="amount" type="text" /></td>
            </tr>
            <tr>
                <td>Currency :</td>
                <td>
                    <select name="currency">
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="LBP">LBP</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Recipient Username :</td>
                <td><input name="recipient_username" type="text" /></td>
            </tr>
            <tr>
                <td>Recipient Account Name :</td>
                <td><input name="recipient_account_name" type="text" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    @if (session('error'))
                    <div style="color: red;">
                        {{ session('error') }}
                    </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="transfer" value="Transfer" />
                    </div>
                </td>
            </tr>
        </form>
    </table>
    <p style="margin-left:auto;margin-right:auto;width:fit-content"><a href="/user-menu">Return to Main Menu</a></p>
</body>

</html>