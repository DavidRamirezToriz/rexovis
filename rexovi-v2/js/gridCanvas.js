const c=document.getElementById("gridCanvas"),
ctx=c.getContext("2d");let mx=-999,my=-999;
function resize()
{
    c.width=innerWidth;c.height=innerHeight;
}
resize();
addEventListener("resize",resize);
addEventListener("mousemove",e=>
    {
        mx=e.clientX;my=e.clientY});
        function draw(t=0)
        {ctx.clearRect
            (0,0,c.width,c.height);
            ctx.strokeStyle='rgba(255,255,255,.08)';
            ctx.lineWidth=1;
            const cols=5;
            for(let i=1;i<=cols;i++)
                {const x=(c.width/(cols+1))*i;ctx.beginPath();
                    for(let y=0;y<=c.height;y+=10)
                        {const d=Math.hypot(mx-x,my-y);
                            const influence=Math.max(0,1-d/160);
                            const offset=Math.sin((y*0.05)+(t*0.002))
                            *influence*60;if(y===0)ctx.moveTo(x+offset,y);
                            else ctx.lineTo(x+offset,y);
                        }
                        ctx.stroke();}requestAnimationFrame(draw)}draw();