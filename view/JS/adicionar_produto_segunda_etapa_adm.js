document.addEventListener('DOMContentLoaded', function() {
    // Image upload functionality
    const imageUploadInput = document.querySelector('.additional_image_upload input[type="file"]');
    const uploadedImagesPreview = document.querySelector('.uploaded_images_preview');
    
    imageUploadInput.addEventListener('change', function(e) {
        const files = e.target.files;
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const imageContainer = document.createElement('div');
                    imageContainer.className = 'uploaded_image_container';
                    imageContainer.style.position = 'relative';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'uploaded_image';
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'remove_image';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.addEventListener('click', function() {
                        imageContainer.remove();
                    });
                    
                    imageContainer.appendChild(img);
                    imageContainer.appendChild(removeBtn);
                    uploadedImagesPreview.appendChild(imageContainer);
                }
                
                reader.readAsDataURL(file);
            }
        }
    });
    
    // Form validation
    const form = document.querySelector('.add_product_area');
    const submitButton = document.querySelector('.add_product_button');
    
    submitButton.addEventListener('click', function(e) {
        e.preventDefault();
        
        let isValid = true;
        const requiredFields = document.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value) {
                field.classList.add('invalid-field');
                isValid = false;
            } else {
                field.classList.remove('invalid-field');
            }
        });
        
        if (isValid) {
            // Submit form or proceed to next step
            alert('Produto adicionado com sucesso!');
            // form.submit(); // Uncomment to actually submit the form
        } else {
            // Scroll to first invalid field
            const firstInvalid = document.querySelector('.invalid-field');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
            }
        }
    });
    
    // Real-time validation
    document.querySelectorAll('[required]').forEach(field => {
        field.addEventListener('input', function() {
            if (this.value) {
                this.classList.remove('invalid-field');
            }
        });
    });
});