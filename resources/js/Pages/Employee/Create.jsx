import React, { useState, useEffect } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import InputError from '@/Components/InputError';
import { useForm, Head } from '@inertiajs/react';

export default function Create({ departments }) {
    const gender = ['Male', 'Female', 'Other'];
    const { data, setData, post, processing, errors, reset } = useForm({
        first_name: '',
        last_name: '',
        birth_date: '',
        hire_date: '',
        dept_no: '',
        gender: '',
        profile_image: null,
    });

    const [preview, setPreview] = useState(null);
    const [message, setMessage] = useState('');
    const [messageType, setMessageType] = useState('');

    const handleImageChange = (e) => {
        const file = e.target.files[0];
        setData('profile_image', file);

        const reader = new FileReader();
        reader.onloadend = () => {
            setPreview(reader.result);
        };
        if (file) {
            reader.readAsDataURL(file);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        const formData = new FormData();
        Object.keys(data).forEach((key) => {
            formData.append(key, data[key]);
        });

        post('/employees', {
            data: formData,
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            onSuccess: () => {
                setMessage('Employee created successfully');
                setMessageType('success');
                reset();
                setPreview(null);
            },
            onError: () => {
                setMessage('Failed to create employee');
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
        <AuthenticatedLayout header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Create Employee</h2>}>
            <Head title="Create Employee" />
            <div className="max-w-lg mx-auto mt-10 p-8 border border-gray-300 rounded-lg shadow-lg bg-white">
                <h2 className="text-2xl font-bold mb-4 text-center">Add Employee</h2>
                {Object.keys(errors).length > 0 && (
                    <div className="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <p className="font-bold">Please correct the following errors:</p>
                        <p>{Object.values(errors).join(', ')}</p>
                    </div>
                )}
                <form onSubmit={handleSubmit} encType="multipart/form-data" className="space-y-6">
                    <div>
                        <label className="block text-sm font-medium text-gray-700">First Name:</label>
                        <input
                            type="text"
                            value={data.first_name}
                            required
                            onChange={(e) => setData('first_name', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Last Name:</label>
                        <input
                            type="text"
                            value={data.last_name}
                            required
                            onChange={(e) => setData('last_name', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Birth Date:</label>
                        <input
                            type="date"
                            value={data.birth_date}
                            required
                            onChange={(e) => setData('birth_date', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Gender:</label>
                        <select
                            value={data.gender}
                            onChange={(e) => setData('gender', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        >
                            <option value="">Select Gender</option>
                            {gender.map((g) => (
                                <option key={g} value={g}>
                                    {g}
                                </option>
                            ))}
                        </select>
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Hire Date:</label>
                        <input
                            type="date"
                            value={data.hire_date}
                            required
                            onChange={(e) => setData('hire_date', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Department:</label>
                        <select
                            value={data.dept_no}
                            onChange={(e) => setData('dept_no', e.target.value)}
                            disabled={processing}
                            className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                        >
                            <option value="">Select Department</option>
                            {departments.map((dept) => (
                                <option key={dept.dept_no} value={dept.dept_no}>
                                    {dept.dept_name}
                                </option>
                            ))}
                        </select>
                    </div>
                    <div>
                        <label htmlFor="profile_image" className="block text-sm font-medium text-gray-700">Profile Image</label>
                        <input type="file" id="profile_image" onChange={handleImageChange} className="mt-1 block w-full" disabled={processing} />
                    </div>
                    {preview && (
                        <div className="mt-4">
                            <img
                                src={preview}
                                alt="Profile Preview"
                                style={{border: '1px solid #ccc' }}
                            />
                        </div>
                    )}
                    <button type="submit" disabled={processing} className="w-full px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        {processing ? 'Creating...' : 'Add Employee'}
                    </button>
                </form>
                {message && <div className={`alert ${messageType}`}>{message}</div>}
            </div>
        </AuthenticatedLayout>
    );
}
