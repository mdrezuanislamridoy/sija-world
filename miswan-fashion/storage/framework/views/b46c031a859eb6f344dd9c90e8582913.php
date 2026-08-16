<!-- Core JavaScript Assets -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo e(asset('assets/vendor_assets/cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor_assets/cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor_assets/cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js')); ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Custom Cart & AJAX Script -->
<script>
    // Setup Global CSRF Token for all AJAX Requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        // Initialize Select2 if element exists
        if ($('.select2-enable').length > 0) {
            $('.select2-enable').select2({
                theme: 'bootstrap4',
                width: '100%'
            });
        }

        // --- Cart Slide-Out Sheet Behavior ---
        function openCartSheet() {
            $('#cartSheetPanel').addClass('show');
            $('#cartOverlay').addClass('show');
            $('body').addClass('cart-sheet-open');
            $('#cartTrigger').attr('aria-expanded', 'true');
        }

        function closeCartSheet() {
            $('#cartSheetPanel').removeClass('show');
            $('#cartOverlay').removeClass('show');
            $('body').removeClass('cart-sheet-open');
            $('#cartTrigger').attr('aria-expanded', 'false');
        }

        $(document).on('click', '#cartTrigger', function (e) {
            e.preventDefault();
            openCartSheet();
        });

        $(document).on('click', '#cartCloseBtn, #cartOverlay', function (e) {
            e.preventDefault();
            closeCartSheet();
        });

        // --- AJAX: Add To Cart Handler ---
        $(document).on('click', '.ajax-add-to-cart', function (e) {
            e.preventDefault();
            
            var form = document.getElementById('productPurchaseForm');
            if(form && !form.checkValidity()) {
                form.reportValidity();
                return;
            }

            var $btn = $(this);
            var productId = $btn.data('product-id');
            var variantId = $('#selected_variant_id').val() || $btn.data('variant-id') || null;
            var size = $('input[name="size"]').val() || null;
            var quantity = $('#product_quantity').val() || 1;
            var color = $('select[name="color"]').val() || null;

            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Adding...');

            $.ajax({
                url: "<?php echo e(route('cart.add')); ?>",
                method: "POST",
                data: {
                    product_id: productId,
                    variant_id: variantId,
                    size: size,
                    color: color,
                    quantity: quantity
                },
                success: function (res) {
                    $btn.prop('disabled', false).html('<i class="fa fa-shopping-bag"></i> Add to Cart');
                    if (res.status === 'success') {
                        // Update cart count and drawer items
                        $('.cart-count-badge').text(res.cart_count);
                        $('.cart-count-text').text(res.cart_count);
                        $('#cartDrawerItemsList').html(res.drawer_html);
                        $('#cartDrawerSubtotal').text(res.subtotal_formatted);
                        
                        alertify.success(res.message);
                        openCartSheet();
                    } else {
                        alertify.error(res.message || 'Could not add product.');
                    }
                },
                error: function (xhr) {
                    $btn.prop('disabled', false).html('<i class="fa fa-shopping-bag"></i> Add to Cart');
                    alertify.error('An error occurred while adding to cart.');
                }
            });
        });

        // --- AJAX: Remove Item from Cart ---
        $(document).on('click', '.remove-from-cart-btn', function (e) {
            e.preventDefault();
            var cartId = $(this).data('cart-id');

            $.ajax({
                url: "<?php echo e(route('cart.remove')); ?>",
                method: "POST",
                data: { cart_id: cartId },
                success: function (res) {
                    if (res.status === 'success') {
                        $('.cart-count-badge').text(res.cart_count);
                        $('.cart-count-text').text(res.cart_count);
                        $('#cartDrawerItemsList').html(res.drawer_html);
                        $('#cartDrawerSubtotal').text(res.subtotal_formatted);

                        // If on cart page, reload or update table
                        if ($('#cartPageTable').length > 0) {
                            location.reload();
                        }
                        alertify.message('Item removed from cart.');
                    }
                }
            });
        });
    });
</script>

<!-- Flash Message Notifications -->
<?php if(session('success')): ?>
    <script>
        $(document).ready(function() {
            alertify.success("<?php echo e(session('success')); ?>");
        });
    </script>
<?php endif; ?>

<?php if(session('error')): ?>
    <script>
        $(document).ready(function() {
            alertify.error("<?php echo e(session('error')); ?>");
        });
    </script>
<?php endif; ?>
<?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/layouts/partials/scripts.blade.php ENDPATH**/ ?>