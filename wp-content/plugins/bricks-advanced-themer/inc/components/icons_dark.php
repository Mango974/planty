<?php

if (!defined('ABSPATH')) { die();
}
?>
<div class="brxc-modal__icons">
    <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
    <label class="brxc-modal__reset" onClick="BRXC.resetSingleLabelandInput(event.target, true)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path orange"><path d="M22.55 41.9q-6.15-.5-10.35-5.05Q8 32.3 8 26.05q0-3.85 1.775-7.25t4.975-5.55l2.15 2.15q-2.8 1.65-4.35 4.525Q11 22.8 11 26.05q0 5 3.3 8.65 3.3 3.65 8.25 4.2Zm3 0v-3q5-.6 8.25-4.225 3.25-3.625 3.25-8.625 0-5.45-3.775-9.225Q29.5 13.05 24.05 13.05h-1l3 3-2.15 2.15-6.65-6.65L23.9 4.9l2.15 2.15-3 3h1q6.7 0 11.35 4.675 4.65 4.675 4.65 11.325 0 6.25-4.175 10.8Q31.7 41.4 25.55 41.9Z"/></svg></label>
    <label class="brxc-modal__delete" onClick="BRXC.deleteSingleLabelandInput(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path red"><path d="M13.05 42q-1.25 0-2.125-.875T10.05 39V10.5H8v-3h9.4V6h13.2v1.5H40v3h-2.05V39q0 1.2-.9 2.1-.9.9-2.1.9Zm21.9-31.5h-21.9V39h21.9Zm-16.6 24.2h3V14.75h-3Zm8.3 0h3V14.75h-3Zm-13.6-24.2V39Z"/></svg></label>
</div>