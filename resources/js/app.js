import './bootstrap';

import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Make Chart.js globally available for Alpine components
window.Chart = Chart;

// Initialize AOS
AOS.init({
    duration: 700,
    easing: 'ease-out-cubic',
    once: true,
    offset: 60,
});

// Animated counter utility for Alpine
window.animateCounter = function(target, duration = 1500) {
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

// Parallax utility
window.parallax = function() {
    return {
        offset: 0,
        onScroll() {
            this.offset = window.scrollY * 0.3;
        }
    };
};

// Alpine.js stores for global state
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

// Start Alpine
Alpine.start();
window.Alpine = Alpine;
