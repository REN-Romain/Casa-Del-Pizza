menu_link_1 = document.getElementById('menu-link-1')
menu_link_2 = document.getElementById('menu-link-2')
menu_link_3 = document.getElementById('menu-link-3')
menu_link_4 = document.getElementById('menu-link-4')
displayMenu = (() => {
    document.getElementById('menu').style.visibility = "inherit"
    document.getElementById('menu').style.opacity = 1
    document.getElementById('equal').style.display = "none"
    document.getElementById('cross').style.display = "flex"
    document.body.style.overflow = 'hidden';
    window.scrollTo(0, 0);

    setTimeout(() => {
        menu_link_1.style.visibility = "inherit"
        menu_link_1.style.opacity = 1
    }, 150);
    setTimeout(() => {
        menu_link_2.style.visibility = "inherit"
        menu_link_2.style.opacity = 1
    }, 250);
    setTimeout(() => {
        menu_link_3.style.visibility = "inherit"
        menu_link_3.style.opacity = 1
    }, 350)
    setTimeout(() => {
        menu_link_4.style.visibility = "inherit"
        menu_link_4.style.opacity = 1
    }, 450)


})

hideMenu = (() => {
    document.getElementById('menu').style.visibility = "hidden"
    document.getElementById('menu').style.opacity = 0
    document.getElementById('equal').style.display = "flex"
    document.getElementById('cross').style.display = "none"
    document.body.style.overflow = 'auto';
    menu_link_1.style.visibility = "hidden"
    menu_link_1.style.opacity = 0
    menu_link_2.style.visibility = "hidden"
    menu_link_2.style.opacity = 0
    menu_link_3.style.visibility = "hidden"
    menu_link_3.style.opacity = 0
    menu_link_4.style.visibility = "hidden"
    menu_link_4.style.opacity = 0
})