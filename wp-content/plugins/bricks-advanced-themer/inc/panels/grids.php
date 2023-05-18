<?php

if (!defined('ABSPATH')) { die();
}


if ( have_rows( 'field_63b48c6f1b20a', 'bricks-advanced-themer' ) ) :

    $index = 0;

    while ( have_rows( 'field_63b48c6f1b20a', 'bricks-advanced-themer' ) ) :

        the_row();

        $label = get_sub_field( 'field_63b48c6f1b20b', 'bricks-advanced-themer' );

        $max_col = get_sub_field( 'field_63b48c6f1b20c', 'bricks-advanced-themer' );

        $min_width = get_sub_field( 'field_63b48c6f1b20d', 'bricks-advanced-themer' );

        $gap = get_sub_field( 'field_63b48d7e1b20e', 'bricks-advanced-themer' );
    
        ?>
        <div class="isotope-wrapper">
            <span class="highlight-color"><?php echo esc_attr($label);?></span>
            <div class="brxc-modal__field two-icons brxc-grids">
                <div class="maxcol-wrapper">
                    <span>Maximum Columns</span>
                    <div class="brxc__range maxcol-range">
                        <input type="range" name="maxcol" id="maxCol<?php echo esc_attr($index);?>" min="0" max="12" value="<?php echo esc_attr($max_col);?>" step="1" data-initial-value="<?php echo esc_attr($max_col);?>" data-label="<?php echo esc_attr($label);?>" data-selector="--grid-column-count" data-unit="" onInput="document.querySelector('#maxColValue<?php echo esc_attr($index);?>').innerHTML = parseInt(event.target.value).toFixed(0);BRXC.setGridValue(event.target, event.target.dataset.label, event.target.dataset.selector,event.target.dataset.unit)">
                        <span id="maxColValue<?php echo esc_attr($index);?>"><?php echo esc_attr($max_col);?></span>
                        <label class="brxc-modal__reset"  onClick="document.querySelector('#maxCol<?php echo esc_attr($index);?>').value=<?php echo esc_attr($max_col);?>;document.querySelector('#maxColValue<?php echo esc_attr($index);?>').innerHTML = '<?php echo esc_attr($max_col);?>';BRXC.setGridValue(document.querySelector('#maxCol<?php echo esc_attr($index);?>'), document.querySelector('#maxCol<?php echo esc_attr($index);?>').dataset.label, document.querySelector('#maxCol<?php echo esc_attr($index);?>').dataset.selector,document.querySelector('#maxCol<?php echo esc_attr($index);?>').dataset.unit)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path orange"><path d="M22.55 41.9q-6.15-.5-10.35-5.05Q8 32.3 8 26.05q0-3.85 1.775-7.25t4.975-5.55l2.15 2.15q-2.8 1.65-4.35 4.525Q11 22.8 11 26.05q0 5 3.3 8.65 3.3 3.65 8.25 4.2Zm3 0v-3q5-.6 8.25-4.225 3.25-3.625 3.25-8.625 0-5.45-3.775-9.225Q29.5 13.05 24.05 13.05h-1l3 3-2.15 2.15-6.65-6.65L23.9 4.9l2.15 2.15-3 3h1q6.7 0 11.35 4.675 4.65 4.675 4.65 11.325 0 6.25-4.175 10.8Q31.7 41.4 25.55 41.9Z"/></svg></label>
                    </div>
                </div>
                <div class="mincolwidth-wrapper">
                    <span>Minimum Column Width</span>
                    <div class="brxc__range mincolwidth-range">
                        <input type="range" name="minColwidth" id="minColWidth<?php echo esc_attr($index);?>" min="0" max="400" value="<?php echo esc_attr($min_width);?>" step="1" data-initial-value="<?php echo esc_attr($min_width);?>" data-label="<?php echo esc_attr($label);?>" data-selector="--grid-item--min-width" data-unit="px" onInput="document.querySelector('#minColWidthValue<?php echo esc_attr($index);?>').innerHTML = parseInt(event.target.value).toFixed(0) + 'px';BRXC.setGridValue(event.target, event.target.dataset.label, event.target.dataset.selector,event.target.dataset.unit)">
                        <span id="minColWidthValue<?php echo esc_attr($index);?>"><?php echo esc_attr($min_width);?>px</span>
                        <label class="brxc-modal__reset" onClick="document.querySelector('#minColWidth<?php echo esc_attr($index);?>').value=<?php echo esc_attr($min_width);?>;document.querySelector('#minColWidthValue<?php echo esc_attr($index);?>').innerHTML = <?php echo esc_attr($min_width);?> + 'px';BRXC.setGridValue(document.querySelector('#minColWidth<?php echo esc_attr($index);?>'), document.querySelector('#minColWidth<?php echo esc_attr($index);?>').dataset.label, document.querySelector('#minColWidth<?php echo esc_attr($index);?>').dataset.selector,document.querySelector('#minColWidth<?php echo esc_attr($index);?>').dataset.unit)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path orange"><path d="M22.55 41.9q-6.15-.5-10.35-5.05Q8 32.3 8 26.05q0-3.85 1.775-7.25t4.975-5.55l2.15 2.15q-2.8 1.65-4.35 4.525Q11 22.8 11 26.05q0 5 3.3 8.65 3.3 3.65 8.25 4.2Zm3 0v-3q5-.6 8.25-4.225 3.25-3.625 3.25-8.625 0-5.45-3.775-9.225Q29.5 13.05 24.05 13.05h-1l3 3-2.15 2.15-6.65-6.65L23.9 4.9l2.15 2.15-3 3h1q6.7 0 11.35 4.675 4.65 4.675 4.65 11.325 0 6.25-4.175 10.8Q31.7 41.4 25.55 41.9Z"/></svg></label>
                    </div>
                </div>
                <span>Gap</span>
                <div class="brxc-modal__labels-typo">
                    <input type="text" id="gridGap<?php echo esc_attr($index);?>" value="<?php echo esc_attr($gap);?>" data-initial-value="<?php echo esc_attr($gap);?>" data-label="<?php echo esc_attr($label);?>" data-selector="--grid-layout-gap" data-unit="" onInput="BRXC.setGridValue(event.target, event.target.dataset.label, event.target.dataset.selector,event.target.dataset.unit)">
                    <div class="brxc-modal__icons">
                        <label class="brxc-modal__copy" onClick="BRXC.copyLabeltoClipboard(event.target);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path green"><path d="M9 43.95q-1.2 0-2.1-.9-.9-.9-.9-2.1V10.8h3v30.15h23.7v3Zm6-6q-1.2 0-2.1-.9-.9-.9-.9-2.1v-28q0-1.2.9-2.1.9-.9 2.1-.9h22q1.2 0 2.1.9.9.9.9 2.1v28q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h22v-28H15v28Zm0 0v-28 28Z"/></svg></label>
                        <label class="brxc-modal__reset" onClick="BRXC.resetTypography(event.target, false);BRXC.setGridValue(document.querySelector('#gridGap<?php echo esc_attr($index);?>'), document.querySelector('#gridGap<?php echo esc_attr($index);?>').dataset.label, document.querySelector('#gridGap<?php echo esc_attr($index);?>').dataset.selector,document.querySelector('#gridGap<?php echo esc_attr($index);?>').dataset.unit);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path orange"><path d="M22.55 41.9q-6.15-.5-10.35-5.05Q8 32.3 8 26.05q0-3.85 1.775-7.25t4.975-5.55l2.15 2.15q-2.8 1.65-4.35 4.525Q11 22.8 11 26.05q0 5 3.3 8.65 3.3 3.65 8.25 4.2Zm3 0v-3q5-.6 8.25-4.225 3.25-3.625 3.25-8.625 0-5.45-3.775-9.225Q29.5 13.05 24.05 13.05h-1l3 3-2.15 2.15-6.65-6.65L23.9 4.9l2.15 2.15-3 3h1q6.7 0 11.35 4.675 4.65 4.675 4.65 11.325 0 6.25-4.175 10.8Q31.7 41.4 25.55 41.9Z"/></svg></label>
                    </div>
                </div>
            </div>
        </div><?php

    $index++;

    endwhile;

else:

    echo '<div class="brxc-modal__no-colors"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M13.05 31.9q.6 0 1.05-.45.45-.45.45-1.05 0-.6-.45-1.05-.45-.45-1.05-.45-.6 0-1.05.45-.45.45-.45 1.05 0 .6.45 1.05.45.45 1.05.45Zm-1.5-6.5h3v-9.55h-3Zm8.95 4h15.95v-3H20.5Zm0-8.55h15.95v-3H20.5ZM6.6 40q-1.2 0-2.1-.9-.9-.9-.9-2.1V11q0-1.2.9-2.1.9-.9 2.1-.9h34.8q1.2 0 2.1.9.9.9.9 2.1v26q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h34.8V11H6.6v26Zm0 0V11v26Z"/></svg>No Grid Class has been found.</div>';

endif;