@include('layouts.header')
</head>
<body>
@include('layouts.nav')



@foreach ($users as $user)
    <div class="container mt-5" >
        <div class="card mb-3" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">{{ $user->email }}</p>    
                <div class="card-text">
                    @if ($user->usertype == 0)
                    <p class="btn btn-secondary" style="background-color: #12691a; color: white;">   
                    مستخدم 
                    </p>
                    @elseif ($user->usertype == 1)
                    <p class="btn btn-secondary" style="background-color: #103552; color: white;">   
  
                    مشرف
                    </p>
                    @elseif ($user->usertype == 2)
                    <p class="btn btn-secondary" style="background-color: #1b1b1c; color: white;">   
                    مدير
                    </p>
                    @else
                        نوع مستخدم غير معروف
                    @endif 
                </div>
                <form action="{{ url('/update_user', $user->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="usertype" class="form-label">تغيير نوع المستخدم</label>
                        <select class="form-select" id="usertype" name="usertype" required>
                            <option value="0" {{ $user->usertype == 0 ? 'selected' : '' }}>مستخدم </option>
                            <option value="1" {{ $user->usertype == 1 ? 'selected' : '' }}>مشرف</option>
                            <option value="2" {{ $user->usertype == 2 ? 'selected' : '' }}>مدير</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color:#395470">تحديث المستخدم</button>
                    <a href="{{ url('/delete_user', $user->id) }}" class="btn btn-danger" style="background-color:#910d1a">حذف المستخدم</a>
                    <a href="{{ url('/reset_password', $user->id) }}" class="btn btn-warning" style="background-color:#e6be1e; border:none">إعادة تعيين كلمة المرور</a>
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>


</body>