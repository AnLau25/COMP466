<?php

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Bookmark</title>
    <script type="text/javascript" async
        src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.0/es5/tex-mml-chtml.js">
        </script>
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
</head>

<body>
    <!-- Header -->
    <section id="header">
        <div class="header container">
            <div class="nav-bar">
                <div class="brand">
                    <a href="#hero">
                        <h1><span>The</span> bookmark <span>page</span></h1>
                    </a>
                </div>
                <div class="nav-list">
                    <ul>
                        <li><a href="#create" data-after="create">Create a bookmark</a></li>
                        <li><a href="#find" data-after="find">Find a bookmark</a></li>
                        <a href="login.php" type="button" class="cta">Log Out</a>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Header -->

    <!-- Hero Section  -->
    <section id="hero">
        <div class="hero container">
            <div class="text-block">
                <h1>Hi there, <span>ussername would go here!</span></h1>
                <h2>Here's what's been keeping everyone bussy:</h2>
                <p>Intro: List of top 10 links</p>
            </div>
        </div>
    </section>
    <!-- End Hero Section  -->

    <!-- create Section -->
    <section id="create">
        <div class="section-container">
            <div class="top">
                <h1 class="section-title"><span>New </span>bookmark</h1>
                <p class="section-subtitle">Create a new bookmark</p>
            </div>

            <div class="bottom">
                <form>
                    <label class="input-label">Link:
                        <input class="cta" name="link" type="text" placeholder="Link to your website"
                            size="50" required />
                    </label>
                    <label class="input-label">Bookmark name:
                        <input class="cta" name="linkName" type="text" placeholder="Name of your bookmark"
                            size="50" maxlength="50" required />
                    </label>
                    <button type="button" id="newLink" class="cta">Add</button>
                </form>
            </div>
        </div>
    </section>
    <!-- End create Section -->

    <!-- find Section -->
    <section id="find">
        <div class="section-container">
            <div class="top">
                <h1 class="section-title">Browse your <span>links</span></h1>
            </div>
            <div class="bottom">
                <form>
                    <label class="input-label">What are we looking for?
                        <input class="cta" name="serimp" type="text" placeholder="Name or Link of the website you need"
                            size="50" maxlength="50" required />
                    </label>
                </form>
            </div>
        </div>
    </section>
    <!-- End find Section -->

</body>

</html>