import gsap from "gsap";

window.addToCartAnimation = function (event) {
    const button = event.currentTarget;
    const cartFly = document.querySelector('[x-ref="cartFly"]');
    const cartIcon = document.querySelector('#cart-icon'); // Sesuaikan dengan id di navbar

    if (!cartFly || !cartIcon) return;

    // Ambil posisi tombol & ikon cart
    const buttonRect = button.getBoundingClientRect();
    const cartRect = cartIcon.getBoundingClientRect();

    // Set posisi awal animasi
    gsap.set(cartFly, {
        x: buttonRect.left,
        y: buttonRect.top,
        scale: 1,
        opacity: 1,
        zIndex: 9999
    });

    // Animasi bergerak ke cart
    gsap.to(cartFly, {
        x: cartRect.left,
        y: cartRect.top,
        scale: 0.5,
        duration: 0.8,
        ease: "power1.inOut",
        onComplete: () => {
            gsap.to(cartFly, { opacity: 0, duration: 0.3 });
        }
    });
};
