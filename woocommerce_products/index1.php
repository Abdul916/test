<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WooCommerce Products</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <?php
            $consumer_key = 'ck_ac2943bcfa7354f777970ffe6ba273d97aac172b';
            $consumer_secret = 'cs_e4fdcc72fdb70d3fdb532576fd31589ae18fef9e';
            $store_url = 'https://explorelogicsit.net/wctest/wp-json/wc/v3/products';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $store_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERPWD, $consumer_key . ":" . $consumer_secret);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                $products = json_decode($response, true);
                if (!empty($products)) {
                    foreach ($products as $product) {
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <!-- <img src="<?php // echo $product['images'][0]['src']; ?>" class="card-img-top" alt="<?php // echo $product['name']; ?>"> -->
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                    <p class="card-text">Price: <?php echo $product['price']; ?></p>
                                    <p class="card-text">Stock: <?php echo ucfirst($product['stock_status']); ?></p>
                                    <a href="#" class="btn btn-primary">View Product</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No products found.</p>";
                }
            }
            curl_close($ch);
            ?>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>