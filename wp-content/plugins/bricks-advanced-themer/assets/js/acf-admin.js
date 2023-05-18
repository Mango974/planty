
function downloadObjectAsJson(exportObj, exportName){
    var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(exportObj));
    var downloadElement = document.createElement('a');
    downloadElement.setAttribute("href", dataStr);
    downloadElement.setAttribute("download", exportName);
    downloadElement.style.display = 'none';
    document.body.appendChild(downloadElement)
    downloadElement.click();
    document.body.removeChild(downloadElement);
}
/*
jQuery(document).ready(function($){

    $('.wrap.acf-settings-wrap h1').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: exportOptions.ajax_url, 
            method: "POST",
            dataType: "JSON",
            data: {
                action: "export_advanced_options",
                nonce: exportOptions.nonce 
            },
            success: function(data) {
                if (Object.keys(data).length > 0) {
                    downloadObjectAsJson(data, 'export_at_theme_settings.json');
                } else {
                    console.log('No AT data found');
                }
            },
            error: function() {
                console.log("Error fetching data from wp_options table");
            }
        });
    });

    $('#import-json-form').on('submit', function(e) {
        e.preventDefault();
        
        var file = $('#import-json-file')[0].files[0];
        var formData = new FormData();
        formData.append('action', 'import_json_data');
        formData.append('file', file);
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.data);
                }
            }
        });
    });
})
*/

window.addEventListener('DOMContentLoaded', () => {
    //open tab with URL hash

    const url = new URL(window.location.href); 
    const anchorID = url.hash.substring(1);
    const link = document.querySelector(`[data-key="${anchorID}"]`); 
    if (link) link.click();
});

