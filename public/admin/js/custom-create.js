document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('is_public');
    const multiSelect = document.getElementById('users_list');

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

imageInput.addEventListener('change', function () {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.innerHTML = `<div><img style="width: 100%;height: 210px" src="${e.target.result}" alt="Image Preview" /><button class="delete-button"><span>X</span></button></div>`;
            const deleteButton = imagePreview.querySelector('.delete-button');
            deleteButton.addEventListener('click', deleteImage);
            imagePreview.style.display = 'block';
        };

        reader.readAsDataURL(file);
    } else {
        imagePreview.innerHTML = '';
        imagePreview.style.display = 'none';
    }
});

function deleteImage() {
    imageInput.value = '';
    imagePreview.innerHTML = '';
    imagePreview.style.display = 'none';
}
