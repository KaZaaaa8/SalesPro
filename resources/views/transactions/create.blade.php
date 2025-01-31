<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white">Transaksi Baru</h1>
                    <p class="text-gray-400 mt-1">Buat transaksi penjualan baru</p>
                </div>
                <a href="{{ route('transactions.index') }}"
                    class="flex items-center px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Daftar Produk -->
            <div class="lg:col-span-2">
                <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
                    <div class="mb-4">
                        <input type="text"
                            id="searchProduct"
                            placeholder="Cari produk..."
                            class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4" id="productList">
                        @foreach($products as $product)
                        <div class="product-item bg-dark-primary rounded-lg border border-gray-700 p-4 cursor-pointer hover:border-blue-500 transition-colors duration-200"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}"
                            data-stock="{{ $product->stock }}">
                            <div class="text-center mb-2">
                                <i class="fas fa-box text-3xl text-gray-600"></i>
                            </div>
                            <h3 class="text-sm font-mexdium text-gray-300 truncate">{{ $product->name }}</h3>
                            <p class="text-xs text-gray-500 mb-2">Stok: {{ $product->stock }}</p>
                            <p class="text-sm font-semibold text-blue-400">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Form Transaksi -->
            <div class="lg:col-span-1">
                <form id="transactionForm" action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="bg-dark-secondary rounded-xl border border-gray-700 p-6">
                        <h2 class="text-lg font-semibold text-white mb-4">Detail Transaksi</h2>

                        <!-- Invoice Number -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                Nomor Invoice
                            </label>
                            <input type="text"
                                name="invoice_number"
                                value="INV-{{ date('Ymd') }}-{{ rand(1000, 9999) }}"
                                class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300"
                                readonly>
                        </div>

                        <!-- Daftar Item -->
                        <div id="cartItems" class="space-y-3 mb-4">
                            <!-- Items will be added here dynamically -->
                        </div>

                        <!-- Ringkasan Pembayaran -->
                        <div class="border-t border-gray-700 pt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Subtotal</span>
                                <span class="text-gray-300" id="subtotal">Rp 0</span>
                                <input type="hidden" name="subtotal" id="subtotalInput">
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">PPN (12%)</span>
                                <span class="text-gray-300" id="tax">Rp 0</span>
                                <input type="hidden" name="tax" id="taxInput">
                            </div>
                            <div class="flex justify-between text-lg font-semibold">
                                <span class="text-gray-400">Total</span>
                                <span class="text-white" id="total">Rp 0</span>
                                <input type="hidden" name="total_amount" id="totalInput">
                            </div>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                Metode Pembayaran
                            </label>
                            <select name="payment_method"
                                class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500">
                                <option value="cash">Tunai</option>
                                <option value="card">Kartu</option>
                            </select>
                        </div>

                        <!-- Jumlah Bayar -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                Jumlah Bayar
                            </label>
                            <input type="number"
                                name="payment_amount"
                                id="paymentAmount"
                                class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                                min="0"
                                step="1000"
                                required>
                        </div>

                        <!-- Kembalian -->
                        <div class="mt-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Kembalian</span>
                                <span class="text-gray-300" id="changeAmount">Rp 0</span>
                                <input type="hidden" name="change_amount" id="changeInput">
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                Catatan
                            </label>
                            <textarea name="notes"
                                rows="2"
                                class="w-full px-4 py-2 bg-dark-primary border border-gray-700 rounded-lg text-gray-300 focus:outline-none focus:border-blue-500"
                                placeholder="Tambahkan catatan jika diperlukan"></textarea>
                        </div>

                        <div id="errorMessages" class="mt-4 text-red-500 text-sm"></div>

                        <button type="submit"
                            id="submitBtn"
                            class="w-full mt-6 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 disabled:opacity-50"
                            disabled>
                            Proses Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let cart = [];
        const TAX_RATE = 0.12;

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.product-item').forEach(item => {
                item.addEventListener('click', function() {
                    let productId = this.getAttribute('data-id');
                    addToCart(productId);
                });
            });
        });

        // Format currency to Rupiah
        function formatRupiah(amount) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(amount));
        }

        // Add product to cart
        function addToCart(productId) {
            const productEl = document.querySelector(`.product-item[data-id="${productId}"]`);
            const product = {
                id: parseInt(productEl.dataset.id),
                name: productEl.dataset.name,
                price: parseFloat(productEl.dataset.price),
                stock: parseInt(productEl.dataset.stock)
            };

            console.log('Adding product:', product); // Debug log

            const existingItem = cart.find(item => item.id === product.id);

            if (existingItem) {
                if (existingItem.quantity < product.stock) {
                    existingItem.quantity++;
                    updateCartDisplay();
                } else {
                    alert('Stok tidak mencukupi!');
                }
            } else {
                if (product.stock > 0) {
                    cart.push({
                        ...product,
                        quantity: 1
                    });
                    updateCartDisplay();
                }
            }
        }

        // Update cart display
        function updateCartDisplay() {
            const cartContainer = document.getElementById('cartItems');
            cartContainer.innerHTML = '';

            let subtotal = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                const itemEl = document.createElement('div');
                itemEl.className = 'flex items-center justify-between bg-dark-primary p-3 rounded-lg';
                itemEl.innerHTML = `
                <div class="flex-1">
                    <p class="text-sm text-gray-300">${item.name}</p>
                    <p class="text-xs text-gray-500">@ ${formatRupiah(item.price)}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <button type="button" onclick="updateQuantity(${item.id}, ${item.quantity - 1})" 
                                class="text-gray-400 hover:text-white">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="text-gray-300">${item.quantity}</span>
                        <button type="button" onclick="updateQuantity(${item.id}, ${item.quantity + 1})"
                                class="text-gray-400 hover:text-white">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-blue-400">${formatRupiah(itemTotal)}</p>
                    <button type="button" onclick="removeItem(${item.id})" 
                            class="text-xs text-red-400 hover:text-red-300 mt-1">
                        Hapus
                    </button>
                </div>
                <input type="hidden" name="items[${item.id}][product_id]" value="${item.id}">
                <input type="hidden" name="items[${item.id}][quantity]" value="${item.quantity}">
            `;
                cartContainer.appendChild(itemEl);
            });

            const tax = subtotal * TAX_RATE;
            const total = subtotal + tax;

            // Update display values
            document.getElementById('subtotal').textContent = formatRupiah(subtotal);
            document.getElementById('tax').textContent = formatRupiah(tax);
            document.getElementById('total').textContent = formatRupiah(total);

            // Update hidden inputs
            document.getElementById('subtotalInput').value = subtotal.toFixed(2);
            document.getElementById('taxInput').value = tax.toFixed(2);
            document.getElementById('totalInput').value = total.toFixed(2);

            calculateChange();

            // Update submit button state
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = cart.length === 0;
        }

        // Update product quantity
        function updateQuantity(productId, newQuantity) {
            const item = cart.find(item => item.id === productId);
            if (!item) return;

            if (newQuantity <= 0) {
                removeItem(productId);
                return;
            }

            if (newQuantity > item.stock) {
                alert('Stok tidak mencukupi!');
                return;
            }

            item.quantity = newQuantity;
            updateCartDisplay();
        }

        // Remove item from cart
        function removeItem(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCartDisplay();
        }

        // Calculate change amount
        function calculateChange() {
            const total = parseFloat(document.getElementById('totalInput').value) || 0;
            const paymentAmount = parseFloat(document.getElementById('paymentAmount').value) || 0;
            const change = paymentAmount - total;

            document.getElementById('changeAmount').textContent = formatRupiah(Math.max(0, change));
            document.getElementById('changeInput').value = Math.max(0, change).toFixed(2);

            const submitBtn = document.getElementById('submitBtn');
            const errorMessages = document.getElementById('errorMessages');

            if (paymentAmount < total && paymentAmount > 0) {
                errorMessages.textContent = 'Jumlah pembayaran kurang dari total transaksi';
                submitBtn.disabled = true;
            } else {
                errorMessages.textContent = '';
                submitBtn.disabled = cart.length === 0 || paymentAmount < total;
            }
        }

        // Initialize event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Product search
            document.getElementById('searchProduct').addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                document.querySelectorAll('.product-item').forEach(product => {
                    const name = product.dataset.name.toLowerCase();
                    product.style.display = name.includes(searchTerm) ? 'block' : 'none';
                });
            });

            // Payment amount input
            document.getElementById('paymentAmount').addEventListener('input', calculateChange);
        });
    </script>
</x-app-layout>