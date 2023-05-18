<?php

if (!defined('ABSPATH')) { die();
}

?>
<div class="brxc-modal__field two-icons">
    <div class="brxc-modal__left-col">
        <input id="ConvertColor" type="color" value="#81d742" data-initial-value="#81d742" onInput="document.querySelector('#ConvertText').value = event.target.value;BRXC.convertHexColor(event.target.value);;">
    </div>
    <div class="brxc-modal__right-col">
        <span>Hex Color</span>
        <div class="brxc-modal__labels">
            <input id="ConvertText" type="text" value="#81d742" onInput="document.querySelector('#ConvertColor').value = event.target.value;BRXC.convertHexColor(event.target.value);">
            <div class="brxc-modal__icons">
                <label class="brxc-modal__copy" onClick="copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                <label class="brxc-modal__reset" onClick="resetLabelandInput(event.target, false);convertHexColor(document.querySelector('#ConvertColor').value);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path orange"><path d="M22.55 41.9q-6.15-.5-10.35-5.05Q8 32.3 8 26.05q0-3.85 1.775-7.25t4.975-5.55l2.15 2.15q-2.8 1.65-4.35 4.525Q11 22.8 11 26.05q0 5 3.3 8.65 3.3 3.65 8.25 4.2Zm3 0v-3q5-.6 8.25-4.225 3.25-3.625 3.25-8.625 0-5.45-3.775-9.225Q29.5 13.05 24.05 13.05h-1l3 3-2.15 2.15-6.65-6.65L23.9 4.9l2.15 2.15-3 3h1q6.7 0 11.35 4.675 4.65 4.675 4.65 11.325 0 6.25-4.175 10.8Q31.7 41.4 25.55 41.9Z"/></svg></label>
            </div>
        </div>
    </div>
</div>
<div class="brxc__converted-wrapper">
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>RGB</span>
            <div class="brxc-modal__labels">
                <input id="rgbConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>RGBA</span>
            <div class="brxc-modal__labels">
                <input id="rgbaConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>HSL</span>
            <div class="brxc-modal__labels">
                <input id="hslConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>HSLA</span>
            <div class="brxc-modal__labels">
                <input id="hslaConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>HSV</span>
            <div class="brxc-modal__labels">
                <input id="hsvConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>HSI</span>
            <div class="brxc-modal__labels">
                <input id="hsiConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>LAB</span>
            <div class="brxc-modal__labels">
                <input id="labConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>OKLAB</span>
            <div class="brxc-modal__labels">
                <input id="oklabConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>LCH</span>
            <div class="brxc-modal__labels">
                <input id="lchConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>HCL</span>
            <div class="brxc-modal__labels">
                <input id="hclConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>OKLCH</span>
            <div class="brxc-modal__labels">
                <input id="oklchConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
    <div class="brxc-modal__field one-icons">
        <div class="brxc-modal__right-col">
            <span>GL</span>
            <div class="brxc-modal__labels">
                <input id="glConvertText" type="text" value="#81d742" onInput="" disabled>
                <div class="brxc-modal__icons">
                    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                </div>
            </div>
        </div>
    </div>
</div>