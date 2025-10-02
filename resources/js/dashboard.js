// Dữ liệu mẫu
const stats = [
    { title: "Tổng đơn hàng", value: "1,234", icon: "fa-shopping-cart", card: "stats-card" },
    { title: "Doanh thu", value: "₫45.2M", icon: "fa-dollar-sign", card: "stats-card-2" },
    { title: "Khách hàng", value: "892", icon: "fa-users", card: "stats-card-3" },
    { title: "Sản phẩm", value: "156", icon: "fa-box", card: "stats-card-4" }
];

const orders = [
    { id: "#DH001", customer: "Nguyễn Văn A", status: "Hoàn thành", statusClass: "bg-green-100 text-green-800" },
    { id: "#DH002", customer: "Trần Thị B", status: "Đang xử lý", statusClass: "bg-yellow-100 text-yellow-800" }
];

const stockAlerts = [
    { product: "iPhone 14", qty: 5, label: "Sắp hết", cls: "bg-red-100 text-red-800", box: "bg-red-50" },
    { product: "Samsung Galaxy S23", qty: 12, label: "Thấp", cls: "bg-orange-100 text-orange-800", box: "bg-orange-50" }
];

// Render thống kê
function renderStats() {
    const container = document.getElementById("stats-container");
    if (!container) return;
    container.innerHTML = stats.map(s => `
        <div class="${s.card} text-white p-6 rounded-lg card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">${s.title}</p>
                    <p class="text-2xl font-bold">${s.value}</p>
                </div>
                <i class="fas ${s.icon} text-3xl opacity-80"></i>
            </div>
        </div>
    `).join("");
}

// Render đơn hàng gần đây
function renderOrders() {
    const container = document.getElementById("recent-orders");
    if (!container) return;
    container.innerHTML = orders.map(o => `
        <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
            <div>
                <p class="font-medium">${o.id}</p>
                <p class="text-sm text-gray-600">${o.customer}</p>
            </div>
            <span class="${o.statusClass} px-2 py-1 rounded text-sm">${o.status}</span>
        </div>
    `).join("");
}

// Render cảnh báo tồn kho
function renderStockAlerts() {
    const container = document.getElementById("stock-alerts");
    if (!container) return;
    container.innerHTML = stockAlerts.map(s => `
        <div class="flex items-center justify-between p-3 ${s.box} rounded">
            <div>
                <p class="font-medium">${s.product}</p>
                <p class="text-sm text-gray-600">Còn lại: ${s.qty} sản phẩm</p>
            </div>
            <span class="${s.cls} px-2 py-1 rounded text-sm">${s.label}</span>
        </div>
    `).join("");
}

// Gọi render khi load
document.addEventListener("DOMContentLoaded", () => {
    renderStats();
    renderOrders();
    renderStockAlerts();
});
