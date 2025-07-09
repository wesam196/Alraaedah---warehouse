@include('layouts.header')
    <title>تعديل المنتج</title>
</head>
<body>
@include('layouts.nav')
<form action="/update_category/{{ $category->id }}" method="post" class="container mt-5">
    @csrf
    <h1 class="d-flex justify-content-center">تعديل التصنيف</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="mb-3">
                    <label for="Category" class="form-label">اسم التصنيف</label>
                    <input type="text" class="form-control" id="Category" name="Category" value="{{ $category->Category }}" required>
                    
                    <label for="refundable">نوع التصنيف</label>
                    <select class="form-select" id="refundable" name="refundable" required>
                        <option value="1" {{ $category->refundable ? 'selected' : '' }}>قابل للاسترداد</option>
                        <option value="0" {{ !$category->refundable ? 'selected' : '' }}>غير قابل للاسترداد</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" value="تحديث التصنيف">
            </div>
        </div>
    </div>