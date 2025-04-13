<?php require base_path('views/partials/layouts/guest/open.php') ;?>

    <!-- Glassmorphism navbar -->
    <nav style="background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); position: fixed; width: 100%; top: 0; z-index: 1000; padding: 1rem;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 2rem;">
            <h1 style="margin: 0; color: #0369a1; font-size: 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem;">
<!--                <i class="fas fa-rocket" style="color: #0ea5e9;"></i>-->
                <img src="/logo.svg" alt="logo" style="height: 2.5rem">
                LaunchPad
            </h1>

            <div style="display: flex; justify-content: flex-end; gap: 0.5rem; margin-top: 0.5rem; margin-inline: 0.5rem">
                <?php if ($_SESSION['user'] ?? false) : ?>
                    <a href="/dashboard">
                        <button type="button" class="button">
                            Dashboard
                        </button>
                    </a>
                <?php else : ?>
                    <a href="/register">
                        <?php echo render('components/button.view.php', ['text' => 'Company Sign Up']) ?>
                    </a>
                    <a href="/login">
                        <button type="button" style="background-color: white; color: var(--sky-500)" class="button">
                            Log In
                        </button>
                    </a>
                <?php endif; ?>
            </div>
        </div>

    </nav>

    <!-- Hero Section -->
    <main style="max-width: 1200px; margin: 7rem auto 0; padding: 2rem;">
        <div style="display: flex; align-items: center; gap: 4rem; margin-bottom: 4rem;">
            <div style="flex: 1; position: relative;">
                <!-- Decorative elements -->
                <div style="position: absolute; width: 200px; height: 200px; background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%); filter: blur(100px); opacity: 0.2; top: -50px; left: -50px; z-index: -1;"></div>

                <h2 style="font-size: 3.5rem; font-weight: 800; background: linear-gradient(135deg, #0c4a6e 0%, #0369a1 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 1.5rem; line-height: 1.2;">
                    Launch Your Career Journey
                </h2>
                <p style="font-size: 1.25rem; color: #334155; margin-bottom: 2.5rem; line-height: 1.7;">
                    Connect with premier internship opportunities through UCSC's cutting-edge placement platform.
                </p>
                <div style="display: flex; gap: 1rem;">
                    <button style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); color: white; padding: 1rem 2rem; border: none; border-radius: 8px; font-size: 1rem; font-weight: 500; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                        Get Started <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                    </button>
                    <button style="background: white; color: #0284c7; padding: 1rem 2rem; border: 2px solid #e0f2fe; border-radius: 8px; font-size: 1rem; font-weight: 500; cursor: pointer; transition: all 0.3s ease;">
                        Learn More
                    </button>
                </div>
            </div>
            <div style="flex: 1; position: relative;">
                <!-- Modern floating cards effect -->
                <div style="position: relative; height: 400px;">
                        <img src="/logo.svg" alt="Student Dashboard" style=" height: 100%; object-fit: cover; border-radius: 16px;">

                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 4rem;">
            <div style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); padding: 2rem; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
                <i class="fas fa-building" style="font-size: 2rem; color: #0ea5e9; margin-bottom: 1rem;"></i>
                <h3 style="color: #0c4a6e; font-size: 1.5rem; margin-bottom: 1rem;">Company Registration</h3>
                <p style="color: #334155; line-height: 1.6;">Direct sign-up access for companies seeking talented UCSC undergraduates.</p>
            </div>
            <div style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); padding: 2rem; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
                <i class="fas fa-user-graduate" style="font-size: 2rem; color: #0ea5e9; margin-bottom: 1rem;"></i>
                <h3 style="color: #0c4a6e; font-size: 1.5rem; margin-bottom: 1rem;">Student Access</h3>
                <p style="color: #334155; line-height: 1.6;">Managed registration process for UCSC undergraduates.</p>
            </div>
            <div style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); padding: 2rem; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
                <i class="fas fa-shield-alt" style="font-size: 2rem; color: #0ea5e9; margin-bottom: 1rem;"></i>
                <h3 style="color: #0c4a6e; font-size: 1.5rem; margin-bottom: 1rem;">Secure Platform</h3>
                <p style="color: #334155; line-height: 1.6;">Controlled access system with administrative oversight.</p>
            </div>
        </div>
    </main>



<?php require base_path('views/partials/layouts/guest/close.php') ?>