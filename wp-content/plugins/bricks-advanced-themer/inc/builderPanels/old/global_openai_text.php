<?php
if (!defined('ABSPATH')) { die();
}
?>
<div id="brxcGlobalOpenAIOverlay" class="brxc-overlay__wrapper" style="opacity:0" data-input-target="" onclick="ADMINBRXC.closeModal(event, this, '#brxcGlobalOpenAIOverlay');" >
    <div class="brxc-overlay__inner">
        <div class="brxc-overlay__close-btn" onClick="ADMINBRXC.closeModal(event, event.target, '#brxcGlobalOpenAIOverlay')">
            <i class="bricks-svg ti-close"></i>
        </div>
        <div class="brxc-overlay__inner-wrapper">
            <div class="brxc-overlay__header">
                <h3 class="brxc-overlay__header-title">OpenAI Assistant</h3>
            </div>
            <div class="error-message-wrapper"></div>
            <div class="brxc-overlay__container">
                <div class="openai-type">
                    <input type="radio" id="global-openai-completion" name="global-openai-type" class="brxc-input__radio" data-transform="0" onClick="ADMINBRXC.movePanel(document.querySelector('#brxcGlobalOpenAIOverlay .brxc-overlay__type-wrapper'),this.dataset.transform);" checked>
                    <label for="global-openai-completion" class="brxc-input__label">Completion / Chat</label>
                    <input type="radio" id="global-openai-edit" name="global-openai-type" class="brxc-input__radio" data-transform="calc(-100% - 80px)" onClick="ADMINBRXC.movePanel(document.querySelector('#brxcGlobalOpenAIOverlay .brxc-overlay__type-wrapper'),this.dataset.transform);">
                    <label for="global-openai-edit" class="brxc-input__label">Edit</label>
                    <input type="radio" id="global-openai-images" name="global-openai-type" class="brxc-input__radio" data-transform="calc(2 * (-100% - 80px))" onClick="ADMINBRXC.movePanel(document.querySelector('#brxcGlobalOpenAIOverlay .brxc-overlay__type-wrapper'),this.dataset.transform);">
                    <label for="global-openai-images" class="brxc-input__label">Images</label>
                    <input type="radio" id="global-openai-history" name="global-openai-type" class="brxc-input__radio" data-transform="calc(3 * (-100% - 80px))" onClick="ADMINBRXC.mounAIHistory('#brxcGlobalOpenAIOverlay');ADMINBRXC.movePanel(document.querySelector('#brxcGlobalOpenAIOverlay .brxc-overlay__type-wrapper'),this.dataset.transform);">
                    <label for="global-openai-history" class="brxc-input__label" style="margin-left: auto;">History</label>
                </div>
                <div class="brxc-overlay__type-wrapper">
                    <div class="brxc-overlay__inner-1">
                        <div class="brxc-overlay__inner--overflow">
                            <label for="globalAISystem" class="brxc-input__label">Tone of voice <span class="brxc__light">(Optional)</span></label>
                            <div class="openai-tones">
                            <?php 
                            foreach($brxc_acf_fields['tone_of_voice'] as $tone){
                                $str = strtolower( preg_replace( '/\s+/', '-', $tone ) );
                            ?>
                                <input type="checkbox" id="global-openai-<?php echo $str;?>" name="global-openai-tones" class="brxc-input__checkbox" data-tone="<?php echo $str;?>">
                                <label for="global-openai-<?php echo $str;?>" class="brxc-input__label"><?php echo $tone;?></label>
                            <?php
                            }
                            ?>
                                <input type="checkbox" id="global-openai-custom" name="global-openai-tones" class="brxc-input__checkbox" onChange="ADMINBRXC.toggleCustomToneVoice(true, this);" data-tone="custom">
                                <label for="global-openai-custom" class="brxc-input__label">Custom</label>
                            </div>
                            <div class="brxc__text">
                                <input type="text" name="globalAISystem" id="globalAISystem" class="brxc-input__range" placeholder="Type here any additional information on the System context." style="display: none">
                            </div>
                            <div class="brxc-prompt-options-wrapper">
                            <div class="brxc-prompt-option">
                                    <label for="globalAIChoices" class="brxc-input__label"><span>Num Choices</span><div data-balloon="How many chat completion choices to generate for each input message." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></label>
                                    <div class="brxc__range">
                                        <input type="range" min="1" max="5" step="1" value="1" name="globalAIChoices" id="globalAIChoices" class="brxc-input__range" oninput="document.querySelector('#globalAIChoicesValue').innerHTML = parseInt(event.target.value).toFixed(0)">
                                        <span id="globalAIChoicesValue">1</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="globalAIMaxTokens" class="brxc-input__label"><span>Max Tokens per input</span><div data-balloon="The maximum number of tokens to generate in the completion. The token count of your prompt plus max_tokens cannot exceed the model's context length (4096)." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></label>
                                    <div class="brxc__range">
                                        <input type="range" min="0" max="4096" step="1" value="100" name="globalAIMaxTokens" id="globalAIMaxTokens" class="brxc-input__range" oninput="document.querySelector('#globalAIMaxTokensValue').innerHTML = parseInt(event.target.value).toFixed(0)">
                                        <span id="globalAIMaxTokensValue">100</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="globalAITemperature" class="brxc-input__label"><span>Temperature</span><div data-balloon="What sampling temperature to use, between 0 and 2. Higher values like 0.8 will make the output more random, while lower values like 0.2 will make it more focused and deterministic. It's recommended altering this or top probability but not both." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></label>
                                    <div class="brxc__range">
                                        <input type="range" min="0" max="2" step="0.1" value="1" name="globalAITemperature" id="globalAITemperature" class="brxc-input__range" oninput="document.querySelector('#globalAITemperatureValue').innerHTML = parseFloat(event.target.value).toFixed(1)">
                                        <span id="globalAITemperatureValue">1</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="globalAITopP" class="brxc-input__label"><span>Top Probability</span><div data-balloon="An alternative to sampling with temperature, called nucleus sampling, where the model considers the results of the tokens with top_p probability mass. So 0.1 means only the tokens comprising the top 10% probability mass are considered. It's recommended altering this or temperature but not both." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></label>
                                    <div class="brxc__range">
                                        <input type="range" min="0.01" max="1" step="0.01" value="1" name="globalAITopP" id="globalAITopP" class="brxc-input__range" oninput="document.querySelector('#globalAITopPValue').innerHTML = parseFloat(event.target.value).toFixed(2)">
                                        <span id="globalAITopPValue">1</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="globalAIPresence" class="brxc-input__label"><span>Presence Penalty</span><div data-balloon="Number between -2.0 and 2.0. Positive values penalize new tokens based on whether they appear in the text so far, increasing the model's likelihood to talk about new topics." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></span></label>
                                    <div class="brxc__range">
                                        <input type="range" min="-2" max="2" step="0.1" value="0" name="globalAIPresence" id="globalAIPresence" class="brxc-input__range" oninput="document.querySelector('#globalAIPresenceValue').innerHTML = parseFloat(event.target.value).toFixed(1)">
                                        <span id="globalAIPresenceValue">0</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="globalAIFrequency" class="brxc-input__label"><span>Frequency Penalty</span><div data-balloon="Number between -2.0 and 2.0. Positive values penalize new tokens based on their existing frequency in the text so far, decreasing the model's likelihood to repeat the same line verbatim." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></label>
                                    <div class="brxc__range">
                                        <input type="range" min="-2" max="2" step="0.1" value="0" name="globalAIFrequency" id="globalAIFrequency" class="brxc-input__range" oninput="document.querySelector('#globalAIFrequencyValue').innerHTML = parseFloat(event.target.value).toFixed(1)">
                                        <span id="globalAIFrequencyValue">0</span>
                                    </div>
                                </div>
                            </div>
                            <label for="openAIPromptText" class="brxc-input__label">User Prompt <span class="brxc__light">(Required)</span></label>
                            <textarea name="openAI-prompt-text" id="globalOpenAIPromptText" class="openAI-prompt-text message user" placeholder="Type your prompt text here..." cols="30" rows="3"></textarea>
                            <div class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelector('#brxcGlobalOpenAIOverlay #globalOpenAIPromptText').value = '';let removes = document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-1 .remove-on-reset');removes.forEach(el => {el.remove()});"><span>Reset</span></div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onclick="ADMINBRXC.getAIResponse(this,true,'#brxcGlobalOpenAIOverlay', document.querySelectorAll('#brxcGlobalOpenAIOverlay input[name=global-openai-tones]:checked'), document.querySelector('#brxcGlobalOpenAIOverlay #globalAISystem').value, parseFloat(document.querySelector('#globalAITemperature').value).toFixed(1), parseInt(document.querySelector('#globalAIMaxTokens').value), parseInt(document.querySelector('#globalAIChoices').value), parseFloat(document.querySelector('#globalAITopP').value).toFixed(2), parseFloat(document.querySelector('#globalAIPresence').value).toFixed(1), parseFloat(document.querySelector('#globalAIFrequency').value).toFixed(1));"><span>Generate Content</span></div>
                            </div>
                            <div id="brxcglobalInsertContentWrapper" class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelector('#brxcGlobalOpenAIOverlay #globalOpenAIPromptText').value = '';let removes = document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-1 .remove-on-reset');removes.forEach(el => {el.remove()});">
                                    <span>Reset</span>
                                </div>
                                <div id="globalOpenAIChatMore" class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="ADMINBRXC.chatMoreAIResponse(true, '#brxcGlobalOpenAIOverlay')">
                                    <span>Chat More</span>
                                </div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onClick='ADMINBRXC.copytoClipboard(this,document.querySelector("#brxcGlobalOpenAIOverlay input[name=openai-results]:checked + label .message.assistant").textContent,"Content Copied!", "Copy Selected to Clipboard");'>
                                    <span>Copy Selected to Clipboard</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="brxc-overlay__inner-2">
                        <div class="brxc-overlay__inner--overflow">
                            <label for="globalOpenAIEditText" class="brxc-input__label">User Prompt <span class="brxc__light">(Required)</span></label>
                            <textarea name="global-openAI-prompt-text" id="globalOpenAIEditText" class="openAI-prompt-text message input" placeholder="Type your prompt text here..." cols="30" rows="3"></textarea>
                            <div class="brxc-prompt-options-wrapper">
                                <div class="brxc-prompt-option">
                                    <label for="globalAIEditChoices" class="brxc-input__label">Num Choices</label>
                                    <div class="brxc__range">
                                        <input type="range" min="1" max="5" step="1" value="1" name="globalAIEditChoices" id="globalAIEditChoices" class="brxc-input__range" oninput="document.querySelector('#globalAIEditChoicesValue').innerHTML = parseInt(event.target.value).toFixed(0)">
                                        <span id="globalAIEditChoicesValue">1</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="globalAIEditTemperature" class="brxc-input__label">Temperature</label>
                                    <div class="brxc__range">
                                        <input type="range" min="0" max="2" step="0.1" value="1" name="globalAIEditTemperature" id="globalAIEditTemperature" class="brxc-input__range" oninput="document.querySelector('#globalAIEditTemperatureValue').innerHTML = parseFloat(event.target.value).toFixed(1)">
                                        <span id="globalAIEditTemperatureValue">1</span>
                                    </div>
                                </div>
                            </div>
                            <label for="openAIEditInstruction" class="brxc-input__label">Instructions <span class="brxc__light">(Required)</span></label>
                            <textarea name="openAI-prompt-text" id="globalOpenAIEditInstruction" class="openAI-prompt-text message instruction" placeholder="Type your instructions here..." cols="30" rows="3"></textarea>
                            <div class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-2 .message').forEach(el => el.value = '');document.querySelector('#brxcGlobalOpenAIOverlay #globalOpenAIEditInstruction').value = '';let removes = document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-2 .remove-on-reset');removes.forEach(el => {el.remove()});">
                                    <span>Reset</span>
                                </div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onclick="ADMINBRXC.getEditAIResponse(this,true, '#brxcGlobalOpenAIOverlay', parseFloat(document.querySelector('#globalAIEditTemperature').value), parseInt(document.querySelector('#globalAIEditChoices').value));">
                                    <span>Generate Edit</span>
                                </div>
                            </div>
                            <div id="brxcglobalInsertEditContentWrapper" class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-2 .message').forEach(el => el.value = '');document.querySelector('#brxcGlobalOpenAIOverlay #globalOpenAIEditInstruction').value = '';let removes = document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-2 .remove-on-reset');removes.forEach(el => {el.remove()});">
                                    <span>Reset</span>
                                </div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onClick='ADMINBRXC.copytoClipboard(this,document.querySelector("#brxcGlobalOpenAIOverlay input[name=openai-edit-results]:checked + label .message.assistant").textContent,"Content Copied!", "Copy Selected to Clipboard");'>
                                    <span>Copy Selected to Clipboard</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="brxc-overlay__inner-4">
                        <div class="brxc-overlay__inner--overflow">
                            <label for="globalOpenAIImages" class="brxc-input__label">User Prompt <span class="brxc__light">(Required - Max 1000 characters)</span></label>
                            <textarea name="global-openAI-prompt-text" id="globalOpenAIImages" class="openAI-prompt-text message input" placeholder="Describe your image here..." cols="30" rows="5" maxlength="1000"></textarea>
                            <div class="brxc-prompt-options-wrapper">
                                <div class="brxc-prompt-option">
                                    <label for="globalAIImagesChoices" class="brxc-input__label">Num Choices</label>
                                    <div class="brxc__range">
                                        <input type="range" min="1" max="10" step="1" value="1" name="globalAIImagesChoices" id="globalAIImagesChoices" class="brxc-input__range" oninput="document.querySelector('#globalAIImagesChoicesValue').innerHTML = parseInt(event.target.value)">
                                        <span id="globalAIImagesChoicesValue">1</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label class="brxc-input__label">Image Size</label>
                                    <div class="openai-images">
                                        <input type="radio" id="global-openai-256" name="global-openai-images" class="brxc-input__radio" checked>
                                        <label for="global-openai-256" class="brxc-input__label">256x256</label>
                                        <input type="radio" id="global-openai-512" name="global-openai-images" class="brxc-input__radio">
                                        <label for="global-openai-512" class="brxc-input__label">512x512</label>
                                        <input type="radio" id="global-openai-1024" name="global-openai-images" class="brxc-input__radio">
                                        <label for="global-openai-1024" class="brxc-input__label">1024x1024</label>
                                    </div>
                                </div>
                            </div>
                            <div class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelector('#brxcGlobalOpenAIOverlay #globalOpenAIImages').value = '';let removes = document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-4 .remove-on-reset');removes.forEach(el => {el.remove()});">
                                    <span>Reset</span>
                                </div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onclick="ADMINBRXC.getImageAIResponse(this,true, '#brxcGlobalOpenAIOverlay', parseInt(document.querySelector('#globalAIImagesChoices').value), document.querySelector('#brxcGlobalOpenAIOverlay input[name=global-openai-images]:checked + label').textContent);">
                                    <span>Generate Image(s)</span>
                                </div>
                            </div>
                            <div id="brxcglobalInsertImagesContentWrapper" class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelector('#brxcGlobalOpenAIOverlay #globalOpenAIImages').value = '';let removes = document.querySelectorAll('#brxcGlobalOpenAIOverlay .brxc-overlay__inner-4 .remove-on-reset');removes.forEach(el => {el.remove()});">
                                    <span>Reset</span>
                                </div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick='ADMINBRXC.downloadAIImage(document.querySelector("#brxcGlobalOpenAIOverlay input[name=global-openai-images-results]:checked + label img.brxc__image").src)'>
                                    <span>Download</span>
                                </div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onClick='ADMINBRXC.saveAIImagetoMediaLibrary(this,document.querySelector("#brxcGlobalOpenAIOverlay input[name=global-openai-images-results]:checked + label img.brxc__image").src);'>
                                    <span>Save to Media Library</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="brxc-overlay__inner-3">
                        <div class="brxc-overlay__inner--overflow">
                            <div id="brxcGlobalOpenAIHistory" class="brxc-ai-response-wrapper brxc-canvas"></div>
                            <div id="brxcglobalInsertHistoryContentWrapper" class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelector('#brxcGlobalOpenAIHistory').innerHTML = '<p class=\'brxc__no-record\'>No records yet. Please come back here after you generated some AI content.</p>';ADMINBRXC.aihistory = [];">
                                    <span>Reset</span>
                                </div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onClick='ADMINBRXC.copytoClipboard(this,document.querySelector("#brxcGlobalOpenAIOverlay input[name=openai-results]:checked + label .message.assistant").textContent,"Content Copied!", "Copy Selected to Clipboard");'>
                                    <span>Copy Selected to Clipboard</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>