import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import { useState } from 'react';
import { router } from '@inertiajs/react';
import FlashMessage from '@/Components/FlashMessage';

export default function Index({ bookings, query }) {
    const [search, setSearch] = useState(query || '');
    const [isLoading, setIsLoading] = useState(false);
    const { flash } = usePage().props;

    const handleSearch = (e) => {
        e.preventDefault();
        setIsLoading(true);
        router.get('/bookings', { search }, {
            onFinish: () => setIsLoading(false)
        });
    };

    const handleDelete = (id) => {
        if (confirm('Are you sure you want to delete this booking?')) {
            router.delete(`/bookings/${id}`, {
                onSuccess: () => alert('Booking deleted successfully!')
            });
        }
    };

    return (
        <AuthenticatedLayout
            header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Booking List</h2>}
        >
            <Head title="Bookings" />
            <FlashMessage flash={flash} />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                        <form onSubmit={handleSearch} className="flex items-center gap-4 mb-6">
                            <input
                                type="text"
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                                placeholder="Search by guest name, room number, etc."
                                className="w-full px-4 py-2 border-2 border-green-800 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            />
                            <button
                                type="submit"
                                className="px-6 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                            >
                                Search
                            </button>
                        </form>

                        <div className="overflow-x-auto mb-6">
                            <table className="min-w-full bg-white rounded-lg shadow-md">
                                <thead className="bg-green-600 text-white">
                                    <tr>
                                        <th className="px-6 py-3 text-sm font-medium uppercase">Booking ID</th>
                                        <th className="px-6 py-3 text-sm font-medium uppercase">Guest Name</th>
                                        <th className="px-6 py-3 text-sm font-medium uppercase">Room Number</th>
                                        <th className="px-6 py-3 text-sm font-medium uppercase">Check-in Date</th>
                                        <th className="px-6 py-3 text-sm font-medium uppercase">Check-out Date</th>
                                        <th className="px-6 py-3 text-sm font-medium uppercase">Total Price</th>
                                        <th className="px-6 py-3 text-sm font-medium uppercase">Room Type</th>
                                        <th className="px-6 py-3 text-sm font-medium uppercase text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-green-200">
                                    {bookings.data.map((booking) => (
                                        <tr key={booking.id}>
                                            <td className="px-6 py-3 text-center">{booking.id}</td>
                                            <td className="px-6 py-3 text-center">
                                                {booking.customer ? booking.customer.guest_name : (booking.guest_name || "Unknown")}
                                            </td>
                                            <td className="px-6 py-3 text-center">{booking.room_number}</td>
                                            <td className="px-6 py-3 text-center">{booking.check_in}</td>
                                            <td className="px-6 py-3 text-center">{booking.check_out}</td>
                                            <td className="px-6 py-3 text-center">{booking.total_price}</td>
                                            <td className="px-6 py-3 text-center">
                                                {booking.roomtype ? booking.roomtype : 'Unknown'}
                                            </td>
                                            <td className="px-6 py-3 text-center space-x-2">
                                                <a
                                                    href={`/bookings/${booking.id}/update`}
                                                    className="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none"
                                                >
                                                    Edit
                                                </a>
                                                <button
                                                    onClick={() => handleDelete(booking.id)}
                                                    className="px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 focus:outline-none"
                                                >
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>

                        <div className="flex justify-center mt-6">
                            {bookings.links &&
                                bookings.links.map((link, index) => (
                                    <button
                                        key={index}
                                        onClick={() => router.get(link.url, { search })}
                                         className={`px-3 py-2 mx-1 border rounded-md ${
                                            link.active
                                                ? 'bg-gray-700 text-white'
                                                : 'bg-white text-gray-700 border-gray-400 hover:bg-gray-100'
                                        }`}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                ))}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
