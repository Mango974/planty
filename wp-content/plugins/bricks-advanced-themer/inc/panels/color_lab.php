<?php

if (!defined('ABSPATH')) { die();
}

?>
<div class="brxc-modal__field two-icons">
    <div class="brxc-modal__left-col">
        <input id="labColor" type="color" value="#81d742" data-initial-value="#81d742" onInput="document.querySelector('#labText').value = event.target.value;BRXC.labGenerateColor();">
    </div>
    <div class="brxc-modal__right-col">
        <span>Initial Color</span>
        <div class="brxc-modal__labels">
            <input id="labText" type="text" value="#81d742" onInput="document.querySelector('#labColor').value = event.target.value;BRXC.labGenerateColor();">
            <div class="brxc-modal__icons">
                <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                <label class="brxc-modal__reset" onClick="BRXC.resetLabelandInput(event.target, false);BRXC.labGenerateColor();"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path orange"><path d="M22.55 41.9q-6.15-.5-10.35-5.05Q8 32.3 8 26.05q0-3.85 1.775-7.25t4.975-5.55l2.15 2.15q-2.8 1.65-4.35 4.525Q11 22.8 11 26.05q0 5 3.3 8.65 3.3 3.65 8.25 4.2Zm3 0v-3q5-.6 8.25-4.225 3.25-3.625 3.25-8.625 0-5.45-3.775-9.225Q29.5 13.05 24.05 13.05h-1l3 3-2.15 2.15-6.65-6.65L23.9 4.9l2.15 2.15-3 3h1q6.7 0 11.35 4.675 4.65 4.675 4.65 11.325 0 6.25-4.175 10.8Q31.7 41.4 25.55 41.9Z"/></svg></label>
            </div>
        </div>
    </div>
</div>
<div class="brightness-wrapper">
    <span>Brightness</span>
    <div class="brxc__range brightness-range">
        <input type="range" name="brightness" id="brightness" min="0" max="2" value="1" step="0.01" onInput="document.querySelector('#brightnessValue').innerHTML = parseInt(event.target.value * 100).toFixed(0) + '%';BRXC.labGenerateColor();">
        <span id="brightnessValue">100%</span>
        <label class="brxc-modal__reset" onClick="document.querySelector('#brightness').value=1;document.querySelector('#brightnessValue').innerHTML = '100%';BRXC.labGenerateColor();"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path orange"><path d="M22.55 41.9q-6.15-.5-10.35-5.05Q8 32.3 8 26.05q0-3.85 1.775-7.25t4.975-5.55l2.15 2.15q-2.8 1.65-4.35 4.525Q11 22.8 11 26.05q0 5 3.3 8.65 3.3 3.65 8.25 4.2Zm3 0v-3q5-.6 8.25-4.225 3.25-3.625 3.25-8.625 0-5.45-3.775-9.225Q29.5 13.05 24.05 13.05h-1l3 3-2.15 2.15-6.65-6.65L23.9 4.9l2.15 2.15-3 3h1q6.7 0 11.35 4.675 4.65 4.675 4.65 11.325 0 6.25-4.175 10.8Q31.7 41.4 25.55 41.9Z"/></svg></label>
    </div>
</div>
<div class="saturation-wrapper">
    <span>Saturation</span>
    <div class="brxc__range saturation-range">
        <input type="range" name="saturation" id="saturation" min="0" max="2" value="1" step="0.01" onInput="document.querySelector('#saturationValue').innerHTML = parseInt(event.target.value * 100).toFixed(0) + '%';BRXC.labGenerateColor();">
        <span id="saturationValue">100%</span>
        <label class="brxc-modal__reset" onClick="document.querySelector('#saturation').value=1;document.querySelector('#saturationValue').innerHTML = '100%';BRXC.labGenerateColor();"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path orange"><path d="M22.55 41.9q-6.15-.5-10.35-5.05Q8 32.3 8 26.05q0-3.85 1.775-7.25t4.975-5.55l2.15 2.15q-2.8 1.65-4.35 4.525Q11 22.8 11 26.05q0 5 3.3 8.65 3.3 3.65 8.25 4.2Zm3 0v-3q5-.6 8.25-4.225 3.25-3.625 3.25-8.625 0-5.45-3.775-9.225Q29.5 13.05 24.05 13.05h-1l3 3-2.15 2.15-6.65-6.65L23.9 4.9l2.15 2.15-3 3h1q6.7 0 11.35 4.675 4.65 4.675 4.65 11.325 0 6.25-4.175 10.8Q31.7 41.4 25.55 41.9Z"/></svg></label>
    </div>
</div>
<div class="result1-wrapper">
    <div id="LabModifiedColor1" class="brxc-modal__field one-icons">
        <div class="brxc-modal__left-col">
            <input id="resultLabColor1" type="color" value="#81d742" data-initial-value="#81d742" disabled>
        </div>
        <div class="brxc-modal__right-col">
            <span>Modified Color Without Luminance</span>
            <div class="brxc-modal__labels">
                <input id="resultLabText1" type="text" value="#81d742" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="luminance-wrapper">
    <span>Luminance</span>
    <div class="brxc__range luminance-range">
        <input type="range" name="luminance" id="luminance" min="0" max="1" value="1" step="0.01" onInput="document.querySelector('#luminanceValue').innerHTML = parseInt(event.target.value * 100) + '%';BRXC.labGenerateColorLuminance();">
        <span id="luminanceValue">1</span>
    </div>
</div>
<div class="result2-wrapper">
    <div id="LabModifiedColor2" class="brxc-modal__field one-icons">
        <div class="brxc-modal__left-col">
            <input id="resultLabColor2" type="color" value="#81d742" data-initial-value="#81d742" onInput="document.querySelector('#labText').value = event.target.value;">
        </div>
        <div class="brxc-modal__right-col">
            <span>Modified Color With Luminance</span>
            <div class="brxc-modal__labels">
                <input id="resultLabText2" type="text" value="#81d742" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
</div>