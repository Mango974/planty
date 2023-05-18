<?php

if (!defined('ABSPATH')) { die();
}
$coloorsPalettes = [
    [['#264653','light'],['#2a9d8f','light'],['#e9c46a','dark'],['#f4a261','light'],['#e76f51','light']],
    [['#e63946','light'],['#f1faee','dark'],['#a8dadc','dark'],['#457b9d','light'],['#1d3557','light']],
    [['#cb997e','dark'],['#ddbea9','dark'],['#ffe8d6','dark'],['#b7b7a4','dark'],['#a5a58d','dark'],['6b705c','light']],
    [['#ffcdb2','dark'],['#ffb4a2','dark'],['#e5989b','dark'],['#b5838d','light'],['#6d6875','light']],
    [['#606c38','light'],['#283618','light'],['#fefae0','dark'],['#dda15e','light'],['#bc6c25','light']],
    [['#000000','light'],['#14213d','light'],['#fca311','dark'],['#e5e5e5','dark'],['#ffffff','dark']],
    [['#8ecae6','dark'],['#219ebc','light'],['#023047','light'],['#ffb703','dark'],['#fb8500','dark']],
];
?>
<span>Popular Color Palettes from Coloors.com</span>
<?php foreach($coloorsPalettes as $palette){
    echo "<div class='popular-color-container'>";
    foreach($palette as $color){?>
        <div class='color-wrapper popular-color' style='background-color:<?php echo $color[0]?>'>
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48' class='brxc__svg-path green' onClick='BRXC.copyColortoClipboard(event.target);'><path d='M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z'/></svg>
            <input type="text" class="popular-hex <?php echo $color[1]?>" value="<?php echo $color[0]?>">
        </div>
    <?php
    }
    echo "</div>";
}