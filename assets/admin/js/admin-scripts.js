document.addEventListener('DOMContentLoaded', function () {
    // Initialize Bootstrap tooltips with custom content
    const tooltipTriggerList = document.querySelectorAll('.product-image');
    tooltipTriggerList.forEach(img => {
        new bootstrap.Tooltip(img, {
            trigger: 'click',
            html: true,
            title: `
                    <div class="image-options">
                        <div class="option magnify-option">
                            <i class="fas fa-search-plus"></i> Magnify
                        </div>
                        <div class="option change-image-option">
                            <i class="fas fa-camera"></i> Change Image
                        </div>
                    </div>
                `,
            placement: 'right',
            customClass: 'product-image-tooltip'
        });
    });

    // Handle tooltip option clicks
    document.addEventListener('click', function (event) {
        const tooltipOption = event.target.closest('.option');
        if (tooltipOption) {
            const tooltip = event.target.closest('.tooltip');
            const img = document.querySelector('[aria-describedby="' + tooltip.getAttribute('id') + '"]');

            if (tooltipOption.classList.contains('magnify-option')) {
                // Handle magnify
                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                document.getElementById('enlargedImage').src = img.src;
                modal.show();
            } else if (tooltipOption.classList.contains('change-image-option')) {
                // Handle image change
                const fileInput = img.closest('.product-image-cell').querySelector('.image-upload');
                fileInput.click();
            }

            // Hide the tooltip
            const tooltipInstance = bootstrap.Tooltip.getInstance(img);
            if (tooltipInstance) {
                tooltipInstance.hide();
            }
        }

        // Close tooltips when clicking outside
        if (!event.target.closest('.product-image') &&
            !event.target.closest('.tooltip')) {
            tooltipTriggerList.forEach(el => {
                const tooltip = bootstrap.Tooltip.getInstance(el);
                if (tooltip) {
                    tooltip.hide();
                }
            });
        }
    });

    // Handle image upload
    document.querySelectorAll('.image-upload').forEach(input => {
        input.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                const img = this.closest('.product-image-cell').querySelector('.product-image');

                reader.onload = function (e) {
                    img.src = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
    });
});