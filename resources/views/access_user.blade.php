<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Main Menu</title>
  <link rel="stylesheet" href="{{asset('style.css')}}">
</head>

<body>
  <h1 style="margin-left:auto;margin-right:auto;width:fit-content">User Operations</h1>

  <table border="0">
    <tr>

      <td>Username :</td>
      <td>
        <form action="/submit-access-user" method="POST"> @csrf
          <input name="username" type="text" />
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
          <input type="submit" name="submit" value="Access" />
        </div>
        </form>
      </td>

    </tr>

  </table>
  <p style="margin-left:auto;margin-right:auto;width:fit-content"><a href="/agent-menu">Return to Main Menu</a></p>

</body>

</html>