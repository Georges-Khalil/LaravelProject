<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Main Menu</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>

<body>
    <h1 style="margin-left:auto;margin-right:auto;width:fit-content">Deposit or Withdraw</h1>

    <table border="0">
        <form action="/submit-form-deposit-withdraw" method="post"> @csrf
            <tr>
            <td>Username :</td>
            <td>
                <input name="username" type="text" />
            </td>
            </tr>
            <tr>
            <td>Account Name :</td>
            <td>
                <input name="account_name" type="text" />
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
                        <input type="submit" name="Submit" value="Submit" />
                    </div>
                </td>
            </tr>
        </form>
    </table>
    <p style="margin-left:auto;margin-right:auto;width:fit-content"><a href="/agent-menu">Return to Main Menu</a></p>
</body>

</html>