document.querySelector(".hamburger").addEventListener("click", function() {
    document.querySelector(".nav-links").classList.toggle("show");
});

// let users = [
//     { id: 1, username: "admin", email: "admin@example.com", role: "Admin", password: "admin123" },
//     { id: 2, username: "john_doe", email: "john@example.com", role: "User", password: "userpass" },
//     { id: 3, username: "collector1", email: "collector@example.com", role: "E-Waste Collector", password: "collectorpass" }
// ];

// Function to display users
// function displayUsers() {
//     let userTable = document.getElementById("userTable");
//     userTable.innerHTML = "";

//     users.forEach((user, index) => {
//         userTable.innerHTML += `
//             <tr>
//                 <td>${user.id}</td>
//                 <td>${user.username}</td>
//                 <td>${user.email}</td>
//                 <td>${user.role}</td>
//                 <td>
//                     <button class="edit-btn" onclick="editUser(${index})">Edit</button>
//                     <button class="delete-btn" onclick="deleteUser(${index})">Delete</button>
//                 </td>
//             </tr>
//         `;
//     });
// }

// Function to add user
// function addUser() {
//     let username = document.getElementById("username").value;
//     let email = document.getElementById("email").value;
//     let password = document.getElementById("password").value;
//     let role = document.getElementById("role").value;

//     if (username && email && password) {
//         let newUser = {
//             id: users.length + 1,
//             username: username,
//             email: email,
//             password: password, // Store password
//             role: role
//         };
//         users.push(newUser);
//         displayUsers();

//         // Clear input fields after adding user
//         document.getElementById("username").value = "";
//         document.getElementById("email").value = "";
//         document.getElementById("password").value = "";
//         document.getElementById("role").value = "Admin"; // Reset dropdown

//         alert("User added successfully!");
//     } else {
//         alert("Please fill in all fields!");
//     }
// }

// Function to delete user
// function deleteUser(index) {
//     if (confirm("Are you sure you want to delete this user?")) {
//         users.splice(index, 1);
//         displayUsers();
//     }
// }

// Function to edit user
function editUser(userId) {
    const row = document.querySelector(`tr[data-user-id="${userId}"]`);
    const currentUsername = row.cells[1].textContent;
    const currentEmail = row.cells[2].textContent;
    const currentRole = row.cells[3].textContent;

    let newUsername = prompt("Enter new username:", currentUsername);
    let newEmail = prompt("Enter new email:", currentEmail);
    let newRole = prompt("Enter new role (admin, collector, user):", currentRole);
    let newPassword = prompt("Enter new password (leave blank to keep current):");

    if (newUsername && newEmail && newRole) {
        const formData = new FormData();
        formData.append('id', userId);
        formData.append('name', newUsername);
        formData.append('email', newEmail);
        formData.append('role', newRole);
        if (newPassword) formData.append('password', newPassword);

        fetch('update_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update local display
                row.cells[1].textContent = newUsername;
                row.cells[2].textContent = newEmail;
                row.cells[3].textContent = newRole;
                alert("User updated successfully!");
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred while updating user.");
        });
    } else {
        alert("All fields except password are required!");
    }
}

// Toggle Password Visibility
function togglePassword() {
    let passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}

// Load users initially
displayUsers();
