<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Ri7 Social Network | Home</title>
</head>
<body class="h-screen">

<?php 
    include('header.php'); 

    // Vérifier si l'utilisateur est connecté
    if(isset($_SESSION['username'])) {
        // Si l'utilisateur est connecté
        echo '<h1 class="text-center text-4xl font-bold sans-serif my-5">Bonjour ' . $_SESSION['username'] . ', bienvenue sur le mini réseau social de Ri7</h1>';
    } else {
        // Si personne n'est connecté
        echo '<h1 class="text-center text-4xl font-bold sans-serif my-5">Bienvenue sur le mini réseau social de Ri7</h1>';
    }
?>

    <div class="flex flex-col">
    <div class="bg-gray-200 flex-1 overflow-y-scroll">
        <div class="px-4 py-2">
            <div class="bg-gray-200 flex-1 overflow-y-scroll">
                <div class="px-4 py-2">
                <?php if ($posts): ?>
    <?php foreach ($posts as $post): ?>
        <div class="flex items-center my-2">
            <div class="ml-4 <?= isset($_SESSION['username']) && $post['author'] === $_SESSION['username'] ? 'bg-indigo-600 text-white p-2 rounded-lg' : '' ?> font-bold"><?= $post['author'] ?> dit:</div>
            <?php if (isset($_SESSION['username']) && $post['author'] === $_SESSION['username']): ?>
                <!-- Utilisation du bouton menu_edit avec les attributs data-post-* correctement définis -->
                <a href="#" class="edit-button ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" 
                   data-post-id="<?= $post['id'] ?>" 
                   data-post-title="<?= $post['title'] ?>" 
                   data-post-content="<?= $post['content'] ?>" 
                   data-post-author="<?= $post['author'] ?>"
                   onclick="openEditModal(this); return false;">
                   <i class="material-icons">menu_edit</i>
                </a>

                <a href="index.php?action=deletePost&postId=<?= $post['id'] ?>" class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le post avec l\'ID <?= $post['id'] ?> ?');"><i class="material-icons">delete</i></a>
                
            <?php endif; ?>
        </div>
        <div class="<?= isset($_SESSION['username']) && $post['author'] === $_SESSION['username'] ? 'bg-indigo-600 text-white' : 'bg-white' ?> rounded-lg p-2 shadow mb-2 max-w-sm">
            <div class="font-semibold underline"><?= $post['title'] ?>:</div>
            <div class="italic text-sm"><?= $post['content'] ?></div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    Aucun message trouvé.
<?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'édition-->
<div id="editModal" class="modal">
  <div class="modal-content mb-20">
    <span class="close" onclick="closeEditModal()">&times;</span>
    <h2>Édition du post</h2>
    <form id="editForm" class="max-w-sm mx-auto" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=editPost"><!-- Correction du chemin d'action -->
      <div class="mb-5">
        <label for="editAuthor" class="block mb-2 text-sm font-medium text-gray-900 text-indigo-600">Auteur</label>
        <input type="text" id="editAuthor" name="author" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" readonly /> <!-- Champ de texte désactivé pour afficher l'auteur -->
      </div>
      <div class="mb-5">
        <label for="editTitle" class="block mb-2 text-sm font-medium text-gray-900 text-indigo-600">Titre</label>
        <input type="text" id="editTitle" name="title" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
      </div>
      <div class="mb-5">
        <label for="editContent" class="block mb-2 text-sm font-medium text-gray-900 text-indigo-600">Message</label>
        <input type="text" id="editContent" name="content" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
      </div>
      <input class="mb-5" type="hidden" id="editPostId" name="id" />
      <button value="editPost" type="submit" class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center hover:bg-blue-700 focus:ring-blue-800">Sauvegarder les modifications</button> <!-- Bouton de soumission du formulaire -->
    </form>
  </div>
</div>

    <div id='message' class='fixed bottom-0 left-0 right-0 bg-gray-100 px-4 py-2'>
        <?php 
            if(isset($_SESSION['user_id'])): 
                // Vérifier si la variable $username est définie avant de l'afficher 
                $author = $_SESSION['username'];
        ?>
            <div class='w-full'>
            <form id="addpostzone" method="POST" action="index.php">
                <div class='flex items-center'>
                  <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                  <input type="text" name="content" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                  <input type="hidden" name="action" value="addPost">
                  <button type='submit' class='bg-indigo-600 hover:bg-indigo-800 text-white font-medium py-2 px-4 rounded-full'>
                      Envoyer
                  </button>
                </div>
            </form>
            </div>
        <?php else: ?>
            <div class='flex items-center'>
                <p class='w-full text-center text-3xl text-red-700 font-bold'>Vous devez être connecté pour poster un message !</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- JavaScript pour ouvrir et préremplir la modal -->
<script>


    document.addEventListener("DOMContentLoaded", function() {
        var editButtons = document.querySelectorAll('.edit-button');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var postId = button.getAttribute('data-post-id');
                var title = button.getAttribute('data-post-title');
                var content = button.getAttribute('data-post-content');
                var author = button.getAttribute('data-post-author');

                openEditModal(postId, title, content, author);
            });
        });
    });

    function openEditModal(postId, title, content, author) {
        var modal = document.getElementById("editModal");
        var titleInput = document.getElementById("editTitle");
        var contentInput = document.getElementById("editContent");
        var authorInput = document.getElementById("editAuthor");
        var postIdInput = document.getElementById("editPostId");
        var editForm = document.getElementById("editForm");
        
        titleInput.value = title;
        contentInput.value = content;
        authorInput.value = author;
        postIdInput.value = postId;
        
        // Modifier l'action du formulaire pour la mise à jour du post
        editForm.action = "<?php echo $_SERVER['PHP_SELF']; ?>?action=editPost&postId=" + postId;
        
        modal.style.display = "block";
    }

    function closeEditModal() {
        var modal = document.getElementById("editModal");
        modal.style.display = "none";
    }

    function submitPostForm() {
        document.getElementById("postForm").submit();
    }
</script>



</body>
</html>
