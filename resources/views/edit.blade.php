<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل بيانات المستخدم</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow border-0 rounded-3 mx-auto" style="max-width: 600px;">
        <div class="card-header bg-warning text-dark py-3">
            <h5 class="mb-0 fw-bold">تعديل بيانات المستخدم</h5>
        </div>
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 shared-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">الاسم الكامل</label>
                    <input type="text" name="name" id="name" class="form-control py-2" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" class="form-control py-2" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">كلمة المرور الجديدة (اتركها فارغة لعدم التغيير)</label>
                    <input type="password" name="password" id="password" class="form-control py-2">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary px-4">تحديث البيانات</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary px-4">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
