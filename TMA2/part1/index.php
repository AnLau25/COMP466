<?php
    include('connection.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username']; 
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
                        <li><a href="#find" data-after="find">Browse your bookmarks</a></li>
                        <li><a href="../tma2.htm#q1" data-after="main">&lt; Go back to cover page</a></li>
                        <form action="../shared/logout.php" method="post">
                            <input type="hidden" name="folder" value="part1">
                            <button type="submit" class="cta">LOG OUT</button>
                        </form>
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
                <h1>Hi there, <span><?php echo htmlspecialchars($username); ?>!</span></h1>
                <h2>Here's what's been keeping everyone bussy:</h2>
                <?php
                    $top10 = "SELECT link_adr
                                FROM links
                                GROUP BY link_adr
                                ORDER BY SUM(link_click) DESC
                                LIMIT 10";
                    $populars = mysqli_query($database, $top10);

                    if (!$populars) {
                        die("Query error.");
                    } else {
                        echo "<ul>";
                        while ($row = $populars->fetch_assoc()) {
                            foreach ($row as $value) {
                                echo '<li><a class="abi" target="_blank" href="' . $value . '">' . $value . '</a></li>';
                            }
                        }
                        echo "</ul>";
                    }
                ?>
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
                <form id="addLink">
                    <label class="input-label">Link:
                        <input class="cta" name="link" type="text" placeholder="Link to your website"
                            size="50" required />
                    </label>
                    <label class="input-label">Bookmark name:
                        <input class="cta" name="name" type="text" placeholder="Name of your bookmark"
                            size="50" maxlength="50" required />
                    </label>
                    <button type="submit" name="newLink" class="cta">ADD</button>
                </form>
            </div>
        </div>
        <script>
             document.getElementById("addLink").addEventListener("submit", function(event) {
                event.preventDefault(); 

                let formData = new FormData(this);
                formData.append("newLink", "1"); 

                fetch("add_link.php", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "Accept": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); 
                    if (data.status === "success") {
                        document.getElementById("addLink").reset();
                        location.reload(); 
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        </script>
    </section>
    <!-- End create Section -->

    <!-- find Section -->
    <section id="find">
        <div class="section-container">
            <div class="top">
                <h1 class="section-title">Browse your <span>links</span></h1>
            </div>
            <div class="bottom">
                <form onsubmit="return false;">
                    <label class="input-label">What are we looking for?
                        <input class="cta" name="serimp" id="searchInput" type="text"
                            placeholder="Name or Link of the website you need" size="50" maxlength="50" required />
                    </label>
                    <ul id="resultsList"></ul>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            loadLinks();

            document.getElementById("searchInput").addEventListener("keyup", function() {
                loadLinks(this.value);
            });

            function loadLinks(searchQuery = "") {
                let resultsList = document.getElementById("resultsList");
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "search_links.php?query=" + encodeURIComponent(searchQuery), true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        resultsList.innerHTML = xhr.responseText;
                        attachClickHandlers();
                    }
                };
                xhr.send();
            }
        });

        function attachClickHandlers() {
            document.querySelectorAll(".saved-link").forEach(link => {
                link.addEventListener("click", function (event) {
                    let linkId = this.getAttribute("data-link-id");
                    updateClickCount(linkId);
                });
            });
        }

        function updateClickCount(linkId) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "link_click.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("link_id=" + encodeURIComponent(linkId));
        }

        function deleteLink(linkId) {
            if (confirm("Are you sure you want to delete this link?")) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_link.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert(xhr.responseText);
                        location.reload(); 
                    }
                };
                xhr.send("link_id=" + encodeURIComponent(linkId));
            }
        }
    </script>
    <!-- End find Section -->

    <!--Modal-->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Link</h2>
            <form id="editForm" onsubmit="return false;">
                <input type="hidden" id="editLinkId">
                <label class="input-label">Link Name:
                    <input class="cta" type="text" id="editLinkName" required>
                </label>
                <label class="input-label">Link URL:
                    <input class="cta" type="url" id="editLinkUrl" required>
                </label>
                <button type="submit" class="cta">Save Changes</button>
            </form>
        </div>
    </div>
    <!--I know I should have a script file at this point, please ignore it this onece-->
    <script>
        function editLink(linkId) {
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "get_link.php?link_id=" + encodeURIComponent(linkId), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let linkData = JSON.parse(xhr.responseText);
                    document.getElementById("editLinkId").value = linkData.link_id;
                    document.getElementById("editLinkName").value = linkData.link_name;
                    document.getElementById("editLinkUrl").value = linkData.link_adr;
                    document.getElementById("editModal").style.display = "block";
                }
            };
            xhr.send();
        }

        document.querySelector(".close").addEventListener("click", function () {
            document.getElementById("editModal").style.display = "none";
        });

        document.getElementById("editForm").addEventListener("submit", function () {
            let linkId = document.getElementById("editLinkId").value;
            let linkName = document.getElementById("editLinkName").value;
            let linkUrl = document.getElementById("editLinkUrl").value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "update_link.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                    location.reload();
                }
            };
            xhr.send("link_id=" + encodeURIComponent(linkId) + "&link_name=" + encodeURIComponent(linkName) + "&link_adr=" + encodeURIComponent(linkUrl));
        });

    </script>
    <!--Modal-->

</body>
    <script src="../shared/sessClosing.js"></script>
</html>