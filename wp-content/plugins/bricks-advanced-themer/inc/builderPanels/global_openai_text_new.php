<?php
if (!defined('ABSPATH')) { die();
}

/*--------------------------------------
Variables
--------------------------------------*/

// ID & Classes
$overlay_id = 'brxcGlobalOpenAIOverlay';
$prefix = 'global-openai';
// Heading
$modal_heading_title = 'OpenAI Assistant';
//for loops
$i = 0;

?>
<!-- Main -->
<div id="<?php echo esc_attr($overlay_id);?>" class="brxc-overlay__wrapper" style="opacity:0" data-input-target="" onclick="ADMINBRXC.closeModal(event, this, '#<?php echo esc_attr($overlay_id);?>');" >
    <!-- Main Inner -->
    <div class="brxc-overlay__inner brxc-medium">
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
                    <input type="radio" id="<?php echo esc_attr($prefix);?>-completion" name="<?php echo esc_attr($prefix);?>-switch" class="brxc-input__radio" data-transform="0" onClick="ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);" checked>
                    <label for="<?php echo esc_attr($prefix);?>-completion" class="brxc-input__label">Completion / Chat</label>
                    <input type="radio" id="<?php echo esc_attr($prefix);?>-edit" name="<?php echo esc_attr($prefix);?>-switch" class="brxc-input__radio" data-transform="calc(-100% - 80px)" onClick="ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);">
                    <label for="<?php echo esc_attr($prefix);?>-edit" class="brxc-input__label">Edit</label>
                    <input type="radio" id="<?php echo esc_attr($prefix);?>-images" name="<?php echo esc_attr($prefix);?>-switch" class="brxc-input__radio" data-transform="calc(2 * (-100% - 80px))" onClick="ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);">
                    <label for="<?php echo esc_attr($prefix);?>-images" class="brxc-input__label">Images</label>
                    <input type="radio" id="<?php echo esc_attr($prefix);?>-history" name="<?php echo esc_attr($prefix);?>-switch" class="brxc-input__radio" data-transform="calc(3 * (-100% - 80px))" onClick="ADMINBRXC.mounAIHistory('<?php echo esc_attr($prefix);?>', '#<?php echo esc_attr($overlay_id);?>');ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);">
                    <label for="<?php echo esc_attr($prefix);?>-history" class="brxc-input__label" style="margin-left: auto;">History</label>
                    <!-- End of Label/Input Switchers -->
                </div>
                <!-- End of Panel Switch -->
                <!-- Modal Panels Wrapper -->
                <div class="brxc-overlay__pannels-wrapper">
                    <!-- Modal Panel -->
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-1 completion accordion v1">
                    <?php 
                    $pannel = '.brxc-overlay__pannel-1.completion';
                    $type = 'Chat';
                    $custom_tone = true;
                    $include_tones = true;
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
                        <div id="<?php echo esc_attr($prefix);?>GenerateContentWrapper" class="brxc-overlay__action-btn-wrapper right m-top-16 generate-content active">
                            <div class="brxc-overlay__action-btn" onClick="ADMINBRXC.resetAIresponses(document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .reset-value-on-reset:not(input.brxc-no-reset:checked ~ *)'), document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .remove-on-reset'), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> #<?php echo esc_attr($prefix);?>GenerateContentWrapper'))"><span>Reset</span></div>
                            <div class="brxc-overlay__action-btn primary" onclick="ADMINBRXC.getAIResponse('<?php echo esc_attr($prefix);?>',this,true,'#<?php echo esc_attr($overlay_id);?>', document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> input[name=<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>-tones]:checked'), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> #<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>System').value, parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Temperature').value).toFixed(1), parseInt(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>MaxTokens').value), parseInt(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Choices').value), parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>TopP').value).toFixed(2), parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Presence').value).toFixed(1), parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Frequency').value).toFixed(1), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> input[name=<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>-models]:checked').value);"><span>Generate Content</span></div>
                        </div>
                        <div id="<?php echo esc_attr($prefix);?>InsertContentWrapper" class="brxc-overlay__action-btn-wrapper right m-top-16 action-wrapper">
                            <div class="brxc-overlay__action-btn" onClick="ADMINBRXC.resetAIresponses(document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .reset-value-on-reset:not(input.brxc-no-reset:checked ~ *)'), document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .remove-on-reset'), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> #<?php echo esc_attr($prefix);?>GenerateContentWrapper'))">
                                <span>Reset</span>
                            </div>
                            <div id="<?php echo esc_attr($prefix);?>ChatMore" class="brxc-overlay__action-btn" onclick="ADMINBRXC.chatMoreAIResponse('<?php echo esc_attr($prefix);?>', true, '#<?php echo esc_attr($overlay_id);?>')">
                                <span>Chat More</span>
                            </div>
                            <div class="brxc-overlay__action-btn primary" onClick='ADMINBRXC.copytoClipboard(this,document.querySelector("#<?php echo esc_attr($overlay_id);?> input[name=openai-results]:checked + label .message.assistant").textContent,"Content Copied!", "Copy Selected to Clipboard");'>
                                <span>Copy Selected to Clipboard</span>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal Panel -->
                    <!-- Modal Panel -->
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-2 edit accordion v1">
                    <?php 
                    $pannel = '.brxc-overlay__pannel-2.edit';
                    $type = 'Edit';
                    $custom_tone = false;
                    $include_tones = true;
                    ?>
                        <!-- Panel Content -->
                        <div class="brxc-field__wrapper">
                            <label class="brxc-input__label">User Prompt <span class="brxc__light">(Required)</span></label>
                            <?php include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/openai_no_reset.php';?>
                            <textarea name="<?php echo esc_attr($prefix);?>-prompt-text" id="<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Text" class="<?php echo esc_attr($prefix);?>-prompt-text reset-value-on-reset message user" placeholder="Type your prompt text here..." cols="30" rows="3"></textarea>
                        </div>
                        <div class="brxc-field__wrapper">
                            <label for="<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Instruction" class="brxc-input__label">Instructions <span class="brxc__light">(Required)</span></label>
                            <?php include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/openai_no_reset.php';?>
                            <textarea name="<?php echo esc_attr($prefix);?>-prompt-text" id="<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Instruction" class="<?php echo esc_attr($prefix);?>-prompt-text reset-value-on-reset message instruction" placeholder="Type your instructions here..." cols="30" rows="3"></textarea>
                        </div>
                        <?php 
                        include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/openai_advanced_options.php';
                        ?>
                        <div id="<?php echo esc_attr($prefix);?>Generate<?php echo esc_attr($type);?>ContentWrapper" class="brxc-overlay__action-btn-wrapper right m-top-16 generate-content active">
                            <div class="brxc-overlay__action-btn" onClick="ADMINBRXC.resetAIresponses(document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .reset-value-on-reset:not(input.brxc-no-reset:checked ~ *)'), document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .remove-on-reset'), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> #<?php echo esc_attr($prefix);?>Generate<?php echo esc_attr($type);?>ContentWrapper'))">
                                <span>Reset</span>
                            </div>
                            <div class="brxc-overlay__action-btn primary" onclick="ADMINBRXC.getEditAIResponse('<?php echo esc_attr($prefix);?>',this,true,'#<?php echo esc_attr($overlay_id);?>', document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> input[name=<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>-tones]:checked'), false, parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Temperature').value).toFixed(1), parseInt(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>MaxTokens').value), parseInt(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Choices').value), parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>TopP').value).toFixed(2), parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Presence').value).toFixed(1), parseFloat(document.querySelector('#<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>Frequency').value).toFixed(1), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> input[name=<?php echo esc_attr($prefix);?><?php echo esc_attr($type);?>-models]:checked').value);">
                                <span>Generate Edit</span>
                            </div>
                        </div>
                        <div id="<?php echo esc_attr($prefix);?>Insert<?php echo esc_attr($type);?>ContentWrapper" class="brxc-overlay__action-btn-wrapper right m-top-16 action-wrapper">
                            <div class="brxc-overlay__action-btn" onClick="ADMINBRXC.resetAIresponses(document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .reset-value-on-reset:not(input.brxc-no-reset:checked ~ *)'), document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .remove-on-reset'), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> #<?php echo esc_attr($prefix);?>Generate<?php echo esc_attr($type);?>ContentWrapper'))">
                                <span>Reset</span>
                            </div>
                            <div class="brxc-overlay__action-btn" onClick='ADMINBRXC.copytoClipboard(this,document.querySelector("#<?php echo esc_attr($overlay_id);?> input[name=<?php echo esc_attr($prefix);?>-edit-results]:checked + label .message.assistant").textContent,"Content Copied!", "Copy Selected to Clipboard");'>
                                <span>Copy Selected to Clipboard</span>
                            </div>
                        </div>
                        <!-- End of Panel Content -->
                    </div>
                    <!-- End of Modal Panel -->
                    <!-- Modal Panel -->
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-3 image accordion v1">
                    <?php 
                    $pannel = '.brxc-overlay__pannel-3.image';
                    $type = 'Images';
                    $custom_tone = false;
                    $include_tones = false;
                    ?>
                        <!-- Panel Content -->
                        <div class="brxc-field__wrapper">
                            <label class="brxc-input__label">User Prompt <span class="brxc__light">(Required - Max 1000 characters)</span></label>
                            <?php include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/openai_no_reset.php';?>
                            <textarea name="<?php echo esc_attr($prefix);?>-prompt-text" id="<?php echo esc_attr($prefix);?>Images" class="<?php echo esc_attr($prefix);?>-prompt-text reset-value-on-reset message input" placeholder="Describe your image here..." cols="30" rows="5" maxlength="1000"></textarea>
                        </div>
                        <div class="brxc-accordion-container">
                            <div class="brxc-accordion-btn">
                                <label>Advanced Options</label>
                                <span></span>
                            </div>
                            <div class="brxc-accordion-panel">
                                <div class="brxc-prompt-options-wrapper two-col">
                                    <div class="brxc-prompt-option">
                                        <label for="<?php echo esc_attr($prefix);?>ImagesChoices" class="brxc-input__label">Num Choices</label>
                                        <div class="brxc__range">
                                            <input type="range" min="1" max="10" step="1" value="1" name="<?php echo esc_attr($prefix);?>ImagesChoices" id="<?php echo esc_attr($prefix);?>ImagesChoices" class="brxc-input__range" oninput="document.querySelector('#<?php echo esc_attr($prefix);?>ImagesChoicesValue').innerHTML = parseInt(event.target.value)">
                                            <span id="<?php echo esc_attr($prefix);?>ImagesChoicesValue">1</span>
                                        </div>
                                    </div>
                                    <div class="brxc-prompt-option">
                                        <label class="brxc-input__label">Image Size</label>
                                        <div class="brxc-overlay__panel-inline-btns-wrapper">
                                            <input type="radio" id="<?php echo esc_attr($prefix);?>-256" name="<?php echo esc_attr($prefix);?>-images" class="brxc-input__radio" checked>
                                            <label for="<?php echo esc_attr($prefix);?>-256" class="brxc-overlay__panel-inline-btns">256x256</label>
                                            <input type="radio" id="<?php echo esc_attr($prefix);?>-512" name="<?php echo esc_attr($prefix);?>-images" class="brxc-input__radio">
                                            <label for="<?php echo esc_attr($prefix);?>-512" class="brxc-overlay__panel-inline-btns">512x512</label>
                                            <input type="radio" id="<?php echo esc_attr($prefix);?>-1024" name="<?php echo esc_attr($prefix);?>-images" class="brxc-input__radio">
                                            <label for="<?php echo esc_attr($prefix);?>-1024" class="brxc-overlay__panel-inline-btns">1024x1024</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="<?php echo esc_attr($prefix);?>GenerateImagesContentWrapper" class="brxc-ai-response-wrapper brxc-overlay__action-btn-wrapper right m-top-16 generate-content active">
                            <div class="brxc-overlay__action-btn" onClick="ADMINBRXC.resetAIresponses(document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .reset-value-on-reset:not(input.brxc-no-reset:checked ~ *)'), document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .remove-on-reset'), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> #<?php echo esc_attr($prefix);?>GenerateImagesContentWrapper'))">
                                <span>Reset</span>
                            </div>
                            <div class="brxc-overlay__action-btn primary" onclick="ADMINBRXC.getImageAIResponse('<?php echo esc_attr($prefix);?>', this,true, '#<?php echo esc_attr($overlay_id);?>', parseInt(document.querySelector('#<?php echo esc_attr($prefix);?>ImagesChoices').value), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> input[name=<?php echo esc_attr($prefix);?>-images]:checked + label').textContent);">
                                <span>Generate Image(s)</span>
                            </div>
                        </div>
                        <div id="<?php echo esc_attr($prefix);?>InsertImagesContentWrapper" class="brxc-ai-response-wrapper brxc-overlay__action-btn-wrapper right m-top-16 action-wrapper">
                            <div class="brxc-overlay__action-btn" onClick="ADMINBRXC.resetAIresponses(document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .reset-value-on-reset:not(input.brxc-no-reset:checked ~ *)'), document.querySelectorAll('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .remove-on-reset'), document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> #<?php echo esc_attr($prefix);?>GenerateImagesContentWrapper'))">
                                <span>Reset</span>
                            </div>
                            <div class="brxc-overlay__action-btn" onclick='ADMINBRXC.downloadAIImage(document.querySelector("#<?php echo esc_attr($overlay_id);?> input[name=<?php echo esc_attr($prefix);?>-images-results]:checked + label img.brxc__image").src)'>
                                <span>Download</span>
                            </div>
                            <div class="brxc-overlay__action-btn primary" onClick='ADMINBRXC.saveAIImagetoMediaLibrary(this,document.querySelector("#<?php echo esc_attr($overlay_id);?> input[name=<?php echo esc_attr($prefix);?>-images-results]:checked + label img.brxc__image").src);'>
                                <span>Save to Media Library</span>
                            </div>
                        </div>
                    </div>
                    <!-- End of Panel Content -->
                    <!-- Modal Panel -->
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-4 history">
                        <!-- Panel Content -->
                        <div id="<?php echo esc_attr($prefix);?>History" class="brxc-ai-response-wrapper brxc-canvas empty"></div>
                        <div id="<?php echo esc_attr($prefix);?>InsertHistoryContentWrapper" class="brxc-overlay__action-btn-wrapper right m-top-16 action-wrapper">
                            <div class="brxc-overlay__action-btn" onclick="document.querySelector('#<?php echo esc_attr($prefix);?>History').innerHTML = '<p class=\'brxc__no-record\'>No records yet. Please come back here after you generated some AI content.</p>';ADMINBRXC.aihistory = [];document.querySelector('#<?php echo esc_attr($overlay_id);?> <?php echo esc_attr($pannel);?> .brxc-overlay__pannel.history .brxc-canvas').classList.add('empty');">
                                <span>Reset</span>
                            </div>
                            <div class="brxc-overlay__action-btn primary" onClick='ADMINBRXC.copytoClipboard(this,document.querySelector("#<?php echo esc_attr($overlay_id);?> input[name=openai-results]:checked + label .message.assistant").textContent,"Content Copied!", "Copy Selected to Clipboard");'>
                                <span>Copy Selected to Clipboard</span>
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