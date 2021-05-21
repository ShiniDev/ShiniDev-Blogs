<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?= base_url() ?>assets/Shinidev.jpg">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/variables.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/templates/cms_template.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shinidev</title>
  <style>
    .button-container>div[name="<?= $current_tag ?? 'non_existent' ?>"] {
      background-color: white;
    }

    .button-container>div[name="<?= $current_tag ?? 'non_existent' ?>"]>a {
      color: black;
      font-size: 0.9rem;
    }

    div[name="posts"]>div>a[name="<?= $current_tag ?? 'non_existent' ?>"] {
      color: black;
      font-size: 0.9rem;
      background-color: white;
    }

    <?php if (isset($current_tag)) {
      if ($current_tag == 'lists' || $current_tag == 'create') { ?>div[name="posts"]>div {
      display: flex;
    }

    div[name="posts"]>div.visible {
      margin-left: 1em;
      display: none;
    }

    <?php }
    } ?>
  </style>
</head>

<body>
  <aside class="flex-container flex-column">
    <div class="flex-container flex-column profile">
      <div class="flex-container flex-center-all">
        <img class="shinidev-image" src="<?= base_url() ?>assets/Shinidev.jpg" alt="My cartoon image">
      </div>
      <div class="flex-container flex-center-all name">
        <?= $username ?>
      </div>
    </div>
    <div class="flex-container flex-column button-container">
      <div>
        <a href="<?= base_url() ?>">Home</a>
      </div>
      <div name="dashboard">
        <a href="<?= base_url() ?>cms">Dashboard</a>
      </div>
      <div name="posts">
        <a href="#" onclick="showList()">Posts</a>
        <div class="flex-container flex-column">
          <a name="lists" href="<?= base_url() ?>cms/lists">List of Posts</a>
          <a name="create" href="<?= base_url() ?>cms/create">Create Post</a>
        </div>
      </div>
      <div class="bottom-place">
        <div>
          <a href="<?= base_url() ?>userauth/logout">Logout</a>
        </div>
      </div>
    </div>
  </aside>
  <div class="content flex-container">

  </div>
  <script src="<?= base_url() ?>js/cms/helper.js"></script>
</body>

</html>