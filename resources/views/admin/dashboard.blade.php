@include('layouts.header')
    <title>لوحة التحكم</title>


  <script>
      window.onload = function() {
          @foreach ($products as $product)
              @if ($product->quantity <= 10)
                  document.getElementById('alert').innerHTML += 'المنتج {{ $product->productName }} لديه كمية قليلة: {{ $product->quantity }} فقط.<br>';
                 
              @endif
          @endforeach
      };
  </script>

</head>
<body>
@if(session()->has('msg'))
            <div class="alert alert-success">
            {{session()->get('msg')}}
            <button data-dismiss="alert" class="close">X</button>
            </div>
            @endif




            <div class="alert alert-danger " id="alert" role="alert">
              
            </div>


    <h1 class="d-flex justify-content-center">الأصناف</h1>
   

        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم التصنيف</th>
      <th scope="col">نوع التصنيف</th>
      <th scope="col">حذف التصنيف</th>
    </tr>
  </thead>
  
  <tbody>
  @foreach ($category as $item)
    <tr>
      <th scope="row">{{$item->id}}</th>
      <td>{{$item->Category}}</td>
      <td>
        @if($item->refundable)
          <span class="badge bg-success">قابل للاسترداد</span>
        @else
          <span class="badge bg-danger">غير قابل للاسترداد</span>
        @endif
      
      <td><a  onclick="return confirm('هل أنت متأكد تود حذف  ( {{$item->Category}} )')" href="{{url('/delete_category',$item->id)}}" class="btn btn-danger">حذف</a></td>
    </tr>
   
    @endforeach
  </tbody>
  
 
</table>



    <br><br><br>


    <h3 class="d-flex justify-content-center">إضافة تصنيف</h3>
    <form action="{{url('/add_category')}}" method="post" class="d-flex justify-content-center">
        @csrf
        
        <input type="text" name="caregory" placeholder="اكتب التصنيف الجديد" required>
        <select name="refundable" class="form-select" aria-label="Default select example">
            <option value="1">قابل للاسترداد</option>
            <option value="0">غير قابل للاسترداد</option>
        </select>
        <input type="submit" placeholder="ارسال">
    </form>

<hr>
<hr>
<hr>
<hr>
<hr>


<h1 class="d-flex justify-content-center">المنتجات</h1>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم المنتج</th>
      <th scope="col">الكمية الإجمالية</th>
      <th scope="col">الكمية المتواجدة</th>
      <th scope="col">التصنيف</th>
      <th scope="col">تعديل المنتج</th>
      <th scope="col">حذف المنتج</th>
      
    </tr>
  </thead>
  
  <tbody>
  @foreach ($products as $item)
    <tr>
      <th scope="row">{{$item->id}}</th>
      <td>{{$item->productName}}</td>
      <td>{{$item->quantity}}</td>
      <td> <span class="badge bg-danger">{{$item->quantity - $item->pledge}}</span> </td>
      
      @foreach ($category as $cat)
        @if($cat->id == $item->category)
          @if($cat->refundable)
            <td>{{$cat->Category}} - (قابل للاسترداد)</td>
          @else
            <td>{{$cat->Category}} - (غير قابل للاسترداد)</td>
          @endif
        @endif
      @endforeach
      
      <td><a href="{{url('/edit_product',$item->id)}}" class="btn btn-primary">تعديل</a></td>
      <td><a onclick="return confirm('هل أنت متأكد تود حذف  ( {{$item->productName}} )')" href="{{url('/delete_product',$item->id)}}" class="btn btn-danger">حذف</a></td>
   
    </tr>
   
    @endforeach
  </tbody>
</table>


    <br><br><br>

    <h3 class="d-flex justify-content-center">إضافة منتج</h3>
    <form action="{{url('/add_product')}}" method="post" class="d-flex justify-content-center">
        @csrf
        
        <input type="text" name="productName" placeholder="اكتب اسم المنتج" required>
        <input type="number" name="quantity" placeholder="اكتب الكمية الإجمالية" required>
        <select name="category" class="form-select" aria-label="Default select example">
            @foreach ($category as $item)
              @if($item->refundable)
                <option value="{{$item->id}}">{{$item->Category}} - (قابل للاسترداد)</option>
              @else 
                <option value="{{$item->id}}">{{$item->Category}} - (غير قابل للاسترداد )</option>
              @endif
            @endforeach
        </select>
        <input type="submit" placeholder="ارسال">
    </form>

</body>
</html>