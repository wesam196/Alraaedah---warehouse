@include('layouts.header')
</head>
<body>
@include('layouts.nav')



@foreach ($users as $user)
    <div class="container mt-5">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">{{ $user->email }}</p>    
                <p class="card-text">
                    @if ($user->usertype == 0)
                        مستخدم عادي
                    @elseif ($user->usertype == 1)
                        مشرف
                    @elseif ($user->usertype == 2)
                        مدير
                    @else
                        نوع مستخدم غير معروف
                    @endif 
                </p>
                <form action="{{ url('/update_user', $user->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="usertype" class="form-label">تغيير نوع المستخدم</label>
                        <select class="form-select" id="usertype" name="usertype" required>
                            <option value="0" {{ $user->usertype == 0 ? 'selected' : '' }}>مستخدم عادي</option>
                            <option value="1" {{ $user->usertype == 1 ? 'selected' : '' }}>مشرف</option>
                            <option value="2" {{ $user->usertype == 2 ? 'selected' : '' }}>مدير</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">تحديث المستخدم</button>
                    <a href="{{ url('/delete_user', $user->id) }}" class="btn btn-danger">حذف المستخدم</a>
                    <a href="{{ url('/reset_password', $user->id) }}" class="btn btn-warning">إعادة تعيين كلمة المرور</a>
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>


</body>