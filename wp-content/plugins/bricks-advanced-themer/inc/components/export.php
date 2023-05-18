<?php

if (!defined('ABSPATH')) { die();
}

?>
<div class="brxc-export-container">
    <div class="brxc-export-json__wrapper">
        <div class="brxc-export-json__col-left">
            <pre><code id="ExportJSONCode"></code></pre>
        </div>
        <div class="brxc-export-json__col-right">
            <span class="brxc-export__title">Export to JSON</span>
            <span class="brxc-export__descrition">
                Click the button below to copy all the modifications made on this session to your clipboard. Once done, you can paste the JSON object inside your Color Palette settings and it will be saved in your database for future references - both on frontend and backend. This method is usefull if your intent is to modify the Color Palette Settings on your entire website.
            </span>
            <div class="brxc-export__btn-wrapper">
                <select name="color-palette-json" id="colorPaletteJson" onChange="document.querySelector('#ExportJSONCode').innerHTML = BRXC.exportValuesToJSON(event.target.value);">
                    <?php
                    if ( $query->have_posts() ) :

                        while ( $query->have_posts() ) :
                    
                            $query->the_post();

                            global $post;

                            $post_slug = $post->post_name;

                            echo '<option value="' . $post_slug . '">' . get_the_title() . '</option>';

                        endwhile;

                    endif;

                    $query->rewind_posts();
                    ?>
                </select>
                <button id="copyJSONtoClipboard" onClick="BRXC.copyJSONtoClipboard(event.target);">
                    Copy to Clipboard
                </button>
            </div>
        </div>
    </div>
    <div class="brxc-export-css__wrapper">
        <div class="brxc-export-css__col-left">
            <pre><code id="ExportCSSCode"></code></pre>
        </div>
        <div class="brxc-export-css__col-right">
            <span class="brxc-export__title">Export to CSS</span>
            <span class="brxc-export__descrition">
                Click the button below to copy all the modifications made on this session to your clipboard. Once done, you can paste the CSS properties anywhere on your site. The Color Palette settings won't be altered on your database. It means that on the next page refresh, the frontend GUI will be exactly the same as the start of this current session. This method is useful if your intent is to just modify local pages without changing the general Color Palette Settings.
            </span>
            <div class="brxc-export__btn-wrapper">
                <select name="color-palette-css" id="colorPaletteCss" onChange="document.querySelector('#ExportCSSCode').innerHTML = BRXC.exportValuesToCSS(event.target.value);">
                    <?php
                    if ( $query->have_posts() ) :

                        while ( $query->have_posts() ) :
                    
                            $query->the_post();

                            global $post;

                            $post_slug = $post->post_name;

                            echo '<option value="' . $post_slug . '">' . get_the_title() . '</option>';

                        endwhile;

                    endif;

                    $query->rewind_posts();
                    ?>
                </select>
                <button id="copyCSStoClipboard" onClick="BRXC.copyCSStoClipboard(event.target);">
                    Copy to Clipboard
                </button>
            </div>
        </div>
    </div>
</div>