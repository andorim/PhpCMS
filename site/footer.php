<adress>
    Copyright 2022 <a href="https://andorim.de" target="_blank">andorim.de</a>
</adress><br/>
<?php
    if(PARTY){ ?>
        <div id="footerParty"> 
            <img src="https://cdn.betterttv.net/emote/5f1b0186cf6d2144653d2970/2x" class="dance cat" />
            <?php
            for($i = 0;$i<32;$i++){
                ?>
                    <img src="https://cdn.betterttv.net/emote/5aa1d0e311237146531078b0/1x" class="dance" />
                <?php
            } ?>
            <img src="https://cdn.betterttv.net/emote/5f1b0186cf6d2144653d2970/2x" class="dance cat" style="transform: scaleX(-1);"/>
        </div>
        <?php
    }
?>
