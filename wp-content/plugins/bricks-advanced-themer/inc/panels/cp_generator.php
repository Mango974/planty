<?php

if (!defined('ABSPATH')) { die();
}

?>
<div class="brxc-modal__field two-icons">
    <div class="brxc-modal__left-col">
        <input id="baseColor" type="color" value="#81d742" data-initial-value="#81d742" onInput="BRXC.setHex(event.target.value);document.querySelector('#baseText').value = event.target.value;">
    </div>
    <div class="brxc-modal__right-col">
        <span>Base Color</span>
        <div class="brxc-modal__labels">
            <input id="baseText" type="text" value="#81d742" onInput="BRXC.setHex(event.target.value);document.querySelector('#baseColor').value = event.target.value;">
            <div class="brxc-modal__icons">
                <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                <label class="brxc-modal__reset" onClick="BRXC.resetLabelandInput(event.target, false);BRXC.setHex(document.querySelector('#baseColor').value);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path orange"><path d="M22.55 41.9q-6.15-.5-10.35-5.05Q8 32.3 8 26.05q0-3.85 1.775-7.25t4.975-5.55l2.15 2.15q-2.8 1.65-4.35 4.525Q11 22.8 11 26.05q0 5 3.3 8.65 3.3 3.65 8.25 4.2Zm3 0v-3q5-.6 8.25-4.225 3.25-3.625 3.25-8.625 0-5.45-3.775-9.225Q29.5 13.05 24.05 13.05h-1l3 3-2.15 2.15-6.65-6.65L23.9 4.9l2.15 2.15-3 3h1q6.7 0 11.35 4.675 4.65 4.675 4.65 11.325 0 6.25-4.175 10.8Q31.7 41.4 25.55 41.9Z"/></svg></label>
            </div>
        </div>
    </div>
</div>
<span>Scheme</span>
<div class="switcher-wrapper">
    <fieldset class="radio-switch scheme" onChange="BRXC.setScheme(event.target.dataset.value);BRXC.displayDistance(event.target.dataset.value);">	        
        <input type="radio" name="scheme" id="monochromatic" data-value="monochromatic" checked><label for="monochromatic">Mono</label>
        <input type="radio" name="scheme" id="contrast" data-value="contrast"><label for="contrast">Contrast</label>
        <input type="radio" name="scheme" id="triade" data-value="triade"><label for="triade">Triade</label>
        <input type="radio" name="scheme" id="tetrade" data-value="tetrade"><label for="tetrade">Tetrade</label>
        <input type="radio" name="scheme" id="analogic" data-value="analogic"><label for="analogic">Analogic</label>
        <div class="highlight"></div>
    </fieldset>
</div>
<span>Variation</span>
<div class="switcher-wrapper">
    <fieldset class="radio-switch variation" onChange="BRXC.setVariation(event.target.dataset.value)">	        
        <input type="radio" name="variation" id="default" data-value="default" checked><label for="default">Default</label>
        <input type="radio" name="variation" id="pastel" data-value="pastel"><label for="pastel">Pastel</label>
        <input type="radio" name="variation" id="soft" data-value="soft"><label for="soft">Soft</label>
        <input type="radio" name="variation" id="light" data-value="light"><label for="light">light</label>
        <input type="radio" name="variation" id="hard" data-value="hard"><label for="hard">Hard</label>
        <input type="radio" name="variation" id="pale" data-value="pale"><label for="pale">Pale</label>
        <div class="highlight"></div>
    </fieldset>
</div>
<div class="distance-wrapper">
    <span>Distance</span>
    <div class="brxc__range distance-range">
    <input type="range" name="distance" id="distance" min="0" max="1" value="0.5" step="0.01" onInput="BRXC.setDistance(event.target.value);document.querySelector('#rangeValue').innerHTML = event.target.value">
    <span id="rangeValue">0.5</span>
    </div>
</div>
<div class="result-wrapper">
    <span>Color Palette</span>
    <div id="result" class="result"></div>
</div>