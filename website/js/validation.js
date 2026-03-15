/**
 * Centralized form validation script for Golf Website
 */

// Helper function to display error under field
function showError(inputElement, errorMessage) {
    // Check if error message span exists, if not create
    let errorSpan = inputElement.nextElementSibling;
    if (!errorSpan || !errorSpan.classList.contains('error-message')) {
        errorSpan = document.createElement('span');
        errorSpan.classList.add('error-message');
        errorSpan.style.color = '#dc3545';
        errorSpan.style.fontSize = '0.875em';
        errorSpan.style.display = 'block';
        errorSpan.style.marginTop = '0.25rem';
        inputElement.parentNode.insertBefore(errorSpan, inputElement.nextSibling);
    }
    errorSpan.textContent = errorMessage;
    inputElement.classList.add('is-invalid');
    inputElement.classList.remove('is-valid');
}

// Helper function to remove error under field
function clearError(inputElement) {
    let errorSpan = inputElement.nextElementSibling;
    if (errorSpan && errorSpan.classList.contains('error-message')) {
        errorSpan.textContent = '';
    }
    inputElement.classList.remove('is-invalid');
    inputElement.classList.add('is-valid');
}

// Validation Functions
const Validator = {
    // Name: Required, min 3 chars, letters/spaces only
    validateName: function (inputElement) {
        const value = inputElement.value.trim();
        const nameRegex = /^[A-Za-z\s]{3,}$/;
        if (value === '') {
            showError(inputElement, 'Name is required.');
            return false;
        } else if (!nameRegex.test(value)) {
            showError(inputElement, 'Name must be at least 3 characters and contain only letters and spaces.');
            return false;
        }
        clearError(inputElement);
        return true;
    },

    // Username: Required, min 3 chars, letters/numbers/underscores only
    validateUsername: function (inputElement) {
        const value = inputElement.value.trim();
        const userRegex = /^[A-Za-z0-9_]{3,}$/;
        if (value === '') {
            showError(inputElement, 'Username is required.');
            return false;
        } else if (!userRegex.test(value)) {
            showError(inputElement, 'Username must be at least 3 characters and contain only letters, numbers, and underscores.');
            return false;
        }
        clearError(inputElement);
        return true;
    },

    // Email: Valid format
    validateEmail: function (inputElement) {
        const value = inputElement.value.trim();
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (value === '') {
            showError(inputElement, 'Email is required.');
            return false;
        } else if (!emailRegex.test(value)) {
            showError(inputElement, 'Please enter a valid email address.');
            return false;
        }
        clearError(inputElement);
        return true;
    },

    // Phone: Exactly 10 digits
    validatePhone: function (inputElement) {
        const value = inputElement.value.trim();
        const phoneRegex = /^\d{10}$/;
        if (value === '') {
            showError(inputElement, 'Phone number is required.');
            return false;
        } else if (!phoneRegex.test(value)) {
            showError(inputElement, 'Phone number must be exactly 10 digits.');
            return false;
        }
        clearError(inputElement);
        return true;
    },

    // Password: Min 6 chars, at least 1 letter, 1 number
    validatePassword: function (inputElement) {
        const value = inputElement.value;
        const passRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{6,}$/;
        if (value === '') {
            showError(inputElement, 'Password is required.');
            return false;
        } else if (!passRegex.test(value)) {
            showError(inputElement, 'Password must be at least 6 characters and contain at least one letter and one number.');
            return false;
        }
        clearError(inputElement);
        return true;
    },

    // Generic Required field
    validateRequired: function (inputElement, fieldName = 'Field') {
        const value = inputElement.value.trim();
        if (value === '') {
            showError(inputElement, `${fieldName} is required.`);
            return false;
        }
        clearError(inputElement);
        return true;
    },

    // Image Upload: JPG, JPEG, PNG, max 2MB
    validateImage: function (inputElement) {
        if (inputElement.files.length > 0) {
            const file = inputElement.files[0];
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes

            if (!validTypes.includes(file.type)) {
                showError(inputElement, 'Only JPG, JPEG, and PNG formats are allowed.');
                return false;
            } else if (file.size > maxSize) {
                showError(inputElement, 'Image size must be less than 2MB.');
                return false;
            }
        } else if (inputElement.hasAttribute('required')) {
            showError(inputElement, 'Please select an image.');
            return false;
        }

        clearError(inputElement);
        return true;
    }
};

/**
 * Common usage example in HTML forms:
 * <form id="myForm" onsubmit="return validateMyForm()">
 *   <input type="text" id="name" onblur="Validator.validateName(this)">
 * </form>
 * 
 * function validateMyForm() {
 *   let isValid = true;
 *   isValid = Validator.validateName(document.getElementById('name')) && isValid;
 *   // validate other fields...
 *   return isValid;
 * }
 */
