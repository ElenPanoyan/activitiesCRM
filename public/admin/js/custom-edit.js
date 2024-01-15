document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('is_public');
    const multiSelect = document.getElementById('users_list');
    if (checkbox.checked) {
        $(multiSelect).prop('disabled', true);
        $(multiSelect).selectpicker('refresh');
    }
    $(multiSelect).selectpicker();
    checkbox.addEventListener('change', function () {
        if (this.checked) {
            $(multiSelect).prop('disabled', true);
            $(multiSelect).selectpicker('refresh');
        } else {
            $(multiSelect).prop('disabled', false);
            $(multiSelect).selectpicker('refresh');
        }
    });
});
const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');
const updateImage = document.getElementById('updateImage');
const deleteImageUpdate = document.getElementById('deleteImageUpdate');

imageInput.addEventListener('change', function () {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.innerHTML = `<div><img style="width: 100%;height: 210px" src="${e.target.result}" alt="Image Preview" /><button class="delete-button"><span>X</span></button></div>`;
            const deleteButton = imagePreview.querySelector('.delete-button');
            deleteButton.addEventListener('click', deleteImage);
            imagePreview.style.display = 'block';
            updateImage.style.display = 'none';

        };

        reader.readAsDataURL(file);
    } else {
        imagePreview.innerHTML = '';
        imagePreview.style.display = 'none';
    }
});

deleteImageUpdate.addEventListener('click', deleteImagePrewiew);

function deleteImage() {
    imageInput.value = ''; // Clear the input field
    imagePreview.innerHTML = '';
    imagePreview.style.display = 'none';
}

function deleteImagePrewiew() {
    document.getElementById('deleted_file').value = '1';
    updateImage.style.display = 'none';
}


