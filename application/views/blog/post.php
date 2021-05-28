<div class="user-post">
    <div name="title"><?= $db['title'] ?></div>
    <div class="meta-info">
        <div name="author">Author: <?= $db['author'] ?></div>
        <div name="created">Posted on: <?= $db['date_created'] ?></div>
    </div>
    <br>
    <div name="content"><?= str_replace('<BURL>', base_url(), $db['content']) ?></div>
    <br>
    <div name="category">
        <i>category: </i><a href="<?= base_url() ?>/blog/category/<?= $db['category'] ?>"><?= $db['category'] ?></a>
    </div>
</div>