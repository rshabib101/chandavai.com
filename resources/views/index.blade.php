<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chandavai Feed</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/habib-custom.css') }}">
    <style>
        body {
            margin: 0;
            background: #f0f2f5;
            font-family: 'Roboto', sans-serif;
        }

        .topbar {
            background: white;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar h1 {
            font-size: 20px;
            color: #1877f2;
            margin: 0;
        }

        .btn {
            background: #1877f2;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 15px;
        }

        .post {
            background: white;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #111;
        }

        .desc {
            font-size: 14px;
            color: #333;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .desc.expanded {
            display: block;
            -webkit-line-clamp: unset;
        }

        .see-btn {
            background: none;
            border: none;
            color: #1877f2;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            margin-top: 5px;
        }

        .post-img {
            width: 100%;
            border-radius: 10px;
            margin-top: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .post-img:hover {
            transform: scale(1.02);
        }

        .actions {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        .actions button {
            background: none;
            border: none;
            color: #65676b;
            cursor: pointer;
        }

        .actions button:hover {
            color: #1877f2;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .tag {
            background: #f0f2f5;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            transition: 0.3s;
        }

        .tag:hover {
            background: #1877f2;
            color: white;
        }
    </style>
</head>

<body>

    <!-- TOP BAR -->
    <div class="topbar">
        <h1 class="habib-button type-neon">Chandavai Feed</h1>
        <a class="habib-button type-neon" href="/report/create">+ Create Report</a>
    </div>

    <!-- FEED CONTAINER -->
    <div class="container" id="feed">
        @include('partials.posts', ['reports' => $reports])
    </div>

    <!-- MODAL FOR IMAGE -->
    <div id="imgModal" class="modal" onclick="closeImage()">
        <img id="modalImg">
    </div>

    <script>
        // See More / See Less Toggle
        function toggleDesc(id, btn) {
            let desc = document.getElementById('desc-' + id);
            if (desc.classList.contains('expanded')) {
                desc.classList.remove('expanded');
                btn.innerText = "See More";
            } else {
                desc.classList.add('expanded');
                btn.innerText = "See Less";
            }
        }

        // Image Modal Open/Close
        function openImage(src) {
            document.getElementById('imgModal').style.display = 'flex';
            document.getElementById('modalImg').src = src;
        }

        function closeImage() {
            document.getElementById('imgModal').style.display = 'none';
        }

        // Infinite Scroll
        let page = 1;
        let loading = false;

        window.addEventListener('scroll', function() {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 300) {
                loadMore();
            }
        });

        function loadMore() {
            if (loading) return;
            loading = true;
            page++;

            fetch("?page=" + page, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    let newPosts = doc.querySelectorAll('.post');

                    if (newPosts.length === 0) {
                        loading = false;
                        return;
                    }

                    newPosts.forEach(post => {
                        document.getElementById('feed').appendChild(post);
                    });
                    loading = false;
                });
        }
    </script>
</body>

</html>