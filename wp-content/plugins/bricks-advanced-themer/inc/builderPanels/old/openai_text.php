<?php
if (!defined('ABSPATH')) { die();
}
?>
<div id="brxcopenAIOverlay" class="brxc-overlay__wrapper" style="opacity:0" data-input-target="" onclick="ADMINBRXC.closeModal(event, this, '#brxcopenAIOverlay');" >
    <div class="brxc-overlay__inner">
        <div class="brxc-overlay__close-btn" onClick="ADMINBRXC.closeModal(event, event.target, '#brxcopenAIOverlay')">
            <i class="bricks-svg ti-close"></i>
        </div>
        <div class="brxc-overlay__inner-wrapper">
            <div class="brxc-overlay__header">
                <h3 class="brxc-overlay__header-title">OpenAI Assistant</h3>
            </div>
            <div class="error-message-wrapper"></div>
            <div class="brxc-overlay__container">
                <div class="openai-type">
                    <input type="radio" id="openai-completion" name="openai-type" class="brxc-input__radio" data-transform="0" onClick="ADMINBRXC.movePanel(document.querySelector('#brxcopenAIOverlay .brxc-overlay__type-wrapper'),this.dataset.transform);" checked>
                    <label for="openai-completion" class="brxc-input__label">Completion / Chat</label>
                    <input type="radio" id="openai-edit" name="openai-type" class="brxc-input__radio" data-transform="calc(-100% - 80px)" onClick="ADMINBRXC.movePanel(document.querySelector('#brxcopenAIOverlay .brxc-overlay__type-wrapper'),this.dataset.transform);">
                    <label for="openai-edit" class="brxc-input__label">Edit</label>
                    <input type="radio" id="openai-history" name="openai-type" class="brxc-input__radio" data-transform="calc(2 * (-100% - 80px))" onClick="ADMINBRXC.mounAIHistory('#brxcopenAIOverlay');ADMINBRXC.movePanel(document.querySelector('#brxcopenAIOverlay .brxc-overlay__type-wrapper'),this.dataset.transform);">
                    <label for="openai-history" class="brxc-input__label" style="margin-left: auto;">History</label>
                </div>
                <div class="brxc-overlay__type-wrapper">
                    <div class="brxc-overlay__inner-1">
                        <div class="brxc-overlay__inner--overflow">
                            <label for="AISystem" class="brxc-input__label">Tone of voice <span class="brxc__light">(Optional)</span></label>
                            <div class="openai-tones">
                            <?php 
                            foreach($brxc_acf_fields['tone_of_voice'] as $tone){
                                $str = strtolower( preg_replace( '/\s+/', '-', $tone ) );
                            ?>
                                <input type="checkbox" id="openai-<?php echo $str;?>" name="openai-tones" class="brxc-input__checkbox" data-tone="<?php echo $str;?>">
                                <label for="openai-<?php echo $str;?>" class="brxc-input__label"><?php echo $tone;?></label>
                            <?php
                            }
                            ?>
                                <input type="checkbox" id="openai-custom" name="openai-tones" class="brxc-input__checkbox" onChange="ADMINBRXC.toggleCustomToneVoice(false, this);" data-tone="custom">
                                <label for="openai-custom" class="brxc-input__label">Custom</label>
                            </div>
                            <div class="brxc__text">
                                <input type="text" name="AISystem" id="AISystem" class="brxc-input__range" placeholder="Type here any additional information on the System context." style="display: none">
                            </div>
                            <div class="brxc-prompt-options-wrapper">
                            <div class="brxc-prompt-option">
                                    <label for="AIChoices" class="brxc-input__label"><span>Num Choices</span><div data-balloon="How many chat completion choices to generate for each input message." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></label>
                                    <div class="brxc__range">
                                        <input type="range" min="1" max="5" step="1" value="1" name="AIChoices" id="AIChoices" class="brxc-input__range" oninput="document.querySelector('#AIChoicesValue').innerHTML = parseInt(event.target.value).toFixed(0)">
                                        <span id="AIChoicesValue">1</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="AIMaxTokens" class="brxc-input__label"><span>Max Tokens per input</span><div data-balloon="The maximum number of tokens to generate in the completion. The token count of your prompt plus max_tokens cannot exceed the model's context length (4096)." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></label>
                                    <div class="brxc__range">
                                        <input type="range" min="0" max="4096" step="1" value="100" name="AIMaxTokens" id="AIMaxTokens" class="brxc-input__range" oninput="document.querySelector('#AIMaxTokensValue').innerHTML = parseInt(event.target.value).toFixed(0)">
                                        <span id="AIMaxTokensValue">100</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="AITemperature" class="brxc-input__label"><span>Temperature</span><div data-balloon="What sampling temperature to use, between 0 and 2. Higher values like 0.8 will make the output more random, while lower values like 0.2 will make it more focused and deterministic. It's recommended altering this or top probability but not both." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></label>
                                    <div class="brxc__range">
                                        <input type="range" min="0" max="2" step="0.1" value="1" name="AITemperature" id="AITemperature" class="brxc-input__range" oninput="document.querySelector('#AITemperatureValue').innerHTML = parseFloat(event.target.value).toFixed(1)">
                                        <span id="AITemperatureValue">1</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="AITopP" class="brxc-input__label"><span>Top Probability</span><div data-balloon="An alternative to sampling with temperature, called nucleus sampling, where the model considers the results of the tokens with top_p probability mass. So 0.1 means only the tokens comprising the top 10% probability mass are considered. It's recommended altering this or temperature but not both." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></label>
                                    <div class="brxc__range">
                                        <input type="range" min="0.01" max="1" step="0.01" value="1" name="AITopP" id="AITopP" class="brxc-input__range" oninput="document.querySelector('#AITopPValue').innerHTML = parseFloat(event.target.value).toFixed(2)">
                                        <span id="AITopPValue">1</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="AIPresence" class="brxc-input__label"><span>Presence Penalty</span><div data-balloon="Number between -2.0 and 2.0. Positive values penalize new tokens based on whether they appear in the text so far, increasing the model's likelihood to talk about new topics." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></span></label>
                                    <div class="brxc__range">
                                        <input type="range" min="-2" max="2" step="0.1" value="0" name="AIPresence" id="AIPresence" class="brxc-input__range" oninput="document.querySelector('#AIPresenceValue').innerHTML = parseFloat(event.target.value).toFixed(1)">
                                        <span id="AIPresenceValue">0</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="AIFrequency" class="brxc-input__label"><span>Frequency Penalty</span><div data-balloon="Number between -2.0 and 2.0. Positive values penalize new tokens based on their existing frequency in the text so far, decreasing the model's likelihood to repeat the same line verbatim." data-balloon-pos="top" data-balloon-length="large"><i class="fas fa-circle-question"></i></div></label>
                                    <div class="brxc__range">
                                        <input type="range" min="-2" max="2" step="0.1" value="0" name="AIFrequency" id="AIFrequency" class="brxc-input__range" oninput="document.querySelector('#AIFrequencyValue').innerHTML = parseFloat(event.target.value).toFixed(1)">
                                        <span id="AIFrequencyValue">0</span>
                                    </div>
                                </div>
                            </div>
                            <label for="openAIPromptText" class="brxc-input__label">User Prompt <span class="brxc__light">(Required)</span></label>
                            <textarea name="openAI-prompt-text" id="openAIPromptText" class="openAI-prompt-text message user" placeholder="Type your prompt text here..." cols="30" rows="3"></textarea>
                            <div class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelector('#brxcopenAIOverlay #openAIPromptText').value = '';let removes = document.querySelectorAll('#brxcopenAIOverlay .brxc-overlay__inner-1 .remove-on-reset');removes.forEach(el => {el.remove()});"><span>Reset</span></div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onclick="ADMINBRXC.getAIResponse(this,false,'#brxcopenAIOverlay', document.querySelectorAll('#brxcopenAIOverlay input[name=openai-tones]:checked'), document.querySelector('#brxcopenAIOverlay #AISystem').value, parseFloat(document.querySelector('#AITemperature').value).toFixed(1), parseInt(document.querySelector('#AIMaxTokens').value), parseInt(document.querySelector('#AIChoices').value), parseFloat(document.querySelector('#AITopP').value).toFixed(2), parseFloat(document.querySelector('#AIPresence').value).toFixed(1), parseFloat(document.querySelector('#AIFrequency').value).toFixed(1));"><span>Generate Content</span></div>
                            </div>
                            <div id="brxcInsertContentWrapper" class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelector('#brxcopenAIOverlay #openAIPromptText').value = '';let removes = document.querySelectorAll('#brxcopenAIOverlay .brxc-overlay__inner-1 .remove-on-reset');removes.forEach(el => {el.remove()});">
                                    <span>Reset</span>
                                </div>
                                <div id="openAIChatMore" class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="ADMINBRXC.chatMoreAIResponse(false, '#brxcopenAIOverlay')">
                                    <span>Chat More</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="brxc-overlay__inner-2">
                        <div class="brxc-overlay__inner--overflow">
                            <label for="openAIEditText" class="brxc-input__label">User Prompt <span class="brxc__light">(Required)</span></label>
                            <textarea name="openAI-prompt-text" id="openAIEditText" class="openAI-prompt-text message input" placeholder="Type your prompt text here..." cols="30" rows="3"></textarea>
                            <div class="brxc-prompt-options-wrapper">
                                <div class="brxc-prompt-option">
                                    <label for="AIEditTemperature" class="brxc-input__label">Temperature</label>
                                    <div class="brxc__range">
                                        <input type="range" min="0" max="2" step="0.1" value="1" name="AIEditTemperature" id="AIEditTemperature" class="brxc-input__range" oninput="document.querySelector('#AIEditTemperatureValue').innerHTML = parseFloat(event.target.value).toFixed(1)">
                                        <span id="AIEditTemperatureValue">1</span>
                                    </div>
                                </div>
                                <div class="brxc-prompt-option">
                                    <label for="AIEditChoices" class="brxc-input__label">Num Choices</label>
                                    <div class="brxc__range">
                                        <input type="range" min="1" max="5" step="1" value="1" name="AIEditChoices" id="AIEditChoices" class="brxc-input__range" oninput="document.querySelector('#AIEditChoicesValue').innerHTML = parseInt(event.target.value).toFixed(0)">
                                        <span id="AIEditChoicesValue">1</span>
                                    </div>
                                </div>
                            </div>
                            <label for="openAIEditInstruction" class="brxc-input__label">Instructions <span class="brxc__light">(Required)</span></label>
                            <textarea name="openAI-prompt-text" id="openAIEditInstruction" class="openAI-prompt-text message instruction" placeholder="Type your instructions here..." cols="30" rows="3"></textarea>
                            <div class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelectorAll('#brxcopenAIOverlay .brxc-overlay__inner-2 .message').forEach(el => el.value = '');let removes = document.querySelectorAll('#brxcopenAIOverlay .brxc-overlay__inner-2 .remove-on-reset');removes.forEach(el => {el.remove()});">
                                    <span>Reset</span>
                                </div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onclick="ADMINBRXC.getEditAIResponse(this,false, '#brxcopenAIOverlay', parseFloat(document.querySelector('#AIEditTemperature').value), parseInt(document.querySelector('#AIEditChoices').value));">
                                    <span>Generate Edit</span>
                                </div>
                            </div>
                            <div id="brxcInsertEditContentWrapper" class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelectorAll('#brxcopenAIOverlay .brxc-overlay__inner-2 .message').forEach(el => el.value = '');let removes = document.querySelectorAll('#brxcopenAIOverlay .brxc-overlay__inner-2 .remove-on-reset');removes.forEach(el => {el.remove()});">
                                    <span>Reset</span>
                                </div>
                            </div>
                    </div>
                    </div>
                    <div class="brxc-overlay__inner-3">
                        <div class="brxc-overlay__inner--overflow">
                            <div id="brxcOpenAIHistory" class="brxc-ai-response-wrapper brxc-canvas"></div>
                            <div id="brxcInsertHistoryContentWrapper" class="brxc-overlay-btn-wrapper">
                                <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="document.querySelector('#brxcOpenAIHistory').innerHTML = '<p class=\'brxc__no-record\'>No records yet. Please come back here after you generated some AI content.</p>';ADMINBRXC.aihistory = [];">
                                    <span>Reset</span>
                                </div>
                                <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onClick='ADMINBRXC.copytoClipboard(this,document.querySelector("#brxcopenAIOverlay input[name=openai-results]:checked + label .message.assistant").textContent, "Content Copied!", "Copy Selected to Clipboard");'>
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