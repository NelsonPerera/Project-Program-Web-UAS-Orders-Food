// Toggle between login and signup forms
document.addEventListener('DOMContentLoaded', () => {
    const createLink = document.getElementById('create');
    const alreadyLink = document.getElementById('already');
    const loginDiv = document.querySelector('.login-div');
    const signupDiv = document.querySelector('.signup-div');
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');

    if (createLink) {
        createLink.addEventListener('click', () => {
            loginDiv.classList.add('hidden');
            loginForm.classList.add('hidden');
            signupDiv.classList.add('active');
            signupForm.classList.add('active');
        });
    }

    if (alreadyLink) {
        alreadyLink.addEventListener('click', () => {
            signupDiv.classList.remove('active');
            signupForm.classList.remove('active');
            loginDiv.classList.remove('hidden');
            loginForm.classList.remove('hidden');
        });
    }

    // Add "filled" class for label movement
    const inputs = document.querySelectorAll('._381fS');
    inputs.forEach(input => {
        input.addEventListener('blur', (e) => {
            if (e.target.value) {
                e.target.classList.add('filled');
            } else {
                e.target.classList.remove('filled');
            }
        });
        // Initial check
        if (input.value) input.classList.add('filled');
    });

    // Handle login form submission
    if (loginForm) {
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const mobileInput = document.querySelector('#login-form #mobile');
            const passwordInput = document.querySelector('#login-form #password');

            if (!mobileInput || !passwordInput) {
                console.error('Login fields missing');
                return;
            }

            const mobile = mobileInput.value;
            const password = passwordInput.value;

            if (mobile && password) {
                try {
                    const response = await fetch(window.BASE_URL + 'auth/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new URLSearchParams({
                            'mobile': mobile,
                            'password': password
                        })
                    });

                    if (!response.ok) {
                        throw new Error(`Server error: ${response.status}`);
                    }

                    const text = await response.text();
                    let data;
                    try {
                        data = JSON.parse(text);
                    } catch (e) {
                        console.error('Server response (raw):', text);
                        const preview = text.substring(0, 100).replace(/</g, "&lt;").replace(/>/g, "&gt;");
                        throw new Error(`Server returned invalid data. Preview: ${preview}...`);
                    }

                    if (data.status === 'success') {
                        showToast('Login successful!');
                        if (data.user) localStorage.setItem("loginUser", JSON.stringify(data.user));

                        // Close offcanvas
                        const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasRight'));
                        if (offcanvas) offcanvas.hide();

                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            updateUserUI(); // Refresh UI state
                        }
                    } else {
                        showToast(data.message || 'Login failed');
                    }
                } catch (error) {
                    console.error('Login error:', error);
                    showToast('Server error during login. Check console.');
                }
            } else {
                showToast('Please enter mobile number and password');
            }
        });
    }

    // Handle signup form submission
    if (signupForm) {
        signupForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const mobileInput = document.querySelector('#signup-form #mobile');
            const nameInput = document.querySelector('#signup-form #name');
            const emailInput = document.querySelector('#signup-form #email');
            const passwordInput = document.querySelector('#signup-form #signup-password');

            if (!mobileInput || !nameInput || !emailInput || !passwordInput) {
                showToast('Form fields missing. Checking...');
                console.error('Signup fields missing:', { mobileInput, nameInput, emailInput, passwordInput });
                return;
            }

            const mobile = mobileInput.value;
            const name = nameInput.value;
            const email = emailInput.value;
            const password = passwordInput.value;

            if (mobile && name && email && password) {
                try {
                    const response = await fetch(window.BASE_URL + 'auth/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new URLSearchParams({
                            'name': name,
                            'email': email,
                            'mobile': mobile,
                            'password': password
                        })
                    });

                    if (!response.ok) {
                        throw new Error(`Server error: ${response.status}`);
                    }

                    const text = await response.text();
                    let data;
                    try {
                        data = JSON.parse(text);
                    } catch (e) {
                        console.error('Server response (raw):', text);
                        const preview = text.substring(0, 100).replace(/</g, "&lt;").replace(/>/g, "&gt;");
                        throw new Error(`Server returned invalid data. Preview: ${preview}...`);
                    }

                    if (data.status === 'success') {
                        showToast('Account created successfully!');
                        if (data.user) localStorage.setItem("loginUser", JSON.stringify(data.user));

                        // Close offcanvas
                        const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasRight'));
                        if (offcanvas) offcanvas.hide();

                        updateUserUI();
                    } else {
                        // Display validation errors if any
                        if (data.errors) {
                            const errorMsg = Object.values(data.errors).join(', ');
                            showToast(errorMsg);
                        } else {
                            showToast(data.message || 'Registration failed');
                        }
                    }
                } catch (error) {
                    console.error('Registration error:', error);
                    showToast(error.message || 'An error occurred.');
                }
            } else {
                showToast('Please fill all fields');
            }
        });
    }

    // Handle logout
    const logoutBtn = document.getElementById('logout');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            try {
                await fetch(window.BASE_URL + 'auth/logout');
                showToast('Logged out successfully');
                window.location.href = '/'; // Reload to clear server session fully
            } catch (error) {
                console.error('Logout error:', error);
            }
        });
    }

    // Check login status on page load
    updateUserUI();
});

async function updateUserUI() {
    try {
        const response = await fetch(window.BASE_URL + 'auth/check');
        const data = await response.json();

        const signinNav = document.querySelector('.signin-nav');
        const userNameDiv = document.querySelector('.UserName');
        const profileSpan = document.getElementById('Profile');

        if (data.isLoggedIn) {
            localStorage.setItem("loginUser", JSON.stringify(data.user)); // Save for Cart
            if (signinNav) signinNav.style.display = 'none';
            if (userNameDiv) userNameDiv.style.display = 'block';
            if (profileSpan) profileSpan.textContent = data.user.name;

            const adminLink = document.getElementById('admin-link');
            if (adminLink) {
                adminLink.style.display = data.user.role === 'admin' ? 'block' : 'none';
            }
        } else {
            localStorage.removeItem("loginUser"); // Clear on logout/fail
            if (signinNav) signinNav.style.display = 'block';
            if (userNameDiv) userNameDiv.style.display = 'none';
        }
    } catch (error) {
        console.error('Auth check error:', error);
    }
}

function showToast(message) {
    const toastBody = document.querySelector('.toast-body');
    const toastEl = document.getElementById('liveToast');

    if (toastBody && toastEl) {
        toastBody.textContent = message;
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    } else {
        alert(message); // Fallback
    }
}
