import './bootstrap';

import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Swal from 'sweetalert2';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

// Make global
window.Chart = Chart;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.Swal = Swal;

// Initialize AOS (kept for backward compat, GSAP handles new stuff)
AOS.init({
    duration: 700,
    easing: 'ease-out-cubic',
    once: true,
    offset: 60,
    disable: window.matchMedia('(prefers-reduced-motion: reduce)').matches
});

// ===== ANIMATED COUNTER UTILITY =====
window.animateCounter = function (target, duration = 1500) {
    return {
        current: 0,
        target: target,
        init() {
            const start = performance.now();
            const step = (now) => {
                const progress = Math.min((now - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                this.current = Math.round(eased * this.target);
                if (progress < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        }
    };
};

// ===== PARALLAX UTILITY =====
window.parallax = function () {
    return {
        offset: 0,
        onScroll() {
            this.offset = window.scrollY * 0.3;
        }
    };
};

// ===== ALPINE STORES =====
Alpine.store('notifications', {
    items: [],
    unreadCount: 0,
    add(notification) {
        this.items.unshift(notification);
        this.unreadCount++;
        setTimeout(() => this.remove(notification), 8000);
    },
    remove(notification) {
        this.items = this.items.filter(n => n !== notification);
    },
    markAllRead() {
        this.unreadCount = 0;
    },
});

Alpine.store('sidebar', {
    open: window.innerWidth >= 1024,
    toggle() {
        this.open = !this.open;
    },
});

// ===== SCROLL PROGRESS BAR =====
function initScrollProgress() {
    const bar = document.getElementById('scroll-progress');
    if (!bar) return;

    const scrollContainer = document.getElementById('main-scroll') || window;
    const isWindow = scrollContainer === window;

    const updateProgress = () => {
        const scrollTop = isWindow ? window.scrollY : scrollContainer.scrollTop;
        const scrollHeight = isWindow ? document.documentElement.scrollHeight : scrollContainer.scrollHeight;
        const clientHeight = isWindow ? window.innerHeight : scrollContainer.clientHeight;

        const docHeight = scrollHeight - clientHeight;
        const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        bar.style.width = progress + '%';
    };

    scrollContainer.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();
}

// ===== CURSOR GLOW (Mouse Trailing Effect) =====
function initCursorGlow() {
    const glow = document.getElementById('cursor-glow');
    if (!glow || window.matchMedia('(max-width: 768px)').matches) return;

    let mouseX = 0, mouseY = 0;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        glow.style.left = mouseX + 'px';
        glow.style.top = mouseY + 'px';
        if (!glow.classList.contains('active')) {
            glow.classList.add('active');
        }
    });

    document.addEventListener('mouseleave', () => {
        glow.classList.remove('active');
    });
}

// ===== MAGNETIC BUTTONS =====
function initMagneticButtons() {
    if (window.matchMedia('(max-width: 768px)').matches) return;

    const buttons = document.querySelectorAll('.btn-magnetic');
    buttons.forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            btn.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px)`;
        });

        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0, 0)';
        });
    });
}

// ===== GSAP SCROLL ANIMATIONS =====
function initGSAPAnimations() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const scroller = document.getElementById('main-scroll') || window;

    // Staggered reveal for admin dashboard cards
    const adminCards = document.querySelectorAll('[data-gsap="stagger"]');
    if (adminCards.length > 0) {
        gsap.fromTo(adminCards,
            { opacity: 0, y: 40 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                stagger: 0.1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: adminCards[0],
                    scroller: scroller,
                    start: 'top 80%',
                    once: true
                }
            }
        );
    }

    // Guest page section reveals
    document.querySelectorAll('[data-gsap="reveal"]').forEach(el => {
        gsap.fromTo(el,
            { opacity: 0, y: 50 },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: el,
                    scroller: scroller,
                    start: 'top 85%',
                    once: true
                }
            }
        );
    });

    // Scale reveal
    document.querySelectorAll('[data-gsap="scale"]').forEach(el => {
        gsap.fromTo(el,
            { opacity: 0, scale: 0.85 },
            {
                opacity: 1,
                scale: 1,
                duration: 0.7,
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: el,
                    scroller: scroller,
                    start: 'top 85%',
                    once: true
                }
            }
        );
    });

    // Slide from left
    document.querySelectorAll('[data-gsap="slide-left"]').forEach(el => {
        gsap.fromTo(el,
            { opacity: 0, x: -60 },
            {
                opacity: 1,
                x: 0,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: el,
                    scroller: scroller,
                    start: 'top 80%',
                    once: true
                }
            }
        );
    });

    // Slide from right
    document.querySelectorAll('[data-gsap="slide-right"]').forEach(el => {
        gsap.fromTo(el,
            { opacity: 0, x: 60 },
            {
                opacity: 1,
                x: 0,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: el,
                    scroller: scroller,
                    start: 'top 80%',
                    once: true
                }
            }
        );
    });

    // Staggered children
    document.querySelectorAll('[data-gsap="stagger-children"]').forEach(parent => {
        const children = parent.children;
        gsap.fromTo(children,
            { opacity: 0, y: 30 },
            {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.08,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: parent,
                    scroller: scroller,
                    start: 'top 95%', // increased start trigger point slightly for child elements
                    once: true
                }
            }
        );
    });

    // Parallax floating orbs
    document.querySelectorAll('[data-gsap="parallax"]').forEach(el => {
        const speed = parseFloat(el.dataset.speed) || 0.3;
        gsap.to(el, {
            y: () => window.innerHeight * speed * -0.5,
            ease: 'none',
            scrollTrigger: {
                trigger: el.parentElement || el,
                scroller: scroller,
                start: 'top bottom',
                end: 'bottom top',
                scrub: 1
            }
        });
    });
}

// ===== SWEETALERT2 ENHANCED TOASTS =====
window.showToast = function (type, title, text) {
    const icons = { success: 'success', error: 'error', warning: 'warning', info: 'info' };
    Swal.fire({
        icon: icons[type] || 'info',
        title: title,
        text: text,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        customClass: {
            popup: 'swal-glass'
        },
        showClass: {
            popup: 'animate__animated animate__fadeInRight animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutRight animate__faster'
        },
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
};

// SweetAlert confirm dialog for admin
window.confirmAction = function (options = {}) {
    return Swal.fire({
        title: options.title || 'Apakah kamu yakin?',
        text: options.text || 'Tindakan ini tidak bisa dibatalkan.',
        icon: options.icon || 'warning',
        showCancelButton: true,
        confirmButtonText: options.confirmText || 'Ya, lanjutkan!',
        cancelButtonText: options.cancelText || 'Batal',
        customClass: {
            popup: 'swal-glass',
            confirmButton: 'swal2-confirm',
            cancelButton: 'swal2-cancel'
        },
        reverseButtons: true,
        focusCancel: true
    });
};

// ===== SCROLL-SPY =====
document.addEventListener('DOMContentLoaded', () => {
    const sectionIds = ['tentang', 'program-kerja', 'kolaborasi'];
    const sectionEls = sectionIds.map(id => document.getElementById(id)).filter(Boolean);

    if (sectionEls.length === 0) return;

    let currentSection = 'beranda';
    const dispatch = (section) => {
        if (currentSection !== section) {
            currentSection = section;
            document.dispatchEvent(new CustomEvent('section-visible', { detail: { section } }));
        }
    };

    const observer = new IntersectionObserver((entries) => {
        let best = null;
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (!best || entry.intersectionRatio > best.intersectionRatio) {
                    best = entry;
                }
            }
        });
        if (best) {
            dispatch(best.target.id);
        }
    }, {
        threshold: [0.1, 0.3, 0.5],
        rootMargin: '-80px 0px -40% 0px'
    });

    sectionEls.forEach(el => observer.observe(el));

    let scrollTimer;
    window.addEventListener('scroll', () => {
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(() => {
            if (window.scrollY < 400) {
                dispatch('beranda');
            }
        }, 50);
    }, { passive: true });

    if (window.scrollY < 400) dispatch('beranda');
});

// ===== SMOOTH SCROLL FOR ANCHORS =====
document.addEventListener('click', (e) => {
    const anchor = e.target.closest('a[href*="#"]');
    if (!anchor) return;

    const href = anchor.getAttribute('href');
    const hashIndex = href.indexOf('#');
    if (hashIndex === -1) return;

    const hash = href.substring(hashIndex + 1);
    if (!hash) return;

    const target = document.getElementById(hash);
    if (!target) return;

    const beforeHash = href.substring(0, hashIndex);
    if (beforeHash && !window.location.href.includes(beforeHash.replace(/\/$/, ''))) return;

    e.preventDefault();
    const navHeight = 80;
    const top = target.getBoundingClientRect().top + window.scrollY - navHeight;
    window.scrollTo({ top, behavior: 'smooth' });

    history.pushState(null, '', '#' + hash);
});

// ===== INIT ALL ENHANCEMENTS =====
document.addEventListener('DOMContentLoaded', () => {
    initScrollProgress();
    initCursorGlow();
    initMagneticButtons();

    // Small delay to ensure DOM is fully rendered
    requestAnimationFrame(() => {
        initGSAPAnimations();
    });

    // Flash message integration with SweetAlert2
    const successMsg = document.querySelector('meta[name="flash-success"]');
    const errorMsg = document.querySelector('meta[name="flash-error"]');
    if (successMsg && successMsg.content) {
        showToast('success', 'Berhasil!', successMsg.content);
    }
    if (errorMsg && errorMsg.content) {
        showToast('error', 'Terjadi Kesalahan', errorMsg.content);
    }
});

// Start Alpine
Alpine.start();
window.Alpine = Alpine;
