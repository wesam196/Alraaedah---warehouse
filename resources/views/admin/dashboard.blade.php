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


    <h1>الأصناف</h1>
    @foreach ($data as $item)

        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم التصنيف</th>
      <th scope="col">حذف التصنيف</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{$item->id}}</th>
      <td>{{$item->Category}}</td>
      <td><a  onclick="return confirm('are you sure you wnat delete ( {{$item->Category}} )')" href="{{url('/delete_category',$item->id)}}" class="btn btn-danger">Delete</a></td>
    </tr>
   
    
  </tbody>
</table>





    @endforeach
    <form action="{{url('/add_category')}}" method="post">
        @csrf
        <h3>إضافة تصنيف</h3>
            <input type="text" name="caregory" placeholder="اكتب التصنيف الجديد">
            <input type="submit" placeholder="ارسال">




    </form>

<hr>
<hr>
<hr>
<hr>
<hr>


</body>
</html>