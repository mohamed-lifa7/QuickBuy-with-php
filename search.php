<?php
include('includes/conn.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>QuickBuy | View-All</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <!-- components css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/css_components/header-footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/search.css'>

</head>


<body>
    <?php
    include 'includes/header.php';
    // include 'includes/nav-bar.php';
    
    ?>


    <div class="search-results section">
        <div class="container">
            <?php
            $search_query = $_GET['q'];
            ?>

            <div>

            </div>
            <div class="products">
                <h4 class="search-heading">Search Results for "
                    <?php echo $search_query; ?>"
                </h4>
                <ul class="products-grid">
                    <?php
                    // Search for products that match the search query
                    $sql_search = "SELECT * FROM products WHERE status = 1 AND (name LIKE '%{$search_query}%' OR type LIKE '%{$search_query}%') ORDER BY created_at DESC";
                    $result_search = $conn->query($sql_search);
                    ?>

                    <?php if ($result_search->num_rows > 0) { ?>
                        <?php while ($row_search = $result_search->fetch_assoc()) { ?>
                            <li class="product-item">
                                <a href="prod-detail.php?id=<?php echo $row_search['product_id']; ?>" class="product-link">
                                    <img src="<?php echo $row_search['image']; ?>" alt="<?php echo $row_search['name']; ?>"
                                        class="product-image">
                                    <div class="product-info">
                                        <h2 class="product-title">
                                            <?php echo $row_search['name']; ?>
                                        </h2>
                                        <p class="product-description">
                                            <?php echo $row_search['type']; ?>
                                        </p>
                                        <span class="product-price">$
                                            <?php echo $row_search['price']; ?>
                                        </span>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } else { ?>
                        <p>No results found for "
                            <?php echo $search_query; ?>".
                        </p>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>



    <?php
    include 'includes/footer.php'
        ?>
</body>

</html>