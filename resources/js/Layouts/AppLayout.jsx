import { Link } from '@inertiajs/react';

export default function AppLayout({ children }) {
    return (
        <div className="min-h-screen bg-green-50">
            <nav className="bg-white shadow-md">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between h-16">
                        <div className="flex">
                            <div className="flex-shrink-0">
                                <img className="h-8 w-8" src="/path/to/logo.png" alt="Logo" />
                            </div>
                            <div className="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <Link href="/dashboard" className="text-gray-900 hover:text-green-600">
                                    Dashboard
                                </Link>
                                <Link href="/online-chat" className="text-gray-900 hover:text-green-600">
                                    Online Chat
                                </Link>
                                <Link href="/products" className="text-gray-900 hover:text-green-600">
                                    Products
                                </Link>
                                <Link href="/employees" className="text-gray-900 hover:text-green-600">
                                    Employees
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <main>{children}</main>
        </div>
    );
}
