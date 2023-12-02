<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Access User</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
    
<body>
    <header>
    <h1>Access User</h1>
    <form class="conteneur_gris" action='/submt-access-user' method="post"> @csrf
        <div class="conteneur_ligne">
            <label class="label_ligne" for="username"> Username: </label>
            <input class="input_ligne" type="text" id="username" name="username"><br><br>
        </div>
        <div class="conteneur_ligne">
            <label class="label_ligne"></label>
            <div class="input_ligne">
                @if (session('error'))
                    <div style="color: red;">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="conteneur_ligne">
            <label class="label_ligne"></label>
            <div class="input_ligne">
                <input class="bt_envoyer" type="submit" value="Access">
            </div>
        </div>
        <div class="conteneur_ligne">
            <label class="label_ligne"></label>
            <div class="input_ligne">
                <a href='/agent-menu'>Go back to menu</a>
            </div>
        </div>
    </form>

    </header>
</body>

</html>
