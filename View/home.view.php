<div>
    <header>
        <h1>EvalBlog</h1>
    </header>
    <div>
        <nav>

        </nav>
    </div>
   <div>
       <section>
           <div>
               <div class="title">
                   <?= $var['title'] ?>
               </div>
               <?php if (!is_null($var['image'])){
                   echo "<img src='" . $var['image'] . "' alt='" . $var['title'] . "'>";
               }
               ?>
               <div class="content">
                   <?= $var['content'] ?>
               </div>
           </div>
       </section>
       <section>
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
    <footer>

    </footer>

</div>
