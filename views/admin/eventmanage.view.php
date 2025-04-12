<?php require base_path(path: 'views/partials/auth/auth.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <link rel="stylesheet" href="/styles/pasindu/eventmanage.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<div class="center-wrapper">
    <div class="container">
        <header>
            <div class="search-container">
                <input type="text" id="search" placeholder="Search">
            </div>
            <button class="new-btn"><a href="/eventAdd">+ NEW</a></button>
        </header>
        
        <div class="events-grid">
            <!-- Event Card Template -->
            <div class="event-card">
                <div class="card-header">
                    <h3>EVENT NAME</h3>
                </div>
                <div class="card-actions">
                    <button class="action-btn edit">
                    <a href="/e-pdcadd"><i class="fas fa-edit"></i></a>
                    </button>
                    <button class="action-btn view">
                    <a href="/eventView"><i class="fas fa-eye"></i></a>
                    </button>
                    <button class="action-btn delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <!-- Additional cards will be cloned from this template -->
        </div>
        </div>
    </div>
    <script src="/scripts/pasindu/eventmanage.js"></script>
</body>
</html>
<?php require base_path('views/partials/auth/auth-close.php') ?>

