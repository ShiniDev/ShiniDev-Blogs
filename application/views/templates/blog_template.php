<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url() ?>assets/Shinidev.jpg">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/variables.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/templates/blog_template.css">
    <title>Shinidev</title>
</head>

<body>
    <div class="flex-container header">
        <header class="flex-container">
            <img class="shinidev-image" src="<?= base_url() ?>assets/Shinidev.jpg" alt="My cartoon image">
            <div class="flex-container">
                <span><b>Mark Joefrey Laurente</b></span>
                <i>I'm interested in learning and becoming fluent on different</i>
                <i>fields of computer science and information technologies.</i>
            </div>
        </header>
        <nav class="flex-container">
            <ul class="navbar">
                <a href="<?= base_url() ?>">
                    <li>Home</li>
                </a>
                <a href="<?= base_url() ?>blog/article/programming">
                    <li>Programming</li>
                </a>
                <a href="<?= base_url() ?>blog/article/devlogs">
                    <li>Devlogs</li>
                </a>
                <a href="<?= base_url() ?>blog/article/tips">
                    <li>Tips</li>
                </a>
                <a href="<?= base_url() ?>blog/article/projects">
                    <li>Projects</li>
                </a>
                <a href="<?= base_url() ?>blog/article/learnings">
                    <li>Learnings</li>
                </a>
                <a href="<?= base_url() ?>blog/about/">
                    <li>About</li>
                </a>
                <a href="<?= base_url() ?>cms">
                    <li>Edit</li>
                </a>
            </ul>
        </nav>
    </div>
    <div class="flex-container body">
        <div class="content" id="content">
            <?= $content['text'] ?? 'Under construction' ?>
        </div>
        <aside class="flex-container">

        </aside>
    </div>
    <footer>
        &copy; shinidev 2021
    </footer>
</body>

</html>