window.addEventListener('load', () => {
    const adminOption = document.querySelector('#acf-field_6388e73289b6a-administrator');
    if (!adminOption) return;
    adminOption.setAttribute('disabled','');
    adminOption.setAttribute('checked','');

    //Clamp builder
    const clampBuilder = (baseFont, minWidthPx, maxWidthPx, minFontSize, maxFontSize) => {
 
        const minWidth = minWidthPx / baseFont;
        const maxWidth = maxWidthPx / baseFont;
     
        const slope = (maxFontSize - minFontSize) / (maxWidth - minWidth);
        const yAxisIntersection = -minWidth * slope + minFontSize;
     
        return `clamp( ${ minFontSize / baseFont  }rem, ${ yAxisIntersection / baseFont  }rem + ${ slope / baseFont * 100 }vw, ${ maxFontSize / baseFont }rem )`;
     }

     // Typography
    const setClampValue =  (minFont, maxFont, target, type) => {
        if (type === 'font-size'){
            target.style.fontSize = clampBuilder(parseInt(baseFont.value), parseInt(minViewport.value), parseInt(maxViewport.value), parseInt(minFont), parseFloat(maxFont));
        } else if (type === 'spacing'){
            target.style.gap = clampBuilder(parseInt(baseFont.value), parseInt(minViewport.value), parseInt(maxViewport.value), parseInt(minFont), parseFloat(maxFont));
        } else if (type === 'border'){
            target.style.borderRadius = clampBuilder(parseInt(baseFont.value), parseInt(minViewport.value), parseInt(maxViewport.value), parseInt(minFont), parseFloat(maxFont));
        }
        
    }

    //Const

    let typeRepeaterRows = document.querySelectorAll('.acf-field-repeater.typography-repeater .acf-row:not(.acf-clone)');
    const typeAddRow = document.querySelector('.acf-field-repeater.typography-repeater .acf-actions > a[data-event="add-row"]');
    let spaceRepeaterRows = document.querySelectorAll('.acf-field-repeater.spacing-repeater .acf-row:not(.acf-clone)');
    const spaceAddRow = document.querySelector('.acf-field-repeater.spacing-repeater .acf-actions > a[data-event="add-row"]');
    let borderRepeaterRows = document.querySelectorAll('.acf-field-repeater.border-repeater .acf-row:not(.acf-clone)');
    const borderAddRow = document.querySelector('.acf-field-repeater.border-repeater .acf-actions > a[data-event="add-row"]');

    //On Load
    let baseFont = document.querySelector('.base-font input[type="number"]');
    let minViewport = document.querySelector('.min-viewport input[type="number"]');
    let maxViewport = document.querySelector('.max-viewport input[type="number"]');

    if (typeRepeaterRows.length > 0) {
        typeRepeaterRows.forEach( row =>{
            const minValueInput = row.querySelector('.min-value input[type="number"]');
            const maxValueInput = row.querySelector('.max-value input[type="number"]');
            const preview = row.querySelector('.typography-preview');
            setClampValue(minValueInput.value, maxValueInput.value, preview, 'font-size');
            ['input','change'].forEach( event => {
                minValueInput.addEventListener(event, () => {
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.typography-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'font-size');
                })
            });
            ['input','change'].forEach( event => {
                maxValueInput.addEventListener(event, () => {
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.typography-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'font-size');
                })
            })
        });
    }

    if (spaceRepeaterRows.length > 0) {
        spaceRepeaterRows.forEach( row =>{
            const minValueInput = row.querySelector('.min-value input[type="number"]');
            const maxValueInput = row.querySelector('.max-value input[type="number"]');
            const preview = row.querySelector('.spacing-preview');
            setClampValue(minValueInput.value, maxValueInput.value, preview, 'spacing');
            ['input','change'].forEach( event => {
                minValueInput.addEventListener(event, () => {
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.spacing-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'spacing');
                })
            });
            ['input','change'].forEach( event => {
                maxValueInput.addEventListener(event, () => {
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.spacing-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'spacing');
                })
            })
        });
    }

    if (borderRepeaterRows.length > 0) {
        borderRepeaterRows.forEach( row =>{
            const minValueInput = row.querySelector('.min-value input[type="number"]');
            const maxValueInput = row.querySelector('.max-value input[type="number"]');
            const preview = row.querySelector('.border-preview');
            setClampValue(minValueInput.value, maxValueInput.value, preview, 'border');
            ['input','change'].forEach( event => {
                minValueInput.addEventListener(event, () => {
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.border-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'border');
                })
            });
            ['input','change'].forEach( event => {
                maxValueInput.addEventListener(event, () => {
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.border-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'border');
                })
            })
        });
    }

    // Add new row
    typeAddRow.addEventListener('click', () => {
        setTimeout( () => {
            typeRepeaterRows = document.querySelectorAll('.acf-field-repeater.typography-repeater .acf-row:not(.acf-clone)');
            if (typeRepeaterRows.length > 0) {
                typeRepeaterRows.forEach( row =>{
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.typography-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'font-size');
                    ['input','change'].forEach( event => {
                        minValueInput.addEventListener(event, () => {
                            baseFont = document.querySelector('.base-font input[type="number"]');
                            minViewport = document.querySelector('.min-viewport input[type="number"]');
                            maxViewport = document.querySelector('.max-viewport input[type="number"]');
                            const minValueInput = row.querySelector('.min-value input[type="number"]');
                            const maxValueInput = row.querySelector('.max-value input[type="number"]');
                            const preview = row.querySelector('.typography-preview');
                            setClampValue(minValueInput.value, maxValueInput.value, preview, 'font-size');
                        })
                    });
                    ['input','change'].forEach( event => {
                        maxValueInput.addEventListener(event, () => {
                            baseFont = document.querySelector('.base-font input[type="number"]');
                            minViewport = document.querySelector('.min-viewport input[type="number"]');
                            maxViewport = document.querySelector('.max-viewport input[type="number"]');
                            const minValueInput = row.querySelector('.min-value input[type="number"]');
                            const maxValueInput = row.querySelector('.max-value input[type="number"]');
                            const preview = row.querySelector('.typography-preview');
                            setClampValue(minValueInput.value, maxValueInput.value, preview, 'font-size');
                        })
                    })
                });
            }
        }, 50);
    });

    spaceAddRow.addEventListener('click', () => {
        setTimeout( () => {
            spaceRepeaterRows = document.querySelectorAll('.acf-field-repeater.spacing-repeater .acf-row:not(.acf-clone)');
            if (spaceRepeaterRows.length > 0) {
                spaceRepeaterRows.forEach( row =>{
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.spacing-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'spacing');

                    ['input','change'].forEach( event => {
                        minValueInput.addEventListener(event, () => {
                            baseFont = document.querySelector('.base-font input[type="number"]');
                            minViewport = document.querySelector('.min-viewport input[type="number"]');
                            maxViewport = document.querySelector('.max-viewport input[type="number"]');
                            const minValueInput = row.querySelector('.min-value input[type="number"]');
                            const maxValueInput = row.querySelector('.max-value input[type="number"]');
                            const preview = row.querySelector('.spacing-preview');
                            setClampValue(minValueInput.value, maxValueInput.value, preview, 'spacing');
                        })
                    });
                    ['input','change'].forEach( event => {
                        maxValueInput.addEventListener(event, () => {
                            baseFont = document.querySelector('.base-font input[type="number"]');
                            minViewport = document.querySelector('.min-viewport input[type="number"]');
                            maxViewport = document.querySelector('.max-viewport input[type="number"]');
                            const minValueInput = row.querySelector('.min-value input[type="number"]');
                            const maxValueInput = row.querySelector('.max-value input[type="number"]');
                            const preview = row.querySelector('.spacing-preview');
                            setClampValue(minValueInput.value, maxValueInput.value, preview, 'spacing');
                        })
                    })
                });
            }
        }, 50);
    });
    
    borderAddRow.addEventListener('click', () => {
        setTimeout( () => {
            borderRepeaterRows = document.querySelectorAll('.acf-field-repeater.border-repeater .acf-row:not(.acf-clone)');
            if (borderRepeaterRows.length > 0) {
                borderRepeaterRows.forEach( row =>{
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.border-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'border');

                    ['input','change'].forEach( event => {
                        minValueInput.addEventListener(event, () => {
                            baseFont = document.querySelector('.base-font input[type="number"]');
                            minViewport = document.querySelector('.min-viewport input[type="number"]');
                            maxViewport = document.querySelector('.max-viewport input[type="number"]');
                            const minValueInput = row.querySelector('.min-value input[type="number"]');
                            const maxValueInput = row.querySelector('.max-value input[type="number"]');
                            const preview = row.querySelector('.border-preview');
                            setClampValue(minValueInput.value, maxValueInput.value, preview, 'border');
                        })
                    });
                    ['input','change'].forEach( event => {
                        maxValueInput.addEventListener(event, () => {
                            baseFont = document.querySelector('.base-font input[type="number"]');
                            minViewport = document.querySelector('.min-viewport input[type="number"]');
                            maxViewport = document.querySelector('.max-viewport input[type="number"]');
                            const minValueInput = row.querySelector('.min-value input[type="number"]');
                            const maxValueInput = row.querySelector('.max-value input[type="number"]');
                            const preview = row.querySelector('.border-preview');
                            setClampValue(minValueInput.value, maxValueInput.value, preview, 'border');
                        })
                    })
                });
            }
        }, 50);
    });

    // Global Settings
    ['input','change'].forEach( event => {
        typeRepeaterRows = document.querySelectorAll('.acf-field-repeater.typography-repeater .acf-row:not(.acf-clone)');
        spaceRepeaterRows = document.querySelectorAll('.acf-field-repeater.spacing-repeater .acf-row:not(.acf-clone)');

        baseFont.addEventListener(event, () => {
            if (typeRepeaterRows.length > 0) {
                typeRepeaterRows.forEach( row =>{
                    baseFont.value = baseFont.value;
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.typography-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'font-size');
                })
            }

            if (spaceRepeaterRows.length > 0) {
                spaceRepeaterRows.forEach( row =>{
                    baseFont.value = baseFont.value;
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.spacing-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'spacing');
                })
            }

            if (borderRepeaterRows.length > 0) {
                borderRepeaterRows.forEach( row =>{
                    baseFont.value = baseFont.value;
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.border-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'border');
                })
            }
        })

        minViewport.addEventListener(event, () => {
            if (typeRepeaterRows.length > 0) {
                typeRepeaterRows.forEach( row =>{
                    minViewport.value = minViewport.value;
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.typography-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'font-size');
                })
            }

            if (spaceRepeaterRows.length > 0) {
                spaceRepeaterRows.forEach( row =>{
                    minViewport.value = minViewport.value;
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.spacing-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'spacing');
                })
            }

            if (borderRepeaterRows.length > 0) {
                borderRepeaterRows.forEach( row =>{
                    minViewport.value = minViewport.value;
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    maxViewport = document.querySelector('.max-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.border-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'border');
                })
            }
        })

        maxViewport.addEventListener(event, () => {
            if (typeRepeaterRows.length > 0) {
                typeRepeaterRows.forEach( row =>{
                    maxViewport.value = maxViewport.value;
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.typography-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'font-size');
                })
            }

            if (spaceRepeaterRows.length > 0) {
                spaceRepeaterRows.forEach( row =>{
                    maxViewport.value = maxViewport.value;
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.spacing-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'spacing');
                })
            }

            if (borderRepeaterRows.length > 0) {
                borderRepeaterRows.forEach( row =>{
                    maxViewport.value = maxViewport.value;
                    baseFont = document.querySelector('.base-font input[type="number"]');
                    minViewport = document.querySelector('.min-viewport input[type="number"]');
                    const minValueInput = row.querySelector('.min-value input[type="number"]');
                    const maxValueInput = row.querySelector('.max-value input[type="number"]');
                    const preview = row.querySelector('.border-preview');
                    setClampValue(minValueInput.value, maxValueInput.value, preview, 'border');
                })
            }
        })
    })
    
})