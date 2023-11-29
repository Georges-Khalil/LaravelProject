<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" href="{{asset('styles.css')}}">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
  <div class="conteneur_form">
    <h1 class="titre_form">Login Form</h1>
  
    <form class="conteneur_gris" action='/submit-login' method="post"> @csrf
      <div class="conteneur_ligne">
        <label class="label_ligne" for="username"> Username: </label>
        <input class="input_ligne" type="text" id="username" name="username"><br><br>
      </div>
      <div class="conteneur_ligne">
        <label class="label_ligne" for="password">Password:</label>
        <input class="input_ligne" type="password"  id="password" name="password"><br><br>
      </div>

      <div class="conteneur_ligne">
        <label class="label_ligne"></label>
        <div class="input_ligne">
          <input class="bt_envoyer" type="submit" value="Login">
        </div>
      </div>

      <div class="conteneur_ligne">
        <label class="label_ligne"></label>
        <div class="input_ligne">
          <a href='/create-user'>Create an account</a>
        </div>
      </div>
    
    </form>
  </div>
    </body>

</html>