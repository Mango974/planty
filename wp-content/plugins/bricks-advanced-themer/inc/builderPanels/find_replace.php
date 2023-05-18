<?php
if (!defined('ABSPATH')) { die();
}

/*--------------------------------------
Variables
--------------------------------------*/

// ID & Classes
$overlay_id = 'brxcFindReplaceModal';
$prefix = 'brxc-findreplace';
// Heading
$modal_heading_title = 'Find & Replace Styles';

?>
<!-- Main -->
<div id="<?php echo esc_attr($overlay_id);?>" class="brxc-overlay__wrapper" style="opacity:0" data-input-target="" onclick="ADMINBRXC.closeModal(event, this, '#<?php echo esc_attr($overlay_id);?>');" >
    <!-- Main Inner -->
    <div class="brxc-overlay__inner brxc-medium" style="max-height: 790px;">
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
            <!-- Modal Container -->
            <div class="brxc-overlay__container">
                <!-- Modal Panels Wrapper -->
                <div class="brxc-overlay__pannels-wrapper">
                    <!-- Modal Panel -->
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-1">
                        <!-- Panel Content -->
                        <label class="has-tooltip">
                            <span>I want to replace this value:</span>
                            <div data-balloon="Write here the value that you want to replace." data-balloon-pos="bottom" data-balloon-length="medium"><i class="fas fa-circle-question"></i></div>
                        </label>
                        <div class="brxc__text">
                            <input type="text" name="<?php echo esc_attr($prefix);?>Search" id="<?php echo esc_attr($prefix);?>Search" placeholder="Type here the search value">
                        </div>
                        <label class="has-tooltip">
                            <span>With this value:</span>
                            <div data-balloon="Write here the value that will be replacing the search value" data-balloon-pos="bottom" data-balloon-length="medium"><i class="fas fa-circle-question"></i></div>
                        </label>
                        <div class="brxc__text">
                            <input type="text" name="<?php echo esc_attr($prefix);?>Replace" id="<?php echo esc_attr($prefix);?>Replace" placeholder="Type here the replace value">
                        </div>
                        <label class="has-tooltip">
                            <span>Inside the following CSS property</span>
                            <div data-balloon="Select the specific CSS property you want to target. Select 'All Properties' to target any property." data-balloon-pos="bottom" data-balloon-length="medium"><i class="fas fa-circle-question"></i></div>
                        </label>
                        <div class="brxc-select">
                            <select name="<?php echo esc_attr($prefix);?>propertyOptions" id="<?php echo esc_attr($prefix);?>propertyOptions" class="brxc-propertyOptions">
                                <option value="all">All Properties</option>
                            </select>
                        </div>
                        <label class="has-tooltip">
                            <span>To the following elements category</span>
                            <div data-balloon="Select the element's category you want to target. Select 'All Categories' to target any category." data-balloon-pos="bottom" data-balloon-length="medium"><i class="fas fa-circle-question"></i></div>
                        </label>
                        <div class="brxc-select">
                            <select name="<?php echo esc_attr($prefix);?>categoryOptions" id="<?php echo esc_attr($prefix);?>categoryOptions" class="brxc-categoryOptions">
                                <option value="all">All Categories</option>
                            </select>
                        </div>
                        <label class="has-tooltip">
                            <span>That are positioned:</span>
                            <div data-balloon="Target the elements based on where they are positioned inside the DOM." data-balloon-pos="bottom" data-balloon-length="medium"><i class="fas fa-circle-question"></i></div>
                        </label>
                        <p class="alert">The global Find & Replace function is targeting the whole page by default. Open Find & Replace inside an element to target specific positions inside the DOM.</p>
                        <div class="brxc-overlay__panel-inline-btns-wrapper m-bottom-24">
                            <input type="radio" id="<?php echo esc_attr($prefix);?>-siblings" name="<?php echo esc_attr($prefix);?>Position" class="brxc-input__checkbox" value="siblings" checked>
                            <label for="<?php echo esc_attr($prefix);?>-siblings" class="brxc-overlay__panel-inline-btns">On the same DOM level (Siblings)</label>
                            <input type="radio" id="<?php echo esc_attr($prefix);?>-div" name="<?php echo esc_attr($prefix);?>Position" class="brxc-input__checkbox" value="div">
                            <label for="<?php echo esc_attr($prefix);?>-div" class="brxc-overlay__panel-inline-btns">Inside the same parent's DIV</label>
                            <input type="radio" id="<?php echo esc_attr($prefix);?>-block" name="<?php echo esc_attr($prefix);?>Position" class="brxc-input__checkbox" value="block">
                            <label for="<?php echo esc_attr($prefix);?>-block" class="brxc-overlay__panel-inline-btns">Inside the same parent's Block</label>
                            <input type="radio" id="<?php echo esc_attr($prefix);?>-container" name="<?php echo esc_attr($prefix);?>Position" class="brxc-input__checkbox" value="container">
                            <label for="<?php echo esc_attr($prefix);?>-container" class="brxc-overlay__panel-inline-btns">Inside the same parent's Container</label>
                            <input type="radio" id="<?php echo esc_attr($prefix);?>-section" name="<?php echo esc_attr($prefix);?>Position" class="brxc-input__checkbox" value="section">
                            <label for="<?php echo esc_attr($prefix);?>-section" class="brxc-overlay__panel-inline-btns">Inside the same parent's Section</label>
                            <input type="radio" id="<?php echo esc_attr($prefix);?>-page" name="<?php echo esc_attr($prefix);?>Position" class="brxc-input__checkbox" value="page">
                            <label for="<?php echo esc_attr($prefix);?>-page" class="brxc-overlay__panel-inline-btns">On the whole Page</label>
                        </div>
                        <div id="<?php echo esc_attr($prefix);?>ExtendWrapper" class="brxc-overlay__action-btn-wrapper right m-top-16 action-wrapper">
                            <div id="<?php echo esc_attr($prefix);?>ChatMore" class="brxc-overlay__action-btn" onClick="ADMINBRXC.closeModal(event, event.target, '#<?php echo esc_attr($overlay_id);?>')">
                                <span>Cancel</span>
                            </div>
                            <div class="brxc-overlay__action-btn primary" onClick='ADMINBRXC.findAndReplace(document.querySelector("#<?php echo esc_attr($overlay_id);?> input[name=<?php echo esc_attr($prefix);?>Search]").value, document.querySelector("#<?php echo esc_attr($overlay_id);?> input[name=<?php echo esc_attr($prefix);?>Replace]").value, document.querySelector("#<?php echo esc_attr($prefix);?>propertyOptions"), document.querySelector("#<?php echo esc_attr($prefix);?>categoryOptions"), document.querySelector("#<?php echo esc_attr($overlay_id);?> input[name=<?php echo esc_attr($prefix);?>Position]:checked").value);ADMINBRXC.closeModal(event, event.target, "#<?php echo esc_attr($overlay_id);?>");'>
                                <span>Find & Replace</span>
                            </div>
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