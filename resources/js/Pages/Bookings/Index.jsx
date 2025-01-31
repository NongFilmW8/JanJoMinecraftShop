import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import { useState } from 'react';
import { router } from '@inertiajs/react';
import FlashMessage from '@/Components/FlashMessage';

export default function Index({ bookings, query }) {
    const [search, setSearch] = useState(query || '');
    const [isLoading, setIsLoading] = useState(false); // เพิ่ม state นี้
    const { flash } = usePage().props;

    const handleSearch = (e) => {
        e.preventDefault();
        setIsLoading(true); // เริ่มโหลด
        router.get('/bookings', { search }, {
            onFinish: () => setIsLoading(false) // จบโหลด
        });
    };
     // ในส่วน JSX
     {isLoading && (
        <div className="text-center py-4">
            <span className="animate-spin">🌀</span> Loading...
        </div>
    )}

    const handlePageChange = (url) => {
        if (url) {
            router.get(url, { search });
        }
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Booking List
                </h2>
            }
        >
            <Head title="Bookings" />
            <FlashMessage flash={flash} />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                        {/* Search Form */}
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

                        {/* Booking Table */}
                        <div className="overflow-x-auto mb-6">
                            <table className="min-w-full bg-white rounded-lg shadow-md">
                                <thead className="bg-green-600 text-white">
                                    <tr>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">Booking ID</th>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">Guest Name</th>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">Room Number</th>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">Check-in Date</th>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">Check-out Date</th>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-green-200">
                                    {bookings.data.map((booking, index) => (
                                        <tr key={index} className="hover:bg-green-100">
                                            <td className="px-6 py-4 text-sm text-gray-700">{booking.id}</td>
                                            <td className="px-6 py-4 text-sm text-gray-700">{booking.guest_name}</td>
                                            <td className="px-6 py-4 text-sm text-gray-700">{booking.room_number}</td>
                                            <td className="px-6 py-4 text-sm text-gray-700">{booking.check_in_date}</td>
                                            <td className="px-6 py-4 text-sm text-gray-700">{booking.check_out_date}</td>
                                            <td className="px-6 py-4 text-sm text-gray-700">{booking.total_price}</td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>

                        {/* Pagination */}
                        <div className="flex justify-center mt-6">
                            {bookings.links &&
                                bookings.links.map((link, index) => (
                                    <button
                                        key={index}
                                        onClick={() => handlePageChange(link.url)}
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
