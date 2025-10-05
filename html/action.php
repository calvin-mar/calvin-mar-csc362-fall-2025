Hi <?php echo htmlspecialchars($_POST['name']); ?>.
You are <?php echo (int) $_POST['age']; ?> years old. 
<?php 
    if (htmlspecialchars($_POST['name'])=== 'Sam' && (int) $_POST['age'] === 22) {
        echo '<br>Happy Birthday Sam!';
    }
?>