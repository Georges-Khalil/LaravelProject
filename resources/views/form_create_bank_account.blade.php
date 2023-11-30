<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Main Menu</title>
  <link rel="stylesheet" href="{{asset('style.css')}}">
</head>

<body>
  <h1 style="margin-left:auto;margin-right:auto;width:fit-content">Create Bank Account</h1>

  <table border="0">
    <tr>

      <td>Account Name :</td>
      <td>
        <form action="/submit-form-create-bank-account" method="POST"> @csrf
          <input name="accountName" type="text" />
      </td>
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
          <input type="submit" name="create" value="Create" />
        </div>
        </form>
      </td>

    </tr>

  </table>
  <p style="margin-left:auto;margin-right:auto;width:fit-content"><a href="/user-menu">Return to Main Menu</a></p>

</body>

</html>