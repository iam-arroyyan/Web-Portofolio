(function () {
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggle = document.getElementById('sidebarToggle');

    if (!sidebar || !toggle) {
        return;
    }

    function openSidebar() {
        sidebar.classList.add('open');
        if (overlay) {
            overlay.classList.add('active');
        }
        document.body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        if (overlay) {
            overlay.classList.remove('active');
        }
        document.body.classList.remove('sidebar-open');
    }

    toggle.addEventListener('click', function () {
        if (sidebar.classList.contains('open')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    window.addEventListener('resize', function () {
        if (window.innerWidth > 992) {
            closeSidebar();
        }
    });
})();

(function () {
    const fileInputs = document.querySelectorAll('.image-upload-input');

    fileInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            const previewId = input.getAttribute('data-preview');
            const preview = previewId ? document.getElementById(previewId) : null;
            const placeholder = document.getElementById('previewPlaceholder');

            if (!preview || !input.files || !input.files[0]) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (placeholder) {
                    placeholder.style.display = 'none';
                }
            };
            reader.readAsDataURL(input.files[0]);
        });
    });
})();

document.querySelectorAll('.drop-zone__input').forEach((inputElement) => {
    const dropZoneElement = inputElement.closest('.drop-zone');

    dropZoneElement.addEventListener('click', (e) => {
        if (e.target !== inputElement) {
            inputElement.click();
        }
    });

    dropZoneElement.addEventListener('dblclick', (e) => {
        if (e.target !== inputElement) {
            inputElement.click();
        }
    });

    inputElement.addEventListener('change', (e) => {
        if (inputElement.files.length) {
            updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
    });

    dropZoneElement.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZoneElement.classList.add('drop-zone--over');
    });

    ['dragleave', 'dragend'].forEach((type) => {
        dropZoneElement.addEventListener(type, (e) => {
            dropZoneElement.classList.remove('drop-zone--over');
        });
    });

    dropZoneElement.addEventListener('drop', (e) => {
        e.preventDefault();
        
        if (e.dataTransfer.files.length) {
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove('drop-zone--over');
    });
});

function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector('.drop-zone__thumb');

    // Remove existing prompt
    if (dropZoneElement.querySelector('.drop-zone__prompt')) {
        dropZoneElement.querySelector('.drop-zone__prompt').style.display = 'none';
    }

    // First time - there is no thumbnail element, so let's create it
    if (!thumbnailElement) {
        thumbnailElement = document.createElement('div');
        thumbnailElement.classList.add('drop-zone__thumb');
        dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    // Show thumbnail for image files
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            thumbnailElement.style.backgroundImage = "url('" + reader.result + "')";
            thumbnailElement.innerHTML = '';
        };
    } else if (file.type.startsWith('audio/')) {
        thumbnailElement.style.backgroundImage = null;
        thumbnailElement.style.backgroundColor = '#009578';
        thumbnailElement.style.display = 'flex';
        thumbnailElement.style.alignItems = 'center';
        thumbnailElement.style.justifyContent = 'center';
        thumbnailElement.innerHTML = '<i class="fas fa-file-audio" style="font-size: 3rem; color: white;"></i>';
    } else {
        thumbnailElement.style.backgroundImage = null;
        thumbnailElement.innerHTML = '';
    }
}
