<?php

if (!defined('ABSPATH')) { die();
}
?>
<div class="brxc-modal__header">
    <div class="brxc-modal__btn-wrapper"> 
        <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs'])) :?>
        <div class="brxc-modal-darkmode__button">
            <label>
                <input class='toggle-checkbox' type='checkbox'></input>
                <div class='toggle-slot'>
                    <div class='sun-icon-wrapper'>
                        <div class="sun-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M24 31q2.9 0 4.95-2.05Q31 26.9 31 24q0-2.9-2.05-4.95Q26.9 17 24 17q-2.9 0-4.95 2.05Q17 21.1 17 24q0 2.9 2.05 4.95Q21.1 31 24 31Zm0 3q-4.15 0-7.075-2.925T14 24q0-4.15 2.925-7.075T24 14q4.15 0 7.075 2.925T34 24q0 4.15-2.925 7.075T24 34ZM3.5 25.5q-.65 0-1.075-.425Q2 24.65 2 24q0-.65.425-1.075Q2.85 22.5 3.5 22.5h5q.65 0 1.075.425Q10 23.35 10 24q0 .65-.425 1.075-.425.425-1.075.425Zm36 0q-.65 0-1.075-.425Q38 24.65 38 24q0-.65.425-1.075.425-.425 1.075-.425h5q.65 0 1.075.425Q46 23.35 46 24q0 .65-.425 1.075-.425.425-1.075.425ZM24 10q-.65 0-1.075-.425Q22.5 9.15 22.5 8.5v-5q0-.65.425-1.075Q23.35 2 24 2q.65 0 1.075.425.425.425.425 1.075v5q0 .65-.425 1.075Q24.65 10 24 10Zm0 36q-.65 0-1.075-.425-.425-.425-.425-1.075v-5q0-.65.425-1.075Q23.35 38 24 38q.65 0 1.075.425.425.425.425 1.075v5q0 .65-.425 1.075Q24.65 46 24 46ZM12 14.1l-2.85-2.8q-.45-.45-.425-1.075.025-.625.425-1.075.45-.45 1.075-.45t1.075.45L14.1 12q.4.45.4 1.05 0 .6-.4 1-.4.45-1.025.45-.625 0-1.075-.4Zm24.7 24.75L33.9 36q-.4-.45-.4-1.075t.45-1.025q.4-.45 1-.45t1.05.45l2.85 2.8q.45.45.425 1.075-.025.625-.425 1.075-.45.45-1.075.45t-1.075-.45ZM33.9 14.1q-.45-.45-.45-1.05 0-.6.45-1.05l2.8-2.85q.45-.45 1.075-.425.625.025 1.075.425.45.45.45 1.075t-.45 1.075L36 14.1q-.4.4-1.025.4-.625 0-1.075-.4ZM9.15 38.85q-.45-.45-.45-1.075t.45-1.075L12 33.9q.45-.45 1.05-.45.6 0 1.05.45.45.45.45 1.05 0 .6-.45 1.05l-2.8 2.85q-.45.45-1.075.425-.625-.025-1.075-.425ZM24 24Z"/></svg></div>
                    </div>
                    <div class='toggle-button'></div>
                    <div class='moon-icon-wrapper'>
                        <div class="moon-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M24 42q-7.5 0-12.75-5.25T6 24q0-7.5 5.25-12.75T24 6q.4 0 .85.025.45.025 1.15.075-1.8 1.6-2.8 3.95-1 2.35-1 4.95 0 4.5 3.15 7.65Q28.5 25.8 33 25.8q2.6 0 4.95-.925T41.9 22.3q.05.6.075.975Q42 23.65 42 24q0 7.5-5.25 12.75T24 42Zm0-3q5.45 0 9.5-3.375t5.05-7.925q-1.25.55-2.675.825Q34.45 28.8 33 28.8q-5.75 0-9.775-4.025T19.2 15q0-1.2.25-2.575.25-1.375.9-3.125-4.9 1.35-8.125 5.475Q9 18.9 9 24q0 6.25 4.375 10.625T24 39Zm-.2-14.85Z"/></svg></div>
                    </div>
                </div>
            </label>
        </div>
        <?php endif;?>
        <div class="brxc-modal__header-btn helpers">
            <div class="brxc-modal__header--btn brxc-panel brxc-modal__lab" data-transform="0" data-balloon="color lab" data-balloon-pos="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M8.6 42q-2.1 0-2.975-1.95T6.2 36.5l12.4-14V9H16q-.65 0-1.075-.425Q14.5 8.15 14.5 7.5q0-.65.425-1.075Q15.35 6 16 6h16q.65 0 1.075.425.425.425.425 1.075 0 .65-.425 1.075Q32.65 9 32 9h-2.6v13.5l12.4 14q1.45 1.6.575 3.55Q41.5 42 39.4 42ZM8 39h32L26.4 23.6V9h-4.8v14.6Zm15.9-15Z"/></svg>
            </div>
            <div class="brxc-modal__header--btn brxc-panel brxc-modal__convertor" data-transform="-1" data-balloon="color convertor" data-balloon-pos="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M8.35 40v-3h6.5l-.75-.6q-3.2-2.55-4.65-5.55-1.45-3-1.45-6.7 0-5.3 3.125-9.525Q14.25 10.4 19.35 8.8v3.1q-3.75 1.45-6.05 4.825T11 24.15q0 3.15 1.175 5.475 1.175 2.325 3.175 4.025l1.5 1.05v-6.2h3V40Zm20.35-.75V36.1q3.8-1.45 6.05-4.825T37 23.85q0-2.4-1.175-4.875T32.75 14.6l-1.45-1.3v6.2h-3V8h11.5v3h-6.55l.75.7q3 2.8 4.5 6t1.5 6.15q0 5.3-3.1 9.55-3.1 4.25-8.2 5.85Z"/></svg>
            </div>
            <div class="brxc-modal__header--btn brxc-panel brxc-modal__gradient" data-transform="-2" data-balloon="scale generator" data-balloon-pos="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M21.85 26.1v-4.3h4.25v4.3Zm-4.3 4.3v-4.3h4.3v4.3Zm8.55 0v-4.3h4.3v4.3Zm4.3-4.3v-4.3h4.3v4.3Zm-17.1 0v-4.3h4.25v4.3ZM9 42q-1.25 0-2.125-.875T6 39V9q0-1.25.875-2.125T9 6h30q1.25 0 2.125.875T42 9v30q0 1.25-.875 2.125T39 42Zm4.3-3h4.25v-4.3H13.3Zm8.55 0h4.25v-4.3h-4.25ZM39 39v-4.3ZM9 34.7h4.3v-4.3h4.25v4.3h4.3v-4.3h4.25v4.3h4.3v-4.3h4.3v4.3H39v-4.3h-4.3v-4.3H39V9H9v17.1h4.3v4.3H9ZM9 39V9v30Zm30-12.9v4.3-4.3Zm-8.6 8.6V39h4.3v-4.3Z"/></svg>
            </div>
            <div class="brxc-modal__header--btn brxc-panel brxc-modal__palette" data-transform="-3" data-balloon="palette generator" data-balloon-pos="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M24 44q-4.1 0-7.75-1.575-3.65-1.575-6.375-4.3-2.725-2.725-4.3-6.375Q4 28.1 4 24q0-4.25 1.6-7.9 1.6-3.65 4.375-6.35 2.775-2.7 6.5-4.225Q20.2 4 24.45 4q3.95 0 7.5 1.325T38.175 9q2.675 2.35 4.25 5.575Q44 17.8 44 21.65q0 5.4-3.15 8.525T32.5 33.3h-3.75q-.9 0-1.55.7t-.65 1.55q0 1.35.725 2.3.725.95.725 2.2 0 1.9-1.05 2.925T24 44Zm0-20Zm-11.65 1.3q1 0 1.75-.75t.75-1.75q0-1-.75-1.75t-1.75-.75q-1 0-1.75.75t-.75 1.75q0 1 .75 1.75t1.75.75Zm6.3-8.5q1 0 1.75-.75t.75-1.75q0-1-.75-1.75t-1.75-.75q-1 0-1.75.75t-.75 1.75q0 1 .75 1.75t1.75.75Zm10.7 0q1 0 1.75-.75t.75-1.75q0-1-.75-1.75t-1.75-.75q-1 0-1.75.75t-.75 1.75q0 1 .75 1.75t1.75.75Zm6.55 8.5q1 0 1.75-.75t.75-1.75q0-1-.75-1.75t-1.75-.75q-1 0-1.75.75t-.75 1.75q0 1 .75 1.75t1.75.75ZM24 41q.55 0 .775-.225.225-.225.225-.725 0-.7-.725-1.3-.725-.6-.725-2.65 0-2.3 1.5-4.05t3.8-1.75h3.65q3.8 0 6.15-2.225Q41 25.85 41 21.65q0-6.6-5-10.625T24.45 7q-7.3 0-12.375 4.925T7 24q0 7.05 4.975 12.025Q16.95 41 24 41Z"/></svg> 
            </div>
            <div class="brxc-modal__header--btn brxc-panel brxc-modal__popular" data-transform="-4" data-balloon="popular palettes" data-balloon-pos="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M11 28q0 3.15 1.425 5.925T16.4 38.55q-.2-.6-.3-1.225Q16 36.7 16 36.1q0-1.6.6-3t1.75-2.55L24 25l5.65 5.55q1.15 1.15 1.75 2.55.6 1.4.6 3 0 .6-.1 1.225-.1.625-.3 1.225 2.55-1.85 3.975-4.625Q37 31.15 37 28q0-2.7-1.15-5.275T32.55 18q-1.05.75-2.2 1.175-1.15.425-2.3.425-3.05 0-5.05-2.075T21 12.3v-1q-2.3 1.65-4.15 3.65-1.85 2-3.15 4.175-1.3 2.175-2 4.45Q11 25.85 11 28Zm13 1.2-3.55 3.5q-.7.7-1.075 1.55Q19 35.1 19 36.1q0 2.05 1.45 3.475Q21.9 41 24 41q2.1 0 3.55-1.425Q29 38.15 29 36.1q0-1-.375-1.85-.375-.85-1.075-1.55ZM24 6v6.6q0 1.7 1.175 2.85 1.175 1.15 2.875 1.15.9 0 1.675-.375T31.1 15.1L32 14q3.7 2.1 5.85 5.85Q40 23.6 40 28q0 6.7-4.65 11.35Q30.7 44 24 44q-6.7 0-11.35-4.65Q8 34.7 8 28q0-6.4 4.3-12.325Q16.6 9.75 24 6Z"/></svg>
            </div>
            <div class="brxc-modal__header--btn brxc-modal__contrast" data-balloon="contrast checker" data-balloon-pos="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M24 44q-4.15 0-7.8-1.575-3.65-1.575-6.35-4.275-2.7-2.7-4.275-6.35Q4 28.15 4 24t1.575-7.8Q7.15 12.55 9.85 9.85q2.7-2.7 6.35-4.275Q19.85 4 24 4t7.8 1.575q3.65 1.575 6.35 4.275 2.7 2.7 4.275 6.35Q44 19.85 44 24t-1.575 7.8q-1.575 3.65-4.275 6.35-2.7 2.7-6.35 4.275Q28.15 44 24 44Zm1-3q6.85-.5 11.425-5.3Q41 30.9 41 24q0-6.9-4.575-11.7Q31.85 7.5 25 7Z"/></svg>
            </div>
        </div>
        <div class="brxc-modal__header-btn action">
            <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs'])) :?>
            <div class="brxc-modal__header--btn brxc-modal__export" data-balloon="export" data-balloon-pos="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M11 46q-1.2 0-2.1-.9Q8 44.2 8 43V17.55q0-1.2.9-2.1.9-.9 2.1-.9h8.45v3H11V43h26V17.55h-8.55v-3H37q1.2 0 2.1.9.9.9.9 2.1V43q0 1.2-.9 2.1-.9.9-2.1.9Zm11.45-15.35V7.8l-4.4 4.4-2.15-2.15L23.95 2 32 10.05l-2.15 2.15-4.4-4.4v22.85Z"/></svg>
            </div>
            <?php endif;?>
            <div class="brxc-modal__header--btn brxc-modal__info" data-balloon="support" data-balloon-pos="bottom">
                <a href="https://advancedthemer.com/documentation/" target="_blank" noreferer>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M22.65 34h3V22h-3ZM24 18.3q.7 0 1.175-.45.475-.45.475-1.15t-.475-1.2Q24.7 15 24 15q-.7 0-1.175.5-.475.5-.475 1.2t.475 1.15q.475.45 1.175.45ZM24 44q-4.1 0-7.75-1.575-3.65-1.575-6.375-4.3-2.725-2.725-4.3-6.375Q4 28.1 4 23.95q0-4.1 1.575-7.75 1.575-3.65 4.3-6.35 2.725-2.7 6.375-4.275Q19.9 4 24.05 4q4.1 0 7.75 1.575 3.65 1.575 6.35 4.275 2.7 2.7 4.275 6.35Q44 19.85 44 24q0 4.1-1.575 7.75-1.575 3.65-4.275 6.375t-6.35 4.3Q28.15 44 24 44Zm.05-3q7.05 0 12-4.975T41 23.95q0-7.05-4.95-12T24 7q-7.05 0-12.025 4.95Q7 16.9 7 24q0 7.05 4.975 12.025Q16.95 41 24.05 41ZM24 24Z"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>
