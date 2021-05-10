<div>
    <div>
        <a href="/index.php?ctrl=connect">Connectez-vous</a>
    </div>
   <section class="sectionArticle">
       <div class="article">
           <div class="title">
               <?= $var['title'] ?>
           </div>
           <div class="user">publié par <?= $var['user'] ?> le : <?= $var['date'] ?></div>
           <?php if (!is_null($var['image'])){
               echo "<img src='" . $var['image'] . "' alt='" . $var['title'] . "'>";
           }
           ?>
           <div class="content">
               <?= $var['content'] ?>
           </div>
       </div>
   </section>
   <section class="sectionComment">
       <?php
            foreach ($var['comment'] as $item){
                echo "
                <div class='comment'>
                    <div class='user'>" . $item['user'] . " le :" . $item['date'] ."</div>

                    <div class='content'>" .
                        $item['content']
                    . "</div>

                </div>
                ";
            }
       ?>
   </section>

</div>


