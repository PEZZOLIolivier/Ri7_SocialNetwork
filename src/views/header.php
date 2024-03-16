<header class='shadow-sm py-4 px-4 bg-white font-[sans-serif] min-h-[50px]'>
    <div class='flex flex-wrap items-center justify-between gap-5 relative'>
        
        <div class='flex lg:order-1 max-sm:ml-auto items-center mx-auto'>
            <div class='flex'>
                <div class='flex mx-auto w-full py-1.5'>
                    <?php 
                    if(isset($_SESSION['user_id'])): 
                        // Vérifier si la variable $username est définie avant de l'afficher
                        echo "<p class='mr-1'>Bonjour </p>" . $_SESSION['username'] ; 
                    ?>
                </div>
               
                <a href="/logout" class='flex w-full justify-center rounded-md bg-indigo-600 px-3 mx-2 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:shadow'>Logout</a>
            </div>
            <?php  else: ?>
            <div class="flex mx-auto w-full">
                <a href="/login" class='flex text-center rounded-md bg-indigo-600 px-3 mx-2 py-1 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:shadow'>Login</a>
                <a href="/register" class='flex text-center rounded-md bg-indigo-600 px-3 mx-2 py-1 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:shadow'>Sign Up</a>
            </div>    
                <?php endif; ?>
        </div>
    </div>
</header>