@include('layouts.header')

<style>
  body {
    font-family: 'Arial', sans-serif;
    direction: rtl;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
  }
  .container {
    padding: 20px;
  }
  .controls {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    align-items: center;
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
  #qr-reader {
    width: 300px;
    margin-top: 15px;
    display: none;
  }
</style>


</head>
<body>

@include('layouts.nav')






<div class="container">
  <div class="controls">
    <input type="text" id="searchInput" placeholder="ابحث عن منتج...">
    <button onclick="searchTable()">أدخل</button>
    <button onclick="startQrScanner()" class="btn btn-success">📷 مسح QR</button>


</div>


  <table id="productTable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">اسم المنتج</th>
        <th scope="col">الكمية المتواجدة</th>
        <th scope="col">التصنيف</th>
        <th scope="col">تعديل المنتج</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $item)
      <tr>
        <th scope="row">{{ $item->id }}</th>
        <td>{{ $item->productName }}</td>
        <td><span class="badge bg-danger">{{ $item->quantity - $item->pledge }}</span></td>
        @php
          $cat = $category->firstWhere('id', $item->category);
        @endphp
        @if ($cat)
          <td>{{ $cat->Category }} - {{ $cat->refundable ? '(قابل للاسترداد)' : '(غير قابل للاسترداد)' }}</td>
        @else
          <td>تصنيف غير معروف</td>
        @endif
        <td><a href="{{ url('/edit_pledge', $item->id) }}" class="btn btn-primary">اخذ عهدة</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>
  function searchTable() {
  const input = document.getElementById("searchInput").value.toLowerCase();
  const rows  = document.querySelectorAll("#productTable tbody tr");

  rows.forEach(row => {
    const idText = row.cells[0].textContent.toLowerCase();   // first cell (the <th>)
    const match  = idText.includes(input);
    row.style.display = (match || input === "") ? "" : "none";
  });
}


  //function to start QR scanner on phone using http request
  function startQrScanner() {
    const qrReader = document.getElementById("qr-reader");
    if (qrReader.style.display === "none") {
      qrReader.style.display = "block";
      const html5QrCode = new Html5Qrcode("qr-reader");
      html5QrCode.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: { width: 250, height: 250 } },
        (decodedText, decodedResult) => {
          console.log(`Decoded text: ${decodedText}`, decodedResult);
          // Here you can handle the decoded text, e.g., search the table
          const searchInput = document.getElementById("searchInput");
          searchInput.value = decodedText;
          searchTable();
          html5QrCode.stop();
          qrReader.style.display = "none";
        },
        (errorMessage) => {
          console.log(`QR Code no longer in front of camera. Error: ${errorMessage}`);
        }
      ).catch(err => {
        console.error(`Unable to start QR scanner: ${err}`);
      });
    } else {
      qrReader.style.display = "none";
      const html5QrCode = new Html5Qrcode("qr-reader");
      html5QrCode.stop().then(() => {
        console.log("QR scanner stopped.");
      }).catch(err => {
        console.error(`Unable to stop QR scanner: ${err}`);
      });
    }
  } 

 

</script>









</body>
</html>
