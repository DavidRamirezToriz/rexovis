// gsap.registerPlugin(ScrollTrigger);
// const lenis = new Lenis({
//   duration: 1.2,
//   smoothWheel: true
// });
// lenis.on("scroll", ScrollTrigger.update);
// function raf(time) {
//   lenis.raf(time);
//   requestAnimationFrame(raf);
// }

// requestAnimationFrame(raf);

// gsap.from(".card", {
//   y: 80,
//   opacity: 0,
//   stagger: 0.1,
//   scrollTrigger: {
//     trigger: ".services",
//     start: "top 80%",
//     markers: false  }
//   });


/* ===========================2   INTRO3=========================== */
/* ===========================2   INTRO3=========================== */
// LivingRock Loader V2
window.addEventListener("load",()=>{
 const path=document.querySelector('.loader-logo path');
 const loader=document.querySelector('.page-loader');
 if(!path||!loader) return;
 const len=path.getTotalLength();
 gsap.set(path,{strokeDasharray:len,strokeDashoffset:len,fill:'transparent'});
 const tl=gsap.timeline();
 tl.to(path,{strokeDashoffset:0,duration:1.25,ease:'power2.inOut'})
   .to(path,{filter:'drop-shadow(0 0 14px rgba(6, 241, 57, 0.8))',duration:.35},'-=.4')
   .to(path,{fill:'#f5f6ff',duration:.35})
   .to('.loader-glow',{opacity:.18,duration:.4},'<')
   .to(loader,{opacity:0,duration:.7,ease:'power2.out',delay:.25})
   .set(loader,{display:'none'});
});
/* ===========================2   HEADER SCROLL3=========================== */
const header =
document.querySelector(".header");
window.addEventListener("scroll",()=>{
  if(window.scrollY > 50){
    header.classList.add("scrolled");
  }else{
    header.classList.remove("scrolled");
  }
});
/* ===========================23   MOBILE MENU24=========================== */
const menuBtn =
document.querySelector(".nav-toggle");
const menu =
document.querySelector(".nav-menu");
if(menuBtn){
  menuBtn.addEventListener("click",()=>{
    menuBtn.classList.toggle("active");
    menu.classList.toggle("active");
  });
}

// TEMAI SVG ANIMATIONS (GSAP required)

// Advanced inline SVG animation

// RINGS COMPONENT 

document.querySelectorAll(".js-rings").forEach(svg=>{
 const circles=svg.querySelectorAll(".ilove-ring");
 circles.forEach((circle,index)=>{
  const len=circle.getTotalLength();
  const dash=len*0.18;
  const gap=len*0.08;
  circle.style.strokeDasharray=`${dash} ${gap}`;
  gsap.to(circle,{
   strokeDashoffset:(index%2?1:-1)*1000,
   duration:60+(index*4),
   repeat:-1,
   ease:'none'
  });
 });
});


// SPIRAL COMPONENT

/* =====================================
   SPIRAL BREATH SYSTEM
===================================== */

document
.querySelectorAll('.js-spiral')
.forEach(svg => {

    const spirals =
        svg.querySelectorAll('.ilove-spiral');

    const tl = gsap.timeline({
        repeat:-1,
        repeatDelay:.8
    });

    spirals.forEach((path,i)=>{

        const len =
            path.getTotalLength();

        gsap.set(path,{
            strokeDasharray:len,
            strokeDashoffset:len
        });

        tl.to(path,{
            strokeDashoffset:0,
            duration:1.8,
            ease:'power2.inOut'
        },i * .18);

    });

    tl.to(spirals,{
        filter:'drop-shadow(0 0 6px rgba(11,58,255,.8))',
        duration:.3
    });

    tl.to(spirals,{
        filter:'drop-shadow(0 0 0px transparent)',
        duration:.3
    });

});


// WAVE COMPONENT

/* =====================================
   WAVE SYSTEM
===================================== */

document
.querySelectorAll('.js-wave')
.forEach(svg => {
    const strokes =
        [...svg.querySelectorAll('.ilove-wave')];
    const fills =
        [...svg.querySelectorAll('.ilove-wave_fill')];
    if(!strokes.length) return;
    strokes.forEach(el => {
        const len =
            typeof el.getTotalLength === 'function'
            ? el.getTotalLength()
            : null;
        if(len){
            gsap.set(el,{
                strokeDasharray: len,
                strokeDashoffset: len
            });
        }
    });

    fills.forEach(fill => {
        gsap.set(fill,{
            fillOpacity:0
        });
    });

    const tl = gsap.timeline({
        repeat:-1,
        yoyo:true,
        repeatDelay:2

    });
    /* ---------------------
       DIBUJO GENERAL
    --------------------- */

    strokes.forEach((el,index)=>{
        if(typeof el.getTotalLength !== 'function')
            return;
        tl.to(el,{
            strokeDashoffset:0,
            duration:36,
            ease:'power2.out'
        },index * 0.45);

    });

    /* ---------------------
       APAREN LOS RELLENOS
    --------------------- */

    fills.forEach((fill,index)=>{
        tl.to(fill,{
            fillOpacity:0.26,
            duration:1.2,
            ease:'sine.out'
        },'>-=0.3');
    });

    /* ---------------------
       GLOW
    --------------------- */

    tl.to(strokes,{
        filter:
            'drop-shadow(0 0 4px #ffffff)',
        duration:0.4,
        stagger:0.05
    });

    tl.to(strokes,{
        filter:
            'drop-shadow(0 0 0px transparent)',
        duration:0.6
    });

    /* ---------------------
       HOLD
    --------------------- */

    tl.to({},{
        duration:2
    });
});

