var brfPanel,bricksforgeData={panel:{}};class BricksforgePanel{domContentLoadedEvent;currentUserRole;roles;hideElementsOnly=!1;timelines=[];splitTextInstances=[];timelineActions=[];constructor(e){e&&(this.domContentLoadedEvent=e),this.init()}async init(){this.setGlobals(),"undefined"!=typeof BRFVARS&&1==BRFVARS.panelActivated&&(bricksIsFrontend||this.loadPanel(),setTimeout((()=>{this.renderPanel()}))),this.renderLogic(),this.hideElementsOnly&&this.handlePermissionSettings()}setGlobals(){if("undefined"!=typeof BRFVARS&&(this.currentUserRole=BRFVARS.currentUserRole,this.roles=BRFVARS.permissions,this.roles&&Array.isArray(this.roles)))for(let e of this.roles)e.value==this.currentUserRole&&(this.hideElementsOnly=e.permissions.hideOnly)}renderLogic(){document.addEventListener("click",(e=>{const t=e.target;t instanceof HTMLElement&&"BUTTON"==t.tagName&&"brf-render"==t.parentNode.getAttribute("controlkey")&&(e.preventDefault(),document.querySelector("li.reload-canvas").click())}))}loadPanel(){let e=document.createElement("div");e.setAttribute("id","bricksforge-triggers"),document.querySelector("#bricks-preview")&&document.querySelector("#bricks-preview").appendChild(e);let t=document.querySelector("#bricks-toolbar ul.group-wrapper.left"),a=document.createElement("li");a.classList.add("brf-panel"),a.setAttribute("data-balloon","Bricksforge Panel (Shortcut: CTRL + P)"),a.setAttribute("data-balloon-pos","bottom");let n=document.createElement("span");n.classList.add("bricks-svg-wrapper"),a.appendChild(n),t&&t.appendChild(a),setTimeout((()=>{document.querySelector("#bricksforge-triggers .brf-triggers-container")&&(document.querySelector("#bricksforge-triggers .brf-triggers-container").style.bottom="-"+document.querySelector("#bricksforge-triggers .brf-triggers-container").getAttribute("data-height"))}),500),a.addEventListener("click",(()=>{const e=new Proxy(new URLSearchParams(window.location.search),{get:(e,t)=>e.get(t)});let t=document.querySelector("#bricksforge-triggers .brf-triggers-container");if(t.style.bottom&&1==t.style.opacity){if(t.style.bottom="-"+t.getAttribute("data-height"),t.style.opacity=0,e["brf-panel"]){const e=new URL(window.location.href);e.searchParams.delete("brf-panel"),window.history.replaceState(null,null,e),bricksforgeData.panel.isOpen=!1}}else if(t.style.bottom="-2px",t.style.opacity=1,!e["brf-panel"]){const e=new URL(window.location.href);e.searchParams.set("brf-panel","1"),window.history.replaceState(null,null,e),bricksforgeData.panel.isOpen=!0}}))}handlePermissionSettings(){document.addEventListener("mousedown",(e=>{let t=e.target;t&&(t.matches("li.elements")||t.closest("li")&&t.closest("li").classList.contains("elements"))&&setTimeout((()=>{this.hideCategories()}),250)})),setTimeout((()=>{this.hideCategories()}),750)}hideCategories(){for(let e of document.querySelectorAll("#bricks-panel-elements-categories .category")){if(!(e.classList.contains("category-layout")||e.classList.contains("category-basic")||e.classList.contains("category-general")||e.classList.contains("category-media")||e.classList.contains("category-wordpress")||e.classList.contains("category-single"))){let t=e.querySelector(".sortable-wrapper").querySelectorAll("li");for(let e of t)e.setAttribute("style","display:block !important");return}let t=e.querySelector(".sortable-wrapper").querySelectorAll("li"),a=!0;for(let e of t)"none"!=getComputedStyle(e).display&&(a=!1);a&&(e.style.display="none")}}renderPanel(e=!1,t=[],a=!1,n=!1){if(!BRFVARS||!BRFVARS.panel||!BRFVARS.panel.length){if(n){this.timelines=[];for(let e of t)this.handleTimeline(e,!1,a);return}return}if(n){this.timelines=[];for(let e of t)this.handleTimeline(e,!1,!0);return}if(0==e&&bricksIsFrontend){let e=BRFVARS.panel[0].instances;if(e&&e.length>0)for(let t of e){this.checkInstanceConditions({data:t,trigger:t.selector?t.selector:null,target:null})&&!t.disabled&&this.handleInstance(t)}}let i=BRFVARS.panel[0].timelines;if(!0===e&&(this.timelines=[],i=[],i.push(t)),!0===a&&(this.timelines=[],i=[],i=t),i&&i.length>0){if("undefined"==typeof gsap)return void console.warn("Bricksforge Panel: You try to use timelines, but GSAP is not loaded.");for(let t of i)if(!t.disabled)if(t.matchMedia){gsap.matchMedia().add(t.matchMedia,(()=>{this.handleTimeline(t,e,a)}))}else this.handleTimeline(t,e,a)}}checkInstanceConditions(e){let t=e.data;if(!t.conditions||!t.conditions.length)return!0;let a=t.conditionsRelation?t.conditionsRelation:"and",n=[];for(let a of t.conditions)switch(a.type){case"elementNode":if(!a.elementNodeSelector||!a.elementNodeSelector||!a.elementNodeOption){n.push(!1);break}let t=document.querySelector(a.elementNodeSelector);if(!t){n.push(!1);break}switch(a.elementNodeOption){case"class":if(!a.elementNodeValue){n.push(!1);break}if("has"==a.elementNodeOperator){if(t.classList.contains(a.elementNodeValue)){n.push(!0);break}n.push(!1);break}if("notHas"==a.elementNodeOperator){if(t.classList.contains(a.elementNodeValue)){n.push(!1);break}n.push(!0);break}break;case"attribute":if(!a.elementNodeValue){n.push(!1);break}if(!a.elementNodeAttribute){n.push(!1);break}if("has"==a.elementNodeOperator){if(t.getAttribute(a.elementNodeAttribute)==a.elementNodeValue){n.push(!0);break}n.push(!1);break}if("notHas"==a.elementNodeOperator){if(t.getAttribute(a.elementNodeAttribute)!=a.elementNodeValue){n.push(!0);break}n.push(!1);break}}break;case"localStorage":if(!a.localStorageKey||!a.localStorageOperator){n.push(!1);break}switch(a.localStorageOperator){case"exists":n.push(null!=localStorage.getItem(a.localStorageKey));break;case"notExists":n.push(!localStorage.getItem(a.localStorageKey));break;case"==":n.push(localStorage.getItem(a.localStorageKey)==a.localStorageValue);break;case"!=":n.push(localStorage.getItem(a.localStorageKey)!=a.localStorageValue);break;case">":n.push(localStorage.getItem(a.localStorageKey)>parseInt(a.localStorageValue));break;case"<":n.push(localStorage.getItem(a.localStorageKey)<parseInt(a.localStorageValue));break;case">=":n.push(localStorage.getItem(a.localStorageKey)>=parseInt(a.localStorageValue));break;case"<=":n.push(localStorage.getItem(a.localStorageKey)<=parseInt(a.localStorageValue))}break;case"sessionStorage":if(!a.localStorageKey||!a.localStorageOperator){n.push(!1);break}switch(a.localStorageOperator){case"exists":n.push(null!=sessionStorage.getItem(a.localStorageKey));break;case"notExists":n.push(!sessionStorage.getItem(a.localStorageKey));break;case"==":n.push(sessionStorage.getItem(a.localStorageKey)==a.localStorageValue);break;case"!=":n.push(sessionStorage.getItem(a.localStorageKey)!=a.localStorageValue);break;case">":n.push(sessionStorage.getItem(a.localStorageKey)>parseInt(a.localStorageValue));break;case"<":n.push(sessionStorage.getItem(a.localStorageKey)<parseInt(a.localStorageValue));break;case">=":n.push(sessionStorage.getItem(a.localStorageKey)>=parseInt(a.localStorageValue));break;case"<=":n.push(sessionStorage.getItem(a.localStorageKey)<=parseInt(a.localStorageValue))}break;case"custom":if(!a.customCondition){n.push(!1);break}let i=e.trigger?e.trigger:null,o=e.target?e.target:null,r=new Function("return ((trigger, target) => {return "+a.customCondition+"})")();if("function"!=typeof r){n.push(!1);break}n.push(!0===r(i,o))}if(!n.length)return!1;switch(a){case"and":return!n.includes(!1);case"or":return n.includes(!0);default:return!1}}async handleInstance(e){if(!e.event||!e.selector||!e.actions.length){if(!e.selector&&"pageLoad"!=e.event&&!e.selector&&"scrollPosition"!=e.event&&"scrollUp"!=e.event&&"scrollDown"!=e.event&&"visibilitychange"!=e.event&&"resize"!=e.event&&"sliderMove"!=e.event&&"sliderMoved"!=e.event&&"sliderVisible"!=e.event&&"sliderHidden"!=e.event&&"sliderClick"!=e.event&&"sliderResize"!=e.event&&"sliderResized"!=e.event&&"sliderDrag"!=e.event&&"sliderDragging"!=e.event&&"sliderDragged"!=e.event&&"sliderOverflow"!=e.event)return void console.warn("You try to use the Bricksforge Panel, but there are some informations missing. This warning appears for the instance: "+(e.name?e.name:"No Name"));e.selector="html"}let t=e.selector,a=!1,n=e.event,i=e.actions,o=!!e.delay&&e.delay;switch(o&&await this.wait(o),e.selectorType){case"exactly":default:t=document.querySelector(t);break;case"all":t=document.querySelectorAll(t),a=!0;break;case"siblings":t=document.querySelector(t).parentNode.children,a=!0;break;case"parent":t=document.querySelector(t).parentNode;break;case"children":t=document.querySelector(t).children,a=!0;break;case"closest":if(!e.closestValue)break;t=document.querySelector(t).closest(e.closestValue)}if(null!=t)for(let o of i){let i=o.action.target,s=o.action.targetElement,l=!1;switch(i){case"same":default:if(!t)break;i=document.querySelector(e.selector);break;case"triggered":i="triggered";break;case"all":if(!t)break;i=document.querySelectorAll(e.selector),l=!0;break;case"siblings":if(!t)break;i=document.querySelector(e.selector).parentNode.children,l=!0;break;case"parent":if(!t)break;i=document.querySelector(e.selector).parentNode;break;case"children":if(!t)break;i=document.querySelector(e.selector).children,l=!0;break;case"closest":if(!t)break;if(!i)break;i=document.querySelector(e.selector).closest(s);break;case"querySelector":if(!t)break;i=document.querySelector(e.selector).querySelector(s);break;case"custom":i=document.querySelector(s);break;case"customAll":i=document.querySelectorAll(s),l=!0}switch(n){case"scrollPosition":document.addEventListener("scroll",(a=>{if(e.consoleLog&&"event"==e.consoleLog&&console.log(a),!e.scrollPosition||!e.scrollPositionOperator)return;let n;switch(e.scrollPositionOperator){case"==":default:n=window.scrollY==e.scrollPosition;break;case">":n=window.scrollY>e.scrollPosition;break;case"<":n=window.scrollY<e.scrollPosition;break;case">=":n=window.scrollY>=e.scrollPosition;break;case"<=":n=window.scrollY<=e.scrollPosition}n&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o})}));break;case"scrollUp":var r=0;document.addEventListener("scroll",(a=>{var n=window.pageYOffset||document.documentElement.scrollTop;n<r&&(e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o})),r=n<=0?0:n}),!1);break;case"scrollDown":r=0;document.addEventListener("scroll",(a=>{var n=window.pageYOffset||document.documentElement.scrollTop;n>r&&(e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o})),r=n<=0?0:n}),!1);break;case"inViewport":if(!t)return;document.addEventListener("scroll",(n=>{if(a)t.forEach((t=>{var a=t.getBoundingClientRect(),r=a.top,s=a.bottom;let c=e.inViewportVisibility?e.inViewportVisibility:"partially",u=e.inViewportVisibilityOffset?e.inViewportVisibilityOffset:0;("partially"==c?r<window.innerHeight-u&&s>=0:r>=0&&s<=window.innerHeight+u)&&(e.consoleLog&&"event"==e.consoleLog&&console.log(n),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:n,actionDataRaw:o}))}));else{var r=t.getBoundingClientRect(),s=r.top,c=r.bottom;let a=e.inViewportVisibility?e.inViewportVisibility:"partially",u=e.inViewportVisibilityOffset?e.inViewportVisibilityOffset:0;("partially"==a?s<window.innerHeight-u&&c>=0:s>=0&&c<=window.innerHeight+u)&&(e.consoleLog&&"event"==e.consoleLog&&console.log(n),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:n,actionDataRaw:o}))}}));break;case"notInViewport":if(!t)return;document.addEventListener("scroll",(n=>{if(a)t.forEach((t=>{var a=t.getBoundingClientRect(),r=a.top,s=a.bottom;r<window.innerHeight&&s>=0||(e.consoleLog&&"event"==e.consoleLog&&console.log(n),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:n,actionDataRaw:o}))}));else{var r=t.getBoundingClientRect(),s=r.top,c=r.bottom;s<window.innerHeight&&c>=0||(e.consoleLog&&"event"==e.consoleLog&&console.log(n),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:n,actionDataRaw:o}))}}));break;case"pageLoad":this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:this.domContentLoadedEvent,actionDataRaw:o});break;case"visibilitychange":document.addEventListener("visibilitychange",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),e.visibilityState&&document.visibilityState==e.visibilityState&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o})}));break;case"resize":window.addEventListener("resize",(a=>{if(e.consoleLog&&"event"==e.consoleLog&&console.log(a),e.resizeDimension&&e.resizeOperator&&e.resizeValue)switch(e.resizeOperator){case"==":"width"==e.resizeDimension&&window.innerWidth==e.resizeValue&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o}),"height"==e.resizeDimension&&window.innerHeight==e.resizeValue&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o});break;case">":"width"==e.resizeDimension&&window.innerWidth>e.resizeValue&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o}),"height"==e.resizeDimension&&window.innerHeight>e.resizeValue&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o});break;case"<":"width"==e.resizeDimension&&window.innerWidth<e.resizeValue&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o}),"height"==e.resizeDimension&&window.innerHeight<e.resizeValue&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o});break;case">=":"width"==e.resizeDimension&&window.innerWidth>=e.resizeValue&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o}),"height"==e.resizeDimension&&window.innerHeight>=e.resizeValue&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o});break;case"<=":"width"==e.resizeDimension&&window.innerWidth<=e.resizeValue&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o}),"height"==e.resizeDimension&&window.innerHeight<=e.resizeValue&&this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o});break;default:this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o})}else this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o})}));break;case"resizeObserver":if(!t)return;new ResizeObserver((a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o})})).observe(t);break;case"mutationObserver":if(!t)return;if(a)t.forEach((t=>{let a=!!e.mutationObserverAttributes&&e.mutationObserverAttributes,n=!!e.mutationObserverChildList&&e.mutationObserverChildList,r=!!e.mutationObserverCharacterData&&e.mutationObserverCharacterData,s=!!e.mutationObserverSubTree&&e.mutationObserverSubTree;new MutationObserver((a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o})})).observe(t,{attributes:a,childList:n,characterData:r,subtree:s})}));else{let a=!!e.mutationObserverAttributes&&e.mutationObserverAttributes,n=!!e.mutationObserverChildList&&e.mutationObserverChildList,r=!!e.mutationObserverCharacterData&&e.mutationObserverCharacterData,s=!!e.mutationObserverSubTree&&e.mutationObserverSubTree;new MutationObserver((a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,actionData:o.action,event:a,actionDataRaw:o})})).observe(t,{attributes:a,childList:n,characterData:r,subtree:s})}break;case"sliderMove":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("move",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"sliderMoved":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("moved",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"sliderVisible":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("visible",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"sliderHidden":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("hidden",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"sliderClick":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("click",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"sliderResize":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("resize",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"sliderResized":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("resized",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"sliderDrag":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("drag",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"sliderDragging":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("dragging",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"sliderDragged":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("dragged",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"sliderOverflow":if(!this.handleSliderEvent(e.sliderId))break;this.handleSliderEvent(e.sliderId).on("overflow",(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;case"custom":if(!e.customEventName)break;if(a){Array.prototype.forEach.call(t,(t=>{t.addEventListener(e.customEventName,(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}))}));break}t.addEventListener(e.customEventName,(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}));break;default:if(a){Array.prototype.forEach.call(t,(t=>{t.addEventListener(n,(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}))}));break}t.addEventListener(n,(a=>{e.consoleLog&&"event"==e.consoleLog&&console.log(a),this.fireAction({action:o.action.value,selector:t,target:i,queryAll:l,instance:e,event:a,actionData:o.action,actionDataRaw:o})}))}}}async fireAction(e){let t=e.instance,a=e.action,n=e.actionData,i=e.selector,o=e.target,r=e.queryAll,s=!!e.event&&e.event.target,l=e.actionDataRaw,c=!!n.delay&&n.delay;if(!a||!i||!o)return;if(l.conditions&&l.conditions.length>0){if(!this.checkInstanceConditions({data:l,trigger:i,target:o}))return}c&&await this.wait(c);let u=n.except&&"none"!=n.except,g=!!n.exceptSelector&&n.exceptSelector,d=s;switch(u&&!1!==g&&s&&s!=document.querySelector(g)&&(d=s.closest(g)),"triggered"==o&&(o=s!=document.querySelector(t.selector)?s.closest(t.selector):document.querySelector(t.selector)),a){case"show":if(r)for(let e of o)u&&d==e||(e.style.display=n.display?n.display:"block");else o.style.display=n.display?n.display:"block";break;case"hide":if(r)for(let e of o)u&&d==e||(e.style.display="none");else o.style.display="none";break;case"addClass":if(!n.cssClass)return;if(r)for(let e of o)u&&d==e||e.classList.add(n.cssClass);else o.classList.add(n.cssClass);break;case"removeClass":if(!n.cssClass)return;if(r)for(let e of o)u&&d==e||e.classList.remove(n.cssClass);else o.classList.remove(n.cssClass);break;case"toggleClass":if(!n.cssClass)return;if(r)for(let e of o)u&&d==e||e.classList.toggle(n.cssClass);else o.classList.toggle(n.cssClass);break;case"setAttribute":if(!n.attributeKey||!n.attributeValue)return;if(r)for(let e of o)u&&d==e||e.setAttribute(n.attributeKey,n.attributeValue);else o.setAttribute(n.attributeKey,n.attributeValue);break;case"removeAttribute":if(!n.attributeKeyRemoval)return;if(r)for(let e of o)u&&d==e||e.removeAttribute(n.attributeKeyRemoval);else o.removeAttribute(n.attributeKeyRemoval);break;case"gsap":if("pageLoad"==t.event&&await this.wait(0),!n.animationAction||!n.animationTimeline)return;let a=n.animationAction,l=n.animationTimeline,c=n.animationSelectorType?n.animationSelectorType:"all",g=[];"all"==c&&(g=this.timelines.filter((e=>e.id==l))),"trigger"==c&&(g=this.timelines.filter((e=>{let t=[...s.getElementsByTagName("*")].includes(e.trigger),a=e.trigger.contains(s);return!(e.id!=l||e.trigger!=s&&!t&&!a)}))),g.forEach((e=>{let t=e.tl;switch(a){case"play":t.play();break;case"pause":t.pause();break;case"restart":t.restart();break;case"resume":t.resume();break;case"reverse":t.reverse()}}));break;case"jsFunction":if(!n.jsFunctionName)return;let f=e.event,p=n.jsFunctionName,m=new Function("return (async (trigger, event, timelines, getTimeline) => {"+p+"})")();"function"==typeof m&&(async()=>{const e=await this.getTimelines();await m(i,f,e,(async e=>await this.getTimelineById(e)))})();break;case"gsapFlip":if(!o)return;gsap.registerPlugin(Flip);let h=e.actionData.flipStylesProps?e.actionData.flipStylesProps:"",b=e.actionData.flipEase?e.actionData.flipEase:"power1.inOut",y=e.actionData.flipDuration?e.actionData.flipDuration:1,v=!!e.actionData.flipIncludeChildren&&e.actionData.flipIncludeChildren,S=!!e.actionData.flipAbsolute&&e.actionData.flipAbsolute;if(r)for(let t of o){if(u&&d==t)continue;const a=Flip.getState(1==v?[t,...t.children]:t,{props:h});if(o.style.transition="none",v)for(let e of o.children)e.style.transition="none";switch(e.actionData.flipStylesInput){case"custom":if(!e.actionData.flipStylesCode)break;let a=new Function("return ((trigger, target, event) => {"+e.actionData.flipStylesCode+"})")();"function"==typeof a&&a(i,t,e.event);break;case"removeClass":if(!e.actionData.flipStylesInputClassName)return;t.classList.remove(e.actionData.flipStylesInputClassName);break;case"addClass":if(!e.actionData.flipStylesInputClassName)return;t.classList.add(e.actionData.flipStylesInputClassName);break;case"toggleClass":if(!e.actionData.flipStylesInputClassName)return;t.classList.toggle(e.actionData.flipStylesInputClassName);break;case"appendTo":if(!e.actionData.flipStylesInputDOMElement)return;document.querySelector(e.actionData.flipStylesInputDOMElement).append(t)}Flip.from(a,{duration:y,ease:b,absolute:S,nested:!0})}else{const t=Flip.getState(1==v?[o,...o.children]:o,{props:h});if(o.style.transition="none",v)for(let e of o.children)e.style.transition="none";switch(e.actionData.flipStylesInput){case"custom":if(!e.actionData.flipStylesCode)break;let t=new Function("return ((trigger, target, event) => {"+e.actionData.flipStylesCode+"})")();"function"==typeof t&&t(i,o,e.event);break;case"removeClass":if(!e.actionData.flipStylesInputClassName)return;o.classList.remove(e.actionData.flipStylesInputClassName);break;case"addClass":if(!e.actionData.flipStylesInputClassName)return;o.classList.add(e.actionData.flipStylesInputClassName);break;case"toggleClass":if(!e.actionData.flipStylesInputClassName)return;o.classList.toggle(e.actionData.flipStylesInputClassName);break;case"appendTo":if(!e.actionData.flipStylesInputDOMElement)return;document.querySelector(e.actionData.flipStylesInputDOMElement).append(o)}Flip.from(t,{duration:y,ease:b,absolute:S})}break;case"gsapSet":if(!o)return;if(r)for(let t of o){let a=n.gsapSetObject,r=new Function("return (trigger, target, event) => { return "+a+" }")();gsap.set(o,"function"==typeof r?r(i,t,e.event):{})}else{let t=n.gsapSetObject,a=new Function("return (trigger, target, event) => { return "+t+" }")();gsap.set(o,"function"==typeof a?a(i,o,e.event):{})}break;case"gsapTo":if(!o)return;if(r)for(let t of o){let a=n.gsapSetObject,r=new Function("return (trigger, target, event) => { return "+a+" }")();gsap.to(o,"function"==typeof r?r(i,t,e.event):{})}else{let t=n.gsapSetObject,a=new Function("return (trigger, target, event) => { return "+t+" }")();gsap.to(o,"function"==typeof a?a(i,o,e.event):{})}break;case"video_self_hosted_play":if(!o)return;if(r)for(let e of o)u&&d==e||e.play();else o.play();break;case"video_self_hosted_pause":if(!o)return;if(r)for(let e of o)u&&d==e||e.pause();else o.pause();break;case"video_self_hosted_stop":if(!o)return;if(r)for(let e of o)u&&d==e||(e.pause(),e.currentTime=0);else o.pause(),o.currentTime=0;break;case"storageSetItem":if(!e.actionData.storageItemKey||!e.actionData.storageItemValue)return;localStorage.setItem(e.actionData.storageItemKey,e.actionData.storageItemValue);break;case"storageRemoveItem":if(!e.actionData.storageItemKey)return;localStorage.removeItem(e.actionData.storageItemKey);break;case"sessionStorageSetItem":if(!e.actionData.storageItemKey||!e.actionData.storageItemValue)return;sessionStorage.setItem(e.actionData.storageItemKey,e.actionData.storageItemValue);break;case"sessionStorageRemoveItem":if(!e.actionData.storageItemKey)return;sessionStorage.removeItem(e.actionData.storageItemKey);break;case"syncSliders":let w=e.actionData.syncSliderData;if(!w||!w.length){console.warn('Bricksforge Panel: You try to use "syncSliders" action, but we found no data for it.');break}for(let e of w){let t=e.slider1,a=e.slider2;t&&a&&(t=bricksData.splideInstances[t],a=bricksData.splideInstances[a],t&&a&&t.sync(a))}}}handleTimeline(e,t=!1,a=!1){bricksIsFrontend||gsap.config({nullTargetWarn:!1}),e.animations&&e.animations.length||console.warn("Bricksforge Panel: You try to use timelines, but we found no animations for it. This warning appears for the timeline: "+e.name);let n=e.repeat?parseInt(e.repeat):0,i=e.repeatDelay?parseInt(e.repeatDelay):0,o=e.trigger?e.trigger:"scrollTrigger",r=e.triggerSelector?e.triggerSelector:"",s=!!e.animateTrigger&&e.animateTrigger,l=null!=e.scrub&&e.scrub,c=e.scrubValue?e.scrubValue:1,u=e.scrollStart?e.scrollStart:"top bottom",g=e.scrollEnd?e.scrollEnd:"bottom top",d=null!=e.pin&&e.pin,f=!e.pinSelector||e.pinSelector,p=null!=e.pinSpacing&&e.pinSpacing,m=null!=e.markers&&e.markers,h=null!=e.stagger&&e.stagger,b=e.staggerAmount?e.staggerAmount:.2,y=e.staggerFrom?e.staggerFrom:"start",v=e.staggerEase?e.staggerEase:"linear",S=e.toggleActions?e.toggleActions:"play none none none",w=null!=e.snap&&e.snap,k=!!e.snapTo&&e.snapTo,D=e.snapDuration?e.snapDuration:.3,A=e.snapDelay?e.snapDelay:.1,I=e.snapEase?e.snapEase:"power1.inOut",L=!!e.toggleClass&&e.toggleClass,T=e.toggleClassTargets?e.toggleClassTargets:"",R=e.toggleClassClassName?e.toggleClassClassName:"",C=null!=e.batch&&e.batch;if("scrollTrigger"===o)bricksIsFrontend&&gsap.registerPlugin(ScrollTrigger);if(!r||"."==r||!this.isValidSelector(r)){if("custom"!=o)return;r="html"}gsap.utils.toArray(r).forEach(((E,V)=>{if(C&&(s=!1,V>=1))return;const q=gsap.timeline({repeat:n,repeatDelay:i,..."scrollTrigger"==o&&e.animations.length&&bricksIsFrontend&&!C&&{scrollTrigger:{...1==L&&{toggleClass:{targets:T,className:R}},trigger:E,markers:m,start:u,...1==w&&{snap:{snapTo:k,duration:D,delay:A,ease:I}},toggleActions:S,end:g,...1==l&&{scrub:c},...1==d&&f&&{pin:f||!0,pinSpacing:p}}}});!0===a&&q.pause(),"custom"==o&&q.pause();for(let n of e.animations){if(!(!0!==a||n.selector&&"."!=n.selector&&document.querySelector(n.selector))){let e=!0===s&&r?r:".brf-dummy";if(q.to(e,{duration:1}),bricksIsFrontend)continue}if(!n.selector&&!1===s){bricksIsFrontend&&console.warn("Bricksforge Panel: You try to use timeline animations, but we found no selector for it. This warning appears for the timeline: "+e.name);continue}if("."==n.selector&&!1===s||!1===s&&!document.querySelector(n.selector))continue;if(!(n.data&&""!=n.data||n.controls&&0!==Object.keys(n.controls).length)&&bricksIsFrontend){console.warn("Bricksforge Panel: You try to use timeline animations, but we found no animation data for it. This warning appears for the timeline: "+e.name);continue}let i=n.controls?n.controls:{};Object.keys(i).forEach((e=>{null===i[e]&&delete i[e]}));let o,V=n.controls2?n.controls2:{};Object.keys(V).forEach((e=>{null===V[e]&&delete V[e]}));try{o=new Function("return (trigger, target) => {return "+n.data.replace(/cssVar\((.*?)\)/g,((e,t)=>this.cssVar(t.trim())))+"}")(this)}catch(e){if(o=new Function,bricksIsFrontend)continue}try{o(r,n.selector)}catch(t){if(o=new Function,console.warn("Bricksforge Panel: You try to use timeline animations, but your Animation data object seems to be wrong. This warning appears for the timeline: "+e.name),bricksIsFrontend)continue}let O,N=o(r,n.selector),F=n.duration?n.duration:.5,P=n.delay?n.delay:0,z=n.position?n.position:"default",K=n.customPosition?n.customPosition:">",B=n.ease?n.ease:"linear",x=!!n.splitText&&n.splitText,H=n.splitTextType?n.splitTextType:"chars",M=!!n.stagger&&n.stagger,Y=n.staggerValue?n.staggerValue:.02;switch(z){case"<":case">":O=z;break;case"custom":O=this.isNumeric(K)?parseFloat(K):K;break;default:O=">"}!0===t&&gsap.set(n.selector,{clearProps:"all"});let j=!0===s&&r?n.childSelector?(bricksIsFrontend,E.querySelector(n.childSelector)):E:n.selector;if(j||(j=".brf-dummy"),bricksIsFrontend||q.pause(),!0===x){let e;gsap.registerPlugin(SplitText);let t=this.splitTextInstances.find((e=>e.id==n.id));switch(bricksIsFrontend?e=new SplitText(j,{type:"chars,words,lines"}):(t?e=t:(e=this.splitTextInstances.push({id:n.id,type:n.splitTextType,data:new SplitText(j,{type:"chars,words,lines"})}),e=this.splitTextInstances.find((e=>e.id==n.id))),e=e.data),H){case"chars":j=e.chars;break;case"words":j=e.words;break;case"lines":j=e.lines}}if(void 0===this.timelineActions.find((e=>e.finalSelector==j&&e.id==n.id))||!bricksIsFrontend){switch(n.method){case"from":C&&bricksIsFrontend?ScrollTrigger.batch(j,{once:1==l||S&&"none"==S.split(" ")[2],markers:m,start:u,end:g,...1==L&&{toggleClass:{targets:T,className:R}},onEnter:(e,t)=>{q.from(e,{duration:F,delay:P,...N,...i,ease:B,...!0===M&&{stagger:Y},...!M&&h&&{stagger:{from:y,amount:b,ease:v}},scrollTrigger:{trigger:e,toggleActions:S,...1==w&&{snap:{snapTo:k,duration:D,delay:A,ease:I}},...1==d&&f&&{pin:f||!0,pinSpacing:p},...1==l&&{scrub:c}}})},animationPositionValue:O}):q.from(j,{duration:F,delay:P,...N,...i,ease:B,...!0===M&&{stagger:Y},...!M&&h&&{stagger:{from:y,amount:b,ease:v}}},O);break;case"to":C&&bricksIsFrontend?ScrollTrigger.batch(j,{once:1==l||S&&"none"==S.split(" ")[2],markers:m,start:u,end:g,...1==L&&{toggleClass:{targets:T,className:R}},onEnter:(e,t)=>{q.to(e,{immediateRender:bricksIsFrontend,duration:F,delay:P,...N,...i,ease:B,...!0===M&&{stagger:Y},...!M&&h&&{stagger:{from:y,amount:b,ease:v}},scrollTrigger:{trigger:e,...1==w&&{snap:{snapTo:k,duration:D,delay:A,ease:I}},...1==l&&{scrub:c},...1==d&&f&&{pin:f||!0,pinSpacing:p}}})},animationPositionValue:O}):q.to(j,{duration:F,delay:P,...N,...i,ease:B,...!0===M&&{stagger:Y},...!M&&h&&{stagger:{from:y,amount:b,ease:v}}},O);break;case"fromTo":let t;try{t=new Function("return (trigger, target) => {return "+n.data2.replace(/cssVar\((.*?)\)/g,((e,t)=>this.cssVar(t.trim())))+"}")(this)}catch(e){if(t=new Function,bricksIsFrontend)continue}try{t(r,n.selector)}catch(a){if(t=new Function,console.warn("Bricksforge Panel: You try to use timeline animations, but your Animation data object seems to be wrong. This warning appears for the timeline: "+e.name),bricksIsFrontend)continue}let a=t(r,n.selector);C&&bricksIsFrontend?ScrollTrigger.batch(j,{once:1==l||S&&"none"==S.split(" ")[2],markers:m,start:u,end:g,...1==L&&{toggleClass:{targets:T,className:R}},onEnter:(e,t)=>{q.fromTo(e,{duration:F,delay:P,...N,...i,ease:B,...!0===M&&{stagger:Y},...!M&&h&&{stagger:{from:y,amount:b,ease:v}},scrollTrigger:{trigger:e,...1==w&&{snap:{snapTo:k,duration:D,delay:A,ease:I}},...1==l&&{scrub:c},...1==d&&f&&{pin:f||!0,pinSpacing:p}}},{duration:F,delay:P,...a,...V,ease:B,...!0===M&&{stagger:Y},...!M&&h&&{stagger:{from:y,amount:b,ease:v}},scrollTrigger:{trigger:e,...1==w&&{snap:{snapTo:k,duration:D,delay:A,ease:I}},...1==l&&{scrub:c},...1==d&&f&&{pin:f||!0,pinSpacing:p}}},O)}}):q.fromTo(j,{...N,...i,immediateRender:bricksIsFrontend,duration:F,delay:P,ease:B,...!0===M&&{stagger:Y},...!M&&h&&{stagger:{from:y,amount:b,ease:v}}},{...a,...V,duration:F,delay:P,ease:B,...!0===M&&{stagger:Y},...!M&&h&&{stagger:{from:y,amount:b,ease:v}}},O)}this.timelineActions.push({finalSelector:j,animationData:N,animationControls:i,id:n.id})}}!1===t&&this.timelines.push({id:e.id,tl:q,children:q.getChildren(),trigger:E})}))}async getTimelineById(e){return new Promise(((t,a)=>{setTimeout((()=>{let n=this.timelines.find((t=>t.id==e));n?t(n):a(new Error("Timeline not found"))}))}))}cssVar(e){let t,a="";e.includes(",")?(a=e.split(",")[0],t=e.split(",")[1]):a=e,a=a.replace(/['"]+/g,""),t&&(t=t.replace(/['"]+/g,""));let n="'"+getComputedStyle(t?document.querySelector(t):document.body).getPropertyValue(a.toString().trim())+"'";return n=n.replace(/' /g,"'"),n=n.trim(),n}handleSliderEvent(e){if(!e)return console.warn("No Slider ID set"),!1;let t=bricksData.splideInstances;if(!t)return console.warn("No Slider Instances found"),!1;const a=t[e];return a||(console.warn("No Slider found with the ID "+e),!1)}async getTimelines(){return await new Promise((e=>{setTimeout((()=>{e()}))})),this.timelines}isValidSelector(e){try{return document.querySelector(e),!0}catch(e){}return!1}async wait(e=1e3){return new Promise((async t=>{setTimeout((()=>{t()}),e)}))}parseObject(e){return new Function("return "+e)}isNumeric(e){return"string"==typeof e&&(!isNaN(e)&&!isNaN(parseFloat(e)))}isParsable(e){try{JSON5.parse(e)}catch(e){return!1}return!0}}document.addEventListener("DOMContentLoaded",(e=>{brfPanel=new BricksforgePanel(e)}));