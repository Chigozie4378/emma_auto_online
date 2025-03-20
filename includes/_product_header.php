<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emma Auto Multi Company</title>
    <!-- Bootstrap CSS (for grid and other styles) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/chosen/chosen.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@300;400;500&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Amazon Ember', Arial, sans-serif;
        }

        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
        }

        .product-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-top: 5px;
            width: 100%;
        }

        .product-name {
            font-size: 15px;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 600;
        }

        .product-details {
            font-size: 12px;
            color: #333;
            width: 100%;
            padding: 2px 10px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 500;
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
            margin-top: 5px;
        }

        .btn-add-cart {
            background-color: #375bf7;
            color: white;
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn-add-cart:hover {
            background-color: #003366;
        }

        /* Custom overlay styling for the enlarged image */
        .image-frame {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            animation: fadeIn 0.5s;
        }

        .frame-content {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 80%;
            margin-top: 5%;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .close {
            position: absolute;
            top: 20px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }
        @media (max-width: 576px) {
            .frame-content {
                margin-top: 80px;
                /* or adjust to your preferred space */
            }
        }



        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>