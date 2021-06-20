<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css" integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/app.js"></script>
    <title>TM Task</title>
</head>

<body>
    <div class="splash-container">
        <div class="splash">
            <h1 class="splash-head">TM Task</h1>
            <p class="splash-subhead">
                Please use the search input to find relevant authors and their books
            </p>
            <form class="pure-form" id="searchForm" method="GET" action="/index.php">
                <input class="pure-input-rounded" type="text" value="<?php echo isset($query) ? $query : '' ?>" name="search" id="searchField" placeholder="Isak Azimov" />
                <button class="pure-button" type="submit" id="searchButton">Search</button>
            </form>

            <div class="pure-g">
                <div class="pure-u-1-3">
                    <table class="pure-table pure-table-horizontal" id="table">
                        <thead>
                            <tr>
                                <th>Author</th>
                                <th>Book</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($result)) : ?>
                                <?php foreach ($result as $row) : ?>
                                    <tr class="fade-in">
                                        <td><?php echo $row['author_name'] ?></td>
                                        <td><?php echo (!empty($row['book_name'])) ? $row['book_name'] : "N/A" ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="2">Result not found!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>

</html>