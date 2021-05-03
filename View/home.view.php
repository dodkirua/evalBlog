
<header>
    <h1>EvalBlog</h1>
    <div class="connect"><a href="index.php?controller=connect">Connectez vous</a></div>
</header>
<div class="principal">
        <nav class="menu">
    
        </nav>
    
    <div>
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
                        <div class='user'>" . $item['user'] . "</div> 
                        <div class='date'>" . $item['date'] . "</div>
                        <div class='content'>" .
                            $item['content']
                        . "</div>  
                            
                    </div>
                    ";
                }
           ?>
       </section>
    
    </div>
</div>
<footer>

</footer>


