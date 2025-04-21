<div class="container">
    <h1 class="error-code">404</h1>
    <h2 class="title">Oops! Page Not Found</h2>
    <p class="message">
        The page you're looking for doesn't exist or has been moved. Let's get you back on track!
    </p>
    <a href="<?= urlBack() ?>" class="home-link">Go Back</a>
</div>

<style>
    :root {
        --color-primary: #0ea5e9;
        --color-secondary: #e5e7eb;
        --color-text: #6b7280;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: Arial, sans-serif;
    }

    .container {
        text-align: center;
        padding: 24px;
        max-width: 500px;
        margin: 0 auto;
    }

    .error-code {
        font-size: 72px;
        font-weight: bold;
        color: var(--color-primary);
        margin-bottom: 16px;
        animation: float 3s ease-in-out infinite;
    }

    .title {
        font-size: 24px;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 16px;
    }

    .message {
        color: var(--color-text);
        margin-bottom: 24px;
        line-height: 1.5;
    }

    .home-link {
        display: inline-block;
        padding: 12px 24px;
        background-color: var(--color-primary);
        color: white;
        text-decoration: none;
        font-weight: 500;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .home-link:hover {
        background-color: #0284c7;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
</style>