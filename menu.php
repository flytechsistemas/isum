<div class="page-sidebar navbar-collapse collapse">

    <ul class="page-sidebar-menu">

        <li class="sidebar-toggler-wrapper">

            <div class="sidebar-toggler"></div>
            
            <div class="clearfix"></div>
        
        </li>
        
        <?php

        foreach ( $_SESSION["menu"] as $dir ) {
        
        ?>
        
            <li class="start <?=($activeClass == $dir["1"])?"active":"";?>">
        
                <a href="home.php?s=<?=$dir["1"]?>">
        
                    <i class="fa fa-user"></i><span class="title"><?=ucfirst(separar($dir["1"]))?></span>
        
                </a>
        
            </li>
        
        <?php
        
        } 
        
        ?>

    </ul>

</div>