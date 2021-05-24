<div class="flex-container display-handler">
    <div class="flex-container" name="page-number">
        <?php if ($page > 1)
        {
            echo '<a href="' . base_url() . 'cms/lists/1/' . $limit . '"><<</a>';
            echo '&nbsp';
            echo '<a href="' . base_url() . 'cms/lists/' . ($page - 1) . '/' . $limit . '"><</a>';
            echo '&nbsp';
        } ?>
        <select name="page-number" onchange="window.location.href = this.value">
            <?php for ($i = 1; $i <= $total_pages; ++$i)
            { ?>
                <option value="<?= base_url() . 'cms/lists/' . $i . '/' . $limit ?>"><?= $i ?></option>
            <?php } ?>
        </select>
        <?php if ($page != $total_pages)
        {
            echo '&nbsp';
            echo '<a href="' . base_url() . 'cms/lists/' . ($page + 1) . '/' . $limit . '">></a>';
            echo '&nbsp';
            echo '<a href="' . base_url() . 'cms/lists/' . $total_pages . '/' . $limit . '">>></a>';
        } ?>
    </div>
    <label for="page-length">Number of rows: </label>
    <select name="num-rows" onchange="window.location.href = this.value">
        <option value="<?= base_url() . 'cms/lists/' . $page . '/' ?>5">5</option>
        <option value="<?= base_url() . 'cms/lists/' . $page . '/' ?>10">10</option>
        <option value="<?= base_url() . 'cms/lists/' . $page . '/' ?>15">15</option>
        <option value="<?= base_url() . 'cms/lists/' . $page . '/' ?>25">25</option>
        <option value="<?= base_url() . 'cms/lists/' . $page . '/' ?>50">50</option>
        <option value="<?= base_url() . 'cms/lists/' . $page . '/' ?>100">100</option>
    </select>
</div>
<table>
    <thead>
        <th>Actions</th>
        <th>Id</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Content</th>
        <th>Preview</th>
        <th>Slug</th>
        <th>Date Created</th>
    </thead>
    <tbody>
        <?php foreach ($db as $row_data)
        { ?>
            <tr <?php if ($row_data['id'] % 2 != 0) echo 'class="odd-item"'; ?>>
                <td>
                    <div class="action-container">
                        <span class="update-button"><a href="<?= base_url() . 'cms/update/' . $row_data['id'] ?>">update</a></span>
                        <span class="delete-button"><a onclick="return confirm('Delete this post?');" href="<?= base_url() . 'cms/delete/' . $row_data['id'] ?>">delete</a></span>
                    </div>
                </td>
                <td><?= $row_data['id'] ?></td>
                <td><?= htmlspecialchars($row_data['title']) ?></td>
                <td><?= htmlspecialchars($row_data['author']) ?></td>
                <td><?= htmlspecialchars($row_data['category']) ?></td>
                <td><textarea readonly><?= htmlspecialchars($row_data['content']) ?></textarea></td>
                <td><textarea readonly><?= htmlspecialchars($row_data['preview']) ?></textarea></td>
                <td><?= htmlspecialchars($row_data['slug']) ?></td>
                <td><?= htmlspecialchars($row_data['date_created']) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    let pageSelect = document.querySelector('select[name="page-number"]');
    let rowNumSelect = document.querySelector('select[name="num-rows"]');
    window.onload = function() {
        // console.log('Select Option Changed!');
        pageSelect.value = '<?= base_url() . 'cms/lists/' . $page . '/' . $limit ?>';
        rowNumSelect.value = '<?= base_url() . 'cms/lists/' . $page . '/' . $limit ?>';
    };
</script>