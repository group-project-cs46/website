<?php require base_path('views/partials/auth/auth.php'); ?>
<link rel="stylesheet" href="/styles/PDC/Job_roles.css" />
<main class="main-content">
    <header class="header">
        <div class="above">
            <i class="fas fa-briefcase" style="font-size: 40px;"></i>
            <h2><b>Manage Job Roles</b></h2>
        </div>
    </header>
<div class="container">
    
    
    <button class="add-btn" onclick="openModal()">Add New Job Role</button>
    
    <table id="job-roles-table">
        <thead>
            <tr>
                <th>Job Role</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($job_roles as $role): ?>
                <tr data-id="<?php echo htmlspecialchars($role['id']); ?>">
                    <td><?php echo htmlspecialchars($role['name']); ?></td>
                    <td><?php echo htmlspecialchars($role['description'] ?? ''); ?></td>
                    <td>
                        <button class="action-btn edit-btn" onclick="openEditModal(<?php echo htmlspecialchars($role['id']); ?>, '<?php echo htmlspecialchars($role['name'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($role['description'], ENT_QUOTES); ?>')">Edit</button>
                        <button class="action-btn delete-btn" onclick="deleteRole(<?php echo htmlspecialchars($role['id']); ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal for adding/editing job role -->
    <div id="roleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title">Add Job Role</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <form id="role-form">
                <input type="hidden" id="role-id" name="id">
                <label for="role-name">Job Role:</label>
                <input type="text" id="role-name" name="name" required>
                <label for="role-description">Description:</label>
                <textarea id="role-description" name="description"></textarea>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</div>
</main>

<?php require base_path('views/partials/auth/auth-close.php') ?>

<script>
// Pass PHP data to JavaScript
let roles = <?php echo json_encode($job_roles); ?>;
console.log('Roles:', roles);

// Open modal for adding a new role
function openModal() {
    document.getElementById('modal-title').textContent = 'Add Job Role';
    document.getElementById('role-id').value = '';
    document.getElementById('role-name').value = '';
    document.getElementById('role-description').value = '';
    document.getElementById('roleModal').style.display = 'block';
}

// Open modal for editing an existing role
function openEditModal(id, name, description) {
    document.getElementById('modal-title').textContent = 'Edit Job Role';
    document.getElementById('role-id').value = id;
    document.getElementById('role-name').value = name;
    document.getElementById('role-description').value = description;
    document.getElementById('roleModal').style.display = 'block';
}

// Close modal
function closeModal() {
    document.getElementById('roleModal').style.display = 'none';
    document.getElementById('role-form').reset();
}

// AJAX function to handle POST requests
function sendAjaxRequest(url, data, callback) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    callback(response);
                } catch (e) {
                    console.error('Error parsing JSON response:', e, 'Response:', xhr.responseText);
                    alert('An error occurred while processing the response. Please try again.');
                }
            } else {
                console.error('Error:', xhr.statusText);
                alert('An error occurred while processing your request: ' + xhr.statusText);
            }
        }
    };
    const params = Object.keys(data).map(key => `${key}=${encodeURIComponent(data[key])}`).join('&');
    xhr.send(params);
}

// Handle form submission (create or edit)
document.getElementById('role-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('role-id').value;
    const name = document.getElementById('role-name').value;
    const description = document.getElementById('role-description').value;

    const data = { id, name, description };
    const url = id ? '/PDC/editjobroles' : '/PDC/createjobroles';

    sendAjaxRequest(url, data, function(response) {
        if (response.success) {
            if (id) {
                // Update existing role in the table
                const row = document.querySelector(`tr[data-id="${id}"]`);
                row.cells[0].textContent = name;
                row.cells[1].textContent = description;
                // Update roles array
                const index = roles.findIndex(role => role.id == id);
                if (index !== -1) {
                    roles[index] = { id, name, description };
                }
            } else {
                // Add new role to the table
                const tableBody = document.getElementById('job-roles-table').getElementsByTagName('tbody')[0];
                const newRow = tableBody.insertRow();
                newRow.setAttribute('data-id', response.id);
                newRow.innerHTML = `
                    <td>${name}</td>
                    <td>${description}</td>
                    <td>
                        <button class="action-btn edit-btn" onclick="openEditModal(${response.id}, '${name}', '${description}')">Edit</button>
                        <button class="action-btn delete-btn" onclick="deleteRole(${response.id})">Delete</button>
                    </td>
                `;
                // Add to roles array
                roles.push({ id: response.id, name, description });
            }
            closeModal();
        } else {
            alert('Failed to save job role: ' + (response.error || 'Unknown error'));
        }
    });
});

// Delete role
function deleteRole(id) {
    if (!confirm('Are you sure you want to delete this job role?')) return;

    sendAjaxRequest('/PDC/deletejobroles', { id: id }, function(response) {
        if (response.success) {
            // Remove from table
            const row = document.querySelector(`tr[data-id="${id}"]`);
            if (row) row.remove();
            // Remove from roles array
            roles = roles.filter(role => role.id != id);
        } else {
            alert('Failed to delete job role: ' + (response.error || 'Unknown error'));
        }
    });
}

// Close modal on outside click
window.onclick = function(event) {
    const modal = document.getElementById('roleModal');
    if (event.target === modal) {
        closeModal();
    }
};
</script>