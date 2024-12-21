@extends('userside.userside_source.userside_template')
<style>
    body {
    background-color: #f7f9fc;
    font-family: 'Poppins', sans-serif;
}

.card-header {
    background: linear-gradient(135deg, #6c63ff, #3f2b96);
    color: #fff;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.card {
    margin-top: 90px;
    background-color: #fff;
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.table th {
    font-weight: 600;
    color: #3f2b96;
    font-size: 16px;
}

.table td {
    color: #333;
    font-size: 16px;
}

.btn-primary {
    background-color: #6c63ff;
    border: none;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #3f2b96;
}

</style>
@section('content')
<div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 600px; border-radius: 15px;">
        <div class="card-header bg-primary text-white text-center" style="border-radius: 15px 15px 0 0;">
            <h3>Edit Profile</h3>
        </div>
        <div class="card-body">
            <!-- عرض الرسائل إذا كانت موجودة -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- نموذج تعديل الملف الشخصي -->
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PUT') <!-- تحديد أنه POST لكن نوعه UPDATE -->
                
                <div class="form-group mb-3">
                    <label for="First_Name" class="form-label">First Name</label>
                    <input type="text" name="First_Name" id="First_Name" class="form-control" value="{{ old('First_Name', $user->First_Name) }}" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="Last_name" class="form-label">Last Name</label>
                    <input type="text" name="Last_name" id="Last_name" class="form-control" value="{{ old('Last_name', $user->Last_name) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $user->address) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">New Password (Optional)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password (Optional)</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
