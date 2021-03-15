let circle = document.getElementById('hover__circle');


if (typeof circle !== 'undefined') {
    let listeners = document.querySelectorAll('.hover__listener');
    listeners.forEach( (listener) => {

        listener.addEventListener('mouseenter', () => {
            gsap.to(circle, 
                {
                    css: {
                        scale: 1,
                    },
                }
            )
        })

        listener.addEventListener('mouseleave', () => {
            gsap.to(circle, 
                {
                    css: {
                        scale: 0,
                    },
                }
            )
        })

        listener.addEventListener('mousemove', (e) => {
            let x = e.pageX;
            let y = e.pageY - circle.style.width;

            gsap.to(circle, 
                {
                    x: x - circle.style.width,
                    y: y - circle.style.height,
                    duration: 1,
                }
            )
        });

    })
}