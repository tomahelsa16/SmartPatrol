document.addEventListener('DOMContentLoaded', function () {

    // Ambil semua toggle submenu
    const submenuToggles = document.querySelectorAll('.submenu-toggle');

    // ================================
    // Animasi Slide Down
    // ================================
    function slideDown(element, duration = 300) {
        element.style.removeProperty('display');
        let display = window.getComputedStyle(element).display;

        if (display === 'none') display = 'block';
        element.style.display = display;

        let height = element.offsetHeight;
        element.style.overflow = 'hidden';
        element.style.height = '0px';
        element.style.paddingTop = '0px';
        element.style.paddingBottom = '0px';

        element.offsetHeight;

        element.style.transition = `height ${duration}ms ease, padding ${duration}ms ease`;
        element.style.height = height + 'px';
        element.style.removeProperty('padding-top');
        element.style.removeProperty('padding-bottom');

        element.addEventListener('transitionend', function handler() {
            element.style.removeProperty('height');
            element.style.removeProperty('overflow');
            element.style.removeProperty('transition');
            element.removeEventListener('transitionend', handler);
        });
    }

    // ================================
    // Animasi Slide Up
    // ================================
    function slideUp(element, duration = 300) {
        element.style.height = element.offsetHeight + 'px';
        element.style.overflow = 'hidden';
        element.offsetHeight;

        element.style.transition = `height ${duration}ms ease, padding ${duration}ms ease`;
        element.style.height = '0px';
        element.style.paddingTop = '0px';
        element.style.paddingBottom = '0px';

        element.addEventListener('transitionend', function handler() {
            element.style.display = 'none';
            element.style.removeProperty('height');
            element.style.removeProperty('padding-top');
            element.style.removeProperty('padding-bottom');
            element.style.removeProperty('overflow');
            element.style.removeProperty('transition');
            element.removeEventListener('transitionend', handler);
        });
    }

    // ======================================================
    // FIX GLOBAL: Cegah Bubbling pada semua item submenu
    // ======================================================
    document.querySelectorAll('.submenu li a').forEach(item => {
        item.addEventListener('click', function (e) {
            e.stopPropagation();               // Hentikan bubbling
        });
    });

    // ======================================================
    // Toggle Submenu dengan Slide Animasi
    // ======================================================
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {

            e.preventDefault();
            e.stopPropagation();

            const parentLi = this.closest('li.has-submenu');
            const submenu = parentLi.querySelector('.submenu');

            if (!submenu) return;

            const isOpen = parentLi.classList.contains('open');

            // (Opsional) Menutup submenu lain agar tidak multiple-open
            document.querySelectorAll('li.has-submenu.open').forEach(li => {
                if (li !== parentLi) {
                    li.classList.remove('open');
                    const otherMenu = li.querySelector('.submenu');
                    if (otherMenu) slideUp(otherMenu);
                }
            });

            // Toggle
            if (isOpen) {
                parentLi.classList.remove('open');
                slideUp(submenu);
            } else {
                parentLi.classList.add('open');
                slideDown(submenu);
            }
        });
    });

    // ======================================================
    // AUTO OPEN SUBMENU BERDASARKAN URL
    // ======================================================
    const currentPath = window.location.origin + window.location.pathname;

    document.querySelectorAll('.main-nav a').forEach(link => {

        if (link.href === currentPath) {

            link.classList.add('active');

            const parentLi = link.closest('li.menu-item');
            if (parentLi) parentLi.classList.add('active');

            const submenu = link.closest('.submenu');

            // Jika link berada dalam submenu
            if (submenu) {
                const parentMenu = submenu.closest('li.has-submenu');
                if (parentMenu) {

                    parentMenu.classList.add('open');

                    // Buka submenu tanpa animasi
                    submenu.style.display = 'block';
                }
            }
        }
    });

});
