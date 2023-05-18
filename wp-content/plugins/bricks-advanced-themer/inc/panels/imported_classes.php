<?php

if (!defined('ABSPATH')) { die();
}


if ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :

    $index = 0;

    while ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :

        the_row();

        $label = get_sub_field( 'field_63b4bd5c16ac3', 'bricks-advanced-themer' );

        $version = get_sub_field( 'field_63b4bd5c16ac4', 'bricks-advanced-themer' );

        $file = get_sub_field( 'field_63b4bdf216ac7', 'bricks-advanced-themer' );

        $classes = Advanced_Themer_Bricks\AT__Class_Importer::extract_selectors_from_css( $file );
    
        ?>
        <div class="brxc-modal__field brxc-classes isotope-wrapper">
            <span class="label highlight-color"><?php echo esc_attr($label); echo ($version) ? ' <span class="css-version">(' . $version . ')</span>': '';?></span>
            <span class="label">Imported Classes</span>
            <div class="class-button-wrapper">
                <?php
                    foreach( $classes as $class ) {
                        echo '<a class="class-button" data-class="' . $class . '" onClick="BRXC.activeClassHighlight(event.target);">' . $class . '</a>';
                    }
                ?>
            </div>
            <span class="label">Css File</span>
            <pre class="imported-classes-code" contenteditable="true"><code id="importedClassesCode<?php echo esc_attr($index);?>" class="language-css"><?php echo esc_html(file_get_contents($file));?></code></pre>
        </div>
        <?php

        $index++;

    endwhile;

else:

    echo '<div class="brxc-modal__no-colors"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M13.05 31.9q.6 0 1.05-.45.45-.45.45-1.05 0-.6-.45-1.05-.45-.45-1.05-.45-.6 0-1.05.45-.45.45-.45 1.05 0 .6.45 1.05.45.45 1.05.45Zm-1.5-6.5h3v-9.55h-3Zm8.95 4h15.95v-3H20.5Zm0-8.55h15.95v-3H20.5ZM6.6 40q-1.2 0-2.1-.9-.9-.9-.9-2.1V11q0-1.2.9-2.1.9-.9 2.1-.9h34.8q1.2 0 2.1.9.9.9.9 2.1v26q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h34.8V11H6.6v26Zm0 0V11v26Z"/></svg>No Imported CSS file has been found.</div>';

endif;