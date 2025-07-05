@include('layouts.header')
    <title>تعديل المنتج</title>
</head>
<body>

    
    <form action="/update_product/{{ $product->id }}" method="post" class="container mt-5">
    @csrf
        <h1 class="d-flex justify-content-center">تعديل المنتج</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="mb-3">
                        <label for="productName" class="form-label">اسم المنتج</label>
                        <input type="text" class="form-control" id="productName" name="productName" value="{{ $product->productName }}" required>
                        
                        <label for="quintity"> الكمية</label>
                        <input type="number" class="form-control" id="quintity" name="quantity" value="{{ $product->quantity }}" required>
                        
                        <label for="pledge">عدد العهد</label>
                        <input type="number" class="form-control" id="pledge" name="pledge" value="{{ $product->pledge }}" required>

                        <label for="category">التصنيف</label>
                        <select class="form-select" id="category" name="category" required>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $product->category ? 'selected' : '' }}>
                                    {{ $item->Category }} - ({{ $item->refundable ? 'قابل للاسترداد' : 'غير قابل للاسترداد' }})
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <input type="submit" class="btn btn-primary" value="تحديث المنتج">
    </form>

</body>
</html>