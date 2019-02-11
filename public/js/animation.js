document.addEventListener('DOMContentLoaded',()=>{
    //initial page load animation
    anime.timeline({
        //easing: 'easeOutExpo',
        easing: 'easeInOutQuad',
    })
    .add({
        targets:'.nav-wrapper',
        //width:['0px', '1200px']
        width:  ['0%','100%']
    })
    // .add({
    //     targets:'.logo',
    //     width:  ['0%','100%'],
    //     offset: '-=500',
    // })
    .add({
        targets:'.logo',
        opacity: [0.55,1],
        translateY:[5,0],
        duration:800,
        delay:(el,i)=>100*i,
        offset: '-=700'
    })
    .add({
        targets:'.nav-slider',
        translateY:[20,0],
        duration:650,
        opacity: [0,1],
        offset: '-=650'
    })
    .add({
        targets: '.ml8 .circle-white',
        scale: [0, 3],
        opacity: [1, 0],
        easing: "easeInOutExpo",
        rotateZ: 360,
        duration: 700,
        offset: '-=750'
      }).add({
        targets: '.ml8 .circle-container',
        scale: [0, 1],
        duration: 650,
        easing: "easeInOutExpo",
        offset: '-=650'
      }).add({
        targets: '.ml8 .circle-dark',
        scale: [0, 1],
        duration: 650,
        easing: "easeOutExpo",
        offset: '-=650',
        
      }).add({
        targets: '.ml8 .letters-left',
        scale: [0, 1],
        duration: 550,
        offset: '-=550'
      }).add({
        targets: '.ml8 .bang',
        scale: [0, 1],
        rotateZ: [45, 15],
        duration: 650,
        offset: '-=650'
      })

    //   .add({
    //     targets: '.ml8',
    //     opacity: 0,
    //     duration: 1000,
    //     easing: "easeOutExpo",
    //     delay: 1400
    //   });

    
    anime({
      targets: '.ml8 .circle-dark-dashed',
      rotateZ: 180,
      duration: 600,
      easing: "linear",
      loop:true
        });


})