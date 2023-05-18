<?php
if (!defined('ABSPATH')) { die();
}
?>
<div id="brxcCSSOverlay" class="brxc-overlay__wrapper" style="opacity:0" onclick="ADMINBRXC.closeModal(event, this,'#brxcCSSOverlay');">
    <div class="brxc-overlay__inner">
        <div class="brxc-overlay__close-btn" onClick="ADMINBRXC.closeModal(event, event.target,'#brxcCSSOverlay')">
            <i class="bricks-svg ti-close"></i>
         </div>
        <div class="brxc-overlay__inner-wrapper">
            <div class="brxc-overlay__header">
                <h3 class="brxc-overlay__header-title">CSS Stylesheets</h3>
            </div>
            <div class="brxc-overlay__container">
                <div id="brxcCSSContainer">
                    <div id="brxcCSSColLeft" class="brxc-overlay__col-left">
                        <div class="brxcCSSLabel active" data-code="page" data-transform="0">Page CSS</div>
                        <div class="brxcCSSLabel" data-code="global" data-transform="0">Global CSS</div>
                        <?php
                        if (get_template_directory() !== get_stylesheet_directory()){
                            ?>
                            <div class="brxcCSSLabel" data-code="child-theme" data-transform="0">Child Theme CSS</div>
                        <?php }
                        if ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :
                            while ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :
                                the_row();
                                $label = get_sub_field('field_63b4bd5c16ac3', 'bricks-advanced-themer' );
                                ?>
                                <div class="brxcCSSLabel" data-code="<?php echo strtolower( preg_replace( '/\s+/', '-', esc_attr($label) ) );?>" data-transform="0"><?php echo esc_attr($label);?> (Imported)</div>
                            <?php
                            endwhile;
                        
                        endif;
                        ?>
                        <div class="brxcCSSLabel-AI" data-transform="calc(-100% - 80px)" style="margin-left: auto;" onClick="ADMINBRXC.movePanel(document.querySelector('#brxcCSSOverlay .brxc-overlay__type-wrapper'),this.dataset.transform);">AI Assistant</div>
                    </div>
                    <div class="brxc-overlay__type-wrapper">
                        <div class="brxc-overlay__inner-1">
                            <div class="brxc-overlay__inner--overflow">
                                <div id="brxcCSSColRight">
                                    <div id="brxcPageCSSWrapper" class="brxc-overlay-css__wrapper active" data-code="page">
                                        <div class="brxc-overlay-css__title">Page CSS</div>
                                        <p class="brxc-overlay-css__desc">Insert your page-specific CSS code here. It will be automatically applied & synched with the builder.</p>
                                        <textarea id="brxcCustomCSS" class="brxcCodeMirror"></textarea>
                                    </div>
                                    <div id="brxcGlobalCSSWrapper" class="brxc-overlay-css__wrapper" data-code="global">
                                        <div class="brxc-overlay-css__title">Global CSS</div>
                                        <p class="brxc-overlay-css__desc">The following CSS codes apply on all the pages of your website. The global inline CSS are set to be read-only. To modify it, go to <a href="/wp-admin/admin.php?page=bricks-settings&bricks_notice=settings_saved#tab-custom-code" target="_blank"> Bricks Settings</a>.</p>
                                        <textarea id="brxcCustomGlobalCSS" class="brxcCodeMirror"></textarea>
                                    </div>
                                    <?php
                                    if (get_template_directory() !== get_stylesheet_directory()){
                                        $file = get_stylesheet_directory() . '/style.css';
                                        ?>
                                        <div class="brxc-overlay-css__wrapper" data-code="child-theme">
                                            <div class="brxc-overlay-css__title">Child Theme CSS</div>
                                            <p class="brxc-overlay-css__desc"> The following CSS codes apply on all the pages of your website. The Child Theme CSS are set to be read-only. To modify it, go to your <a href="/wp-admin/theme-editor.php" target="_blank">Theme File Editor</a>.</p>
                                            <textarea class="brxc-codemirror__imported"><?php echo esc_html(file_get_contents($file));?></textarea>
                                        </div>
                                    <?php }
                                    if ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :
                                        while ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :
                                            the_row();
                                            $label = get_sub_field('field_63b4bd5c16ac3', 'bricks-advanced-themer' );
                                            $file = get_sub_field('field_63b4bdf216ac7', 'bricks-advanced-themer' );
                                            ?>
                                            <div class="brxc-overlay-css__wrapper" data-code="<?php echo strtolower( preg_replace( '/\s+/', '-', esc_attr($label) ) );?>">
                                                <div class="brxc-overlay-css__title"><?php echo esc_attr($label)?> (Imported)</div>
                                                <p class="brxc-overlay-css__desc">The following CSS codes apply on all the pages of your website. The imported CSS are set to be read-only. To modify it, go to your <a href="/wp-admin/admin.php?page=bricks-advanced-themer" target="_blank">Advanced Themer Settings</a>.</p>
                                                <textarea class="brxc-codemirror__imported"><?php echo esc_html(file_get_contents($file));?></textarea>
                                            </div>
                                        <?php endwhile;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="brxc-overlay__inner-2">
                            <div class="brxc-overlay__inner--overflow">
                                <label for="globalOpenAICodeText" class="brxc-input__label">User Prompt <span class="brxc__light">(Required)</span></label>
                                <textarea name="global-openAI-prompt-text" id="globalOpenAICodeText" class="openAI-prompt-text message input" placeholder="Type your prompt text here..." cols="30" rows="3"></textarea>
                                <div class="brxc-overlay-btn-wrapper">
                                    <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-2 .message').forEach(el => el.value = '');let removes = document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-2 .remove-on-reset');removes.forEach(el => {el.remove()});">
                                        <span>Reset</span>
                                    </div>
                                    <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onclick="ADMINBRXC.getCodeAIResponse(this,true, '#brxcGlobalOpenAIOverlay');">
                                        <span>Generate Code</span>
                                    </div>
                                </div>
                                <div id="brxcglobalInsertCodeContentWrapper" class="brxc-overlay-btn-wrapper">
                                    <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-2 .message').forEach(el => el.value = '');let removes = document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-2 .remove-on-reset');removes.forEach(el => {el.remove()});">
                                        <span>Reset</span>
                                    </div>
                                    <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onClick='ADMINBRXC.copytoClipboard(this,document.querySelector("#brxcGlobalOpenAIOverlay input[name=openai-Code-results]:checked + label .message.assistant").textContent,"Content Copied!", "Copy Selected to Clipboard");'>
                                        <span>Copy Code to Clipboard</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>