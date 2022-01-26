const navbarBackground = document.getElementById("navbar-background")
const navbarItems = document.querySelectorAll(".navbar-item")
const background = document.getElementById("header-background")
const notImportant = document.querySelectorAll(".not-important")
const isLittleScreen = document.querySelectorAll(".is-little-screen")

const ySwitch = 200

let isSwitched = false
let littleScreen = false

if (window.innerWidth <= 1260) {
    littleScreen = true
}

window.onscroll = (e) => {
    if (!littleScreen) {
        if (window.scrollY >= ySwitch && !isSwitched) {
            isSwitched = true
            navbarItems.forEach((item, index) => {
                item.classList.add("is-onBackground")
            })
            navbarBackground.classList.add("is-active")
        }

        if (window.scrollY < ySwitch && isSwitched) {
            isSwitched = false
            navbarItems.forEach((item, index) => {
                item.classList.remove("is-onBackground")
            })
            navbarBackground.classList.remove("is-active")
        }
    }

    if (window.screen.availHeight >= 940) {
        background.style.top = - window.scrollY/10 + "px"
    }
}

if (littleScreen) {
    notImportant.forEach((item, index) => {
        item.style.display = "none"
    })
    isLittleScreen.forEach((item, index) => {
        item.style.display = "inherit"
    })
}
