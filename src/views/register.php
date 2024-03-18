<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ri7 Mini Réseau Social | Enregistrement</title>
</head>
<body class="h-screen">
    <?php  
        include('header.php'); 
    ?>
    <div class="flex flex-col justify-center px-6 py-6 lg:px-8 border-solid container mx-auto my-5 rounded-xl shadow">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Ri7SocialNetwork">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Créez votre compte</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="/register" method="POST">
          <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">E-mail</label>
            <div class="mt-2">
              <input 
                id="email" 
                name="email" 
                type="text" 
                autocomplete="email" 
                required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
          <div>
            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Nom d'utilisateur</label>
            <div class="mt-2">
              <input 
                id="username" 
                name="username" 
                type="text" 
                autocomplete="username" 
                required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
            </div>
            <div class="mt-2">
              <input 
                id="password" 
                name="password" 
                type="password" 
                autocomplete="current-password" 
                required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <button 
              value="Register" 
              type="submit" 
              class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm 
                     hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Connexion
            </button>
          </div>
        </form>
    </div>
</body>
</html>

   