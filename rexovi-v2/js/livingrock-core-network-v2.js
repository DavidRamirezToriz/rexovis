
/* LivingRock Core Network V2 */
(function(){
const mount=document.getElementById('lr-canvas');
if(!mount||typeof THREE==='undefined'||typeof gsap==='undefined') return;

const scene=new THREE.Scene();
const camera=new THREE.PerspectiveCamera(45,window.innerWidth/window.innerHeight,.1,100);
camera.position.z=12;
const renderer=new THREE.WebGLRenderer({alpha:true,antialias:true});
renderer.setPixelRatio(Math.min(window.devicePixelRatio,2));
renderer.setSize(window.innerWidth,window.innerHeight);
mount.appendChild(renderer.domElement);

const group=new THREE.Group();
scene.add(group);

// logo frame (static-ish)
function arm(color,l=3){
 const geo=new THREE.BoxGeometry(l,.45,.45);
 const mat=new THREE.MeshStandardMaterial({color,emissive:color,emissiveIntensity:.2});
 return new THREE.Mesh(geo,mat);
}
const a=arm(0x1ccad8),b=arm(0x2f80ed),c=arm(0x1ccad8),d=arm(0x2f80ed);
a.position.set(-2.2,2.2,0); b.position.set(2.2,2.2,0); c.position.set(-2.2,-2.2,0); d.position.set(2.2,-2.2,0);
a.rotation.z=Math.PI/4; d.rotation.z=Math.PI/4; b.rotation.z=-Math.PI/4; c.rotation.z=-Math.PI/4;
[a,b,c,d].forEach(x=>group.add(x));

scene.add(new THREE.AmbientLight(0xffffff,1.2));
const p=new THREE.PointLight(0x66ccff,8); p.position.set(0,0,8); scene.add(p);

// core network particles in center void
const particleCount=1200;
const pos=new Float32Array(particleCount*3);
for(let i=0;i<particleCount;i++){
 const r=Math.random()*2.2;
 const a=Math.random()*Math.PI*2;
 pos[i*3]=Math.cos(a)*r;
 pos[i*3+1]=Math.sin(a)*r;
 pos[i*3+2]=(Math.random()-.5)*12;
}
const g=new THREE.BufferGeometry();
g.setAttribute('position',new THREE.BufferAttribute(pos,3));
const m=new THREE.PointsMaterial({color:0x7dd3fc,size:.03,transparent:true,opacity:.9});
const points=new THREE.Points(g,m);
group.add(points);

// flowing tunnel illusion
const rings=[];
for(let i=0;i<24;i++){
 const geo=new THREE.RingGeometry(1.2,1.22,64);
 const mat=new THREE.MeshBasicMaterial({color:0x1e90ff,transparent:true,opacity:.15,side:THREE.DoubleSide});
 const ring=new THREE.Mesh(geo,mat);
 ring.position.z=-i*1.5;
 rings.push(ring); group.add(ring);
}

window.addEventListener('mousemove',e=>{
 const mx=(e.clientX/window.innerWidth-.5);
 const my=(e.clientY/window.innerHeight-.5);
 gsap.to(group.rotation,{x:my*.15,y:mx*.25,duration:2});
});

function animate(){
 requestAnimationFrame(animate);
 points.rotation.z+=0.001;
 points.rotation.y+=0.0008;
 rings.forEach((r)=>{r.position.z+=0.05;if(r.position.z>2)r.position.z=-34;});
 renderer.render(scene,camera);
 }
 animate();

window.addEventListener('resize',()=>{
 camera.aspect=window.innerWidth/window.innerHeight;
 camera.updateProjectionMatrix();
 renderer.setSize(window.innerWidth,window.innerHeight);
});
})();
