import React, { useState, useEffect } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useForm, Head } from '@inertiajs/react';

export default function CreateBooking() {
    const { data, setData, post, processing, errors, reset } = useForm({
        guest_name: "",
        check_in: "",
        check_out: "",
        room_number: "",
        roomtype: "",
        total_price: "",
    });

    const roomPrices = {
        "Standard": 1000, // Standard
        "Suite": 2000, // Suite
        "VIP": 5000  // VIP
    };

    const [message, setMessage] = useState('');
    const [messageType, setMessageType] = useState('');

    const calculateTotalPrice = () => {
        if (data.roomtype && data.check_in && data.check_out) {
            const pricePerNight = roomPrices[data.roomtype] || 0;
            console.log("Room Type:", data.roomtype, "Price per night:", pricePerNight);

            const checkInDate = new Date(data.check_in);
            const checkOutDate = new Date(data.check_out);
            console.log("Check-in:", checkInDate, "Check-out:", checkOutDate);

            if (checkInDate >= checkOutDate) {
                setData('total_price', ''); // Clear total_price if dates are invalid
                setMessage('Check-out date must be after check-in date');
                setMessageType('error');
                return;
            }

            const nights = (checkOutDate - checkInDate) / (1000 * 60 * 60 * 24);
            console.log("Nights:", nights);

            if (nights > 0) {
                setData('total_price', (nights * pricePerNight).toFixed(2));
            } else {
                setData('total_price', ''); // Clear total_price if nights is not positive
            }
        } else {
            setData('total_price', ''); // Clear total_price if any required field is missing
        }
    };

    useEffect(() => {
        calculateTotalPrice();
    }, [data.roomtype, data.check_in, data.check_out]);

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log("Data being sent:", data);
        post('/bookings', {
            data,
            onSuccess: () => {
                setMessage('Booking created successfully');
                setMessageType('success');
                reset();
            },
            onError: () => {
                setMessage('Failed to create booking');
                setMessageType('error');
            },
        });
    };

    useEffect(() => {
        if (message) {
            const timer = setTimeout(() => {
                setMessage('');
            }, 3000);
            return () => clearTimeout(timer);
        }
    }, [message]);

    return (
        <AuthenticatedLayout header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Create Booking</h2>}>
            <Head title="Create Booking" />
            <div className="max-w-lg mx-auto mt-10 p-8 border border-gray-300 rounded-lg shadow-lg bg-white">
                <h2 className="text-2xl font-bold mb-4 text-center">Add Booking</h2>
                {Object.keys(errors).length > 0 && (
                    <div className="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <p className="font-bold">Please correct the following errors:</p>
                        <p>{Object.values(errors).join(', ')}</p>
                    </div>
                )}
                <form onSubmit={handleSubmit} className="space-y-6">
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Guest Name:</label>
                        <input
                            type="text"
                            value={data.guest_name}
                            required
                            onChange={(e) => setData('guest_name', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Room Number:</label>
                        <input
                            type="text"
                            value={data.room_number}
                            required
                            onChange={(e) => setData('room_number', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Check-in Date:</label>
                        <input
                            type="date"
                            value={data.check_in}
                            required
                            onChange={(e) => setData('check_in', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Check-out Date:</label>
                        <input
                            type="date"
                            value={data.check_out}
                            required
                            onChange={(e) => setData('check_out', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        />
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700">Room Type:</label>
                        <select
                            value={data.roomtype}
                            required
                            onChange={(e) => setData('roomtype', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        >
                            <option value="">Select Room Type</option>
                            <option value="Standard">Standard</option>
                            <option value="Suite">Suite</option>
                            <option value="VIP">VIP</option>
                        </select>
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Total Price:</label>
                        <input
                            type="number"
                            value={data.total_price}
                            required
                            onChange={(e) => setData('total_price', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        />
                    </div>

                    <button type="submit" disabled={processing} className="w-full px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        {processing ? 'Creating...' : 'Add Booking'}
                    </button>
                </form>
                {message && <div className={`alert ${messageType}`}>{message}</div>}
            </div>
        </AuthenticatedLayout>
    );
}
