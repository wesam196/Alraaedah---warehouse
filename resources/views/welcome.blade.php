<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>جدول المنتجات</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      direction: rtl;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    header {
      background-color: #004080;
      color: white;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    header .logo {
      font-size: 24px;
      font-weight: bold;
    }

    .container {
      padding: 20px;
    }

    .controls {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    input[type="text"] {
      padding: 10px;
      width: 300px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      padding: 10px 20px;
      border: none;
      background-color: #004080;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0066cc;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }

    th {
      background-color: #f0f0f0;
    }

    img {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }
  </style>
</head>
<body>

  <header>
    <div class="logo">شعار الشركة</div>
    <div>لوحة تحكم المنتجات</div>
  </header>

  <div class="container">
    <div class="controls">
      <input type="text" id="searchInput" placeholder="ابحث عن منتج...">
      <button onclick="searchTable()">أدخل</button>
      <button onclick="openCamera()">افتح الكاميرا</button>
    </div>

    <table id="productTable">
      <thead>
        <tr>
          <th>معرف المنتج</th>
          <th>اسم المنتج</th>
          <th>الكمية</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>001</td>
          <td>هاتف ذكي</td>
          <td>10</td>
        </tr>
        <tr>
          <td>002</td>
          <td>حاسوب محمول</td>
          <td>20</td>
        </tr>
        <tr>
          <td>003</td>
          <td>سماعات رأس</td>
          <td>30</td>
        </tr>
      </tbody>
    </table>
  </div>

  <script>
    function searchTable() {
      const input = document.getElementById("searchInput").value.toLowerCase();
      const table = document.getElementById("productTable");
      const rows = table.getElementsByTagName("tr");

      for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let found = false;
        for (let j = 0; j < 2; j++) {
          if (cells[j].textContent.toLowerCase().includes(input)) {
            found = true;
            break;
          }
        }
        rows[i].style.display = found ? "" : "none";
      }
    }

    function openCamera() {
      alert("سيتم فتح الكاميرا (هذه ميزة وهمية، تحتاج إلى تنفيذ متقدم)");
      // لإضافة وظيفة فعلية، ستحتاج إلى استخدام WebRTC أو مكتبة متقدمة
    }
  </script>

</body>
</html>
