const ADMINBRXC = {
    globalSettings: {
        keyboardShortcuts: {
        },
        disableIDStyles: false,
        integrations:{
        },
        elements : [],
        styleControls: [],
    },
    vue: document.querySelector('.brx-body').__vue_app__,
    vueConfig: document.querySelector('.brx-body').__vue_app__.config,
    vueGlobalProp: document.querySelector('.brx-body').__vue_app__.config.globalProperties,
    cssVariables: [],
    populateCSSVariables: function(){
        const self = this;
        const temp = Array.from(document.styleSheets)
        .filter(
            sheet =>
            sheet.href === null || sheet.href.startsWith(window.location.origin)
        )
        .reduce(
            (acc, sheet) =>
            (acc = [
                ...acc,
                ...Array.from(sheet.cssRules).reduce(
                (def, rule) =>
                    (def =
                    rule.selectorText === ":root"
                        ? [
                            ...def,
                            ...Array.from(rule.style).filter(name =>
                            name.startsWith("--") && !name.startsWith("--builder")
                            )
                        ]
                        : def),
                []
                )
            ]),
            []
        )
        .sort(

        );
        temp.forEach(el => {
            self.cssVariables.push(`var(${el})`)
        })
    },
    globalClasses: () => {
        let globalClasses = [];
        if(bricksData["loadData"].hasOwnProperty("globalClasses")){
            bricksData["loadData"]["globalClasses"].forEach(el =>{
                globalClasses.push(el['name']);
            })
        }
        return globalClasses;
    },
    loremSentences: [
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'Integer nec odio. Praesent libero uctus non, massa.',
        'Sed cursus ante dapibus diam. Sed nisi.',
        'Nulla quis sem at nibh elementum imperdiet.',
        'Duis sagittis ipsum. Praesent mauris himenaeos.',
        'Fusce nec tellus sed augue semper porta.',
        'Vestibulum lacinia arcu eget nulla per conubia.',
        'Class aptent taciti sociosqu ad litora torquent.',
        'Curabitur sodales ligula in libero euismod in, nibh.',
        'Sed dignissim lacinia nunc nostra, per inceptos.',
        'Curabitur tortor pellentesque nibh aenean quam.',
        'In scelerisque sem at dolor maecenas mattis.',
        'Sed convallis tristique sem mauris massa.',
        'Proin ut ligula vel nunc egestas porttitor.',
        'Morbi lectus risus, iaculis vel, suscipit quis.',
        'Fusce ac turpis quis ligula lacinia aliquet.',
        'Mauris ipsum mam nec ante Nulla facilisi adipiscing diam.',
        'Nulla metus metus, ullamcorper vel, tincidunt sed.',
        'Quisque volutpat condimentum velit ante quis turpis.',
        'Class aptent taciti sociosqu ad litora torquent per conubia.',
        'Sed lacinia, urna non tincidunt mattis, tortor neque.',
        'Ut fringilla. Suspendisse potenti a cursus ipsum.',
        'Nunc feugiat mi a tellus consequat imperdiet.',
        'Vestibulum sapien. Proin quam. Etiam ultrices.',
        'Suspendisse in justo eu magna luctus suscipit.',
    ],
    webSentences: [
        'This is just placeholder text. We will change this out later. It’s just meant to fill space until your content is ready.',
        'Don’t be alarmed, this is just here to fill up space since your finalized copy isn’t ready yet.',
        'Once we have your content finalized, we’ll replace this placeholder text with your real content.',
        'Sometimes it’s nice to put in text just to get an idea of how text will fill in a space on your website.',
        'Traditionally our industry has used Lorem Ipsum, which is placeholder text written in Latin.',
        'Unfortunately, not everyone is familiar with Lorem Ipsum and that can lead to confusion.',
        'I can’t tell you how many times clients have asked me why their website is in another language.',
        'There are other placeholder text alternatives like Hipster Ipsum, Zombie Ipsum, Bacon Ipsum, and many more.',
        'While often hilarious, these placeholder passages can also lead to much of the same confusion.',
        'If you’re curious, this is Website Ipsum. It was specifically developed for the use on development websites.',
        'Other than being less confusing than other Ipsum’s, Website Ipsum is also formatted in patterns more similar to how real copy is formatted on the web today.',
    ],
    fields: {
        CSSVariabe : {
            includedFields: [
                'div[data-control="number"]',
                'div[data-control="text"]:has(#_cssTransition)',
                'div[data-control="text"]:has(#_transformOrigin)',
                'div[data-control="text"]:has(#_flexBasis)',
                'div[data-control="text"]:has(#_overflow)',
                'div[data-control="text"]:has(#_gridTemplateColumns)',
                'div[data-control="text"]:has(#_gridTemplateRows)',
                'div[data-control="text"]:has(#_gridAutoColumns)',
                'div[data-control="text"]:has(#_gridAutoRows)',
                'div[data-control="text"]:has(#_objectPosition)'
            ],
            excludedFields: [
                // Query loop
                '.control-query',
                // Slider
                'div[data-controlkey="start"]',
                'div[data-controlkey="perPage"]',
                'div[data-controlkey="perMove"]',
                'div[data-controlkey="speed"]',
            ],
        },
        loremIpsum : {
            includedFields: [
                'div[data-control="textarea"]',
                '[data-controlkey="text"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="title"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="fields"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="prefix"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="suffix"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="logoText"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="actionText"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="titleCustom"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-control-key="text"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-control-key="title"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-control-key="subtitle"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-control-key="name"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-control-key="buttonText"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
            ],
            excludedFields: [
                '.control-query',
                'div[data-control="conditions"]',
                'div[data-control="interactions"]',
                '#transition',
                'div[data-controlkey="speed"]',
                '[data-controlkey="shortcode"]',
                'div[data-control-key="format"]',
            ],
        },
        openAI : {
            includedFields: [
                'div[data-control="textarea"]',
                '[data-controlkey="text"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="title"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="fields"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="prefix"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="suffix"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="logoText"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="actionText"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-controlkey="titleCustom"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-control-key="text"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-control-key="title"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-control-key="subtitle"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-control-key="name"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
                '[data-control-key="buttonText"] div[data-control="text"][type="text"]:has(input.has-dynamic-picker)',
            ],
            excludedFields: [
                '.control-query',
                'div[data-control="conditions"]',
                'div[data-control="interactions"]',
                '#transition',
                'div[data-controlkey="speed"]',
                '[data-controlkey="shortcode"]',
                'div[data-control-key="format"]',
            ],
        },
        colorsOnHover : {
            includedFields: [
                'ul.color-palette.grid > li.color',
            ],
            excludedFields: [
            ],
        },
        classesOnHover : {
            includedFields: [
                'div.bricks-control-popup > div.css-classes > ul:nth-of-type(2) > li > div.actions',
            ],
            excludedFields: [
            ],
        }
    },
    aihistory:[
    ],
    qry: (el) => {
        return document.querySelector(el);
    },
    qryAll: (els) => {
        return document.querySelectorAll(els);
    },
    initAcc: (elem, option) => {
        document.addEventListener('click', (e) => {
            if (!e.target.matches(elem + ' .brxc-accordion-btn')) return;
            else {
                if (!e.target.parentElement.classList.contains('active')) {
                    if (option == true) {
                        var elementList = document.querySelectorAll(elem + ' .brxc-accordion-container');
                        Array.prototype.forEach.call(elementList, (e) => {
                        e.classList.remove('active');
                        });
                    }
                    e.target.parentElement.classList.add('active');
                } else {
                    e.target.parentElement.classList.remove('active');
                }
            }
        });
    },
    autocomplete: function(inp, arr, type) {
        const self = this;
        var currentFocus = 0;
        if (inp.dataset.autocomplete === "true") return;
        inp.setAttribute("data-autocomplete", "true");
        inp.addEventListener("input", function(e) {
            var a, b, i, j, ul, val = this.value;
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items bricks-control-popup bottom");
            this.parentNode.appendChild(a);
            ul = document.createElement("ul");
            a.appendChild(ul);
            for (i = 0, j = 0; i < arr.length; i++) {
              if (arr[i].toUpperCase().includes(val.toUpperCase())) {
                j++
                b = document.createElement("li");
                b.innerHTML += arr[i];
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    b.addEventListener("click", function(e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    const event = new Event('input', {
                        bubbles: true,
                        cancelable: true,
                    });
                    
                    inp.dispatchEvent(event);
                    closeAllLists();
                });
                ul.appendChild(b);
              }
            }
            if(j === 0){
                closeAllLists();
            }
        });

        inp.addEventListener("keydown", function(e){
            var x = document.getElementById(inp.id + "autocomplete-list");
            if (!x) return;
            x = x.getElementsByTagName("li");
            if (e.keyCode == 40) {
              currentFocus++;
              addActive(x);
            } else if (e.keyCode == 38) { 
              currentFocus--;
              addActive(x);
            } else if (e.keyCode == 13) {
              e.preventDefault();
              if (currentFocus > -1) {
                if (x) x[currentFocus].click();
              }
            }
        })

        function addActive(x) {
          if (!x) return false;
          removeActive(x);
          if (currentFocus >= x.length) currentFocus = 0;
          if (currentFocus < 0) currentFocus = (x.length - 1);
          x[currentFocus].classList.add("selected");
        }
        function removeActive(x) {
          for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("selected");
          }
        }
        function closeAllLists(elmnt) {
          var x = document.getElementsByClassName("autocomplete-items");
          for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
          }
        }
      }

      document.addEventListener("click", function (e) {
          closeAllLists(e.target);
      });
    },
    debounce: (fn, threshold) => {
        var timeout;
        threshold = threshold || 200;
        return function debounced() {
        clearTimeout(timeout);
        var args = arguments;
        var _this = this;
    
        function delayed() {
            fn.apply(_this, args);
        }
        timeout = setTimeout(delayed, threshold);
        };
    },
    randomize: (length) => {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
          counter += 1;
        }
        return result;
    },
    getSetStyleRule: function(sheetName){
        let stylesheet = document.querySelector('link[href*=' + sheetName + ']')
     
        if (stylesheet) {
           stylesheet = stylesheet.sheet;
        }
        return stylesheet;
    },
    updateStyleSheet: function(css, selector, property, value) {
        const self = this;
        const sheet = self.getSetStyleRule(css);
        const sheetRule = [...sheet.cssRules].find((r) => r.selectorText === selector);
        return sheetRule.style.setProperty(property, value);
    },
    openModal: function(target, id){
        const self = this;
        const wrapper = document.querySelector(id);
        wrapper.classList.add('active');
        const btns = wrapper.querySelectorAll('#brxcVariableOverlay .brxc-overlay__action-btn');

        if(btns.length < 1) return;


        btns.forEach(btn => {
            if (target.value === btn.dataset.variable){
                btn.classList.add('active');
            }

            btn.onclick = () => {
                const dataset = btn.dataset.variable;
                target.value = dataset;
                const event = new Event('input', {
                    bubbles: true,
                    cancelable: true,
                });
                
                target.dispatchEvent(event);
                self.closeModal(target, target.target, id)
            }
        })
    },
    openPlainClassesModal: function(classes, id){
        const self = this;
        const wrapper = document.querySelector(id);
        const finalClasses = []
        classes.forEach(el => {
            finalClasses.push(el.textContent.replace('.',''));
        });
        document.querySelector('#brxcPlainClassesOverlay .CodeMirror').CodeMirror.setValue(finalClasses.join(' '));
        wrapper.classList.add('active');
    },
    openAIModal: function(prefix, global = false, target, id){
        const self = this;

        if (global === false){
            // Completion
            const chatMore = document.querySelector('#brxcopenAIOverlay #' + prefix + 'ChatMore');
            const existingInsertBtn = document.querySelector('#brxcopenAIOverlay #' + prefix + 'InsertContent');
            const existingReplaceBtn = document.querySelector('#brxcopenAIOverlay #' + prefix + 'ReplaceContent');
            if(existingInsertBtn) existingInsertBtn.remove();
            if(existingReplaceBtn) existingReplaceBtn.remove();
            chatMore.insertAdjacentHTML(
                'afterend',
                '<div id="' + prefix + 'InsertContent" class="brxc-overlay__action-btn"><span>Insert Content</span></div><div id="' + prefix + 'ReplaceContent" class="brxc-overlay__action-btn primary"><span>Replace Content</span></div>'
            );

            const insertBtn = document.querySelector('#brxcopenAIOverlay #' + prefix + 'InsertContent');
            insertBtn.addEventListener('click', () =>{
                const value = document.querySelector('#brxcopenAIOverlay input[name="openai-results"]:checked + label .message.assistant').textContent;
                target.value += value.replace(/\n/g,'<br>');
                const event = new Event('input', {
                    bubbles: true,
                    cancelable: true,
                });
                target.dispatchEvent(event);
                self.closeModal(target, target.target, id);
                //self.showMessage('AI Content Inserted')
                self.vueGlobalProp.$_showMessage('AI Content Inserted');
            })
            const replaceBtn = document.querySelector('#brxcopenAIOverlay #' + prefix + 'ReplaceContent');
            replaceBtn.addEventListener('click', () =>{
                const value = document.querySelector('#brxcopenAIOverlay input[name="openai-results"]:checked + label .message.assistant').textContent;
                target.value = value.replace(/\n/g,'<br>');
                const event = new Event('input', {
                    bubbles: true,
                    cancelable: true,
                });
                target.dispatchEvent(event);
                self.closeModal(target, target.target, id);
                //self.showMessage('AI Content Inserted')
                self.vueGlobalProp.$_showMessage('AI Content Inserted');
            })

            // Edit
            const editTextArea = document.querySelector('#brxcopenAIOverlay #' + prefix + 'EditText');
            const editbtnwrapper = document.querySelector('#brxcopenAIOverlay #' + prefix + 'InsertEditContentWrapper')
            const existingInsertEditBtn = document.querySelector('#brxcopenAIOverlay #' + prefix + 'InsertEditContent');
            const existingReplaceEditBtn = document.querySelector('#brxcopenAIOverlay #' + prefix + 'ReplaceEditContent');
            if(existingInsertEditBtn) existingInsertEditBtn.remove();
            if(existingReplaceEditBtn) existingReplaceEditBtn.remove();
            editTextArea.value = target.value.replaceAll('<br>', '\n');
            editbtnwrapper.innerHTML += '<div id="' + prefix + 'InsertEditContent" class="brxc-overlay__action-btn"><span>Insert Content</span></div>';
            editbtnwrapper.innerHTML += '<div id="' + prefix + 'ReplaceEditContent" class="brxc-overlay__action-btn primary"><span>Replace Content</span></div>';
            const insertEditBtn = document.querySelector('#brxcopenAIOverlay #' + prefix + 'InsertEditContent');
            insertEditBtn.addEventListener('click', () =>{
                const value = document.querySelector('#brxcopenAIOverlay input[name="openai-edit-results"]:checked + label .message.assistant').textContent;
                target.value += value.replace(/\n/g,'<br>');
                const event = new Event('input', {
                    bubbles: true,
                    cancelable: true,
                });
                target.dispatchEvent(event);
                self.closeModal(target, target.target, id);
                //self.showMessage('AI Content Inserted')
                self.vueGlobalProp.$_showMessage('AI Content Inserted');
            })
            const replaceEditBtn = document.querySelector('#brxcopenAIOverlay #' + prefix + 'ReplaceEditContent');
            replaceEditBtn.addEventListener('click', () =>{
                const value = document.querySelector('#brxcopenAIOverlay input[name="openai-edit-results"]:checked + label .message.assistant').textContent;
                target.value = value.replace(/\n/g,'<br>');
                const event = new Event('input', {
                    bubbles: true,
                    cancelable: true,
                });
                target.dispatchEvent(event);
                self.closeModal(target, target.target, id);
                //self.showMessage('AI Content Inserted')
                self.vueGlobalProp.$_showMessage('AI Content Inserted');
            })
        }

        // Open modal
        const wrapper = document.querySelector(id);
        wrapper.classList.add('active');
    },
    openExtendClassModal: function(id){
        const self = this;
        const select = document.querySelector('#brxcExtendModal #brxc-extendcategoryOptions');
        select.value = self.vueGlobalProp.$_state.activeElement.name;
        const wrapper = document.querySelector(id);
        wrapper.classList.add('active');
    },
    openFindReplaceModal: function(global, id){
        const self = this;
        const wrapper = document.querySelector(id);
        const posRadios = document.querySelectorAll('#brxcFindReplaceModal [name=brxc-findreplacePosition]');
        const select = document.querySelector('#brxcFindReplaceModal #brxc-findreplacecategoryOptions');
        const alert = document.querySelector('#brxcFindReplaceModal .alert');

        if (global){
            select.value = 'all';
            const pageRadio = document.querySelector('#brxcFindReplaceModal #brxc-findreplace-page');
            pageRadio.dispatchEvent(new MouseEvent('click'));
            posRadios.forEach(radio => {
                radio.setAttribute('disabled', true);
            })
            alert.classList.add('active');

        } else {
            select.value = self.vueGlobalProp.$_state.activeElement.name;
            const SiblingRadio = document.querySelector('#brxcFindReplaceModal #brxc-findreplace-siblings');
            SiblingRadio.dispatchEvent(new MouseEvent('click'));
            posRadios.forEach(radio => {
                radio.removeAttribute('disabled');
            })
            alert.classList.remove('active');
        }
        wrapper.classList.add('active');
    },
    generateGlobalClass: function(prefix,e){
        const self = this;
        const id = self.vueGlobalProp.$_generateId()
        self.vueGlobalProp.$_state.globalClasses.push({
            id: prefix + id,
            name: e
        })

        return id;
    },
    importedClasses: function(){
        const self = this;
        let existingClassesId = [];
        const globalClasses = self.vueGlobalProp.$_state.globalClasses;
        const importedClasses = self.globalSettings.importedClasses;
        if (importedClasses.length > 0){
            importedClasses.forEach(e => {
                globalClasses.forEach((item) => { 
                    if (item.name === e) { 
                        existingClassesId.push({id: item.id,name: item.name});
                    }
                }); 
            })

            const importedClassesToCreate = importedClasses.filter(str => !existingClassesId.some(obj => obj.name === str));
            if (importedClassesToCreate.length > 0){
                importedClassesToCreate.forEach( e => {
                    self.generateGlobalClass('brxc_imported_',e);
                })
            }
        }

        //Remove classes

        for (let i = 0; i < globalClasses.length; i++) { 
            const obj = globalClasses[i]; 
            const isImported = obj.name.includes('brxc_imported');  
            isIncluded = importedClasses.includes(obj.name); 
            if (isImported && isIncluded) {
                continue;
            } 
            if (isImported && !isIncluded) { 
                self.vueGlobalProp.$_state.globalClasses.splice(i, 1); 
                i--; 
            }
        } 
    },
    importedGrids: function(){
        const self = this;
        let existingClassesId = [];
        const globalClasses = self.vueGlobalProp.$_state.globalClasses;
        const grids = self.globalSettings.gridClasses;
        if (grids.length > 0){
            grids.forEach(e => {
                globalClasses.forEach((item) => { 
                    if (item.name === e) { 
                        existingClassesId.push({id: item.id,name: item.name});
                    }
                }); 
            })

            const gridsToCreate = grids.filter(str => !existingClassesId.some(obj => obj.name === str));
            if (gridsToCreate.length > 0){
                gridsToCreate.forEach( e => {
                    self.generateGlobalClass('brxc_grid_', e);
                })
            }
        }
        
        //Remove classes

        for (let i = 0; i < globalClasses.length; i++) { 
            const obj = globalClasses[i]; 
            const isGrid = obj.name.includes('brxc_grid_');  
            isIncluded = grids.includes(obj.name); 
            if (isGrid && isIncluded) {
                continue;
            } 
            if (isGrid && !isIncluded) { 
                self.vueGlobalProp.$_state.globalClasses.splice(i, 1); 
                i--; 
            }
        } 

        
    },
    savePlainClasses: function(target,classes) {
        const self = this;
        let finalClasses = []
        let newClasses = [];
        let existingClassesId = [];
        const globalClasses = self.vueGlobalProp.$_state.globalClasses;
        if (classes) {
            newClasses = classes.replace(/\s\s+/g, ' ').split(" ").filter((value, index, array) => array.indexOf(value) === index);
        }
  
        if (newClasses.length > 0){
            newClasses.forEach(e => {
                globalClasses.forEach((item) => { 
                    if (item.name === e) { 
                        existingClassesId.push({id: item.id,name: item.name});
                        finalClasses.push(item.id)
                    }
                }); 
            })

            const newClassesToCreate = newClasses.filter(str => !existingClassesId.some(obj => obj.name === str));
            if (newClassesToCreate.length > 0){
                newClassesToCreate.forEach( e => {
                    const id = self.generateGlobalClass('', e);
                    finalClasses.push(id)
                })
            }
        }
        self.vueGlobalProp.$_activeElement._value.settings._cssGlobalClasses = finalClasses;

        setTimeout(self.closeModal(target, target.target, '#brxcPlainClassesOverlay'), 300);
        self.vueGlobalProp.$_showMessage('Classes updated!');
    },
    resetClasses: function(target){
        const self = this;
        self.savePlainClasses(target, '');
        if (self.vueGlobalProp.$_activeElement._value.settings.hasOwnProperty('_cssGlobalClasses')) delete self.vueGlobalProp.$_activeElement._value.settings._cssGlobalClasses;
        self.closeModal(target, target.target, '#brxcPlainClassesOverlay');
        self.vueGlobalProp.$_showMessage('Classes reset successfully!');
    },
    closeModal: (event, target, id) => {
        if( event.target !== target ) {
            return;
        }
        const wrapper = document.querySelector(id);
        wrapper.classList.remove('active');
        const btns = wrapper.querySelectorAll('.brxc-overlay__action-btn.active');
        if( id === "#brxcVariableOverlay"){
            const btns = wrapper.querySelectorAll('.brxc-overlay__action-btn.active');
            btns.forEach(btn => { btn.classList.remove('active');})
        }
        

    },
    addLorem: function(target, btn) {
        const self = this;
        let used = parseInt(btn.dataset.used);
        let tempArr;
        let arr;
        (self.globalSettings['loremIpsumtype'] === 'human') ? tempArr = ADMINBRXC.webSentences : tempArr = ADMINBRXC.loremSentences;
        (used === tempArr.length) ? arr = tempArr : arr = tempArr.slice(used);
        
        if(target.value.slice(-1)[0] === "."){
            target.value = target.value + ' ' + arr[0];
        } else {
            target.value = target.value + arr[0];
        }
        (used === tempArr.length) ? btn.setAttribute('data-used', 1) : btn.setAttribute('data-used', used + 1);
        const event = new Event('input', {
            bubbles: true,
            cancelable: true,
        });
          
        target.dispatchEvent(event);
    },
    completionAPIRequest: function(prefix, global, overlay, target, history, n, json, type){
        const self = this;
        jQuery.ajax({
            type: 'POST',
            url: openai_ajax_req.ajax_url,
            data: {
                action: 'openai_ajax_function',
                nonce: openai_ajax_req.nonce
            },
            success: function(response) {
                const post = async () => {
                    const rawResponse = await fetch('https://api.openai.com/v1/chat/completions', {
                      method: 'POST',
                      headers: {
                          'Content-Type': 'application/json',
                          'Authorization' : 'Bearer '+ response,
                        },
                      body: JSON.stringify(json)
                    });
                    const content = await rawResponse.json();
                    console.log(content);
                    if(content.error){
                        self.insertErrorMessage(prefix, global, overlay, content.error.message);
                        target.classList.remove('disable');
                    } else {
                        for(i=0; i<n;i++){
                            if(type === "chat"){
                                self.insertAIResponse(prefix, global, overlay, content.choices[i].message.content.trim(), i);
                            } else if(type === "edit"){
                                self.insertAIEditResponse(prefix, global, overlay, content.choices[i].message.content.trim(), i);
                            } else if(type === "code"){
                                self.insertAICodeResponse(prefix, global, overlay, content.choices[i].message.content.trim(), i);
                            }
                        }
                        target.classList.remove('disable');
                        history['assistant'] = content;
                        self.aihistory.push(history);
                    }
                };
                post();
            },
            error: function(response){
                console.log('Something went wrong with the OpenAI AJAX request: ' + response);
                target.classList.remove('disable');
            }
        });
    },
    getAIResponse: function(prefix, target, global = false, overlay, voiceTones, customToneVal, temp = 0, maxTokens = 15, n = 1, topP = 1, pres = 0, freq = 0, model){
        const self = this;
        target.classList.add('disable');
        let message = [];
        let history = [];
        let tones = [];
        let tone = '';
        if (voiceTones.length > 0){
            if(customToneVal && Array.from(voiceTones).filter(el => el.dataset.tone == 'custom').length > 0 && voiceTones.length === 1){
                tone = customToneVal;
            } else {
                let customTone = '';
                if(customToneVal && Array.from(voiceTones).filter(el => el.dataset.tone == 'custom').length > 0){
                    customTone = ' ' + customToneVal;
                };
                Array.from(voiceTones).filter(el => {
                    if (el.dataset.tone != 'custom'){
                        tones.push(el.dataset.tone);
                    }
                });
                tone = 'Adjust the tone of the text to be ' + tones.join(" and ") + '.' + customTone;
            }
            message.push({"role": "system", "content": tone});
        }
        const fmessages = document.querySelectorAll(overlay + ' .brxc-overlay__pannel.completion .message');
        fmessages.forEach(fmessage => {
            if(fmessage.classList.contains('user')){
                message.push({"role": "user", "content": fmessage.value});
            } else {
                message.push({"role": "assistant", "content": fmessage.textContent});
            }
        })
        history['user'] = {
                date: Date.now(),
                type: 'completion',
                system: tone,
                message: message[message.length - 1].content,
                maxTokens: maxTokens,
                choices: n,
                temperature: temp,
                top_p: topP,
                presence_penalty: pres,
                frequency_penalty: freq,
        }

        let json = {
            "model": model, 
            "messages": message,
            "max_tokens": maxTokens,
        };

        if (n != 1) json.n = n;
        if (temp != 1) json.temperature = Number.parseFloat(temp);
        if (topP != 1) json.top_p = Number.parseFloat(topP);
        if (pres != 0) json.presence_penalty = Number.parseFloat(pres);
        if (freq != 0) json.frequency_penalty = Number.parseFloat(freq);

        self.completionAPIRequest(prefix, global, overlay, target, history, n, json, 'chat');
    },
    getEditAIResponse: function(prefix, target, global = false, overlay, voiceTones, customToneVal, temp = 0, maxTokens, n = 1, topP = 1, pres = 0, freq = 0, model){
        const self = this;
        target.classList.add('disable');
        const instruction = document.querySelector(overlay + ' .brxc-overlay__pannel.edit .instruction').value;
        let message = [];
        let history = [];
        let tones = [];
        let tone = 'You are an helpful assistant.';
        if (voiceTones.length > 0){
            Array.from(voiceTones).filter(el => {
                if (el.dataset.tone != 'custom'){
                    tones.push(el.dataset.tone);
                }
            });
            tone += 'Adjust the tone of the text to be ' + tones.join(" and ") + '.';
        }
        message.push({"role": "system", "content": tone});

        const fmessages = document.querySelectorAll(overlay + ' .brxc-overlay__pannel.edit .message');
        fmessages.forEach(fmessage => {
            if(fmessage.classList.contains('user')){
                message.push({"role": "user", "content": `Here is the content: "${fmessage.value}". Here are the instructions: "${instruction}."`});
            } else if (fmessage.classList.contains('assistant')){
                message.push({"role": "assistant", "content": fmessage.textContent});
            }
        })
        history['user'] = {
                date: Date.now(),
                type: 'completion',
                system: tone,
                message: message[message.length - 1].content,
                maxTokens: maxTokens,
                choices: n,
                temperature: temp,
                top_p: topP,
                presence_penalty: pres,
                frequency_penalty: freq,
        }

        let json = {
            "model": model, 
            "messages": message,
            "max_tokens": maxTokens,
        };

        if (n != 1) json.n = n;
        if (temp != 1) json.temperature = Number.parseFloat(temp);
        if (topP != 1) json.top_p = Number.parseFloat(topP);
        if (pres != 0) json.presence_penalty = Number.parseFloat(pres);
        if (freq != 0) json.frequency_penalty = Number.parseFloat(freq);

        self.completionAPIRequest(prefix, global, overlay, target, history, n, json, 'edit');
    },
    getImageAIResponse: function(prefix, target,global = false, overlay, n = 1, size = "256x256"){
        const self = this;
        target.classList.add('disable');
        const prompt = document.querySelector(overlay + ' .brxc-overlay__pannel.image .message.input').value;
        let history = [];
        history['user'] = {
            date: Date.now(),
            type: 'images',
            message: prompt,
            choices: parseInt(n),
            sizes: size,
        }
        const api = () => {
            jQuery.ajax({
                type: 'POST',
                url: openai_ajax_req.ajax_url,
                data: {
                    action: 'openai_ajax_function',
                    nonce: openai_ajax_req.nonce
                },
                success: function(response) {
                    const post = async () => {
                        const rawResponse = await fetch('https://api.openai.com/v1/images/generations', {
                          method: 'POST',
                          headers: {
                              'Content-Type': 'application/json',
                              'Authorization' : 'Bearer '+ response,
                            },
                          body: JSON.stringify({
                            "prompt": prompt,
                            "n": n,
                            "size": size,
                            "response_format": "b64_json"
                            })
                        });
                        const content = await rawResponse.json();
                        console.log(content);
                        if(content.error){
                            self.insertErrorMessage(prefix, global, overlay, content.error.message);
                            target.classList.remove('disable');
                        } else {
                            self.insertAIImagesResponse(prefix, global, overlay, content.data, n);
                            target.classList.remove('disable');
                            history['assistant'] = content;
                            self.aihistory.push(history);
                        }
                    };
                    post();
                },
                error: function(response){
                    console.log('Something went wrong with the OpenAI ImageAJAX request: ' + response);
                    target.classList.remove('disable');
                }
            });
        }
        api();
    },
    //getCodeAIResponse: function(prefix, target,global = false, overlay, temp = 0, maxTokens = 2000, n = 1, topP = 1, pres = 0, freq = 0, model){
    getCodeAIResponse: function(prefix, target, global = false, overlay, temp = 0, maxTokens, n = 1, topP = 1, pres = 0, freq = 0, model){
        const self = this;
        target.classList.add('disable');
        //const input = "/* Write The following request using CSS only (No HTML, Javavascript, SCSS or SASS). The request: " + document.querySelector(overlay + ' .brxc-overlay__pannel.code .input').value + " */";
        let history = [];
        let message = [{"role": "system", "content": "You are an helpful assistant and a CSS Expert. You just write vanilla CSS codes only (No HTML, Javavascript, SCSS or SASS)."}];
        const fmessages = document.querySelectorAll(overlay + ' .brxc-overlay__pannel.code .message');
        fmessages.forEach(fmessage => {
            if(fmessage.classList.contains('user')){
                message.push({"role": "user", "content": `/* The following request is meant to be pasted in a CSS file, so comment any text accordingly. Here is the request: ${fmessage.value} */`});
            }
        })
        history['user'] = {
            date: Date.now(),
            type: 'code',
            message: message[message.length - 1].content,
            maxTokens: 4000,
            choices: n,
            temperature: temp,
            top_p: topP,
            presence_penalty: pres,
            frequency_penalty: freq,
        }

        let json = {
            "model": model, 
            "messages": message,
            "max_tokens": maxTokens,
        };

        if (n != 1) json.n = n;
        if (temp != 1) json.temperature = Number.parseFloat(temp);
        if (topP != 1) json.top_p = Number.parseFloat(topP);
        if (pres != 0) json.presence_penalty = Number.parseFloat(pres);
        if (freq != 0) json.frequency_penalty = Number.parseFloat(freq);

        self.completionAPIRequest(prefix, global, overlay, target, history, n, json, 'code');
    },
    insertErrorMessage: function(prefix, global, overlay, response){
        const self = this;
  
        const wrapper = document.querySelector(overlay + ' .brxc-overlay__error-message-wrapper');
        let inner = `<div class="brxc-ai-response-wrapper remove-on-reset">`;
        inner += `<div name="${prefix}-prompt-response" class="error-message" id="${prefix}ErrorMsg"><i class="bricks-svg ti-close" onClick="this.parentElement.parentElement.remove()"></i>OpenAI API returned an error with the following message: "${response}"</div></div>`;

        wrapper.innerHTML = inner;
        
    },
    saveAIImagetoMediaLibrary: function(target,imageUrl) {
        target.classList.add('disable');
        const api = () => {
            jQuery.ajax({
                type: 'POST',
                url: openai_ajax_req.ajax_url,
                data: {
                    action: 'openai_save_image_to_media_library',
                    image_url: imageUrl,
                    nonce: openai_ajax_req.nonce
                },
                success: function(response) {
                    target.classList.remove('disable');
                    target.textContent = 'Image saved successfully!';
                    setTimeout(() => {
                            target.textContent = 'Save to Media Library';
                    }, 1000)
                },
                error: function(response) {
                    target.classList.remove('disable');
                    target.textContent = 'Error - Something went wrong!';
                    setTimeout(() => {
                            target.textContent = 'Save to Media Library';
                    }, 1000)
                },
            });
        }
        api();
    },
    downloadAIImage: function (src){
        const a = document.createElement("a");
        a.href = src;
        a.download = "AI-Image.png";
        a.click();
        a.remove();
    },
    movePanel: (wrapper, value) => {
        wrapper.style.transform = 'translateX(' + value + ')';
    },
    insertAIResponse: function (prefix, global, overlay, response, n){
        const self = this;
        const randClass = self.randomize(6);
        const wrapper = document.querySelector(overlay + ' .brxc-overlay__pannel.completion #' + prefix + 'InsertContentWrapper')
        const generateWrapper = document.querySelector(overlay + ' .brxc-overlay__pannel.completion #' + prefix + 'GenerateContentWrapper');
        generateWrapper.classList.toggle('active');
        let inner = `<div class="brxc-ai-response-wrapper remove-on-reset"><input type="radio" id="brxc${randClass}" name="openai-results"><label for="brxc${randClass}" class="brxc-input__label">`;
        if (n === 0 ) {
            inner += "<p>OpenAI Assistant</p>";
        }
        inner += `<div name="${prefix}-prompt-response" class="message assistant" id="${prefix}PromptResponse">${response}</div></label></div>`;

        wrapper.insertAdjacentHTML(
            'beforebegin',
            inner
        );
        const radios = document.querySelectorAll('input[name="openai-results"]')
        radios[radios.length - 1].checked = true;
    },
    insertAIEditResponse: function (prefix, global, overlay, response, n){
        const self = this;
        const randClass = self.randomize(6);
        const wrapper = document.querySelector(overlay + ' .brxc-overlay__pannel.edit #' + prefix + 'InsertEditContentWrapper');
        const generateWrapper = document.querySelector(overlay + ' .brxc-overlay__pannel.edit #' + prefix + 'GenerateEditContentWrapper');
        generateWrapper.classList.toggle('active');
        let inner = `<div class="brxc-ai-response-wrapper remove-on-reset"><input type="radio" id="brxc${randClass}" name="${prefix}-edit-results"><label for="brxc${randClass}" class="brxc-input__label">`;
        if (n === 0 ) {
            inner += "<p>OpenAI Assistant</p>";
        }
        inner += `<div name="${prefix}-prompt-response" class="message assistant" id="${prefix}PromptResponse">${response}</div></label></div>`;
        wrapper.insertAdjacentHTML(
            'beforebegin',
            inner
        );
        const radios = document.querySelectorAll('input[name="' + prefix + '-edit-results"]')
        radios[radios.length - 1].checked = true;
    },
    insertAIImagesResponse: function (prefix, global, overlay, response, n){
        const self = this;
        const wrapper = document.querySelector(overlay + ' .brxc-overlay__pannel.image #' + prefix + 'InsertImagesContentWrapper')
        const generateWrapper = document.querySelector(overlay + ' .brxc-overlay__pannel.image #' + prefix + 'GenerateImagesContentWrapper');
        generateWrapper.classList.toggle('active');
        inner = `<div class="brxc-ai-response-wrapper remove-on-reset">
                 <label class="brxc-input__label">OpenAI Assistant</label>
                 <div class='brxc__img-wrapper'>`;
        for(i = 0; i<n; i++){
            const randClass = self.randomize(6);
            inner += `<input type="radio" id="brxc${randClass}" name="${prefix}-images-results">
                  <label for="brxc${randClass}" class="brxc-input__label">
                    <img src="data:image/png;base64,${response[i].b64_json}" alt="" class="brxc__image" />
                  </label>`;         
        }
        inner += "</div></div>";
        wrapper.insertAdjacentHTML(
            'beforebegin',
            inner
        );
        const radios = document.querySelectorAll('input[name="' + prefix + '-images-results"]')
        radios[radios.length - 1].checked = true;
    },
    insertAICodeResponse: function (prefix, global, overlay, response, n){
        const self = this;
        const randClass = self.randomize(6);
        const generateWrapper = document.querySelector(overlay + ' .brxc-overlay__pannel.code #' + prefix + 'GenerateCodeContentWrapper');
        generateWrapper.classList.toggle('active');
        let inner = `<div class="brxc-ai-response-wrapper remove-on-reset"><input type="radio" id="brxc${randClass}" name="${prefix}-code-results"><label for="brxc${randClass}" class="brxc-input__label">`;
        if (n === 0 ) {
            inner += "<p>OpenAI Assistant</p>";
        }
        inner += `<div name="${prefix}-prompt-response" class="message assistant" id="${prefix}PromptResponse"><textarea>${response}</textarea></div></label></div>`;
        const wrapper = document.querySelector(overlay + ' .brxc-overlay__pannel.code #' + prefix + 'InsertCodeContentWrapper');
        wrapper.insertAdjacentHTML(
            'beforebegin',
            inner
        );
        const textarea = document.querySelector(`label[for="brxc${randClass}"] textarea`);
        self.setNewCodeMirror(textarea);
        const radios = document.querySelectorAll('input[name="' + prefix + '-code-results"]')
        radios[radios.length - 1].checked = true;
    },
    pasteAICode: function(generatedCode){
        const pageCSSLabel = document.querySelector('#brxcCSSOverlay #global-code-openai-page')
        const pageCSS = document.querySelector('#brxcCSSOverlay #brxcPageCSSWrapper .CodeMirror');
        const pageCSSValue = pageCSS.CodeMirror.getValue();
        const finalCode = pageCSSValue + "\n" + generatedCode;
        pageCSS.CodeMirror.setValue(finalCode);
        pageCSSLabel.dispatchEvent(new Event('click'));
        pageCSSLabel.checked = true;
    },
    chatMoreAIResponse: function (prefix, global = false, overlay){
        const wrapper = document.querySelector(overlay + ' #' + prefix + 'InsertContentWrapper')
        wrapper.insertAdjacentHTML(
            'beforebegin',
            `<label for="${prefix}PromptText" class="brxc-input__label remove-on-reset">User Prompt (Required)</label><textarea name="${prefix}-prompt-text" id="${prefix}PromptText" class="${prefix}-prompt-text message user remove-on-reset" placeholder="Type your prompt text here..." cols="30" rows="3" spellcheck="false"></textarea>`
        );
        const container = document.querySelector(overlay + ' .brxc-overlay__pannel.completion')
        const btns = document.querySelector(overlay + ' .brxc-overlay__pannel.completion #' + prefix + 'GenerateContentWrapper')
        btns.classList.toggle('active');
        container.insertBefore(btns, wrapper);

    },
    resetAIresponses: (resets, removes, generate) => {
        resets.forEach(reset => {reset.value = ''});
        removes.forEach(el => {el.remove()});
        const generateWrapper = generate;
        generateWrapper.classList.add('active');
    },
    toggleCustomToneVoice: (prefix, custom) => {
        let input = document.querySelector('#' + prefix + 'System');
        if ( custom.checked==true ) {
            input.style.display = 'block';
        } else {
            input.style.display = 'none';
        }

    },
    toggleRadioVisibility: function(){
        const radios = document.querySelectorAll('[name="brxc-extend-styles"]');
        const target = document.querySelector('#brxc-extend-css-property');
        radios.forEach(radio => {
            radio.addEventListener('change', () =>{
                const radio = document.querySelector('#brxc-extend-style');
                (radio.checked == true) ? target.style.display = 'block' : target.style.display = 'none';
            })
        })

    },
    mounAIHistory: function(prefix, overlay){
        const self = this;

        const canvas = document.querySelector(overlay + ' .brxc-overlay__pannel.history .brxc-canvas');

        if (self.aihistory.length === 0) return canvas.innerHTML = "<p class='brxc__no-record'>No records yet. Please come back here after you generated some AI content.</p>"
        // wrapper
        canvas.classList.remove('empty');
        let inner = '<div class="isotope-wrapper--late" data-gutter="20" data-filter-layout="fitRows" style="--col:1">';
        //search
        inner += '<div class="brxc-overlay__search-box"><input type="search" class="iso-search" name="typography-search" placeholder="Type here to filter the history list" data-type="textContent"><div class="iso-reset"><i class="bricks-svg ti-close"></i></div></div>';
        //container
        inner += '<div class="isotope-container">';
        if(self.aihistory.length < 1) return;
        const rtf = new Intl.RelativeTimeFormat('en', { numeric: 'auto' });
        for(let i=0; i<self.aihistory.length; i++){
            const diff = self.aihistory[i]['user']['date'] - Date.now();
            let unit = "second";
            let divider = 1000;
            if (diff / 1000 < -59) {
                unit = "minute";
                divider = 60000;
            }
            if (diff / 1000 / 60 < -59) {
                unit = "hour";
                divider = 3600000;
            }
            if (diff / 1000 / 60 / 60 < -23) {
                unit = "day";
                divider = 86400000;
            }
            const time = rtf.format(Math.round(diff / divider), unit);
            inner += `
            <div class="brxc-ai-response-wrapper isotope-selector brxc-isotope__col">
                <input type="radio" id="brxcHistoryUser${i}" name="openai-results">
                <label for="brxcHistoryUser${i}" class="brxc-input__label">
                    <div class="brxc-history__header-wrapper">
                        <div class="brxc-history__header-wrapper--left">
                            <span><i class="fas fa-user"></i>You <span class="brxc__light">(${time})</span></span>
                        </div>
                        <div class="brxc-history__header-wrapper--right">`;
                            if(self.aihistory[i]['user']['type']){
                                inner += `
                                <div class="brxc-history__header-block" data-balloon="Category" data-balloon-pos="top">
                                    <i class="bricks-svg fas fa-tag"></i>
                                    <span>${self.aihistory[i]['user']['type']}</span>
                                </div>`;
                            }
                            if(self.aihistory[i]['user']['choices']){
                                inner += `
                                <div class="brxc-history__header-block" data-balloon="Choices" data-balloon-pos="top">
                                    <i class="bricks-svg fas fa-list-ul"></i>
                                    <span>${self.aihistory[i]['user']['choices']}</span>
                                </div>`;
                            }
                            if (self.aihistory[i]['user']['maxTokens']){
                                inner += `<div class="brxc-history__header-block" data-balloon="Max Tokens" data-balloon-pos="top">
                                    <i class="bricks-svg fas fa-traffic-light"></i>
                                    <span>${self.aihistory[i]['user']['maxTokens']} tokens</span>
                                </div>`;
                            }
                            if (typeof self.aihistory[i]['assistant']['usage'] != 'undefined'){
                                if(self.aihistory[i]['assistant']['usage']['prompt_tokens']){
                                inner += `<div class="brxc-history__header-block" data-balloon="Tokens used" data-balloon-pos="top">
                                    <i class="bricks-svg fas fa-dollar-sign"></i>
                                    <span>${self.aihistory[i]['assistant']['usage']['prompt_tokens']} tokens</span>
                                </div>`;
                                }
                            }
                        inner +=`</div>
                    </div>`;
                    
                    inner +=` <div name="${prefix}-prompt-response" class="message assistant">${self.aihistory[i]['user']['message']}</div>`;
                    
                inner +=`</label>`;
                if(self.aihistory[i]['user']['instruction']){
                    inner += `
                    <input type="radio" id="brxcHistoryInstruction${i}" name="openai-results">
                    <label for="brxcHistoryInstruction${i}" class="brxc-input__label">
                        <div name="${prefix}-prompt-response" class="message assistant">${self.aihistory[i]['user']['instruction']}</div>
                    </label>`;
                }
            inner += `</div>`;
            inner += '<div class="brxc-ai-response-wrapper isotope-selector brxc-isotope__col">';
            if(typeof self.aihistory[i]['assistant']['choices'] != 'undefined'){  
                for(let j=0; j<self.aihistory[i]['assistant']['choices'].length; j++){
                    
                    inner += `
                        <input type="radio" id="brxcHistoryAssistant${i + "c" +  j}" name="openai-results">
                        <label for="brxcHistoryAssistant${i + "c" +  j}" class="brxc-input__label">
                            <div class="brxc-history__header-wrapper">
                                <div class="brxc-history__header-wrapper--left">`
                                if(j===0) inner +=`<span><i class="fas fa-robot"></i>AI assistant <span class="brxc__light">(${time})</span></span>`;
                                inner +=`</div>
                                <div class="brxc-history__header-wrapper--right">`;
                                    if(j===0 && self.aihistory[i]['user']['temperature']){
                                        inner += `
                                        <div class="brxc-history__header-block" data-balloon="Temperature" data-balloon-pos="top">
                                            <i class="bricks-svg fas fa-temperature-empty"></i>
                                            <span>${self.aihistory[i]['user']['temperature']}</span>
                                        </div>`;
                                    }
                                    if(j===0 && self.aihistory[i]['user']['top_p']){
                                        inner += `
                                        <div class="brxc-history__header-block" data-balloon="Top Probability" data-balloon-pos="top">
                                            <i class="bricks-svg fas fa-arrow-up-1-9"></i>
                                            <span>${self.aihistory[i]['user']['top_p']}</span>
                                        </div>`;
                                    }
                                    if(j===0 && self.aihistory[i]['user']['presence_penalty']){
                                        inner += `
                                        <div class="brxc-history__header-block" data-balloon="Presence Penalty" data-balloon-pos="top">
                                            <i class="bricks-svg fas fa-signal"></i>
                                            <span>${self.aihistory[i]['user']['presence_penalty']}</span>
                                        </div>`;
                                    }
                                    if(j===0 && self.aihistory[i]['user']['frequency_penalty']){
                                        inner += `
                                        <div class="brxc-history__header-block" data-balloon="Frequency Penalty" data-balloon-pos="top">
                                            <i class="bricks-svg fas fa-wave-square"></i>
                                            <span>${self.aihistory[i]['user']['frequency_penalty']}</span>
                                        </div>`;
                                    }
                                    if (j===0 && typeof self.aihistory[i]['assistant']['usage'] != 'undefined' && self.aihistory[i]['assistant']['usage']['completion_tokens']){
                                        inner += `
                                        <div class="brxc-history__header-block" data-balloon="Tokens used" data-balloon-pos="top">
                                            <i class="bricks-svg fas fa-dollar-sign"></i>
                                            <span>${self.aihistory[i]['assistant']['usage']['completion_tokens']} tokens</span>
                                        </div>`;
                                    }
                                    inner += `</div>
                            </div>`;
                            if(self.aihistory[i]['user']['type'] === "completion" || self.aihistory[i]['user']['type'] === "code" || self.aihistory[i]['user']['type'] === "edit"){
                                inner += `<div name="${prefix}-prompt-response" class="message assistant">${self.aihistory[i]['assistant']['choices'][j]['message']['content'].trim()}</div>`;
                            } else {
                                inner += `<div name="${prefix}-prompt-response" class="message assistant">${self.aihistory[i]['assistant']['choices'][j]['text'].trim()}</div>`;
                            }
                        inner += '</label>';
                    
                }
            }
            if(self.aihistory[i]['user']['type'] === "images"){
                inner += `
                <input type="radio" id="brxcHistoryAssistant${i}" name="openai-results">
                <label for="brxcHistoryAssistant${i}" class="brxc-input__label">
                <div class="brxc-history__header-wrapper">
                    <div class="brxc-history__header-wrapper--left">
                        <span>AI assistant <span class="brxc__light">(${time})</span></span>
                    </div>
                </div>
                <div name="${prefix}-prompt-response" class="message assistant">I successfully generated ${self.aihistory[i]['user']['choices']} image(s)</div>`;
            }
            inner += '</div>';
        }
        //end of container and wrapper
        inner += '</div></div>';

        canvas.innerHTML = inner;


        let filterRes = true;
        let filterSearch = true;
        let qsRegex
        let isotopeGutter;
        let isotopeLayoutHelper;
        const isotopeWrappers = document.querySelectorAll(overlay + ' .isotope-wrapper--late')
        isotopeWrappers.forEach(wrapper => {
            const isotopeContainers = wrapper.querySelectorAll('.isotope-container');
            isotopeContainers.forEach(isotopeContainer => {
                const isotopeSelector = wrapper.querySelectorAll('.isotope-selector');
                const isoSearch = wrapper.querySelector('input[type="search"].iso-search');
                const isoSearchType = isoSearch.dataset.type;
                const isoSearchReset = wrapper.querySelector('.iso-reset');
                if (wrapper.dataset.gutter) {
                    isotopeGutter = parseInt(wrapper.dataset.gutter);
                    wrapper.style.setProperty('--gutter', isotopeGutter + 'px');
                    isotopeSelector.forEach(elm => elm.style.paddingBottom = isotopeGutter + 'px');
                } else {
                    isotopeGutter = 0;
                };

                if (wrapper.dataset.filterLayout) {
                    isotopeLayoutHelper = wrapper.dataset.filterLayout;
                } else {
                    isotopeLayoutHelper = 'fitRows';
                };
                

                // init Isotope
                const isotopeOptions = {
                    itemSelector: '.isotope-selector',
                    layoutMode: isotopeLayoutHelper,
                    transitionDuration: 0,
                    filter: function(itemElem1, itemElem2) {
                        const itemElem = itemElem1 || itemElem2;
                        if(isoSearchType === "textContent") {
                            return qsRegex ? itemElem.textContent.match(qsRegex) : true;
                        } else {
                            filterSearch = qsRegex ? itemElem.getAttribute('title').match(qsRegex) : true;
                            return filterRes;
                        }
                    },
                };


                // Set the correct layout
                switch (isotopeLayoutHelper) {
                    case 'fitRows':
                    isotopeOptions.fitRows = {
                        gutter: isotopeGutter
                    };
                    break;
                    case 'masonry':
                    isotopeOptions.masonry = {
                        gutter: isotopeGutter
                    };
                    break;
                }

                // Search Filter
                const iso = new Isotope(isotopeContainer, isotopeOptions);
                
                if (isoSearch) {
                    isoSearch.addEventListener('keyup', self.debounce(() => {
                        qsRegex = new RegExp(isoSearch.value, 'gi');
                        iso.arrange();
                    }, 100));
                }
                if (isoSearchReset) {
                    isoSearchReset.onclick = () => {
                        isoSearch.value = '';
                        const clickEvent = new Event('keyup');
                        isoSearch.dispatchEvent(clickEvent);
                    }
                }



            })
            
        })
    },
    initGridGuide: function() {
        const self = this;
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        const xGridWrapper = document.createElement('div');
        xGridWrapper.classList.add(...['brxc-grid-guide__wrapper','brxe-section']);
        const xGridContainer = document.createElement('div');
        xGridContainer.classList.add('brxe-container');
        const div = '<div></div>';
        xGridContainer.innerHTML += div.repeat(self.globalSettings.enableGridGuideCol);
        xGridWrapper.appendChild(xGridContainer);
        x.document.body.after(xGridWrapper);
    },
    gridGuide: (btn) => {
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        let xGridWrapper = x.document.querySelector('.brxc-grid-guide__wrapper')
        xGridWrapper.classList.toggle('active');
        btn.classList.toggle('enabled');
    },
    XCode: (btn) => {
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        const els = x.document.querySelectorAll('body main *, body footer *, body header *');
        if(!btn.classList.contains('enabled')){
            btn.classList.add('enabled');
            els.forEach(el=> {
                el.classList.add('x-mode-enabled');
            })
        } else {
            btn.classList.remove('enabled');
            els.forEach(el=> {
                el.classList.remove('x-mode-enabled');
            })
        }
    },
 
    contrast: (btn) => {
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        if(!btn.classList.contains('enabled')){
            btn.classList.add('enabled');
            contrast.check();
        } else {
            btn.classList.remove('enabled');
            const failedEls = x.document.querySelectorAll('.brxc-contrast-failed');
            failedEls.forEach(el => el.classList.remove('brxc-contrast-failed'))
        }
    },

 
    darkMode: (btn) => {
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        x.document.body.classList.toggle('brxc-dark');
        btn.classList.toggle('enabled');

    },
    addMenuItemtoToolbar: (classes, balloonText, balloonPosition, onClickFunction, iconHTML, toolbar, insertBeforeEl) => {
        const li = document.createElement('li');
        li.classList.add(classes);
        li.setAttribute('data-balloon', balloonText);
        li.setAttribute('data-balloon-pos', balloonPosition);
        li.setAttribute('onClick',onClickFunction)
        const span = document.createElement('span');
        span.classList.add('bricks-svg-wrapper');
        span.innerHTML += iconHTML;
        li.appendChild(span);
        toolbar.insertBefore(li,insertBeforeEl);
    },
    addIconToFields: (tag, classes, balloonText, balloonPosition, onClickFunction, dataUsed, htmlEl, target, appendMethod) => {
        const li = document.createElement(tag);
        li.classList.add(...classes.split(' '));
        li.setAttribute('data-balloon', balloonText);
        li.setAttribute('data-balloon-pos',balloonPosition);
        li.setAttribute('onclick', onClickFunction);
        (dataUsed === true) ? li.setAttribute('data-used', 0) : '';
        li.innerHTML = htmlEl;
        if(appendMethod === 'after'){
            target.after(li);
        } else if (appendMethod === 'before'){
            target.insertBefore(li);
        } else if (appendMethod === 'child'){
            target.appendChild(li);
        } 
    },
    addDynamicVariableIcon: function() {
        const self = this;
        setTimeout(()=> {
            self.fields['CSSVariabe']['includedFields'].forEach(field => {
                const wrappers = Array.from(document.querySelectorAll(field)).filter(item => !item.parentNode.closest(self.fields['CSSVariabe']['excludedFields']));
                if(wrappers.length < 1) return;
                wrappers.forEach(wrapper => {
                    const modal = wrapper.querySelector('.brxc-toggle-modal');
                    if (modal) return;
                    self.addIconToFields('div','brxc-toggle-modal', 'Select CSS Variable', 'top-right', 'ADMINBRXC.openModal(event.target.previousSibling, "#brxcVariableOverlay" )', false,  "<span>v</span>", wrapper.querySelector("input[type=\'text\']"), 'after');
                })
            })
        },0)
    },
    addDynamicLoremIcon: function() {
        const self = this;
        setTimeout(()=> {
            self.fields['loremIpsum']['includedFields'].forEach(field => {
                const wrappers = Array.from(document.querySelectorAll(field)).filter(item => !item.parentNode.querySelector(self.fields['loremIpsum']['excludedFields']) && !item.parentNode.closest(self.fields['loremIpsum']['excludedFields']));
                if(wrappers.length < 1) return;
                wrappers.forEach(wrapper => {
                    const inputs = wrapper.querySelectorAll('.brxc-toggle-lorem');
                    if (inputs.length > 0) return;
                    self.addIconToFields('div','brxc-toggle-lorem', 'Add Dummy Content', 'top-right', 'ADMINBRXC.addLorem(event.target.parentNode.querySelector("textarea,input"), this)', true, "<div class='lorem-wrapper'><div class='lorem-line lorem-line-1'></div><div class='lorem-line lorem-line-2'></div><div class='lorem-line lorem-line-3'></div>", wrapper, 'child');
                })
            })
        },0)
    },
    addDynamicAIIcon: function() {
        const self = this;
        setTimeout(()=> {
            self.fields['openAI']['includedFields'].forEach(field => {
                const wrappers = Array.from(document.querySelectorAll(field)).filter(item => !item.parentNode.querySelector(self.fields['openAI']['excludedFields']) && !item.parentNode.closest(self.fields['openAI']['excludedFields']));
                if(wrappers.length < 1) return;
                wrappers.forEach(wrapper => {
                    const inputs = wrapper.querySelectorAll('.brxc-toggle-ai');
                    if (inputs.length > 0) return;
                    self.addIconToFields('div','brxc-toggle-ai', 'Add AI Content', 'top-right', 'ADMINBRXC.openAIModal("openai",false,event.target.parentNode.querySelector("textarea,input"), "#brxcopenAIOverlay" )', false, "<div class='ai-wrapper'><span class='ai-text'>AI</span></div>", wrapper, 'child');
                })
            })
        },0)
    },
    addPanelHeaderIcons: function(){
        const self = this;
        const arrow = document.querySelector('#bricks-toolbar ul.group-wrapper.left li.pseudo-classes')
        const icons = document.querySelectorAll('#bricks-panel-inner #bricks-panel-header ul.actions li.brxc-header-icon')
        const pseudos = document.querySelectorAll('#bricks-panel-element #panel-pseudo-classes .bricks-control-popup ul li .name');
        const clear = document.querySelector('#panel-pseudo-classes .bricks-svg-wrapper.clear');
        if (clear && document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.pseudoClassPopup === true){
            clear.addEventListener('click', () => {
                const icons = document.querySelectorAll('#bricks-panel-header ul.actions li')
                icons.forEach(li => li.classList.remove('active'));
                return;
            })
        }
        if (arrow && document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.pseudoClassPopup === true){
            arrow.addEventListener('click', () => {
                const icons = document.querySelectorAll('#bricks-panel-header ul.actions li')
                icons.forEach(li => li.classList.remove('active'));
                return;
            })
        }
        const defaultPseudo = ['before','after','hover', 'active', 'focus'];
        defaultPseudo.forEach(pseudo => {
            const menuEl = Array.from(pseudos).find(el => el.textContent.includes(pseudo));
            if (!menuEl) return;
            menuEl.parentElement.addEventListener('click', () => {
                icons.forEach(icon => icon.classList.remove('active'));
                const icon = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions li.brxc-header-icon__' + pseudo);
                (icon) ? icon.classList.add('active') : '';
            })
        })
        const wrapper = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions')
        if (Object.values(self.globalSettings.shortcutsIcons).includes('hover')){
            if(!self.vueGlobalProp.$_state.pseudoClasses.includes(':hover')) self.vueGlobalProp.$_state.pseudoClasses.push(':hover')
            const hoverIcon = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions .brxc-header-icon__hover');
            if (!hoverIcon) {
                wrapper ? self.addIconToFields('li','brxc-header-icon brxc-header-icon__hover', ':hover', 'bottom-right', 'ADMINBRXC.setHeaderState("li.brxc-header-icon__hover", ":hover");', true, '<span class="bricks-svg-wrapper"><i class="fas fa-arrow-pointer" title="fas fa-arrow-pointer"></i></span>', wrapper, 'child') : '';
            }
        }
        if (Object.values(self.globalSettings.shortcutsIcons).includes('before')){
            if(!self.vueGlobalProp.$_state.pseudoClasses.includes(':before')) self.vueGlobalProp.$_state.pseudoClasses.push(':before')
            const beforeIcon = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions .brxc-header-icon__before');
            if (!beforeIcon) {
                wrapper ? self.addIconToFields('li','brxc-header-icon brxc-header-icon__before', ':before', 'bottom-right', 'ADMINBRXC.setHeaderState("li.brxc-header-icon__before", ":before");', true, '<span class="bricks-svg-wrapper"><svg class="bricks-svg" viewBox="0 0 24 24"><path d="M5 20h14v-2H5v2zM19 9h-4V3H9v6H5l7 7 7-7z"></path></svg></span>', wrapper, 'child') : '';
            }
        }
        if (Object.values(self.globalSettings.shortcutsIcons).includes('after')){
            if(!self.vueGlobalProp.$_state.pseudoClasses.includes(':after')) self.vueGlobalProp.$_state.pseudoClasses.push(':after')
            const afterIcon = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions .brxc-header-icon__after');
            if (!afterIcon) {
                wrapper ? self.addIconToFields('li','brxc-header-icon brxc-header-icon__after', ':after', 'bottom-right', 'ADMINBRXC.setHeaderState("li.brxc-header-icon__after", ":after");', true, '<span class="bricks-svg-wrapper"><svg class="bricks-svg" viewBox="0 0 24 24"><path d="M5 20h14v-2H5v2zM19 9h-4V3H9v6H5l7 7 7-7z"></path></svg></span>', wrapper, 'child') : '';
            }
        }
        if (Object.values(self.globalSettings.shortcutsIcons).includes('active')){
            if(!self.vueGlobalProp.$_state.pseudoClasses.includes(':active')) self.vueGlobalProp.$_state.pseudoClasses.push(':active')
            const activeIcon = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions .brxc-header-icon__active');
            if (!activeIcon) {
                wrapper ? self.addIconToFields('li','brxc-header-icon brxc-header-icon__active', ':active', 'bottom-right', 'ADMINBRXC.setHeaderState("li.brxc-header-icon__active", ":active");', true, '<span class="bricks-svg-wrapper"><i class="fas fa-toggle-on" title="fas fa-toggle-on"></span>', wrapper, 'child') : '';
            }
        }
        if (Object.values(self.globalSettings.shortcutsIcons).includes('focus')){
            if(!self.vueGlobalProp.$_state.pseudoClasses.includes(':focus')) self.vueGlobalProp.$_state.pseudoClasses.push(':focus')
            const focusIcon = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions .brxc-header-icon__focus');
            if (!focusIcon) {
                wrapper ? self.addIconToFields('li','brxc-header-icon brxc-header-icon__focus', ':focus', 'bottom-right', 'ADMINBRXC.setHeaderState("li.brxc-header-icon__focus", ":focus");', true, '<span class="bricks-svg-wrapper"><i class="fas fa-crosshairs" title="fas fa-crosshairs"></span>', wrapper, 'child') : '';
            }
        }
    },
    setExtendClass(){
        const self = this;
        const wrapper = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions');
        if(!wrapper) return;
        if(Object.values(self.globalSettings.classFeatures).includes("extend-classes")){
            const extendIcon = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions .brxc-header-icon__extend');
            if (!extendIcon) {
                wrapper ? self.addIconToFields('li','brxc-header-icon brxc-header-icon__extend', 'Extend Classes & Styles', 'bottom-right', 'ADMINBRXC.openExtendClassModal("#brxcExtendModal")', true, '<span class="bricks-svg-wrapper"><svg xmlns="http://www.w3.org/2000/svg" class="bricks-svg" viewBox="0 96 960 960"><path d="M145 1022v-95h670v95H145Zm337-125L311 726l58-59 72 72V413l-72 72-58-59 171-171 172 171-59 59-72-72v326l72-72 59 59-172 171ZM145 225v-95h670v95H145Z"/></svg></span>', wrapper, 'child') : '';
            }
        }
    },
    setFindReplace(){
        const self = this;
        const wrapper = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions');
        if(!wrapper) return;
        if(Object.values(self.globalSettings.classFeatures).includes("find-and-replace")){
            const FindReplaceIcon = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions .brxc-header-icon__find-replace');
            if (!FindReplaceIcon) {
                wrapper ? self.addIconToFields('li','brxc-header-icon brxc-header-icon__find-replace', 'Find & Replace Styles', 'bottom-right', 'ADMINBRXC.openFindReplaceModal(false, "#brxcFindReplaceModal")', true, '<span class="bricks-svg-wrapper"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960" class="bricks-svg"><path xmlns="http://www.w3.org/2000/svg" d="M138 484q18-110 103.838-182T440 230q75 0 133 30.5t98 82.5v-98h72v239H503v-71h100q-27-42-70.5-65T440 325q-72.187 0-130.093 43.5Q252 412 234 484h-96Zm674 492L615 780q-34 27-78 43.5T440.217 840Q367 840 308.5 813 250 786 209 734v93h-72V588h240v71H271q28.269 41.15 72.541 64.075Q387.812 746 440 746q72.102 0 127.444-44.853T642 588h96q-5 33-19 65.5T684 713l197 196-69 67Z"/></svg></span>', wrapper, 'child') : '';
            }
        }
    },
    setGoToParentElement: function(){
        const self = this;
        const wrapper = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions');
        if(!wrapper) return;
        const goToParentIcon = document.querySelector('#bricks-panel-inner #bricks-panel-header ul.actions .brxc-header-icon__parent');
        if (goToParentIcon && self.vueGlobalProp.$_activeElement._value.hasOwnProperty('parent') && self.vueGlobalProp.$_activeElement._value.parent === 0) {
            goToParentIcon.remove();
        } else if (!goToParentIcon && self.vueGlobalProp.$_activeElement._value.hasOwnProperty('parent') && self.vueGlobalProp.$_activeElement._value.parent != 0) {
            self.addIconToFields('li','brxc-header-icon brxc-header-icon__parent', 'Go to Parent Element', 'bottom-right', 'ADMINBRXC.goToParentElement()', true, '<span class="bricks-svg-wrapper"><i class="fas fa-arrow-turn-up" title="fas fa-arrow-turn-up"></span>', wrapper, 'child');
        }
    },
    goToParentElement: function(){
        const self = this;
        self.vueGlobalProp.$_state.activeId = self.vueGlobalProp.$_activeElement._value.parent;
    },
    setHeaderState: function(target, text) {
        const self = this;
        const icons = document.querySelectorAll('#bricks-panel-header ul.actions li')
        const icon = document.querySelector('#bricks-panel-header ' + target);

        // If icon is active
        if (icon.classList.contains('active')){
            document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.pseudoClassPopup = false;
            icons.forEach(li => li.classList.remove('active'));
            return;
        }

        // If Icon is inactive
        icons.forEach(li => li.classList.remove('active'));
        icon.classList.add('active');
        const pseudoList = document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.pseudoClasses;
        let isPseudoMatching = false;
        for(var i=0; i<pseudoList.length; i++) {
            if(pseudoList[i].indexOf(text)!=-1) {
                isPseudoMatching = true;
            }
        }
        if (isPseudoMatching === true){
            document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.pseudoClassPopup = true;
            document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.pseudoClassActive = text
        }
    },
    setDynamicColorOnHover: function(){
        const self = this;
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        const activeElementID = '#brxe-' + document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_activeElement._value.id;
        const active = x.document.querySelector(activeElementID);
        setTimeout(()=> {
            self.fields['colorsOnHover']['includedFields'].forEach(field => {
                const colors = Array.from(document.querySelectorAll(field));
                colors.forEach(color => {
                    color.onmouseenter = () => {        
                        if (color.parentNode.closest('[data-control="typography"]')) active.style.color = window.getComputedStyle( color.childNodes[0] ,null).getPropertyValue('background-color');
                        if (color.parentNode.closest('[data-control="background"]')) active.style.backgroundColor = window.getComputedStyle( color.childNodes[0] ,null).getPropertyValue('background-color');
                        if (color.parentNode.closest('[data-control="border"]')) active.style.borderColor = window.getComputedStyle( color.childNodes[0] ,null).getPropertyValue('background-color');
                    }
                    color.onmouseleave = () => {          
                        if (color.parentNode.closest('[data-control="typography"]')) active.style.color = '';
                        if (color.parentNode.closest('[data-control="background"]')) active.style.backgroundColor = '';
                        if (color.parentNode.closest('[data-control="border"]')) active.style.borderColor = '';
                    }
                })
            })
        },0)
    },
    setDynamicClassOnHover: function(){
        const self = this;
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        setTimeout(()=> {
            const self = this;
            const activeElementID = '#brxe-' + self.vueGlobalProp.$_activeElement._value.id;
            const active = x.document.querySelector(activeElementID);
            const title = Array.from(document.querySelectorAll('div.bricks-control-popup > div.css-classes > h6')).find(el => el.textContent.includes('Other classes'));
            if(!title) return;
            const ul = title.nextSibling;
            const globalClasses = ul.querySelectorAll('li');
            globalClasses.forEach(singleClass => {
                singleClass.onmouseenter = () => {    
                    const sClass = singleClass.querySelector('div.actions')
                    if (!sClass) return;
                    const sibling = sClass.previousSibling;
                    const name = sibling.textContent;      
                    active.classList.add(name.substring(1));
                };
                singleClass.onmouseleave = () => { 
                    const sClass = singleClass.querySelector('div.actions')
                    if (!singleClass) return;
                    const sibling = sClass.previousSibling;
                    const name = sibling.textContent;       
                    active.classList.remove(name.substring(1));
                }
                singleClass.onclick = () => { 
                    const sClass = singleClass.querySelector('div.actions')
                    if (!singleClass) return;
                    const sibling = sClass.previousSibling;
                    const name = sibling.textContent;       
                    active.classList.remove(name.substring(1));
                }
            })
        },0)
    },
    setIsotope: function() {
        const self = this;
        let filterRes = true;
        let filterSelector = "*";
        let filterSearch = true;
        let qsRegex
        let isotopeGutter;
        let isotopeLayoutHelper;
        const isotopeWrappers = document.querySelectorAll('.isotope-wrapper')
        isotopeWrappers.forEach(wrapper => {
            const isotopeContainers = wrapper.querySelectorAll('.isotope-container');
            isotopeContainers.forEach(isotopeContainer => {
                const isotopeSelector = wrapper.querySelectorAll('.isotope-selector');
                const isoSearch = wrapper.querySelector('input[type="search"].iso-search');
                const isoSearchType = isoSearch.dataset.type;
                const isoSearchReset = wrapper.querySelector('.iso-reset');
                if (wrapper.dataset.gutter) {
                    isotopeGutter = parseInt(wrapper.dataset.gutter);
                    wrapper.style.setProperty('--gutter', isotopeGutter + 'px');
                    isotopeSelector.forEach(elm => elm.style.paddingBottom = isotopeGutter + 'px');
                } else {
                    isotopeGutter = 0;
                };

                if (wrapper.dataset.filterLayout) {
                    isotopeLayoutHelper = wrapper.dataset.filterLayout;
                } else {
                    isotopeLayoutHelper = 'fitRows';
                };
                

                // init Isotope
                const isotopeOptions = {
                    itemSelector: '.isotope-selector',
                    layoutMode: isotopeLayoutHelper,
                    transitionDuration: 0,
                    filter: function(itemElem1, itemElem2) {
                        const itemElem = itemElem1 || itemElem2;
                        if(isoSearchType === "textContent") {
                            return qsRegex ? itemElem.textContent.match(qsRegex) : true;
                        } else {
                            filterSearch = qsRegex ? itemElem.getAttribute('title').match(qsRegex) : true;
                            filterRes = filterSelector != '*' ? itemElem.dataset.filter.includes(filterSelector) : true;
                            return filterSearch && filterRes;
                        }
                    },
                };


                // Set the correct layout
                switch (isotopeLayoutHelper) {
                    case 'fitRows':
                    isotopeOptions.fitRows = {
                        gutter: isotopeGutter
                    };
                    break;
                    case 'masonry':
                    isotopeOptions.masonry = {
                        gutter: isotopeGutter
                    };
                    break;
                }

                // Search Filter
                const iso = new Isotope(isotopeContainer, isotopeOptions);
                
                if (isoSearch) {
                    isoSearch.addEventListener('keyup', self.debounce(() => {
                        qsRegex = new RegExp(isoSearch.value, 'gi');
                        iso.arrange();
                    }, 100));
                }
                if (isoSearchReset) {
                    isoSearchReset.onclick = () => {
                        isoSearch.value = '';
                        const clickEvent = new Event('keyup');
                        isoSearch.dispatchEvent(clickEvent);
                    }
                }

                // Buttons Filters
                const filtersElem = wrapper.querySelectorAll(".filterbtn");
                if (filtersElem.length > 0) {
                    filtersElem.forEach(elem => elem.addEventListener("click", function (event) {
                        event.preventDefault();
                        var filterValue = event.target.getAttribute("data-filter");
                        filterSelector = filterValue;
                        iso.arrange();
                    }));
                };

                const radioButtonGroup = (buttonGroup) => {
                    buttonGroup.addEventListener("click", function (event) {
                    filtersElem.forEach(btn => btn.classList.remove("active"));
                    event.target.classList.add("active");
                    });
                };

                for (var i = 0, len = filtersElem.length; i < len; i++) {
                    var buttonGroup = filtersElem[i];
                    radioButtonGroup(buttonGroup);
                };



            })
            

            //setTimeout(() => iso.arrange({filter: '*'}), 300)
        })
    },
    openInnerWindow: (wrapper) => {
        wrapper.classList.toggle('inner');
    },
    setInnerContent: (el) => {
        const imgCanvas = document.querySelector('#brxcResourcesOverlay .brxc-overlay__pannel-2 .brxc-overlay__img');
        const titleCanvas = document.querySelector('#brxcResourcesOverlay .brxc-overlay__pannel-2 .brxc-overlay__header-title');
        const srcImg = el.childNodes[1].src;
        const titleText = el.getAttribute('title');
        imgCanvas.innerHTML = '<img src="' + srcImg + '" class="inner__img">';
        titleCanvas.textContent = titleText;
    },
    copytoClipboard: function(btn,target, copytext, resestText) {
        const self = this;
        if (window.isSecureContext && navigator.clipboard) {
           navigator.clipboard.writeText(target);
           btn.textContent = copytext;
           setTimeout(() => {
                btn.textContent = resestText;
           }, 1000)
        } else {
            self.unsecuredCopyToClipboard(btn,target,copytext, resestText);
        }
     },
     unsecuredCopyToClipboard: (btn,text,copytext, resestText) => {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.focus({
           preventScroll: true
        });
        textArea.select();
        try {
           document.execCommand('copy');
           btn.textContent = copytext;
           setTimeout(() => {
                btn.textContent = resestText;
           }, 1000)
        } catch (err) {
            alert('Unable to copy to clipboard - Use a secure environment.')
        }
        document.body.removeChild(textArea);
     },
    codeMirrorOptions: (textarea) => {
        let builderTheme;
        (bricksData["loadData"].hasOwnProperty("globalClasses") && bricksData["loadData"]['globalSettings'].hasOwnProperty("builderMode") && bricksData['loadData']['globalSettings']['builderMode'] === 'light') ? builderTheme = 'default' : builderTheme = 'one-dark';
        const obj = {
            value: textarea.value,
            mode: "css",
            theme: builderTheme,
            readOnly: false,
            styleActiveLine: true,
            tabSize: 2,
            lineNumbers: true,
            lineWrapping: !0,
            autoRefresh: !0,
            autofocus: true,
            suppressErrorLogging: !1,
            autoCloseBrackets: true,
            matchBrackets: true,
            gutters: ["CodeMirror-lint-markers"],
            selfContain: true,
            //highlightSelectionMatches: {showToken: /\w/, annotateScrollbar: true},
            extraKeys: { Tab: "emmetExpandAbbreviation", Esc: "emmetResetAbbreviation", Enter: "emmetInsertLineBreak" },
        };
        return obj;
    },
    setCodeMirror: function() {
        const self = this;
        const customCSS = document.querySelector("#brxcCustomCSS");
        const customGlobalCSS = document.querySelector("#brxcCustomGlobalCSS");
        const PlainClasses = document.querySelector("#plainClassesInput");
        let pageCSS = document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.pageSettings.customCss;
        let globalCSS = document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.globalSettings.customCss;

        const codemirrors = document.querySelectorAll("#brxcCSSOverlay.brxc-overlay__wrapper .brxc-codemirror__imported")
        if (customCSS && pageCSS) {
            customCSS.innerHTML = pageCSS
        } else if(customCSS){
            customCSS.innerHTML = '';
        }
        if (customGlobalCSS && globalCSS) {
            customGlobalCSS.innerHTML = globalCSS;
        } else if (customGlobalCSS){
            customGlobalCSS.innerHTML = '';
        }

        [customCSS, customGlobalCSS, PlainClasses, ...codemirrors].forEach(textarea => {
            if (!textarea) return;
            const myCodeMirror = CodeMirror(function(elt) {
                textarea.parentNode.replaceChild(elt, textarea);
            }, self.codeMirrorOptions(textarea));

            if(textarea === customCSS){
                myCodeMirror.setOption("lint", CodeMirror.lint.css);
                myCodeMirror.setOption('autoCloseBrackets', "[]{}''\"\"")
                myCodeMirror.on('change', () => {
                    document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.pageSettings.customCss = myCodeMirror.getValue();
                });
                myCodeMirror.on("keyup", function (cm, event) {
                    if (!cm.state.completionActive &&
                        event.keyCode >= 65 &&
                        event.keyCode <= 90 || 
                        event.keyCode == 56 || 
                        event.keyCode == 189) {
                        CodeMirror.commands.autocomplete(cm, null, {completeSingle: false});
                    }
                });
            } else if(textarea === customGlobalCSS){
                myCodeMirror.setOption("lint", CodeMirror.lint.css);
                myCodeMirror.setOption('autoCloseBrackets', "[]{}''\"\"")
                myCodeMirror.on('change', () => {
                    document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.globalSettings.customCss = myCodeMirror.getValue();
                });
                myCodeMirror.on("keyup", function (cm, event) {
                    if (!cm.state.completionActive &&
                        event.keyCode >= 65 &&
                        event.keyCode <= 90 || 
                        event.keyCode == 56 || 
                        event.keyCode == 189) {
                        CodeMirror.commands.autocomplete(cm, null, {completeSingle: false});
                    }
                });
            } else if(textarea === PlainClasses){
                document.querySelector('#brxcPlainClassesOverlay .CodeMirror').CodeMirror.getMode().name = "text/x-markdown";
                myCodeMirror.setOption('lineNumbers', false);
                myCodeMirror.setOption('autoCloseBrackets', false);
                myCodeMirror.setOption('matchBrackets', false);
                myCodeMirror.setOption('gutters', false);
                myCodeMirror.setOption('lint', false);
                myCodeMirror.setOption('highlightSelectionMatches', false);
                myCodeMirror.setOption("placeholder",'Type your classes here...');
                myCodeMirror.on("keyup", function (cm, event) {
                    if (!cm.state.completionActive && 
                        event.keyCode >= 46 &&
                        event.keyCode <= 90 ||
                        event.keyCode == 109 || event.keyCode == 189) { 
                        CodeMirror.commands.autocomplete(cm, null, {completeSingle: false});
                    }
                });
                myCodeMirror.on("beforeChange", function(cm, changeObj) {
                    var typedNewLine = changeObj.origin == '+input' && typeof changeObj.text == "object" && changeObj.text.join("") == "";
                    if (typedNewLine) {
                        return changeObj.cancel();
                    }
                
                    var pastedNewLine = changeObj.origin == 'paste' && typeof changeObj.text == "object" && changeObj.text.length > 1;
                    if (pastedNewLine) {
                        var newText = changeObj.text.join(" ");
                        return changeObj.update(null, null, [newText]);
                    }
                
                    return null;
                });
            } else {
                myCodeMirror.options['readOnly'] = true;
            }

            CodeMirror.hint.anyword = function (editor) {
                var list = self.globalClasses();
                var cursor = editor.getCursor();
                var currentLine = editor.getLine(cursor.line);
                var start = cursor.ch;
                var end = start;
                var reg = /[\w\-$]+/;
                while (end < currentLine.length && reg.test(currentLine.charAt(end))) ++end;
                while (start && reg.test(currentLine.charAt(start - 1))) --start;
                var curWord = start != end && currentLine.slice(start, end);
                var regex = new RegExp('^' + curWord, 'i');
                var result = {
                    list: (!curWord ? list : list.filter(function (item) {
                        return item.match(regex);
                    })).sort(),
                    from: CodeMirror.Pos(cursor.line, start),
                    to: CodeMirror.Pos(cursor.line, end)
                };

                return result;
            }
            const cssHinter = CodeMirror.hint.css;
            CodeMirror.hint.css = function (editor) {
                const cursor = editor.getCursor();
                const currentLine = editor.getLine(cursor.line);
                let start = cursor.ch;
                let end = start;
                const rex= /[\w\-$]+/; // a pattern to match any characters in our hint "words"
                // Our hints include function calls, e.g. "trap.getSource()"
                // so we search for word charcters (\w) and periods.
                // First (and optional), find end of current "word" at cursor...
                while (end < currentLine.length && rex.test(currentLine.charAt(end))) ++end;
                // Find beginning of current "word" at cursor...
                while (start && rex.test(currentLine.charAt(start - 1))) --start;
                // Grab the current word, if any...
                const curWord = start !== end && currentLine.slice(start, end);
                // Get the default results object from the JavaScript hinter...
                const dflt=cssHinter(editor);
                // If the default hinter didn't hint, create a blank result for now...
                const result = dflt || {list: []};
                // Set the start/end of the replacement range...
                result.to=CodeMirror.Pos(cursor.line, end);
                result.from=CodeMirror.Pos(cursor.line, start);
                // Add our custom hintWords to the list, if they start with the curWord...
                self.cssVariables.forEach(h=>{if (h.includes(curWord)) result.list.push(h);});
                result.list = [...new Set(result.list)];
                result.list.sort(); // sort the final list of hints
                return result;
            }


            CodeMirror.commands.autocomplete = function(cm) {
                var doc = cm.getDoc();
                var POS = doc.getCursor();
                var mode = CodeMirror.innerMode(cm.getMode(), cm.getTokenAt(POS).state).mode.name;
                if (mode == 'css') {
                    cm.showHint(
                        {
                            hint: CodeMirror.hint.css,
                            completeSingle: false,
                        }
                    )
                } else if(mode == 'text/x-markdown') {
                    cm.showHint(
                        {
                            hint: CodeMirror.hint.anyword,
                            completeSingle: false,
                        }
                    )
                } else if(mode == 'cssVariables') {
                    cm.showHint(
                        {
                            hint: CodeMirror.hint.cssVariables,
                            completeSingle: false,
                        }
                    )
                }
            }
        });
        (Object.values(self.globalSettings.globalFeatures).includes('AdvancedCSS')) ? self.switchCodePanels() : '';
    },
    setNewCodeMirror: function(target){
        const self = this;
        const myCodeMirror = CodeMirror(function(elt) {
            target.parentNode.replaceChild(elt, target);
        }, self.codeMirrorOptions(target));
    },
    switchCodePanels: function() {
        const self = this;
        const labels = document.querySelectorAll('#brxcCSSOverlay.brxc-overlay__wrapper .brxc-overlay__panel-switcher-wrapper > [data-code]');
        const colRight = document.querySelector('#brxcCSSOverlay.brxc-overlay__wrapper #brxcCSSColRight');
        const panels = colRight.querySelectorAll('.brxc-overlay-css__wrapper');
        labels.forEach(label => {
            label.onclick = () => {
                labels.forEach(label => {label.classList.remove('active')})
                panels.forEach(panel => {panel.classList.remove('active')})
                label.classList.add('active');
                const attr = label.dataset.code;
                const panel = colRight.querySelector('[data-code="'+ attr +'"]');
                panel.classList.add('active');
                const editor= panel.querySelector('.CodeMirror');
                if (editor) editor.CodeMirror.refresh();
                self.movePanel(document.querySelector('#brxcCSSOverlay .brxc-overlay__pannels-wrapper'), label.dataset.transform);

            };
        })
    },
    forceClassStlyes: () => {
        const classes = document.querySelector('.active-class input[type="text"]');
        const styleTab = Array.from(document.querySelectorAll('ul#bricks-panel-tabs li')).find(el => el.textContent.includes('Style'));
        if(!styleTab) return;
        const contentTab = Array.from(document.querySelectorAll('ul#bricks-panel-tabs li')).find(el => el.textContent.includes('Content'));
        if (parseInt(classes.getAttribute('size')) === 999) {
            const clickEvent = new Event('click');
            contentTab.dispatchEvent(clickEvent);
            styleTab.style.display = 'none';
        } else{
            styleTab.style.display = 'block';
        }
    },
    setPlainClasses: function(){
        const self = this;
        const activeClasses = document.querySelector('#bricks-panel-element-classes .active-class')
        if(!activeClasses) return;

        const icon = activeClasses.querySelector('.plain-classes-icon');
        if (icon) return;

        self.addIconToFields('div','plain-classes-icon', 'Plain Classes', 'top-right', 'ADMINBRXC.openPlainClassesModal(document.querySelectorAll("#bricks-panel-element-classes ul.element-classes li span.name"), "#brxcPlainClassesOverlay" )', false,  "<span class='symbol counter'>P</span>", activeClasses, 'child');
    },
    setexportIDStylestoClass: function(){
        const self = this;
        const els = document.querySelector('#bricks-panel-element-classes')
        if (!els) return;
        const activeClasses = els.querySelector('.active-class')
        if(!activeClasses) return;

        const icon = activeClasses.querySelector('.copy-id-to-class-icon');
        if (icon || self.vueGlobalProp.$_state.activeClass != "") return;

        self.addIconToFields('div','copy-id-to-class-icon', 'Export the styles to a class', 'top-right', 'ADMINBRXC.exportIDStylestoClass()', false,  "<span class='symbol counter'><i class='fas fa-file-export' title='fas fa-file-export'></i></span>", activeClasses, 'child');
        const newIcon = els.querySelector('.copy-id-to-class-icon');
        newIcon.addEventListener('click', (e) => e.stopPropagation());
    },
    setImportIDStylestoClass: function(){
        const self = this;
        const els = document.querySelector('#bricks-panel-element-classes')
        if (!els) return;
        const activeClasses = els.querySelector('.active-class')
        if(!activeClasses) return;

        const icon = activeClasses.querySelector('.copy-class-to-id-icon');
        if (icon || self.vueGlobalProp.$_state.activeClass === "" || self.vueGlobalProp.$_state.activeClass === undefined || self.vueGlobalProp.$_isLocked(self.vueGlobalProp.$_state.activeClass.id)) return;

        self.addIconToFields('div','copy-class-to-id-icon', 'Import styles from the ID element', 'top-right', '', false,  "<span class='symbol counter'><i class='fas fa-file-import' title='fas fa-file-import'></i></span>", activeClasses, 'child');
        const newIcon = els.querySelector('.copy-class-to-id-icon');
        newIcon.addEventListener('click', (e) => {
            e.stopPropagation();
            const newIconHTML = `<span class='symbol counter'><i class='fas fa-file-import' title='fas fa-file-import'></i></span>`;
            newIcon.innerHTML = `<span class='symbol counter'><i class='fas fa-check' title='fas fa-check'></i></span>`;
            newIcon.setAttribute("onClick", "ADMINBRXC.importIDStylestoClass()");
            setTimeout(() => {
                newIcon.innerHTML = newIconHTML;
                newIcon.removeAttribute("onClick");
            }, 2000)
        });
    },
    exportIDStylestoClass: function(){
        const self = this;
        const els = document.querySelector('#bricks-panel-element-classes')
        if (!els) return;
        const wrapper = els.querySelector('.brxc-copy-id-to-class-wrapper')
        if(wrapper) return wrapper.remove();
        const activeClass = els.querySelector('.active-class');
        const inputHTML = `<div class="brxc-copy-id-to-class-wrapper"><input type="text" id="brxc-copy-id-to-class-input" size="999" autocomplete="off" spellcheck="false" placeholder="Type your class name here"><span class="bricks-svg-wrapper create" data-balloon="Create/Update" data-balloon-pos="left"><!--?xml version="1.0" encoding="UTF-8"?--><svg version="1.1" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="bricks-svg"><path d="M362.7,64h-256c-23.7,0 -42.7,19.2 -42.7,42.7v298.7c0,23.5 19,42.7 42.7,42.7h298.7c23.5,0 42.7,-19.2 42.7,-42.7v-256l-85.4,-85.4Zm-106.7,341.3c-35.4,0 -64,-28.6 -64,-64c0,-35.4 28.6,-64 64,-64c35.4,0 64,28.6 64,64c0,35.4 -28.6,64 -64,64Zm64,-213.3h-213.3v-85.3h213.3v85.3Z" fill="currentColor"></path></svg></span><div>`
        activeClass.insertAdjacentHTML('afterend', inputHTML);
        const newWrapper = els.querySelector('.brxc-copy-id-to-class-wrapper')
        const newInput = newWrapper.querySelector('#brxc-copy-id-to-class-input');
        if(!newInput || newInput.dataset.active === "true") return;
        newInput.setAttribute("data-active", "true");
        self.autocomplete(newInput, self.globalClasses(), false);
        const saveBtn = document.querySelector('.brxc-copy-id-to-class-wrapper .bricks-svg-wrapper.create')
        saveBtn.addEventListener("click", function(event) {

            // Create CSS Settings
            const settings = {};
            for (const [key, value] of Object.entries(self.vueGlobalProp.$_state.activeElement.settings)){
                if (key != '_cssGlobalClasses' && key.charAt(0) === '_') {
                    settings[key] = value;
                }
            }
            let isLocked;
            let isUnique = true;
            let idClass;

            const addClass = (id, message, newWrapper) =>{
                // Add class to the element
                if (self.vueGlobalProp.$_state.activeElement.settings.hasOwnProperty('_cssGlobalClasses')) {
                    if (!self.vueGlobalProp.$_state.activeElement.settings._cssGlobalClasses.includes(id)) self.vueGlobalProp.$_state.activeElement.settings._cssGlobalClasses.push(id)
                } else {
                    self.vueGlobalProp.$_state.activeElement.settings._cssGlobalClasses = [];
                    self.vueGlobalProp.$_state.activeElement.settings._cssGlobalClasses.push(id);
                }

                // Remove styles on ID
                for (const [key, value] of Object.entries(self.vueGlobalProp.$_state.activeElement.settings)){
                    if (key != '_cssGlobalClasses' && key.charAt(0) === '_') delete self.vueGlobalProp.$_state.activeElement.settings[key];
                }

                newWrapper.remove();
                self.vueGlobalProp.$_showMessage(message);
            }

            // Check if class exists
            self.vueGlobalProp.$_state.globalClasses.forEach(obj => {
                if (obj.name === newInput.value.replace(/\s+/g, '-')){
                    isUnique = false;
                    idClass = obj.id;
                    isLocked = self.vueGlobalProp.$_isLocked(obj.id);
                    if (!isLocked) for (const [key, value] of Object.entries(settings)){
                        obj.settings[key] = value;
                    }
                } 
            })

            if(isLocked === true){
                newWrapper.remove();
                self.vueGlobalProp.$_showMessage('Abort: the class is locked');
                return;
            }

            if(isUnique === false) {
                addClass(idClass, 'Class Successfully Updated!', newWrapper)
                return;
            }

            // Generate unique ID
            idClass = self.vueGlobalProp.$_generateId()

            // Create the class object
            const newGlobalClass = {
                id: idClass,
                name: newInput.value.replace(/\s+/g, '-'),
                settings: settings
            };

            self.vueGlobalProp.$_state.globalClasses.push(newGlobalClass);
            addClass(idClass, 'Class Successfully Created!', newWrapper)
        });
    },
    importIDStylestoClass: function(){
        const self = this;

        // Create CSS Settings
        const settings = {};
        for (const [key, value] of Object.entries(self.vueGlobalProp.$_state.activeElement.settings)){
            if (key != '_cssGlobalClasses' && key.charAt(0) === '_') {
                settings[key] = value;
            }
        }

        const addClass = (message) =>{

            // Import Styles from ID
            for (const [key, value] of Object.entries(settings)){
                self.vueGlobalProp.$_state.activeClass.settings[key] = value;
                delete self.vueGlobalProp.$_state.activeElement.settings[key]
            }

            self.vueGlobalProp.$_showMessage(message);
        }

        addClass('Styles Successfully Imported to the Class!')



    },
    setVariableAutocomplete: function(){
        const self = this;
        setTimeout(()=> {
            self.fields['CSSVariabe']['includedFields'].forEach(field => {
                const wrappers = Array.from(document.querySelectorAll(field)).filter(item => !item.parentNode.closest(self.fields['CSSVariabe']['excludedFields']) && !item.classList.contains('autocomplete-active'));
                if(wrappers.length < 1) return;
                wrappers.forEach(wrapper => {
                    wrapper.classList.add('autocomplete-active');
                    const input = wrapper.querySelector("input[type=\'text\']");
                    input.addEventListener('click', () => {
                        self.autocomplete(input, self.cssVariables, "style");
                    })
                })
            })
        },0)

    },
    closeStyleTabs: () => {
        const tab = document.querySelector('.bricks-panel-controls ul.control-groups li.control-group.open .control-group-title');
        if(!tab) return;
        tab.dispatchEvent(new Event('click'))
    },
    setActiveStyleTabs: function(){
        const tabWrapper = document.querySelector('#bricks-panel-tabs');
        if (!tabWrapper) return;
        const styleTab = Array.from(tabWrapper.querySelectorAll('li')).filter(item => item.textContent === "Style");
        if(styleTab[0].dataset.listening) return;
        styleTab[0].setAttribute('data-listening', true);
        styleTab[0].setAttribute('onClick', 'ADMINBRXC.closeStyleTabs();');
    },
    showBorderandBoxshadow: function(){
        const self = this;
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        const activeElementID = '#brxe-' + self.vueGlobalProp.$_activeElement._value.id;
        const activeEl = x.document.querySelector(activeElementID);
        activeEl.classList.remove('has-border-settings');
    },
    hideBorderandBoxshadow: function(){
        const self = this;
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        const activeElementID = '#brxe-' + self.vueGlobalProp.$_activeElement._value.id;
        const activeEl = x.document.querySelector(activeElementID);
        activeEl.classList.add('has-border-settings');
    },
    setBorderAndBoxShadow: function(){
        const self = this;
        const els = document.querySelectorAll('[data-control="border"], [data-control="box-shadow"]');
        if (els.length <1 ) return;
        els.forEach(el => {
            const popup = el.querySelector('.bricks-control-popup');
            if (!popup) return;
            self.hideBorderandBoxshadow();
            const observer = new MutationObserver(function(mutations) {
                // check for removed target
                mutations.forEach(function(mutation) {
                  const nodes = Array.from(mutation.removedNodes);
                  const directMatch = nodes.indexOf(popup) > -1
                  if (directMatch) {
                    self.showBorderandBoxshadow();
                  } 
                });
              });
              const config = {
                subtree: true,
                childList: true
              };
            observer.observe(el, config);
        })
    },
    initToolbar: function(){
        const self = this;
        const leftToolbar = document.querySelector('#bricks-toolbar ul.group-wrapper.left');
        const rightToolbar = document.querySelector('#bricks-toolbar ul.group-wrapper.right');
        let elements;
        let structure;
        if (leftToolbar){
            elements = leftToolbar.querySelector('.elements');
        }
        if (rightToolbar){
            structure = rightToolbar.querySelector('.structure');
        }
        (Object.values(self.globalSettings.globalFeatures).includes('GridGuide')) ? self.addMenuItemtoToolbar('grid-guide', 'Grid Guides (ctrl+cmd+' + self.globalSettings.keyboardShortcuts.gridGuides + ')', 'bottom', 'ADMINBRXC.gridGuide(this)', '<i class="bricks-svg ti-layout-grid4-alt" style="opacity: .5;"></i>', leftToolbar,  elements) : '';
        (Object.values(self.globalSettings.globalFeatures).includes('X-Mode')) ? self.addMenuItemtoToolbar('x-mode', 'X-Mode (ctrl+cmd+' + self.globalSettings.keyboardShortcuts.xMode + ')', 'bottom', 'ADMINBRXC.XCode(this)', '<i class="bricks-svg fas fa-border-top-left" style="opacity: .5;"></i>', leftToolbar, elements) : '';
        (Object.values(self.globalSettings.globalFeatures).includes('ContrastChecker')) ? self.addMenuItemtoToolbar('constrast', 'Contrast Checker (ctrl+cmd+' + self.globalSettings.keyboardShortcuts.contrastChecker + ')', 'bottom', 'ADMINBRXC.contrast(this)', '<i class="bricks-svg ion-ios-contrast" style="opacity: .5;"></i>', leftToolbar, elements) : '';
        (Object.values(self.globalSettings.globalFeatures).includes('Darkmode')) ? self.addMenuItemtoToolbar('darkmode', 'Darkmode (ctrl+cmd+' + self.globalSettings.keyboardShortcuts.darkmode + ')', 'bottom', 'ADMINBRXC.darkMode(this)', '<i class="bricks-svg fas fa-moon" style="opacity: .5;"></i>', leftToolbar, elements) : '';
        (Object.values(self.globalSettings.globalFeatures).includes('AdvancedCSS')) ? self.addMenuItemtoToolbar('custom-css', 'Advanced CSS (ctrl+cmd+' + self.globalSettings.keyboardShortcuts.cssStylesheets + ')', 'bottom', 'ADMINBRXC.openModal(false, "#brxcCSSOverlay");document.querySelector("#brxcCSSOverlay .CodeMirror").CodeMirror.setValue(document.querySelector(".brx-body").__vue_app__.config.globalProperties.$_state.pageSettings.customCss);', '<i class="bricks-svg fas fa-code" style="opacity: .5;"></i>', leftToolbar, elements) : '';
        (Object.values(self.globalSettings.themeSettingsTabs).includes('resources') && Object.values(self.globalSettings.globalFeatures).includes('Resources')) ? self.addMenuItemtoToolbar('resources', 'Resources (ctrl+cmd+' + self.globalSettings.keyboardShortcuts.resources + ')', 'bottom', 'ADMINBRXC.openModal(false, "#brxcResourcesOverlay")', '<i class="bricks-svg fas fa-images" style="opacity: .5;"></i>', rightToolbar, structure) : '';
        (Object.values(self.globalSettings.globalFeatures).includes('GlobalAIPanel')) ? self.addMenuItemtoToolbar('openai', 'OpenAI Assistant (ctrl+cmd+' + self.globalSettings.keyboardShortcuts.openai + ')', 'bottom', 'ADMINBRXC.openModal(false, "#brxcGlobalOpenAIOverlay")', '<i class="bricks-svg fas fa-robot" style="opacity: .5;"></i>', rightToolbar, structure) : '';
    },
    setColumnNumber: function(num){
        let style = document.querySelector('#thisisatest');
        if(!style){
            style = document.createElement("STYLE");
            style.setAttribute("id", "thisisatest");
            document.head.appendChild(style);
        }
        style.innerHTML = `#bricks-panel-elements #bricks-panel-elements-categories .sortable-wrapper {grid-template-columns: repeat(${num},1fr) !important;}`;
    },
    setElementsColumns: function(){
        const self = this;
        if (self.vueGlobalProp.$_state.activePanel != 'elements') return;
        const header = document.querySelector('#bricks-panel-inner #bricks-panel-elements #bricks-panel-header')
        if (header.dataset.active === "true") return;
        header.setAttribute("data-active", "true");
        const wrapper = document.createElement("UL");
        wrapper.setAttribute("id", "bricks-panel-view");
        header.after(wrapper);
        self.addIconToFields('li','brxc-header-icon brxc-header-icon__hover', '2-col', 'bottom-right', 'ADMINBRXC.setColumnNumber(2)', true, '<span class="bricks-svg-wrapper"><i class="ti-layout-column2-alt"></i></span>', wrapper, 'child');
        self.addIconToFields('li','brxc-header-icon brxc-header-icon__hover', '3-col', 'bottom-right', 'ADMINBRXC.setColumnNumber(3)', true, '<span class="bricks-svg-wrapper"><i class="ti-layout-column3-alt"></i></span>', wrapper, 'child');
        self.addIconToFields('li','brxc-header-icon brxc-header-icon__hover', '4-col', 'bottom-right', 'ADMINBRXC.setColumnNumber(4)', true, '<span class="bricks-svg-wrapper"><i class="ti-layout-column4-alt"></i></span>', wrapper, 'child');
    },
    highlightClasses: function(){
        const self = this;
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        if (self.vueGlobalProp.$_state.activeClass === "" || self.vueGlobalProp.$_state.activeClass === undefined || self.vueGlobalProp.$_state.activeClass == false) {
            const activeEls = x.document.querySelectorAll('.brxc-active-class');
            if(activeEls.length < 1) return;
            activeEls.forEach(el => el.classList.remove('brxc-active-class'))
        } else {
            const els = x.document.querySelectorAll('.brxc-active-class');
            const activeEls = x.document.querySelectorAll('.' + self.vueGlobalProp.$_state.activeClass.name);
            if(els.length > 0) els.forEach(el => el.classList.remove('brxc-active-class'))
            if(activeEls.length < 1) return;
            activeEls.forEach(el => el.classList.add('brxc-active-class'));
        }
    },
    countClasses: function (){
        const self = this;
        if (self.vueGlobalProp.$_state.activeClass === "" || self.vueGlobalProp.$_state.activeClass == false) return;
        const numClasses = document.querySelector('#bricks-panel #brxcNumClasses');
        if(numClasses) return;
        const activeClasses = document.querySelector('#bricks-panel .active-class .symbol.counter');
        if(!activeClasses) return;
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        if(self.vueGlobalProp.$_state.activeClass === '' || typeof self.vueGlobalProp.$_state.activeClass === 'undefined') return;
        const classes = x.document.querySelectorAll('.' + self.vueGlobalProp.$_state.activeClass.name);
        const numClassesHTML = `<span id="brxcNumClasses" class="symbol counter" data-balloon="Used class on page" data-balloon-pos="top-right">${classes.length}</span>`;
        activeClasses.insertAdjacentHTML('afterend', numClassesHTML);
        if(classes.length < 1) return;
        const icon = document.querySelector('#bricks-panel #brxcNumClasses');
        if(icon.dataset.active === "true") return;
        icon.setAttribute("data-active", "true");
        let i = 0;
        icon.addEventListener('click', (e) => {
            e.stopPropagation();
            classes[i].scrollIntoView({ behavior: "smooth"});
            (i === classes.length - 1) ? i = 0 : i++;
        })
    },
    panelSwitch: function(el){
        const self = this;
        if (el.dataset.panel) self.vueGlobalProp.$_state.activePanelTab = el.dataset.panel;
        if (el.dataset.panelGroup) self.vueGlobalProp.$_state.activePanelGroup = el.dataset.panelGroup;
        const els = document.querySelectorAll('#bricks-panel-element .brxce-panel-shortcut__container > li')
        els.forEach(el => el.classList.remove('active'));
        el.classList.add('active');
    },
    panelShortcuts: function(){
        const self = this;
        if (self.vueGlobalProp.$_state.activePanel !== "element") return;
        const panelElement = document.querySelector('#bricks-panel-element');
        if(!panelElement) return;
        if((Object.values(self.globalSettings.classFeatures).includes("disable-id-styles") && (self.vueGlobalProp.$_state.activeClass === '' || self.vueGlobalProp.$_state.activeClass === undefined || self.vueGlobalProp.$_state.activeClass === false))) {
            const wrapper = panelElement.querySelector('.brxce-panel-shortcut__wrapper');
            (wrapper) ? wrapper.remove() : '';
            panelElement.removeAttribute("data-active");
            return;
        }
        const li = panelElement.querySelectorAll('.brxce-panel-shortcut__container li')
        if(li.length > 0){
            li.forEach(el => el.classList.remove('active'));
            if (self.vueGlobalProp.$_state.activePanelTab === "content") {
                const active = Array.from(li).find(el => el.dataset.panel === "content");
                active.classList.add('active');
            } else if (self.vueGlobalProp.$_state.activePanelGroup) {
                const active = Array.from(li).find(el => el.dataset.panelGroup === self.vueGlobalProp.$_state.activePanelGroup);
                active.classList.add('active');
            }
        }
        if (!panelElement || panelElement.dataset.active === "true") return;
        panelElement.setAttribute("data-active", "true");
        const panelSticky = panelElement.querySelector('#bricks-panel-sticky')
        let wrapper = `<div class="brxce-panel-shortcut__wrapper"><div class="brxce-panel-shortcut__container">`;
        (Object.values(self.globalSettings.shortcutsTabs).includes('content')) ? wrapper += `<li data-panel="content" data-balloon="Content" data-balloon-pos="right" onClick="ADMINBRXC.panelSwitch(this)"><span class="bricks-svg-wrapper"><i class="fas fa-pen"></i></span></li>` : '';
        (Object.values(self.globalSettings.shortcutsTabs).includes('layout')) ? wrapper += `<li data-panel="style" data-panel-group="_layout" data-balloon="Layout" data-balloon-pos="right" onClick="ADMINBRXC.panelSwitch(this)"><span class="bricks-svg-wrapper"><i class="fas fa-layer-group"></i></span></li>` : '';
        (Object.values(self.globalSettings.shortcutsTabs).includes('typography')) ? wrapper += `<li data-panel="style" data-panel-group="_typography" data-balloon="Typography" data-balloon-pos="right" onClick="ADMINBRXC.panelSwitch(this)"><span class="bricks-svg-wrapper"><i class="fas fa-font"></i></span></li>` : '';
        (Object.values(self.globalSettings.shortcutsTabs).includes('background')) ? wrapper += `<li data-panel="style" data-panel-group="_background" data-balloon="Background" data-balloon-pos="right" onClick="ADMINBRXC.panelSwitch(this)" ><span class="bricks-svg-wrapper"><i class="fas fa-image"></i></span></li>` : '';
        (Object.values(self.globalSettings.shortcutsTabs).includes('borders')) ? wrapper += `<li data-panel="style" data-panel-group="_border" data-balloon="Border" data-balloon-pos="right" onClick="ADMINBRXC.panelSwitch(this)"><span class="bricks-svg-wrapper"><i class="fas fa-border-all"></i></span></li>` : '';
        (Object.values(self.globalSettings.shortcutsTabs).includes('gradient')) ? wrapper += `<li data-panel="style" data-panel-group="_gradient" data-balloon="Gradient" data-balloon-pos="right" onClick="ADMINBRXC.panelSwitch(this)"><span class="bricks-svg-wrapper"><i class="fas fa-brush"></i></span></li>` : '';
        (Object.values(self.globalSettings.shortcutsTabs).includes('transform')) ? wrapper += `<li data-panel="style" data-panel-group="_transform" data-balloon="Transform" data-balloon-pos="right" onClick="ADMINBRXC.panelSwitch(this)"><span class="bricks-svg-wrapper"><i class="fas fa-wand-magic-sparkles"></i></span></li>` : '';
        (Object.values(self.globalSettings.shortcutsTabs).includes('css')) ? wrapper += `<li data-panel="style" data-panel-group="_css" data-balloon="CSS" data-balloon-pos="right" onClick="ADMINBRXC.panelSwitch(this)"><span class="bricks-svg-wrapper"><i class="fab fa-css3-alt"></i></span></li>` : '';
        (Object.values(self.globalSettings.shortcutsTabs).includes('attributes')) ? wrapper += `<li data-panel="style" data-panel-group="_attributes" data-balloon="Attributes" data-balloon-pos="right" onClick="ADMINBRXC.panelSwitch(this)"><span class="bricks-svg-wrapper"><i class="fas fa-database"></i></span></li>` : '';
        wrapper += `</div></div>`;
        panelSticky.insertAdjacentHTML('afterend', wrapper);

    },
    runObserver: function() {
        const self = this;

        const panelInner = document.querySelector('#bricks-panel-inner');
        if (!panelInner) return;

        const observer = new MutationObserver(function(mutations) {
            
            // Classes
            (Object.values(self.globalSettings.classFeatures).includes("variable-picker")) ? self.addDynamicVariableIcon() : '';
            (Object.values(self.globalSettings.globalFeatures).includes('GlobalAIPanel')) ? self.addDynamicAIIcon() : '';
            (Object.values(self.globalSettings.classFeatures).includes("color-preview")) ? self.setDynamicColorOnHover() : '';
            (Object.values(self.globalSettings.classFeatures).includes("disable-id-styles")) ? self.forceClassStlyes() : '';
            (Object.values(self.globalSettings.classFeatures).includes("plain-classes")) ? self.setPlainClasses() : '';
            if (Object.values(self.globalSettings.classFeatures).includes("export-styles-to-class")) {
                self.setexportIDStylestoClass();
                self.setImportIDStylestoClass();
            }
            (Object.values(self.globalSettings.classFeatures).includes("highlight-classes")) ? self.highlightClasses() : '';
            (Object.values(self.globalSettings.classFeatures).includes("count-classes")) ? self.countClasses() : '';
            (Object.values(self.globalSettings.classFeatures).includes("extend-classes")) ? self.setExtendClass() : '';
            (Object.values(self.globalSettings.classFeatures).includes("find-and-replace")) ? self.setFindReplace() : '';
            (Object.values(self.globalSettings.classFeatures).includes("autocomplete-variable")) ? self.setVariableAutocomplete() : '';

            // Elements
            (Object.values(self.globalSettings.elementFeatures).includes("pseudo-shortcut") && self.globalSettings.shortcutsIcons.length > 0) ? self.addPanelHeaderIcons() : '';
            (Object.values(self.globalSettings.elementFeatures).includes("parent-shortcut")) ? self.setGoToParentElement() : '';
            (Object.values(self.globalSettings.elementFeatures).includes("close-accordion-tabs")) ? self.setActiveStyleTabs() : '';
            (Object.values(self.globalSettings.elementFeatures).includes("disable-borders-boxshadows")) ? self.setBorderAndBoxShadow(): '';
            (Object.values(self.globalSettings.elementFeatures).includes("resize-elements-icons")) ? self.setElementsColumns() : '';
            (Object.values(self.globalSettings.elementFeatures).includes("lorem-ipsum")) ? self.addDynamicLoremIcon() : '';
            (Object.values(self.globalSettings.elementFeatures).includes("tabs-shortcuts") && self.globalSettings.shortcutsTabs.length > 0) ? self.panelShortcuts() : '';
        });
        observer.observe(panelInner, { subtree: true, childList: true });
    },
    runObserverClasses: function() {
        const self = this;

        const panelInner = document.querySelector('#bricks-panel-inner:not(div.bricks-control-popup *)');
        if (!panelInner) return;

        const observer = new MutationObserver(function(mutations) {
            self.setDynamicClassOnHover();
        });
        observer.observe(panelInner, { 
            subtree: true, 
            childList: true,
            attributes: true,
            attributeFilter: ['class'],
        });
    },
    initObservers: function(){
        const self = this;
        (self.globalSettings.elementFeatures.length > 0 || self.globalSettings.classFeatures.length > 0 ) ? self.runObserver() : '';
        (Object.values(self.globalSettings.elementFeatures).includes("class-preview")) ? self.runObserverClasses() : "";
    },
    setKeyboardShortcuts: function(){
        const self = this;
        const x = document.querySelector('#bricks-builder-iframe').contentWindow;
        document.addEventListener('keydown', function(e) {
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.gridGuides && Object.values(self.globalSettings.globalFeatures).includes('GridGuide')) ? self.gridGuide(document.querySelector('#bricks-toolbar li.grid-guide')) : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.xMode && Object.values(self.globalSettings.globalFeatures).includes('X-Mode')) ? self.XCode(document.querySelector('#bricks-toolbar li.x-mode')) : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.contrastChecker && Object.values(self.globalSettings.globalFeatures).includes('ContrastChecker')) ? self.contrast(document.querySelector('#bricks-toolbar li.constrast')) : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.darkmode && Object.values(self.globalSettings.globalFeatures).includes('Darkmode')) ? self.darkMode(document.querySelector('#bricks-toolbar li.darkmode')) : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.cssStylesheets && Object.values(self.globalSettings.globalFeatures).includes('AdvancedCSS')) ? self.openModal(false, "#brxcCSSOverlay") : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.resources && Object.values(self.globalSettings.globalFeatures).includes('Resources')) ? self.openModal(false, "#brxcResourcesOverlay") : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.openai && Object.values(self.globalSettings.globalFeatures).includes('GlobalAIPanel')) ? self.openModal(false, "#brxcGlobalOpenAIOverlay") : '';
        });
        x.document.addEventListener('keydown', function(e) {
            (e.metaKey && e.ctrlKey && !e.repeat && e.key === self.globalSettings.keyboardShortcuts.gridGuides && Object.values(self.globalSettings.globalFeatures).includes('GridGuide')) ? self.gridGuide(document.querySelector('#bricks-toolbar li.grid-guide')) : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.xMode && Object.values(self.globalSettings.globalFeatures).includes('X-Mode')) ? self.XCode(document.querySelector('#bricks-toolbar li.x-mode')) : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.contrastChecker && Object.values(self.globalSettings.globalFeatures).includes('ContrastChecker')) ? self.contrast(document.querySelector('#bricks-toolbar li.constrast')) : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.darkmode && Object.values(self.globalSettings.globalFeatures).includes('Darkmode')) ? self.darkMode(document.querySelector('#bricks-toolbar li.darkmode')) : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.cssStylesheets && Object.values(self.globalSettings.globalFeatures).includes('AdvancedCSS')) ? self.openModal(false, "#brxcCSSOverlay") : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.resources && Object.values(self.globalSettings.globalFeatures).includes('Resources')) ? self.openModal(false, "#brxcResourcesOverlay") : '';
            (e.metaKey && e.ctrlKey && e.key === self.globalSettings.keyboardShortcuts.openai && Object.values(self.globalSettings.globalFeatures).includes('GlobalAIPanel')) ? self.openModal(false, "#brxcGlobalOpenAIOverlay") : '';
        });
    },
    setDefaultPseudoClasses: function(){
        const pseudoList = document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.pseudoClasses;
        const defaultPseudo = [':before',':after',':hover', ':active', ':focus'];
        defaultPseudo.forEach(pseudo => {
            if (Object.values(pseudoList).indexOf(pseudo) > -1) return;
            document.querySelector('.brx-body').__vue_app__.config.globalProperties.$_state.pseudoClasses.push(pseudo);
        })
    },
    findAndReplace: function(searchValue, replaceValue, property, element, position){
        const self = this;
        property = property.options[property.selectedIndex].value;
        element = element.options[element.selectedIndex].value;
        let content = self.vueGlobalProp.$_state.content;

        function replaceColor(replaceColor){
            const palettes = self.vueGlobalProp.$_state.colorPalette;
            let matchingColor = null;
            palettes.forEach(palette => {
                palette.colors.forEach( color => {
                    for (const [key, value] of Object.entries(color)) {
                        if (color[key] === replaceColor)  {
                            matchingColor = color;
                        }
                    }
                })
            })
            if (matchingColor) return matchingColor;
        }
        function replaceStyle(id){
            const color = replaceColor(replaceValue)
            for(let i = 0; i < content.length; i++){
                for (const [key, value] of Object.entries(content[i])) {
                    if (key === 'id' && value === id ) {
                        for (const [key, value] of Object.entries(content[i].settings)) {
                            if(key === "_cssGlobalClasses") continue ;
                            // Gradients

                            if (property === "_gradient" && key === "_gradient"){
                                if(content[i].settings[key].hasOwnProperty('colors')){
                                    for(let i = 0; i < content[i].settings[key].colors; i++){
                                        if (color) content[i].settings[key].colors[i] = color;
                                    }

                                }
                            }
                            if(property === "all" || key === property) {
                                // Colors
                                if (typeof content[i].settings[key] === "object" && content[i].settings[key].hasOwnProperty('color')){
                                    if (color) content[i].settings[key].color = color;
                                } else {
                                    content[i].settings[key] = JSON.parse(JSON.stringify(value).replace(searchValue, replaceValue));
                                }
                            }
                        }
                    }
                }
            }
        }

        function setStyle(obj, id) {
            // Category check
            if(element === "all" || obj.name === element){
                replaceStyle(id);
            }
            if(Object.keys(obj.children).length > 0){
                Object.keys(obj.children).forEach(function (key){
                    const newObj = self.vueGlobalProp.$_getElementObject(obj.children[key]);
                    setStyle(newObj, obj.children[key]);
                });
            }
        }

        // page

        if(position === "page"){
            content.forEach(child => {
                if(element === "all" || child.name === element){
                    replaceStyle(child.id)
                } 
            })
        } else {
        
            // active element
            const el = self.vueGlobalProp.$_state.activeElement;
            const parentID = el.parent;
            if(!parentID || typeof content == "undefined") return;

            function checkParent(id){
                const obj = self.vueGlobalProp.$_getElementObject(id);
                
                // sibling
                
                if(position === "siblings"){
                    obj.children.forEach(child => {
                        const obj = self.vueGlobalProp.$_getElementObject(child);
                        if(element === "all" || obj.name === element){
                            replaceStyle(child);
                        }
                    })

                // custom postion
                } else {
                    if (obj.name === position){
                        obj.children.forEach(child => {
                            const obj = self.vueGlobalProp.$_getElementObject(child)
                            setStyle(obj, child)
                        })
                    } else {
                        if(obj.parent) checkParent(obj.parent);
                    }
                }
            }

            checkParent(parentID);

        }

        self.vueGlobalProp.$_state.content = content;
        self.vueGlobalProp.$_showMessage('Styles correctly replaced!');
    },
    expandClass: function(type, property, category, position){
        const self = this;
            
        let content = self.vueGlobalProp.$_state.content;
        category = category.options[category.selectedIndex].value;
        property = property.options[property.selectedIndex].value;

        // active element
        const el = self.vueGlobalProp.$_activeElement._value;
        if (!el) return;
        const classes = el.settings._cssGlobalClasses;
        if (type === "Classes" && !classes) return self.vueGlobalProp.$_showMessage('No Class found on the element');
        let styles = [];
        for (const [key, value] of Object.entries(el.settings)) {
            if (key != '_cssGlobalClasses' && key.charAt(0) === '_') styles.push({[key]: value});
        }
        if (type === "Styles" && styles.length < 1) return self.vueGlobalProp.$_showMessage('No Style found on the element');
        const parentID = el.parent;
        if(!parentID || typeof content == "undefined") return;

        function replaceClass(id){
            for(let i = 0; i < content.length; i++){
                for (const [key, value] of Object.entries(content[i])) {
                    if (key === 'id' && value === id) {
                        if(Object.getPrototypeOf(content[i].settings).length === 0) content[i].settings = {};

                        // classes
                        if (type === "Classes") content[i].settings._cssGlobalClasses = [];
                        classes.forEach(el => {
                            content[i].settings._cssGlobalClasses.push(el);
                        })

                        // styles
                        if (type === "Styles") {
                            styles.forEach(style => {
                                for (const [key, value] of Object.entries(style)) {
                                    if(property === "all" || key === property) content[i].settings[key] = value
                                }
                            })
                        }
                    }
                }
            }
        }
        function setClass(obj, id) {
            // Category check
            if(category === "all" || obj.name === category){
                replaceClass(id);
            }
            if(Object.keys(obj.children).length > 0){
                Object.keys(obj.children).forEach(function (key){
                    const newObj = self.vueGlobalProp.$_getElementObject(obj.children[key]);
                    setClass(newObj, obj.children[key]);
                });
            }
        }

        function checkParent(id){
            const obj = self.vueGlobalProp.$_getElementObject(id);
            
            // sibling
            
            if(position === "siblings"){
                obj.children.forEach(child => {
                    const obj2 = self.vueGlobalProp.$_getElementObject(child)
                    if(category === "all" || obj2.name === category){
                        replaceClass(child);
                    }
                })

            // page

            } else if(position === "page"){
                content.forEach(child => {
                    if(category === "all" || child.name === category){
                        replaceClass(child.id);
                    }
                })
            
            // custom container

            } else {
                if (obj.name === position){
                    obj.children.forEach(child => {
                        const obj = self.vueGlobalProp.$_getElementObject(child)
                        setClass(obj, child)
                    })
                } else {
                    if(obj.parent) checkParent(obj.parent);
                }
            }
        }

        checkParent(parentID);
        self.vueGlobalProp.$_state.content = content;
        self.vueGlobalProp.$_showMessage(type + ' correctly extended!');
    },
    setContextualMenuItems: function(){
        const self = this;
        let contextualMenu = document.querySelector("#bricks-builder-context-menu").children[0].children[0];
        let icons = '';
        if(Object.values(self.globalSettings.classFeatures).includes("extend-classes")) icons += `<li id="brxcExpandClasses" onClick='ADMINBRXC.openExtendClassModal("#brxcExtendModal")'>Extend Classes & Styles</li>`;
        if(Object.values(self.globalSettings.classFeatures).includes("find-and-replace")) icons += `<li class="sep" id="brxcFindandReplaceStyles" onClick='ADMINBRXC.openFindReplaceModal(false, "#brxcFindReplaceModal")'>Find & Replace Styles</li>`;

        contextualMenu.insertAdjacentHTML("beforeBegin", icons);
    },
    setHeaderStructurePanel: function(){
        const self = this;
        let header = document.querySelector("#bricks-structure #bricks-panel-header ul.actions li");
        let icons = '';
        if(header && Object.values(self.globalSettings.classFeatures).includes("find-and-replace")) {
            icons += `<li data-balloon="Find & replace" onClick='ADMINBRXC.openFindReplaceModal(true, "#brxcFindReplaceModal")' data-balloon-pos="bottom-right"><span class="bricks-svg-wrapper"><!--?xml version="1.0" encoding="UTF-8"?--><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960" class="bricks-svg"><path xmlns="http://www.w3.org/2000/svg" d="M138 484q18-110 103.838-182T440 230q75 0 133 30.5t98 82.5v-98h72v239H503v-71h100q-27-42-70.5-65T440 325q-72.187 0-130.093 43.5Q252 412 234 484h-96Zm674 492L615 780q-34 27-78 43.5T440.217 840Q367 840 308.5 813 250 786 209 734v93h-72V588h240v71H271q28.269 41.15 72.541 64.075Q387.812 746 440 746q72.102 0 127.444-44.853T642 588h96q-5 33-19 65.5T684 713l197 196-69 67Z"/></svg></span></li>`;
            header.insertAdjacentHTML("beforeBegin", icons);
        }
    },
    setControlsOptions: function(){
        const self = this;
        const allElements = [];
        const allControls = [];

        for (const [key, value] of Object.entries(bricksData.elements)) {
            const el = key;
            allElements.push(el);
            for (const [key, value] of Object.entries(bricksData.elements[el].controls)) {
                if (key.charAt(0) === '_') {
                    allControls.push(key)
                }
            }
        }

        const categoryWrappers = document.querySelectorAll('.brxc-categoryOptions');
        self.globalSettings.elements = [...new Set(allElements)].sort();
        (categoryWrappers.length > 0) ? categoryWrappers.forEach(wrapper => {
            self.globalSettings.elements.forEach(el => {
                wrapper.innerHTML += `<option value="${el}">${el}</option>` 
            })
        }) : '';

        const propertyWrappers = document.querySelectorAll('.brxc-propertyOptions');
        self.globalSettings.styleControls = [...new Set(allControls)].sort();
        (propertyWrappers.length > 0) ? propertyWrappers.forEach(wrapper => {
            self.globalSettings.styleControls.forEach(control => {
                wrapper.innerHTML += `<option value="${control}">${control.substring(1)}</option>` 
            })
        }) : '';


    },
    reorderClasses: function(){
       const self = this;
       if(self.vueGlobalProp.$_state.globalClasses && typeof self.vueGlobalProp.$_state.globalClasses === "object") self.vueGlobalProp.$_state.globalClasses.sort((a, b) => { if (a.name < b.name) return -1; if (a.name > b.name) return 1; return 0; });
    },
    init: function(){
        const self = this;
        self.initObservers();
        self.setIsotope();
        (Object.values(self.globalSettings.globalFeatures).includes('GridGuide')) ? self.initGridGuide() : '';
        self.setCodeMirror();
        self.setKeyboardShortcuts();
        (Object.values(self.globalSettings.classFeatures).includes("autocomplete-variable")) ? self.populateCSSVariables() : '';
        (Object.values(self.globalSettings.globalFeatures).includes('GlobalAIPanel')) ? self.initAcc('.accordion.v1', true) : '';
        (Object.values(self.globalSettings.elementFeatures).includes("pseudo-shortcut")) ? self.setDefaultPseudoClasses() : '';
        (Object.values(self.globalSettings.elementFeatures).includes("resize-elements-icons")) ? self.setElementsColumns() : '';
        self.setContextualMenuItems();
        self.setHeaderStructurePanel();
        self.setControlsOptions();
        self.toggleRadioVisibility();
        (Object.values(self.globalSettings.themeSettingsTabs).includes("class-importer")) ? self.importedClasses() : '';
        (Object.values(self.globalSettings.themeSettingsTabs).includes("grids")) ? self.importedGrids() : '';
        (Object.values(self.globalSettings.classFeatures).includes("reorder-classes")) ? self.reorderClasses() : '';
    }
}
//ADMINBRXC.initPageCSS()
window.addEventListener('DOMContentLoaded', () => {
    if (!Object.values(ADMINBRXC.globalSettings.themeSettingsTabs).includes("builder-tweaks")) {
        return;
    }
    ADMINBRXC.initToolbar();
})
window.addEventListener('load', () => {
    if (!Object.values(ADMINBRXC.globalSettings.themeSettingsTabs).includes("grids")) {
        ADMINBRXC.vueGlobalProp.$_state.globalClasses = ADMINBRXC.vueGlobalProp.$_state.globalClasses.filter(item => !item.id.startsWith("brxc_grid"));
    }
    if (!Object.values(ADMINBRXC.globalSettings.themeSettingsTabs).includes("class-importer")) {
        ADMINBRXC.vueGlobalProp.$_state.globalClasses = ADMINBRXC.vueGlobalProp.$_state.globalClasses.filter(item => !item.id.startsWith("brxc_imported"));
    }
    if (!Object.values(ADMINBRXC.globalSettings.themeSettingsTabs).includes("builder-tweaks")) {
        return;
    }
    ADMINBRXC.init()
    document.querySelectorAll('.brxc-overlay__wrapper').forEach(el => el.removeAttribute('style'));
    (Object.values(ADMINBRXC.globalSettings.elementFeatures).includes("tabs-shortcuts") && ADMINBRXC.globalSettings.shortcutsTabs.length > 0) ? document.body.classList.add('brxc-has-panel-shortcuts') : '';
})