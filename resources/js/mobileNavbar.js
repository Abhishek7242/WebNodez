// MOBILE NAVBAR
let hamIcon = document.getElementById('ham-icon')
let mobileNav = document.getElementById('mobile-nav')
const navItems = document.querySelectorAll('#mobile-nav .nav-btns');
hamIcon.addEventListener('click', () => {
    mobileNav.classList.add('show')

})
hamIcon.addEventListener('click', function () {
    if (!show) {
        document.body.classList.add('no-scroll')
        show = true



        mobileNav.style.right = '0px'
        navItems.forEach((item, index) => {
            setTimeout(() => {
                item.classList.add('animate');
            }, index * 200); // Adjust the delay as needed
        });
    } else {

        show = false
        navItems.forEach((item, index) => {
            setTimeout(() => {
                item.classList.remove('animate');
            }, index * 100); // Adjust the delay as needed

        });
        setTimeout(() => {
            document.body.classList.remove('no-scroll')


            hamIcon.style.opacity = "1"
            mobileNav.classList.remove('show')
            setTimeout(() => {
                mobileNav.style.right = '-1000px'

            }, 600);
        }, 1100);
    }

    // Trigger the mobileNav animation after the last li animation

});



