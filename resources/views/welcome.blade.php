@include('layouts.header')

<style>
 
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

<script src="https://unpkg.com/html5-qrcode"></script>

</head>
<body>

@include('layouts.nav')

@if(session()->has('msg'))
            <div class="alert alert-success">
            {{session()->get('msg')}}
            <button data-dismiss="alert" class="close">X</button>
            </div>
            @endif




<div class="container">
  <div class="controls">
    <input type="text" id="searchInput" placeholder="ابحث عن منتج...">
    <button onclick="searchTable()" style="background-color:#395470;">أدخل</button>
    <button id="scanBtn" style="background-color:#395470;">مسح QR</button>
  <button id="stopBtn" style="display: none;">أوقف الكاميرا</button>

    
  
  
  <div id="qr-reader" style="display: none;"> 
  </div>

</div>


  <table id="productTable" class="table table-striped">



    <thead  style="background-color:#395470;color:white;">
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
        <td>
          <a href="{{ url('/edit_pledge', $item->id) }}" class="btn btn-primary" style="background-color:#202457">اخذ عهدة</a>

           
              @if ($cat->refundable)
                <a href="{{ url('/return_pledge', $item->id) }}" class="btn btn-primary" style="background-color:#20572d">ارجاع عهدة</a>
              
              @endif
          
        </td>
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


  
    const scanBtn = document.getElementById("scanBtn");
    const stopBtn = document.getElementById("stopBtn");
    const searchInput = document.getElementById("searchInput");
    const qrReaderContainer = document.getElementById("qr-reader");

    let html5QrCode;

    scanBtn.addEventListener("click", async () => {
      qrReaderContainer.style.display = "block";
      stopBtn.style.display = "inline-block";

      html5QrCode = new Html5Qrcode("qr-reader");

      try {
        const devices = await Html5Qrcode.getCameras();
        const backCamera = devices.find(cam =>
          cam.label.toLowerCase().includes('back')
        ) || devices[0];

        await html5QrCode.start(
          { deviceId: { exact: backCamera.id } },
          { fps: 10, qrbox: 250 },
          (decodedText) => {
            searchInput.value = decodedText;

            html5QrCode.stop().then(() => {
              qrReaderContainer.style.display = "none";
              stopBtn.style.display = "none";
            });
          },
          (errorMessage) => {
            // Optional: handle scan errors
          }
        );
      } catch (err) {
        alert("Camera error: " + err.message);
        stopBtn.style.display = "none";
      }
    });

    stopBtn.addEventListener("click", async () => {
      if (html5QrCode) {
        await html5QrCode.stop();
        qrReaderContainer.style.display = "none";
        stopBtn.style.display = "none";
      }
    });
  

</script>









</body>
</html>
