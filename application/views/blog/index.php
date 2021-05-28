<div class="list-post">
    <?php foreach ($db as $row)
    {
    ?>
        <div>
            <a href="<?= base_url() ?>blog/post/<?= $row['slug'] ?>">
                <div name="title"><?= $row['title'] ?></div>
            </a>
        </div>
        <div class="meta-info">
            <div name="author">Author: <?= $row['author'] ?></div>
            <div name="created">Posted on: <?= $row['date_created'] ?></div>
        </div>
        <br>
        <div name="preview"><?= str_replace('<BURL>', base_url(), $row['preview']) ?></div>
        <br>
        <div name="category">
            <i>category: </i><a href="<?= base_url() ?>/blog/category/<?= $row['category'] ?>"><?= $row['category'] ?></a>
        </div>
        <hr>
    <?php
    }
    ?>
</div>
<div class="page-link">
    <?php if ($page > 1)
    {
        if (isset($category))
        {
            echo '<a href="' . base_url() . 'blog/category/' . $category . '/1"><<</a>';
            echo '&nbsp;';
            echo '<a href="' . base_url() . 'blog/category/' . $category . '/' . ($page - 1) . '"><</a>';
            echo '&nbsp;';
        }
        else
        {
            echo '<a href="' . base_url() . 'blog/index/' . '/1"><<</a>';
            echo '&nbsp;';
            echo '<a href="' . base_url() . 'blog/index/' . '/' . ($page - 1) . '"><</a>';
            echo '&nbsp;';
        }
    } ?>
    <?php if (!empty($db))
    { ?><div class="current-page"><?= $page ?></div><?php } ?>
    <?php if ($page != $total_page)
    {
        echo '&nbsp;';
        if (isset($category))
        {
            echo '<a href="' . base_url() . 'blog/category/' . $category . '/' . ($page + 1) . '">></a>';
            echo '&nbsp;';
            echo '<a href="' . base_url() . 'blog/category/' . $category . '/' . $total_page . '">>></a>';
        }
        else
        {
            echo '<a href="' . base_url() . 'blog/index/' . '/' . ($page + 1) . '">></a>';
            echo '&nbsp;';
            echo '<a href="' . base_url() . 'blog/index/' . '/' . $total_page . '">>></a>';
        }
    } ?>
</div>