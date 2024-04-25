gsap.set(".box", {
    x: (i) => i * 520
});


gsap.to(".box", {
    duration: 500000,
    ease: "none",
    x: "+=10000000",
    modifiers: {
        x: gsap.utils.unitize(x => parseFloat(x) % 3640)
    },
    repeat: -1
});

const overflow = document.querySelector("#overflow");
overflow.addEventListener("change", applyOverflow);

function applyOverflow() {
    if(overflow.checked) {
        gsap.set(".wrapper", {overflow: "visible"});
    } else {
        gsap.set(".wrapper", {overflow: "hidden"});
    }
}