@include('layouts.header')
    <title>لوحة التحكم</title>
</head>
<body>
@if(session()->has('msg'))
            <div class="alert alert-success">
            {{session()->get('msg')}}
            <button data-dismiss="alert" class="close">X</button>
            </div>
            @endif


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
        
        <input type="text" name="caregory" placeholder="اكتب التصنيف الجديد">
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


</body>
</html>