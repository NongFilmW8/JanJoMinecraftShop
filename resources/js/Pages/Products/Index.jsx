import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function Index({ products }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Products
                </h2>
            }
        >
            <Head title="Products" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6">
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                {products.map((product) => (
                                    <div
                                        key={product.id}
                                        className="bg-gray-50 rounded-lg p-4 hover:shadow-lg transition-shadow border-2 border-green-500"
                                    >
                                        <img src={product.image} alt={product.name} className="product-image mb-2" />
                                        <h2 className="text-xl font-semibold text-gray-700">
                                            {product.name}
                                        </h2>
                                        <p className="text-gray-500 mt-2">Price: ฿{product.price}</p>
                                        <Link
                                            href={`/products/${product.id}`}
                                            className="inline-block mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition"
                                        >
                                            View Product
                                        </Link>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
