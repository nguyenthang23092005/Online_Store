<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-100 p-6">
    <div id="staff" class="section">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Danh sách nhân viên</h2>
                <p class="text-gray-600 mt-1">Quản lý thông tin và quyền hạn nhân viên</p>
            </div>
            <button class="gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all duration-200" onclick="openAddStaffModal()">
                <i class="fas fa-plus mr-2"></i>Thêm nhân viên
            </button>
        </div>

        <!-- Ô thống kê -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-crown text-purple-600"></i>
                    </div>
                    <div>
                        <p id="adminCount" class="text-2xl font-bold text-gray-800">0</p>
                        <p class="text-sm text-gray-600">Admin</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-shopping-cart text-blue-600"></i>
                    </div>
                    <div>
                        <p id="orderCount" class="text-2xl font-bold text-gray-800">0</p>
                        <p class="text-sm text-gray-600">Order Manager</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-warehouse text-green-600"></i>
                    </div>
                    <div>
                        <p id="storekeeperCount" class="text-2xl font-bold text-gray-800">0</p>
                        <p class="text-sm text-gray-600">Storekeeper</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-headset text-yellow-600"></i>
                    </div>
                    <div>
                        <p id="supportCount" class="text-2xl font-bold text-gray-800">0</p>
                        <p class="text-sm text-gray-600">Support Staff</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bảng nhân viên -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 border-b">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Tìm kiếm nhân viên..." class="pl-10 pr-4 py-2 border rounded-lg w-full md:w-64" id="staffSearch" oninput="filterStaff()">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <select class="border rounded-lg px-4 py-2" id="roleFilter" onchange="filterStaff()">
                            <option value="">Tất cả chức vụ</option>
                            <option value="Admin">Admin</option>
                            <option value="Order Manager">Order Manager</option>
                            <option value="Storekeeper">Storekeeper</option>
                            <option value="Support Staff">Support Staff</option>
                        </select>
                        <select class="border rounded-lg px-4 py-2" id="statusFilter" onchange="filterStaff()">
                            <option value="">Tất cả trạng thái</option>
                            <option value="active">Hoạt động</option>
                            <option value="inactive">Không hoạt động</option>
                            <option value="suspended">Tạm khóa</option>
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-download mr-2"></i>Xuất Excel
                        </button>
                        <button class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition-colors">
                            <i class="fas fa-filter mr-2"></i>Bộ lọc
                        </button>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full" id="staffTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nhân viên</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Chức vụ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Liên hệ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="staffBody" class="divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    // Dữ liệu nhân viên mẫu
    let staffList = [
        { id: "#NV001", name: "Nguyễn Văn A", role: "Admin", status: "active", email: "a.nguyen@email.com" },
        { id: "#NV002", name: "Trần Thị B", role: "Support Staff", status: "inactive", email: "b.tran@email.com" },
        { id: "#NV003", name: "Phạm Văn C", role: "Order Manager", status: "active", email: "c.pham@email.com" }
    ];

    // Render danh sách nhân viên
    function renderStaff(list = staffList) {
        const tbody = document.getElementById("staffBody");
        tbody.innerHTML = "";

        list.forEach(staff => {
            let statusClass = staff.status === "active" ? "bg-green-100 text-green-800"
                            : staff.status === "inactive" ? "bg-gray-200 text-gray-600"
                            : "bg-yellow-100 text-yellow-800";

            tbody.innerHTML += `
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=${encodeURIComponent(staff.name)}" alt="">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${staff.name}</div>
                                <div class="text-sm text-gray-500">ID: ${staff.id}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${staff.role}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                            ${staff.status}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${staff.email}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-indigo-600 hover:text-indigo-900" onclick="editStaff('${staff.id}')">Sửa</button>
                        <button class="text-red-600 hover:text-red-900 ml-4" onclick="deleteStaff('${staff.id}')">Xóa</button>
                    </td>
                </tr>
            `;
        });

        updateRoleCount();
    }

    // Thêm nhân viên
    function openAddStaffModal() {
        alert("Mở form thêm nhân viên (chưa code modal).");
    }

    // Sửa nhân viên
    function editStaff(id) {
        alert("Sửa nhân viên: " + id);
    }

    // Xóa nhân viên
    function deleteStaff(id) {
        if (confirm("Bạn có chắc muốn xóa nhân viên " + id + " không?")) {
            staffList = staffList.filter(s => s.id !== id);
            renderStaff();
        }
    }

    // Bộ lọc
    function filterStaff() {
        let search = document.getElementById("staffSearch").value.toLowerCase();
        let role = document.getElementById("roleFilter").value;
        let status = document.getElementById("statusFilter").value;

        let filtered = staffList.filter(s => 
            s.name.toLowerCase().includes(search) &&
            (role === "" || s.role === role) &&
            (status === "" || s.status === status)
        );

        renderStaff(filtered);
    }

    // Cập nhật số lượng theo chức vụ
    function updateRoleCount() {
        document.getElementById("adminCount").innerText = staffList.filter(s => s.role === "Admin").length;
        document.getElementById("orderCount").innerText = staffList.filter(s => s.role === "Order Manager").length;
        document.getElementById("storekeeperCount").innerText = staffList.filter(s => s.role === "Storekeeper").length;
        document.getElementById("supportCount").innerText = staffList.filter(s => s.role === "Support Staff").length;
    }

    // Load khi mở trang
    document.addEventListener("DOMContentLoaded", renderStaff);
    </script>
</body>
</html>

