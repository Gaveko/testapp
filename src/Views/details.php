<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
    <link rel="stylesheet" href="<?php echo STATIC_PATH.'/css/style.css';?>"/>
</head>
<body>
    <nav>
        <h1>Details Page</h1>
        <button id="createBook">Create new Book</button>
    </nav>
    <hr>

    <img src="<?php echo STORAGE_PATH.'/images/'.$this->context['book']->getImage(); ?>" alt="">
    <hr>
    <?php 
        echo $this->context['book']->getTitle(); 
        echo "<hr>";
        echo $this->context['book']->getPrice(); 
        echo "<hr>";
        echo $this->context['book']->getDescription(); 
        echo "<hr>";
        echo $this->context['book']->getAuthor()->getFullname(); 
        echo "<hr>";
        echo $this->context['book']->getCategory()->getTitle(); 
        echo "<hr>";
    ?>

    <script src=<?php echo STATIC_PATH.'/js/index.js';?>></script>
</body>
</html>