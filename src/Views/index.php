<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test app</title>
    <link rel="stylesheet" href="<?php echo STATIC_PATH.'/css/style.css';?>"/>
</head>
<body>
    <nav>
        <h1>Index Page</h1>
        <button id="createBook">Create new Book</button>
    </nav>
    <hr>
    <h2><?php echo $this->context['message']; ?></h2>
    <hr>
    <input id="search" type="text">
    <button onclick="search()">Search</button>
    <button onclick="sortByAsc()">Order asc</button>
    <button onclick="sortByDesc()">Order desc</button>
    <select id="categorySelect">
        <?php foreach ($this->context['categories'] as $category) { ?>
            <option value="<?php echo $category->getId(); ?>"><?php echo $category->getTitle(); ?></option>                  
        <?php } ?>
    </select>
    <button onclick="filter()">Filter</button>
    <button onclick="clearQuery()">Clear</button>
    <hr>
    <div class="container">
        <?php foreach ($this->context['books'] as $book) { ?>
            <div class="item">
                <img src="<?php echo STORAGE_PATH.'/images/'.$book->getImage(); ?>" alt="">
                <h3><?php echo $book->getTitle(); ?></h3>
                <p><?php echo $book->getPrice(); ?></p>
                <p><?php echo $book->getAuthor()->getFullname(); ?></p>
                <a href="details/<?php echo $book->getId(); ?>">More...</a>
            </div>
            
        <?php } ?>
    </div>
    
    <div>
        <?php if ($this->context['page'] - 1 > 0) {?>
            <button onclick='changePage(event)'><?php echo $this->context['page'] - 1;?></button>
        <?php } ?>
        <button onclick='changePage(event)'><?php echo $this->context['page']; ?></button>
        <button onclick='changePage(event)'><?php echo $this->context['page'] + 1; ?></button>
    </div>

    <script src=<?php echo STATIC_PATH.'/js/index.js';?>></script>
</body>
</html>