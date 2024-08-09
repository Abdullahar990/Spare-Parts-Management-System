let pathArray = window.location.pathname.split('/');
let curfile = pathArray[pathArray.length - 1];

let curNav = document.querySelector('a[href="/' + curfile + '"]');
if (curNav) {
    curNav.classList.add('subMenuActive');

    let mainNav = curNav.closest('li.liMainMenu');
    if (mainNav) {
        mainNav.style.background = '#fff';
        let subMenu = mainNav.querySelector('.subMenus');
        let mainMenuIcon = mainNav.querySelector('i.mainMenuIconArrow');
        showHideSubMenu(subMenu, mainMenuIcon);
    }
}

// Ensure pathArray is not redeclared
// let pathArray = window.location.pathname.split('/');

// Handle click event
document.addEventListener('click', function(e) {
    let clickedEl = e.target;

    if (clickedEl.classList.contains('showHideSubMenu')) {
        let closestLI = clickedEl.closest('li');
        if (closestLI) {
            let subMenu = closestLI.querySelector('.subMenus');
            let mainMenuIcon = closestLI.querySelector('.mainMenuIconArrow');

            let subMenus = document.querySelectorAll('.subMenus');
            subMenus.forEach((sub) => {
                if (subMenu !== sub) sub.style.display = 'none';
            });

            showHideSubMenu(subMenu, mainMenuIcon);
        }
    }
});

// Function to show/hide submenus
function showHideSubMenu(subMenu, mainMenuIcon) {
    if (subMenu) {
        if (subMenu.style.display === 'block') {
            subMenu.style.display = 'none';
            if (mainMenuIcon) {
                mainMenuIcon.classList.remove('fa-angle-down');
                mainMenuIcon.classList.add('fa-angle-left');
            }
        } else {
            subMenu.style.display = 'block';
            if (mainMenuIcon) {
                mainMenuIcon.classList.remove('fa-angle-left');
                mainMenuIcon.classList.add('fa-angle-down');
            }
        }
    }
}
