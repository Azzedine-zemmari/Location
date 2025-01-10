<?php
session_start();
include "../../../Config.php";
include "../../Class/themeClass.php";
include "../../Class/articleClass.php";
include "../../Class/tagClass.php";
include "../../Class/Commentaire.php";
$themeClass = new them();
$themes = $themeClass->showAll();
// var_dump($_POST);
// var_dump($_FILES);
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $themeId = $_POST['themeID'];

    if (isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['name'])) {
        $imagePath = './uploads/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }
    if (isset($_FILES['vedeo']['name']) && !empty($_FILES['vedeo']['name'])) {
        $vedeoPath = './uploads/' . $_FILES['vedeo']['name'];
        move_uploaded_file($_FILES['vedeo']['tmp_name'], $vedeoPath);
    }

    $articleClass = new article();
    $add = $articleClass->addArticle($content, $imagePath, $vedeoPath, $title, $themeId);
    if ($add) {
        $_SESSION['message'] = "article added successfully";
    } else {
        $_SESSION['message'] =  "theres an error ";
    }
    // Redirect to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
$tags = new tags();
$showTags = $tags->getAllTags();
// var_dump($showTags);
$commets = new commentaire();
$show = $commets->showAllComments(1);

$article = new article();
$data = $article->showArticles();
// var_dump($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Blog Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .pagination-btn {
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .pagination-btn:hover {
            background-color: #ddd;
        }

        .pagination-btn.active {
            background-color: #007bff;
            color: white;
        }
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>

<body class="bg-white font-family-karla">

    <!-- Top Bar Nav -->
    <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="#">Shop</a></li>
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="#">About</a></li>
                </ul>
            </nav>

            <div class="flex items-center text-lg no-underline text-white pr-6">
                <a class="" href="#">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>

    </nav>

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
                Minimal Blog
            </a>
            <p class="text-lg text-gray-600">
                Lorem Ipsum Dolor Sit Amet
            </p>
        </div>
    </header>

    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a
                href="#"
                class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open">
                Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div id="themes" class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
                <?php foreach ($themes as $theme): ?>
                    <button value="<?= $theme['id'] ?>" class="hover:bg-gray-400 rounded py-2 px-4 mx-2"><?= $theme['name'] ?></button>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>


    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section id="POSTS" class="w-full md:w-2/3 flex flex-col items-center px-3">
            <?php
            foreach ($data as $obj): ?>
                <article class="flex flex-col shadow my-4">
                    <a href="#" class="hover:opacity-75">
                        <img src="<?= $obj['media'] ?>" alt="Theme Image">
                    </a>
                    <form action="../traitementPage/addToFavorite.php" method="post">
                        <input type="hidden" name="article_id" value="<?= $obj['id'] ?>">
                        <button name="submit">❤️</button>
                    </form>
                    <div class="bg-white flex flex-col justify-start p-6">
                        <a href="" class="text-blue-700 text-sm font-bold uppercase pb-4"><?= $obj['title'] ?></a>
                        <a href="#" class="pb-6"><?= $obj['content'] ?></a>
                        <div class="flex flex-wrap">
                            <?php
                            $tags = json_decode($obj['tags'], true);
                            $unique_tags = array_unique($tags);
                            foreach ($unique_tags as $tag): ?>
                                <span class="tag bg-transparent border-2 border-sky-500 rounded-full text-blue-400 text-sm px-3 py-1 m-1"><?= $tag ?></span>
                            <?php endforeach; ?>
                        </div>
                        <div class="flex flex-col">
                            <?php
                            $comments = json_decode($obj['comments'], true);
                            $unique_comments = array_unique($comments);
                            foreach ($unique_comments as $comment): ?>
                                <span class="comment flex flex-col"><?= $comment ?></span>
                            <?php endforeach; ?>
                        </div>
                        <form action="../traitementPage/submit_comment.php" method="POST">
                            <input type="hidden" name="article_id" value="<?= $obj['id'] ?>">
                            <textarea name="comment" placeholder="Write your comment here..." required></textarea>
                            <button name="submit" type="submit">Submit Comment</button>
                        </form>

                    </div>
                </article>
            <?php endforeach; ?>

            <!-- Pagination -->
            <div id="pagination"></div>


        </section>

        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class=" w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">tu peux ajouter votre article ici!</p>
                <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                <button onclick="togglePopup()" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Add New Article
                </button>
            </div>
            <div class=" w-full  bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-4">Rechercher et Filtrer</p>

                <!-- Search Input -->
                <div class=" relative mb-4">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Rechercher un article..."
                        class="w-full bg-gray-100 border border-gray-300 text-gray-800 rounded py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                    <i class="fas fa-search absolute right-4 top-3 text-gray-500"></i>
                </div>

                <!-- Filter Select -->
                <div class="relative">
                    <select
                        id="filterSelect"
                        class="w-full bg-gray-100 border border-gray-300 text-gray-800 rounded py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <?php foreach ($showTags as $tag): ?>
                            <option value="<?= $tag['id'] ?>"><?= $tag['tag'] ?></option>
                        <?php endforeach; ?>
                        <!-- Add more options as needed -->
                    </select>
                </div>
            </div>

            <!-- Popup Overlay -->
            <div id="articlePopup" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
                <!-- Popup Content -->
                <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold">Add New Article</h2>
                        <button onclick="togglePopup()" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form id="articleForm" action="../traitementPage/addArticle.php" method="post" enctype="multipart/form-data" class="space-y-4" >
                        <!-- Theme Select -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Theme</label>
                            <select id="theme" name="themeID" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select a theme</option>
                                <?php foreach ($themes as $theme): ?>
                                    <option value="<?= $theme['id'] ?>"><?= $theme['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Title Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Content Textarea -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                            <textarea id="content" name="content" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            <input type="file" name="image" id="image" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- video Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Vedeo</label>
                            <input type="file" name="vedeo" id="vedeo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" name="submit" class="w-full bg-blue-800 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                            Submit Article
                        </button>
                    </form>
                </div>
            </div>
        </aside>

    </div>


    <script>
        let posts = document.getElementById("POSTS");
        let buttons = document.querySelectorAll("#themes button");

        buttons.forEach((button) => {
            button.addEventListener("click", function() {
                const buttonValue = this.value;
                console.log("Button value is:", buttonValue);

                // Clear the posts area
                posts.innerHTML = "";

                // Send fetch request
                fetch("../../AjaxFiles/FilterByTheme.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: `theme=${buttonValue}`,
                    })
                    .then((response) => {
                        return response.json();
                    })
                    .then((articles) => {
                        console.log("Themes fetched:", articles);

                        if (articles.length === 0) {
                            posts.innerHTML = "<p>No articles found for this theme.</p>";
                            return;
                        }

                        let htmlContent = "";
                        articles.forEach((article) => {
                            htmlContent += `
                            <article class="flex flex-col shadow my-4">
                                <a href="#" class="hover:opacity-75">
                                    <img src="${article.media}" alt="Theme Image">
                                </a>
                                <div class="bg-white flex flex-col justify-start p-6">
                                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">${article.title}</a>
                                    <a href="#" class="pb-6">${article.content}</a>
                                    <a href="#" class="uppercase text-gray-800 hover:text-black">
                                        Continue Reading <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        `;
                        });

                        posts.innerHTML = htmlContent; // Set HTML content once
                    })
                    .catch((error) => {
                        console.error("Error fetching articles:", error);
                        posts.innerHTML = "<p>An error occurred while fetching articles. Please try again later.</p>";
                    });
            });
        });
        document.getElementById("searchInput").addEventListener("keydown", (event) => {
            if (event.key == "Enter") {
                event.preventDefault();
                const title = event.target.value.trim();
                console.log("title", title)
                fetch("../../AjaxFiles/SearchArticle.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: `title=${title}`,
                    })
                    .then((response) =>response.json())
                    .then((articles) => {
                        // if (articles.length === 0) {
                        //     posts.innerHTML = "<p>No articles found for this theme.</p>";
                        //     return;
                        // }

                        console.log("Themes fetched:", articles);
                        let htmlContent = "";
                        articles.forEach((article) => {
                            htmlContent += `
            <article class="flex flex-col shadow my-4">
                <a href="#" class="hover:opacity-75">
                    <img src="${article.media}" alt="Theme Image">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">${article.title}</a>
                    <a href="#" class="pb-6">${article.content}</a>
                    <a href="#" class="uppercase text-gray-800 hover:text-black">
                        Continue Reading <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
        `;
                        });
                        posts.innerHTML = htmlContent;

                    })
                    .catch((error) => {
                        console.error("Error in fetch:", error);
                    });
            }
        })

        // let currentPage = 1;
        // let totalPages = 1;
        // let currentTheme = ''; 
        // document.getElementById("themes").addEventListener("click", (event) => {
        //     if (event.target.tagName === 'BUTTON') {
        //         event.preventDefault();

        //         currentTheme = event.target.value;
        //         console.log("Selected theme:", currentTheme);

        //        fetchArticles(currentTheme,currentPage)
        //     }
        // });
        // function fetchArticles(theme,page){
        //     fetch("../../AjaxFiles/showArticle.php", {
        //             method: 'POST',
        //             headers: {
        //                 "Content-type": "application/x-www-form-urlencoded",
        //             },
        //             body: `theme=${theme}&page=${page}`
        //         })
        //         .then((response) => response.json())
        //         .then((articles) => {
        //             console.log("Themes fetched:", articles);
        //             const main = document.getElementById("POSTS");
        //             main.innerHTML = ''
        //             articles.result.forEach((article) => {
        //                 const tags = article.tags ? article.tags.split(", ").map((tag)=>
        //                  `<button class="bg-transparent border-2 border-sky-500 rounded-full text-blue-400 text-sm px-3 py-1 m-1">${tag}</button>`
        //             ):''
        //                 main.innerHTML += `
        //                     <article class="flex flex-col shadow my-4">
        //                         <a href="#" class="hover:opacity-75">
        //                             <img src="${article.media}" alt="Theme Image">
        //                         </a>
        //                         <div class="bg-white flex flex-col justify-start p-6">
        //                             <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">${article.title}</a>
        //                             <a href="#" class="pb-6">${article.content}</a>
        //                             <div class="flex flex-wrap">${tags}</div>
        //                             <a href="#" class="uppercase text-gray-800 hover:text-black">
        //                                 Continue Reading <i class="fas fa-arrow-right"></i>
        //                             </a>
        //                         </div>
        //                     </article>
        //                 `;
        //             });
        //             // Update pagination
        //                 totalPages = articles.totalPage;
        //                 updatePagination();
        //         })
        //         .catch((error) => {
        //             console.error("Error in fetch:", error);
        //         });
        // }
        // function updatePagination() {
        //     const paginationContainer = document.getElementById("pagination");
        //     paginationContainer.innerHTML = ''; // Clear existing buttons

        //     // Create pagination buttons
        //     for (let page = 1; page <= totalPages; page++) {
        //         const button = document.createElement("button");
        //         button.innerText = page;
        //         button.classList.add("pagination-btn");
        //         button.dataset.page = page;

        //         button.addEventListener("click", function() {
        //             currentPage = page;  // Update current page
        //             fetchArticles(currentTheme, currentPage);  // Fetch articles for selected page and theme
        //         });

        //         paginationContainer.appendChild(button);
        //     }
        // }

        // document.getElementById("searchInput").addEventListener("keydown",(event)=>{
        //     if(event.key == "Enter"){
        //         event.preventDefault();
        //         const title = event.target.value;
        //         fetch("../../AjaxFiles/SearchArticle.php",{
        //             method : 'POST',
        //             headers: {
        //                 "Content-type": "application/x-www-form-urlencoded",
        //             },
        //             body: `title=${title}`
        //         })
        //         .then((response)=>response.json())
        //         .then((articles) => {
        //             console.log("Themes fetched:", articles);
        //             const main = document.getElementById("POSTS");
        //             main.innerHTML = '';

        //             articles.forEach((article) => {
        //                 main.innerHTML += `
        //                     <article class="flex flex-col shadow my-4">
        //                         <a href="#" class="hover:opacity-75">
        //                             <img src="${article.media}" alt="Theme Image">
        //                         </a>
        //                         <div class="bg-white flex flex-col justify-start p-6">
        //                             <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">${article.title}</a>
        //                             <a href="#" class="pb-6">${article.content}</a>
        //                             <a href="#" class="uppercase text-gray-800 hover:text-black">
        //                                 Continue Reading <i class="fas fa-arrow-right"></i>
        //                             </a>
        //                         </div>
        //                     </article>
        //                 `;
        //             });
        //         })
        //         .catch((error) => {
        //             console.error("Error in fetch:", error);
        //         });
        //     }
        // })
        // document.getElementById("filterSelect").addEventListener("change",function(){
        //         const tagId = this.value
        //         console.log("this is tag id",tagId);
        //         fetch("../../AjaxFiles/filterByTag.php",{
        //             method : 'POST',
        //             headers: {
        //                 "Content-type": "application/x-www-form-urlencoded",
        //             },
        //             body: `tag=${tagId}`
        //         })
        //         .then((response)=>response.json())
        //         .then((articles) => {
        //             console.log("Themes fetched:", articles)
        //             const main = document.getElementById("POSTS")
        //             main.innerHTML = ''

        //             if(articles.notFound){
        //                 main.innerHTML = `<p class="text-center text-blue-700">${articles.notFound}</p>`;
        //             }else if(articles.length > 0){
        //             articles.forEach((article) => {
        //                 main.innerHTML += `
        //                     <article class="flex flex-col shadow my-4">
        //                         <a href="#" class="hover:opacity-75">
        //                             <img src="${article.media}" alt="Theme Image">
        //                         </a>
        //                         <div class="bg-white flex flex-col justify-start p-6">
        //                             <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">${article.title}</a>
        //                             <a href="#" class="pb-6">${article.content}</a>
        //                             <a href="#" class="uppercase text-gray-800 hover:text-black">
        //                                 Continue Reading <i class="fas fa-arrow-right"></i>
        //                             </a>
        //                         </div>
        //                     </article>
        //                 `;
        //             });
        //         }
        //         })
        //         .catch((error) => {
        //             console.error("Error in fetch:", error);
        //         });
        // })
        function togglePopup() {
            const popup = document.getElementById('articlePopup');
            popup.classList.toggle('hidden');
        }
    </script>
</body>

</html>