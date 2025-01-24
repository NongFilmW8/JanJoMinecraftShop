import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';
import { useState } from 'react';

export default function Show({ product }) {
    const [showGif, setShowGif] = useState(false);

    const handleBuyClick = () => {
        setShowGif(true);
    };

    const closeModal = () => {
        setShowGif(false);
    };

// แสดงชื่อสินค้าตรง nav bar
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    {product.name}
                </h2>
            }
        >
            <Head title={product.name} />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6">
                            {product.image && (
                                <img
                                    src={product.image}
                                    alt={product.name}
                                    className="w-full h-auto mb-4 rounded"
                                />
                            )}

                            <p className="text-gray-600 text-lg mb-4">
                                {product.description.split('\n').map((line, index) => (
                                    <span key={index}>
                                        {line}<br />
                                    </span>
                                ))}
                            </p>
                            <p className="mt-2 text-lg font-semibold">Price: ${product.price}</p>

                            <div className="mt-4 flex space-x-2">
                                <button
                                    onClick={handleBuyClick}
                                    className="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition"
                                >
                                    Buy
                                </button>
                                <Link
                                    href="/products"
                                    className="text-gray-600 hover:text-gray-900 px-4 py-2 rounded border border-gray-300"
                                >
                                    Back to All Products
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Modal สำหรับ GIF */}
            {showGif && (
                <div className="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div className="bg-white p-4 rounded shadow-lg">
                        <img src="/minecraft-1-logo-pack/butfinish.gif" alt="Purchase Complete" className="w-full h-auto" />
                        <div className="flex justify-end mt-4">
                            <button onClick={closeModal} className="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </AuthenticatedLayout>
    );
}
