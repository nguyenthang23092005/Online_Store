<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khách hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <!-- SheetJS để xuất Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>
<body class="bg-gray-100 p-6">
<div id="customers" class="section">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Danh sách khách hàng</h2>
            <p class="text-gray-600 mt-1">Khách hàng tự đăng ký tài khoản trên website</p>
        </div>
        <div class="flex space-x-2">
            <button id="exportExcel" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-download mr-2"></i>Xuất Excel
            </button>
            <button class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition-colors">
                <i class="fas fa-filter mr-2"></i>Bộ lọc
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b">
            <div class="flex space-x-4">
                <input id="searchInput" type="text" placeholder="Tìm kiếm khách hàng..." class="flex-1 border rounded-lg px-4 py-2">
                <select id="statusSelect" class="border rounded-lg px-4 py-2">
                    <option>Tất cả trạng thái</option>
                    <option>Hoạt động</option>
                    <option>Không hoạt động</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table id="customerTable" class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên khách hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Số điện thoại</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Nguyễn Văn A</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">nguyenvana@email.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0123456789</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Hoạt động</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3">Sửa</button>
                            <button class="text-red-600 hover:text-red-900">Xóa</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#002</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Trần Thị B</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">tranthib@email.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0987654321</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Hoạt động</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3">Sửa</button>
                            <button class="text-red-600 hover:text-red-900">Xóa</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const statusSelect = document.getElementById('statusSelect');
    const tableBody = document.querySelector('#customerTable tbody');
    const exportBtn = document.getElementById('exportExcel');

    const rows = Array.from(tableBody.querySelectorAll('tr'));

    // Tìm kiếm khách hàng
    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase();
        rows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const email = row.cells[2].textContent.toLowerCase();
            const phone = row.cells[3].textContent.toLowerCase();
            row.style.display = (name.includes(query) || email.includes(query) || phone.includes(query)) ? '' : 'none';
        });
    });

    // Lọc trạng thái
    statusSelect.addEventListener('change', () => {
        const filter = statusSelect.value;
        rows.forEach(row => {
            const status = row.cells[4].textContent.trim();
            if(filter === 'Tất cả trạng thái' || filter === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Xóa khách hàng
    tableBody.addEventListener('click', e => {
        if(e.target.textContent === 'Xóa') {
            const row = e.target.closest('tr');
            if(confirm(`Bạn có chắc chắn muốn xóa khách hàng ${row.cells[1].textContent}?`)) {
                row.remove();
            }
        }
    });

    // Xuất Excel
    exportBtn.addEventListener('click', () => {
        const visibleRows = rows.filter(row => row.style.display !== 'none');
        const data = visibleRows.map(row => ({
            ID: row.cells[0].textContent,
            Tên: row.cells[1].textContent,
            Email: row.cells[2].textContent,
            Số_điện_thoại: row.cells[3].textContent,
            Trạng_thái: row.cells[4].textContent.trim()
        }));
        const ws = XLSX.utils.json_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "KhachHang");
        XLSX.writeFile(wb, "Danh_sach_khach_hang.xlsx");
    });
});
</script>
</body>
</html>
