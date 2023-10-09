<?php
require_once("../controllers/dbHandling.php");
$db_instance = new DatabaseHandler();
$res_posts = $db_instance->getPosts();


foreach($res_posts as &$row) {

  echo " <div class='box'>
    <div class='box-title'>
        <h2 class='box-h2'>{$row[2]}</h2>
        <label for='box-h2'>{$row[1]}</label>
    </div>
    <img class='box-img' src='{$row[6]}' alt=''>

    <div class='box-description'>
    <p>{$row[3]}</p>
        <div class='description-hashtags'>
            <p class='description-hashtag'>#item1</p>
            <p class='description-hashtag'>#item2</p>
            <p class='description-hashtag'>#item3</p>
        </div>
    </div>
</div>";}


?>
