import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import { useState } from 'react';
import { router } from '@inertiajs/react';
import FlashMessage from '@/Components/FlashMessage';

export default function Index({ employees, query }) {
    const [search, setSearch] = useState(query || '');
    const { flash } = usePage().props;

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/employees', { search });
    };

    const handlePageChange = (url) => {
        if (url) {
            router.get(url, { search });
        }
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Employee List
                </h2>
            }
        >
            <Head title="Employees" />
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
                                placeholder="Search by name"
                                className="w-full px-4 py-2 border-2 border-green-800 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            />
                            <button
                                type="submit"
                                className="px-6 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                            >
                                Search
                            </button>
                        </form>
                        {/* Employee Table */}
                        <div className="overflow-x-auto mb-6">
                            <table className="min-w-full bg-white rounded-lg shadow-md">
                                <thead className="bg-green-600 text-white">
                                    <tr>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">ID</th>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">First Name</th>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">Last Name</th>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">Gender</th>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">Birth Date</th>
                                        <th className="px-6 py-3 text-left text-sm font-medium uppercase">Hire Date</th>
                                        <th className="px-6 py-3 text-center text-sm font-medium uppercase">Profile Image</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-green-200">
                                    {employees.data.map((employee, index) => (
                                        <tr key={index} className="hover:bg-green-100">
                                            <td className="px-6 py-4 text-sm text-gray-700">{employee.emp_no}</td>
                                            <td className="px-6 py-4 text-sm text-gray-700">{employee.first_name}</td>
                                            <td className="px-6 py-4 text-sm text-gray-700">{employee.last_name}</td>
                                            <td className="px-6 py-4 text-sm text-gray-700">
                                                {employee.gender === 'M' ? 'Male' : employee.gender === 'F' ? 'Female' : 'Other'}
                                            </td>
                                            <td className="px-6 py-4 text-sm text-gray-700">{employee.birth_date}</td>
                                            <td className="px-6 py-4 text-sm text-gray-700">{employee.hire_date}</td>
                                            <td className="px-6 py-4 text-sm text-gray-700 text-center">
                                                {employee.profile_picture ? (
                                                    <img
                                                        src={`/storage/${employee.profile_picture}`}
                                                        alt={`${employee.first_name} ${employee.last_name}`}
                                                        style={{
                                                            width: '50px',
                                                            height: '50px',
                                                            borderRadius: '50%',
                                                            objectFit: 'cover',
                                                            display: 'inline-block',
                                                            verticalAlign: 'middle',
                                                        }}
                                                    />
                                                ) : (
                                                    <div
                                                        style={{
                                                            width: '50px',
                                                            height: '50px',
                                                            display: 'inline-flex',
                                                            alignItems: 'center',
                                                            justifyContent: 'center',
                                                            verticalAlign: 'middle',
                                                            textAlign: 'center',
                                                        }}
                                                    >
                                                        <span className="text-gray-500">No Image</span>
                                                    </div>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>

                        {/* Pagination */}
                        <div className="flex justify-center mt-6">
                            {employees.links &&
                                employees.links.map((link, index) => (
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
