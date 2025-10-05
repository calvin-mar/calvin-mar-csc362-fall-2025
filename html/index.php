<!DOCTYPE html>
<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <?php echo '<p>Hello World</p>'; ?>
        <?php
            if (str_contains($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
        ?>
                <h3>str_contains() returned true</h3>
                <p>You are using Firefox. </p>
        <?php
        } elseif (str_contains($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
        ?>
                <h3>str_contains() returned true</h3>
                <p> You are using Google Chrome</p>
        <?php
        } elseif (str_contains($_SERVER['HTTP_USER_AGENT'], 'Safari')) {
        ?>
                <h3>str_contains() returned true</h3>
                <p> You are using Safari</p>
        <?php
        } else{
        ?>
                <h3>str_contains() returned false</h3>
                <p> Who know what browser you are using.</p>
        <?php 
    }?>
    <form action="action.php" method="post">
    <label for="name">Your name:</label>
    <input name="name" id="name" type="text">

    <label for="age">Your age:</label>
    <input name="age" id="age" type="number">

    <button type="submit">Submit</button>
    </form> 
    </body>
</html>