<?php
if (!defined('ABSPATH')) { die();
}
?>
<div id="brxcPlainClassesOverlay" class="brxc-overlay__wrapper" style="opacity:0" onclick="ADMINBRXC.closeModal(event, this, '#brxcPlainClassesOverlay');" >
    <div class="brxc-overlay__inner">
        <div class="brxc-overlay__close-btn" onClick="ADMINBRXC.closeModal(event, event.target, '#brxcPlainClassesOverlay')">
            <i class="bricks-svg ti-close"></i>
        </div>
        <div class="brxc-overlay__inner-wrapper">
            <div class="brxc-overlay__header">
                <h3 class="brxc-overlay__header-title">Plain Classes</h3>
            </div>
            <div class="brxc-overlay__container">
                <p class="brxc-overlay-css__desc">Update the classes in bulk. Seperate each different class by a space, without dot. Any deleted class from the list will be removed too.</p>
                <textarea name="plain-classes" id="plainClassesInput" placeholder="Type your classes here..." cols="30" rows="10"></textarea>
                <div class="brxc-overlay-btn-wrapper">
                    <div class="brxcCSSLabel brxc-overlay-btn__copy" style="width: fit-content;align-self: flex-end;" onclick="ADMINBRXC.resetClasses(this)"><span>Reset Classes</span></div>
                    <div class="brxcCSSLabel brxc-overlay-btn__copy active" style="width: fit-content;align-self: flex-end;" onclick="ADMINBRXC.savePlainClasses(this, document.querySelector('#brxcPlainClassesOverlay .CodeMirror').CodeMirror.getValue(CodeMirror));"><span>Update Classes</span></div>
                </div>
            </div>
        </div>
    </div>
</div>