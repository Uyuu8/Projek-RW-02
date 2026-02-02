<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>

    <!-- FONT AWESOME (ICON) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .menu-container {
            width: 100%;
        }

        .menu-row {
            display: flex;
            height: 60px;
        }

        .menu-item {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            border-right: 2px solid #ffffff;
        }

        .menu-item:last-child {
            border-right: none;
        }

        /* WARNA */
        .green {
            background-color: #00a651;
        }

        .green .menu-item {
            color: #ffffff;
        }

        .yellow {
            background-color: #f1c40f;
        }

        .yellow .menu-item {
            color: #000000;
        }

        /* ICON */
        .menu-item i {
            font-size: 22px;
        }

        /* HOVER ANIMATION */
        .menu-item:hover {
            transform: translateY(-4px);
            filter: brightness(1.1);
        }
    </style>
</head>
<body>

<div class="menu-container">

    <div class="menu-row green">
        <a href="#" class="menu-item">
            <i class="fa-solid fa-heart-pulse"></i>
            KESEHATAN
        </a>
        <a href="#" class="menu-item">
            <i class="fa-solid fa-wallet"></i>
            KEUANGAN
        </a>
    </div>

    <div class="menu-row yellow">
        <a href="#" class="menu-item">
            <i class="fa-solid fa-graduation-cap"></i>
            PENDIDIKAN
        </a>
        <a href="#" class="menu-item">
            <i class="fa-solid fa-sitemap"></i>
            STRUKTUR ORGANISASI
        </a>
    </div>

</div>

</body>
</html>
