(function(){

const c = document.getElementById('hexTexture');

if(!c) return;

const ctx = c.getContext('2d');

const logoCanvas =
    document.getElementById(
        'logoTexture'
    );

const logoCtx =
    logoCanvas
        ? logoCanvas.getContext('2d')
        : null;

/* ======================================
   RESIZE
====================================== */

function rs(){

    const visual =
        document.querySelector(
            '.hero-hex-v2__visual'
        );

    c.width =
        visual
            ? visual.offsetWidth
            : window.innerWidth;

    c.height =
        visual
            ? visual.offsetHeight
            : window.innerHeight;

    if(
        logoCanvas
    ){

        logoCanvas.width = 522;

        logoCanvas.height = 611;
    }
}

rs();

window.addEventListener(
    'resize',
    rs
);

/* ======================================
   MOUSE
====================================== */

let t = 0;

let mx = 0;
let my = 0;

window.addEventListener(
    'mousemove',
    e => {

        mx =
            (
                e.clientX /
                innerWidth
            ) - .5;

        my =
            (
                e.clientY /
                innerHeight
            ) - .5;
    }
);

/* ======================================
   RIBBON
====================================== */

function ribbon(
    color,
    width,
    speed,
    offset,
    alpha
){

    const w =
        c.width;

    const h =
        c.height;

    const x =

        w * .5 +

        Math.sin(
            t * speed +
            offset
        ) * 900 +

        Math.cos(
            t * speed * .3 +
            offset
        ) * 240 +

        mx * 80;

    const y =

        h * .5 +

        Math.cos(
            t * speed * .7 +
            offset
        ) * 450 +

        my * 40;

    const g =
        ctx.createRadialGradient(
            x,
            y,
            10,
            x,
            y,
            width
        );

    g.addColorStop(
        0,
        color
    );

    g.addColorStop(
        .4,
        color
    );

    g.addColorStop(
        1,
        'rgba(255,255,255,0)'
    );

    ctx.globalAlpha =
        alpha;

    ctx.fillStyle =
        g;

    ctx.fillRect(
        -w,
        -h,
        w * 3,
        h * 3
    );
}

/* ======================================
   RENDER
====================================== */

function draw(){

    requestAnimationFrame(
        draw
    );

    t += .020;

    const w =
        c.width;

    const h =
        c.height;

    /* -------------------------------
       BACKGROUND
    -------------------------------- */

    const bg =
        ctx.createLinearGradient(
            0,
            0,
            w,
            h
        );

    bg.addColorStop(
        0,
        '#0c370d'
    );

    bg.addColorStop(
        .55,
        '#73bc44'
    );

    bg.addColorStop(
        1,
        '#a5fc04'
    );

    ctx.globalAlpha =
        1;

    ctx.globalCompositeOperation =
        'source-over';

    ctx.fillStyle =
        bg;

    ctx.fillRect(
        0,
        0,
        w,
        h
    );

    /* -------------------------------
       ENERGY
    -------------------------------- */

    ctx.filter =
        'blur(90px)';

    ctx.globalCompositeOperation =
        'screen';

    ribbon(
        '#0B3AFF',
        650,
        .28,
        0,
        1
    );

    ribbon(
        '#1781FF',
        520,
        .42,
        2,
        .95
    );

    ribbon(
        '#DDE3FD',
        420,
        .63,
        4,
        .75
    );

    ribbon(
        '#E6F85D',
        260,
        .35,
        1.4,
        .35
    );

    ribbon(
        'rgba(255,156,175,1)',
        300,
        .31,
        5,
        .28
    );

    ribbon(
        '#1781FF',
        280,
        .78,
        3,
        .22
    );

    ribbon(
        '#DDE3FD',
        220,
        .95,
        1,
        .18
    );

    /* -------------------------------
       DEPTH
    -------------------------------- */

    ctx.globalCompositeOperation =
        'multiply';

    ribbon(
        'rgb(208,255,77)',
        700,
        .12,
        2,
        .20
    );

    ribbon(
        'rgb(0,0,0)',
        500,
        .16,
        5,
        .12
    );

    /* -------------------------------
       REFRACTION
    -------------------------------- */

    ctx.filter =
        'none';

    ctx.globalCompositeOperation =
        'overlay';

    for(
        let y = 0;
        y < h;
        y += 12
    ){

        const wave =

            Math.sin(
                y * .012 +
                t * 2.2
            ) * 65;

        const grad =
            ctx.createLinearGradient(
                0,
                0,
                w,
                0
            );

        grad.addColorStop(
            0,
            'rgba(188,255,4,0)'
        );

        grad.addColorStop(
            .5,
            'rgba(221,227,253,.08)'
        );

        grad.addColorStop(
            1,
            'rgba(221,227,253,0)'
        );

        ctx.fillStyle =
            grad;

        ctx.fillRect(
            w * .1 + wave,
            y,
            w * .8,
            7
        );
    }

    /* -------------------------------
       FOG
    -------------------------------- */

    const fog =

        ctx.createRadialGradient(
            w * .5,
            h * .55,
            50,
            w * .5,
            h * .55,
            w * .8
        );

    fog.addColorStop(
        0,
        'rgba(247,253,221,.1)'
    );

    fog.addColorStop(
        1,
        'rgba(221,227,253,0)'
    );

    ctx.fillStyle =
        fog;

    ctx.fillRect(
        0,
        0,
        w,
        h
    );

    /* -------------------------------
       COPY TO SVG
    -------------------------------- */

    if(
        logoCanvas &&
        logoCtx
    ){

        logoCtx.clearRect(
            0,
            0,
            logoCanvas.width,
            logoCanvas.height
        );

        logoCtx.drawImage(
            c,
            0,
            0,
            logoCanvas.width,
            logoCanvas.height
        );
    }
}

draw();

})();

(function(){
 const isIOS=/iPad|iPhone|iPod/.test(navigator.userAgent);
 const isSafari=/^((?!chrome|android).)*safari/i.test(navigator.userAgent);

 if(!(isIOS||isSafari)) return;

 const oldSvg=document.querySelector('.logo-svg-mask');
 const fallback=document.getElementById('logoMaskIOS');

 if(oldSvg) oldSvg.style.display='none';
 if(fallback) fallback.style.display='block';
})();
