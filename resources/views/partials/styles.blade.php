<style>
    :root {
        --primary-blue: #0071e3;
        --light-blue: #e6f1fa;
    }

    body {
        background-color: #f5f5f7;
    }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        background-color: #fff;
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #333;
    }

    .sidebar .nav-link.active {
        color: var(--primary-blue);
        background-color: var(--light-blue);
    }

    .sidebar .logo {
        padding: 0 1rem;
    }

    .chart-placeholder {
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #86868b;
    }

    /* Responsive */
    @media (max-width: 767.98px) {
        .sidebar {
            position: static;
            padding: 0;
        }
        
        .nav-section {
            display: flex;
            overflow-x: auto;
        }
        
        .nav-item {
            white-space: nowrap;
        }
    }
</style>