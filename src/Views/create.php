<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create book</title>
</head>
<body>
    <h1>Create new Book</h1>
    <div>
        <?php foreach ($this->context['errors'] as $error) { ?>
            <p><?php echo $error; ?></p>                  
        <?php } ?>
    </div>
    <div>
        <form method="POST" action="http://localhost:8000/store">
            <input name="title" placeholder="Enter title"/><br>
            <textarea name="description" placeholder="Enter description"></textarea><br>
            <label for="categories">Choose a category:</label>
            <select name="category_id" id="categories">
                <?php foreach ($this->context['categories'] as $category) { ?>
                    <option value="<?php echo $category->getId(); ?>"><?php echo $category->getTitle(); ?></option>                  
                <?php } ?>
            </select><br>
            <label for="authors">Choose a author:</label>
            <select name="author_id" id="authors">
                <?php foreach ($this->context['authors'] as $author) { ?>
                    <option value="<?php echo $author->getId(); ?>"><?php echo $author->getFullname(); ?></option>                  
                <?php } ?>
            </select><br>
            <input name="price" placeholder="Enter price"/><br>
            <input type="submit" value="Submit" />
        </form>
    </div>
</body>
</html>