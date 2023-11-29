<!DOCTYPE html>
<html>

<head>
  <title>Create Account</title>
  <link rel="stylesheet" href="{{asset('styles.css')}}">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
  <div class="conteneur_form">
    <h1 class="titre_form">Create Account Form</h1>
  
    <form class="conteneur_gris" action='/create-user-send' method="post"> @csrf
      <div class="conteneur_ligne">
        <label class="label_ligne" for="username"> Username: </label>
        <input class="input_ligne" type="text" id="username" name="username"><br><br>
      </div>
      <div class="conteneur_ligne">
        <label class="label_ligne" for="password">Password:</label>
        <input class="input_ligne" type="text"  id="password" name="password"><br><br>
      </div>

      <div class="conteneur_ligne">
        <label class="label_ligne"></label>
        <div class="input_ligne">
          <input class="bt_envoyer" type="submit" value="Create">
        </div>
      </div>
    
    </form>
  </div>
    </body>

</html>