// TRIANGLE COMPONENT


document
.querySelectorAll('.js-triangle')
.forEach(svg => {

    const triangles =
        [...svg.querySelectorAll('.ilove-triangle')]
            .sort((a,b)=>a.getTotalLength()-b.getTotalLength());

    if(!triangles.length) return;

    triangles.forEach(triangle => {

        const len = triangle.getTotalLength();

        gsap.set(triangle,{
            fill:'none',
            stroke:'#ffffff',
            strokeWidth:1.5,
            strokeDasharray: len + 10,
            strokeDashoffset: len + 10
        });

    });

    const tl = gsap.timeline({
        repeat:-1,
        yoyo:true,
        repeatDelay:2
    });

    triangles.forEach((triangle,index)=>{

        tl.to(triangle,{
            strokeDashoffset:0,
            duration:46,
            ease:'power2.out'
        }, index * 0.75);

    });

    tl.to(triangles,{
        filter:'drop-shadow(0 0 3px #ffffff)',
        duration:0.4,
        stagger:0.05
    });

    tl.to(triangles,{
        filter:'drop-shadow(0 0 0px transparent)',
        duration:0.6
    });

    tl.to({}, {duration:2});

});


// FREQUENCY COMPONENT


document.querySelectorAll('.js-frequency').forEach(svg => {

  const fills = svg.querySelectorAll('.ilove-frequency_fill');

  fills.forEach((fill,index)=>{

    gsap.to(fill,{
      opacity:0.55,
      filter:'drop-shadow(0 0 4px white)',
      duration:3 + (index * 0.3),
      repeat:-1,
      yoyo:true,
      ease:'sine.inOut'
    });

  });

  const line = svg.querySelector('.ilove-frequency');

  if(line){
    gsap.set(line,{strokeDasharray:'12 8'});

    gsap.to(line,{
      strokeDashoffset:-40,
      duration:3,
      repeat:-1,
      ease:'none'
    });
  }

});

// DISTORTION COMPONENT

document
.querySelectorAll('.js-distortion')
.forEach(svg => {

    const shapes = [...svg.querySelectorAll('.ilove-distortion')]
        .sort((a,b)=>a.getTotalLength()-b.getTotalLength());

    if(!shapes.length) return;

    shapes.forEach((shape,index)=>{

        gsap.to(shape,{
            scale: 1 + (index * 0.015),
            opacity: 0.65 + (index * 0.05),
            duration: 3 + (index * 0.4),
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut'
        });

        gsap.to(shape,{
            x: 0.8,
            y: 0.4,
            duration: 2 + index,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut'
        });

    });

});

// ECO COMPONENT

document.querySelectorAll('.js-eco').forEach(svg=>{
 const waves=[...svg.querySelectorAll('.ilove-eco')]
   .sort((a,b)=>a.getTotalLength()-b.getTotalLength());
 if(!waves.length) return;
 waves.forEach(w=>{
   const len=w.getTotalLength();
   gsap.set(w,{strokeDasharray:len+50,strokeDashoffset:len+50});
 });
 const tl=gsap.timeline({repeat:-1,yoyo:true,repeatDelay:1.5});
 waves.forEach((wave,index)=>{
   tl.to(wave,{strokeDashoffset:-6,duration:1.2,ease:'power2.out'},index*0.35);
 });
 tl.to(waves,{filter:'drop-shadow(0 0 4px #ffffff)',duration:0.3,stagger:0.05});
 tl.to(waves,{filter:'drop-shadow(0 0 0px transparent)',duration:0.4});
 tl.to({}, {duration:1.5});
});




/* =====================================
   TRUST METRICS COUNTER
===================================== */

gsap.registerPlugin(ScrollTrigger);

document
.querySelectorAll('.js-counter')
.forEach(counter => {

    const target =
        Number(counter.dataset.value);

    const state = {
        value:0
    };

    gsap.to(state,{

        value:target,

        duration:2,

        ease:'power2.out',

        scrollTrigger:{
            trigger:counter,
            start:'top 85%',
            once:true
        },

        onUpdate:()=>{

            const value =
                Math.floor(state.value);

            const suffix =
                counter.dataset.suffix || '';

            const format =
                counter.dataset.format;

            counter.textContent =
                format === 'comma'
                    ? value.toLocaleString()
                    : value;

            counter.textContent += suffix;

        }

    });

});
``