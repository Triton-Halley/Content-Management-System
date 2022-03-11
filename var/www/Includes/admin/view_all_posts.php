<!-- class="table-bordered table-hover" -->
<table class="table ">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Categories</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>

        <?php

        $query = "SELECT * FROM posts";
        $query_result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_result)) {
        ?>
            <tr>

                <?php
                //{$row['post_image']}
                echo "<th> {$row['post_id']}</th>";
                echo "<th> {$row['post_author']}</th>";
                echo "<th> {$row['post_title']}</th>";
                echo "<th> {$row['post_category_id']}</th>";
                echo "<th> {$row['post_status']}</th>";
                echo "<th><img class='img-responsive' src='../Uploads/{$row['post_image']}' alt='placeholder' width='100px'></th>";
                echo "<th> {$row['post_tag']}</th>";
                echo "<th> {$row['post_comment_count']}</th>";
                echo "<th> {$row['post_date']}</th>";
                ?>
            </tr>

        <?php } ?>

    </tbody>



</table>