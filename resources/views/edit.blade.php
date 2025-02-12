@extends('layouts.app')

@section('content')
<div class="container">
    <h2>แก้ไขการจอง</h2>
    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">ชื่อผู้จอง</label>
            <input type="text" name="name" class="form-control" value="{{ $booking->name }}">
        </div>

        <div class="form-group">
            <label for="room">ห้องพัก</label>
            <input type="text" name="room" class="form-control" value="{{ $booking->room }}">
        </div>

        <button type="submit" class="btn btn-primary">อัปเดต</button>
    </form>
</div>
@endsection
