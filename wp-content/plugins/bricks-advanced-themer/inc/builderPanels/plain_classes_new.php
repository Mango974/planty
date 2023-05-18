<?php
if (!defined('ABSPATH')) { die();
}

/*--------------------------------------
Variables
--------------------------------------*/

// ID & Classes
$overlay_id = 'brxcPlainClassesOverlay';
$prefix_id = 'brxcPlainClasses';
$prefix_class = 'brxc-plain-classes';
// Heading
$modal_heading_title = 'Plain Classes';

?>
<!-- Main -->
<div id="<?php echo esc_attr($overlay_id);?>" class="brxc-overlay__wrapper" style="opacity:0" data-input-target="" onclick="ADMINBRXC.closeModal(event, this, '#<?php echo esc_attr($overlay_id);?>');" >
    <!-- Main Inner -->
    <div class="brxc-overlay__inner brxc-medium" style="max-height: 430px;">
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
                <!-- Modal Panels Wrapper -->
                <div class="brxc-overlay__pannels-wrapper">
                    <!-- Modal Panel -->
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-1">
                        <!-- Panel Content -->
                        <p class="brxc-overlay-css__desc">Update the classes in bulk. Seperate each different class by a space, without dot. Any deleted class from the list will be removed too.</p>
                        <textarea name="plain-classes" id="plainClassesInput" placeholder="Type your classes here..." cols="30" rows="10"></textarea>
                        <div class="brxc-overlay__action-btn-wrapper right m-top-16"> 
                            <div class="brxc-overlay__action-btn" onclick="ADMINBRXC.resetClasses(this)"><span>Reset Classes</span></div>
                            <div class="brxc-overlay__action-btn active" onclick="ADMINBRXC.savePlainClasses(this, document.querySelector('#<?php echo esc_attr($overlay_id); ?> .CodeMirror').CodeMirror.getValue(CodeMirror));"><span>Update Classes</span></div>
                        </div>
                        <!-- End of Panel Content -->
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