gsap.registerPlugin(ScrollTrigger);
const swiperEl=document.querySelector('.hero-swiper');
if(swiperEl && typeof Swiper!=='undefined'){
const title=document.querySelector('.hero-title');
const subtitle=document.querySelector('.hero-subtitle');
const description=document.querySelector('.hero-description');
const button=document.querySelector('.hero__cta');
const counter=document.querySelector('.hero__counter');
const progress=document.querySelector('.hero__progress span');
const swiper=new Swiper('.hero-swiper',{
loop:true,effect:'fade',speed:1200,autoplay:{delay:5000,disableOnInteraction:false},
on:{init(){update(this);animateBar();},slideChangeTransitionStart(){gsap.to([title,subtitle,description,button],{opacity:0,y:20,duration:.3});},slideChangeTransitionEnd(){update(this);animateBar();}}
});
function animateBar(){gsap.fromTo(progress,{width:'0%'},{width:'100%',duration:5,ease:'none'});}
function update(s){const slide=s.slides[s.activeIndex];title.textContent=slide.dataset.title;subtitle.textContent=slide.dataset.subtitle;description.textContent=slide.dataset.text;button.textContent=slide.dataset.button;counter.textContent=String((s.realIndex||0)+1).padStart(2,'0');gsap.fromTo([title,subtitle,description,button],{opacity:0,y:30},{opacity:1,y:0,stagger:.08,duration:.8});}
}
// orden scripts:
// gsap -> ScrollTrigger -> lenis -> swiper -> gridCanvas -> animations -> hero
