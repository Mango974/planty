<?php

if (!defined('ABSPATH')) { die();
}

?>
<span>Compose your color scale</span>
<div id="colorsScale" class="scale-wrapper">
    <div class="color-wrapper brxc-modal__field generated-color-wrapper delete">
        <input type="color" value="#81d742" onInput="event.target.nextSibling.nextSibling.value = event.target.value;BRXC.scaleGenerateArray();">
        <input type="text" value="#81d742" onInput="event.target.previousSibling.previousSibling.value = event.target.value;BRXC.scaleGenerateArray();">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path red" onClick="event.target.closest('.generated-color-wrapper').remove();BRXC.scaleGenerateArray();"><path d="M13.05 42q-1.25 0-2.125-.875T10.05 39V10.5H8v-3h9.4V6h13.2v1.5H40v3h-2.05V39q0 1.2-.9 2.1-.9.9-2.1.9Zm21.9-31.5h-21.9V39h21.9Zm-16.6 24.2h3V14.75h-3Zm8.3 0h3V14.75h-3Zm-13.6-24.2V39Z"/></svg>
    </div>
    <div class="color-wrapper brxc-modal__field generated-color-wrapper delete">
        <input type="color" value="#1E73BE" onInput="event.target.nextSibling.nextSibling.value = event.target.value;BRXC.scaleGenerateArray();">
        <input type="text" value="#1E73BE" onInput="event.target.previousSibling.previousSibling.value = event.target.value;BRXC.scaleGenerateArray();">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path red" onClick="event.target.closest('.generated-color-wrapper').remove();BRXC.scaleGenerateArray();"><path d="M13.05 42q-1.25 0-2.125-.875T10.05 39V10.5H8v-3h9.4V6h13.2v1.5H40v3h-2.05V39q0 1.2-.9 2.1-.9.9-2.1.9Zm21.9-31.5h-21.9V39h21.9Zm-16.6 24.2h3V14.75h-3Zm8.3 0h3V14.75h-3Zm-13.6-24.2V39Z"/></svg>
    </div>
    <div id="ScaleAddColor" class="add-color">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path" onClick="BRXC.scaleGenerateArray();"><path d="M22.5 38V25.5H10v-3h12.5V10h3v12.5H38v3H25.5V38Z"/></svg>
    </div>
</div>
<div class="numcolors-wrapper">
    <span>Number of returned colors</span>
    <div class="brxc__range numcolors-range">
        <input type="range" name="numcolors" id="scaleNumColors" min="2" max="25" value="5" step="1" onInput="document.querySelector('#scaleNumValue').innerHTML = event.target.value;BRXC.scaleGenerateArray();">
        <span id="scaleNumValue">5</span>
    </div>
</div>
<span>Preview</span>
<div id="scalePreview" class="scale-preview"></div>
<span>Generated Color Scale</span>
<div id="scaleArrResult" class="scale-result"></div>
<span>Gradient Type</span>
<div class="switcher-wrapper">
    <fieldset class="radio-switch gradientType" onChange="BRXC.displayGradientDegree(event.target.dataset.value);BRXC.displayGradientPosition(event.target.dataset.value);BRXC.scaleGenerateArray();">	        
        <input type="radio" name="gradienttype" id="linear" data-value="linear" checked><label for="linear">Linear</label>
        <input type="radio" name="gradienttype" id="circle" data-value="circle"><label for="circle">Radial - Cirlce</label>
        <input type="radio" name="gradienttype" id="ellipse" data-value="ellipse"><label for="ellipse">Radial - Ellipse</label>
        <div class="highlight"></div>
    </fieldset>
</div>
<div class="switcher-wrapper gradientposition-wrapper">
    <span>Gradient Position</span>
    <fieldset class="radio-switch gradientPosition" onChange="BRXC.scaleGenerateArray();">	        
        <input type="radio" name="gradientposition" id="farthest-corner" data-value="farthest-corner" checked><label for="farthest-corner">farthest-corner</label>
        <input type="radio" name="gradientposition" id="closest-side" data-value="closest-side"><label for="closest-side">closest-side</label>
        <input type="radio" name="gradientposition" id="closest-corner" data-value="closest-corner"><label for="closest-corner">closest-corner</label>
        <input type="radio" name="gradientposition" id="farthest-side" data-value="farthest-side"><label for="farthest-side">farthest-side</label>
        <div class="highlight"></div>
    </fieldset>
</div>
<div class="gradientdegree-wrapper">
    <span>Gradient Degree</span>
    <div class="brxc__range gradientdegree-range">
        <input id="gradientDegree" type="range" name="gradientdegree" min="0" max="360" value="90" step="1" onInput="document.querySelector('#gradientDegreeValue').innerHTML = event.target.value + '°';BRXC.scaleGenerateArray();">
        <span id="gradientDegreeValue">90°</span>
    </div>
</div>
<span>CSS</span>
<pre class="scaleCode"><code id="scaleCssCode"></code></pre>