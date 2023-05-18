<?php
if (!defined('ABSPATH')) { die();
}

/*--------------------------------------
Variables
--------------------------------------*/

// ID & Classes
$overlay_id = 'brxcCSSOverlay';
$prefix = 'global-code-openai';
// Heading
$modal_heading_title = 'Advanced CSS';
//for loops
$i = 0;
?>
<!-- Main -->
<div id="<?php echo esc_attr($overlay_id);?>" class="brxc-overlay__wrapper" style="opacity:0" data-input-target="" onclick="ADMINBRXC.closeModal(event, this, '#<?php echo esc_attr($overlay_id);?>');" >
    <!-- Main Inner -->
    <div class="brxc-overlay__inner brxc-large">
        <!-- Close Modal Button -->
        <div class="brxc-overlay__close-btn" onClick="ADMINBRXC.closeModal(event, event.target, '#<?php echo esc_attr($overlay_id);?>')">
            <i class="bricks-svg ti-close"></i>
        </div>
        <!-- Modal Wrapper -->
        <div class="brxc-overlay__inner-wrapper">
            <!-- Modal Header -->
            <div class="brxc-overlay__header">
                <!-- Modal Header Title-->
                <h3 class="brxc-overlay__header-title"><?php echo esc_attr($modal_heading_title);?></h3>
            </div>
            <!-- Modal Error Container for OpenAI -->
            <div class="brxc-overlay__error-message-wrapper"></div>
            <!-- Modal Container -->
            <div class="brxc-overlay__container">
                <!-- Modal Panel Switch -->
                <div class="brxc-overlay__panel-switcher-wrapper">
                    <!-- Label/Input Switchers -->
                    <input type="radio" id="<?php echo esc_attr($prefix)?>-page" name="<?php echo esc_attr($prefix)?>-switch" class="brxc-input__radio" data-code="page" data-transform="0" onClick="ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);" checked>
                    <label for="<?php echo esc_attr($prefix)?>-page">Page CSS</label>
                    <input type="radio" id="<?php echo esc_attr($prefix)?>-global" name="<?php echo esc_attr($prefix)?>-switch" class="brxc-input__radio" data-code="global" data-transform="0" onClick="ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);">
                    <label for="<?php echo esc_attr($prefix)?>-global">Global CSS</label>
                    <?php if (get_template_directory() !== get_stylesheet_directory()){
                        ?>
                        <input type="radio" id="<?php echo esc_attr($prefix)?>-child-theme" name="<?php echo esc_attr($prefix)?>-switch" class="brxc-input__radio" data-code="child-theme" data-transform="0" onClick="ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);">
                        <label for="<?php echo esc_attr($prefix)?>-child-theme">Child Theme CSS</label>
                    <?php }
                    if ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :
                        while ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :
                            the_row();
                            $label = get_sub_field('field_63b4bd5c16ac3', 'bricks-advanced-themer' );
                            $label_lower = strtolower( preg_replace( '/\s+/', '-', esc_attr($label) ) );
                            ?>
                            <input type="radio" id="<?php echo esc_attr($prefix)?>-<?php echo esc_attr($label_lower);?>" name="<?php echo esc_attr($prefix)?>-switch" class="brxc-input__radio" data-code="<?php echo esc_attr($label_lower);?>" data-transform="0" onClick="ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);">
                            <label for="<?php echo esc_attr($prefix)?>-<?php echo esc_attr($label_lower);?>"><?php echo esc_attr($label);?> (Imported)</label>
                        <?php
                        endwhile;
                    
                    endif;
                    ?>
                    <input type="radio" id="<?php echo esc_attr($prefix)?>-variables" name="<?php echo esc_attr($prefix)?>-switch" class="brxc-input__radio" data-code="variables" data-transform="0" onClick="ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);">
                    <label for="<?php echo esc_attr($prefix)?>-variables">CSS Variables</label>
                    <input type="radio" id="<?php echo esc_attr($prefix)?>-ai" name="<?php echo esc_attr($prefix)?>-switch" class="brxc-input__radio" data-transform="calc(-100% - 80px)" onClick="ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);">
                    <label for="<?php echo esc_attr($prefix)?>-ai" style="margin-left: auto;">AI Assistant</label>
                    <!-- End of Label/Input Switchers -->
                </div>
                <!-- End of Panel Switch -->
                <!-- Modal Panels Wrapper -->
                <div class="brxc-overlay__pannels-wrapper">
                    <!-- Modal Panel -->
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-1">
                        <!-- Panel Content -->

                        <div id="brxcCSSColRight">
                            <div id="brxcPageCSSWrapper" class="brxc-overlay-css__wrapper" data-code="variables">
                                <p class="brxc-overlay-css__desc">Click on any button to copy the corresponding CSS variable to your clipboard. To modify the CSS variable values, go to your <a href="/wp-admin/admin.php?page=bricks-advanced-themer" target="_blank">Advanced Themer Settings</a>.</p>
                                <div class="isotope-wrapper" data-gutter="10" data-filter-layout="fitRows">
                                    <!-- Panel Content -->
                                    <div class="brxc-overlay__search-box">
                                        <input type="search" class="iso-search" name="typography-search" placeholder="Type here to filter the CSS variables" data-type="textContent">
                                        <div class="iso-reset">
                                            <i class="bricks-svg ti-close"></i>
                                        </div>
                                    </div>
                                    <?php
                                    if ( is_array( $typography ) && !empty( $typography ) ){
                                        ?>
                                        <label class="brxc-input__label">Typography</label>
                                        <div class="brxc-overlay__action-btn-wrapper isotope-container">
                                        
                                            <?php foreach ( $typography as $value ) {
                                                ?>
                                                <div class="brxc-overlay__action-btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>" onClick="ADMINBRXC.copytoClipboard(this, this.dataset.variable, 'copied!', this.textContent);"><?php echo esc_attr($value[0]) ?></div> 

                                            <?php }
                                        ?>
                                        </div>
                                    <?php
                                    }

                                    if ( is_array( $spacing ) && !empty( $spacing ) ){
                                        ?>
                                        <label class="brxc-input__label">Spacing</label>
                                        <div class="brxc-overlay__action-btn-wrapper isotope-container">
                                        
                                            <?php foreach ( $spacing as $value ) {
                                                ?>
                                                <div class="brxc-overlay__action-btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>" onClick="ADMINBRXC.copytoClipboard(this, this.dataset.variable, 'copied!', this.textContent);"><?php echo esc_attr($value[0]) ?></div>

                                            <?php }
                                            ?>
                                        </div>
                                    <?php 
                                    }

                                    if ( is_array( $border ) && !empty( $border ) ){
                                        ?>
                                        <label class="brxc-input__label">Border-Radius</label>
                                        <div class="brxc-overlay__action-btn-wrapper isotope-container">
                                        
                                            <?php foreach ( $border as $value ) {
                                                ?>
                                                <div class="brxc-overlay__action-btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>" onClick="ADMINBRXC.copytoClipboard(this, this.dataset.variable, 'copied!', this.textContent);"><?php echo esc_attr($value[0]) ?></div>

                                            <?php }
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    
                                    if ( is_array( $misc ) && !empty( $misc ) ){

                                        $index = 0;

                                        foreach ( $misc as $cat ) {
                                        ?>
                                        <label class="brxc-input__label"><?php echo esc_attr($cat[$index]['label']); ?></label>
                                        <div class="brxc-overlay__action-btn-wrapper isotope-container">

                                            <?php
                                            if ( is_array( $cat[$index]['items'] ) && !empty( $cat[$index]['items'] ) ){ 
                                                foreach ( $cat[$index]['items'] as $value ) {
                                                    ?>
                                                    <div class="brxc-overlay__action-btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>" onClick="ADMINBRXC.copytoClipboard(this, this.dataset.variable, 'copied!', this.textContent);"><?php echo esc_attr($value[0]) ?></div> 
                                                <?php }
                                            }
                                        ?>
                                        </div>
                                        <?php 
                                        $index++;
                                        }
                                    }?>
                                    <!-- End of Panel Content -->
                                </div>
                                <!-- End of Modal Panel -->
                            </div>
                            <div id="brxcPageCSSWrapper" class="brxc-overlay-css__wrapper has-codemirror active" data-code="page">
                                <p class="brxc-overlay-css__desc">Insert your page-specific CSS code here. It will be automatically applied & synched with the builder.</p>
                                <textarea id="brxcCustomCSS" class="brxcCodeMirror"></textarea>
                            </div>
                            <div id="<?php echo esc_attr($prefix);?>CSSWrapper" class="brxc-overlay-css__wrapper has-codemirror" data-code="global">
                                <p class="brxc-overlay-css__desc">The following CSS codes apply on all the pages of your website. All the changes made here during this session will apply on the page, <strong>but they won't be saved inside your database and will be lost after a page refresh</strong>. Thus, if you want to save your work, make sure to copy/paste your code inside the <a href="/wp-admin/admin.php?page=bricks-settings#tab-custom-code" target="_blank"> Bricks Settings</a>.</p>
                                <textarea id="brxcCustomGlobalCSS" class="brxcCodeMirror"></textarea>
                            </div>
                            <?php
                            if (get_template_directory() !== get_stylesheet_directory()){
                                $file = get_stylesheet_directory() . '/style.css';
                                ?>
                                <div class="brxc-overlay-css__wrapper has-codemirror" data-code="child-theme">
                                    <p class="brxc-overlay-css__desc"> The following CSS codes apply on all the pages of your website. The Child Theme CSS are set to be read-only. To modify it, go to your <a href="/wp-admin/theme-Codeor.php" target="_blank">Theme File Codeor</a>.</p>
                                    <textarea class="brxc-codemirror__imported"><?php echo esc_html(file_get_contents($file));?></textarea>
                                </div>
                            <?php }
                            if ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :
                                while ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :
                                    the_row();
                                    $label = get_sub_field('field_63b4bd5c16ac3', 'bricks-advanced-themer' );
                                    $file = get_sub_field('field_63b4bdf216ac7', 'bricks-advanced-themer' );
                                    ?>
                                    <div class="brxc-overlay-css__wrapper has-codemirror" data-code="<?php echo strtolower( preg_replace( '/\s+/', '-', esc_attr($label) ) );?>">
                                        <p class="brxc-overlay-css__desc">The following CSS codes apply on all the pages of your website. The imported CSS are set to be read-only. To modify it, go to your <a href="/wp-admin/admin.php?page=bricks-advanced-themer" target="_blank">Advanced Themer Settings</a>.</p>
                                        <textarea class="brxc-codemirror__imported"><?php echo esc_html(file_get_contents($file));?></textarea>
                                    </div>
                                <?php endwhile;
                            endif;
                            ?>
                        </div>

                        <!-- End of Panel Content -->
                    </div>
                    <!-- End of Modal Panel -->
                    <!-- Modal Panel -->
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-2 code accordion v1">
                    <?php 
                    $pannel = '.brxc-overlay__pannel-2.code';
                    $type = 'Code';
                    $custom_tone = false;
                    $include_tones = false;
                    ?>
                        <!-- Panel Content -->
                        <div class="brxc-field__wrapper">
                            <label class="brxc-input__label">User Prompt <span class="brxc__light">(Required)</span></label>
                            <?php include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/openai_no_reset.php';?>
                            <textarea name="<?php echo esc_attr($prefix);?>-prompt-text" id="<?php echo esc_attr($prefix);?>PromptText" class="<?php echo esc_attr($prefix);?>-prompt-text reset-value-on-reset message user" placeholder="Type your prompt text here..." cols="30" rows="3"></textarea>
                        </div>
                        <?php 
                        include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/openai_advanced_options.php';
                        ?>
                        <div id="<?php echo esc_attr($prefix);?>Generate<?php echo esc_attr($type);?>ContentWrapper" class="brxc-overlay__action-btn-wrapper right m-top-16 generate-content active">
                            <div class="brxc-overlay__action-btn" onClick="ADMINBRXC.resetAIresponses(document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .reset-value-on-reset:not(input.brxc-no-reset:checked ~ *)'), document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .remove-on-reset'), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> #<?php echo esc_attr($prefix);?>Generate<?php echo esc_attr($type);?>ContentWrapper'))"><span>Reset</span></div>
                            <div class="brxc-overlay__action-btn primary" onclick="ADMINBRXC.getCodeAIResponse('<?php echo esc_attr($prefix);?>',this,true,'#<?php echo esc_attr($overlay_id);?>', parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Temperature').value).toFixed(1), parseInt(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>MaxTokens').value), parseInt(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Choices').value), parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>TopP').value).toFixed(2), parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Presence').value).toFixed(1), parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Frequency').value).toFixed(1), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> input[name=<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>-models]:checked').value);"><span>Generate Content</span></div>
                        </div>
                        <div id="<?php echo esc_attr($prefix);?>Insert<?php echo esc_attr($type);?>ContentWrapper" class="brxc-overlay__action-btn-wrapper right m-top-16 action-wrapper">
                            <div class="brxc-overlay__action-btn" onClick="ADMINBRXC.resetAIresponses(document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .reset-value-on-reset:not(input.brxc-no-reset:checked ~ *)'), document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .remove-on-reset'), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> #<?php echo esc_attr($prefix);?>Generate<?php echo esc_attr($type);?>ContentWrapper'))">
                                <span>Reset</span>
                            </div>
                            <div class="brxc-overlay__action-btn" onClick='ADMINBRXC.copytoClipboard(this,document.querySelector("#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> input[name=<?php echo esc_attr($prefix);?>-code-results]:checked + label .CodeMirror").CodeMirror.getValue(),"Content Copied!", "Copy Selected to Clipboard");'>
                                <span>Copy Selected to Clipboard</span>
                            </div>
                            <div class="brxc-overlay__action-btn primary" onClick='ADMINBRXC.pasteAICode(document.querySelector("#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> input[name=<?php echo esc_attr($prefix);?>-code-results]:checked + label .CodeMirror").CodeMirror.getValue());'>
                                <span>Insert Code to your Page CSS</span>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal Panel -->
                    
                </div>
                <!-- End of Modal Panels Wrapper -->
            </div>
            <!-- End of Modal Container -->
        </div>
        <!-- End of Modal Wrapper -->
    </div>
    <!-- End of Main Inner -->
</div>
<!-- End of Main -->