class BrfScrollSmoother{settings;smoother;constructor(){this.init()}async init(){document.body.classList.contains("brf-backend-view")||this.prepare()}prepare(){switch(this.settings=BRFSCROLLSMOOTHER.toolSettings.find((t=>7==t.id)),this.settings?(this.settings=this.settings.settings,this.settings.provider||(this.settings.provider="gsap")):this.settings={settings:{provider:"gsap",smooth:1,smoothTouch:!1,effects:!1}},this.settings.provider){case"gsap":if(document.body.classList.contains("brf-scroll-smoother-disabled"))return;gsap.registerPlugin(ScrollTrigger,ScrollSmoother),ScrollTrigger.config({ignoreMobileResize:!0}),window.bricksSmoothScroll=()=>!1,document.querySelectorAll("[data-brf-fixed]").forEach((t=>{document.body.append(t)}));!!this.settings.adjustFixedElements&&this.settings.adjustFixedElements&&this.adjustFixedPositions(),this.run(this.settings.provider);break;case"lenis":this.run(this.settings.provider)}}run(t){switch(t){case"gsap":const t=document.querySelector("#smooth-content"),e=this.settings.smooth?this.settings.smooth:1,s=!!this.settings.smoothTouch&&this.settings.smoothTouch,i=!!this.settings.effects&&this.settings.effects,o=this.settings.speed?this.settings.speed:1;this.smoother=ScrollSmoother.create({smooth:e,effects:i,smoothTouch:s,normalizeScroll:!0,ignoreMobileResize:!0,speed:o});new ResizeObserver((t=>{gsap.delayedCall(.2,(()=>{this.smoother.refresh()}))})).observe(t),document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach((t=>{t.addEventListener("click",(t=>{t.preventDefault(),this.smoother.scrollTo(t.target.getAttribute("href"),!0,"top 50px")}))})),window.location.hash&&this.smoother.scrollTo(window.location.hash,!1,"top 50px");break;case"lenis":document.documentElement.style.scrollBehavior="initial";let n=this.settings.lenisDuration?this.settings.lenisDuration:1.2,r=this.settings.lenisEase?this.settings.lenisEase:"Math.min(1, 1.001 - Math.pow(2, -10 * x))",h=new Function("return (x) => { return  "+r+" }")(),l=this.settings.lenisDirection?this.settings.lenisDirection:"vertical",c=this.settings.lenisGestureDirection?this.settings.lenisGestureDirection:"vertical",a=!this.settings.lenisSmooth||this.settings.lenisSmooth,d=this.settings.lenisMouseMultiplier?this.settings.lenisMouseMultiplier:1,g=!!this.settings.lenisSmoothTouch&&this.settings.lenisSmoothTouch,u=this.settings.lenisTouchMultiplier?this.settings.lenisTouchMultiplier:2,m=!!this.settings.lenisInfinite&&this.settings.lenisInfinite;this.smoother=new Lenis({duration:n,easing:t=>h(t),direction:l,gestureDirection:c,smooth:a,mouseMultiplier:d,smoothTouch:g,touchMultiplier:u,infinite:m});const p=t=>{this.smoother.raf(t),requestAnimationFrame(p)};requestAnimationFrame(p),document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach((t=>{t.addEventListener("click",(t=>{t.preventDefault(),this.smoother.scrollTo(t.target.getAttribute("href"),!0,"top 50px")}))})),window.location.hash&&this.smoother.scrollTo(window.location.hash,{immediate:!0})}}adjustFixedPositions(){[].filter.call(document.querySelectorAll("*"),(t=>"fixed"==getComputedStyle(t).position)).forEach((t=>{t.classList.contains("bricks-mobile-menu-wrapper")||document.body.append(t)}))}}var brfScrollSmoother;document.addEventListener("DOMContentLoaded",(()=>{bricksIsFrontend&&"undefined"!=typeof BRFSCROLLSMOOTHER&&(brfScrollSmoother=new BrfScrollSmoother)}));