document.addEventListener('DOMContentLoaded', function () {
    const coverImageInputs = document.querySelectorAll('[name="cover_image"]');
    if (coverImageInputs.length) {
        coverImageInputs.forEach(input => {
            input.addEventListener('change', function () {
                const fileName = this.files[0].name;
                const fileNameElement = input.nextElementSibling;
                if (fileNameElement && fileNameElement.id === 'file-name') {
                    fileNameElement.textContent = fileName;
                }
            });
        });
    }
});